<?php get_header(); ?>

<?php
$current_term_slug     = 'all-services';
$service_item_position = 1;
$page_banner_args      = array(
	'page_title' => __( 'All Services', 'brandit' )
);
?>

    <main class="all-services-page">

		<?php get_template_part( 'template-parts/banners/page-banner', null, $page_banner_args ); ?>

        <section class="service-category-filters page-section container-xxl">
			<?php display_service_category_buttons( $current_term_slug ); ?>
        </section>

        <section class="services-section page-section container-xxl">
            <div class="row justify-content-center align-items-center g-4">

				<?php while ( have_posts() ) : the_post();

					// Reverse every second service item
					$service_item_classes = ( $service_item_position % 2 === 0 ) ? 'flex-row-reverse' : '';

					$card_args = array(
						'title'                => get_the_title(),
						'short_summary'        => get_the_excerpt(),
						'bg_image_url'         => get_the_post_thumbnail_url(),
						'service_url'          => get_the_permalink(),
						'service_item_classes' => $service_item_classes,
					);

					// Call the template part for each service
					get_template_part( 'template-parts/services/service-item', null, $card_args );

					// Increment position counter
					$service_item_position ++;
				endwhile; ?>

            </div>
        </section>

    </main>

<?php get_footer(); ?>