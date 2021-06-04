<?php

namespace App\Http\Controllers;

use App\Models\PostVote;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class PostVoteController extends Controller
{

    /*A post vote is created as well as added to the count of votes on a post*/
    /*It changes the previous vote if it already existed*/

    public function storeNewPostVote(Request $request)
    {  
        $vote =PostVote::where('post_id', '=',  $request->input('post_id'))->where('user_id', '=', Auth::id()) ->first();
        $post=Post::find($request->input('post_id'));
        if($request->input('upvote')=="true"){
           
            if($vote!=null){
                if($vote->is_up){
                    $vote->delete();
                    $post->upvotes=$post->upvotes-1;
                    $post->save();
                    return response()->json(['success' => 'remove_up', 'id'=> $request->input('post_id')]);
                }
                else{
                    $vote->is_up=true;
                    $vote->save();
                    $post->upvotes=$post->upvotes+1;
                    $post->downvotes=$post->downvotes-1;
                    $post->save();
                    return response()->json(['success' => 'switch_up', 'id'=> $request->input('post_id')]);
                }
            }
            else{
                $post_vote = new PostVote();
               
                $post_vote->user_id = Auth::id();
                $post_vote->post_id = $request->input('post_id');
                $post_vote->is_up = true;
                $post_vote->save();
                $post->upvotes=$post->upvotes+1;
                $post->save();
                return response()->json(['success' => 'new_up', 'id'=> $post_vote->post_id]);
            }
        }
        else{
            if($vote!=null){
                if(!$vote->is_up){
                    $vote->delete();
                    $post->downvotes=$post->downvotes-1;
                    $post->save();
                    return response()->json(['success' => 'remove_down', 'id'=> $request->input('post_id')]);
                }
                else{
                    $vote->is_up=false;
                    $vote->save();
                    $post->upvotes=$post->upvotes-1;
                    $post->downvotes=$post->downvotes+1;
                    $post->save();

                    return response()->json(['success' => 'switch_down', 'id'=> $request->input('post_id')]);
                }
            }
            else{
                $post_vote = new PostVote();
                $post_vote->user_id = Auth::id();
                $post_vote->post_id = $request->input('post_id');
                $post_vote->is_up =false;
                $post_vote->save();
              
                $post->downvotes=$post->downvotes+1;
                $post->save();
                return response()->json(['success' => 'new_down', 'id'=> $post_vote->post_id]);
            }
        }
      

        // if ($request->ajax()) {
       // return response()->json(['success' => 'Form is successfully submitted!', 'id'=> $post_vote->post_id]);
        // } else {
        //     return redirect('/post/' . $request->input('post_id'));
        // }

    }

}