<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function post(){
        $categories = Category::get();
        $posts = Post::get();



        return view('admin.post.index',compact('categories','posts'));
    }
    public function create(Request $request){
        // dd($request->all());

        $this->validation($request);

        if(!empty($request->postImage)){
            $file = $request->file('postImage');
            $fileName = uniqid()."_" .$file->getClientOriginalName();
            $file->move(public_path().'/postImage',$fileName);


            $data = $this->getCreateData($request,$fileName);
        }else{
            $data = $this->getCreateData($request,null);
        }




        Post::create($data);
        return redirect()->route('admin#post');
    }
    private function getCreateData($request,$fileName){
        return [
            "title" => $request->postTitle,
            "description" => $request->postDescription,
            "category_id" => $request->postCategory,
            "image" => $fileName,
        ];
    }
    private function validation($request){
        return $request->validate([
            "postTitle" => "required",
            "postDescription" => "required",
            "postCategory" => "required",
            "postImage" => "mimes:png,jpg,jpeg",
            // "postImage" => "required",
        ]);
    }
}
22
