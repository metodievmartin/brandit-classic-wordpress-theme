<?php
$button_title   = $args['button_title'] ?? 'Title';
$button_url     = $args['button_link'] ?? '#';
$button_classes = $args['button_classes'] ?? '';
// TODO: other options to add flexibility
?>

<div class="text-center">
    <a href="<?php echo esc_url( $button_url ); ?>"
       class="btn <?php echo esc_attr( $button_classes ); ?>">
		<?php echo esc_html( $button_title ); ?>
    </a>
</div>