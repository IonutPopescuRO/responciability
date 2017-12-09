<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table='comments';

    protected $fillable= ['user_id','body','issue_id'];

    public function creator()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }
}
