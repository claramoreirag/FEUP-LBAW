<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class FeedController extends Controller {



    public static function listRecent(){
        $recentNews = DB::table('post')->orderBy('datetime','desc')->get();
        $posts=array();
        foreach($recentNews as $n){
            $p=PostController::getPost($n->id);
            array_push($posts,json_decode($p->getContent()));
        }
        $collection=collect($posts);
        return $posts;

    }


    public function show() {
        
   
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
        $cat = [];
        $cat = array_map('intval', explode(',', $request->get('categories')));

        
        $po = Post::where('header', 'like', '%' . $request->get('searchQuery') . '%' )->where('title', 'like', '%' . $request->get('searchQuery') . '%' )->whereIn('category',$cat)->get();
        $posts=array();
        foreach($po as $n){
            $p=PostController::getPost($n->id);
            array_push($posts,json_decode($p->getContent()));
        }
        
        return response()->json(['html'=>view('partials.management.posts',['posts' => $posts])->render()]);
    }
}