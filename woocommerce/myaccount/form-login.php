<?php include 'process-login.php'; ?>
<div class="myaccount-login">
    <h2>Đăng nhập tài khoản</h2>
    <form method="post" action="<?php echo esc_url( wc_get_account_endpoint_url('dashboard') ); ?>">
        <div class="form-group">
            <label for="username">Tên đăng nhập hoặc Email</label>
            <input type="text" name="username" id="username" required class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" name="password" id="password" required class="form-control">
        </div>
        <button type="submit" class="btn btn-primary" name="login_action">Đăng nhập</button>
    </form>
    <p>Bạn chưa có tài khoản? <a href="<?php echo wc_get_account_endpoint_url('register'); ?>">Đăng ký ngay</a></p>
</div>