<?php
    
    $id = $product->ProductID; //เมื่อ click ปุ่ม view จะส่งรหัสสินค้าเฉพาะ item ที่เลือกแสดงมายังหน้า show.blade.php
    $parts = DB::connection('mysql')
    ->select('select product.ProductID, product.ProductName, product.Quantity, product.Price, product.ProductDetail,
     product.ProductImage, product.ProductSize, producttype.ProductTypeID, producttype.ProductTypeName
    from product left join producttype on product.ProductTypeID = producttype.ProductTypeID
    where product.ProductID=?', [$id]);
    //query ข้อมูลเฉพาะ productID ที่ส่งมาจากหน้า index.blade.php สามารถกำหนด fields ที่ต้องการนำมาแสดงได้
?>

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Product {{ $product->ProductID }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/product') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/product/' . $product->ProductID . '/edit') }}" title="Edit Product"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/product' . '/' . $product->ProductID) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Product" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    @foreach($parts as $row)
                                    <tr><th> ProductID </th><td> {{ $row->ProductID }} </td></tr>
                                    <tr><th> ProductName </th><td> {{ $row->ProductName }} </td></tr>
                                    <tr><th> Price </th><td> {{ $row->Price }} </td></tr>
                                    <tr><th> Quantity </th><td> {{ $row->Quantity }} </td></tr>
                                    <tr><th> Image </th><td> <img src="{{ url('/') }}/images/product/{{ $row->ProductImage }}"></td></tr>
                                    <tr><th> Detail </th><td> {{ $row->ProductDetail }} </td></tr>
                                    <tr><th> Size </th><td> {{ $row->ProductSize }} </td></tr>
                                    
                                    <tr><th> Product type </th><td> {{ $row->ProductTypeName }}</td></tr>
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
