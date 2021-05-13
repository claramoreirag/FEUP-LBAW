<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Post;
use DateTime;

class CommentController extends Controller
{

    public static function getAllFromPost($post_id)
    {
        $cmts=Comment::where('post_id','=',$post_id)->where('comment_id','=',null)->get();
        $comments= array();
        foreach ($cmts as $c){
                $replies=Comment::where('comment_id','=',$c->id)->get();
                $comment=array();
                $comment['info']=$c;
                $comment['replies']=$replies;
                array_push($comments,$comment);
            }
            
      
      return $comments;
    }

    public function newComment(Request $request){
        $comment = new Comment();
        //$src = Source().create($request->input('source'));
        //$this->authorize('storeNewPost', $post);
        
        
  
        $comment->user_id = Auth::id();
        $comment->body = $request->input('body');
        $comment->post_id = $request->input('post_id');
        
        $comment->save();
        
  
        return redirect('/post/'.$request->input('post_id'));
    }

    public function replyComment(Request $request){
        $comment = new Comment();
        //$src = Source().create($request->input('source'));
        //$this->authorize('storeNewPost', $post);
        
    
        $comment->user_id = Auth::id();
        $comment->body = $request->input('body');
        $comment->post_id = $request->input('post_id');
        $comment->comment_id = $request->input('comment_id');
        $comment->save();
        
  
        return redirect('/post/'.$request->input('post_id'));
    }
    
}