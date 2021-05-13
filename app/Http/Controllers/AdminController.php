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

         foreach($r as $n){
             $p=ReportController::getReport($n->id);
             if(json_decode($p->getContent())->comment!= null){
                array_push($reportedComments,json_decode($p->getContent()));
             }
             else{
                array_push($reportedPosts,json_decode($p->getContent()));
             }
         }
        return view('pages.admindashboard', ['reportedPosts' => $reportedPosts, 'reportedComments' => $reportedComments]);
        
    }

}