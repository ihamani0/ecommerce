<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, mixed $id)
 * @method static create(array $array)
 */
class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id' , 'product_uuid'] ;




}
