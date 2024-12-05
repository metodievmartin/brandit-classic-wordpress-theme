<?php
$title        = $args['title'] ?? 'Blog Title';
$permalink    = $args['permalink'] ?? '#';
$num_of_words = $args['num_of_words'] ?? 20;
$event_date   = isset( $args['event_date'] )
	? new DateTime( $args['event_date'] )
	: new DateTime();
?>


<div class="blog-content blog-content-mini mx-4 mb-4 d-flex">

    <div class="text-dark bg-secondary">
        <div class="h-100 py-2 px-4 d-flex flex-column justify-content-center text-center">
            <span class="date-summary-month smaller"><?php echo $event_date->format( 'M' ) ?></span>
            <span class="date-summary-day smaller"><?php echo $event_date->format( 'd' ) ?></span>
        </div>
    </div>

    <div class="p-3 flex-grow-1 d-flex align-items-center bg-body">
        <a href="<?php echo esc_url( $permalink ); ?>" class="h5">
			<?php echo esc_html( $title ); ?>
        </a>
    </div>

</div>