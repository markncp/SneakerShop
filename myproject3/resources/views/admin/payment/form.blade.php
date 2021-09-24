<div class="form-group {{ $errors->has('PaymentID') ? 'has-error' : ''}}">
    <label for="PaymentID" class="control-label">{{ 'Paymentid' }}</label>
    <input class="form-control" name="PaymentID" type="number" id="PaymentID" value="{{ isset($payment->PaymentID) ? $payment->PaymentID : ''}}" >
    {!! $errors->first('PaymentID', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('PaymentDate') ? 'has-error' : ''}}">
    <label for="PaymentDate" class="control-label">{{ 'Paymentdate' }}</label>
    <input class="form-control" name="PaymentDate" type="datetime-local" id="PaymentDate" value="{{ isset($payment->PaymentDate) ? $payment->PaymentDate : ''}}" >
    {!! $errors->first('PaymentDate', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('money_paid') ? 'has-error' : ''}}">
    <label for="money_paid" class="control-label">{{ 'Money Paid' }}</label>
    <input class="form-control" name="money_paid" type="number" id="money_paid" value="{{ isset($payment->money_paid) ? $payment->money_paid : ''}}" >
    {!! $errors->first('money_paid', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('comment') ? 'has-error' : ''}}">
    <label for="comment" class="control-label">{{ 'Comment' }}</label>
    <input class="form-control" name="comment" type="text" id="comment" value="{{ isset($payment->comment) ? $payment->comment : ''}}" >
    {!! $errors->first('comment', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('PaymentImage') ? 'has-error' : ''}}">
    <label for="PaymentImage" class="control-label">{{ 'Paymentimage' }}</label>
    <input class="form-control" name="PaymentImage" type="text" id="PaymentImage" value="{{ isset($payment->PaymentImage) ? $payment->PaymentImage : ''}}" >
    {!! $errors->first('PaymentImage', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('orderID') ? 'has-error' : ''}}">
    <label for="orderID" class="control-label">{{ 'Orderid' }}</label>
    <input class="form-control" name="orderID" type="number" id="orderID" value="{{ isset($payment->orderID) ? $payment->orderID : ''}}" >
    {!! $errors->first('orderID', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
