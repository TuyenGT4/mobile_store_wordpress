<?php
// Nạp Bootstrap, assets, và hỗ trợ WooCommerce
function mobilestorewp_enqueue_scripts() {
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
    wp_enqueue_style('main-style', get_stylesheet_uri());
    wp_enqueue_style('custom-style', get_template_directory_uri().'/assets/css/style.css');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
    wp_enqueue_style( 'bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css' );
}
add_action('wp_enqueue_scripts', 'mobilestorewp_enqueue_scripts');

// Hỗ trợ ảnh đại diện, menu, WooCommerce
add_theme_support('post-thumbnails');
add_theme_support('nav-menus'); // Sửa lại dòng này
add_theme_support('woocommerce');

// Đăng ký menu
function mobilestorewp_register_menus() {
    register_nav_menu('primary', 'Menu chính');
}
add_action('after_setup_theme', 'mobilestorewp_register_menus');

// WooCommerce endpoint dashboard
add_action( 'init', function() {
    add_rewrite_endpoint( 'dashboard', EP_PAGES );
});
add_filter( 'woocommerce_account_menu_items', function( $items ) {
    $items = array( 'dashboard' => 'Bảng điều khiển' ) + $items;
    return $items;
});
add_action( 'woocommerce_account_dashboard_endpoint', function() {
    wc_get_template( 'myaccount/dashboard.php' );
});

// Tìm kiếm sản phẩm theo danh mục
function tg4_search_by_product_category( $where, $query ) {
    global $wpdb;

    if ( is_search() && ! is_admin() && isset( $query->query_vars['s'] ) && $query->query_vars['post_type'] === 'product' ) {
        $search = $query->query_vars['s'];

        // Chỉ lấy danh mục có tên hoặc slug TRÙNG chính xác với từ khoá
        $term = get_term_by( 'name', $search, 'product_cat' );
        if ( ! $term ) {
            $term = get_term_by( 'slug', sanitize_title( $search ), 'product_cat' );
        }

        if ( $term ) {
            $product_ids = get_objects_in_term( $term->term_id, 'product_cat' );
            if ( ! empty( $product_ids ) ) {
                $product_ids = implode( ',', array_map( 'intval', $product_ids ) );
                $where .= " OR {$wpdb->posts}.ID IN ($product_ids)";
            }
        }
    }
    return $where;
}
add_filter( 'posts_where', 'tg4_search_by_product_category', 10, 2 );

// Shortcode giới thiệu
function mobile_store_about_shortcode() {
    ob_start();
    ?>
    <div class="site-content">
      <div class="container py-5">
        <h1 class="mb-4 text-center">Giới Thiệu Về Mobile Store WP</h1>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h2 class="h4 mb-3">Sứ mệnh của chúng tôi</h2>
                        <p>
                            Mobile Store WP được xây dựng với mong muốn mang lại trải nghiệm mua sắm điện thoại di động và phụ kiện trực tuyến dễ dàng, uy tín và an toàn cho người dùng Việt Nam. Chúng tôi không ngừng cập nhật các dòng sản phẩm mới nhất, chính hãng với giá cả cạnh tranh và dịch vụ chăm sóc khách hàng tận tâm.
                        </p>
                        <h2 class="h4 mb-3">Vì sao chọn Mobile Store WP?</h2>
                        <ul>
                            <li>Sản phẩm đa dạng: Điện thoại, máy tính bảng, phụ kiện công nghệ...</li>
                            <li>Cam kết chính hãng 100%, bảo hành minh bạch.</li>
                            <li>Giao hàng nhanh chóng trên toàn quốc.</li>
                            <li>Hỗ trợ khách hàng 24/7 qua nhiều kênh: chat, hotline, email.</li>
                            <li>Thanh toán linh hoạt: tiền mặt, chuyển khoản, ví điện tử...</li>
                        </ul>
                        <h2 class="h4 mb-3">Đội ngũ phát triển</h2>
                        <p>
                            Mobile Store WP được phát triển dựa trên nền tảng WordPress & WooCommerce, tối ưu giao diện, tốc độ và bảo mật. Đội ngũ kỹ thuật viên và chăm sóc khách hàng luôn sẵn sàng lắng nghe mọi phản hồi để giúp bạn có trải nghiệm tốt nhất khi mua sắm tại đây.
                        </p>
                        <h2 class="h4 mb-3">Liên hệ với chúng tôi</h2>
                        <p>
                            Nếu bạn có câu hỏi, góp ý hoặc cần hỗ trợ, vui lòng liên hệ qua:<br>
                            Email: <a href="mailto:hotro@mobilestorewp.vn">hotro@mobilestorewp.vn</a><br>
                            Hotline: <a href="tel:0123456789">0123 456 789</a><br>
                            Fanpage: <a href="#">Facebook Mobile Store WP</a>
                        </p>
                        <div class="text-center mt-4">
                            <a href="<?php echo home_url(); ?>" class="btn btn-primary">Về trang chủ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('mobile_store_about', 'mobile_store_about_shortcode');