<?php include 'process-register.php'; ?>
<?php global $register_error, $register_success; ?>
<?php if (!empty($register_error)): ?>
    <div class="alert alert-danger"><?php echo esc_html($register_error); ?></div>
<?php endif; ?>
<?php if (!empty($register_success)): ?>
    <div class="alert alert-success"><?php echo esc_html($register_success); ?></div>
<?php endif; ?>

<div class="myaccount-register">
    <h2>Đăng ký tài khoản mới</h2>
    <form method="post" action="">
        <div class="form-group">
            <label for="reg_username">Tên tài khoản</label>
            <input type="text" name="reg_username" id="reg_username" required class="form-control">
        </div>
        <div class="form-group">
            <label for="reg_email">Email</label>
            <input type="email" name="reg_email" id="reg_email" required class="form-control">
        </div>
        <div class="form-group">
            <label for="reg_password">Mật khẩu</label>
            <input type="password" name="reg_password" id="reg_password" required class="form-control">
        </div>
        <?php wp_nonce_field('custom_register_action', 'custom_register_nonce'); ?>
        <button type="submit" class="btn btn-success" name="register_action">Đăng ký</button>
    </form>
    <p>Đã có tài khoản? <a href="<?php echo esc_url( wc_get_account_endpoint_url('login') ); ?>">Đăng nhập</a></p>
</div>