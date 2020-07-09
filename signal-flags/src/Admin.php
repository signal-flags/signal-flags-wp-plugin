<?php

/**
 * This file is part of the Dutyman plugin for WordPress™.
 *
 * @link      https://github.com/opensums/dutyman-plugin
 * @package   dutyman-plugin
 * @copyright [OpenSums](https://opensums.com/)
 * @license   MIT
 */

namespace SignalFlagsPlugin;

use SignalFlagsPlugin\WpPlugin\Admin as BaseAdmin;

/**
 * Main class for the Dutyman plugin.
 */
class Admin extends BaseAdmin {

    protected function load(): void {
        // Load admin page hooks here.
        $this->loadAdminPage();
    }

    protected function loadAdminPage(): void {
        $this->adminPage = new AdminPage($this->plugin, [
            'template' => 'admin/settings-page',
            'sectionTemplate' => 'admin/settings-page-sections',
            'menuParent' => 'settings',
        ]);

        $signalFlags = $this->plugin->getSignalFlags();
        // Set up the default flag set selections.
        $flagSetFiles = $signalFlags->getFlagSetFiles();
        $flagSets = [];
        foreach ($flagSetFiles as $file) {
            $flags = include($file);
            $flagSets[basename($file, '.php')] = $flags['meta']['description'];
        }

        // Set up the current default flag set display.
        $currentFlagsHtml = '<div style="display: flex; flex-wrap: wrap; height: 200px; overflow: auto;">';
        foreach ($signalFlags->keys() as $key) {
            $currentFlagsHtml .= ($signalFlags->get($key, [ 'width' => 60, 'margin' => 2 ]));
        }
        $currentFlagsHtml .= '</div>';

        $this->adminPage->addSections([
            // placeholder
            // helper to the right
            // supplemental underneath
            [
                'id' => 'intro',
                'title' => __('Quick start', 'signal-flags'),
            ],
            [
                // This is prefixed and used as the key in the wp_options table.
                'group' => 'user-settings',
                // Prefixed and used as the section element's id.
                'id' => 'default-flags',
                'title' => __('Default flag set', 'signal-flags'),
                'fields' => [
                    [
                        'id' => 'current-default',
                        'label' => __('Current default set', 'signal-flags'),
                        'type' => 'html',
                        'html' => $currentFlagsHtml,
                    ],
                    [
                        'id' => 'default-flag-set',
                        'label' => __('Change default set', 'signal-flags'),
                        'type' => 'select',
                        'options' => $flagSets,
                    ],
                ],
            ],
            [
                // The default settings options group for this section.
                // 'group' => 'defaults',
                // Prefixed and used as the section element's id.
                'id' => 'save-settings',
            ],
            [
                // The default settings options group for this section.
                // 'group' => 'defaults',
                // Prefixed and used as the section element's id.
                'id' => 'about',
                'title' => __('About Signal Flags', 'signal-flags'),
            ],
        ]);
    }
}
