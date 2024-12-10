<?php
$section_title  = $args['section_title'] ?? __( 'Upcoming Events', 'brandit' );
$no_items_found = $args['no_items_found'] ?? __( 'No upcoming events.', 'brandit' );
?>

<div class="recent-events p-4 col-12 col-lg-6 d-flex justify-content-end">
    <div class="split-section">
        <h2 class="mb-4 headline headline--small-plus text-center">
			<?php echo esc_html( $section_title ); ?>
        </h2>

		<?php
		$today        = date( 'Ymd' );
		$events_query = get_events_query();

		if ( $events_query->have_posts() ) {

			while ( $events_query->have_posts() ) {
				$events_query->the_post();

				$event_item_args = array(
					'title'         => get_the_title(),
					'short_summary' => get_the_excerpt(),
					'permalink'     => get_the_permalink(),
					'event_date'    => get_field( 'event_date' ),
				);

				get_template_part( 'template-parts/events/event-item', null, $event_item_args );
			}

			$button_args = array(
				'button_title'   => __( 'View All Events', 'brandit' ),
				'button_link'    => get_post_type_archive_link( 'event' ),
				'button_classes' => 'btn-outline-primary text-dark',
			);

			get_template_part( 'template-parts/base/button-link', null, $button_args );

			wp_reset_postdata();
		} else {
			echo '<p class="text-center">' . esc_html( $no_items_found ) . '</p>';
		}
		?>

    </div>
</div>
