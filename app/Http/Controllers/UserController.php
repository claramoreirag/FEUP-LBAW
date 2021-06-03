<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\FollowCategory;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use DateTime;
use Laravel\Ui\Presets\React;
use App\Models\PostVote;

class UserController extends Controller
{

  public function searchUsers(Request $request){
    
    $users = User::where('username', 'like', '%' . $request->get('searchQuery') . '%' )->get();

    return json_encode($users);
  }


  public function searchUserManagement(Request $request){
    $users = User::where('username', 'like', '%' . $request->get('searchQuery') . '%' )->get();
    return response()->json(['html'=>view('partials.management.users',['users' => $users])->render()]);
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
        $postVisible=Post::find($sp->id);
          if($postVisible->isvisible){
        array_push($saved_posts, json_decode($p->getContent()));
          }
      }
      $savedp=$this->paginate($saved_posts);
      $savedp->withPath('');
      $upvoted_posts=array();
      foreach ($upvoted_posts_ids as $up) {
        $p = PostController::getPost($up->id);
        $postVisible=Post::find($up->id);
          if($postVisible->isvisible){
        array_push($upvoted_posts, json_decode($p->getContent()));
          }
      }
      $upp=$this->paginate($upvoted_posts);
      $upp->withPath('');
      if(Auth::check() && Auth::id()==$id){
        $ownposts=array();
        foreach($user->posts as $p){
          $postVisible=Post::find($p->id);
          if($postVisible->isvisible){
          array_push($ownposts,json_decode(PostController::getPost($p->id)->getContent()));
          }
        }
        $ownp=$this->paginate($ownposts);
        $ownp->withPath('');
        $follusers = $user->following()->paginate(5);
        $follusers->withPath('');
        $followerusers = $user->followers()->paginate(5);
        $followerusers->withPath('');
        $categories=Category::all();
        $followedCat=array();
        foreach($categories as $c){
          if(DB::table('follow_category')->where('category_id','=',$c->id)->where('user_id','=',$user->id)->exists()){array_push($followedCat,$c->id);}
        }
        return view('pages.ownprofile', ['user' => $user,'ownposts'=>$ownp, 'followers'=>$followers, 'following'=>$following, 'posts'=>$posts, 'upvotes'=>$count_upvotes, 'savedPosts' => $savedp
        , 'upvotedPosts' => $upp, 'follusers'=>$follusers,'followerusers'=>$followerusers,'categories'=>$categories,'followedCat'=>$followedCat]);
      }
      else{

        $otherposts = array();
        foreach ($user->posts as $p) {
          $postVisible=Post::find($p->id);
          if($postVisible->isvisible){
          array_push($otherposts, json_decode(PostController::getPost($p->id)->getContent()));
          }
        }
        $op=$this->paginate($otherposts);
        $op->withPath('');
        
        if(Auth::check()){
          $follows=DB::table('follow')->where('follower','=',Auth::id())->where('followed','=',$user->id)->exists();
        return view('pages.otherprofile', ['user' => $user, 'otherposts'=> $op, 'followers' => $followers, 'following' => $following, 'posts' => $posts, 'upvotes' => $count_upvotes, 'savedPosts' =>$saved_posts, 'upvotedPosts' => $upp,'follows'=>$follows]);
      }
      else{
        return view('pages.otherprofile', ['user' => $user, 'otherposts'=> $op, 'followers' => $followers, 'following' => $following, 'posts' => $posts, 'upvotes' => $count_upvotes, 'savedPosts' =>$saved_posts, 'upvotedPosts' => $upp]);
      }
    }
    }




  public function paginate($items,$name='', $perPage = 5, $page = null, $options = [])
  {
      $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
      $items = $items instanceof Collection ? $items : Collection::make($items);
      return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
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
        'image' => 'image|nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'oldPassword' => 'required|min:6',
        
      ]);
      
      $id = Auth::id();
      $user = User::find($id);

      var_dump($request->file);
      if(password_verify($request->input('oldPassword'), $user->password)){
        
        if ($request->hasFile('image')) {
          $filenameWithExt = $request->file('image')->getClientOriginalName ();
          // Get Filename
          $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
          
          // Get just Extension
          $extension = $request->file('image')->getClientOriginalExtension();
          // Filename To store
          $fileNameToStore = $filename. '_'. time().'.'.$extension;
           
          $path = $request->file('image')->storeAs('public/img/profile', $fileNameToStore);

          }
          // Else add a dummy image
          else {
          $fileNameToStore = 'default.png';
          }
          $user->photo = $fileNameToStore;

      // if($request->input('image')!=null){
      //   $imageName = Auth::id().'.'.$request->file->extension();
      //   $request->file->move(public_path('img/profile'), $imageName);
      //   $user->photo=$imageName;
      // }
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
      return redirect('/user/'.Auth::id());
    }


    public function getProfilePic($id){
      $user = User::find($id);
      $path = storage_path( 'app/public/img/profile/' . $user->photo);
      $p='public/img/profile/' . $user->photo;
      if(!Storage::exists($p)) abort(404);
   
  
      $file = File::get($path);
      $type = File::mimeType($path);
  
      $response = Response::make($file, 200);
      $response->header("Content-Type", $type);
      return $response;

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
      DB::delete('delete from follow_category where category_id = ? and user_id = ?' ,[$category->id, Auth::id()]);
    

      return redirect('authuserfeed');
    }


    public function manageCategory(Request $request){
      
      if(DB::table('follow_category')->where('category_id','=',$request->get('cat_id'))->where('user_id','=',Auth::id())->exists()){
      
        DB::delete('delete from follow_category where category_id = ? and user_id = ?' ,[$request->get('cat_id'), Auth::id()]);
        return response()->json(['success'=>'deleted','id'=>$request->get('cat_id')]);

      }
      else{
        $cat= new FollowCategory();
      $cat->user_id=Auth::id();
      $category=Category::where('id','=',$request->get('cat_id'))->first();
    
      $cat->category_id=$category->id;
      $cat->save();
      return response()->json(['success'=>'added','id'=>$request->get('cat_id')]);
      
      }
    }


    public static function alreadyFollowCat( $cat){
      $category=Category::where('name','=',$cat)->first();
      if (FollowCategory::where('user_id','=',Auth::id())->where('category_id','=',$category->id)->exists()) {
        return true;
     }
     else return false;
    }

    public static function alreadySavedPost( $post){
      return DB::table('saved_post')->where('user_id','=',Auth::id())->where('post_id','=',$post)->exists();
      
    }

    public function suspendedUser() {
      Auth::logout();
    return redirect('/login'.'?suspended=1');
  }

  public function bannedUser() {
    Auth::logout();
    return redirect('/login'.'?banned=1');
  }

  
    public static function alreadyUpvotedPost($post_id)
    {
      if (PostVote::where('post_id', '=', $post_id)->where('user_id', '=', Auth::id())->where('is_up', '=', true)->exists()) {
        return true;
      } else return false;
    }

    public static function alreadyDownvotedPost($post_id)
    {
      if (PostVote::where('post_id', '=', $post_id)->where('user_id', '=', Auth::id())->where('is_up', '=', false)->exists()) {
        return true;
      } else return false;
    }



    public function followUser(Request $request){
     if(DB::table('follow')->where('follower','=',Auth::id())->where('followed','=',$request->get('user_id'))->exists()){
      DB::delete('delete from follow where follower = ? and followed = ?' ,[Auth::id(), $request->get('user_id')]);
      return response()->json(['success'=>'deleted','id'=>$request->get('user_id')]);
     }
     else{
      DB::insert('insert into follow (follower, followed) values (?, ?)', [Auth::id(), $request->get('user_id')]);
      return response()->json(['success'=>'added','id'=>$request->get('user_id')]);
     }
    }

   
}