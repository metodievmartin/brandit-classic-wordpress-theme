<?php get_header(); ?>

<?php
get_template_part(
	'template-parts/banners/page-banner',
	null,
	array( 'page_title' => get_the_archive_title() )
);
?>

    <section class="blog-section page-section container-xxl">
        <div class="container-fluid blog py-6">
            <div class="container">
                <div class="text-center">
                    <h5 class="skewed-title">Welcome to our Blog</h5>
                    <h1 class="display-5 mb-5">Keep up with our latest news.</h1>
                </div>
            </div>
        </div>

        <div class="row justify-content-center g-5">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>
                    <div class="col-md-6 col-lg-4">

                        <div class="blog-item">
                            <div class="overflow-hidden rounded">
                                <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="img-fluid w-100" alt="">
                            </div>

							<?php
							$blog_args = array(
								'title'         => get_the_title(),
								'short_summary' => get_the_excerpt(),
								'permalink'     => get_the_permalink(),
								'event_date'    => get_the_date(),
								'num_of_words'  => 5
							);

							// Call the template part for each service
							get_template_part( 'template-parts/blog/blog-mini-item', null, $blog_args );

							?>
                        </div>


                    </div>
				<?php endwhile; ?>


				<?php echo paginate_links() ?>

			<?php else : ?>
                <p><?php esc_html__( 'Sorry, there no posts yet' ); ?></p>
			<?php endif; ?>

        </div>
    </section>

<?php get_footer(); ?>