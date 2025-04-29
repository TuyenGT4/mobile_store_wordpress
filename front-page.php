<?php get_header(); ?>
<div class="site-content">
  <div class="container py-5">
      <h1 class="mb-4 text-center">Sản phẩm theo danh mục</h1>
      <?php
      $terms = get_terms([
          'taxonomy' => 'product_cat',
          'hide_empty' => false,
      ]);
      foreach ($terms as $term) :
          $args = [
              'post_type' => 'product',
              'posts_per_page' => 8,
              'tax_query' => [[
                  'taxonomy' => 'product_cat',
                  'field'    => 'term_id',
                  'terms'    => $term->term_id,
              ]],
          ];
          $query = new WP_Query($args);
          if ($query->have_posts()) : ?>
              <h2 class="mb-3 mt-5"><?php echo esc_html($term->name); ?></h2>
              <div class="row">
                  <?php while ($query->have_posts()) : $query->the_post(); global $product; ?>
                  <div class="col-md-3 mb-4">
                      <div class="card h-100 product-card">
                          <a href="<?php the_permalink(); ?>">
                              <?php if (has_post_thumbnail()) {
                                  the_post_thumbnail('medium', ['class' => 'card-img-top']);
                              } else {
                                  echo '<img src="' . wc_placeholder_img_src() . '" class="card-img-top" alt="No image">';
                              } ?>
                          </a>
                          <div class="card-body d-flex flex-column">
                              <h5 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                              <p class="card-text mb-2"><?php echo $product->get_price_html(); ?></p>
                              <div class="mt-auto">
                                  <?php woocommerce_template_loop_add_to_cart(); ?>
                              </div>
                          </div>
                      </div>
                  </div>
                  <?php endwhile; ?>
              </div>
          <?php endif;
          wp_reset_postdata();
      endforeach; ?>
  </div>
</div>
<?php get_footer(); ?>