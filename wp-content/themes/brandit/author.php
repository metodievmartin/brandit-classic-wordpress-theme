<?php get_header(); ?>

<?php
$author_id         = get_queried_object_id();
$author_name       = get_the_author_meta( 'display_name', $author_id );
$author_bio        = get_the_author_meta( 'description', $author_id );
$page_banner_args  = array(
	'page_title'    => sprintf( __( 'Blog posts by: %s', 'brandit' ), $author_name ),
	'page_subtitle' => $author_bio,
);
$blog_listing_args = array(
	'section_main_title' => __( 'Check out the latest posts from this author.', 'brandit' ),
);
?>

<main class="author-archive-page">

	<?php get_template_part( 'template-parts/banners/page-banner', null, $page_banner_args ); ?>

	<?php get_template_part( 'template-parts/blog/blog-listing-grid', null, $blog_listing_args ); ?>

</main>

<?php get_footer(); ?>
