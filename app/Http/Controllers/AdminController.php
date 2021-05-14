<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
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
                array_push($reportedComments,json_decode($p->getContent()));
             }
             else{
                array_push($reportedPosts,json_decode($p->getContent()));
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

    public function viewPost() {
        return view('pages.fullpostadmin');
    }

}