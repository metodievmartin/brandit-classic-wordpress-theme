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
    <div class="container-xxl">
        <nav class="navbar navbar-light navbar-expand-lg">

            <a href="<?php echo esc_url( site_url( '/' ) ); ?>" class="navbar-brand">
				<?php get_template_part( 'template-parts/header/logo' ); ?>
            </a>

            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">

				<?php
				wp_nav_menu( array(
					'theme_location' => 'header-menu',
					'depth'          => 2,
					'walker'         => new WP_Bootstrap_Navwalker(),
					'menu_class'     => 'navbar-nav nav-underline mx-auto',
					'container'      => false
				) );
				?>

                <button id="main-search-button"
                        class="px-3 py-2 search-button align-items-center d-none d-lg-inline-flex">
                    <span class="search-shortcut macos">⌘ + K</span>
                    <span class="search-shortcut windows">Ctrl + K</span>
                    <i class="fas fa-search"></i>
                </button>

            </div>

        </nav>
    </div>
</header>