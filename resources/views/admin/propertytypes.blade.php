@extends('layout.new')

@section('contents')
    @include('flash.flash')

    <div class="container">
        <div class="bg-white row">
            <div class="col-md-12">
                <legend>Property Types</legend>
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" value="" placeholder="Enter Property Type"
                                    class="form-control" required>
                            </div>
                        </div>
                        {{-- <div class="col">
                            <div class="form-group">
                                <label for="">Type</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="branch" id=""
                                    required>
                                    <option value="">Select</option>
                                    @forelse ($locations as $location)
                                        
                                    <option value="{{ $location->name?? 'None' }}">{{ $location->name?? 'None' }}</option>
                                    @empty
                                    <option value="others">No Location</option>
                                    @endforelse
                                </select>
                            </div>
                        </div> --}}
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
                            <img src="{{ isset($testimonial->photo) ? asset('storage/properttypes' . '/' . $testimonial->photo) : '' }}"
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
                @forelse ($propertyTypes as $propertyType)
                    <div class="card m-2" style="width: 18rem;">
                        <img class="card-img-top"
                            src="{{ asset('storage/properttypes' . '/' . $propertyType->image) ?? '' }}" alt="">
                        <div class="card-body">
                            <p class="card-text"><b>Name:</b>
                                <small>{{ Str::limit($propertyType->name, 50) ?? '-' }}</small>
                            </p>
                            {{-- <p class="card-text"><b>Content:</b>
                                <small>{{ Str::limit($propertyType->content, 50) ?? '-' }}</small>
                            </p> --}}
                            <div class="row">
                                <div class="d-flex">
                                    <a class="btn btn-primary mx-2 btn-sm"
                                        href="/admin/edit/property/type?id={{ base64_encode($propertyType->id) ?? '' }}">
                                        <i class="fa fa-edit"></i> Edit</a>

                                    <a class="btn btn-danger mx-2 btn-sm"
                                        href="/admin/delete/property/type?id={{ base64_encode($propertyType->id) ?? '' }}"
                                        onclick="return confirm('Are you sure you want to delete this property type?')">
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
