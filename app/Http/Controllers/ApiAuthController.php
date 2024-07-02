<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'name' => 'required|string|max:255',
            'email' => 'email|required|string|unique:users,email',
           
            'password' => 'confirmed|required|min:8'
        ]);
        if ($validator->fails()) {

            return response()->json(['message' => $validator->errors()], 301);
        }

        $access_token = Str::random(64);
        //hashing password
        $passwordHashed = bcrypt($request->password);
        //create
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'access_token' => $access_token
        ]);
        //message
        return  response()->json([
            'message' => 'you register successfully',
            'token' => $access_token
        ], 301);
    }


    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'email|required|string',
            'password' => 'string|required|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 301);
        }

        //email check
        $user = User::where('email', '=', $request->email)->first('*');
        if ($user !== null) {
            $oldPassword = $user->password;
            $access_token = Str::random(64);
            //check on password
            if (Hash::check($request->password, $oldPassword)) {

                $user->update(['access_token' => $access_token]);
                //return message
                return response()->json([
                    'success' => 'user logged  in successfully',
                    'access_token' => $access_token
                ], 200);
            } else {
                return response()->json(['message' => 'credential error '], 403);
            }
        } else {
            return response()->json(['message' => 'credential error'], 403);
        }
    }


    //logout
    public function logout(Request $request){
        //catch data 
        $access_token=$request->header('access_token');

        if($access_token !== null){

            $user=User::where('access_token','=',$access_token)->first();

            if($user !== null){

                //update access token to null
                $user->update([
                    'access_token'=>null
                ]);
                //message
                return response()->json(['success','user logged out successfully'],200);
            }else{
                return response()->json(['message'=>'access token not correct'],404);
            }
        }else{
           return response()->json(['message'=>'access token not found'],404);

        }
    }
}
