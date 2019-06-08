<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'importance_order', 'colour', 'description',
    ];
        
    public function documents()
    {
        return $this->hasMany('App\Document');
    }
}
