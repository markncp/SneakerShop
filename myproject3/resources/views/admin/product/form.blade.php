<?php $parts = DB::connection('mysql')->select('select * from producttype');?>
<div class="form-group {{ $errors->has('ProductID') ? 'has-error' : ''}}">
    <label for="ProductID" class="control-label">{{ 'Productid' }}</label>
    <input class="form-control" name="ProductID" type="number" id="ProductID" value="{{ isset($product->ProductID) ? $product->ProductID : ''}}" >
    {!! $errors->first('ProductID', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('ProductName') ? 'has-error' : ''}}">
    <label for="ProductName" class="control-label">{{ 'Productname' }}</label>
    <input class="form-control" name="ProductName" type="text" id="ProductName" value="{{ isset($product->ProductName) ? $product->ProductName : ''}}" >
    {!! $errors->first('ProductName', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('Quantity') ? 'has-error' : ''}}">
    <label for="Quantity" class="control-label">{{ 'Quantity' }}</label>
    <input class="form-control" name="Quantity" type="number" id="Quantity" value="{{ isset($product->Quantity) ? $product->Quantity : ''}}" >
    {!! $errors->first('Quantity', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('Price') ? 'has-error' : ''}}">
    <label for="Price" class="control-label">{{ 'Price' }}</label>
    <input class="form-control" name="Price" type="number" id="Price" value="{{ isset($product->Price) ? $product->Price : ''}}" >
    {!! $errors->first('Price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('ProductDetail') ? 'has-error' : ''}}">
    <label for="ProductDetail" class="control-label">{{ 'Productdetail' }}</label>
    <input class="form-control" name="ProductDetail" type="text" id="ProductDetail" value="{{ isset($product->ProductDetail) ? $product->ProductDetail : ''}}" >
    {!! $errors->first('ProductDetail', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('ProductImage') ? 'has-error' : ''}}">
    <label for="ProductImage" class="control-label">{{ 'Productimage' }}</label>
    <input class="form-control" name="ProductImage" type="file" id="ProductImage" value="{{ isset($product->ProductImage) ? $product->ProductImage : ''}}" >
    {!! $errors->first('ProductImage', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('ProductSize') ? 'has-error' : ''}}">
    <label for="ProductSize" class="control-label">{{ 'Size' }}</label>
    <input class="form-control" name="ProductSize" type="text" id="ProductSize" value="{{ isset($product->ProductSize) ? $product->ProductSize : ''}}" >
    {!! $errors->first('ProductSize', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('ProductTypeID') ? 'has-error' : ''}}">
   <label for="ProductTypeID" class="control-label">{{ 'ProductTypeID' }}</label>
   <select class="form-control" name="ProductTypeID" id="ProductTypeID">
           <option value="{{ isset($product->ProductTypeID) ? $product->ProductTypeID : ''}}">{{ isset($product->ProductTypeID) ? $product->ProductTypeID : ''}}</option>
           @foreach($parts as $row)
           	<option value="{{$row->ProductTypeID}}">{{$row->ProductTypeName}}</option>
           @endforeach    
   </select>
   {!! $errors->first('ProductTypeID', '<p class="help-block">:message</p>') !!}
</div>



<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
