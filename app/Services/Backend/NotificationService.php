<?php

namespace App\Services\Backend;

use App\Models\Admin;
use App\Models\User;
use App\Notifications\BackendNotification;
use Illuminate\Support\Facades\Notification;

class NotificationService{


    public static function sendNotificationToAdmins($type , $message): void
    {
        //send notification to Admin and Vendor
        $admins = self::getAdminWithRoles();
        Notification::send($admins , new BackendNotification($type ,$message));

    }

    public static function getAdminWithRoles(){
        $roles = ['super-admin', 'admin'];
        return Admin::whereHas('roles' , function ($query) use ($roles){
            $query->whereIn('name' , $roles);
        })->get();
    }

    public static function sendNotificationToVendors($orderDetails , $type , $message): void
    {
        $vendorsIds = $orderDetails->orderItems->pluck('vendor_id')->unique();
        //send notification to Admin and Vendor
        $vendors  = self::getVendors($vendorsIds->toArray());
        Notification::send($vendors  , new BackendNotification($type ,$message));

    }
    public static function getVendors(Array $vendorIds){
        return User::whereIn('id' , $vendorIds)->get();
    }
}
