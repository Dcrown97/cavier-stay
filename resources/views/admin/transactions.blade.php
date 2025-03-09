@extends('layout.new')
@section('contents')
    <div class="row">

        @include('flash.flash')
        <legend>Transactions</legend>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Property</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $item)
                                <tr>
                                    <td>{{ $item->full_name ?? '' }}</td>
                                    <td>{{ $item->email ?? '' }}</td>
                                    <td>{{ $item->phone ?? '' }}</td>
                                    <td style="white-space: pre-wrap">{{ $item->address ?? '' }}</td>
                                    <td>{{ $item->property->name ?? '' }}</td>
                                    <td>{{ $item->created_at ?? '' }}</td>
                                    <td>{{ $item->amount ?? '' }}</td>
                                    <td>{{ $item->status ?? '' }}</td>
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
                                    {{ $transactions->links() }}
                                    <span class="float-right">Showing {{ $transactions->firstItem() }} to
                                        {{ $transactions->lastItem() }}
                                        of {{ $transactions->total() }} entries</span>
                                </td>
                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
