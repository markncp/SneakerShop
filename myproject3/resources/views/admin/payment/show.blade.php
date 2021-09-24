@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">payment {{ $payment->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/payment') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> ย้อนกลับ</button></a>

                        <form method="POST" action="{{ url('admin/payment/update') }}" accept-charset="UTF-8" style="display:inline">
                            {{ csrf_field() }}
                            <input type="hidden" name="orderID" value="{{ $payment->orderID }}">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i> ยืนยันการชำระเงิน</button>
                        </form>
                        @if (\Session::has('danger'))
                            <div class="alert alert-danger">
                                <ul>
                                    <li>{!! \Session::get('danger') !!}</li>
                                </ul>
                            </div>
                        @endif
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                   
                                    </tr>
                                    <tr><th> OrderID </th><td> {{ $payment->orderID }} </td>
                                    </tr><tr><th> PaymentDate </th><td> {{ $payment->PaymentDate }} </td></tr>
                                    <tr><th> Money Paid </th><td> {{ $payment->price }} </td></tr>
                                    <tr><th> Comment </th><td> {{ $payment->comment }} </td></tr>
                                    <tr><th> Image </th><td> <img src="{{ url('/') }}/images/payment/{{ $payment->imageFileName }}"></td></tr>                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
