<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $table = 'listings';

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'listing_categories', 'listing_id', 'category_id');
    }

    public function levels()
    {
        return $this->belongsToMany('App\Models\Level', 'listing_levels', 'listing_id', 'level_id');
    }

    public function openingtimes()
    {
        return $this->hasMany('App\Models\OpeningTime');
    }

    public function gallery()
    {
        return $this->hasOne('App\Gallery', 'listing_id');
    }
}
