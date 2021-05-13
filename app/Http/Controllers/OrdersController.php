<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrdersController extends Controller
{
    public function details(Request $request, $uuid)
    {
        $order = Order::query()->where('uuid', '=', $uuid)->firstOrFail();
        return view('front.orders.details', [
            'order' => $order
        ]);
    }
}
