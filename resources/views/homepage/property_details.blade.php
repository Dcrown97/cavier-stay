@extends('layout.home')
<!-- Include Fancybox CSS and JS via CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

<style>
    /* Ensure all images have the same height and width */
    .img-container {
        width: 100%;
        height: 250px;
        /* Set a fixed height that suits your design */
        position: relative;
        overflow: hidden;
        /* Ensure no content overflows out of the container */
    }

    .uniform-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Ensures the image covers the container while maintaining aspect ratio */
    }

    /* Add hover effect for images */
    .zoom-hover {
        transition: transform 0.3s ease;
    }

    .zoom-hover:hover {
        transform: scale(1.05);
    }

    /* Overlay text for the 4th image */
    .see-all-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 1.2rem;
        background: rgba(0, 0, 0, 0.5);
        padding: 5px 10px;
        border-radius: 5px;
    }

    .col-6 {
        position: relative;
    }
</style>
@section('contents')
    <!-- Header Start -->
    <div class="container-fluid header bg-white p-0 mt-2">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadeIn mb-4">Property Details</h1>
                <nav aria-label="breadcrumb animated fadeIn">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-body active" aria-current="page">{{ $property->name ?? null }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 animated fadeIn">
                <img class="img-fluid" src="./real-estate-html-template/img/property-list1.jpeg" alt="">
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Property Details Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <!-- Left Column: Text, Details, and Images -->
                <div class="col-lg-8">
                    <h2>{{ $property->name ?? null }}</h2>
                    <div class="d-flex align-items-center mb-3">
                        <span><i
                                class="fa fa-home me-2"></i>{{ $property->propertyType ? $property->propertyType->name : 'No Property Type' }}</span>
                        <span class="mx-3">|</span>
                        <span><i class="fa fa-bath me-2"></i>{{ $property->bath }} Bathrooms & Toilet</span>
                        <span class="mx-3">|</span>
                        <span><i class="fa fa-bed me-2"></i>{{ $property->bed }} Bedrooms</span>
                    </div>
                    <div class="badge bg-primary mb-3">{{ $property->saleType->name }}</div>
                    <p>{{ $property->address }}</p>

                    <div class="row g-2 gallery">
                        @php
                            $images = json_decode($property->image, true); // Assuming images are stored as JSON
                            $totalImages = count($images);
                            $displayImages = array_slice($images, 0, 4); // Display first 4 images
                        @endphp

                        @foreach ($displayImages as $index => $image)
                            <div class="col-6">
                                @if ($index == 3 && $totalImages > 4)
                                    <!-- Special case for the 4th image with the "See all photos" overlay -->
                                    <a href="{{ asset('storage/properties/' . $image) }}" data-fancybox="gallery"
                                        data-caption="Property Image {{ $index + 1 }}">
                                        <div class="img-container">
                                            <img src="{{ asset('storage/properties/' . $image) }}"
                                                alt="Property Image {{ $index + 1 }}"
                                                class="img-fluid zoom-hover rounded uniform-img">
                                            <div class="see-all-text">See all photos</div>
                                        </div>
                                    </a>
                                @else
                                    <!-- Regular images (1st to 3rd) -->
                                    <a href="{{ asset('storage/properties/' . $image) }}" data-fancybox="gallery"
                                        data-caption="Property Image {{ $index + 1 }}">
                                        <div class="img-container">
                                            <img src="{{ asset('storage/properties/' . $image) }}"
                                                alt="Property Image {{ $index + 1 }}"
                                                class="img-fluid zoom-hover rounded uniform-img">
                                        </div>
                                    </a>
                                @endif
                            </div>
                        @endforeach

                        <!-- Add all the remaining images to the Fancybox gallery, but don't display them on the page -->
                        @foreach (array_slice($images, 4) as $index => $image)
                            <a href="{{ asset('storage/properties/' . $image) }}" data-fancybox="gallery"
                                data-caption="Property Image {{ $index + 5 }}" style="display: none;">
                                <img src="{{ asset('storage/properties/' . $image) }}" alt="Property Image {{ $index + 5 }}"
                                    class="img-fluid rounded">
                            </a>
                        @endforeach
                    </div>

                    <p>{!! $property->description !!}</p>

                </div>

                <!-- Right Column: Booking Form -->
                <div class="col-lg-4">
                    @include('flash.flash')
                    <div class="mt-4 p-4 border rounded">
                        <h4 class="text-center">₦{{ $property->price }}</h4>
                        <form action="" method="POST" class="">
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <input type="text" name="property_id" id="property_id" value="{{ $property->id }}" hidden>
                            <div class="mb-3">
                                <label for="full_name" class="form-label">Full Name</label>
                                <input type="text" name="full_name" class="form-control" id="full_name"
                                    placeholder="Enter your full name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Enter your email adrress" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="number" name="phone" class="form-control" id="phone"
                                    placeholder="Enter phone number" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" id="address"
                                    placeholder="Enter your address">
                            </div>
                            <div class="mb-3">
                                <label for="checkIn" class="form-label">Check-in</label>
                                <input type="date" class="form-control" name="check_in" id="checkIn" required>
                            </div>
                            <div class="mb-3">
                                <label for="checkOut" class="form-label">Check-out</label>
                                <input type="date" class="form-control" name="check_out" id="checkOut" required>
                            </div>
                            <div class="mb-3">
                                <label for="guests" class="form-label">Guests</label>
                                <input type="number" name="guests" class="form-control" id="guests"
                                    placeholder="Enter number guests" required>
                            </div>
                            <div class="mb-3">
                                <input type="number" name="amount" class="form-control" id="amount"
                                    value="{{ $property->price }}" hidden required>
                                {{-- <input type="number" name="charge" class="form-control" id="charge" value="100"
                                    hidden required> --}}
                            </div>
                            <div class="row g-3">
                                <div class="col-6">
                                    <button class="btn btn-primary w-100 py-3" onclick="bookProperties()"
                                        type="button">Book now</button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-primary w-100 py-3"
                                        onclick="payWithPaystackNaira({{ $property->id }}, {{ $property->price }})"
                                        type="button">Pay now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Property Details End -->


    <!-- Property Details End -->

    <!-- Call to Action Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="bg-light rounded p-3">
                <div class="bg-white rounded p-4" style="border: 1px dashed rgba(0, 185, 142, .3)">
                    <div class="row g-5 align-items-center">
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                            <img class="img-fluid rounded w-100" src="../real-estate-html-template/img/call-to-action.jpg"
                                alt="">
                        </div>
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                            <div class="mb-4">
                                <h1 class="mb-3">Lets talk over coffee?</h1>
                                <p>Our exclusive marketing strategies will position your home to reach virtually every buyer
                                    through robust syndication</p>
                            </div>
                            <a href="tel:+2347084960775" class="btn btn-primary py-3 px-4 me-2">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://js.paystack.co/v1/inline.js"></script>

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Initialize Fancybox with zoom functionality
    $('[data-fancybox="gallery"]').fancybox({
        buttons: [
            'slideShow',
            'share',
            'zoom', // This enables the zoom feature
            'fullScreen',
            'close'
        ],
        loop: true, // Ensures looping through all images
        zoom: true // Enables zoom
    });

    function payWithPaystackNaira(id, amount) {
        // var charge = $('#charge').val();
        var total = (parseFloat(amount)) * 100; // Convert to kobo (Paystack processes in kobo)

        let handler = PaystackPop.setup({
            key: "{{ env('PAYSTACK_PUBLIC_KEY') }}", // Paystack public key
            email: document.getElementById("email").value,
            amount: total, // Total amount in kobo
            currency: 'NGN',
            ref: '' + Math.floor((Math.random() * 1000000000) + 1), // Generate a unique transaction reference
            onClose: function() {
                alert('Transaction was not completed, window closed.');
            },
            callback: function(response) {
                console.log(response);

                // Post data to your server after payment
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/save_payment",
                    data: {
                        response: response,
                        full_name: $('#full_name').val(),
                        email: $('#email').val(),
                        phone: $('#phone').val(),
                        address: $('#address').val(),
                        check_in: $('#checkIn').val(),
                        check_out: $('#checkOut').val(),
                        guests: $('#guests').val(),
                        amount: $('#amount').val(),
                        // charge: charge,
                        total: total / 100, // Back to Naira
                        property_id: $('#property_id').val()
                    },
                    cache: false,
                    success: function(data) {
                        window.location.reload();
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Payment Successful!',
                                text: 'Your payment has been verified.',
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Payment Failed!',
                                text: data.message,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Payment Error!',
                            text: 'An error occurred while processing your payment. Please try again.',
                        });
                    }
                });
            }
        });

        handler.openIframe();
    }


    function bookProperties() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Ensure CSRF token is included
            }
        });

        $.ajax({
            type: "POST",
            url: "/book_properties",
            data: {
                full_name: $('#full_name').val(),
                email: $('#email').val(),
                phone: $('#phone').val(),
                address: $('#address').val(),
                check_in: $('#checkIn').val(),
                check_out: $('#checkOut').val(),
                guests: $('#guests').val(),
                amount: $('#amount').val(),
                amount: $('#amount').val(),
                property_id: $('#property_id').val()
            },
            cache: false,
            success: function(data) {
                window.location.reload();
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
                Swal.fire({
                    icon: 'error',
                    title: 'Booking Failed!',
                    text: 'Please try again.',
                });
            }
        });
    }
</script>
