@extends('layout.admin')
@section('contents')
    <!-- Main content -->
    <section class="content">
        @include('flash.flash')
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <b>Services</b>
                    </h3>
                </div>
                <!-- /.card-header -->
                <form action="/admin/service" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                    <input type="text" name="title" value="" class="form-control"
                                        id="exampleInputEmail1" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Content</label>
                                    <textarea class="form-control" name="content" id="summernote" required>
                                    </textarea>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <!-- /.card-body -->
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    @if (isset($services))
                        <thead>
                            <tr>
                                <th style="width: 10px">S/N</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th class="align-items-center">Action</th>
                                {{-- <th style="width: 40px">Label</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $service->title }}</td>
                                    <td>{!! $service->content !!}</td>
                                    <td class="project-actions text-right">
                                        <div class="d-flex">
                                            <a class="btn btn-info btn-sm mr-2"
                                                onclick="openModal('{{ $service->id }}', '{{ $service->title }}', '{{ $service->content }}')"
                                                data-toggle="modal" data-target="#modal-default">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>

                                            <a class="btn btn-danger btn-sm"
                                                href="/admin/delete/service/{{ base64_encode($service->id) }}"
                                                onclick="return deleteFunction();">
                                                <i class="fas fa-trash">
                                                </i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <p>No Record Found!</p>
                    @endif
                </table>
            </div>
            <!-- /.container-fluid -->

            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Service</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- form start -->
                            <form action="/admin/service" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title</label>
                                        <input type="text" name="title" id="title" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Content</label>
                                        <textarea class="form-control" id="summernote1" name="content">
                                        </textarea>
                                    </div>
                                </div>
                                <input type="text" name="id" id="aboutId" hidden>
                                <!-- /.card-body -->
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

    </section>
    <!-- /.content -->
    <script>
        function openModal(id, title, content) {
            var form = document.querySelector('#modal-default form');
            console.log(id, 'sdfd')
            document.getElementById('title').value = title;
            $('#summernote1').summernote('code', content);
            document.getElementById('aboutId').value = id;
        }

        function deleteFunction() {
            if (!confirm("Are you sure you want to delete?"))
                event.preventDefault();
        }
    </script>
@endsection
