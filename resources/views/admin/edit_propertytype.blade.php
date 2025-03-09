@extends('layout.new')

@section('contents')
    @include('flash.flash')

    <div class="container">
        <div class="bg-white row">
            <div class="col-md-12">
                <legend>Edit Property Type</legend>
                <form method="POST" action="/admin/property/types" enctype="multipart/form-data">
                    @csrf
                    {{-- {{dd($edit_service)}} --}}
                    <input type="hidden" name="id" value="{{ $propertyType->id }}">
                    <input type="hidden" name="old_photo" value="{{ $propertyType->image }}">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{ $propertyType->name ?? '' }}" placeholder=""
                                    class="form-control" required>
                            </div>
                        </div>
                        {{-- <div class="col">
                            <legend>Description </legend>
                            <div class="form-group">
                                <textarea class="form-control" name="content" id="" cols="60" rows="5" required>{{ $propertyType->content ?? '' }}</textarea>
                            </div>
                        </div> --}}
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Image</label>
                                <input id="picture" type="file"
                                    onchange="this.files[0].size > 2097152 ? (alert('File size must be less than 2MB!'), this.value='') : preview();"
                                    name="image" value="{{ $propertyType->image }}" class="form-control">
                            </div>
                        </div>

                        <div class="col">
                            <img src="{{ isset($propertyType->photo) ? asset('storage/properttypes/' . $propertyType->photo) : '' }}"
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
@extends('layout.new')

@section('contents')
    @include('flash.flash')

    <div class="container">
        <div class="bg-white row">
            <div class="col-md-12">
                <legend>Edit Property Type</legend>
                <form method="POST" action="/admin/property/types" enctype="multipart/form-data">
                    @csrf
                    {{-- {{dd($edit_service)}} --}}
                    <input type="hidden" name="id" value="{{ $propertyType->id }}">
                    <input type="hidden" name="old_photo" value="{{ $propertyType->image }}">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{ $propertyType->name ?? '' }}" placeholder=""
                                    class="form-control" required>
                            </div>
                        </div>
                        {{-- <div class="col">
                            <legend>Description </legend>
                            <div class="form-group">
                                <textarea class="form-control" name="content" id="" cols="60" rows="5" required>{{ $propertyType->content ?? '' }}</textarea>
                            </div>
                        </div> --}}
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Image</label>
                                <input id="picture" type="file"
                                    onchange="this.files[0].size > 2097152 ? (alert('File size must be less than 2MB!'), this.value='') : preview();"
                                    name="image" value="{{ $propertyType->image }}" class="form-control">
                            </div>
                        </div>

                        <div class="col">
                            <img src="{{ isset($propertyType->photo) ? asset('storage/properttypes/' . $propertyType->photo) : '' }}"
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
