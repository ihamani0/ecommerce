<?php

namespace App\Services\Frontend;

use App\Contracts\Frontend\OrderInterface;
use App\Mail\OrderPlaced;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderService{
    // Define your service methods here
    public function __construct(public OrderInterface $cashRepo)
    {}

    public function storeOrder(Collection $order, $sessionData): void
    {

        try {
            DB::beginTransaction();

            // Store the order in the database and retrieve orderId
            $orderID = $this->cashRepo->storeOrder($order, $sessionData);

            //  retrieve The details of  order
            $orderDetail = $this->cashRepo->getOrderById($orderID);

            // Send confirmation email to the user
            Mail::to($order->get('email'))->send(new OrderPlaced($orderDetail));

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            // Log the exception message and stack trace
            Log::error('Order placement failed: ' . $exception->getMessage());
            Log::error('Stack trace: ' . $exception->getTraceAsString());
            // Rethrow the exception with the original message for further handling if needed
            throw new \Exception("An error occurred while placing the order (OrderService): " . $exception->getMessage());

        }

    }
}
