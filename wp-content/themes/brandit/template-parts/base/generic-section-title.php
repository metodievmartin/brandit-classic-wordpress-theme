<?php
$section_top_title  = $args['section_top_title'] ?? '';
$section_main_title = $args['section_main_title'] ?? '';
?>

<div class="generic-section-title container-fluid py-6">
    <div class="container">
        <div class="text-center">

			<?php if ( ! empty( $section_top_title ) ): ?>
                <h5 class="skewed-title">
					<?php echo esc_html( $section_top_title ); ?>
                </h5>
			<?php endif; ?>

            <h1 class="display-5 mb-5">
				<?php echo esc_html( $section_main_title ); ?>
            </h1>
        </div>
    </div>
</div>