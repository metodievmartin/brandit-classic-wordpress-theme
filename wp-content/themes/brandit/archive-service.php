<?php get_header(); ?>

<?php
$current_term_slug = 'all-services';

// Page Banner
$page_banner_args = array(
	'page_title'    => __( 'All Services', 'brandit' ),
	'page_subtitle' => 'All services description'
);

// Category Filter Section
$cat_filters_args = array(
	'current_term_slug' => $current_term_slug
);
?>

    <main class="service-listing-page all-services-page">

		<?php get_template_part( 'template-parts/banners/page-banner', null, $page_banner_args ); ?>

		<?php get_template_part( 'template-parts/services/service-category-filter-section', null, $cat_filters_args ); ?>

		<?php get_template_part( 'template-parts/services/service-items-listing-section' ); ?>

    </main>

<?php get_footer(); ?>