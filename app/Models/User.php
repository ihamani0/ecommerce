<?php

namespace App\Models;

use App\Notifications\Auth\VerifyEmailUser;
use Carbon\Carbon;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail as IMustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property mixed $id
 * @method static where(string $string, string $string1, Carbon $subMinutes)
 */
class User extends Authenticatable implements IMustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable , MustVerifyEmail , HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'role',
        'phone_number' ,
        'street_address',
        'city',
        'postal_code',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_activity' => 'datetime',
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailUser);
    }

    //query Scope
    public function scopeActive($query){
        return $query->where('status', 1);
    }

    //relationship hasMany
    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class , "vendor_id" , 'id');
    }


    //Relations Many to Many users and Products with table pivot wishList
    public function wishlist(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'wishlists' , 'user_id'  , 'product_id')
            ->withTimestamps();
    }

    //Relations Many to Many users and Products with table pivot wishList
    public function compare(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'compares' , 'user_id'  , 'product_id')
            ->withTimestamps();
    }


    //check user is online
    public function isOnline(): bool
    {
        return $this->last_activity && $this->last_activity->gt(Carbon::now()->subMinutes(5));
    }
}
