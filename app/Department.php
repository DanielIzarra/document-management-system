<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'company_id', 'delegation_id',
    ];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function delegation()
    {
        return $this->belongsTo('App\Delegation');
    }

    /**
     * The users that belong to the departments.
     */
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
