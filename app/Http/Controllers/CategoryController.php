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

class CategoryController extends Controller
{
 
    public static function categoryAlreadyFollowed($user_id,$cat_id){
        if (Report::where('post_id', '=', $post_id)->where('user_id', '=', $user_id)->exists()) {
            return true;
         }
         else return false;
    }
}
