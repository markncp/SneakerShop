<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use DB;

class CartController extends Controller
{
    public static function index($id)
    {
        $sql = "SELECT shop_cart.CartID, shop_cart.cart_quantity, shop_cart.cart_price, product.ProductName, shop_cart.ProductID, product.ProductImage,shop_cart.ProductID ,
        ( shop_cart.cart_quantity*shop_cart.cart_price)AS totalprice
        FROM shop_cart 
        INNER JOIN users ON users.id = shop_cart.id
        INNER JOIN product ON shop_cart.ProductID=product.ProductID 
        WHERE shop_cart.id=$id ";

        return DB::select($sql);
     }
     
     public static function delete($id)
    {
        $sql="DELETE FROM shop_cart
        WHERE CartID=$id";
        $dcart=DB::select($sql)[0];         
        return response()->json($dcart);
     }
     
     public static function addcart(Request $request){
        $cart = new Cart();
        $cart->cart_quantity = $request->get('cart_quantity');
        $cart->cart_price = $request->get('cart_price');   
        $cart->ProductID  = $request->get('ProductID');     
        $cart->id = $request->get('id');
        //$product->phone = $request->get('phone');
        $cart->save();
        return response()->json(array(
            'message' => 'add cart successfully', 
            'status' => 'true'));
     }
}