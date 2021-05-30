<?php

namespace App\Http\Controllers;

use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use App\Models\Source;
use App\Models\Post;
use App\Models\User;
use App\Models\FollowCategory;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
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
      $followers = $user->followers()->get()->count();
      $following = $user->following()->get()->count();
      $posts = $user->posts()->get()->count();
      $saved_posts_ids = $user->savedPosts()->get();
      $upvoted_posts_ids = $user->upvotedPosts()->get();
      $user=User::find(Auth::id());
            $followedCats=[];
           
            foreach ($user->followedCategories as $cat){
              array_push($followedCats,$cat->id);
         
            }
          
            $followedUsers=[];
            foreach ($user->following as $u){
      
                array_push($followedUsers,$u->id);
            }
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
      if(Auth::check() && Auth::id()==$id){
        $ownposts=array();
        foreach($user->posts as $p){
          array_push($ownposts,json_decode(PostController::getPost($p->id)->getContent()));

        }
        $ownp=$this->paginate($ownposts);
        $ownp->withPath('');
        return view('pages.ownprofile', ['user' => $user,'ownposts'=>$ownp, 'followers'=>$followers, 'following'=>$following, 'posts'=>$posts, 'upvotes'=>$count_upvotes, 'savedPosts' => $savedp
        , 'upvotedPosts' => $upp]);
      }
      else{
        $otherposts = array();
        foreach ($user->posts as $p) {
          array_push($otherposts, json_decode(PostController::getPost($p->id)->getContent()));
        }
        $op=$this->paginate($otherposts);
        $op->withPath('');
        return view('pages.otherprofile', ['user' => $user, 'otherposts'=> $op, 'followers' => $followers, 'following' => $following, 'posts' => $posts, 'upvotes' => $count_upvotes, 'savedPosts' =>$saved_posts, 'upvotedPosts' => $upp]);
      }
    }




  public function paginate($items, $perPage = 5, $page = null, $options = [])
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