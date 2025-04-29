<nav class="nav flex-column nav-pills mb-4 account-menu-custom">
    <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
        <a class="nav-link d-flex align-items-center justify-content-between<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>" href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>">
            <span>
                <?php
                // Thêm icon minh họa nếu muốn
                switch ($endpoint) {
                    case 'dashboard':
                        echo '<i class="bi bi-house-door me-2"></i>';
                        break;
                    case 'orders':
                        echo '<i class="bi bi-clipboard-data me-2"></i>';
                        break;
                    case 'downloads':
                        echo '<i class="bi bi-download me-2"></i>';
                        break;
                    case 'edit-address':
                        echo '<i class="bi bi-geo-alt me-2"></i>';
                        break;
                    case 'edit-account':
                        echo '<i class="bi bi-person-gear me-2"></i>';
                        break;
                    case 'customer-logout':
                        echo '<i class="bi bi-box-arrow-right me-2"></i>';
                        break;
                }
                ?>
                <?php echo esc_html( $label ); ?>
            </span>
        </a>
    <?php endforeach; ?>
</nav>