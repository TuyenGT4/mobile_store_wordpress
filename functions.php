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
add_theme_support('menus');
add_theme_support('woocommerce');

// Đăng ký menu
function mobilestorewp_register_menus() {
    register_nav_menu('primary', 'Menu chính');
}
add_action('after_setup_theme', 'mobilestorewp_register_menus');

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

