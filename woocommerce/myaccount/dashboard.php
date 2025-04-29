<?php
if ( ! is_user_logged_in() ) {
    wp_redirect( wc_get_page_permalink('myaccount') );
    exit;
}
$current_user = wp_get_current_user();
$user_id = get_current_user_id();

$customer_orders = wc_get_orders( array(
    'customer_id' => $user_id,
    'orderby'     => 'date',
    'order'       => 'DESC',
    'limit'       => 10,
) );
?>

<div class="card shadow mb-4 mb-4 w-100", style="max-width:100%;">
    <div class="card-body w-100" style="max-width:100%;"">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold mb-0">Đơn Hàng</h3>
            <a href="<?php echo esc_url( wc_get_account_endpoint_url('edit-account') ); ?>" class="btn btn-danger">
                <i class="bi bi-person-gear"></i> Quản Lý Tài Khoản
            </a>
        </div>
        <div class="table-responsive w-100" style="max-width:100%;">
            <table class="table table-striped align-middle text-center w-100" style="min-width:700px;">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Ngày Giờ</th>
                        <th>Mã Giao Dịch</th>
                        <th>Tổng Tiền</th>
                        <th>Trạng Thái Đơn Hàng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ( ! empty($customer_orders) ) :
                        $i = 1;
                        foreach ( $customer_orders as $order ) :
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo esc_html( $order->get_date_created()->date('Y-m-d H:i') ); ?></td>
                        <td>
                            <a href="<?php echo esc_url( $order->get_view_order_url() ); ?>" target="_blank">
                                <?php echo esc_html( $order->get_order_key() ); ?>
                            </a>
                        </td>
                        <td><?php echo wc_price( $order->get_total() ); ?></td>
                        <td>
                            <?php
                                $status = $order->get_status();
                                if ( $status == 'completed' ) {
                                    echo '<span class="badge bg-success">Đã Giao Hàng</span>';
                                } else {
                                    echo '<span class="badge bg-secondary">' . wc_get_order_status_name( $status ) . '</span>';
                                }
                            ?>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr>
                        <td colspan="5">Bạn chưa có đơn hàng nào.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>