<?php get_header(); ?>

<?php
get_template_part(
	'template-parts/banners/page-banner',
	null,
	array( 'page_title' => 'All Services' )
);
?>

    <div class="services-section container-xxl">
        <div class="row justify-content-center align-items-center g-4">

			<?php while ( have_posts() ) : the_post();

				$card_args = array(
					'title'         => get_the_title(),
					'short_summary' => get_the_excerpt(),
					'bg_image_url'  => get_the_post_thumbnail_url(),
					'service_url'   => get_the_permalink(),
				);

				// Call the template part for each service
				get_template_part( 'template-parts/services/service-item', null, $card_args );

			endwhile; ?>

        </div>
    </div>

<?php get_footer(); ?>