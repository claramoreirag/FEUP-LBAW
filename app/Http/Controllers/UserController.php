<?php

namespace App\Http\Controllers;

use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Source;
use App\Models\Post;
use App\Models\User;
use App\Models\FollowCategory;
use App\Models\Category;
use DateTime;
use Laravel\Ui\Presets\React;

class UserController extends Controller
{

  public function searchUsers(Request $request){
    
    $users = User::where('username', 'like', '%' . $request->get('searchQuery') . '%' )->get();

    return json_encode($users);
  }

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

      $request->validate([
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'oldPassword' => 'required|min:6',
        'password'=>'min:6|same:password_confirmation',
        'password_confirmation'=>'min:6|same:password_confirmation'
      ]);
      
      $id = Auth::id();
      $user = User::find($id);

      var_dump($request->file);
      if(password_verify($request->input('oldPassword'), $user->password)){
      if($request->input('image')!=null){
        $imageName = Auth::id().'.'.$request->file->extension();
        $request->file->move(public_path('img/profile'), $imageName);
        $user->photo=$imageName;
      }
      if($request->input('username')!=null){
        $user->username = $request->input('username');
      }
      if($request->input('name')!=null){
        $user->name = $request->input('name');
      }
      if($request->input('password')!=null){
        if($request->input('password')==$request->input('password_confirmation')){
          $user->password = bcrypt($request->password);
      
        }

      }
    }
    
      $user->save();
     // return redirect('/user/'.Auth::id());
    }




    public function followCategory(Request $request){
      $cat= new FollowCategory();
      $cat->user_id=Auth::id();
      $category=Category::where('name','=',$request->category)->first();
    
      $cat->category_id=$category->id;
      $cat->save();

      return redirect('authuserfeed');
    }

    public function unfollowCategory(Request $request){
     
      $category=Category::where('name','=',$request->category)->first();
      $cat= FollowCategory::where('user_id','=',Auth::id())->where('category_id','=',$category->id)->first();
      $cat->delete();

      return redirect('authuserfeed');
    }


    public static function alreadyFollowCat( $cat){
      $category=Category::where('name','=',$cat)->first();
      if (FollowCategory::where('user_id','=',Auth::id())->where('category_id','=',$category->id)->exists()) {
        return true;
     }
     else return false;
    }
}