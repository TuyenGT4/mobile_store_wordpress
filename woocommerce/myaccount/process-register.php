<?php
if ( ! defined( 'ABSPATH' ) ) exit;

global $register_error, $register_success;
$register_error = '';
$register_success = '';

if ( isset($_POST['register_action']) ) {
    // Check nonce
    if (!isset($_POST['custom_register_nonce']) || !wp_verify_nonce($_POST['custom_register_nonce'], 'custom_register_action')) {
        $register_error = 'Có lỗi bảo mật. Vui lòng thử lại!';
    } else {
        $username = isset($_POST['reg_username']) ? sanitize_user($_POST['reg_username']) : '';
        $email    = isset($_POST['reg_email']) ? sanitize_email($_POST['reg_email']) : '';
        $password = isset($_POST['reg_password']) ? $_POST['reg_password'] : '';

        if ( empty($username) || empty($email) || empty($password) ) {
            $register_error = 'Vui lòng nhập đầy đủ thông tin đăng ký.';
        } elseif ( strlen($password) < 6 ) {
            $register_error = 'Mật khẩu phải từ 6 ký tự trở lên.';
        } elseif ( username_exists($username) ) {
            $register_error = 'Tên tài khoản đã tồn tại.';
        } elseif ( email_exists($email) ) {
            $register_error = 'Email đã được sử dụng.';
        } elseif ( !is_email($email) ) {
            $register_error = 'Email không hợp lệ.';
        } else {
            $user_id = wp_create_user( $username, $password, $email );
            if ( is_wp_error($user_id) ) {
                $register_error = 'Đăng ký thất bại: ' . $user_id->get_error_message();
            } else {
                wp_set_current_user($user_id);
                wp_set_auth_cookie($user_id);
                $register_success = 'Đăng ký thành công! Đang chuyển hướng tới tài khoản...';
                wp_redirect( home_url('/my-account/') );
                exit;
            }
        }
    }
}
?>