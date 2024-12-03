<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'template-parts/banners/page-banner' ); ?>

    <section class="single-service-section container-xxl py-5 my-5">

		<?php if ( ! empty( get_the_post_thumbnail_url() ) ) : ?>

            <div class="text-center mb-5">
                <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="rounded img-thumbnail" alt="">
            </div>

		<?php endif; ?>

        <div class="generic-content">
			<?php the_content(); ?>
        </div>

    </section>

<?php endwhile; ?>

<?php get_footer(); ?>

