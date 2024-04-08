<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //
    public function index(){
        $id = Auth::user()->id;
        // dd($id);
        $user = User::where('id',$id)->first();
        // dd($user->toArray());
        return view('admin.profile.index',compact('user'));
    }
    public function update(Request $request){
        // dd($request->toArray());

        $updateData = $this->getUserInfo($request);
         $validator = $this->validationCheck($request);




        User::where('id',$request->adminId)->update($updateData);
        return redirect('dashboard')->with(['message'=>"Account Update Success"]);

    }
    public function changePassword(){
        $user =User::where('id',1)->first() ;
        return view('admin.profile.changePassword',compact('user'));
    }


    public function changePasswordPost(Request $request){
        $this->validationCheckForChangePassword($request);
        // dd($request->toArray());
        $dbData = User::where('id',Auth::user()->id)->first();
        $dbPassword = $dbData->password; //hash


        $hashOldPW = Hash::make($request->oldPassword);
        $hashNewPW = Hash::make($request->newPassword);



        if(Hash::check($request->oldPassword,$dbPassword)){
            // dd("correct");
            $updatePW =[
                "password"=>$hashNewPW,
                "updated_at"=>Carbon ::new()
            ];
            User::where('id',Auth::user()->id)->update($updatePW);
            // dd("success");
            return redirect('dashboard');
        }else{
            return back()->with([
                "fail"=>"Old password do not match"
            ]);
        }
    }
    private function getUserInfo(Request $request){


        return [
            'name' => $request->adminName,
            'email' => $request->adminEmail,
            'phone' => $request->adminPhone,
            'address' => $request->adminAddress,
            'gender' => $request->adminGender,
            'updated_at'=> Carbon:: now(),
        ];
    }
    private function validationCheck($request){
        $validated = $request->validate([
            'adminName' => 'required',
            'adminEmail' => 'required',
        ],[
            "adminName"=>"The admin name field is required.",
            "adminEmail"=>"The admin name field is required.",
        ]);
        return $validated;


    }
    private function validationCheckForChangePassword($request){
            $validationRule =[
                'oldPassword' => 'required',
                'newPassword' => 'required|min:8|max:15',
                'comfirmPassword' => 'required|same:newPassword|min:8|max:15',
            ];

        $validationMessage=[
            "oldPassword.required"=> "The old password field is required.",
            "newPassword.required"=> "The new password field is required.",
            "comfirmPassword.required"=> "The confirm password field is required.",
            "comfirmPassword.same"=>"The comfirm password field must match new password."
        ];

        $validated = $request->validate($validationRule,$validationMessage);
        return $validated;


    }

}
