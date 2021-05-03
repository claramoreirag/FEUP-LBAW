<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'post';
    protected $fillable = ['datetime','user_id', 'title', 'header', 'body', 'category_id', 'upvotes', 'downvotes'];

    protected $casts = [
        'id' => 'integer',
        'datetime' => 'string',
        'user_id' => 'integer',
        'title' => 'string',
        'header' => 'string',
        'body' => 'string',
        'category_id' => 'integer',
        'upvotes' => 'integer',
        'downvotes' => 'integer'
    ];
 

    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }    

    public function author(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }


    public function sources(){
        return $this->hasMany('App\Models\PostSource');
    }
    
    public function getSources(){
        $sources=array();
        foreach($this->sources as $s){
            $source =Source::find($s->source_id);
            array_push($sources, $source->name);
        }
    }


}
