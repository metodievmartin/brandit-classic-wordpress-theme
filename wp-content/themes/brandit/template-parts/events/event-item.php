<?php
$title         = $args['title'] ?? 'Event Title';
$short_summary = $args['short_summary'] ?? 'Event Short Summary ';
$permalink     = $args['permalink'] ?? '#';
$num_of_words  = $args['num_of_words'] ?? 20;
$cta_text      = $args['$cta_text'] ?? 'Read More';
$event_date    = isset( $args['event_date'] )
	? new DateTime( $args['event_date'] )
	: new DateTime();
?>

<div class="event-summary">
    <a class="event-summary__date text-center" href="<?php echo esc_url( $permalink ); ?>">
        <span class="date-summary-month"><?php echo $event_date->format( 'M' ) ?></span>
        <span class="date-summary-day"><?php echo $event_date->format( 'd' ) ?></span>
    </a>
    <div class="event-summary__content">
        <h5 class="event-summary__title headline headline--tiny">
            <a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a>
        </h5>
        <p>
			<?php echo esc_html( wp_trim_words( $short_summary, $num_of_words ) ); ?>
            <a href="<?php echo esc_url( $permalink ); ?>"
               class="text-body-tertiary"><?php echo esc_html( $cta_text ); ?></a>
        </p>
    </div>
</div>