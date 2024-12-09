<?php if ( isset( $events_query ) && $events_query->have_posts() ) : ?>

    <ul class="upcoming-events">

		<?php while ( $events_query->have_posts() ) : $events_query->the_post(); ?>
			<?php $event_date_meta = get_post_meta( get_the_ID(), 'event_date', true ); ?>
			<?php $event_date_obj = new DateTime( $event_date_meta ) ?>

            <li>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <span><?php echo $event_date_obj->format( 'F j, Y' ); ?></span>
            </li>

		<?php endwhile; ?>

    </ul>

<?php else : ?>
    <p><?php esc_html_e( 'No upcoming events found.', 'bcf_domain' ); ?></p>
<?php endif;
