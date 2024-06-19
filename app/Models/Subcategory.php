<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $uuid)
 */
class Subcategory extends Model
{
    use HasFactory;


    protected $table = 'subcategories';
    protected $guarded =[];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->BelongsTo(Category::class);
    }

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class , 'subcategory_id' , 'id');
    }
}
