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
        $post_vote->post_id = $request->input('post_id');
        $post_vote->is_up = $request->input('is_up');

        var_dump($post_vote);

        $post_vote->save();

        // if ($request->ajax()) {
            return response()->json(['success' => 'Form is successfully submitted!', 'id'=> $post_vote->post_id]);
        // } else {
        //     return redirect('/post/' . $request->input('post_id'));
        // }

    }

}