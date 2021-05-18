<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    //use Searchable;
    use Notifiable;


    // Don't add create and update timestamps in database.
    public $timestamps  = false;
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'name', 'email', 'photo', 'user_state', 'is_admin',
    ];

    protected $casts = [
        'id' => 'integer',
        'username' => 'string',
        'password' => 'string',
        'name' => 'string',
        'email' => 'string',
        'photo' => 'string',
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

    // public function followedCategories(){
    //     return $this->h('App\Models\Category')
    // }
    

   
}


