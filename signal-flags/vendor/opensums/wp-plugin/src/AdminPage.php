<?php

namespace SignalFlagsPlugin\WpPlugin;

class AdminPage {

    protected $plugin;

    protected $page;

    protected static $defaults = [
        'menuParent' => null,
        'capability' => 'manage_options',
    ];

    protected $settingsGroups = [];
    protected $groups = [];
    protected $sections;

    public function __construct($plugin, $options) {
        $this->plugin = $plugin;
        $this->settings = array_merge([
            'capability' => 'manage_options',
            'menuLabel' => $plugin->getName(),
            'pageTitle' => "{$plugin->getName()} Settings",
            'pageSlug' => 'admin',
        ], $options);

        $this->settings['pageSlug'] = $this->plugin->slugify($this->settings['pageSlug']);

        // Add my entry to the admin menu.
        add_action('admin_menu', [$this, 'addAdminMenuEntry']);
    }

    protected function constructSettings() {
        $settings = $this->settings;
    }

    protected function getContext(): array {
        return [];
    }

    /**
     * Add an entry for the plugin to the Admin menu.
     *
     * Invoked as a callback when the admin menu is being created.
     */
    public function loadAdminMenu(): void {
        $this->adminPage->addAdminMenuEntry([
            // 'parent' => 'settings',
            'callback' => [$this, 'renderSettingsPage'],
        ]);
    }

    /**
     * Show the settings page.
     *
     * Invoked as a callback when the related admin menu item is selected.
     */
    public function renderSettingsPage(): void {
        if (!current_user_can($this->settings['capability'])) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }
        $vars = $this->settings;
        $vars['messagesSlug'] = $this->plugin->slugify('messages');
        $this->plugin->render($this->settings['template'], array_merge($this->getContext(), $vars));
    }

    /**
     * Add an entry in the Admin menu.
     *
     * @param mixed{} $options Options for the menu entry.
     * - `parent => string` Parent entry (if any).
     * - `title => string` <title> tag for the page.
     * - `label => string` Label for the menu entry.
     * - `capability => string` Permission required to show the entry.
     * - `slug => string` Unique slug used in the URI query string.
     * - `callback => callable` Callback to render the page.
     * @return self Chainable.
     */
    public function addAdminMenuEntry(): self {
        $settings = $this->settings;
        $args = [
            $settings['pageTitle'],
            $settings['menuLabel'],
            $settings['capability'],
            $settings['pageSlug'],
            [$this, 'renderSettingsPage'],
        ];
        switch ($settings['menuParent'] ?? null) {
            case 'settings':
                call_user_func_array('add_options_page', $args);
                break;
            default:
                call_user_func_array('add_menu_page', $args);
        }

        return $this;
    }

    /**
     *
     * @param mixed[] $sections An array of sections. Each section is an array:
     * - `string 'id'` The id for the admin page section.
     * - `string 'title'` HTML for the section's title.
     */
    public function addSections(array $sections = []): self {
        $this->sections = $sections;
        add_action('admin_init', [$this, 'addSectionsCallback']);
        add_action('admin_init', [$this, 'addFieldsCallback']);
        return $this;
    }

    public function addSectionsCallback(): void {
        foreach ($this->sections as $section) {
            add_settings_section(
                $section['id'],
                $section['title'] ?? null,
                [$this, 'renderSection'],
                $this->settings['pageSlug']
            );
        }
    }

    /**
     *
     * @param mixed[] $sections An array of sections. Each section is an array:
     * - `string 'id'` The id for the admin page section.
     * - `string 'title'` HTML for the section's title.
     */
    public function addFieldsCallback() {
        foreach ($this->sections ?? [] as $section) {
            foreach ($section['fields'] ?? [] as $field) {
                // Group names by option group and prefix.
                $group = $field['group'] = $field['group'] ?? $section['group'];
                $this->groups[$group] = true;
                $group = $this->plugin->slugify($group, '_');
                $field['key'] = $field['id'];
                $field['name'] = "{$group}[{$field['key']}]";

                // Use label_for in preference to id (since WP 4.6).
                $field['label_for'] = $field['id'] = "{$group}-{$field['id']}";
                add_settings_field(
                    $field['id'],
                    $field['label'],
                    [$this, 'renderField'],
                    $this->settings['pageSlug'],
                    $section['id'],
                    $field
                );
            }
        }
        // Should refactor the whole thing to better integrate the settings and options APIs.
        foreach (array_keys($this->groups) as $group) {
            $optionName = $this->plugin->slugify($group, '_');

            $settingsGroup = $this->settingsGroups[$group] ?? null;

            if ($settingsGroup) {
                register_setting(
                    // Option group.
                    $this->settings['pageSlug'],
                    // Option name.
                    $optionName,
                    [
                        'type' => 'array',
                        'sanitize_callback' => $settingsGroup['validate'],
                    ]
                );
            } else {
                register_setting($this->settings['pageSlug'], $optionName);
            }

            $this->values[$group] = get_option($optionName);
        }
    }

    /**
     * @see https://www.smashingmagazine.com/2016/04/three-approaches-to-adding-configurable-fields-to-your-plugin/
     */
    public function renderField($field) {
        if (is_array($this->values[$field['group']])) {
            $value = $this->values[$field['group']][$field['key']] ?? null;
        } else {
            $value = null;
        }

        // Check which type of field we want
        switch ($field['type'] ?? null) {
            case 'textarea': // If it is a textarea
                printf(
                    '<textarea name="%1$s" id="%2$s" placeholder="%3$s" rows="5"'
                        . ' cols="50">%4$s</textarea>',
                    $field['name'],
                    $field['id'],
                    $field['placeholder'],
                    $value
                );
                break;
            case 'select': // If it is a select dropdown
                if (!empty($field['options']) && is_array($field['options'])) {
                    $options_markup = '';
                    foreach ($field['options'] as $key => $label) {
                        $options_markup .= sprintf(
                            '<option value="%s" %s>%s</option>',
                            $key,
                            selected($value, $key, false),
                            $label
                        );
                    }
                    printf(
                        '<select name="%1$s" id="%2$s">%3$s</select>',
                        $field['name'],
                        $field['id'],
                        $options_markup
                    );
                }
                break;
            case 'html': // Just render the html
                echo($field['html']);
                break;
            case 'text': // If it is a text field
            default:
                printf(
                    '<input name="%1$s" id="%2$s" type="%3$s" placeholder="%4$s"'
                        . ' value="%5$s" />',
                    $field['name'],
                    $field['label_for'],
                    $field['type'] ?? 'text',
                    $field['placeholder'] ?? null,
                    $value
                );
        }

        // If there is help text
        if ($helper = $field['helper'] ?? null) {
            printf('<span class="helper"> %s</span>', $helper); // Show it
        }

        // If there is supplemental text
        if ($supplemental = $field['supplemental'] ?? null) {
            printf('<p class="description">%s</p>', $supplemental); // Show it
        }
    }

    public function renderSection($section) {
        $this->plugin->render($this->settings['sectionTemplate'], array_merge($this->getContext(), $section));
    }
}
