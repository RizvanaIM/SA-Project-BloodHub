<?php
include('admin/authentication.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<style>
    /* Main */
    /* Import Montserrat Font */
    @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap");

    /* Global Styles */
    * {
        font-family: "Montserrat", sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-color: #ecebf3;
    }

    h2 {
        font-size: 35px;
        font-weight: 600;
        color: #0C120C;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 20px;
        text-align: center;
    }

    p {
        font-size: 16px;
        line-height: 1.5;
        margin-bottom: 20px;
        color: #0C120C;
    }

    .section-padding {
        padding: 25px 0;
    }

    /* Carousel Styles */
    .carousel-item {
        height: 75vh;
        min-height: 100px;
    }

    .carousel-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .carousel-inner::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: rgba(12, 18, 12, 0.7);
        z-index: 1;
    }

    .carousel-caption {
        bottom: 120px;
        z-index: 2;
    }

    .carousel-caption h5 {
        font-size: 40px;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-top: 25px;
        color: #ecebf3;
    }

    .carousel-caption p {
        width: 70%;
        margin: auto;
        font-size: 18px;
        line-height: 1.9;
        color: #ecebf3;
    }

    /* About Section */
    .about {
        background-color: #ecebf3;
        padding: 30px 0;
    }

    .about .section-header h2 {
        color: #0C120C;
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .about .section-header p {
        color: #0C120C;
        font-size: 18px;
        margin-bottom: 10px;
    }

    .about-img {
        display: flex;
        justify-content: center;
    }

    .about-img img {
        max-width: 100%;
        width: 100%;
        height: auto;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .about-img img:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .about-text {
        color: #0C120C;
        margin-bottom: 10px;
    }

    .about-text h3 {
        font-weight: bold;
        margin-top: 30px;
        color: #0C120C;
    }

    .about-text p {
        font-size: 18px;
        line-height: 1.6;
    }

    .about-text ul {
        margin-top: 15px;
        padding-left: 20px;
    }

    .about-text a {
        background-color: #C20114;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        font-size: 16px;
        cursor: pointer;
    }

    .about-text a:hover {
        background-color: #a0153e;
    }

    /* About Card Styles */
    .about_card {
        background-color: #fff;
        padding: 5px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 20px;
        height: 100%;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        text-align: center;
    }
    .about_card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .about_card h3 {
        color: #0C120C;
        font-weight: bold;
        margin-bottom: 10px;
        margin-top: 10px;
    }

    .about_card p {
        color: #0C120C;
        font-size: 16px;
        margin-bottom: 10px;
    }

    .about_card img {
        margin: 0 auto;
        display: block;
        width: 100px;
        height: 100px;
        object-fit: contain;
        border-radius: 10px 10px 0 0;
    }

    /* Contact Section */
    .contact {
        background-color: #ecebf3;
        padding: 30px 0;
        text-align: center;
    }

    .contact img {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .contact img:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .contact h2 {
        color: #0C120C;
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .contact p {
        color: #0C120C;
        font-size: 18px;
        margin-bottom: 40px;
    }

    .contact form {
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .contact form:hover {
        transform: translateY(-8px);
    }

    .contact .form-group {
        margin-bottom: 15px;
    }

    .contact input,
    .contact textarea {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        font-size: 16px;
        transition: border-color 0.3s;
        width: 100%;
    }

    .contact input:focus,
    .contact textarea:focus {
        border-color: #C20114;
        outline: none;
    }

    .contact button {
        background-color: #C20114;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        font-size: 16px;
        cursor: pointer;
    }

    .contact button:hover {
        background-color: #a0153e;
    }

    /* CTA Section */
    .cta-section {
        color: #ecebf3;
        padding: 30px 0;
        text-align: center;
    }

    .cta-section h2 {
        color: #0C120C;
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .cta-section p {
        color: #0C120C;
        font-size: 18px;
        margin-bottom: 40px;
        line-height: 1.6;
    }

    .cta-buttons {
        display: flex;
        justify-content: center;
        gap: 50px;
        flex-wrap: wrap;
    }

    .cta-buttons .cta-request,
    .cta-buttons .cta-donate {
        background-color: #fff;
        color: #0C120C;
        padding: 20px;
        border-radius: 10px;
        width: 300px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        text-align: center;
        overflow: hidden;
    }

    .cta-buttons .cta-request:hover,
    .cta-buttons .cta-donate:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .cta-buttons img {
        display: block;
        margin: 0 auto 15px;
        width: 80px;
        height: 80px;
        object-fit: contain;
    }

    .cta-buttons h3 {
        text-transform: uppercase;
        font-size: 22px;
        margin-bottom: 15px;
    }

    .cta-buttons p {
        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .cta-buttons .btn .a {
        display: block;
        margin: 0 auto;
        font-size: 14px;
        font-weight: 500;
        text-transform: uppercase;
        color: #fff;
        padding: 05px 10px;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .cta-buttons .btn-success {
        background-color: #28a745;
    }

    .cta-buttons .btn-danger {
        background-color: #C20114;
    }

    .cta-buttons .btn:hover {
        background-color: #0C120C;
    }

    /* Driver Section Styles */
    .driver-section {
        background-color: #ecebf3;
        padding: 30px 0;
        /* Increased padding for a more spacious look */
        text-align: center;
    }

    .driver-section h2 {
        color: #0C120C;
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .driver-section p {
        color: #0C120C;
        font-size: 18px;
        margin-bottom: 30px;
        /* Increased margin for better spacing */
    }

    .driver-image img {
        width: 100%;
        /* Make the image responsive */
        height: auto;
        /* Keep aspect ratio */
        max-height: 445px;
        /* Limit height */
        object-fit: cover;
        /* Ensure the image covers the container */
        border-radius: 10px;
        /* Match with the driver info */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        /* Optional: add shadow */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .driver-image img:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .driver-info {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 100px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .driver-info:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .driver-info h3 {
        font-weight: bold;
        margin-top: 20px;
        /* Reduced margin for tighter layout */
    }

    .driver-info ul {
        list-style: none;
        padding: 0;
        margin: 20px 0;
        font-size: 16px;
        line-height: 1.8;
        /* Increased line height for readability */
    }

    .driver-info li {
        margin-bottom: 15px;
        /* Increased spacing between items */
    }

    .driver-info .form-group {
        margin-bottom: 15px;

    }

    .driver-info input,
    .driver-info textarea {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        font-size: 16px;
        transition: border-color 0.3s;
        width: 100%;
    }

    .driver-info input:focus,
    .driver-info textarea:focus {
        border-color: #C20114;
        outline: none;
    }

    .driver-info a {
        background-color: #C20114;
        color: #fff;
        padding: 12px 20px;
        /* Increased padding for better a size */
        border: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        font-size: 16px;
        cursor: pointer;
    }

    .driver-info a:hover {
        background-color: #a0153e;
    }

    /* Driver Queries End*/

    /* Media Queries */
    @media only screen and (min-width: 768px) and (max-width: 991px) {
        .carousel-caption {
            bottom: 370px;
        }

        .carousel-caption p {
            width: 100%;
        }

        .img-area img {
            width: 100%;
        }
    }

    @media only screen and (max-width: 767px) {
        .navbar-nav {
            text-align: center;
        }
    }

    /* Media Queries End*/
</style>

<section class="carousel slide" data-bs-ride="carousel" id="carouselExampleIndicators">
    <div class="carousel-indicators">
        <button aria-label="Slide 1" class="active" data-bs-slide-to="0" data-bs-target="#carouselExampleIndicators"
            type="button"></button> <button aria-label="Slide 2" data-bs-slide-to="1"
            data-bs-target="#carouselExampleIndicators" type="button"></button> <button aria-label="Slide 3"
            data-bs-slide-to="2" data-bs-target="#carouselExampleIndicators" type="button"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img alt="..." class="d-block w-100" src="assets\images\Img1.jpg">
            <div class="carousel-caption">
                <h5>Join Our Blood Donation Drive</h5>
                <p>Your contribution helps save lives. Participate in our next blood donation drive and make a
                    difference in your community.</p>
                <p><a class="btn btn-warning mt-3" href="#">Learn More</a></p>
            </div>
        </div>
        <div class="carousel-item">
            <img alt="..." class="d-block w-100" src="assets\images\Img2.jpg">
            <div class="carousel-caption">
                <h5>Donate Blood, Save Lives</h5>
                <p>Every drop counts. Be a hero by donating blood. Your donation can save up to three lives.</p>
                <p><a class="btn btn-warning mt-3" href="#cta">Donate Now</a></p>
            </div>
        </div>
        <div class="carousel-item">
            <img alt="..." class="d-block w-100" src="assets\images\Img3.jpg">
            <div class="carousel-caption">
                <h5>Request Blood When Needed</h5>
                <p>In an emergency? Submit a request for blood and get support from our network. We’re here to help.</p>
                <p><a class="btn btn-warning mt-3" href="#cta">Request Blood</a></p>
            </div>
        </div>
    </div><button class="carousel-control-prev" data-bs-slide="prev" data-bs-target="#carouselExampleIndicators"
        type="button"><span aria-hidden="true" class="carousel-control-prev-icon"></span> <span
            class="visually-hidden">Previous</span></button> <button class="carousel-control-next" data-bs-slide="next"
        data-bs-target="#carouselExampleIndicators" type="button"><span aria-hidden="true"
            class="carousel-control-next-icon"></span> <span class="visually-hidden">Next</span></button>
</section>

<!-- About Section Starts -->
<section class="about section-padding" id="about">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header text-center pb-3">
                    <h2 class="text-uppercase">About Us</h2>
                    <p>Together, we can create a healthier community where everyone plays a part in saving lives.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-12 d-flex justify-content-center align-items-center">
                <div class="about-img">
                    <img alt="About BloodHub" class="img-fluid w-100" src="assets/images/about.jpg">
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-12 ps-lg-5">
                <div class="about-text">
                    <h3 class="font-weight-bold mb-3 text-uppercase">Providing Life-Saving Quality Services</h3>
                    <p>At BloodHub, we are committed to offering exceptional services that truly make an impact. Whether
                        you urgently need blood or wish to donate and save lives, our platform is designed to support
                        you in every possible way.
                        <span style="color:red; font-weight:500">Join us in our mission to ensure that no one is left
                            without the essential care they deserve.</span>
                    </p>
                    <p class="mt-3">Our dedication to excellence goes beyond just fulfilling blood requests.
                        <span style="color:red; font-weight:500">We prioritize safety, reliability, and
                            efficiency</span> in every aspect of our service. Together, we can create a healthier, more
                        supportive community where everyone plays a part in saving lives.
                    </p>
                    <h3 class="mt-5">Blood Groups</h3>
                    <p class="mt-1">Learn about the different blood groups and their importance:</p>
                    <ul>
                        <li>A positive or A negative</li>
                        <li>B positive or B negative</li>
                        <li>O positive or O negative</li>
                        <li>AB positive or AB negative</li>
                    </ul>
                    <a class="btn btn-warning mt-3" href="https://en.wikipedia.org/wiki/Blood_type">Learn More</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Section Ends -->

<!-- About Card section -->
<section class="about-card section-padding" id="about-card">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="about_card">
                    <h3 class="text-center">Our Vision</h3>
                    <img src="assets/images/binoculars.png" alt="Our Vision" class="justify-center" width="168"
                        height="168">
                    <p class="text-center mt-3">
                        At BloodHub, our vision is to revolutionize blood donation and distribution through cutting-edge
                        technology. We aim to create a world where timely <span style="color:red; font-weight:500">
                            access to blood resources </span> is guaranteed, enhancing community health and support.
                    </p>
                </div>
            </div>

            <div class="col">
                <div class="about_card">
                    <h3 class="text-center">Our Goal</h3>
                    <img src="assets/images/target.png" alt="Our Goal" class="img img-responsive" width="168"
                        height="168">
                    <p class="text-center mt-3">
                        Our goal is to transform blood bank management with a centralized platform that <span
                            style="color:red; font-weight:500"> improves operational efficiency </span> and ensures
                        blood availability. We seek to <span style="color:red; font-weight:500"> elevate patient care
                        </span> and optimize the blood supply chain.
                    </p>
                </div>
            </div>

            <div class="col">
                <div class="about_card">
                    <h3 class="text-center">Our Mission</h3>
                    <img src="assets/images/goal.png" alt="Our Mission" class="img img-responsive" width="168"
                        height="168">
                    <p class="text-center mt-3">
                        Our mission is to streamline blood donation and distribution with an innovative online platform.
                        We focus on <span style="color:red; font-weight:500"> increasing accessibility and efficiency
                        </span> in blood management, supporting and saving lives with precision and care.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End About Card section -->

<!-- Contact starts -->
<section class="contact section-padding mb-3" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header text-center">
                    <h2>Contact Us</h2>
                    <p>If you have any questions or need assistance, contact us today and let us know how we can assist
                        you!</p>
                </div>
            </div>
        </div>
        <div class="row m-0 align-items-stretch"> <!-- Added align-items-stretch -->
            <!-- Image Column -->
            <div class="col-md-6 p-1 text-center">
                <img src="assets/images/contact.jpg" class="img-fluid contact-image" alt="Contact Image">
            </div>
            <!-- Form Column -->
            <div class="col-md-6 p-1">
                <form action="#" class="bg-light p-4 contact-form">
                    <div class="form-group">
                        <input type="text" class="form-control" required placeholder="Your Full Name">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" required placeholder="Your Email Address">
                    </div>
                    <div class="form-group">
                        <textarea rows="3" required class="form-control" placeholder="Your Query Here"></textarea>
                    </div>
                    <button class="btn btn-warning btn-sm">Send</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Contact ends -->

<!-- Donate section -->
<section class="cta-section mb-3" id="cta">
    <div class="container">
        <h2>Make a Difference Today</h2>
        <p>Whether you need blood or want to donate, your participation can help save lives in our community. Get
            started now!</p>

        <div class="cta-buttons">
            <div class="cta-request">
                <img src="assets/images/request-icon.jpg" alt="Request Blood">
                <h3>Request Blood</h3>
                <p>Need blood urgently? Submit a request and get help from our community.</p>
                <a href="request-blood.php" class="btn btn-success align-items-center">Request Blood</a>
                <p class="mt-2"><em>Over 500 requests fulfilled last month.</em></p>
            </div>

            <div class="cta-donate">
                <img src="assets/images/donate-icon.jpg" alt="Donate Blood">
                <h3>Donate Blood</h3>
                <p>Become a hero by donating blood. Your single donation can save up to three lives.</p>
                <a href="donate-blood.php" class="btn btn-danger">Donate Blood</a>
                <p class="mt-2"><em>Join 10,000+ donors already making a difference.</em></p>
            </div>
        </div>
    </div>
</section>
<!-- Donate section end -->

<!-- Driver Section starts -->
<section class="driver-section section-padding" id="drivers">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header text-center">
                    <h2>Meet Our Drivers</h2>
                    <p>Our dedicated drivers ensure that blood is delivered safely and promptly to hospitals. They are trained professionals committed to making a difference in the lives of patients.</p>
                </div>
            </div>
        </div>
        <div class="row m-0 align-items-stretch"> <!-- Ensure d-flex is present -->
            <div class="col-md-6 p-1">
                <div class="driver-info bg-light p-4">
                    <h3>Why Choose Our Drivers?</h3>
                    <ul>
                        <li class="d-flex align-items-center mb-3">
                            <i class="fas fa-check-circle me-2" style="color: #28a745; font-size: 20px;"></i>
                            <span>Experienced and trained in safe transportation.</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="fas fa-box-open me-2" style="color: #007bff; font-size: 20px;"></i>
                            <span>Equipped with proper storage to maintain blood quality.</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="fas fa-clock me-2" style="color: #ffc107; font-size: 20px;"></i>
                            <span>Committed to timely deliveries, ensuring no delays in urgent situations.</span>
                        </li>
                    </ul>
                    <p>Join us in supporting our drivers as they play a crucial role in saving lives!</p>
                    <a href="driver_register.php" class="btn btn-danger btn-sm">Register</a>
                </div>
            </div>

            <div class="col-md-6 p-1 text-center">
                <div class="driver-image">
                    <img src="assets/images/driver.jpg" class="img-fluid contact-image" alt="Driver delivering blood">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Driver Section ends -->

<?php
include('includes/footer.php');
?>