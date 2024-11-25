<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<header class="">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-xxl">
            <a href="<?php echo esc_url( site_url( '/' ) ); ?>" class="navbar-brand">
                <span class="fs-4">Brand It</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
                    aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav nav-underline mr-auto w-100 justify-content-end">
                    <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Services
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Service 1</a></li>
                            <li><a class="dropdown-item" href="#">Service 2</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">See All Services</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a href="#" class="nav-link">About Us</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Contacts</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>