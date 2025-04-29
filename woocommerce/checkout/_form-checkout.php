<?php
defined( 'ABSPATH' ) || exit;
do_action( 'woocommerce_before_checkout_form', $checkout );
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
  echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
  return;
}
?>

<div class="container py-5">
  <h1 class="mb-4"><?php esc_html_e( 'Thanh toán', 'woocommerce' ); ?></h1>
  <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-7">
        <?php
        do_action( 'woocommerce_checkout_before_customer_details' );
        ?>
        <div id="customer_details">
          <?php
          do_action( 'woocommerce_checkout_billing' );
          do_action( 'woocommerce_checkout_shipping' );
          ?>
        </div>
        <?php
        do_action( 'woocommerce_checkout_after_customer_details' );
        ?>
      </div>
      <div class="col-md-5">
        <?php
        do_action( 'woocommerce_checkout_before_order_review_heading' );
        ?>
        <h3 id="order_review_heading"><?php esc_html_e( 'Đơn hàng của bạn', 'woocommerce' ); ?></h3>
        <?php
        do_action( 'woocommerce_checkout_before_order_review' );
        ?>
        <div id="order_review" class="woocommerce-checkout-review-order">
          <?php do_action( 'woocommerce_checkout_order_review' ); ?>
        </div>
        <?php
        do_action( 'woocommerce_checkout_after_order_review' );
        ?>
      </div>
    </div>
  </form>
</div>
<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>