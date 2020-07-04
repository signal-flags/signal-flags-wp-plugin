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
            'savedMessage' => __('Signal Flags settings saved at', 'signal-flags'),
        ]);

        $this->adminPage->addSections([
            // placeholder
            // helper to the right
            // supplemental underneath
            [
                // The default settings options group for this section.
                'group' => 'defaults',
                // Prefixed and used as the section element's id.
                'id' => 'defaults',
                'title' => 'Default flag set',
                'fields' => [
                    [
                        // Prefixed and used as the element's id.
                        'id' => 'default-colors',
                        'label' => __('Colours', 'signal-flags'),
                        'type' => 'select',
                        'options' => ['default' => 'Default', 'b' => 'Primary'],
                    ],
                    [
                        'id' => 'default-shape',
                        'label' => __('Shape', 'signal-flags'),
                        'type' => 'select',
                        'options' => [
                            'square' => 'Square',
                            '3x2' => '3:2',
                            '4x3' => '4:3',
                            '16x9' => '16:9',
                        ],
                        'helper' => __('The aspect ratio of letter flags C-Z', 'signal-flags'),
                    ],
                    [
                        // Prefixed and used as the element's id.
                        'id' => 'default-width',
                        'label' => __('Width', 'signal-flags'),
                    ],
                ],
            ],
            [
                // The default settings options group for this section.
                // 'group' => 'defaults',
                // Prefixed and used as the section element's id.
                'id' => 'show-defaults',
            ],
            [
                // The default settings options group for this section.
                // 'group' => 'defaults',
                // Prefixed and used as the section element's id.
                'id' => 'system',
                'title' => 'System information',
            ],
        ]);
    }
}
