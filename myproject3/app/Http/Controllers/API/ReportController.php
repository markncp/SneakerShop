<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use DB;

class ReportController extends Controller
{
    //ยอดการสั่งซื้อรายเดือน (บาท)    
    public function monthlySale($id)    
    {
        $year=2021 ;//date("Y");
        $sql = "SELECT SUBSTRING(`order`.orderDate,6,2) AS month, 
                    SUM(order_detail.Quantity*order_detail.Price) AS totalPrice 
                FROM product 
                    INNER JOIN order_detail ON product.productID=order_detail.productID
                    INNER JOIN `order` ON order_detail.orderID=`order`.orderID ";
                
                if($id!="" && $year!=""){
                $sql .="WHERE `order`.`id`=$id AND SUBSTRING(`order`.orderDate,1,4)='$year' ";
                }else if($id!=""){
                $sql .="WHERE `order`.`id`=$id ";
                }else if($year!=""){
                $sql .="WHERE SUBSTRING(`order`.orderDate,1,4)='$year' ";
                }

                $sql .=" GROUP BY SUBSTRING(`order`.orderDate,6,2)
                ORDER BY SUBSTRING(`order`.orderDate,6,2) ASC";        
        return response()->json( DB::select($sql) );
    }

    //สินค้าที่มียอดการสั่งซื้อ 5 อันดับแรก (บาท)
    public function topFiveProduct($id)
    {
        $year=2021 ;//date("Y");
        $sql = "SELECT product.ProductID , ProductName, 
                        SUM(order_detail.Quantity*order_detail.Price) AS totalPrice 
                FROM product 
                    INNER JOIN order_detail ON product.ProductID =order_detail.ProductID 
                    INNER JOIN `order` ON order_detail.orderID=`order`.orderID ";

                if($id!="" && $year!=""){
                $sql .="WHERE `order`.`id`=$id AND SUBSTRING(`order`.orderDate,1,4)='$year' ";
                }else if($id!=""){
                $sql .="WHERE `order`.`id`=$id ";
                }else if($year!=""){
                $sql .="WHERE SUBSTRING(`order`.orderDate,1,4)='$year' ";
                }    

                $sql .="GROUP BY product.ProductName , ProductName 
                ORDER BY SUM(order_detail.Quantity*order_detail.Price) DESC LIMIT 5";
        return response()->json( DB::select($sql) );
    }
 
}