<?php get_header(); ?>

<?php
$page_banner_args  = array(
	'page_title' => __( 'Welcome to our Blog', 'brandit' ),
);
$blog_listing_args = array(
	'section_top_title' => __( 'Blog', 'brandit' ),
);
?>

<main class="default-archive-page blog-listing-page">

	<?php get_template_part( 'template-parts/banners/page-banner', null, $page_banner_args ); ?>

	<?php get_template_part( 'template-parts/blog/blog-listing-grid', null, $blog_listing_args ); ?>

</main>

<?php get_footer(); ?>

