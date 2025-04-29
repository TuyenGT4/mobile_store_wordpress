<?php get_header(); ?>
<div class="site-content" style="padding-top: 80px;">
  <!-- Nội dung trang -->
  <div class="container py-5">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <div><?php the_content(); ?></div>
    <?php endwhile; endif; ?>
    </div>
</div>
<?php get_footer(); ?>