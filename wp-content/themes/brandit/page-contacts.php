<?php get_header(); ?>

<?php
// TODO: some validation and maybe default values
$contact_email_address = bci_get_contact_email();
$contact_address       = bci_get_contact_address();
$contact_phone_number  = bci_get_contact_phone_number();
?>

<?php get_template_part( 'partials/page-banner' ); ?>

    <section class="contacts-section container-xxl py-5 my-5">
        <div class="row justify-content-center">

            <div class="col-12 mb-5">
                <div class="row row-cols-1 row-cols-lg-3 g-3">
                    <div class="col">
                        <div class="h-100 d-flex border border-primary p-4">
                            <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Address</h4>
                                <p><?php echo $contact_address; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="h-100 d-flex border border-primary p-4">
                            <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Mail Us</h4>
                                <p class="mb-2"><?php echo $contact_email_address; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="h-100 d-flex border border-primary p-4">
                            <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Telephone</h4>
                                <p class="mb-2"><?php echo $contact_phone_number; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-12 text-center mb-5">
                <small class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Get
                    in touch</small>
                <h1 class="display-5 mb-0">Contact Us For Any Queries!</h1>
            </div>

            <div class="contact-form-container col-md-6 col-lg-7">
                <form class="contact-form" data-np-autofill-form-type="identity" data-np-checked="1"
                      data-np-watching="1">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name" placeholder="Your Name"
                                       data-np-uid="6d5c9069-b4ae-411d-9aaa-4e6c24b7fa61"
                                       data-np-autofill-field-type="fullName">
                                <label for="name">Your Name</label>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" placeholder="Your Email"
                                       data-np-uid="8220425d-5b07-4806-bc75-71b08c43f202"
                                       data-np-autofill-field-type="email">
                                <label for="email">Your Email</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="subject" placeholder="Subject"
                                       data-np-intersection-state="visible">
                                <label for="subject">Subject</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a message here" id="message"
                                                  style="height: 100px" data-np-intersection-state="visible"></textarea>
                                <label for="message">Message</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-secondary w-100 py-3" type="submit">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

<?php get_footer(); ?>