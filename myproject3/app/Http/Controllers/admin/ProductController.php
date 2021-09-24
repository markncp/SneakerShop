<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $product = Product::where('ProductID', 'LIKE', "%$keyword%")
                ->orWhere('ProductName', 'LIKE', "%$keyword%")
                ->orWhere('Quantity', 'LIKE', "%$keyword%")
                ->orWhere('Price', 'LIKE', "%$keyword%")
                ->orWhere('ProductDetail', 'LIKE', "%$keyword%")
                ->orWhere('ProductImage', 'LIKE', "%$keyword%")
                ->orWhere('ProductSize', 'LIKE', "%$keyword%")
                ->orWhere('ProductTypeID', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $product = Product::latest()->paginate($perPage);
        }

        return view('admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'ProductID'         ,
            'ProductName'       =>  'required',
            'Quantity'          =>  'required',
            'Price'             =>  'required',
            'ProductDetail'     ,
            'ProductImage'      =>  'required|max:2048',
            'ProductSize'             =>  'required',
            'ProductTypeID'     =>  'required',
        ]);
       
        $image = $request->file('ProductImage');
  
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/product'), $new_name);
        $form_data = array(
            'ProductID'         =>   $request->ProductID,
            'ProductName'       =>   $request->ProductName,
            'Quantity'          =>   $request->Quantity,
            'Price'             =>   $request->Price,
            'ProductDetail'     =>   $request->ProductDetail,
            'ProductImage'      =>   $new_name,
            'ProductSize'     =>   $request->ProductSize,
            'ProductTypeID'     =>   $request->ProductTypeID
       );
    
       Product::create($form_data);
      
       return redirect('admin/product')->with('flash_message', 'Product added!');


        /*
        $requestData = $request->all();
        
        Product::create($requestData);

        return redirect('admin/product')->with('flash_message', 'Product added!');
        */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'ProductID'         =>  'required',
            'ProductName'       =>  'required',
            'Quantity'          =>  'required',
            'Price'             =>  'required',
            'ProductDetail'     ,
            'ProductImage'      =>  'required|max:2048',
            'ProductSize'             =>  'required',
            'ProductTypeID'     =>  'required',
        ]);
       
        $image = $request->file('ProductImage');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/product'), $new_name);
        $form_data = array(
            'ProductID'         =>   $request->ProductID,
            'ProductName'       =>   $request->ProductName,
            'Quantity'          =>   $request->Quantity,
            'Price'             =>   $request->Price,
            'ProductDetail'     =>   $request->ProductDetail,
            'ProductImage'      =>   $new_name,
            'ProductSize'       =>   $request->ProductSize,
            'ProductTypeID'     =>   $request->ProductTypeID
       );
      
       $product = Product::findOrFail($id);
       $product->update($form_data);
 
       return redirect('admin/product')->with('flash_message', 'Product updated!');
   
        /*
        $requestData = $request->all();
        
        $product = Product::findOrFail($id);
        $product->update($requestData);

        return redirect('admin/product')->with('flash_message', 'Product updated!');
        */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Product::destroy($id);

        return redirect('admin/product')->with('flash_message', 'Product deleted!');
    }
}
