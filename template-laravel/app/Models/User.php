<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    
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

    public function posts(){
        return $this->hasMany('App\Model\Post');
    }

    public function comments(){
        return $this->hasMany('App\Model\Comment');
    }

    public function reports(){
        return $this->hasMany('App\Model\Report');
    }

    public function reportsAnalysed(){
        //testar se é admin
        return $this->hasMany('App\Model\Report');
    }
}


