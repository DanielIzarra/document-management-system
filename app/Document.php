<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'filename', 'uri', 'delete',
    ];

    /**
     * The users that belong to the document.
     */
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    /**
     * The status that belong to the document.
     */
    public function state()
    {
        return $this->belongsTo('App\State');
    }
}
