<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

        if( $request->postImage != null && !empty($request->postImage) ){
            $file = $request->file('postImage');
            $fileName = uniqid()."_" .$file->getClientOriginalName();
            $file->move(public_path().'/postImage',$fileName);


            $data = $this->getCreateData($request,$fileName);
        }else{
            $data = $this->getCreateData($request,NULL);
        }




        Post::create($data);
        return redirect()->route('admin#post');
    }
    public function delete($id,Request $request){
        // dd($request->all());
        $data  =  Post::where('post_id',$id) ->first();
        $dbImageName = $data->image;
        // dd($dbImageName);


        Post::where('post_id',$id)->delete();
       if(File::exists(public_path().'/postImage/'.$dbImageName )){
            File::delete(public_path().'/postImage/'.$dbImageName  );
       }
        return back();
    }
    public function editPage($id){
        // dd($id);
        $categories = Category::get();
        $posts = Post::get();
        $post = Post::where('post_id',$id)->first();
        // dd($post->toArray());



        return view('admin.post.edit',compact('categories','posts','post'));
    }

    public function update(Request $request){
        $this->validation($request);
        // dd($request->toArray());
        $postId  = $request->postId;

        $oldDb =     Post::where('post_id',$postId)->first();
        $oldImageName = $oldDb->image;

        if($oldImageName != null && File::exists (public_path().'/postImage/'.$oldImageName   ) ){
         
            File::delete(public_path().'/postImage/'.$oldImageName   );
        }

        if( $request->postImage != null && !empty($request->postImage) ){
            $file = $request->file('postImage');
            $fileName = uniqid()."_" .$file->getClientOriginalName();
            $file->move(public_path().'/postImage',$fileName);


            $data = $this->getCreateData($request,$fileName);
        }else{
            $data = $this->getCreateData($request,NULL);
        }

        Post::where('post_id',$postId)->update($data);
        // dd($request->toArray());
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

