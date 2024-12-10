<?php
$button_title = $args['button_title'] ?? 'Title';
$button_url   = $args['button_link'] ?? '#';
// TODO: accept classes and other options to add flexibility
?>

<div class="text-center">
    <a href="<?php echo esc_url( $button_url ); ?>"
       class="btn btn-outline-primary text-dark">
		<?php echo esc_html( $button_title ); ?>
    </a>
</div>