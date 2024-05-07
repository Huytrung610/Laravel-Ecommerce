<?php

namespace App\Helpers\Backend;

use App\Models\Order;
use Carbon\Carbon;

class OrderHelper
{
    public function orderStatistic(){
        $order = new Order();
        
        $month = now()->month;
        $year = now()->year;
        $daysInMonth = Carbon::createFromDate($year, $month, 1)->daysInMonth;
        $allDays = range(1, $daysInMonth);
        $temp = Order::revenueCurrentMonth($month, $year);

        $label = [];
        $data = [];
        $temp2 = array_map(function($day) use ($temp, &$label , &$data){

            $found = collect($temp)->first(function($record) use ($day){
                return $record['day'] == $day;
            });

            $label[] = 'Day '.$day;
            $data[] = $found ? $found['daily_revenue'] : 0;
    

        }, $allDays);
        
        $revenueMonth = [
            'label' => $label,
            'data' => $data
        ];
        
        $previousMonth = ($month == 1) ? 12 : $month - 1;
        $previousYear = ($month == 1) ? $year - 1 : $year;
        
        $orderCurrentMonth = $order->getOrderByTime($month, $year);
        $orderPreviousMonth = $order->getOrderByTime($previousMonth, $previousYear);
        
        return [
            'orderCurrentMonth' => $orderCurrentMonth,
            'orderPreviousMonth' => $orderPreviousMonth,
            'grow' => $this->growth($orderCurrentMonth, $orderPreviousMonth),
            'revenueChart' => $this->convertRevenueChartData(Order::revenueByYear($year)),
            'revenueWeek' => $this->convertRevenueChartData(Order::revenue7Day(), 'daily_revenue', 'date', ''),
            'revenueMonth' => $revenueMonth
        ];
    }
    
    public function growth($currentValue, $previousValue){
        $division = ($previousValue == 0) ? 1 : $previousValue;
        $grow = ($currentValue - $previousValue ) / $division * 100;
        return number_format($grow, 1);
    }
    public function cancellationRate($successfulOrders, $cancelledOrders) {
        if ($successfulOrders == 0) {
            return 0; 
        }
        $rate = ($cancelledOrders / $successfulOrders) * 100;
        return number_format($rate, 1);
    }

    public function growHtml($grow){
        if($grow > 0) {
            return '<span class="tw-text-xs tw-text-blue-400">'.$grow.'%</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#3B82F6" class="tw-w-4 tw-h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
            </svg>';
        } else{
            return '<span class="tw-text-xs tw-text-red-400">'.$grow.'%</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#F87171" class="tw-w-4 tw-h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6 9 12.75l4.286-4.286a11.948 11.948 0 0 1 4.306 6.43l.776 2.898m0 0 3.182-5.511m-3.182 5.51-5.511-3.181" />
            </svg>';
        }
    }

    public function convertRevenueChartData($chartData, $data = 'monthly_revenue' ,$label = 'month', $text = 'Month'){
        $newArray = [];
        if(!is_null($chartData) && count($chartData)){
            foreach($chartData as $key => $val){
                $newArray['data'][] =  $val->{$data};
                $newArray['label'][] =  $text.' '.$val->{$label};

            }
        }
        return $newArray;
    }
}