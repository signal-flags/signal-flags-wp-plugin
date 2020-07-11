<?php

/**
 * This file is part of the Dutyman plugin for WordPress™.
 *
 * @link      https://github.com/opensums/dutyman-plugin
 * @package   dutyman-plugin
 * @copyright [OpenSums](https://opensums.com/)
 * @license   MIT
 */

$span = '<span style="font-family: Consolas, Monaco, monospace; background: rgba(0,0,0,0.07); padding: 0 4px;">';
$sc1 = '[signal-flag a]';
$sc2 = '[signal-flag a height=inline]';
$sc3 = '[signal-flag a height=inline-l]';
$sc4 = '[signal-flag a height=inline-s]';
$sc5 = '[signal-flag ap height=inline width=50 margin="0 50px"]';
$sc6 = '[signal-flags height=40 margin="0 4px"]a z n0 n9 ap s1 s3 greenwhite[/signal-flags]';
$sc7 = '[signal-flags width=40 margin="0 4px"]a b c d e f g[/signal-flags]';
$sc8 = '[signal-flags width=40 margin="0 4px"]n1 n2 n3 ap s1 s2 s3[/signal-flags]';

?>

<div class="wrap">

<?php settings_errors($messagesSlug) ?>

<h1><?php echo get_admin_page_title() ?></h1>

<h2>Getting started</h2>

<p>
Use the shortcode <?php echo($span.$sc1) ?></span> to display an A flag in a
post or page (or anywhere you can use shortcodes), but beware the flag will
expand to fit the available width so use with care! 
</p>

<form action="options.php" method="post">
<?php
// output security fields for the registered setting "wporg"
settings_fields($pageSlug);
// output setting sections and their fields
do_settings_sections($pageSlug);
// output save settings button - moved up into sections.
// submit_button('Save Settings');
?>
<?php submit_button('Save settings'); ?>
</form>

<h2>Instructions</h2>

<p>
Use the shortcode <?php echo($span.$sc1) ?></span> to display an A flag in a
post or page (or anywhere you can use shortcodes), but beware the flag will
expand to fit the available width so use with care! 
</p>

<p>
For use in text like this you can use the
<?php echo($span) ?>height=inline</span>
option <?php echo(do_shortcode($sc2)) ?>. You can adjust the size using
<?php echo($span) ?>inline-l</span> <?php echo(do_shortcode($sc3)) ?> or
<?php echo($span) ?>inline-s</span> <?php echo(do_shortcode($sc4)) ?>.
</p>

<p>Use the <?php echo($span) ?>[signal-flags]&hellip;[/signal-flags]</span>
shortcode to display more than one flag, you can also use the
<?php echo($span) ?>margin</span> option to create some space:<br>
<?php echo($span.$sc6) ?></span><br>
<?php echo(do_shortcode($sc6)) ?>
</p>

<p style="vertical-align: middle;">If you want flags and pennants to line up vertically you can use the
<?php echo($span) ?>width</span> option instead of
<?php echo($span) ?>height</span>:<br>
<?php echo($span.$sc7) ?></span><br>
<?php echo($span.$sc8) ?></span><br>
<?php echo(do_shortcode($sc7)) ?><br>
<?php echo(do_shortcode($sc8)) ?>
</p>

<h2>About the Signal Flags plugin</h2>

This is <?php echo $plugin['name'] ?> version
<?php echo $plugin['version'] ?>.

</div>
