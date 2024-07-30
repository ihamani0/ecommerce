<?php

namespace App\Http\Resources\Backend;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
           'unreadNotificationCount' => $this->unreadNotifications()->count(),
           'unreadNotification' =>  NotificationResource::collection($this->unreadNotifications),
        ];
    }
}
