<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //login
    public function login(Request $request){
        $user = User::where('email',$request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                return response()->json([
                    "user"=>$user,
                    'token'=>$user->createToken(time())->plainTextToken,
                ] );
            }else{
                return response()->json([
                    "user"=>NULL,
                    'token'=>NULL,
                ] );
            }

        }else{
            return response()->json([
                "user"=>NULL,
                'token'=>NULL,
            ] );
        }


    }
    public function category(){
        $category =  Category::get();
        return response()->json([
            "category"=>$category
        ] );
    }
    public function register(Request $request){



        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),

        ];
        User::create($data);
        $user = User::where('email',$request->email)->first();


        return response()->json([
            "user"=>$user,
            'token'=>$user->createToken(time())->plainTextToken,
        ]);
    }
    // 27
}
