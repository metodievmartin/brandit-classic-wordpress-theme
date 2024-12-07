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

                        <div class="blog-item h-100">
                            <div class="overflow-hidden rounded image-container">
                                <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="img-fluid w-100"
                                     alt="Blog post image">
                            </div>

							<?php
							$blog_args = array(
								'title'      => get_the_title(),
								'permalink'  => get_the_permalink(),
								'event_date' => get_the_date(),
							);

							get_template_part( 'template-parts/blog/blog-mini-item', null, $blog_args );

							?>

                            <div class="blog-item-content px-4">
								<?php echo get_excerpt_or_first_n_words( 15 ) ?>
                            </div>
                        </div>

                    </div>

				<?php endwhile; ?>

			<?php else : ?>
                <p><?php esc_html__( 'Sorry, there are no posts yet' ); ?></p>
			<?php endif; ?>

        </div>

        <div class="pagination-container text-center pt-3 my-4">
			<?php echo paginate_links() ?>
        </div>

    </section>

<?php get_footer(); ?>