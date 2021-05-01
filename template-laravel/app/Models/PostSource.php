<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostSource extends Model
{
    use HasFactory;

    protected $table = 'post_source';

    public $timestamps = false;
    protected $fillable = ['post_id', 'source_id'];

    protected $casts = [
        'post_id' => 'integer',
        'source_id' => 'integer'
    ];

    public function source(){
        $this->belongsTo('App\Models\Source', 'source_id');
    }

    public function post(){
        $this->belongsTo('App\Models\Post', 'post_id');
    }
}
