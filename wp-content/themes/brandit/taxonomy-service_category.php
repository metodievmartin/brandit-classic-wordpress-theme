<?php get_header(); ?>

<?php
// Get the current term object
$current_term      = get_queried_object();
$current_term_slug = $current_term ? $current_term->slug : '';
$page_title_prefix = __( 'Service Category: ', 'brandit' );
$page_banner_args  = array(
	'page_title' => single_term_title( $page_title_prefix, false )
);
?>

<?php get_template_part( 'template-parts/banners/page-banner', null, $page_banner_args ); ?>

    <section class="service-category-filters page-section container-xxl">
		<?php display_service_category_buttons( $current_term_slug ); ?>
    </section>

    <section class="services-section page-section container-xxl">
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
    </section>

<?php get_footer(); ?>