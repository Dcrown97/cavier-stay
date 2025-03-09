@extends('layout.home')
@section('contents')
    <!-- Header Start -->
    <div class="container-fluid header bg-white p-0">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadeIn mb-4">Testimonial</h1>
                <nav aria-label="breadcrumb animated fadeIn">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-body active" aria-current="page">Testimonial</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 animated fadeIn">
                <img class="img-fluid" src="./real-estate-html-template/img/property-list1.jpeg" alt="">
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Search Start -->
    {{-- <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
        <div class="container">
            <div class="row g-2">
                <div class="col-md-10">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <input type="text" class="form-control border-0 py-3" placeholder="Search Keyword">
                        </div>
                        <div class="col-md-4">
                            <select class="form-select border-0 py-3">
                                <option selected>Property Type</option>
                                <option value="1">Property Type 1</option>
                                <option value="2">Property Type 2</option>
                                <option value="3">Property Type 3</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-select border-0 py-3">
                                <option selected>Location</option>
                                <option value="1">Location 1</option>
                                <option value="2">Location 2</option>
                                <option value="3">Location 3</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-dark border-0 w-100 py-3">Search</button>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Search End -->

    <!-- Testimonial Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">Our Clients Say!</h1>
                <p>Our clients have found their dream homes and properties with us. Hear from them about their experience
                    with our dedicated team and exceptional service.</p>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" id="testimonial-carousel" data-wow-delay="0.1s">
                @forelse ($testimonials as $testimonial)
                    <div class="testimonial-item bg-light rounded p-3">
                        <div class="bg-white border rounded p-4">
                            <p>{{ $testimonial->content }}</p>
                            <div class="d-flex align-items-center">
                                {{-- <img class="img-fluid flex-shrink-0 rounded"
                                    src="{{ asset('storage/testimonials' . '/' . $testimonial->image) ?? '' }}"
                                    style="width: 45px; height: 45px;"> --}}
                                <div class="ps-3">
                                    <h6 class="fw-bold mb-1">{{ $testimonial->client_name }}</h6>
                                    {{-- <small>{{ $testimonial->profession }}</small> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No Client Testimonials</p>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
@endsection
