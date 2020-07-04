<?php

/**
 * This file is part of the Signal Flags plugin for WordPress.
 *
 * @link      https://github.com/signal-flags/signal-flags-wp/
 * @package   signal-flags
 * @copyright [OpenSums](https://opensums.com/)
 * @license   MIT
 *
 * @wordpress ```
 * Plugin Name:       Signal Flags (Development)
 * Description:       Integrate flags from the Interational Code of Signals (and more).
 * Version:           0.1.0-dev
 * Requires at least: 5.2 - check this
 * Requires PHP:      7.2 - check this
 * Author:            OpenSums
 * Author URI:        https://opensums.com/
 * Text Domain:       signal-flags
 * License:           MIT
 * License URI:       https://github.com/signal-flags/signal-flags-wp/LICENSE
 * ```
 */

namespace SignalFlagsPlugin;

defined('WPINC') || die;

require_once(__DIR__.'/signal-flags/vendor/autoload.php');

register_activation_hook(__FILE__, [Install::class, 'activate']);
register_deactivation_hook(__FILE__, [Install::class, 'deactivate']);
register_uninstall_hook(__FILE__, [Install::class, 'uninstall']);

(new Plugin([
    'path' => __DIR__ . '/signal-flags',
    ]), 'load']);
]))->load();
