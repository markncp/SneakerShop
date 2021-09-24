<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use DB;
// use App\Models\Order;


class OrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $id = $request->get('id');
        $statusID = $request->get('statusID');
        $order = Order::index($search,$id,$statusID);
        return response()->json( $order );
    }
    public function create(Request $request, Order $order, OrderDetail $orderDetail)
    {
        
        return response()->json($request->all());

            $inputsOrder = $request->only('id');
            $inputsOrder['statusID'] = 0;
            $inputsOrder['orderDate'] = Carbon::now();


            $newObject = $order->create($inputsOrder);
        
    }


    public function AddOrderNull($id)
    {
        $Order = new Order();    
        $Order->statusID = 0;
        $Order->id = $id;
        $Order->orderDate = date('Y-m-d');;
        $Order->save();                
        return response()->json(array(
            'message' => 'add a Order successfully', 
            'status' => 'true'));   
    }

    public function SelectIDOrder()
    {
        $sql="SELECT orderID FROM `order` WHERE 1  ORDER BY orderID DESC";
        $order=DB::select($sql)[0];
        return response()->json($order);

    }

    public function updatestatus(Request $request, $id)
    {       
        $order = Order::find($id);
        $order->statusID = $request->get('statusID');       
        $order->save();

        return response()->json(array(
            'message' => 'update a order successfully', 
            'status' => 'true'));
    }
}