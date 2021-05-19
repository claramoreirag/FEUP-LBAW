<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;
use App\Models\Comment;
use App\Models\Post;
use DateTime;

class ReportController extends Controller
{
   /**
   * Shows all posts.
   *
   * @return Response
   */
  public function list()
  {
    $reports = Report::all();
  }


  public function delete(Request $request, $id)
  {
   // $post = Post::find($id);

    // $this->authorize('delete', $card);
    //$post->delete();
   // return redirect()->route('profile',['user_id'=>Auth::id()]);
   
  }

    public static function getReport($id) {
        $report = Report::find($id);
        if (is_null($report)) {
            return response()->json([
                'status' => 'failure',
                'status_code' => 404,
                'message' => 'Not Found',
                'errors' => ['post' => 'There is no post with id ' . $id],
            ], 404);
        }

        $report_author = null;
        // if post has no author (account deleted)
        //var_dump($post);
        if ($report->user_id !== null) {
            $report_author = [
                'id'=> $report->user->id,
                'name'=> $report->user->name,
                'username' => $report->user->username,
                'photo' => $report->user->photo,
            ];
        }

        $admin_resp = null;
        // if post has no author (account deleted)
        //var_dump($post);
        if ($report->admin_id !== null) {
            $admin_resp = [
                'id'=> $report->admin->id,
                'name'=> $report->admin->name,
                'username' => $report->admin->username,
                'photo' => $report->admin->photo,
            ];
        }

        
        $timesReported=null;

        $comment = null;
        if ($report->comment_id !== null) {
            $comment = [
                'id'=> $report->comment->id,
                'user' => $report->comment->user,
                'post' => $report->comment->post,
                'body' =>$report->comment->body,
                'datetime' => $report->comment->datetime,
            ];
            $contagem = Report::select('comment_id', DB::raw('count(*) as total'))->groupBy('comment_id')->where('comment_id','<=',$report->comment->id)->get();
            $timesReported=$contagem[0]["total"];
        }

        $post = null;
        if ($report->post_id !== null) {
            $post = [
                'id'=> $report->post->id,
                'datetime' => $report->post->datetime,
                'user' => $report->post->author,
                'title' => $report->post->title,
                'header' => $report->post->header,
                'body' =>$report->post->body,
                'category' =>$report->post->category,
                'upvotes' => $report->post->upvotes,
                'downvotes' => $report->post->downvotes
            ];
          
            $contagem = Report::select('post_id', DB::raw('count(*) as total'))
            ->groupBy('post_id')
            ->where('post_id','<=',$report->post->id)
            ->get();
            $timesReported=$contagem[0]["total"];
        }

        return response()->json([
            'id' => $report->id,
            'user' => $report_author,
            'date' => $report->datetime,
            'comment' => $comment,
            'post' => $post,
            'admin' =>  $admin_resp,
            'number' => $timesReported
        ], 200);

    }    



    public static function createPostReport($user_id, $post_id)
    {
        $report=new Report();
        $report->user_id=$user_id;
        $report->state='NotAnswered';
        $report->post_id=$post_id;
        $report->save();
    
    }

    public static function createCommentReport($user_id, $comment_id)
    {
        $report=new Report();
        $report->user_id=$user_id;
        $report->state='NotAnswered';
        $report->comment_id=$comment_id;
        $report->save();
    
    }

    public static function postAlreadyReported($user_id,$post_id){
        if (Report::where('post_id', '=', $post_id)->where('user_id', '=', $user_id)->exists()) {
            return true;
         }
         else return false;
    }

    public static function commentAlreadyReported($user_id,$comment_id){
        if (Report::where('comment_id', '=', $comment_id)->where('user_id', '=', $user_id)->exists()) {
            return true;
         }
         else return false;
    }

}