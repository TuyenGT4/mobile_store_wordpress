<?php
/**
 * My Account page template override for better layout
 */
defined( 'ABSPATH' ) || exit;
?>

<div class="container py-5">
    <div class="row">
        <div class="col-md-3 mb-4">
            <?php do_action( 'woocommerce_account_navigation' ); ?>
        </div>
        <div class="col-md-9">
            <?php do_action( 'woocommerce_account_content' ); ?>
        </div>
    </div>
</div>