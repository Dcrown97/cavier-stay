@extends('layout.home')
@section('contents')
    <!-- Header Start -->
    <div class="container-fluid header bg-white p-0">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadeIn mb-4">
                    {{ $property->sale_type === 'Sell' ? 'Buy Property' : 'Book Rent' }}</h1>
                <nav aria-label="breadcrumb animated fadeIn">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-body active" aria-current="page">
                            {{ $property->sale_type === 'Sell' ? 'BuyProperty' : 'Book Rent' }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 animated fadeIn">
                <img class="img-fluid" src="./real-estate-html-template/img/header.jpg" alt="">
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">{{ $property->sale_type === 'Sell' ? 'BuyProperty' : 'Book Rent' }} now!</h1>
                <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod
                    sit. Ipsum diam justo sed rebum vero dolor duo.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-12">
                    <div class="wow fadeInUp" data-wow-delay="0.5s">
                        @include('flash.flash')
                        <form action="" method="POST" class="">
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <input type="text" name="property_id" id="property_id" value="{{ $property->id }}" hidden>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="full_name" id="full_name"
                                            placeholder="Your Name" required>
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Your Email" required>
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="phone" name="phone"
                                            placeholder="+234" required>
                                        <label for="phone">Phone Number</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="address" name="address"
                                            placeholder="Enter address" required>
                                        <label for="phone">Address</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="amount" name="amount"
                                            placeholder="" value="{{ $property->price }}" disabled required>
                                        <label for="phone">(₦) Amount</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="charge" name="charge"
                                            placeholder="" value="100" disabled>
                                        <label for="phone">(₦) Charge</label>
                                    </div>
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
                                {{-- <div class="col-6">
                                </div> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://js.paystack.co/v1/inline.js"></script>

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function payWithPaystackNaira(id, amount) {
        var charge = $('#charge').val();
        var total = (parseFloat(amount) + parseFloat(charge)) * 100; // Convert to kobo (Paystack processes in kobo)

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
                        amount: $('#amount').val(),
                        charge: charge,
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
