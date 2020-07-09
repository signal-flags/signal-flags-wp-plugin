<?php

namespace SignalFlagsPlugin\WpPlugin;

class Plugin {
    // --- YOU MUST OVERRIDE THESE IN THE PLUGIN CLASS -------------------------
    /** @var string Name of the admin class. */
    protected $adminClass;

    /** @var string Plugin human name. */
    protected $name;

    /** @var string Plugin slug (aka text domain). */
    protected $slug;

    /** @var string Current version. */
    protected $version;

    /** @var string Class for install/uninstall. */
    protected $installClass;

    // -------------------------------------------------------------------------

    /** @var self $instance Singleton instance. */
    protected static $instance;

    /** @var string Path to the plugin. */
    protected $path;

    /** @var mixed[] Configuration etc. */
    protected $settings;

    /** @var mixed[] Global variables for templates. */
    protected $templateGlobals = [];

    /** @var mixed[] Configuration etc. */
    protected $values = [];

    public function __construct(array $config) {
        $this->path = $config['path'];
 
        // Load settings if they have not been injected.
        $this->settings = $config['settings'] ?? new Settings($this);

        // Load the module admin hooks if on an admin page.
        $cls = $this->adminClass ?? null;
        if (is_admin() && $cls) {
            new $cls($this);
        }
    }

    /**
     * Get a prefixed slug.
     *
     * @param string $path The slug to be prefixed.
     * @return string The slug with an added prefix.
     */
    public function slugify(string $slug = null, $separator = null): string {
        if ($slug === null) {
            $ret = $this->slug;
        } else {
            $ret = "{$this->slug}-{$slug}";
        }
        if ($separator === null) {
            return $ret;
        }
        return str_replace('-', $separator, $ret);
    }

    /**
     * Get all the values.
     *
     * @return mixed[] The values.
     */
    public function all() {
        return $this->values;
    }

    public function get(string $key) {
        return $this->values[$key];
    }

    public function getBaseFile() {
        return $this->baseFile;
    }

    public function getName() {
        return $this->name;
    }

    public function getSettings() {
        return $this->settings;
    }

    public function getVersion() {
        return $this->version;
    }

    public function render($template, $vars) {
        extract($this->templateGlobals);
        extract($vars);
        require("{$this->path}/templates/{$template}.tpl.php");
    }

    public function set($key, $value = null) {
        if (is_array($key)) {
            $this->values = array_merge($this->values, $key);
        } else {
            $this->values[$key] = $value;
        }
    }

    protected function load() {}

}
