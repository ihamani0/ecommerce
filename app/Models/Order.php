<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static insertGetId(array $array)
 * @method static find($orderId)
 * @method static where(string $string, $orderId)
 * @method static orderBy(string $string, string $string1)
 */
class Order extends Model
{
    use HasFactory;
    protected $guarded =[];


    public function orderItems(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderItem::class , 'order_id' , 'id');
    }

    public function getTotalAmount():float
    {
        return $this->orderItems->sum(function ($item){
            return $item->price * $item->qty;
        });
    }

    public function  user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class , 'costumer_id' , 'id');
    }

}
