<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Source;
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
      $categories=Category::all();
      return view('pages.fullpost', ['post' => $post]);
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

  public function delete(Request $request, $id)
  {
    $post = Post::find($id);

    // $this->authorize('delete', $card);
    $post->delete();
    return redirect()->route('profile',['user_id'=>Auth::id()]);
   
  }




     public function showNewPost()
     {
      $categories=Category::all();
      return view('pages.newpost',['categories'=>$categories]);
     }

     public function storeNewPost(Request $request)
     {
      $post = new Post();
      $src = new Source();


      //$this->authorize('storeNewPost', $post);
  
      $validatedData = [];

      /*
      // Request validation
      if ($post->type == 1) {
          // Post type has title
          $validatedData = $request->validate([
            'title' => 'required|min:15',
            'body' => 'required|min:19',
        ]);
      } else {
        $validatedData = $request->validate([
          'body' => 'required|min:19',
      ]);
      }*/

      $post->user_id = Auth::user()->id;
      $post->title = $request->input('title');
      $post->header = $request->input('header');
      $post->body = $request->input('mytextarea');
      $post->category = $request->input('categories');
      $post->source=$src;
      $post->save();

      return redirect('/user/{{Auth::id()}}');
     }

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
        //$this->authorize('view', $post);

        $post_author = null;
        // if post has no author (account deleted)
        //var_dump($post);
        if ($post->user_id !== null) {
            
            $post_author = [
                'id'=> $post->author->id,
                'name'=> $post->author->name,
                'username' => $post->author->username,
                'photo' => $post->author->photo,
            ];
        }
        $sources=array();
        foreach($post->sources as $s){
            $source =Source::find($s->source_id);
            array_push($sources, $source->name);
        }
        $category=Category::find($post->category)->name;
       // var_dump($category);

        return response()->json([
            'id' => $post->id,
            'datetime' => $post->datetime,
            'title' => $post->title,
            'header' => $post->header,
            'body' => $post->body,
            'author' => $post_author,
            'category' => $category,
            'upvotes'=> $post->upvotes,
            'downvotes' => $post->downvotes,
            'sources'=>$sources

        ], 200);

    }

    public function showEdit($id){
      $post = PostController::getPost($id);
      if ($post->getStatusCode() !== 200) {
        abort($post->getStatusCode());
      }

      $post = json_decode($post->getContent());
     // $this->authorize('show', $post);
     $categories=Category::all();
     
      return view('pages.editpost', ['post' => $post,'categories'=>$categories]); //não é pages.post, é o quê?
    }

    public function edit($id, $request){
      $post= Item::find($id);
    }



}
