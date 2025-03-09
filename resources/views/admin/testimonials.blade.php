@extends('layout.new')

@section('contents')
    @include('flash.flash')

    <div class="container">
        <div class="bg-white row">
            <div class="col-md-12">
                <legend>Testimonials</legend>
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Client Name</label>
                                <input type="text" name="client_name" value="" placeholder="Enter client name"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Profession</label>
                                <input type="text" name="profession" value="" placeholder="Enter client profession"
                                    class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <legend>Content </legend>
                            <div class="form-group">
                                <textarea class="form-control" name="content" id="" cols="60" rows="5" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Image</label>
                                <input id="picture" type="file"
                                    onchange="this.files[0].size > 2097152 ? (alert('File size must be less than 2MB!'), this.value='') : preview();"
                                    name="image" class="form-control">
                            </div>
                        </div>

                        <div class="col">
                            <img src="{{ isset($testimonial->photo) ? asset('storage/testimonials/' . $testimonial->photo) : '' }}"
                                class="img-responsive" id="image" alt=""
                                style="max-height: 150px; max-width:50%">
                        </div>
                    </div>

                    <a class="btn btn-warning" href="{{ url()->previous() }}">Back</a>
                    <button class="btn btn-primary" type="submit">Save</button>
                    <hr>
                    <hr>
                </form>
            </div>

            <div class="row col-lg-12">
                @forelse ($testimonials as $testimonial)
                    <div class="card m-2" style="width: 18rem;">
                        <img class="card-img-top" src="{{ asset('storage/testimonials/' . $testimonial->image) ?? '' }}"
                            alt="">
                        <div class="card-body">
                            <p class="card-text"><b>Client Name:</b>
                                <small>{{ Str::limit($testimonial->client_name, 50) ?? '-' }}</small>
                            </p>
                            <p class="card-text"><b>Profession:</b>
                                <small>{{ Str::limit($testimonial->profession, 50) ?? '-' }}</small>
                            </p>
                            <p class="card-text"><b>Content:</b>
                                <small>{{ Str::limit($testimonial->content, 50) ?? '-' }}</small>
                            </p>
                            <div class="row">
                                <div class="d-flex">
                                    <a class="btn btn-primary mx-2 btn-sm"
                                        href="/admin/edit_testimonial?id={{ base64_encode($testimonial->id) ?? '' }}">
                                        <i class="fa fa-edit"></i> Edit</a>

                                    <a class="btn btn-danger mx-2 btn-sm"
                                        href="/admin/delete_testimonial?id={{ base64_encode($testimonial->id) ?? '' }}"
                                        onclick="return confirm('Are you sure you want to delete this testimonial?')">
                                        <i class="fa fa-trash"></i> Delete</a>
                                </div>
                            </div>
                        </div>

                    </div>
                @empty
                    <p>No result found</p>
                @endforelse

            </div>
        </div>

    </div>
    </div>
    </div>

    <script src="/assets2/js/lib/jquery.min.js"></script>
    <script>
        function changeImage() {
            $('#picture').show();
            console.log('path1', ($('#image').attr()));
        }

        function preview() {
            $('#image').attr("src", URL.createObjectURL(event.target.files[0]));
        }

        function setImage() {
            console.log('path', ($('#picture').val()));
            $('#image').attr("src", ($('#picture').val()));
        }
    </script>
@endsection
