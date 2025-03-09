@extends('layout.new')
@section('contents')
    <div class="row">

        @include('flash.flash')
        <legend>Contact Messages</legend>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($contacts as $item)
                                <tr>
                                    <td>{{ $item->name ?? '' }}</td>
                                    <td>{{ $item->email ?? '' }}</td>
                                    <td>{{ $item->phone ?? '' }}</td>
                                    <td style="white-space: pre-wrap">{{ $item->message ?? '' }}</td>
                                    <td>
                                        <a onclick="return confirm('Are you sure you want to delete this message?')"
                                            href="/admin/delete_contact/{{ base64_encode($item->id) }}"
                                            class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                        {{-- Reply with mailto --}}
                                        <a href="mailto:{{ $item->email ?? '' }}?subject={{ $item->subject ?? '' }}&body={{ $item->message ?? '' }}"
                                            class="btn btn-primary"><i class="fa fa-reply"></i> Reply</a>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No data</td>
                                </tr>
                            @endforelse
                        </tbody>
                        {{-- pagination with count --}}
                        <tfoot>
                            <tr>
                                <td colspan="5">
                                    {{ $contacts->links() }}
                                    <span class="float-right">Showing {{ $contacts->firstItem() }} to
                                        {{ $contacts->lastItem() }}
                                        of {{ $contacts->total() }} entries</span>
                                </td>
                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
