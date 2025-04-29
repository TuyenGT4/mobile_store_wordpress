<?php
defined( 'ABSPATH' ) || exit;
wc_print_notices();
do_action( 'woocommerce_before_cart' );
?>
<div class="container py-5">
  <h1 class="mb-4"><?php esc_html_e( 'Giỏ hàng', 'woocommerce' ); ?></h1>
  <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
    <?php do_action( 'woocommerce_before_cart_table' ); ?>
    <table class="shop_table shop_table_responsive cart table table-bordered">
      <?php do_action( 'woocommerce_before_cart_table' ); ?>
      <tbody>
        <?php do_action( 'woocommerce_cart_contents' ); ?>
      </tbody>
    </table>
    <?php do_action( 'woocommerce_after_cart_table' ); ?>
    <div class="cart-collaterals">
      <?php do_action( 'woocommerce_cart_collaterals' ); ?>
    </div>
    <?php do_action( 'woocommerce_after_cart' ); ?>
  </form>
</div>