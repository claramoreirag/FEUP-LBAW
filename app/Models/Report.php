<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Report extends Model
{
    use HasFactory;

    protected $table = 'report';

    public $timestamps = false;
    protected $fillable = ['user_id', 'date', 'state', 'comment_id', 'post_id', 'admin_id',];

    

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'date' => 'datetime',
        'state' => 'string',
        'comment_id' => 'integer',
        'post_id' => 'integer',
        'admin_id' => 'integer'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function comment(){
        return $this->belongsTo('App\Models\Comment', 'comment_id');
    }

    public function post(){
        return $this->belongsTo('App\Models\Post', 'post_id');
    }

    public function admin(){
        return $this->belongsTo('App\Models\User', 'admin_id');
    }

    public function state(){
        return $this->state;
    }

 
}
