<?php
/**
 * Template Name: Homepage
 */
?>

<?php get_header(); ?>

<?php get_template_part( 'template-parts/banners/hero-banner' ); ?>

<?php render_services_section(); ?>

<section class="blog-and-events-section page-section row justify-content-center">

	<?php get_template_part( 'template-parts/events/upcoming-events-split-section' ); ?>

	<?php get_template_part( 'template-parts/blog/recent-blogs-split-section' ); ?>

</section>

<?php get_footer(); ?>
