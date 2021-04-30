<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Post;


class FeedController extends Controller {
    public function show() {
        
    
        // hot posts
        $request = new Request();
       // $request->sortBy = "numerical";
        $recentNews = Post::all();

        // random tags
       // $randomTags = Tag::inRandomOrder()->limit(8)->get();

        return view('pages.authuserfeed',
            [
             'recentNews' => $recentNews
            ]
        );
    }


}