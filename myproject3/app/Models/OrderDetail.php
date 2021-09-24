<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Product;
class OrderDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_detail';
    
    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'OrderDetailID  ';
    public $timestamps = false;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Quantity', 'Price','ProductID','orderID' ];

    public function getProduct() {
        return $this->belongsTo(Product::class, 'ProductID', 'ProductID');
    }
    //public $timestamps = false; 
}