<?php

namespace App\Services\Backend;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use JetBrains\PhpStorm\ArrayShape;

class ReportService{

    #[ArrayShape(['period' => "", 'start_date' => "", 'end_date' => "mixed", 'total_orders' => "int", 'total_amount' => "int|mixed", 'total_sales' => "int|mixed", 'total_customers' => "mixed"])]

    private function getBaseQuery($start_date , $end_date = null): \Illuminate\Database\Eloquent\Builder
    {
        $query = Order::query();
        if($end_date){
            $query->where('created_at', '>=', $start_date)
                ->where('created_at', '<=', Carbon::parse($end_date)->endOfDay());
        }else{
            $query->whereDate('created_at', '>=', $start_date)
                ->whereDate('created_at', '<', Carbon::parse($start_date)->addDay());
        }
        return $query;

    }
    private function getTotalCustomers($start_date , $end_date = null): int
    {
        try {
            $query = Order::query();
            if($end_date){
                $query->where('created_at', '>=', $start_date)
                                ->where('created_at', '<=', Carbon::parse($end_date)->endOfDay());
            }else{
                $query->whereDate('created_at', '>=', $start_date)
                            ->whereDate('created_at', '<', Carbon::parse($start_date)->addDay());
            }
            return $query->distinct('costumer_id')->count('costumer_id');
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function generateReport($period, $start_date, $end_date = null): array
    {

        $query = $this->getBaseQuery( $start_date, $end_date);

        return [
            'period' => $period,
            'start_date' => $start_date,
            'end_date' => $end_date ?? $start_date,
            'total_orders' => $query->count(),
            'total_amount' => $query->sum('amount'),
            'total_sales' => $query->sum('amount'), // Assuming sales are the same as total amount
            'total_customers' => $this->getTotalCustomers($start_date, $end_date),
            'order'=>$query->with('orderItems')->get()
        ];

    }

    //dailyReport
    public function dailyReport($date)
    {
        return $this->generateReport('daily', $date);
    }

    public function weeklyReport($week)
    {
        // Extract year and week number from the input (e.g., "2024-W52")
        list($year, $weekNumber) = explode('-W', $week);
        // Create a Carbon instance for the first day of the year
        $startOfYear = Carbon::parse($year . '-01-01');
        // Get the start date of the specified week
        $start_date = $startOfYear->startOfWeek()->addWeeks($weekNumber - 1);
        // Calculate the end date of the week
        $end_date = $start_date->copy()->addDays(6);

        return $this->generateReport('weekly', $start_date, $end_date);
    }

    public function monthlyReport($date)
    {
        // Explode the input date string "YYYY-M" into year and month
        list($year, $month) = explode('-', $date);

        $start_date = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $end_date = $start_date->copy()->endOfMonth();
        return $this->generateReport('monthly', $start_date, $end_date);
    }

    public function yearlyReport($year)
    {
        $start_date = Carbon::createFromDate($year, 1, 1)->startOfYear();
        $end_date = $start_date->copy()->endOfYear();
        return $this->generateReport('yearly', $start_date, $end_date);
    }




}
