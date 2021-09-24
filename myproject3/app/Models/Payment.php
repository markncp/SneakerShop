<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use DB;

class Payment extends Model
{

    protected $table = 'payment';
    protected $primaryKey = 'PaymentID';
    public $timestamps = false;

    protected $fillable = ['PaymentID', 'PaymentDate', 'money_paid', 'comment', 'imageFileName', 'orderID'];

    public function getOrder() {
        return $this->belongsTo(Order::class, 'orderID', 'orderID');
    }

}
