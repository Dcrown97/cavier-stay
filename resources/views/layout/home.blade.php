<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cavier - Stays</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="../real-estate-html-template/img/fav_img.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../real-estate-html-template/lib/animate/animate.min.css" rel="stylesheet">
    <link href="../real-estate-html-template/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../real-estate-html-template/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../real-estate-html-template/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar Start -->
        <div class="container-fluid nav-bar bg-transparent">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
                <a href="/" class="navbar-brand d-flex align-items-center text-center">
                    <div class="icon p-2 me-2">
                        <img class="img-fluid" src="../real-estate-html-template/img/cavierstays_transparent.png"
                            alt="Icon" style="width:100px; height:40px">
                    </div>
                    {{-- <h1 class="m-0 text-primary">Cavier Stays</h1> --}}
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="/"
                            class="nav-item nav-link {{ request()->route() && request()->route()->uri() == '/' ? 'active' : '' }}">Home</a>
                        <a href="/about"
                            class="nav-item nav-link {{ request()->route() && request()->route()->uri() == 'about' ? 'active' : '' }}">About</a>
                        <a href="/property_list"
                            class="nav-item nav-link {{ request()->route() && request()->route()->uri() == 'property_list' ? 'active' : '' }}">Property</a>
                        <a href="/services"
                            class="nav-item nav-link {{ request()->route() && request()->route()->uri() == 'services' ? 'active' : '' }}">Services</a>
                        <a href="/testimonial"
                            class="nav-item nav-link {{ request()->route() && request()->route()->uri() == 'testimonial' ? 'active' : '' }}">Testimonial</a>
                        <a href="/contact"
                            class="nav-item nav-link {{ request()->route() && request()->route()->uri() == 'contact' ? 'active' : '' }}">Contact</a>
                    </div>
                    {{-- <a href="#" class="btn btn-primary px-3 d-none d-lg-flex">Add Property</a> --}}
                </div>
            </nav>
        </div>
        <!-- Navbar End -->

        <div class="">
            @yield('contents')

        </div>

        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-4 col-md-6">
                        <h5 class="text-white mb-4">Get In Touch</h5>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>142 Ahmadu Bello Way, Victoria
                            Island, Lagos, Nigeria</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>
                            <span>Sales: +2348177245589 & 08056842804</span>
                            <span>Customer support: +2349168686728 & +234 911 242 6568</span>
                        </p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>contact@cavierproperties.com
                            guests@cavierproperties.com</p>
                        <div class="d-flex pt-2">
                            {{-- <a class="btn btn-outline-light btn-social" href="#"><i
                                    class="fab fa-twitter"></i></a> --}}
                            <a class="btn btn-outline-light btn-social" target="__blank"
                                href="https://facebook.com/profile.php?id=100083169226995"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social"
                                href="https://www.instagram.com/cavierproperties?igsh=ZnY4dW1nZDlyMWJ6"
                                target="__blank"><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-light btn-social" target="__blank"
                                href="https://www.linkedin.com/company/cavier-properties/?originalSubdomain=ng"><i
                                    class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <h5 class="text-white mb-4">Quick Links</h5>
                        <a class="btn btn-link text-white-50" href="/about">About Us</a>
                        <a class="btn btn-link text-white-50" href="/contact">Contact Us</a>
                        <a class="btn btn-link text-white-50" href="/testimonial">Testimonials</a>
                        <a class="btn btn-link text-white-50" href="#">Privacy Policy</a>
                        <a class="btn btn-link text-white-50" href="#">Terms & Condition</a>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <h5 class="text-white mb-4">Photo Gallery</h5>
                        <div class="row g-2 pt-2">
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1"
                                    src="../real-estate-html-template/img/IMG_5420.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1"
                                    src="../real-estate-html-template/img/about-bg.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1"
                                    src="../real-estate-html-template/img/IMG_3678.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1"
                                    src="../real-estate-html-template/img/IMG_5463.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1"
                                    src="../real-estate-html-template/img/about-bg3.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1"
                                    src="../real-estate-html-template/img/about-bg4.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">Cavier Stay Website</a>, All Right
                            Reserved.

                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a class="border-bottom" href="https://ftsl-ng.com/">Flyte Technologies And
                                Solutions LTD</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../real-estate-html-template/lib/wow/wow.min.js"></script>
    <script src="../real-estate-html-template/lib/easing/easing.min.js"></script>
    <script src="../real-estate-html-template/lib/waypoints/waypoints.min.js"></script>
    <script src="../real-estate-html-template/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../real-estate-html-template/js/main.js"></script>

    <script>
        // Play video on hover
        document.getElementById('hoverVideo').addEventListener('mouseenter', function() {
            this.play();
        });

        document.getElementById('hoverVideo').addEventListener('mouseleave', function() {
            this.pause();
            this.currentTime = 0; // Reset to the beginning when the mouse leaves
        });

        // Play video when scrolled into view
        let video = document.getElementById('hoverVideo');
        let observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    video.play();
                } else {
                    video.pause();
                    video.currentTime = 0; // Reset to the beginning when out of view
                }
            });
        }, {
            threshold: 0.5
        }); // Play when 50% of the video is visible

        observer.observe(video);
    </script>
</body>

</html>
