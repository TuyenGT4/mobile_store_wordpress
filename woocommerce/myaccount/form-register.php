<?php include 'process-register.php'; ?>
<div class="myaccount-register">
    <h2>Đăng ký tài khoản mới</h2>
    <form method="post" action="<?php echo esc_url( wc_get_account_endpoint_url('dashboard') ); ?>">
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
        <button type="submit" class="btn btn-success" name="register_action">Đăng ký</button>
    </form>
    <p>Đã có tài khoản? <a href="<?php echo wc_get_account_endpoint_url('login'); ?>">Đăng nhập</a></p>
</div>