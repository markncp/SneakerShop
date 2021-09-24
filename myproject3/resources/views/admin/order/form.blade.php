
<div class="form-group {{ $errors->has('orderID') ? 'has-error' : ''}}">
    <label for="orderID" class="control-label">{{ 'Orderid' }}</label>
    <input class="form-control" name="orderID" type="number" id="orderID" value="{{ isset($order->orderID) ? $order->orderID : ''}}" >
    {!! $errors->first('orderID', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('orderDate') ? 'has-error' : ''}}">
    <label for="orderDate" class="control-label">{{ 'Orderdate' }}</label>
    <input class="form-control" name="orderDate" type="datetime-local" id="orderDate" value="{{ isset($order->orderDate) ? $order->orderDate : ''}}" >
    {!! $errors->first('orderDate', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group {{ $errors->has('statusID') ? 'has-error' : ''}}">
    <label for="statusID" class="control-label">{{ 'Statusid' }}</label>
    <input class="form-control" name="statusID" type="number" id="statusID" value="{{ isset($order->statusID) ? $order->statusID : ''}}" >
    {!! $errors->first('statusID', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group {{ $errors->has('id') ? 'has-error' : ''}}">
    <label for="id" class="control-label">{{ 'Id' }}</label>
    <input class="form-control" name="id" type="number" id="id" value="{{ isset($order->id) ? $order->id : ''}}" >
    {!! $errors->first('id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
