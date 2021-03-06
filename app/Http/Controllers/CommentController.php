<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Post;
use DateTime;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{

    /*This gets all the comments from a post*/
    public static function getAllFromPost($post_id)
    {
        $cmts=Comment::where('post_id','=',$post_id)->where('comment_id','=',null)->orderBy('datetime','desc')->get();
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

    /*Editing, posting and replying to a comment using ajax: */

    public function newComment(Request $request){
        $comment = new Comment();
      
        $this->authorize('create', $comment);
        $comment->user_id = Auth::id();
        $comment->body = $request->input('body');
        $comment->post_id = $request->input('post_id');
        
        $comment->save();
        $c=Comment::find($comment->id);
        $replies=Comment::where('comment_id','=',$c->id)->get();
        $comment=array();
        $comment['info']=$c;
        $comment['replies']=$replies;
        $view=view('partials.comment',['comment'=>$comment])->render();
  
        
        return response()->json(['success'=>'Form is successfully submitted!','comment'=>$view]);
    }

    public function editComment(Request $request,$comment_id){
     
        $comment = Comment::find($comment_id);
     

         $comment->body = $request->input('body');
         $comment->save();
       
         if($request->ajax()){
             return response()->json(['success'=>'Form is successfully submitted!','comment'=>$comment->body]);
        }
        else{ 
            return redirect('/post/'.$request->input('post_id'));
        }
    }

    public function replyComment(Request $request){

        $comment = new Comment();
       
        
        $this->authorize('create', $comment);
        $comment->user_id = Auth::id();
        $comment->body = $request->input('body');
        $comment->post_id = $request->input('post_id');
        $comment->comment_id = $request->input('comment_id');
        $comment->save();
        $c=Comment::find($comment->id);
        $view=view('partials.reply',['comment'=>$c])->render();
  
        if($request->ajax()){
            
            return response()->json(['success'=>'Form is successfully submitted!','comment'=>$view]);
           
        }
        else{ return redirect('/post/'.$request->input('post_id'));
        }
    }

    
    public static function getComment($id) {
        $comment = Comment::find($id);
        if (is_null($comment)) {
            return response()->json([
                'status' => 'failure',
                'status_code' => 404,
                'message' => 'Not Found',
                'errors' => ['comment' => 'There is no comment with id ' . $id],
            ], 404);
        }

        if ($comment->user_id !== null) {
            
            $comment_author = [
                'id'=> $comment->user->id,
                'name'=> $comment->user->name,
                'username' => $comment->user->username,
                'photo' => $comment->user->photo,
            ];
        }
        
        return response()->json([
            'id' => $comment->id,
            'datetime' => $comment->datetime,
            'body' => $comment->body,
            'author' => $comment_author,
            'post_id' =>$comment->post_id,
            'comment_id'=>$comment->comment_id
            
           

        ], 200);

    }


    /*Deleting a comment, this action cannot be undon*/
  public function deleteComment(Request $request, $id)
  {
    $comment = Comment::find($id);
   
  
    
    $comment->delete();
    if($request->ajax()){
        
        return response()->json(['success'=>'Form is successfully submitted!']);
    }
    else{ return redirect('/post/'.$request->input('post_id'));
    }
    }



/*Reporting a comment*/
  public function reportComment($id){
    ReportController::createCommentReport(Auth::id(),$id);
    $comment = Comment::find($id);
    return redirect('/post/'.$comment->post_id);
  }





}