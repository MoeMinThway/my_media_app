<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //getAllPost
    public function getAllPost(){
        $posts = Post::get();
        return response()->json([
            'post'=>$posts
        ]);
    }
    public function search(Request $request){
        // logger($request->all());
        $posts = Post :: where('title','like' , '%'. $request->key .'%')->get();
        return response()->json([
            // 'reponseValue'=>$request->all(),
            'searchData' => $posts,
        ]);
    }
    public function details(Request $request){

        // $post = Post::where('post_id',$request->id)->first();
        $p =Post::where('post_id',$request->id)->first();
        // $u = User::where('id',$request->id)->first();
        // $c = Category::where('category_id',$request->id)->first();

        return response()->json([
            "post" => $p ,

        ] );
    }
}
