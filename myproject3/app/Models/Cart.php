<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Cart extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'shop_cart';
    
    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'CartID ';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['CartID ', 'cart_quantity', 'cart_price ', 'ProductID ', 'id'];

    public $timestamps = false; 
}