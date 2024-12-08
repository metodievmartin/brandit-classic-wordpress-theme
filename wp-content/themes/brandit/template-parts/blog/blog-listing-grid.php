<?php
$no_posts_message   = $args['no_posts_message'] ?? __( 'Sorry, there are no posts yet', 'brandit' );
$section_top_title  = $args['section_top_title'] ?? __( 'Welcome to our Blog', 'brandit' );
$section_main_title = $args['section_main_title'] ?? __( 'Keep up with our latest news.', 'brandit' );
?>

<section class="blog-listing-section page-section container-xxl">

	<?php
	get_template_part(
		'template-parts/base/generic-section-title',
		null,
		array(
			'section_top_title'  => $section_top_title,
			'section_main_title' => $section_main_title,
		)
	);
	?>

    <div class="blog-listing-grid row g-5">

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
            <p><?php echo esc_html( $no_posts_message ); ?></p>
		<?php endif; ?>

    </div>

    <div class="pagination-container text-center pt-3 my-4">
		<?php echo paginate_links() ?>
    </div>

</section>
