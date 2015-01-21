<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * The search form.
 *
 * @package tsatu
 */
?>
<form role="search" method="get" class="searchform" action="<?php echo home_url('/'); ?>">
        <input kl_virtual_keyboard_secure_input="on" type="text" class="form-control" name="s" placeholder="<?php _e('Search', 'tsatu'); ?>" aria-describedby="search-addon" />
</form>