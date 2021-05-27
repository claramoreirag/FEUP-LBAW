<?php

namespace App\Http\Controllers;

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
        return view('pages.usermanager');
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