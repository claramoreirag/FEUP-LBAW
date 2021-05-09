<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Source;
use App\Models\Post;
use App\Models\User;
use DateTime;

class UserController extends Controller
{
    public function show($id)
    {
      $user = User::find($id);
     
      if(Auth::check() && Auth::id()==$id){
        $ownposts=array();
        foreach($user->posts as $p){
          array_push($ownposts,json_decode(PostController::getPost($p->id)->getContent()));

        }
        return view('pages.ownprofile', ['user' => $user,'ownposts'=>$ownposts]);
      }
      else{
        return view('pages.otherprofile', ['user' => $user]);
      }
    }
}