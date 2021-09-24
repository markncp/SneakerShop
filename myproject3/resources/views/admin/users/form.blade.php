<?php $parts = DB::connection('mysql')->select('select * from user_type');?>

<div class="form-group {{ $errors->has('id') ? 'has-error' : ''}}">
    <label for="id" class="control-label">{{ 'Id' }}</label>
    <input class="form-control" name="id" type="number" id="id" value="{{ isset($user->id) ? $user->id : ''}}" >
    {!! $errors->first('id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('firstname') ? 'has-error' : ''}}">
    <label for="firstname" class="control-label">{{ 'Firstname' }}</label>
    <input class="form-control" name="firstname" type="text" id="firstname" value="{{ isset($user->firstname) ? $user->firstname : ''}}" >
    {!! $errors->first('firstname', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('lastname') ? 'has-error' : ''}}">
    <label for="lastname" class="control-label">{{ 'Lastname' }}</label>
    <input class="form-control" name="lastname" type="text" id="lastname" value="{{ isset($user->lastname) ? $user->lastname : ''}}" >
    {!! $errors->first('lastname', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Email' }}</label>
    <input class="form-control" name="email" type="text" id="email" value="{{ isset($user->email) ? $user->email : ''}}" >
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('username') ? 'has-error' : ''}}">
    <label for="username" class="control-label">{{ 'Username' }}</label>
    <input class="form-control" name="username" type="text" id="username" value="{{ isset($user->username) ? $user->username : ''}}" >
    {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
    <label for="password" class="control-label">{{ 'Password' }}</label>
    <input class="form-control" name="password" type="text" id="password" value="{{ isset($user->password) ? $user->password : ''}}" >
    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
    <label for="phone" class="control-label">{{ 'Phone' }}</label>
    <input class="form-control" name="phone" type="text" id="phone" value="{{ isset($user->phone) ? $user->phone : ''}}" >
    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
   <label for="type" class="control-label">{{ 'Type' }}</label>
   <select class="form-control" name="type" id="type">
           <option value="{{ isset($users->type) ? $users->type : ''}}">{{ isset($users->type) ? $users->type : ''}}</option>
           @foreach($parts as $row)
           	<option value="{{$row->type}}">{{$row->TypeName}}</option>
           @endforeach    
   </select>
   {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group {{ $errors->has('addressdetail') ? 'has-error' : ''}}">
    <label for="addressdetail" class="control-label">{{ 'Addressdetail' }}</label>
    <input class="form-control" name="addressdetail" type="text" id="addressdetail" value="{{ isset($user->addressdetail) ? $user->addressdetail : ''}}" >
    {!! $errors->first('addressdetail', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('road') ? 'has-error' : ''}}">
    <label for="road" class="control-label">{{ 'Road' }}</label>
    <input class="form-control" name="road" type="text" id="road" value="{{ isset($user->road) ? $user->road : ''}}" >
    {!! $errors->first('road', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('province') ? 'has-error' : ''}}">
    <label for="province" class="control-label">{{ 'Province' }}</label>
    <input class="form-control" name="province" type="text" id="province" value="{{ isset($user->province) ? $user->province : ''}}" >
    {!! $errors->first('province', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('subdistrict') ? 'has-error' : ''}}">
    <label for="subdistrict" class="control-label">{{ 'Subdistrict' }}</label>
    <input class="form-control" name="subdistrict" type="text" id="subdistrict" value="{{ isset($user->subdistrict) ? $user->subdistrict : ''}}" >
    {!! $errors->first('subdistrict', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('district') ? 'has-error' : ''}}">
    <label for="district" class="control-label">{{ 'District' }}</label>
    <input class="form-control" name="district" type="text" id="district" value="{{ isset($user->district) ? $user->district : ''}}" >
    {!! $errors->first('district', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('zipcode') ? 'has-error' : ''}}">
    <label for="zipcode" class="control-label">{{ 'Zipcode' }}</label>
    <input class="form-control" name="zipcode" type="text" id="zipcode" value="{{ isset($user->zipcode) ? $user->zipcode : ''}}" >
    {!! $errors->first('zipcode', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('imageFileName') ? 'has-error' : ''}}">
    <label for="imageFileName" class="control-label">{{ 'Imagefilename' }}</label>
    <input class="form-control" name="imageFileName" type="file" id="imageFileName" value="{{ isset($user->imageFileName) ? $user->imageFileName : ''}}" >
    {!! $errors->first('imageFileName', '<p class="help-block">:message</p>') !!}
</div>




<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
