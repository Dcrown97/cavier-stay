@extends('layout.home')
@section('contents')
    <!-- Header Start -->
    <div class="container-fluid header bg-white p-0">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadeIn mb-4">Services</h1>
                <nav aria-label="breadcrumb animated fadeIn">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-body active" aria-current="page">Services</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 animated fadeIn">
                <img class="img-fluid" src="../real-estate-html-template/img/property-list1.jpeg" alt="">
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">Packages & Pricing</h1>
                <p>Offered services</p>
            </div>

            <div class="row g-4">
                <!-- Tier 1 -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="cat-item d-block bg-light text-center rounded p-3">
                        <h3>Tier 1</h3>
                        <p><strong>Marketing, Booking and Administration Service Only</strong></p>
                        <p>Fee: 10% commission + VAT on rental income</p>
                        <ul class="text-left">
                            <li>Professional Photography</li>
                            <li>Channel and online advertising management</li>
                            <li>Online channel & information system upload</li>
                            <li>Seasonal & peak price management</li>
                        </ul>
                    </div>
                </div>

                <!-- Tier 2 -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="cat-item d-block bg-light text-center rounded p-3">
                        <h3>Tier 2</h3>
                        <p><strong>Fully Managed Service</strong></p>
                        <p>Fee: 20% commission + VAT on rental income</p>
                        <ul class="text-left">
                            <li>Everything in Tier 1</li>
                            <li>24/7 guest management & communication</li>
                            <li>Housekeeping management & quality assurance</li>
                            <li>FF&E Maintenance & Replacement</li>
                            <li>Arrival experience optimization</li>
                            <li>Proprietary guest verification process</li>
                            <li>Robust rental contracts</li>
                            <li>Rigorous background checks</li>
                            <li>Fast & detailed financial reporting</li>
                            <li>Monthly income and cash flow statements</li>
                            <li>Portfolio-level data & benchmarking</li>
                        </ul>
                    </div>
                </div>

                <!-- Tier 3 -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="cat-item d-block bg-light text-center rounded p-3">
                        <h3>Tier 3</h3>
                        <p><strong>100% Hands-Off</strong></p>
                        <p>Fee: 25% commission + VAT on rental income + additional expenses</p>
                        <ul class="text-left">
                            <li>Professional Photography</li>
                            <li>Channel and online advertising management</li>
                            <li>Online channel & information system upload</li>
                            <li>Seasonal & peak price management</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->
@endsection
