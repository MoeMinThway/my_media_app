<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    //
    public function list(){
        $searchKey =null;
        $users = User::get();
        // dd($users->toArray());
        return view('admin.list.index',compact('users','searchKey'));
    }
    public function delete($id){
        // dd($id);
        // dd(Auth::user()->id);
        if(Auth::user()->id != $id){
            User::where('id',$id)->delete();
            return redirect()->route('admin#list')->with([
                "success"=>"Delete Admin Success"
            ]);
        }else{
            return back();
        }
    }
    public function search(Request $request){
        $searchKey = $request->searchKey;

         $users = User::

                orWhere ('name','like','%'. $searchKey .'%')->
                orWhere ('email','like','%'. $searchKey .'%')->
                orWhere ('phone','like','%'. $searchKey .'%')->
                orWhere ('address','like','%'. $searchKey .'%')->
                orWhere ('gender','like','%'. $searchKey .'%')

                    ->get();
        //  dd($users->toArray());
        return view('admin.list.index',compact('users','searchKey'));




    }
}
