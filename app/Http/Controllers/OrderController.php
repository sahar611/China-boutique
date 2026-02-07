<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
 use Barryvdh\DomPDF\Facade\Pdf;


class OrderController extends Controller
{
    public function index(Request $request)
{
    $q = Order::query()->latest();

    if ($request->filled('status')) {
        $q->where('status', $request->status);
    }

    if ($request->filled('payment_method')) {
        $q->where('payment_method', $request->payment_method);
    }

    if ($request->filled('payment_status')) {
        $q->where('payment_status', $request->payment_status);
    }

    if ($request->filled('from')) {
        $q->whereDate('placed_at', '>=', $request->from);
    }

    if ($request->filled('to')) {
        $q->whereDate('placed_at', '<=', $request->to);
    }

    if ($request->filled('search')) {
        $search = $request->search;
        $q->where(function($qq) use ($search){
            $qq->where('code', 'like', "%$search%")
               ->orWhere('customer_name', 'like', "%$search%")
               ->orWhere('customer_email', 'like', "%$search%");
        });
    }

    $orders = $q->paginate(20)->withQueryString();

    return view('orders.index', compact('orders'));
}


    public function show(Order $order)
    {
        $order->load('items.product','user');

        return view('orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => ['required','in:new,processing,shipped,completed,cancelled'],
            'payment_status' => ['nullable','in:pending,paid,failed'],
        ]);

        $order->update($data);

        return back()->with('success', __('messages.updated'));
    }
   



public function pdf(Order $order)
{
    $order->load(['items', 'user']);

    $pdf = Pdf::loadView('orders.single-pdf', compact('order'))
        ->setPaper('A4', 'portrait');

    return $pdf->download("order-{$order->code}.pdf");
}


}
