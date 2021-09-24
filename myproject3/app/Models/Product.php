<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Product extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'ProductID';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ProductID', 'ProductName', 'Quantity', 'Price', 'ProductDetail', 'ProductImage', 'ProductTypeID','ProductSize'];

    //
    public static function index($query="",$ProductTypeID="")
    {
        $sql="SELECT * FROM product 
              INNER JOIN producttype ON producttype.ProductTypeID=product.ProductTypeID
              WHERE 1 ";
        if($query!=""){
            $sql.="AND product.ProductName LIKE '%$query%' OR 
                       producttype.ProductTypeName LIKE '%$query%' ";
        }

        if($ProductTypeID!=""){            
            $sql.="AND product.ProductTypeID=$ProductTypeID ";            
        } 
        $sql.="GROUP BY product.ProductName ";
        $sql.="ORDER BY product.ProductID ASC ";

         return DB::select($sql);
    }

    

}
