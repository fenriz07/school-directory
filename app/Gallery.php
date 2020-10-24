<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'listing_id',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'image_5',
    ];
}
