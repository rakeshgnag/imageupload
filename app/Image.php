<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
   use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'images';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     
     */
    protected $fillable = [
        'title', 'image_uri_original','image_uri_cropped','categories'
    ];
}
