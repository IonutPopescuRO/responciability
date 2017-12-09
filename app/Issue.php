<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $table = 'issues';

    protected $fillable = ['title','description','lat','lng','user_id','image', 'status', 'address'];

    public function creator()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function ratings()
    {
    	return $this->hasMany('App\Vote', 'issue_id');
    }

    public function upvotes()
    {
    	return $this->ratings()->where(['type' => 1])->get();
    }

    public function downvotes()
    {
    	return $this->ratings()->where(['type' => 0])->get();
    }


}
