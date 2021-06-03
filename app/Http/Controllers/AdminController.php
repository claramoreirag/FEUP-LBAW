<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CommentController;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller {

    public function show() {
        $this->authorize('show');
         $r = Report::all();
       
         $reportedPosts=array();
         $reportedComments=array();

        //get all reports
        foreach($r as $n){
             $p=ReportController::getReport($n->id);
             if(json_decode($p->getContent())->comment!= null){
                if(json_decode($p->getContent())->state=='NotAnswered'){
                array_push($reportedComments,json_decode($p->getContent()));
                }
             }
             else{
                if(json_decode($p->getContent())->state=='NotAnswered'){
                    array_push($reportedPosts,json_decode($p->getContent()));
                }
             }
        } 

        //show list correctly
        $post_ids=array();
        $reportedPostsFinal=array();
        foreach($reportedPosts as $rp){
            if(!in_array($rp->post->id,$post_ids)){
                array_push($reportedPostsFinal,$rp);
                array_push($post_ids,$rp->post->id);
            }
        }

        $comment_ids=array();
        $reportedCommentsFinal=array();
        foreach($reportedComments as $rc){
            if(!in_array($rc->comment->id,$comment_ids)){
                array_push($reportedCommentsFinal,$rc);
                array_push($comment_ids,$rc->comment->id);
            }
        }

        return view('pages.admindashboard', ['reportedPosts' => $reportedPostsFinal, 'reportedComments' => $reportedCommentsFinal]);
    }

    public function showUsers() {
        $users = User::all();
        $usersFinal = array();
        foreach($users as $u){
            if(!$u->isAdmin()){
                array_push($usersFinal,$u);
            }
        }
        return view('pages.usermanager',['users' => $usersFinal]);
    }

    public function paginate($items, $perPage = 5, $page = null, $options = []){
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function showUser($id)
  {
      $user = User::find($id);
      $followers = $user->followers()->get()->count();
      $following = $user->following()->get()->count();
      $posts = $user->posts()->get()->count();
      $saved_posts_ids = $user->savedPosts()->get();
      $upvoted_posts_ids = $user->upvotedPosts()->get();
    
      $post_list = $user->posts()->get();
      $count_upvotes = 0;
      foreach($post_list as $p){
        $count_upvotes += $p->upvotes;
      }

      $saved_posts = array();
      foreach($saved_posts_ids as $sp){
        $p = PostController::getPost($sp->id);
        array_push($saved_posts, json_decode($p->getContent()));
      }
      $savedp=$this->paginate($saved_posts);
      $savedp->withPath('');
      $upvoted_posts=array();
      foreach ($upvoted_posts_ids as $up) {
        $p = PostController::getPost($up->id);
        array_push($upvoted_posts, json_decode($p->getContent()));
      }
      $upp=$this->paginate($upvoted_posts);
      $upp->withPath('');
    
        $otherposts = array();
        foreach ($user->posts as $p) {
          array_push($otherposts, json_decode(PostController::getPost($p->id)->getContent()));
        }
        $op=$this->paginate($otherposts);
        $op->withPath('');
        return view('pages.otherprofileadmin', ['user' => $user, 'otherposts'=> $op, 'followers' => $followers, 'following' => $following, 'posts' => $posts, 'upvotes' => $count_upvotes, 'savedPosts' =>$saved_posts, 'upvotedPosts' => $upp]);
      
    }

    public function viewPost($id) {
        $p=PostController::getPost($id);
        $post = json_decode($p->getContent());
        $comments=CommentController::getAllFromPost($id);
        return view('pages.fullpostadmin',['post' => $post, 'comments'=>$comments]);
    }

    public function viewComment($post_id,$comment_id) {
        $p=PostController::getPost($post_id);
        $post = json_decode($p->getContent());
        $comments=CommentController::getAllFromPost($post_id);
        
        $cmts=Comment::find($comment_id);
        $commentt= array();
        $replies=Comment::where('comment_id','=',$cmts->id)->get();
        $co=array();
        $co['info']=$cmts;
        $co['replies']=$replies;
        array_push($commentt,$co);
        
        return view('pages.fullcommentadmin',['post' => $post, 'comments'=>$comments, 'comment'=>$commentt, 'justcomment'=>$co]);
    }

    public function undoAction($report_id) {
        //TODO visibles

        $report=ReportController::getReport($report_id);
        $re=Report::all();
        if(json_decode($report->getContent())->comment!= null){
            $id=json_decode($report->getContent())->comment->id;
            foreach($re as $n){
              $r=ReportController::getReport($n->id);
              $cm=json_decode($r->getContent())->comment;
              if($cm!=null){
              if($cm->id==$id){
                $rr=Report::find($n->id);
                $com=Comment::find($cm->id);
                $com->setAttribute('isvisible',true);
                $com->save();
                $rr->setAttribute('state', 'NotAnswered');
                $rr->save();
              }
            }
        }
        }
        else{
            $id=json_decode($report->getContent())->post->id;
            foreach($re as $n){
              $r=ReportController::getReport($n->id);
              $post=json_decode($r->getContent())->post;
              if($post!=null){
              if($post->id==$id){
                $rr=Report::find($n->id);
                $ppp=Post::find($post->id);
                $ppp->setAttribute('isvisible',true);
                $ppp->save();
                $rr->setAttribute('state', 'NotAnswered');
                $rr->save();
              }
            }
        }
        }
        
        return redirect()->route('reports');
    }

    public function updateDashboard(Request $request){
        $val=$request->get('searchQuery');
        $r = Report::all();
        $reportedPosts=array();
        $reportedComments=array();

        if($val==1){
             //get all reports
            foreach($r as $n){
                $p=ReportController::getReport($n->id);
                if(json_decode($p->getContent())->comment!= null){
                    if(json_decode($p->getContent())->state=='NotAnswered'){
                        array_push($reportedComments,json_decode($p->getContent()));
                    }
                }
                else{
                    if(json_decode($p->getContent())->state=='NotAnswered'){
                        array_push($reportedPosts,json_decode($p->getContent()));
                    }
                }
            } 
            //show list correctly
         $post_ids=array();
         $reportedPostsFinal=array();
         foreach($reportedPosts as $rp){
             if(!in_array($rp->post->id,$post_ids)){
                 array_push($reportedPostsFinal,$rp);
                 array_push($post_ids,$rp->post->id);
             }
         }
 
         $comment_ids=array();
         $reportedCommentsFinal=array();
         foreach($reportedComments as $rc){
             if(!in_array($rc->comment->id,$comment_ids)){
                 array_push($reportedCommentsFinal,$rc);
                 array_push($comment_ids,$rc->comment->id);
             }
         }

         return response()->json(['html'=>(view('partials.management.unhandled',['reportedPosts' => $reportedPostsFinal, 'reportedComments' => $reportedCommentsFinal])->render())]);

            
        }else{

            foreach($r as $n){
                $p=ReportController::getReport($n->id);
                if(json_decode($p->getContent())->comment!= null){
                    if(json_decode($p->getContent())->state!='NotAnswered'){
                        array_push($reportedComments,json_decode($p->getContent()));
                    }
                }
                else{
                    if(json_decode($p->getContent())->state!='NotAnswered'){
                        array_push($reportedPosts,json_decode($p->getContent()));
                    }
                   
                }
            }

        $post_ids=array();
         $reportedPostsFinal=array();
         foreach($reportedPosts as $rp){
             if(!in_array($rp->post->id,$post_ids)){
                 array_push($reportedPostsFinal,$rp);
                 array_push($post_ids,$rp->post->id);
             }
         }
 
         $comment_ids=array();
         $reportedCommentsFinal=array();
         foreach($reportedComments as $rc){
             if(!in_array($rc->comment->id,$comment_ids)){
                 array_push($reportedCommentsFinal,$rc);
                 array_push($comment_ids,$rc->comment->id);
             }
         }

         return response()->json(['html'=>(view('partials.management.handled',['reportedPosts' => $reportedPostsFinal, 'reportedComments' => $reportedCommentsFinal])->render())]);
            
        }
        
    }




}