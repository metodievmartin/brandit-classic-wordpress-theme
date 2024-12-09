<?php get_header(); ?>

    <main>

		<?php
		get_template_part(
			'template-parts/banners/page-banner',
			null,
			array( 'page_title' => get_the_title() )
		);
		?>

        <section class="services-section page-section container-xxl">
            <div class="row justify-content-center g-5">

				<?php while ( have_posts() ) : the_post(); ?>

                    <div class="container container--narrow page-section position-relative">

                        <div class="metabox metabox--position-up metabox--with-home-link">
                            <p>
                                <a class="metabox__blog-home-link" href="<?php echo esc_url( site_url( '/blog' ) ); ?>">
                                    <i class="fa fa-home me-1" aria-hidden="true"></i>Blog Home
                                </a>
                                <span class="metabox__main">
                                    Posted by <?php the_author_posts_link(); ?> on <?php the_time( 'd/M/Y' ); ?> in <?php echo get_the_category_list( ', ' ); ?>
                                </span>
                            </p>
                        </div>

						<?php if ( has_post_thumbnail() ) : ?>

                            <div class="mb-5">
								<?php the_post_thumbnail( 'medium_large', array( 'class' => 'img-thumbnail' ) ); ?>
                            </div>

						<?php endif; ?>

                        <div class="generic-content">
							<?php the_content(); ?>
                        </div>

                    </div>

				<?php endwhile; ?>

            </div>
        </section>

    </main>

<?php get_footer(); ?>