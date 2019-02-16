<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */    
    protected $fillable = [
        'name', 'denomination', 'cif', 'email',
    ];

    /**
     * The users that belong to the company.
     */
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
    
    public function delegations()
    {
        return $this->hasMany('App\Delegation');
    }

    public function departments()
    {
        return $this->hasMany('App\Department');
    }

}
