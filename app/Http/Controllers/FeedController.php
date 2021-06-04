<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\Gate;

class FeedController extends Controller {



    public static function listRecent(){
        $recentNews = DB::table('post')->orderBy('datetime','desc')->get();
        $posts=array();
        foreach($recentNews as $n){
            $p=PostController::getPost($n->id);
            $pp=Post::find($n->id);
            if($pp->isvisible){
                array_push($posts,json_decode($p->getContent()));
            }
        }
        $collection=collect($posts);
        return $posts;

    }


    public function listTop(Request $request){
        $recentNews = DB::table('post')->orderBy('upvotes','desc')->get();
        $categories = Category::all();
        $posts=array();
        foreach($recentNews as $n){
            $p=PostController::getPost($n->id);
            $pp=Post::find($n->id);
            if($pp->isvisible){
                array_push($posts,json_decode($p->getContent()));
            }
        }
       
        $p= $this->paginate($posts);
          
        if($request->ajax()){
        
            return response()->json(['success'=>'Form is successfully submitted!','posts'=>$p]);
          
       }
       else{ 
           if(Auth::check()){
                return view('pages.authuserfeed',
                [
                'posts' => $posts,'categories'=>$categories
                ]
                );
            }
            else{
                return view('pages.homepage',
                [
                'posts' => $posts,'categories'=>$categories
                ]
                );
            }   
       }

    }


    public function show() {
        
        if (Gate::allows('is_admin')) {return redirect('admin/reports');}
        $categories = Category::all();
        // random tags
        // $randomTags = Tag::inRandomOrder()->limit(8)->get();
        $posts=$this->paginate(FeedController::listRecent());
        
        if(Auth::check()){
            return view('pages.authuserfeed',
            [
             'posts' => $posts,'categories'=>$categories
             ]
            );
        }
        else{
            return view('pages.homepage',
            [
             'posts' => $posts,'categories'=>$categories
            ]
            );
        }   
    }


    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }


    public function searchPosts(Request $request){
        $categories = Category::all();
        $cat = [];
        $cat = array_map('intval', explode(',', $request->get('categories')));
        if($request->get('preference')!="my-feed"){
            if($request->get('order')=="top-news"){
                $po = Post::where('header', 'like', '%' . $request->get('searchQuery') . '%' )->where('title', 'like', '%' . $request->get('searchQuery') . '%' )->whereIn('category',$cat)->orderBy('upvotes','desc')->orderBy('downvotes','asc')->get();
            }
            else{
                $po = Post::where('header', 'like', '%' . $request->get('searchQuery') . '%' )->where('title', 'like', '%' . $request->get('searchQuery') . '%' )->whereIn('category',$cat)->orderBy('datetime','desc')->get();
            }
        }
        else{
            if(Auth::check()){
                $user=User::find(Auth::id());
                $followedCats=array();
                foreach ($user->followedCategories as $c){
                    array_push($followedCats,$c->id);
                }

                $followedUsers=array();
                foreach ($user->following as $u){
                    array_push($followedUsers,$u->id);
                }
                if($request->get('order')=="top-news"){
                    $po = Post::where('header', 'like', '%' . $request->get('searchQuery') . '%' )->where('title', 'like', '%' . $request->get('searchQuery') . '%' )->whereIn('category',$cat)->whereIn('category',$followedCats)->orwhereIn('user_id',$followedUsers)->orderBy('upvotes','desc')->orderBy('downvotes','asc')->get();
                }
                else{
                    $po = Post::where('header', 'like', '%' . $request->get('searchQuery') . '%' )->where('title', 'like', '%' . $request->get('searchQuery') . '%' )->whereIn('category',$cat)->whereIn('category',$followedCats)->orwhereIn('user_id',$followedUsers)->orderBy('datetime','desc')->get();
                }
            }
        }

        $posts=array();
        foreach($po as $n){
            $p=PostController::getPost($n->id);
            $pp=Post::find($n->id);
           if($pp->isvisible){
                array_push($posts,json_decode($p->getContent()));
           }
            
        }

        $p=$this->paginate($posts);
        $p->withPath('');
        return response()->json(['html'=>view('partials.management.posts',['posts' => $p])->render()]);
    }

}