<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $uuid)
 * @method static create(array $array)
 */
class Coupon extends Model
{
    use HasFactory;

    protected $guarded = [] ;
}
