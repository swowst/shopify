<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {

        $coupons = Coupon::where('status', '1')->get();
        $cartItem = session('cart', []);
        $totalPrice = 0;
        $categories = Category::all();

        foreach ($cartItem as $cart){
            $totalPrice += $cart['price'] * $cart['qty'];
        }

        if (session()->get('coupon_code')){
            $kupon = Coupon::where('name', session()->get('coupon_code'))->where('status', '1')->first();
            $kuponprice = $kupon->price ?? 0;
            $kuponcode = $kupon->name ?? '';

            $newTotalPrice = $totalPrice - $kuponprice;
        }else{
            $newTotalPrice = $totalPrice;
        }



        session()->put('totalPrice', $newTotalPrice);
        return view('frontend.pages.cart', compact('categories','cartItem', 'coupons'));
    }

    public function add(Request $request)
    {
        $productId = $request->product_id;
        $qty = $request->qty ?? 1 ;
        $size = $request->size;
        $product = Product::find($productId);

        if (!$product){
            return redirect()->back()->withErrors('Product not find');
        }

        $cartItem = session('cart',[]);

        if (array_key_exists($productId, $cartItem)){
            $cartItem['productId']['qty'] += $qty;
        }else{
            $cartItem[$productId] = [
                'name' => $product->name,
                'image' => $product->image,
                'price' => $product->price,
                'qty' => $qty,
                'size' => $size,
            ];
        }
        session(['cart' =>$cartItem ]);

        return redirect()->back()->withSuccess('Product added to cart');

    }


    public function newQty(Request $request)
    {
        $productId = $request->productId;
        $qty = $request->qty;
        $itemEvent = $request->itemEvent;

        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $cartItems = session()->get('cart', []);

        if (!isset($cartItems[$productId])) {
            return response()->json(['error' => 'Product not found in cart'], 404);
        }

        if ($itemEvent == 'Arttir') {
            $cartItems[$productId]['qty'] += $qty;
        } elseif ($itemEvent == 'Azalt') {
            if ($cartItems[$productId]['qty'] > $qty) {
                $cartItems[$productId]['qty'] -= $qty;
            } else {
                $qty = 0;
                unset($cartItems[$productId]);
            }
        }

        session()->put('cart', $cartItems);
        $itemTotal = $product->price * $qty;

        return response()->json(['itemTotal' => $itemTotal, 'message' => 'Updated Cart']);
    }






    public function remove(Request $request)
    {
        $productId = $request->product_id;
        $cartItem = session('cart',[]);

        if (array_key_exists($productId, $cartItem)){
            unset($cartItem[$productId]);
        }

        session(['cart' => $cartItem]);

        return redirect()->back()->with('success', 'Removed successfully');
    }

    public function checkCoupon(Request $request)
    {
        $totalPrice = 0;
        $cartItem = session('cart', []);


        foreach ($cartItem as $cart){
            $totalPrice += $cart['price'] * $cart['qty'];
        }

        $kupon = Coupon::where('name', $request->name)->where('status', '1')->first();

        if (!$kupon){
            return back()->with('error', 'Code not available');
        }


        $kuponprice = $kupon->price ?? 0;
        $kuponcode = $kupon->name ?? '';

        $totalPrice = $totalPrice - $kuponprice;

        session()->put('totalPrice', $totalPrice);
        session()->put('coupon_code', $kuponcode);


        return back()->withSuccess('Added successfully');

    }


    public function cartSave(Request $request)
    {
         $invoice = Invoice::create([
             'user_id' => auth()->user()->id ?? null,
             'order_no' => rand(10000, 1000000),
             'country' => $request->country ?? null,
             'name' => $request->name ?? null,
             'company_name' => $request->company_name ?? null,
             'address' => $request->address ?? null,
             'city' => $request->city ?? null,
             'zip' => $request->zip ?? null,
             'email' => $request->email ?? null,
             'phone' => $request->phone ?? null,
             'note' => $request->note ?? null,

        ]);

         $cart = session()->get('cart');

         foreach ($cart as $key => $item){
             Order::create([
                 'order_no' => $invoice->order_no,
                 'product_id' => $key,
                 'name' => $item['name'],
                 'price' => $item['price'],
                 'qty' => $item['qty'],
             ]);
         }

         return redirect()->back();
    }
}
