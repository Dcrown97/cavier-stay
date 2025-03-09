@extends('layout.admin')
@section('contents')
    <div class="row col-md-12">
        <legend>Photo</legend>

        @include('flash.flash')
        <div class="row col-lg-12">
            
            <div class="col-lg-6">
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Description</label>
                        <input type="text" name="desc" value="{{ $slider->desc ?? '' }}" placeholder="Enter Top title"
                            class="form-control" required>
                    </div>
                 
                    <div class="form-group">
                        <label for="">Image</label>
                        <input id="picture" type="file" onchange="preview()" name="photo" required
                            class="form-control">
                    </div>
                    <a class="btn btn-warning" href="/admin/galleries">Back</a>
                    <button class="btn btn-primary" type="submit">Save</button>
                </form>
            </div>

            <div class="col-lg-6">
                <img src="{{ isset($slider)? asset('storage'.'/'.$slider->photo): '' }}" class="img-responsive" id="image" alt="" width="100%">
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
