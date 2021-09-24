@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">user {{ $user->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/users') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/users/' . $user->id . '/edit') }}" title="Edit user"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/users' . '/' . $user->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete user" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $user->id }}</td>
                                    </tr>
                                    <tr><th> Id </th><td> {{ $user->id }} </td></tr><tr><th> Firstname </th><td> {{ $user->firstname }} </td></tr>
                                    <tr><th> Lastname </th><td> {{ $user->lastname }} </td></tr><tr><th> Username </th><td> {{ $user->username }} </td></tr>
                                    <tr><th> Email </th><td> {{ $user->email }} </td></tr><tr><th> Phone </th><td> {{ $user->phone }} </td></tr>
                                    <tr><th> Type </th><td> {{ $user->type }} </td></tr><tr><th> AddressDetail </th><td> {{ $user->addressdetail }} </td></tr>
                                    <tr><th> ถนน </th><td> {{ $user->road }} </td></tr><tr><th> ตำบล </th><td> {{ $user->subdistrict }} </td></tr>
                                    <tr><th> อำเภอ </th><td> {{ $user->district }} </td></tr><tr><th> จังหวัด </th><td> {{ $user->province }} </td></tr>
                                    <tr><th> รหัสไปรษณีย์ </th><td> {{ $user->zipcode }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
