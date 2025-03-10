@extends('layout.home')
@section('contents')
    <!-- Header Start -->
    <div class="container-fluid header bg-white p-0">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadeIn mb-4">About Us</h1>
                <nav aria-label="breadcrumb animated fadeIn">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-body active" aria-current="page">About</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 animated fadeIn">
                <img class="img-fluid" src="./real-estate-html-template/img/property-list1.jpeg" alt="">
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="about-img position-relative overflow-hidden p-5 pe-0">
                        <img class="img-fluid w-100" src="./real-estate-html-template/img/about-bg1.jpg">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="mb-4">#1 Place To Find The Perfect Property</h1>
                    <p class="mb-4">Cavier Properties Investment Limited is a property services company based in Lagos,
                        Nigeria with a mandate to provide quality
                        services with a severe code of business conduct and complete transparency for her clients. <br>The
                        organisation takes care of each step of the process, including cleaning and maintenance of the
                        homes as well as supporting guests during the course of their stay.</p>
                    <p>Cavier Properties Investment Limited is a property services company based in Lagos, Nigeria with a
                        mandate to provide quality services with a severe code of business conduct and complete transparency
                        for her clients <br> Cavier Properties Investment Limited also partners with other real estate
                        companies (small, medium or large scale in Nigeria), who desire to increase their revenue.</p>
                    <p><i class="fa fa-check text-primary me-3"></i>Property Damage Protection</p>
                    <p><i class="fa fa-check text-primary me-3"></i> Optimized Well Targeted Listings</p>
                    <p><i class="fa fa-check text-primary me-3"></i>Cutting Edge Tools And Technologies</p>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Call to Action Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="bg-light rounded p-3">
                <div class="bg-white rounded p-4" style="border: 1px dashed rgba(0, 185, 142, .3)">
                    <div class="row g-5 align-items-center">
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                            <img class="img-fluid rounded w-100" src="./real-estate-html-template/img/call-to-action.jpg"
                                alt="">
                        </div>
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                            <div class="mb-4">
                                <h1 class="mb-3">Lets talk over coffee?</h1>
                                <p>Our exclusive marketing strategies will position your home to reach virtually every buyer
                                    through robust syndication</p>
                            </div>
                            <a href="tel:+2348177245589" class="btn btn-primary py-3 px-4 me-2">
                                <i class="fa fa-phone-alt me-2"></i>Make A Call
                            </a>
                            <a href="/contact" class="btn btn-dark py-3 px-4"><i class="fa fa-calendar-alt me-2"></i>Get
                                Appoinment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Call to Action End -->

    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">Meet Our Team</h1>
                <p>Working with our in-house marketing and advertising agency, your agent will target the right audience
                    across the most effective channels.</p>
            </div>
            <div class="row g-4">
                @forelse ($propertyAgents as $propertyAgent)
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item rounded overflow-hidden d-flex flex-column" style="height: 100%;">
                            <div class="position-relative">
                                <img class="img-fluid"
                                    src="{{ 'storage/propertyagents' . '/' . $propertyAgent->image ?? '' }}" alt=""
                                    style="width: 100%; height: 300px; object-fit: cover;">
                                <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                    <a class="btn btn-square mx-1" title="{{ $propertyAgent->facebook_link }}"
                                        href="tel:{{ $propertyAgent->facebook_link }}"><i class="fab fa-whatsapp"></i></a>
                                    <a class="btn btn-square mx-1" title="{{ $propertyAgent->twitter_link }}"
                                        href="mailto:{{ $propertyAgent->twitter_link }}"><i class="fa fa-envelope"></i></a>
                                    <a class="btn btn-square mx-1" title="{{ $propertyAgent->instagram_link }}"
                                        href="tel:{{ $propertyAgent->instagram_link }}"><i class="fa fa-phone"></i></a>
                                </div>
                            </div>
                            <div class="text-center p-4 mt-auto">
                                <h5 class="fw-bold mb-0">{{ $propertyAgent->name }}</h5>
                                <small>{{ $propertyAgent->position }}</small>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No Property Agent</p>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Team End -->
@endsection
