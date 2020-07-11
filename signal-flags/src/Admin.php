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
            'pageTitle' => 'Signal Flags'
        ]);

        $signalFlags = $this->plugin->getSignalFlags();
        // Set up the default flag set selections.
        $flagSetFiles = $signalFlags->getFlagSetFiles();
        $flagSets = [];
        foreach ($flagSetFiles as $file) {
            $flags = include($file);
            $flagSets[basename($file, '.php')] = $flags['meta']['description']['short'];
        }

        // Set up the current default flag set display.
        $currentFlagsHtml = '<div style="display: flex; flex-wrap: wrap; height: 200px; overflow: auto;">';
        foreach ($signalFlags->keys() as $key) {
            $currentFlagsHtml .= ($signalFlags->get($key, [ 'width' => 60, 'margin' => 2 ]));
        }
        $currentFlagsHtml .= '</div>';
        $description = str_replace("\n\n", "</p>\n<p>", $this->plugin->getSignalFlags()->getMeta()['description']['full']);
        $currentFlagsHtml .= "<p>$description</p>";

        $this->adminPage->addSections([
            // placeholder
            // helper to the right
            // supplemental underneath
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
        ]);
    }
}
