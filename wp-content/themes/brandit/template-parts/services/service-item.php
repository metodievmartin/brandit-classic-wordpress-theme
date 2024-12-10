<?php
$title                = $args['title'] ?? 'Service Title';
$short_summary        = $args['short_summary'] ?? 'Service Short Summary ';
$bg_image_url         = $args['bg_image_url'] ?? '';
$icon_image_url       = $args['icon_image_url'] ?? '';
$service_url          = $args['service_url'] ?? '#';
$num_of_words         = $args['num_of_words'] ?? 20;
$cta_text             = $args['$cta_text'] ?? 'Read More';
$service_item_classes = $args['service_item_classes'] ?? '';
?>

<div class="col-lg-8 col-md-10">
    <div class="service-item row h-100 <?php echo esc_attr( $service_item_classes ); ?>">

		<?php if ( ! empty( $bg_image_url ) ) : ?>
            <div class="p-0 col-12 col-md-5 service-image">
                <img class="" src="<?php echo esc_url( $bg_image_url ) ?>" alt="">
            </div>
		<?php endif; ?>

        <div class="col-12 col-md-7 service-text p-5">

			<?php if ( ! empty( $icon_image_url ) ) : ?>
                <img class="mb-4" src="<?php echo esc_url( $icon_image_url ) ?>" alt="Icon">
			<?php endif; ?>

            <h3 class="mb-3"><?php echo esc_html( $title ); ?></h3>
            <p class="mb-4 flex-grow-1"><?php echo esc_html( wp_trim_words( $short_summary, $num_of_words ) ); ?></p>
            <a class="btn" href="<?php echo esc_url( $service_url ); ?>">
                <i class="fa fa-plus text-primary me-3"></i><?php echo esc_html( $cta_text ); ?>
            </a>
        </div>
    </div>
</div>