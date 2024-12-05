<?php get_header(); ?>

<?php
get_template_part(
	'template-parts/banners/page-banner',
	null,
	array( 'page_title' => 'All Events' )
);
?>

    <section class="services-section page-section container-xxl">
        <div class="row justify-content-center g-5">

			<?php while ( have_posts() ) : the_post(); ?>

                <div class="col-12 col-md-5">

					<?php

					$event_args = array(
						'title'         => get_the_title(),
						'short_summary' => get_the_excerpt(),
						'bg_image_url'  => get_the_post_thumbnail_url(),
						'permalink'     => get_the_permalink(),
						'event_date'    => get_field( 'event_date' ),
					);

					// Call the template part for each service
					get_template_part( 'template-parts/events/event-item', null, $event_args );

					?>

                </div>
			<?php endwhile; ?>

        </div>
    </section>

<?php get_footer(); ?>