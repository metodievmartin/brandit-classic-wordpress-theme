<?php
$title         = $args['title'] ?? 'Event Title';
$short_summary = $args['short_summary'] ?? 'Event Short Summary ';
$permalink     = $args['permalink'] ?? '#';
$num_of_words  = $args['num_of_words'] ?? 20;
$cta_text      = $args['$cta_text'] ?? 'Read More';
$post_date     = isset( $args['post_date'] )
	? new DateTime( $args['post_date'] )
	: new DateTime();
?>


<div class="blog-content mx-4 mb-4 d-flex">
    <div class="text-dark bg-secondary">
        <div class="h-100 py-3 px-4 d-flex flex-column justify-content-center text-center">
            <span class="date-summary-month"><?php echo $post_date->format( 'M' ) ?></span>
            <span class="date-summary-day"><?php echo $post_date->format( 'd' ) ?></span>
        </div>
    </div>
    <div class="p-3 border">
        <p class="mb-1">
            <a href="<?php echo esc_url( $permalink ); ?>" class="h5">
				<?php echo esc_html( $title ); ?>
            </a>
        </p>

		<?php echo esc_html( wp_trim_words( $short_summary, $num_of_words ) ); ?>

        <a href="<?php echo esc_url( $permalink ); ?>"
           class="pl-1 text-body-tertiary"><?php echo esc_html( $cta_text ); ?></a>

    </div>
</div>