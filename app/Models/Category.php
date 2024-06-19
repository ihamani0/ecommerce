<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static orderBy(string $string, string $string1)
 * @method static where(string $string, $uuid)
 */
class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['category_name', "category_slug", "category_img"];


    public function subcategories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Subcategory::class, 'category_id', 'id');
    }

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class , "category_id" , "id");
    }


    public function countProductsForEachCategory(){
        return $productCount = $this->subcategories->sum(function($subcategory){
                return $subcategory->products->count();
            });
    }//end function  countProductsForEachCategory
}
