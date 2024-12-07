<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'template-parts/banners/page-banner' ); ?>

    <section class="page-section container-xxl py-5 my-5">

        <div class="generic-content">
			<?php the_content(); ?>
        </div>

    </section>

<?php endwhile; ?>

<?php get_footer(); ?>