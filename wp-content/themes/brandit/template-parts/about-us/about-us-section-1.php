<?php
$page_id         = $args['page_id'] ?? get_the_ID();
$section_fields  = get_fields( $page_id );
$main_title      = $section_fields['section_1_main_title'] ?? '';
$secondary_title = $section_fields['section_1_secondary_title'] ?? '';
$left_image      = $section_fields['section_1_left_image'] ?? '';
$right_image     = $section_fields['section_1_right_image'] ?? '';
$paragraph_1     = $section_fields['section_1_paragraph_1'] ?? '';
$paragraph_2     = $section_fields['section_1_paragraph_2'] ?? '';
$button_cta      = $section_fields['section_1_button_cta'] ?? '';
$button_url      = $section_fields['section_1_button_url'] ?? '';
?>

<section class="about-us-section page-section container-xxl py-5">
    <div class="row g-5">
        <div class="col-lg-6">
            <div class="about-img">

				<?php if ( ! empty( $left_image ) ): ?>
                    <img class="img-fluid" src="<?php echo $left_image['sizes']['about-section-portrait'] ?>"
                         alt="About Us Image 1">
				<?php endif; ?>

				<?php if ( ! empty( $right_image ) ): ?>
                    <img class="img-fluid" src="<?php echo $right_image['sizes']['about-section-portrait'] ?>"
                         alt="About Us Image 1">
				<?php endif; ?>

            </div>
        </div>
        <div class="col-lg-6">
            <h4 class="section-title text-uppercase fw-lighter"><?php echo esc_html( $secondary_title ); ?></h4>
            <h1 class="display-5 mb-4"><?php echo esc_html( $main_title ); ?></h1>

			<?php if ( ! empty( $paragraph_1 ) ): ?>

                <p class="mb-4"><?php echo esc_html( $paragraph_1 ); ?></p>

			<?php endif; ?>

			<?php if ( ! empty( $paragraph_2 ) ): ?>

                <p class="mb-5"><?php echo esc_html( $paragraph_2 ); ?></p>

			<?php endif; ?>

			<?php if ( ! empty( $button_cta ) && ! empty( $button_url ) ): ?>


                <a class="btn btn-primary py-3 px-5" href="<?php echo esc_url( $button_url ); ?>">
					<?php echo esc_html( $button_cta ); ?>
                </a>

			<?php endif; ?>

        </div>
    </div>
</section>
