<?php
$current_term_slug = $args['current_term_slug'] ?? '';
?>

<section class="service-category-filters page-section container-xxl">
	<?php display_service_category_buttons( $current_term_slug ); ?>
</section>