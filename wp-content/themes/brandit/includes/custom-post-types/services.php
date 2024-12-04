<?php

/**
 * Render the services section with dynamically queried posts of the `service` custom post type.
 *
 * @param array $section_args
 */
function render_services_section( $section_args = array() ) {
	// Set default arguments
	$section_defaults = array(
		'show_section_title'    => true,
		'section_title'         => 'What we offer',
		'show_section_subtitle' => true,
		'section_subtitle'      => 'Our Services',
	);

	$parsed_section_args = wp_parse_args( $section_args, $section_defaults );

	$services_query = get_services_query();

	?>

    <section class="services-section container-xxl">
        <div class="section-title text-center mx-auto mb-5">
            <h5 class="skewed-title">
				<?php echo esc_html( $parsed_section_args['section_subtitle'] ) ?>
            </h5>
            <h1 class="display-5 mb-5 mt-2">
				<?php echo esc_html( $parsed_section_args['section_title'] ) ?>
            </h1>
        </div>
        <div class="row g-4">

			<?php

			if ( $services_query->have_posts() ) {

				while ( $services_query->have_posts() ) {
					$services_query->the_post();

					$card_args = array(
						'title'         => get_the_title(),
						'short_summary' => get_the_excerpt(),
						'bg_image_url'  => get_the_post_thumbnail_url(),
						'service_url'   => get_the_permalink(),
					);

					// Call the template part for each service
					get_template_part( 'template-parts/services/service-card', null, $card_args );
				}

				wp_reset_postdata();
			} else {
				echo '<p>No services found.</p>';
			}

			?>
        </div>
    </section>

	<?php
}
