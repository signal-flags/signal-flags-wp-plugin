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
 * Plugin Name:       Signal Flags
 * Description:       Display signal flags (ICS) and other nautical flags on your website.
 * Version:           1.1.1
 * Requires at least: 4.7
 * Requires PHP:      7.2
 * Author:            OpenSums
 * Author URI:        https://github.com/signal-flags/
 * Text Domain:       signal-flags
 * License:           MIT
 * License URI:       https://github.com/signal-flags/signal-flags-wp/LICENSE
 * ```
 */

namespace SignalFlagsPlugin;

defined('WPINC') || die;

require_once(__DIR__.'/vendor/autoload.php');

register_activation_hook(__FILE__, [Install::class, 'activate']);
register_deactivation_hook(__FILE__, [Install::class, 'deactivate']);
register_uninstall_hook(__FILE__, [Install::class, 'uninstall']);

(new Plugin([
    'path' => __DIR__,
]))->load();
