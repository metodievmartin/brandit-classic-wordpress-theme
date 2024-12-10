<?php
$page_id                = $args['page_id'] ?? get_the_ID();
$banner_fields          = get_fields( $page_id );
$banner_main_title      = $banner_fields['hero_banner_main_title'];
$banner_secondary_title = $banner_fields['hero_banner_secondary_title'];
$banner_image           = $banner_fields['hero_banner_image'];
//var_dump( $banner_image );
?>

<section class="hero-banner page-section py-6 my-6 mt-0">
    <div class="container-xxl ">
        <div class="row g-5 align-items-center">
            <div class="title-container col-lg-7 col-md-12">

				<?php if ( ! empty( $banner_secondary_title ) ): ?>
                    <h5 class=" m-0 py-3">
						<?php echo esc_html( $banner_secondary_title ); ?>
                    </h5>
				<?php endif; ?>


				<?php if ( ! empty( $banner_main_title ) ): ?>
                    <h1 class="display-1 mb-4">
						<?php echo replace_title_placeholder( $banner_main_title ); ?>
                    </h1>
				<?php endif; ?>


                <a href="" class="btn btn-primary border-2 text-light py-3 px-4 px-md-5 me-4">Book
                    Now</a>
                <a href="" class="btn btn-outline-primary py-3 px-4 px-md-5">Know
                    More</a>
            </div>

			<?php if ( ! empty( $banner_image ) && isset( $banner_image['sizes'] ) ): ?>

                <div class="image-container col-lg-5 col-md-12">
                    <img src="<?php echo $banner_image['sizes']['hero-banner-portrait'] ?>"
                         class="img-fluid img-thumbnail" alt="">
                </div>

			<?php endif; ?>

        </div>
    </div>
</section>