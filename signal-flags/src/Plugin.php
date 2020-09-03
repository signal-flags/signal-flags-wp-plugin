<?php

namespace SignalFlagsPlugin;

use SignalFlagsPlugin\WpPlugin\Plugin as BasePlugin;

use SignalFlagsPlugin\SignalFlags\SignalFlags;

class Plugin extends BasePlugin {

    // --- YOU MUST OVERRIDE THESE IN THE PLUGIN CLASS -------------------------
    /** @var string Name of the admin class. */
    protected $adminClass = Admin::class;

    /** @var string Plugin human name. */
    protected $name = 'Signal Flags';

    /** @var string Plugin slug (aka text domain). */
    protected $slug = 'signal-flags';

    /** @var string Current version. */
    protected $version = '1.1.1';

    /** @var string Class for install/uninstall. */
    protected $installClass = Install::class;

    /** @var SignalFlags SignalFlags object. */
    protected $signalFlags;

    public function allowSvgUpload(array $types): array {
        return array_merge($types, ['svg' => 'image/svg+xml']);
    }

    public function load() {
        // Must call the parent to set up admin if we need to.
        parent::load();
        // Register all hooks here.
        add_shortcode('signal-flag', [$this, 'signalFlagShortcode']);
        add_shortcode('signal-flags', [$this, 'signalFlagsShortcode']);

        if ($this->settings->get('allow_svg_upload')) {
            add_filter('upload_mimes', [$this, 'allowSvgUpload']);
        }
    }

    public function getSignalFlags() {
        if (!$this->signalFlags) {
            $user_settings = get_option('signal_flags_user_settings', []);
            try {
                $this->signalFlags = new SignalFlags([
                    'flagsFile' => $user_settings['default-flag-set'] ?? 'signal-flags-00',
                ]);
            } catch (\Throwable $e) {
                // Couldn't load the requested flagset so load the default one.
                $this->signalFlags = new SignalFlags();
            }
        }
        return $this->signalFlags;
    }

    public function signalFlagShortcode($atts, string $content, string $tag): string {
        $id = is_array($atts) ? ($atts[0] ?? null) : null;
        if (!is_string($id)) return '[]';
        $options = [
            // If the shortcode has no attributes $atts will be an empty string.
            'width' => $atts['width'] ?? null,
            'height' => $atts['height'] ?? null,
            'margin' => $atts['margin'] ?? null,
            'display' => $atts['display'] ?? null,
        ];
        try {
            return $this->getSignalFlags()->get(strtolower($id), $options);
        } catch (\Throwable $e) {
            return "[$id]";
        }
    }

    public function signalFlagsShortcode($atts, string $content, string $tag): string {
        $options = [
            // If the shortcode has no attributes $atts will be an empty string.
            'width' => $atts['width'] ?? null,
            'height' => $atts['height'] ?? null,
            'margin' => $atts['margin'] ?? null,
            'display' => $atts['display'] ?? null,
        ];
        $flags = '';
        foreach (explode(' ', $content) as $id) {
            try {
                $flags .= $this->getSignalFlags()->get(strtolower($id), $options);
            } catch (\Throwable $e) {
                $flags .= "[$id]";
            }
        }
        return $flags;
    }
}
