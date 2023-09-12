<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->paginate(10);
        return view('orders.index', [
            'orders' => $orders
        ]);
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_number' => 'required|max:20|unique:orders',
            'date' => 'required|date',
            'supplier_name' => 'required|max:50',
            'product_name' => 'required|max:50',
            'total' => 'required|max:8'
        ]);

        Order::create($validatedData);

        return redirect('/orders')->with('success', 'New Order has been created');
    }

    public function edit(Order $order)
    {
        if (request('page')) {
            $order->page = request('page');
        }
        return view('orders.edit', [
            'order' => $order,
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $rules = [
            'date' => 'required|date',
            'supplier_name' => 'required|max:50',
            'product_name' => 'required|max:50',
            'total' => 'required|max:8'
        ];

        if ($request->order_number != $order->order_number) {
            $rules['order_number'] = 'required|max:20|unique:orders';
        }

        $validatedData = $request->validate($rules);
        Order::where('id', $order->id)
            ->update($validatedData);

        return redirect('/orders')->with('success', 'Order has been updated');
    }

    public function destroy(Order $order)
    {
        Order::destroy($order->id);
        return redirect('/orders')->with('success', 'Order has been deleted');
    }
}
