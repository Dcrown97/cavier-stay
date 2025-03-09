@extends('layout.home')
@section('contents')
    <!-- Header Start -->
    <div class="container-fluid header bg-white p-0">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadeIn mb-4">Property Type</h1>
                <nav aria-label="breadcrumb animated fadeIn">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-body active" aria-current="page">Property Type</li>
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
            <form action="">
                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <input type="text" name="search_name" class="form-control border-0 py-3"
                                    placeholder="Search Keyword">
                            </div>
                            <div class="col-md-4">
                                <select class="form-select border-0 py-3" name="property_type_id">
                                    <option value="">Select Property Type</option>
                                    @forelse ($propertyTypes as $propertyType)
                                        <option value="{{ $propertyType->id }}">{{ $propertyType->name }}</option>
                                    @empty
                                        <option value="others">No Property Type</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-select border-0 py-3" name="location_id">
                                    <option value="">Select Location</option>
                                    @forelse ($locations as $location)
                                        <option value="{{ $location->id ?? 'None' }}">{{ $location->name ?? 'None' }}
                                        </option>
                                    @empty
                                        <option value="others">No Location</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-dark border-0 w-100 py-3">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div> --}}
    <!-- Search End -->

    <!-- Category Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">Property Types</h1>
                <p>Our cohesive brand identity will elevate the style and story of your home.</p>
            </div>
            <div class="row g-4">
                @forelse ($propertyTypes as $propertyType)
                    @php
                        $count = App\Models\Property::where('property_type_id', $propertyType->id)->count();
                    @endphp
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                            <div class="rounded p-4">
                                <div class="icon mb-3">
                                    <img class="img-fluid"
                                        src="{{ asset('storage/properttypes' . '/' . $propertyType->image) ?? '' }}" alt="Icon">
                                </div>
                                <h6>{{ $propertyType->name }}</h6>
                                <span>{{ $count }} Properties</span>
                            </div>
                        </a>
                    </div>
                @empty
                    <p>No Property Type</p>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Category End -->
@endsection
