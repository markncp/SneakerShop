<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use DB;

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'orderID';
    public $timestamps = false;

    protected $fillable = [
        'statusID',
        'orderDate',
        'statusID',
        'id'
    ];     

    
    public static function index($query="",$id="",$statusID="")
    {
        $sql = "SELECT `order`.`orderID`, `orderDate`, 
        `order`.`id`, `statusID`, users.firstname,users.lastname,
        SUM(order_detail.Quantity) AS totalQuantity,
        SUM(order_detail.Quantity*order_detail.Price) AS totalPrice 
        FROM `order` 
        LEFT JOIN users ON users.id = `order`.id       
        INNER JOIN order_detail ON `order`.`orderID`=order_detail.orderID 
        WHERE 1 ";

        if($query!=""){
           $sql.="AND (`order`.orderDate LIKE '%$query%' OR 
                       users.firstname LIKE '%$query%' OR 
                       users.lastname LIKE '%$query%' ";
        }

        if($id!=""){
            $sql.="AND `order`.id=$id ";
        }

        if($statusID!=""){
            $sql.="AND `order`.statusID=$statusID ";
        }

        $sql.="GROUP BY `order`.`orderID`, `orderDate`,
         `order`.`id`, `statusID`,users.firstname,users.lastname     
        ORDER BY `order`.orderID DESC ";
        //echo $sql;die();        
        return DB::select($sql);
     }
     
    public function getUser() {
        return $this->belongsTo(User::class, 'id', 'id');
    }
    
}
