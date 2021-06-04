<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Source;
use App\Models\PostSource;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;

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
        if(PostSource::where('post_id', '=', $post_id)->where('source_id','=',$source->id)->exists()){

        }
        else{
          $psource=new PostSource();
          $psource->post_id = $post_id;
          $psource->source_id = $source->id;
          $psource->save();
        }
       
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

    

}
