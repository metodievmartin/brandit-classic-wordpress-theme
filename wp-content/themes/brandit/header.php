<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<header class="header">
    <!--    <nav class="navbar navbar-expand-lg bg-body-tertiary">-->
    <!--        <div class="container-xxl">-->
    <!--            <a href="--><?php ///*echo esc_url( site_url( '/' ) );*/ ?><!--" class="navbar-brand">-->
    <!--                <span class="fs-4">Brand It</span>-->
    <!--            </a>-->
    <!---->
    <!--            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"-->
    <!--                    aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">-->
    <!--                <span class="navbar-toggler-icon"></span>-->
    <!--            </button>-->
    <!---->
    <!--            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">-->
    <!--                <ul class="navbar-nav nav-underline mr-auto w-100 justify-content-end">-->
    <!--                    <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Home</a></li>-->
    <!--                    <li class="nav-item dropdown">-->
    <!--                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"-->
    <!--                           aria-expanded="false">-->
    <!--                            Services-->
    <!--                        </a>-->
    <!--                        <ul class="dropdown-menu">-->
    <!--                            <li><a class="dropdown-item" href="#">Service 1</a></li>-->
    <!--                            <li><a class="dropdown-item" href="#">Service 2</a></li>-->
    <!--                            <li>-->
    <!--                                <hr class="dropdown-divider">-->
    <!--                            </li>-->
    <!--                            <li><a class="dropdown-item" href="#">See All Services</a></li>-->
    <!--                        </ul>-->
    <!--                    </li>-->
    <!--                    <li class="nav-item"><a href="#" class="nav-link">About Us</a></li>-->
    <!--                    <li class="nav-item"><a href="#" class="nav-link">Contacts</a></li>-->
    <!--                </ul>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </nav>-->
    <div class="container-xxl">
        <nav class="navbar navbar-light navbar-expand-lg">
            <a href="index.html" class="navbar-brand">
                <!--                <h1 class="text-primary fw-bold mb-0">Cater<span class="text-dark">Serv</span></h1>-->
				<?php get_template_part( 'partials/logo' ); ?>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav nav-underline mx-auto">
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
                <button class="search-button btn-md-square me-4 d-none d-lg-inline-flex"
                        data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search"></i></button>
                <a href="" class="btn btn-outline-primary py-2 px-4 d-none d-xl-inline-block">Book Now</a>
            </div>
        </nav>
    </div>
</header>