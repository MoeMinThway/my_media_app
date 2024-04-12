<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function getAllCategory(){
        $categories = Category::select('category_id','description','title')->get();
        return response()->json([
            'category'=>$categories
        ]);
    }
   public function search(Request $request){
        // $request->searchCategory;
        $postSearhByCategory =Post:: where('category_id',$request->categoryId)->get();
            return response()->json([
                "posts" => $postSearhByCategory,
            ]);

   }
}
