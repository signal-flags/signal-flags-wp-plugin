<?php

/**
 * This file is part of the Dutyman plugin for WordPress™.
 *
 * @link      https://github.com/opensums/dutyman-plugin
 * @package   dutyman-plugin
 * @copyright [OpenSums](https://opensums.com/)
 * @license   MIT
 */

?>

<?php if ($id === 'intro'): ?>
<?php
$sc1 = '[signal-flag a]';
$sc2 = '[signal-flag a height=30]';
$sc3 = '[signal-flag s1 width=40]';
$sc4 = '[signal-flag n1 height=20 margin=4]';
$sc5 = '[signal-flag ap width=50 margin="0 50px"]';
$sc6 = '[signal-flags height=40 margin="10px 2px"]a n1 ap s1 z black[/signal-flags]';
$sc7 = '[signal-flags width=60 margin="10px 2px"]a n1 ap s1 z black[/signal-flags]';
?>
<div style="margin-bottom: 3em;">
Use the shortcode <code><?php echo($sc1) ?></code> to display an A flag in a post or page.
You can modify the display with options: try
<code><?php echo($sc2) ?></code>
<?php echo(do_shortcode($sc2)) ?>, <code><?php echo($sc3) ?></code>
<?php echo(do_shortcode($sc3)) ?>, <code><?php echo($sc4) ?></code>
<?php echo(do_shortcode($sc4)) ?>, <code><?php echo($sc5) ?></code>
<?php echo(do_shortcode($sc5)) ?>
</div>

<div style="margin-bottom: 3em;">
<p>Use the <code>[signal-flags]&hellip;[/signal-flags]</code> shortcode to display more than one flag:</p>
<div><code><?php echo($sc6) ?></code></div>
<div><?php echo(do_shortcode($sc6)) ?></div>
<div><code><?php echo($sc7) ?></code></div>
<div><?php echo(do_shortcode($sc7)) ?></div>
</div>


<?php elseif ($id === 'default-flags'): ?>

<?php elseif ($id === 'save-settings'): ?>
<?php submit_button('Save Settings'); ?>

<?php elseif ($id === 'about'): ?>
This is <?php echo $plugin['name'] ?> version
<?php echo $plugin['version'] ?>.

<?php else: ?>

<?php endif ?>
