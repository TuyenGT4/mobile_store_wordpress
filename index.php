<?php get_header(); ?>
<div class="site-content" style="padding-top: 80px;">
  <div class="container py-5">
    <h1 class="mb-4">Bài viết mới</h1>
    <div class="row">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <?php if(has_post_thumbnail()): ?>
              <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium', ['class' => 'card-img-top']); ?></a>
            <?php endif; ?>
            <div class="card-body">
              <h5 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
              <p class="card-text"><?php the_excerpt(); ?></p>
            </div>
          </div>
        </div>
      <?php endwhile; else: ?>
        <p>Không có bài viết nào.</p>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>