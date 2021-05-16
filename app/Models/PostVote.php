<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostVote extends Model
{
    use HasFactory;

    protected $table = 'post_vote';

    public $timestamps = false;
    protected $fillable = ['user_id', 'post_id', 'is_up',];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'post_id' => 'integer',
        'is_up' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id');
    }

}
