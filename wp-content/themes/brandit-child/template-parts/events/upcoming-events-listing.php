<?php
$events_query = $args['events_query'] ?? null;
?>

<section class="event-listing-section page-section container-xxl">

    <div class="text-center mb-5">
        <h2>A template loaded from child theme</h2>
        <h5>Overwriting the default "upcoming_events_list" shortcode template</h5>
    </div>


    <div class="event-listing-grid row g-5">

		<?php

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
		}

		?>

    </div>

</section>

