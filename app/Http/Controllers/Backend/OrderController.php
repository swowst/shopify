<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Invoice::with('orders')->withCount('orders')->get();
        return view('backend.pages.orders.index',compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */



    /**
     * Display the specified resource.
     */
    public function checkOrder(string $id)
    {
        $invoice = Invoice::where('id', $id)->with('orders')->firstOrFail();
        $totalPrice = 0;

        foreach ($invoice->orders as $order) {
            $totalPrice += $order->qty * $order->price;
        }

        return view('backend.pages.orders.create', compact('invoice', 'totalPrice'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $models = Order::where('id', $id)->first();

        return view('backend.pages.orders.create', compact('models'));

    }

    /**
     * Update the specified resource in storage.
     */
//    public function update(Request $request, string $id)
//    {
//        $orders = Order::findOrFail($id);
//
//
//        Order::where('id', $id)->update([
//            'name' => $request->name,
//            'price' => $request->price,
//            'color' => $request->color,
//            'category_id' => $request->category_id,
//            'content' => $request->text,
//            'size' => $request->size,
//            'short_text' => $request->short_text,
//            'qty' => $request->qty,
//            'status' => $request->status,
//        ]);
//
//        return back()->with('success', 'Order başarıyla güncellendi.');
//    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $order = Invoice::where('id', $request->id)->firstOrFail();


        $order->delete();

        return response(['error' => false, 'message' => 'Deleted successfully']);
    }


    public function status(Request $request)
    {
        $itemId = $request->input('itemId');
        $status = $request->input('status');

        // Update status in the database
        $orders = Order::findOrFail($itemId);
        $orders->status = $status;
        $orders->save();

        return response()->json(['success' => true]);

    }
}
