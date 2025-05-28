@extends('layout.home')
<style>
    .property-item {
        display: flex;
        flex-direction: column;
        height: 100%;
        /* Makes sure the card takes the full height */
    }

    .property-item img {
        height: 200px;
        /* You can adjust this to fit your needs */
        object-fit: cover;
        /* Ensures the image maintains aspect ratio and fills the height */
        width: 100%;
        /* Ensures full width */
    }

    .property-item .p-4.pb-0 {
        flex-grow: 1;
        /* This allows the content to grow and push the button section down */
    }

    .property-item .d-flex.border-top {
        margin-top: auto;
        /* Forces the button section to stick to the bottom */
    }

    .property-item .d-flex.border-top.p-4 {
        margin-bottom: 0;
        /* Ensures uniform bottom padding */
    }
</style>
@section('contents')
    <!-- Header Start -->
    <div class="container-fluid header bg-white p-0">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadeIn mb-4">Property List</h1>
                <nav aria-label="breadcrumb animated fadeIn">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-body active" aria-current="page">Property List</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 animated fadeIn">
                <img class="img-fluid" src="./real-estate-html-template/img/property-list1.jpeg" alt="">
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Property List Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-6">
                    <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                        <h1 class="mb-3">Property Listing</h1>
                        <p>Backed by data-driven strategy, Caviers listings spend 22 fewer days on market than the industry
                            average.</p>
                    </div>
                </div>
                {{-- <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                    <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-primary @if (!request('sale_type_id')) active @endif"
                                href="/property_list">All</a>
                        </li>
                        @if (isset($saleTypes))
                            @foreach ($saleTypes as $saleType)
                                <li class="nav-item me-2">
                                    <a class="btn btn-outline-primary @if (request('sale_type_id') == $saleType->id) active @endif"
                                        href="{{ route('properties.list', ['sale_type_id' => $saleType->id]) }}">{{ $saleType->name }}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div> --}}
            </div>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        @forelse ($properties as $property)
                            @php
                                // Decode the JSON-encoded images to get an array of filenames
                                $images = json_decode($property->image);
                                $firstImage = $images[0] ?? null; // Get the first image if available
                            @endphp
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href="/property_details/{{ $property->id }}"><img class="img-fluid"
                                                src="{{ $firstImage ? asset('storage/properties/' . $firstImage) : '' }}"
                                                alt=""></a>
                                        {{-- <div
                                            class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                            {{ $property->saleType->name }}</div>
                                        <div
                                            class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                                            {{ $property->propertyType ? $property->propertyType->name : 'No Property Type' }}
                                        </div> --}}
                                    </div>
                                    <div class="p-4 pb-0">
                                        @if (isset($property->price))
                                            <h5 class="text-primary mb-3">₦{{ number_format($property->price, 0) }}</h5>
                                        @endif
                                        <a class="d-block h5 mb-2"
                                            href="/property_details/{{ $property->id }}">{{ $property->name }}</a>
                                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $property->address }}
                                        </p>
                                    </div>
                                    <div class="d-flex border-top">
                                        @if (isset($property->square_footage))
                                            <small class="flex-fill text-center border-end py-2"><i
                                                    class="fa fa-ruler-combined text-primary me-2"></i>{{ $property->square_footage }}
                                                Sqft</small>
                                        @endif
                                        @if (isset($property->bed))
                                            <small class="flex-fill text-center border-end py-2"><i
                                                    class="fa fa-bed text-primary me-2"></i>{{ $property->bed }}</small>
                                        @endif
                                        @if (isset($property->bath))
                                            <small class="flex-fill text-center py-2"><i
                                                    class="fa fa-bath text-primary me-2"></i>{{ $property->bath }}</small>
                                        @endif
                                    </div>
                                    @if (isset($property->price))
                                        <div class="d-flex border-top p-4">
                                            <a href="/property_details/{{ $property->id }}"
                                                class="btn btn-sm btn-outline-primary flex-fill">
                                                <i class="fa fa-home"></i>
                                                {{ $property->sale_type === 'Sell' ? 'Buy' : 'Book now' }}
                                            </a>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        @empty
                            <p>No Property</p>
                        @endforelse
                        <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                            <a class="btn btn-primary py-3 px-5" href="/property_list">Browse More Property</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Property List End -->
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
                            <a href="tel:+2349168686728" class="btn btn-primary py-3 px-4 me-2">
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
@endsection
