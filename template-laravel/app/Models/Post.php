<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'post';
    protected $fillable = ['datetime','user_id', 'title', 'header', 'body', 'category', 'upvotes', 'downvotes'];

    protected $casts = [
        'id' => 'integer',
        'datetime' => 'datetime',
        'user_id' => 'integer',
        'title' => 'string',
        'header' => 'string',
        'body' => 'string',
        'category' => 'integer',
        'upvotes' => 'integer',
        'downvotes' => 'integer'
    ];

    public function comments(){
        return $this->hasMany('App\Model\Comment');
    }    

    public function author(){
        return $this->belongsTo('App\Model\User', 'user_id');
    }

    public function category(){
        return $this->belongsTo('App\Model\Category', 'category');
    }


    public function sources(){
        return $this->hasMany('App\Model\PostSource');
    }
    


}
