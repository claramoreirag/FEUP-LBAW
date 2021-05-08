<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Card;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Source;
use App\Models\PostSource;
use App\Models\Post;

class SourceController extends Controller
{
  /**
   * Creates a new item.
   *
   * @param  int  $card_id
   * @param  Request request containing the description
   * @return Response
   */
  public static function create($link, $post_id)
  {
  
    if(Source::where('name', '=', $link)->exists()){
        $source = Source::where('name', '=', $link)->first();
        $psource=new PostSource();
        $psource->post_id = $post_id;
        $psource->source_id = $source->id;
        $psource->save();
    }
    else{
        $source = new Source();
        $source->name = $link;
        $source->save();
        $psource=new PostSource();
        $psource->post_id = $post_id;
        $psource->source_id = $source->id;
        $psource->save();
    }
    
    
  }

    /**
     * Updates the state of an individual item.
     *
     * @param  int  $id
     * @param  Request request containing the new state
     * @return Response
     */
    public function update(Request $request, $id)
    {
     
    }

    /**
     * Deletes an individual item.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete(Request $request, $id)
    {
      
    }

}
