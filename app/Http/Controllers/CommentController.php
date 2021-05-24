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
        //$this->authorize('storeNewcomment', $comment);
        
        
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
        //var_dump($request);

        $comment = Comment::find($request->input('comment_id'));
        $this->authorize('update', $comment);
    
         $comment->body = $request->input('body');
         $comment->save();
       

        return response()->json(['success'=>'Form is successfully submitted!','comment'=>$comment->body]);
       // return response()->json(['success'=>'Form is successfully submitted!']);
        // return response()->json(['success'=>'Form is successfully submitted!','comment'=>$view]);
        
       
       
        //return redirect('/post/'.$request->input('post_id'));
    }

    public function replyComment(Request $request){

        $comment = new Comment();
        //$src = Source().create($request->input('source'));
        //$this->authorize('storeNewcomment', $comment);
        
        $this->authorize('create', $comment);
        $comment->user_id = Auth::id();
        $comment->body = $request->input('body');
        $comment->post_id = $request->input('post_id');
        $comment->comment_id = $request->input('comment_id');
        $comment->save();
        $c=Comment::find($comment->id);
        $view=view('partials.reply',['comment'=>$c])->render();
  
        return response()->json(['success'=>'Form is successfully submitted!','comment'=>$view]);
        
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


    
  public function deleteComment(Request $request, $id)
  {
    $comment = Comment::find($id);
   
    $this->authorize('delete', $comment);
    
    $comment->delete();
    return response()->json(['success'=>'Form is successfully submitted!']);
    // return redirect('/post/'.$request->input('post_id'));
  }



  public function reportComment($id){
    ReportController::createCommentReport(Auth::id(),$id);
    
  }





}