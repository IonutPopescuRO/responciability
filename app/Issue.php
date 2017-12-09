<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $table = 'issues';

    protected $fillable = ['title','description','lat','lng','user_id','image'];

    public function creator()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }
}
