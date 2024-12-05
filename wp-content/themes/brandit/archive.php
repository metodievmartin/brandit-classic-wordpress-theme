<?php get_header(); ?>

<?php
get_template_part(
	'template-parts/banners/page-banner',
	null,
	array( 'page_title' => wp_strip_all_tags( get_the_archive_title() ) )
);
?>

    <section class="blog-section page-section container-xxl">
        <div class="row justify-content-center g-5">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

                    <div class="post-item">
                        <h2 class="headline headline--medium headline--post-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                        </h2>

                        <div class="metabox">
                            <p class="m-0">Posted by <?php the_author_posts_link(); ?> on <?php the_time( 'd/M/Y' ); ?>
                                in <?php echo get_the_category_list( ', ' ) ?></p>
                        </div>

                        <div class="generic-content">
							<?php the_excerpt(); ?>
                            <p>
                                <a class="btn btn-tertiary border" href="<?php the_permalink(); ?>">Continue reading
                                    &raquo;</a>
                            </p>
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