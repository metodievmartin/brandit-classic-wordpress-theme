<?php

/**
 * Render the services section with dynamically queried posts of the `service` custom post type.
 *
 * @param array $section_args
 * @param array $query_args
 */
function render_services_section( $section_args = array(), $query_args = array() ) {
	// Set default arguments
	$query_defaults = array(
		'posts_per_page' => 6, // get from the services settings
		'order'          => 'ASC',
		'orderby'        => 'menu_order',
	);

	$section_defaults = array(
		'show_section_title'    => true,
		'section_title'         => 'What we offer',
		'show_section_subtitle' => true,
		'section_subtitle'      => 'Our Services',
	);

	$parsed_query_args   = wp_parse_args( $query_args, $query_defaults );
	$parsed_section_args = wp_parse_args( $section_args, $section_defaults );

	// default overwrite
	$parsed_query_args['post_type'] = 'service';

	// Perform the query
	$query = new WP_Query( $parsed_query_args );

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

			if ( $query->have_posts() ) {

				while ( $query->have_posts() ) {
					$query->the_post();

					$card_args = array(
						'title'         => get_the_title(),
						'short_summary' => get_the_excerpt(),
						'bg_image_url'  => get_the_post_thumbnail_url(),
						'service_url'   => get_the_permalink(),
					);

					// Call the template part for each service
					get_template_part( 'template-parts/services/service-item', null, $card_args );
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
