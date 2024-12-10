<?php get_header(); ?>

<?php
// Get the current term object
$current_term             = get_queried_object();
$current_term_slug        = $current_term->slug ?? '';
$current_term_description = $current_term->description ?? '';

// Page Banner
$page_title_prefix = __( 'Service Category: ', 'brandit' );
$page_banner_args  = array(
	'page_title'    => single_term_title( $page_title_prefix, false ),
	'page_subtitle' => $current_term_description
);

// Category Filter Section
$cat_filters_args = array(
	'current_term_slug' => $current_term_slug
);
?>

    <main class="service-category-page">

		<?php get_template_part( 'template-parts/banners/page-banner', null, $page_banner_args ); ?>

		<?php get_template_part( 'template-parts/services/service-category-filter-section', null, $cat_filters_args ); ?>

		<?php get_template_part( 'template-parts/services/service-items-listing-section' ); ?>

    </main>

<?php get_footer(); ?>