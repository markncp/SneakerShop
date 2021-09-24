<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use DB;
class PaymentController extends Controller
{
public function payment(Request $request){
        //validate image file
        //$this->validate($request, ['file' => 'image']);
        //upload file
        $imageFileName = "";
        $file = $request->file('file');
        if(isset($file)){
        $file->move(public_path('images/payment'),
        $file->getClientOriginalName());
        $imageFileName = $file->getClientOriginalName();
        }//add user data into users table
        
        $user = new Payment();
        $user->orderID = $request->get('orderID');
        $user->PaymentDate =date("Y-m-d");
        $user->price = $request->get('price');
        $user->comment = $request->get('comment');
        $user->imageFileName = $imageFileName;
        $user->save();
        return response()->json(array(
        'message' => 'add a payment successfully',
        'status' => 'true'));
    }
}