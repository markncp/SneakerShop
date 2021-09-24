<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use DB;
// use App\Models\Order;


class OrderDetailController extends Controller
{
    public function AddOrderDetail(Request $request)
    {
        
        $OrderDetail = new OrderDetail();
        $OrderDetail->Quantity = $request->get('Quantity');
        $OrderDetail->Price = $request->get('Price');    
        $OrderDetail->ProductID  = $request->get('ProductID');
        $OrderDetail->orderID = $request->get('orderID');          
        $OrderDetail->save();                
        return response()->json(array(
            'message' => 'add a OrderDetail successfully', 
            'status' => 'true'));   
    }
   
}