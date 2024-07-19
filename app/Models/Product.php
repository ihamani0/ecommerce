<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static active()
 * @method static where(string $string, mixed $id)
 */
class Product extends Model
{
    use HasFactory;

    protected $guarded = [];




    /*-----------Section of RelationShip's---------------------------------------*/
   //brand
    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brand::class , "brands_id" , 'id');
    }
    //vendor
    public function vendor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    //category
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    //subcategory
    public function subcategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function MultiplImg() : \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(MultiImageProduct::class , "product_id" , "id");
    }

    //Comment
    public function comments() : \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(review::class , "product_id" , "id")->where('status' , 1);
    }


    /*-----------Section of Query's---------------------------------------*/
    //query Scope
    public function scopeActive($query){
        return $query->where('status', 1);
    }
    //query this query to get all product that related to same product from subcategories
    public function getProductsInSameSubcategory(): \Illuminate\Support\Collection
    {
        if ($this->subcategory) {
            return $this->subcategory->products->where('products_uuid', '!=', $this->products_uuid);
        }
        return collect(); // Return an empty collection if no subcategory
    }

    public function avgRating($decimals=2): float
    {
        return round($this->comments()->avg('rating'), $decimals);
    }


    /*--------------------------------------------------*/
    //explode color
    public function colors(): ?array
    {
        if($this->product_color){
            return explode("," , $this->product_color);
        }
        return null;
    }
    //explode sizes
    public function sizes(): ?array
    {
        if($this->product_size){
            return explode("," , $this->product_size);
        }
        return null;
    }
    //explode tags
    public function tags(): ?array
    {
        if($this->product_tags){
            return explode("," , $this->product_tags);
        }
        return null;
    }
    /*--------------------------------------------------*/


    /*--------------------------------------------------*/
    //Relations Many to Many users and Products with table pivot wishList
    /*--------------------------------------------------*/
    public function wishlistedBy(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'wishlists', 'product_id', 'user_id')
            ->withTimestamps();
    }
}
