<?php
$section_title  = $args['section_title'] ?? __( 'From Our Blog', 'brandit' );
$no_items_found = $args['no_items_found'] ?? __( 'No posts yet.', 'brandit' );
?>

<div class="recent-blogs p-4 col-12 col-lg-6 d-flex justify-content-start">
    <div class="split-section">
        <h2 class="mb-4 headline headline--small-plus text-center">
			<?php echo esc_html( $section_title ); ?>
        </h2>

		<?php

		$posts_query = new WP_Query( array(
			'post_type'      => 'post',
			'posts_per_page' => 2, // TODO: Add a setting to control the number of posts
		) );

		if ( $posts_query->have_posts() ) {

			while ( $posts_query->have_posts() ) {
				$posts_query->the_post();

				$blog_args = array(
					'title'         => get_the_title(),
					'short_summary' => get_the_excerpt(),
					'permalink'     => get_the_permalink(),
					'post_date'     => get_the_date(),
					'num_of_words'  => 10
				);

				get_template_part( 'template-parts/blog/blog-item', null, $blog_args );
			}

			$button_args = array(
				'button_title'   => __( 'View All Posts', 'brandit' ),
				'button_link'    => site_url( '/blog' ),
				'button_classes' => 'btn-outline-secondary text-dark'
			);

			get_template_part( 'template-parts/base/button-link', null, $button_args );

			wp_reset_postdata();
		} else {
			echo '<p class="text-center">' . esc_html( $no_items_found ) . '</p>';
		}
		?>

    </div>
</div>
