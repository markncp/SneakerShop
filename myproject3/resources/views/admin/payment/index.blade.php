@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Payment</div>
                    <div class="card-body">

                        <form method="GET" action="{{ url('/admin/payment') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>PaymentID</th><th>PaymentDate</th><th>Money Paid</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($payment as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->getOrder->getUser->firstname }}</td>
                                        <td>{{ $item->PaymentDate }}</td>
                                        <td>{{ $item->price }}</td>
                                        @if($item->getOrder->statusID == 1)
                                        <td>
                                            <a href="{{ url('/admin/payment/' . $item->PaymentID ) }}" title="View payment"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                        </td>
                                        @endif
                                        
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
