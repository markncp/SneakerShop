<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
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
            $producttype = ProductType::where('ProductTypeID', 'LIKE', "%$keyword%")
                ->orWhere('ProductTypeName', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $producttype = ProductType::latest()->paginate($perPage);
        }

        return view('admin.product-type.index', compact('producttype'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.product-type.create');
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
        
        $requestData = $request->all();
        
        ProductType::create($requestData);

        return redirect('admin/product-type')->with('flash_message', 'ProductType added!');
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
        $producttype = ProductType::findOrFail($id);

        return view('admin.product-type.show', compact('producttype'));
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
        $producttype = ProductType::findOrFail($id);

        return view('admin.product-type.edit', compact('producttype'));
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
        
        $requestData = $request->all();
        
        $producttype = ProductType::findOrFail($id);
        $producttype->update($requestData);

        return redirect('admin/product-type')->with('flash_message', 'ProductType updated!');
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
        ProductType::destroy($id);

        return redirect('admin/product-type')->with('flash_message', 'ProductType deleted!');
    }
}
