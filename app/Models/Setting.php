<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static updateOrCreate(string[] $array, int[] $array1)
 * @method static first()
 */
class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];



    public function social(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SocialMedia::class , 'config_id' , 'id');
    }
}
