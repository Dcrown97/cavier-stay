@extends('layout.admin')

@section('contents')
    @include('flash.flash')

    <div class="container">
        <div class="bg-white row">
            <div class="col-md-12">
                <legend>Edit Faqs</legend>
                <form method="POST" action="/admin/faqs" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $faq->id }}">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" name="title" value="{{ $faq->title ?? '' }}"
                                    placeholder="e.g Cheers" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <legend>Content</legend>
                            <div class="form-group">
                                <textarea class="form-control" name="content" id="" cols="60" rows="2" required>{{ $faq->content ?? '' }}</textarea>
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
