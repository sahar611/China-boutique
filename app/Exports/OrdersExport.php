<?php
namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Order::select('code','customer_name','customer_email','total','payment_method','payment_status','status','placed_at')->latest()->get();
    }

    public function headings(): array
    {
        return ['Code','Customer','Email','Total','Payment Method','Payment Status','Status','Date'];
    }
}
