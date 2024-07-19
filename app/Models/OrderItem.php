<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, $uuid)
 * @method static whereHas(string $string, \Closure $param)
 */
class OrderItem extends Model
{
    use HasFactory;
    protected $guarded =[];


    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class , 'product_uuid' , 'products_uuid');
    }

    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order::class , 'order_id' , 'id');
    }

}
