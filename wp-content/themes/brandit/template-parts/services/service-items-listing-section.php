<?php
$service_item_position = 1;
?>

<section class="services-section page-section container-xxl">
    <div class="row justify-content-center align-items-center g-4">

		<?php while ( have_posts() ) : the_post();

			$service_item_classes = $service_item_position % 2 ? 'odd' : 'even';

			$service_item_args = array(
				'title'                 => get_the_title(),
				'short_summary'         => get_the_excerpt(),
				'bg_image_url'          => get_the_post_thumbnail_url(),
				'service_url'           => get_the_permalink(),
				'service_item_classes'  => $service_item_classes,
				'service_item_position' => $service_item_position,
			);

			// Call the template part for each service
			get_template_part( 'template-parts/services/service-item', null, $service_item_args );

			$service_item_position ++;
		endwhile; ?>

    </div>
</section>