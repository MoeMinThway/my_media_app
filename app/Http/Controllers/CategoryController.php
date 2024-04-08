<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    public function category(){
        $searchKey = null;

        $categories = Category::paginate();
        return view('admin.category.index',compact('categories','searchKey'));
    }
    public function delete($id){
        // $searchKey = null;
        Category::where('category_id',$id)->delete();
        // $categories = Category::paginate();
        // return back()->with(['successDelete'=> "Category Delete Success !!!"]);;
        // return view('admin.category.index',compact('categories','searchKey'))->with(['successDelete'=> "Category Delete Success !!!"]);
        return redirect()->route('admin#category');
    }
    public function create(Request $request){
        // dd($request->all());
        $this->validationCheck($request);
        $data = $this->getCreateData($request);

        Category::create($data);


        return redirect()->route('admin#category')->with(['successCreate'=> "Category Create Success"]);
    }
    public function search(Request $request){
        $searchKey = $request->searchKey;

         $categories = Category::
                orWhere ('title','like','%'. $searchKey .'%')->
                orWhere ('description','like','%'. $searchKey .'%')
                   ->get();
        return view('admin.category.index',compact('categories','searchKey'));
    }

    public function editPage($id){
        $searchKey = null;
        $categories = Category::paginate();

        // dd($id);
        $category = Category::where('category_id',$id)->first();
        // dd($category->toArray());

        return view('admin.category.edit',compact('searchKey','category','categories'));
    }

    public function update(Request $request){
        // dd($request->toArray());

        $oldData = Category::where('category_id',$request->categoryId)->first();
        // dd($oldData->title);

        if($request->categoryTitle != $oldData->title ||
            $request->categoryDescription != $oldData->description
         ){
            $data =  $this->getUpdateData($request);
            $this->validationCheckUp($request);
            Category::where('category_id',$request->categoryId)->update($data);
            // dd("success");
            return redirect()->route('admin#category');


         }else{
            return back();
         }


    }

    private function getCreateData($request){
            return [
                "title" => $request->categoryName,
                "description" => $request->categoryDescription,
                'updated_at'=>Carbon::now(),
            ];
    }
    private function validationCheck($request){
        $validated = $request->validate([
            'categoryName' => 'required',
            'categoryDescription' => 'required',
        ]);
        return $validated;


    }
    private function getUpdateData($request){
        return [
            'title'=>$request->categoryTitle,
            'description'=>$request->categoryDescription,
        ];
    }
    private function validationCheckUp($request){
        return $request->validate(
            [
                "categoryTitle"=>"required",
                "categoryDescription"=>"required",
            ]
            );
    }
}

// <form class="form-horizontal" action="{{route('admin#category#update')}}" method="POST">
// @csrf
// <input type="hidden" name="categoryId" value="{{$category->category_id}}">
// <div class="form-group row">
//   <label for="inputName" class="col-sm-2 col-form-label">Title</label>
//   <div class="col-sm-10">
//     <input type="text" value="{{old('categoryTitle',$category->title)   }}"  name="categoryTitle" class="form-control" id="inputName" placeholder="Title">
//     @error('categoryTitle')
//         <div class="text-danger"> {{$message}}</div>
//     @enderror
// </div>
// </div>

// <div class="form-group row">
//   <label for="inputEmail" class="col-sm-2 col-form-label">Description</label>
//   <div class="col-sm-10">
//     {{-- <input type="email" name="categoryDescription" value="{{old('categoryDescription',$category->description)}}" class="form-control" id="inputEmail" placeholder="Description"> --}}
//     <textarea name="categoryDescription" class="form-control" id="" placeholder="Description" cols="30" rows="5">{{old('categoryDescription',$category->description)}}</textarea>
//     @error('categoryDescription')
//     <div class="text-danger"> {{$message}}</div>
// @enderror
// </div>
// </div>





// <div class="form-group row">
//   <div class=" col-sm-10 mr-5">
//     <button type="submit" class="btn bg-dark w-50 text-white">Update</button>
//   </div>
// </div>
// </form>
