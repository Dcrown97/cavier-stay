@extends('layout.admin')

@section('contents')
    @include('flash.flash')

    <div class="container">
        <div class="bg-white row">
            <div class="col-md-12">
                <legend>Faqs</legend>
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" name="title" value="" placeholder="e.g Cheers"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <legend>Content</legend>
                            <div class="form-group">
                                <textarea class="form-control" name="content" id="" cols="60" rows="2" required></textarea>
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
                @forelse ($faqs as $faq)
                    <div class="card m-2" style="width: 18rem;">
                        <div class="card-body">
                            <p class="card-text"><b>Title:</b> <small>{{ Str::limit($faq->title, 50) ?? '-' }}</small>
                            </p>
                            <p class="card-text"><b>Content:</b> <small>{{ Str::limit($faq->content, 50) ?? '-' }}
                                </small>
                            </p>
                            <div class="row">
                                <div class="d-flex">

                                    <a class="btn btn-primary mx-2 btn-sm"
                                        href="/admin/edit_faq?id={{ base64_encode($faq->id) ?? '' }}">
                                        <i class="fa fa-edit"></i> Edit</a>
                                    <a class="btn btn-danger mx-2 btn-sm"
                                        href="/admin/delete_faq?id={{ base64_encode($faq->id) ?? '' }}">
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
