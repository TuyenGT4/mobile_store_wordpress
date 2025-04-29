<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Khởi tạo biến thông báo
global $login_message, $login_error;
$login_message = '';
$login_error = '';

// Chỉ xử lý khi form được submit và tồn tại POST login_action
if ( isset($_POST['login_action']) ) {
    $username = isset($_POST['username']) ? sanitize_user($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Kiểm tra dữ liệu nhập vào
    if ( empty($username) || empty($password) ) {
        $login_error = 'Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu.';
    } else {
        // Thực hiện đăng nhập qua WordPress
        $creds = array(
            'user_login'    => $username,
            'user_password' => $password,
            'remember'      => true
        );
        $user = wp_signon($creds, is_ssl());

        if ( is_wp_error($user) ) {
            $login_error = 'Tên đăng nhập hoặc mật khẩu không đúng!';
        } else {
            // Đăng nhập thành công, chuyển hướng đến tài khoản (dashboard)
            wp_redirect( wc_get_account_endpoint_url('dashboard') );
            exit;
        }
    }
}

// Có thể dùng biến $login_error để hiển thị lỗi trong form-login.php
?>