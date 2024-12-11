<?php get_header(); ?>

<?php
// TODO: some validation and maybe default values
$contact_email_address = bci_get_contact_email();
$contact_address       = bci_get_contact_address();
$contact_phone_number  = bci_get_contact_phone_number();
?>

<?php get_template_part( 'template-parts/banners/page-banner' ); ?>

    <section class="contacts-section container-xxl py-5 my-5">
        <div class="row justify-content-center">

            <div class="col-12 mb-5">
                <div class="row row-cols-1 row-cols-lg-3 g-3">
                    <div class="col">
                        <div class="h-100 d-flex border border-primary p-4">
                            <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                            <div>
                                <h4><?php esc_html_e( 'Address', 'brandit' ); ?></h4>
                                <p><?php echo esc_html( $contact_address ); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="h-100 d-flex border border-primary p-4">
                            <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                            <div>
                                <h4><?php esc_html_e( 'Mail Us', 'brandit' ); ?></h4>
                                <p class="mb-2"><?php echo esc_html( $contact_email_address ); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="h-100 d-flex border border-primary p-4">
                            <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                            <div>
                                <h4><?php esc_html_e( 'Telephone', 'brandit' ); ?></h4>
                                <p class="mb-2"><?php echo esc_html( $contact_phone_number ); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-12 text-center mb-5">
                <h5 class="skewed-title fw-bold text-dark text-uppercase mb-3">
					<?php esc_html_e( 'Get in touch', 'brandit' ); ?>
                </h5>
                <h1 class="display-5 mb-0">
					<?php esc_html_e( 'Contact Us For Any Queries!', 'brandit' ); ?>
                </h1>
            </div>

            <div class="contact-form-container col-md-9 col-lg-7">
                <form id="contact-form" class="contact-form needs-validation" novalidate>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="sender_name" name="sender_name"
                                       placeholder="<?php esc_attr_e( 'Your Name', 'brandit' ); ?>"
                                       required>
                                <label for="sender_name">
									<?php esc_html_e( 'Your Name', 'brandit' ); ?>
                                </label>
                                <div class="invalid-feedback">
									<?php esc_html_e( 'Name is a required field', 'brandit' ); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="sender_email" name="sender_email"
                                       placeholder="<?php esc_attr_e( 'Your Email', 'brandit' ); ?>"
                                       required>
                                <label for="sender_email">
									<?php esc_html_e( 'Your Email', 'brandit' ); ?>
                                </label>
                                <div class="invalid-feedback">
									<?php esc_html_e( 'This field should be a valid email', 'brandit' ); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="subject"
                                       placeholder="<?php esc_attr_e( 'Subject', 'brandit' ); ?>"
                                       data-np-intersection-state="visible">
                                <label for="subject">
									<?php esc_html_e( 'Subject', 'brandit' ); ?>
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                        <textarea class="form-control"
                                                  id="message"
                                                  placeholder="<?php esc_attr_e( 'Leave your message here', 'brandit' ); ?>"
                                                  style="height: 100px"
                                                  required></textarea>
                                <label for="message">
									<?php esc_html_e( 'Message', 'brandit' ); ?>
                                </label>
                                <div class="invalid-feedback">
									<?php esc_html_e( 'Message is a required field', 'brandit' ); ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <button id="form-submit-button"
                                    class="submit-button btn btn-outline-secondary text-dark w-100 py-3" type="submit">
                                <span class="loading-spinner spinner-border spinner-border-sm"
                                      aria-hidden="true"></span>
                                <span class="submit-text" role="status">
                                    <?php esc_html_e( 'Send Message', 'brandit' ); ?>
                                </span>
                            </button>

                        </div>
                    </div>
                </form>

                <div class="form-submission-alert alert d-none alert-dismissible my-4" role="alert">
                    <div class="alert-message type-success">
						<?php esc_html_e( 'Your message has been sent successfully!', 'brandit' ); ?>
                    </div>
                    <div class="alert-message type-error">
						<?php esc_html_e( 'Sorry, there has been an error. Try again later.', 'brandit' ); ?>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            </div>
        </div>
    </section>

<?php get_footer(); ?>