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

    protected function getContext(): array {
        if (!$this->signalFlags) {
            $this->signalFlags = new SignalFlags\SignalFlags();
        }
        return [
            'flags' => $this->signalFlags,
            'plugin' => [
                'name' => $this->plugin->getName(),
                'slug' => $this->plugin->slugify(),
                'version' => $this->plugin->getVersion(),
            ],
        ];
    }
}
