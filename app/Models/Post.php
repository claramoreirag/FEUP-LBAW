<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'post';
    protected $fillable = ['datetime','user_id', 'title', 'header', 'body', 'category_id', 'upvotes', 'downvotes', 'isvisible',];

    protected $casts = [
        'id' => 'integer',
        'datetime' => 'datetime',
        'user_id' => 'integer',
        'title' => 'string',
        'header' => 'string',
        'body' => 'string',
        'category_id' => 'integer',
        'upvotes' => 'integer',
        'downvotes' => 'integer',
        'isvisible' => 'boolean'
    ];
 
    protected $attributes = [
        'photo' => 'default.png',
     ];



    public function comments(){
       
        return $this->hasMany('App\Models\Comment');
    }    


    public function getComments(){
        $cmts=Comment::where('post_id','=',$this->id)->where('comment_id','=',null)->get();
        $comments= array();
        foreach ($cmts as $c){
                $replies=Comment::where('comment_id','=',$c->id)->get();
                $comment=array();
                $comment['info']=$c;
                $comment['replies']=$replies;
                array_push($comments,$comment);
            }
            
      
        return collect($comments);
        //return $this->hasMany('App\Models\Comment');
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

    public function isVisible(){
        return $this->isvisible;
    }


}
