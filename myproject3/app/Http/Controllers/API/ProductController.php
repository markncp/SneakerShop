<?php
namespace App\Http\Controllers\API;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $ProductTypeID = $request->get('ProductTypeID');        
        $data = Product::index($search,$ProductTypeID);
        return response()->json($data);
    }
    public function view(Request $request)
    {
        $search = $request->get('search');
        $ProductTypeID = $request->get('ProductTypeID');        
        $data = Product::index($search,$ProductTypeID);
        return response()->json($data);
    }

    public function toppro()
    {   
        $sql='SELECT product.ProductID , ProductName ,product.Price AS Price, ProductImage , SUM(order_detail.Quantity) AS Topquantity 
        FROM product JOIN order_detail ON order_detail.ProductID = product.ProductID 
        GROUP BY product.ProductName ORDER BY SUM(order_detail.Quantity) DESC LIMIT 10 ';
        
        return response()->json( DB::select($sql) );
    }

    public function viewdetail($id){
        $sql="SELECT product.ProductName , product.Price , product.ProductDetail , product.ProductImage , 
        product.Quantity , producttype.ProductTypeName 
        FROM product
        INNER JOIN producttype ON producttype.ProductTypeID=product.ProductTypeID
        WHERE ProductID=$id";
        $vpro=DB::select($sql)[0];         
        return response()->json($vpro);
    }

    public function viewsize($name){
        $sql="SELECT ProductSize
        FROM product
        WHERE ProductName LIKE '%$name%' ";
        $size=DB::select($sql);         
        return response()->json($size);
    }

    public function viewview(Request $request,$id)
    {   $ProductSize= $request->get('ProductSize');
        $sql="SELECT * FROM product 
        INNER JOIN producttype ON producttype.ProductTypeID=product.ProductTypeID
        WHERE ProductName= '$id'";
	    if($ProductSize!=""){
	    $sql.=" AND ProductSize=$ProductSize " ;
	    } 
        $vpro=DB::select($sql)[0];         
        return response()->json($vpro);
    }    
    public function updatestok(Request $request, $id)
    {       
        $Product = Product::find($id);
        $Product->Quantity = $request->get('Quantity'); 
        $Product->save();

        return response()->json(array(
            'message' => 'update a Product successfully', 
            'status' => 'true'));
    }

}

