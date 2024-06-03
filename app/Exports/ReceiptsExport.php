<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReceiptsExport implements WithHeadings,FromCollection, ShouldAutoSize
{

    protected $start_date;
    protected $end_date;

    public function __construct($start_date = null, $end_date = null)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = Order::query();

        if ($this->start_date) {
            $query->whereDate('created_at', '>=', $this->start_date);
        }

        if ($this->end_date) {
            $query->whereDate('created_at', '<=', $this->end_date);
        }

        $query->where('status', 'delivered')->where('payment_status', 'paid');

        return $query->get(['order_number', 'name', 'email', 'detail_address', 'quantity', 'created_at', 'delivery_date', 'total_amount', 'payment_method', 'payment_status', 'status']);
    }

    public function headings(): array
    {
        return [
            'Order No.',
            'Name',
            'Email',
            'Detail Address',
            'Quantity',
            'Date',
            'Delivery date',
            'Total Amount',
            'Payment Method',
            'Payment Status',
            'Status',
        ];
    }
}
