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
    protected $version = '0.1.0-dev';

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

        add_filter('upload_mimes', [$this, 'allowSvgUpload']);
    }

    public function getSignalFlags() {
        if (!$this->signalFlags) {
            $this->signalFlags = new SignalFlags();
        }
        return $this->signalFlags;
        // Must call the parent to set up admin if we need to.
        parent::load();
        // Register all hooks here.
        add_shortcode('signal-flag', [$this, 'signalFlagShortcode']);
    }

    public function signalFlagShortcode($atts, string $content, string $tag): string {
        $id = is_array($atts) ? ($atts[0] ?? null) : null;
        if (!is_string($id)) return '[]';
        $options = [
            // If the shortcode has no attributes $atts will be an empty string.
            'width' => $atts['width'] ?? null,
            'height' => $atts['height'] ?? null,
            'display' => $atts['display'] ?? 'inline',
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
            'display' => $atts['display'] ?? 'inline',
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
