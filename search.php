<?php get_header(); ?>
<div class="site-content">
  <div class="container py-5">
    <h1 class="mb-4">Kết quả tìm kiếm cho: "<?php echo get_search_query(); ?>"</h1>
    <div class="row justify-content-center">
      <?php
      if (have_posts()) :
        while (have_posts()) : the_post();
          // Chỉ hiển thị sản phẩm WooCommerce
          if (get_post_type() == 'product') :
            global $product;
            if (!$product) $product = wc_get_product(get_the_ID());
      ?>
            <div class="col-md-3 mb-4">
              <div class="card h-100 product-card">
                <a href="<?php the_permalink(); ?>">
                  <?php
                  if (has_post_thumbnail()) {
                    the_post_thumbnail('medium', ['class' => 'card-img-top']);
                  } else {
                    echo '<img src="' . wc_placeholder_img_src() . '" class="card-img-top" alt="No image">';
                  }
                  ?>
                </a>
                <div class="card-body d-flex flex-column">
                  <h5 class="card-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                  </h5>
                  <p class="card-text mb-2"><?php echo $product->get_price_html(); ?></p>
                  <div class="mt-auto">
                    <?php woocommerce_template_loop_add_to_cart(); ?>
                  </div>
                  <?php
                  // Hiển thị danh mục sản phẩm
                  $terms = get_the_terms(get_the_ID(), 'product_cat');
                  if ($terms && !is_wp_error($terms)) {
                    echo '<div class="mt-2"><small>Danh mục: ';
                    $cats = [];
                    foreach ($terms as $term) {
                      $cats[] = '<a href="' . get_term_link($term) . '">' . esc_html($term->name) . '</a>';
                    }
                    echo implode(', ', $cats);
                    echo '</small></div>';
                  }
                  ?>
                </div>
              </div>
            </div>
      <?php
          endif;
        endwhile;
      else :
        echo '<p>Không có sản phẩm phù hợp.</p>';
      endif;
      ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>