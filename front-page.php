<?php get_header(); ?>
<div class="site-content">
  <div class="container py-5">
      <h1 class="mb-4 text-center">Sản phẩm theo danh mục</h1>
      <?php
      // Lấy các danh mục cha (không có parent)
      $parent_terms = get_terms([
          'taxonomy' => 'product_cat',
          'hide_empty' => false,
          'parent' => 0, // Chỉ lấy danh mục cha
      ]);
      foreach ($parent_terms as $term) :
          // Query sản phẩm trong từng danh mục cha
          $args = [
              'post_type' => 'product',
              'posts_per_page' => 8,
              'tax_query' => [[
                  'taxonomy' => 'product_cat',
                  'field'    => 'term_id',
                  'terms'    => $term->term_id,
                  'include_children' => true, // Bao gồm cả sản phẩm trong danh mục con
              ]],
          ];
          $query = new WP_Query($args);
          if ($query->have_posts()) : ?>
              <h2 class="mb-3 mt-5"><?php echo esc_html($term->name); ?></h2>
              <ul class="products columns-4">
                  <?php while ($query->have_posts()) : $query->the_post(); ?>
                      <?php wc_get_template_part('content', 'product'); ?>
                  <?php endwhile; ?>
              </ul>
          <?php endif;
          wp_reset_postdata();
      endforeach; ?>
  </div>
</div>
<?php get_footer(); ?>