@extends('layout.admin')
@section('contents')
    <div class="row col-md-12">
        <legend>Gallery| <a class="btn btn-primary btn-sm" href="/admin/gallery"><i class="fa fa-pen"></i> Add new</a></legend>

        @include('flash.flash')
        <div class="row col-lg-12">
            @forelse ($sliders as $slider)
                <div class="card m-2" style="width: 18rem;">
                    <img class="card-img-top" src="{{ asset('storage'.'/'.$slider->photo) ?? '' }}" alt="">
                    <div class="card-body">
                        <p class="card-text">Description: <small>{{ $slider->desc ?? '-' }}</small></p>
                        <div class="row">
                            <a class="btn btn-warning btn-sm mx-2 text-white" href="/admin/dashboard">Home</a>
                            <a class="btn btn-primary mx-2 btn-sm"
                                href="/admin/gallery?id={{ base64_encode($slider->id) ?? '' }}">
                                <i class="fa fa-edit"></i> Edit</a>
                            <a class="btn btn-danger mx-2 btn-sm" onclick="return confirm('Are you sure?')"
                                href="/admin/delete_photo?id={{ base64_encode($slider->id) ?? '' }}">
                                <i class="fa fa-trash"></i> Delete</a>
                        </div>
                    </div>

                </div>
            @empty
                <p>No result found</p>
            @endforelse

        </div>

    </div>

    <script src="/assets2/js/lib/jquery.min.js"></script>
    <script>
        function changeImage() {
            $('#picture').show();
            console.log('path1', ($('#image').attr()));
        }

        function preview() {
            // $('#image').src = URL.createObjectURL(event.target.files[0]);
            $('#image').attr("src", URL.createObjectURL(event.target.files[0]));
        }

        function setImage() {
            console.log('path', ($('#picture').val()));

            $('#image').attr("src", ($('#picture').val()));
        }

        // $('iframe').width(100).height(200);
    </script>
@endsection
