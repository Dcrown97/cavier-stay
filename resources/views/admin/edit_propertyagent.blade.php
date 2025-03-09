@extends('layout.new')

@section('contents')
    @include('flash.flash')

    <div class="container">
        <div class="bg-white row">
            <div class="col-md-12">
                <legend>Edit Property Agent</legend>
                <form method="POST" action="/admin/property/agents" enctype="multipart/form-data">
                    @csrf
                    {{-- {{dd($propertyAgent)}} --}}
                    <input type="hidden" name="id" value="{{ $propertyAgent->id }}">
                    <input type="hidden" name="old_photo" value="{{ $propertyAgent->image }}">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{ $propertyAgent->name ?? '' }}"
                                    placeholder="e.g ECG" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Position</label>
                                <input type="text" name="position" value="{{ $propertyAgent->position ?? '' }}"
                                    placeholder="Enter agents position" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Whatsapp Number</label>
                                <input type="text" name="facebook_link" value="{{ $propertyAgent->facebook_link ?? '' }}"
                                    placeholder="Enter agents facebook link" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Email Address</label>
                                <input type="text" name="twitter_link" value="{{ $propertyAgent->twitter_link ?? '' }}"
                                    placeholder="Enter agents twitter link" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Phone Number</label>
                                <input type="text" name="instagram_link"
                                    value="{{ $propertyAgent->instagram_link ?? '' }}"
                                    placeholder="Enter agents instagram link" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Image</label>
                                <input id="picture" type="file"
                                    onchange="this.files[0].size > 2097152 ? (alert('File size must be less than 2MB!'), this.value='') : preview();"
                                    name="image" value="{{ $propertyAgent->image }}" class="form-control">
                            </div>
                        </div>

                        <div class="col">
                            <img src="{{ isset($propertyAgent->photo) ? asset('storage/propertyagents/' . $propertyAgent->photo) : '' }}"
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
