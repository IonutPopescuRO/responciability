<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaOfInterest extends Model
{
    protected $table = 'user_area';

    protected $fillable = [
    	'lat','lng','user_id'
    ];

}
