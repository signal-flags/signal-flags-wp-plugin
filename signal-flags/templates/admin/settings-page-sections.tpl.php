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

<?php if ($id === 'defaults'): ?>
These are the settings used by default

<?php elseif ($id === 'show-defaults'): ?>

<div style="display: flex; flex-wrap: wrap;">
<?php foreach ($flags->keys() as $key): ?>
<?php     echo($flags->get($key, [ 'width' => 60, 'margin' => 4 ])) ?>
<?php endforeach; ?>
</div>

<?php elseif ($id === 'system'): ?>
<pre>
Plugin:  <?php echo $plugin['name'] ?>

Version: <?php echo $plugin['version'] ?>

PHP:     <?php echo phpversion() ?>
</pre>

<?php else: ?>

<?php endif ?>
