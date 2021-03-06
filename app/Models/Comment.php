<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comment';
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'post_id', 'comment_id', 'body', 'date_time', 'isvisible',
    ];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'post_id' => 'integer',
        'body' => 'string',
        'datetime' => 'datetime',
        'comment_id' => 'integer',
        'isvisible'=> 'boolean'
    ];

    public function post(){
        return $this->belongsTo('App\Models\Post', 'post_id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function reports(){
        return $this->hasMany('App\Models\Report');
    }

    public function isVisible(){
        return $this->isvisible;
    }
}
