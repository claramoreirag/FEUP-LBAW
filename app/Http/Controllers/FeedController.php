<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FeedController extends Controller {

    public function show() {
        
        // hot posts
        $request = new Request();
       // $request->sortBy = "numerical";
        $recentNews = Post::all();
        $categories = Category::all();
        // random tags
       // $randomTags = Tag::inRandomOrder()->limit(8)->get();
        $posts=array();
        foreach($recentNews as $n){
            $p=PostController::getPost($n->id);
            array_push($posts,json_decode($p->getContent()));
        }

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


    public function searchPosts(Request $request){
        $cat = [];
        //parse_str($request->get('categories'), $cat);

        $cat = array_map(function($value) {
            return intval($value);
        }, array($request->get('categories')));

        $posts = Post::whereIn('category',$cat)->where('header', 'like', '%' . $request->get('searchQuery') . '%' )->orWhere('title', 'like', '%' . $request->get('searchQuery') . '%' )->get();
        return response()->json(['html'=>view('partials.management.posts',[ 'posts' => $posts])->render()]);
    }
}