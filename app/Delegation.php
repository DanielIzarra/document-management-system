<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delegation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'company_id'
    ];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    /**
     * The users that belong to the delegation.
     */
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
