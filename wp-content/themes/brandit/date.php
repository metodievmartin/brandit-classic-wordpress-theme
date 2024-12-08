<?php get_header(); ?>

<?php
$page_banner_args  = array(
	'page_title' => wp_strip_all_tags( get_the_archive_title() ),
);
$blog_listing_args = array(
	'section_main_title' => __( 'Check out everything that happened during this time.', 'brandit' ),
);
?>

<main class="date-archive-page">

	<?php get_template_part( 'template-parts/banners/page-banner', null, $page_banner_args ); ?>

	<?php get_template_part( 'template-parts/blog/blog-listing-grid', null, $blog_listing_args ); ?>

</main>

<?php get_footer(); ?>
