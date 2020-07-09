<?php

namespace SignalFlagsPlugin;

class Install {

    public static function activate() {
        // Called on activation.
    }

    public static function deactivate() {
        // Called on deactivation - note that this must be a static method.
    }

    public static function uninstall() {
        // Called on delete - note that this must be a static method.
        delete_option('signal_flags_user_settings');
    }
}
