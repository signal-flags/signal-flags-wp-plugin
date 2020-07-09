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
<div class="wrap">

<?php settings_errors($messagesSlug) ?>

<h1><?php echo get_admin_page_title() ?></h1>

<form action="options.php" method="post">
<?php
// output security fields for the registered setting "wporg"
settings_fields($pageSlug);
// output setting sections and their fields
do_settings_sections($pageSlug);
// output save settings button - moved up into sections.
// submit_button('Save Settings');

?>
</form>

</div>
