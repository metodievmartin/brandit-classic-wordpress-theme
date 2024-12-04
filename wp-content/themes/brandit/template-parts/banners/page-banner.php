<?php
$page_title = $args['page_title'] ?? get_the_title();
?>

<section class="main-page-banner container-fluid">
    <div class="container-xxl text-center">
        <h1 class="display-1 mb-4"><?php echo esc_html( $page_title ); ?></h1>
    </div>
</section>