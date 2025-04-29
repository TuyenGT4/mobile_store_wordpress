<?php
defined( 'ABSPATH' ) || exit;
get_header( 'shop' ); ?>
<div class="container py-4">
  <h1 class="mb-4"><?php woocommerce_page_title(); ?></h1>
  <?php woocommerce_content(); ?>
</div>
<?php get_footer( 'shop' ); ?>