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

use SignalFlagsPlugin\WpPlugin\AdminPage as BaseAdminPage;

class AdminPage extends BaseAdminPage {
    protected $signalFlags;

    protected $settingsGroups = [
        'user-settings' => [
        ],
    ];

    public function __construct($plugin, $options) {
        parent::__construct($plugin, $options);
        $this->settingsGroups = [
            'user-settings' => [
                'validate' => function ($dirty) {
                    $clean = [
                        'default-flag-set' => basename($dirty['default-flag-set'] ?? ''),
                    ];
                    return $clean;
                },
            ],
        ];
    }

    protected function getContext(): array {
        return [
            'plugin' => [
                'name' => $this->plugin->getName(),
                // 'slug' => $this->plugin->slugify(),
                'version' => $this->plugin->getVersion(),
            ],
        ];
    }
}
