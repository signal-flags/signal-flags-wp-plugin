<?php

namespace SignalFlagsPlugin\WpPlugin;

class Admin {

    protected $plugin;

    public function __construct($plugin) {
        $this->plugin = $plugin;
        $this->load();
    }

    protected function load() {}
}
