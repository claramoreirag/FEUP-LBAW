<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Scout\Searchable;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

class User extends Authenticatable
{
    //use Searchable;
    use Notifiable;


    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'name', 'email', 'photo', 'state', 'is_admin',
    ];

    protected $attributes = [
        'photo' => 'default.png',
     ];

    protected $casts = [
        'id' => 'integer',
        'username' => 'string',
        'password' => 'string',
        'name' => 'string',
        'email' => 'string',
        'photo' => 'string',
        'state' => 'string',
        'is_admin' => 'boolean'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function searchableAs()
    {
        return 'username';
    }

    public function getScoutKey()
    {
        return $this->username;
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function posts(){
        return $this->hasMany('App\Models\Post');
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }

    public function reports(){
        return $this->hasMany('App\Models\Report');
    }

    public function reportsAnalysed(){
        //testar se é admin
        return $this->hasMany('App\Models\Report');
    }
   
    public function followers(){
        return $this->belongsToMany('App\Models\User', 'follow', 'followed', 'follower');
    }

    public function following()
    {
        return $this->belongsToMany('App\Models\User', 'follow', 'follower', 'followed');
    }

    public function savedPosts(){
        return $this->belongsToMany('App\Models\User', 'saved_post', 'user_id', 'post_id');
    }

    public function upvotedPosts(){
        return $this->belongsToMany('App\Models\User', 'post_vote', 'user_id', 'post_id')->where('is_up', '=', true);
    }

    public function state(){
        return $this->state;
    }

    public function followedCategories(){
        return $this->belongsToMany('App\Models\Category', 'follow_category', 'user_id', 'category_id');
    }


}