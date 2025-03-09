@extends('layout.new')

@section('contents')
    @include('flash.flash')

    <div class="container">
        <div class="bg-white row">
            <div class="col-md-12">
                <legend>Location</legend>
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            {{-- <legend>Location Name</legend> --}}
                            <div class="form-group">
                                <input type="text" name="name" value="" class="form-control"
                                    id="exampleInputEmail1" placeholder="Enter Location" required>
                            </div>
                        </div>
                    </div>

                    <a class="btn btn-warning" href="{{ url()->previous() }}">Back</a>
                    <button class="btn btn-primary" type="submit">Save</button>
                    <hr>
                    <hr>
                </form>
            </div>

            <div class="row col-lg-12">
                @forelse ($locations as $location)
                    <div class="card m-2" style="width: 18rem;">
                        <div class="card-body">
                            {{-- <p class="card-text"><b>Title:</b> <small>{{ Str::limit($location->title, 50) ?? '-' }}</small>
                            </p> --}}
                            <p class="card-text"><b>Name:</b> <small>{{ Str::limit($location->name, 50) ?? '-' }}
                                </small>
                            </p>
                            <div class="row">
                                <div class="d-flex">
                                    <a class="btn btn-primary mx-2 btn-sm"
                                        href="/admin/edit_location?id={{ base64_encode($location->id) ?? '' }}">
                                        <i class="fa fa-edit"></i> Edit</a>
                                    <a class="btn btn-danger mx-2 btn-sm"
                                        href="/admin/delete_location?id={{ base64_encode($location->id) ?? '' }}">
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
