<?php get_header(); ?>

<?php get_template_part( 'template-parts/banners/page-banner' ); ?>

<?php get_template_part( 'template-parts/about-us/about-us-section-1' ); ?>

<section class="services-section page-section container-xxl">
    <div class="row justify-content-center g-5">

		<?php while ( have_posts() ) : the_post(); ?>

            <div class="generic-content">
				<?php the_content(); ?>
            </div>

		<?php endwhile; ?>

    </div>
</section>

<?php get_footer(); ?>
