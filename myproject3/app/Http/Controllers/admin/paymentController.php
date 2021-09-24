<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\payment;
use App\Models\Order;
use App\Models\OrderDetail;


use Illuminate\Http\Request;

class paymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request, Payment $payment, Order $order)
    {
        // dd($order->all());
        $payment = $payment->all();
        // dd($payment);
        // $keyword = $request->get('search');
        // $perPage = 25;

        // // $payment = $payment->get();

        // if (!empty($keyword)) {
        //     $payment = payment::where('PaymentID', 'LIKE', "%$keyword%")
        //         ->orWhere('PaymentDate', 'LIKE', "%$keyword%")
        //         ->orWhere('money_paid', 'LIKE', "%$keyword%")
        //         ->orWhere('comment', 'LIKE', "%$keyword%")
        //         ->orWhere('PaymentImage', 'LIKE', "%$keyword%")
        //         ->orWhere('orderID', 'LIKE', "%$keyword%")
        //         ->latest()->paginate($perPage);
        // } else {
        //     // $payment = [];
        //     $payment = payment::latest()->paginate($perPage);
        //     // dd($payment);
        // }

        return view('admin.payment.index', compact('payment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.payment.create');
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
        
        payment::create($requestData);

        return redirect('admin/payment')->with('flash_message', 'payment added!');
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
        $payment = payment::findOrFail($id);

        return view('admin.payment.show', compact('payment'));
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
        $payment = payment::findOrFail($id);

        return view('admin.payment.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Order $order, OrderDetail $orderdetail)
    {
        $requestData = $request->all();

        $order = $order->where('orderID', $requestData['orderID'])->first();

        $datadetail = $orderdetail->where('orderID', $order->orderID)->with(['getProduct'])->get();
        foreach($datadetail as $item) {
            $amountProduct = $item->getProduct->Quantity - $item->Quantity;
            if ($amountProduct < 0) {
                return back()->with('danger', 'สินค้าไม่พอ!!');
            }
        }


        $order->update(['statusID' => 2]);

        foreach($datadetail as $item) {
            $amountProduct = $item->getProduct->Quantity - $item->Quantity;
            $item->getProduct->update(['Quantity' => $amountProduct]);
        }

        return redirect('admin/payment')->with('flash_message', 'payment updated!');
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
        payment::destroy($id);

        return redirect('admin/payment')->with('flash_message', 'payment deleted!');
    }
}
