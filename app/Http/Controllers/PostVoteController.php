<?php

namespace App\Http\Controllers;

use App\Models\PostVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostVoteController extends Controller
{

    public function storeNewPostVote(Request $request)
    {
        $post_vote = new PostVote();

        $post_vote->user_id = Auth::id();
        $post_vote->post_id = $request->input('title');
        $post_vote->is_up = $request->input('header');

        $post_vote->save();

        return redirect('/user/' . Auth::id());
    }

}