@extends('layout.new')

@section('contents')
    @include('flash.flash')

    <div class="container">
        <div class="bg-white row">
            <div class="col-md-12">
                <legend>Edit Category</legend>
                <form method="POST" action="/admin/categories" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $saleType->id }}">
                    <div class="row">
                        <div class="col">
                            <legend>Content</legend>
                            <div class="form-group">
                                <input type="text" name="name" value="{{ $saleType->name ?? '' }}" class="form-control"
                                    id="exampleInputEmail1" placeholder="Enter Category" required>
                            </div>
                        </div>
                    </div>

                    <a class="btn btn-warning" href="{{ url()->previous() }}">Back</a>
                    <button class="btn btn-primary" type="submit">Save</button>
                    <hr>
                    <hr>
                </form>
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
