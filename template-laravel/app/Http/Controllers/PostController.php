<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use DateTime;

class PostController extends Controller
{
    /**
     * Shows the post for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
      $post = PostController::getPost($id);
      if ($post->getStatusCode() !== 200) {
        abort($post->getStatusCode());
      }
      $post = json_decode($post->getContent());
      $this->authorize('show', $post);
      return view('pages.post', ['post' => $post]);
    }

    /**
     * Shows all posts.
     *
     * @return Response
     */
    public function list()
    {
     
      $posts = Post::all();
    
    }

    // /**
    //  * Creates a new card.
    //  *
    //  * @return Card The card created.
    //  */
    // public function create(Request $request)
    // {
    //   $card = new Card();

    //   $this->authorize('create', $card);

    //   $card->name = $request->input('name');
    //   $card->user_id = Auth::user()->id;
    //   $card->save();

    //   return $card;
    // }

    // public function delete(Request $request, $id)
    // {
    //   $card = Card::find($id);

    //   $this->authorize('delete', $card);
    //   $card->delete();

    //   return $card;
    // }


    public static function getPost($id) {
        $post = Post::find($id);
        if (is_null($post)) {
            return response()->json([
                'status' => 'failure',
                'status_code' => 404,
                'message' => 'Not Found',
                'errors' => ['post' => 'There is no post with id ' . $id],
            ], 404);
        }

        // check if the user has authorization to view the post
        $this->authorize('view', $post);

        $post_author = null;
        // if post has no author (account deleted)
        if ($post->content->user_id !== null) {
            
            $post_author = [
                'id'=> $post->content->author->id,
                'name'=> $post->content->author->name,
                'username' => $post->content->author->username,
                'photo' => $post->content->author->photo,
            ];
        }


        return response()->json([
            'id' => $post->id,
            'datetime' => $post->datetime,
            'title' => $post->title,
            'header' => $post->header,
            'body' => $post->body,
            'author' => $post_author,
            'category' => $post->category,
            'upvotes'=> $post->upvotes,
            'downvotes' => $post->downvotes,

        ], 200);

    }

}
