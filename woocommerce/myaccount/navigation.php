<nav class="nav flex-column nav-pills mb-4">
    <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
        <a class="nav-link<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>" href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>">
            <?php echo esc_html( $label ); ?>
        </a>
    <?php endforeach; ?>
</nav>