<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;


class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory,   Notifiable , HasRoles;

    protected $guard = "admin";

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'last_activity' => 'datetime',
    ];

    //check Admin is online
    public function isOnline(): bool
    {
        return $this->last_activity && $this->last_activity->gt(Carbon::now()->subMinutes(5));
    }

}
