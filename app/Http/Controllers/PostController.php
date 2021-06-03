<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Models\Source;
use App\Models\Post;
use App\Models\User;
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
     // $this->authorize('view', $post);
      if ($post->getStatusCode() !== 200) {
        abort($post->getStatusCode());
      }
      $post = json_decode($post->getContent());
      $comments=$this->paginate(CommentController::getAllFromPost($id));
      $comments->withPath('');
      if(Auth::check()){
        $saved=DB::table('saved_post')->where('user_id','=',Auth::id())->where('post_id','=',$post->id)->exists();
        return view('pages.fullpost', ['post' => $post, 'comments'=>$comments,'saved'=>$saved]);
      }
      return view('pages.fullpost', ['post' => $post, 'comments'=>$comments]);
    }
  

    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
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


  public function delete(Request $request, $id)
  {
    $post = Post::find($id);

    $this->authorize('delete', $post);
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
      //$src = Source().create($request->input('source'));
      //$this->authorize('storeNewPost', $post);
      
      $validatedData = [];
      
      $validatedData = $request->validate([
          'title' => 'required|min:5',
          'header' => 'required|min:10',
          'body' => 'required|min:10',
      ]);
      $this->authorize('create', $post);
      $post->user_id = Auth::id();
      $post->title=$request->input('title');
      $post->header = $request->input('header');
      $post->body = $request->input('body');
      $post->category = $request->input('categories');
      
      $post->save();
      foreach($request->input('source') as $s){
        if($s!=null)SourceController::create($s,$post->id);
      }

      return redirect('/user/'.Auth::id().'?postSuccess=1&n='.$post->id);
     }

  


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
        
       $bool=$post->isVisible();
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
            'sources'=>$sources,
            'isvisible'=>$bool
        ], 200);

    }





    public function showEdit($id){
      $post = PostController::getPost($id);
      if ($post->getStatusCode() !== 200) {
        abort($post->getStatusCode());
      }

      $post = json_decode($post->getContent());
      // var_dump($post->author->id);
      // var_dump(Auth::id());
      //$this->authorize('update', $post);
      $categories=Category::all();
     
      return view('pages.editpost', ['post' => $post,'categories'=>$categories]); 
    }






    public function edit(Request $request,$id){
      
      $post= Post::find($id);
      
      $this->authorize('update', $post);
      $post->title=$request->input('title');
      $post->header = $request->input('header');
      $post->body = $request->input('body');
      $post->category = $request->input('categories');
      $post->save();
     
      foreach($request->input('source') as $s){
          if($s!=null)SourceController::create($s,$id);
      }
      
      return redirect('/post/'.$id);
    }




    public function report($id){
      
      ReportController::createPostReport(Auth::id(),$id);
      return redirect('/post/'.$id);
    }

    public function save(Request $request,$id){
      $post= Post::find($id);
      $this->authorize('save', $post);
      $saved=DB::table('saved_post')->where('user_id','=',Auth::id())->where('post_id','=',$id)->exists();
      if(!$saved){
        DB::insert('insert into saved_post (user_id, post_id) values (?, ?)', [Auth::id(), $id]);
        return response()->json(['success'=>'true','id'=>$id]);
      }
      else{
        DB::delete('delete from saved_post where post_id = ? and user_id = ?' ,[$id, Auth::id()]);
        return response()->json(['success'=>'false','id'=>$id]);
      }

      
    }

    

}


