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

  public function searchUsers(Request $request){
    
    $users = User::where('username', 'like', '%' . $request->get('searchQuery') . '%' )->get();

    return json_encode($users);
  }

    public function show($id)
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

      $upvoted_posts=array();
      foreach ($upvoted_posts_ids as $up) {
        $p = PostController::getPost($up->id);
        array_push($upvoted_posts, json_decode($p->getContent()));
      }

      if(Auth::check() && Auth::id()==$id){
        $ownposts=array();
        foreach($user->posts as $p){
          array_push($ownposts,json_decode(PostController::getPost($p->id)->getContent()));

        }
        return view('pages.ownprofile', ['user' => $user,'ownposts'=>$ownposts, 'followers'=>$followers, 'following'=>$following, 'posts'=>$posts, 'upvotes'=>$count_upvotes, 'savedPosts' => $saved_posts, 'upvotedPosts' => $upvoted_posts]);
      }
      else{
        $otherposts = array();
        foreach ($user->posts as $p) {
          array_push($otherposts, json_decode(PostController::getPost($p->id)->getContent()));
        }

        return view('pages.otherprofile', ['user' => $user, 'otherposts'=> $otherposts, 'followers' => $followers, 'following' => $following, 'posts' => $posts, 'upvotes' => $count_upvotes, 'savedPosts' =>$saved_posts, 'upvotedPosts' => $upvoted_posts]);
      }
    }


    
  public function delete(Request $request)
  {
    $user =User::find(Auth::id());

    $user->delete();
    return redirect()->route('homepage');
   
  }

    public function showEditProfile(){
      //TODO
      $id = Auth::id();
    }

    public function editProfile(Request $request){
      //TODO
      //Falta testar se a old password corresponde à que ele tem
      //Falta ver como atualizar a palavra passe
      $id = Auth::id();
      $user = User::find($id);
      $user->username = $request->username;
      $user->name = $request->name;
      $user->password = $request->password;
      $user->save();

    }
}