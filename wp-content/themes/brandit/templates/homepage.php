<?php
/**
 * Template Name: Homepage
 */
?>

<?php get_header(); ?>

<div class="container-xxl">
    <h1>Hello world!</h1>
</div>

<?php render_services_section(); ?>

<section class="blog-and-events-section page-section row justify-content-center">
    <div class="recent-events p-4 col-12 col-lg-6 d-flex justify-content-end">
        <div class="split-section">
            <div class="full-width-split__inner">
                <h2 class="mb-4 headline headline--small-plus text-center">Upcoming Events</h2>

				<?php
				$today           = date( 'Ymd' );
				$homepage_events = get_events_query()
				?>

				<?php

				if ( $homepage_events->have_posts() ) {

					while ( $homepage_events->have_posts() ) {
						$homepage_events->the_post();

						$event_args = array(
							'title'         => get_the_title(),
							'short_summary' => get_the_excerpt(),
							'permalink'     => get_the_permalink(),
							'event_date'    => get_field( 'event_date' ),
						);

						// Call the template part for each service
						get_template_part( 'template-parts/events/event-item', null, $event_args );
					}

					wp_reset_postdata();
				} else {
					echo '<p>No upcoming events.</p>';
				}

				?>

                <p class="text-center">
                    <a href="<?php echo get_post_type_archive_link( 'event' ); ?>"
                       class="btn btn-outline-primary text-dark">
                        View All Events
                    </a>
                </p>
            </div>
        </div>
    </div>

    <div class="recent-blogs p-4 col-12 col-lg-6 d-flex justify-content-start">
        <div class="split-section">
            <h2 class="mb-4 headline headline--small-plus text-center">From Our Blog</h2>
			<?php

			$homepage_posts = new WP_Query( array(
				'post_type'      => 'post',
				'posts_per_page' => 2,
			) );

			if ( $homepage_posts->have_posts() ) {

				while ( $homepage_posts->have_posts() ) {
					$homepage_posts->the_post();

					$blog_args = array(
						'title'         => get_the_title(),
						'short_summary' => get_the_excerpt(),
						'permalink'     => get_the_permalink(),
						'event_date'    => get_the_date(),
						'num_of_words'  => 10
					);

					// Call the template part for each service
					get_template_part( 'template-parts/blog/blog-item', null, $blog_args );
				}

				wp_reset_postdata();
			} else {
				echo '<p>No posts yet.</p>';
			}

			?>

            <p class="text-center">
                <a href="<?php echo site_url( '/blog' ); ?>" class="btn btn-outline-secondary text-dark">
                    View All Posts
                </a>
            </p>

        </div>
    </div>
</section>

<?php get_footer(); ?>
