<?php get_header(); ?>

<?php
get_template_part(
	'template-parts/banners/page-banner',
	null,
	array(
		'page_title' => '404 Error',
	)
);
?>

    <section class="page-section container-xxl py-5 my-5">

        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <i class="bi bi-exclamation-triangle display-1 text-primary"></i>
                    <h1 class="display-1">404</h1>
                    <h1 class="mb-4">Page Not Found</h1>
                    <p class="mb-4">We’re sorry, the page you have looked for does not exist in our website! Maybe go to
                        our home page or try to use a search?</p>
                    <a class="btn btn-outline-primary py-3 px-5" href="<?php echo esc_html( site_url( '/' ) ) ?>">
                        Go Back To Home
                    </a>
                </div>
            </div>
        </div>

    </section>

<?php get_footer(); ?>