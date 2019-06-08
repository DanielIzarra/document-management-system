<?php

namespace App;

use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, ShinobiTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The companies that belong to the user.
     */
    public function companies()
    {
        return $this->belongsToMany('App\Company')->withTimestamps();
    }

    /**
     * The delegations that belong to the user.
     */
    public function delegations()
    {
        return $this->belongsToMany('App\Delegation')->withTimestamps();
    }

    /**
     * The departments that belong to the user.
     */
    public function departments()
    {
        return $this->belongsToMany('App\Department')->withTimestamps();
    }

    /**
     * The documents that belong to the user.
     */
    public function documents()
    {
        return $this->belongsToMany('App\Document')->withTimestamps();
    }
}
