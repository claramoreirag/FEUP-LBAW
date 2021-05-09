<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller {
    public function show() {
        
    
        // hot posts
        $request = new Request();
       // $request->sortBy = "numerical";
        $recentNews = Post::all();

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
             'posts' => $posts
             ]
            );
        }
        else{
            return view('pages.homepage',
            [
             'posts' => $posts
            ]
            );
        }   
    }
            
      


}