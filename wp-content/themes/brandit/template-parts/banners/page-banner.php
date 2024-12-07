<?php
$page_title    = $args['page_title'] ?? get_the_title();
$page_subtitle = $args['page_subtitle'] ?? '';
?>

<section class="main-page-banner container-fluid">
    <div class="container-xxl text-center">
        <h1 class="display-1 mb-4"><?php echo esc_html( $page_title ); ?></h1>

		<?php if ( ! empty( $page_subtitle ) ): ?>
            <h4 class="banner-subtitle fw-light"><?php echo esc_html( $page_subtitle ); ?></h4>
		<?php endif; ?>

    </div>
</section>