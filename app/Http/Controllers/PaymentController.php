<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Conekta\Conekta as Conekta;
use Conekta\Order as ConektaOrder;
use App\Models\Order as AppOrder;

class PaymentController extends Controller {
    public function checkout() {
        return view('checkout');
    }

    public function processPayment(Request $request) {
        Conekta::setApiKey(env('CONEKTA_SECRET_KEY'));
        Conekta::setApiVersion("2.0.0");

        try {
            AppOrder::create([
                'customer_name' => $request->name,
                'customer_email' => $request->email,
                'total' => $request->amount,
                'items' => json_encode(session('cart')),
                'status' => 'pending'
            ]);

            ConektaOrder::create([
                "line_items" => [
                    [
                        "name" => "Compra en tienda",
                        "unit_price" => intval($request->amount * 100),
                        "quantity" => 1
                    ]
                ],
                "charges" => [
                    [
                        "payment_method" => [
                            "type" => "card",
                            "token_id" => $request->token
                        ]
                    ]
                ],
                "currency" => "MXN"
            ]);

            session()->forget('cart');
            return redirect()->route('products.index')->with('success', 'Pago exitoso');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}