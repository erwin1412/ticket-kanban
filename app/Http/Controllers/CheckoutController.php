<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    public function index()
    {
        $couriers    = DB::table('couriers')->pluck('title', 'code');
        $provinces   = DB::table('provinces')->pluck('title', 'province_id');
        $carts       = Cart::with('product')
            ->where('user_id', auth()->user()->id)
            ->get();
        $totalPrice  = 0;
        $totalWeight = 0;

        foreach ($carts as $cart) {
            $totalPrice  += $cart->product->price * $cart->qty;
            $totalWeight += $cart->product->weight * $cart->qty;
        }

        return view('checkouts.index', compact('couriers', 'provinces', 'totalPrice', 'totalWeight'));
    }

    public function getCities($id)
    {
        $city = DB::table('cities')->where('province_id', $id)
            ->pluck('title', 'city_id');

        return response()->json($city);
    }

    public function checkCost(Request $request)
    {
        $response = Http::withHeaders([
            'key' => config('services.rajaongkir.key')
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin'      => 468, // ID kota Tasikmalaya  (Kabupaten)
            'destination' => $request->destination,
            'weight'      => str_replace('.', '', $request->weight),
            'courier'     => $request->courier
        ]);

        return response()->json($response['rajaongkir']['results'][0]['costs']);
    }

    public function pay(Request $request)
    {
        $pecah      = explode('_', $request->service);
        $newService = $pecah[0] . ' - ' . 'Estimasi ' . $pecah[2] . ' Hari';
        $newAddress = $request->address . ' ' . explode('_', $request->city_destination)[1] . ' ' . explode('_', $request->province_destination)[1];

        $order                = new Order;
        $order->user_id       = auth()->user()->id;
        $order->order_number  = 'ON' . time();
        $order->name          = $request->name;
        $order->phone_number  = $request->phone_number;
        $order->weight        = str_replace('.', '', $request->weight);
        $order->courier       = strtoupper($request->courier);
        $order->service       = $newService;
        $order->total_price   = $request->total_price;
        $order->shipping_cost = $request->shipping_cost;
        $order->total_amount  = $request->total_amount;
        $order->address       = $newAddress;
        $order->save();

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey    = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized  = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds        = true;

        $params = [
            'transaction_details'   => [
                'order_id'          => $order->order_number,
                'gross_amount'      => $order->total_amount
            ],
            'customer_details'      => [
                'firt_name'         => $request->name,
                'last_nama'         => '',
                'phone'             => $request->phone_number,
            ]
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $order->snap_token = $snapToken;
        $order->save();

        // Pindahkan data cart ke table order details
        // Dan kurangi stok product
        $carts      = Cart::with('product')
            ->where('user_id', auth()->user()->id)
            ->get();

        foreach ($carts as $cart) {
            $product    = Product::find($cart->product_id);
            $product->update([
                'stock' => $product->stock - $cart->qty
            ]);

            OrderDetail::create([
                'order_id'      => $order->id,
                'user_id'       => $cart->user_id,
                'product_id'    => $cart->product_id,
                'qty'           => $cart->qty
            ]);
        }

        // Hapus data cart berdasar user id
        $cartByUser = Cart::where('user_id', auth()->user()->id);
        $cartByUser->delete();

        return redirect('/user/purchase')->with('success', 'Pesanan berhasil dibuat');
    }

    public function callback(Request $request)
    {
        $serverKey  = config('midtrans.server_key');
        $hash       = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hash == $request->signature_key) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $order          = Order::where('order_number', $request->order_id)->first();
                $order->status  = 'Paid';
                $order->save();
            }
        }
    }
}
