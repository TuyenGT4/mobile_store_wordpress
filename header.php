<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-mobile-header fixed-top py-3 shadow">
      <div class="container">
        <!-- Logo -->
        <a class="navbar-brand fw-bold" href="<?php echo home_url(); ?>">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/logo.png" alt="Logo" style="height:40px;max-width:100%;">
          Mobile Store
        </a>

        <!-- Search Bar -->
        <form class="d-none d-lg-flex mx-3 flex-grow-1" role="search" method="get" action="<?php echo home_url('/'); ?>">
          <input class="form-control me-2" type="search" name="s" placeholder="Tìm kiếm sản phẩm..." aria-label="Search">
          <button class="btn btn-outline-primary" type="submit">Tìm</button>
        </form>

        <!-- Toggle button mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu & nút -->
        <div class="collapse navbar-collapse" id="mainNav">
          <ul class="navbar-nav ms-auto align-items-lg-center">
            <li class="nav-item"><a class="nav-link" href="<?php echo esc_url( home_url('/dien-thoai/') ); ?>">Điện thoại</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo esc_url( home_url('/phu-kien/') ); ?>">Phụ kiện</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo esc_url( home_url('/gioi-thieu/') ); ?>">Giới thiệu</a></li>
            <!-- Giỏ hàng -->
            <li class="nav-item ms-2">
              <a class="nav-link position-relative" href="<?php echo wc_get_cart_url(); ?>">
                <i class="bi bi-cart3"></i> Giỏ hàng
                <?php if (function_exists('WC')): ?>
                <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                  <?php echo WC()->cart->get_cart_contents_count(); ?>
                </span>
                <?php endif; ?>
              </a>
            </li>
            <!-- User Account -->
            <li class="nav-item ms-2">
              <?php if (is_user_logged_in()) : 
                $current_user = wp_get_current_user();
              ?>
                <a class="nav-link d-flex align-items-center gap-2" href="<?php echo esc_url( wc_get_page_permalink('myaccount') ); ?>">
                  <i class="bi bi-person-circle"></i>
                  <span><?php echo esc_html( $current_user->display_name ); ?></span>
                </a>
              <?php else: ?>
                <a class="btn btn-primary ms-2" href="<?php echo esc_url( wc_get_page_permalink('myaccount') ); ?>">
                  Đăng nhập
                </a>
              <?php endif; ?>
            </li>
          </ul>
          <!-- Search bar mobile -->
          <form class="d-lg-none my-2" role="search" method="get" action="<?php echo home_url('/'); ?>">
            <input class="form-control mb-2" type="search" name="s" placeholder="Tìm kiếm sản phẩm..." aria-label="Search">
            <button class="btn btn-outline-primary w-100" type="submit">Tìm</button>
          </form>
        </div>
      </div>
    </nav>
  </header>