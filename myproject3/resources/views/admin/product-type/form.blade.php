<div class="form-group {{ $errors->has('ProductTypeID') ? 'has-error' : ''}}">
    <label for="ProductTypeID" class="control-label">{{ 'Producttypeid' }}</label>
    <input class="form-control" name="ProductTypeID" type="number" id="ProductTypeID" value="{{ isset($producttype->ProductTypeID) ? $producttype->ProductTypeID : ''}}" >
    {!! $errors->first('ProductTypeID', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('ProductTypeName') ? 'has-error' : ''}}">
    <label for="ProductTypeName" class="control-label">{{ 'Producttypename' }}</label>
    <input class="form-control" name="ProductTypeName" type="text" id="ProductTypeName" value="{{ isset($producttype->ProductTypeName) ? $producttype->ProductTypeName : ''}}" >
    {!! $errors->first('ProductTypeName', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
