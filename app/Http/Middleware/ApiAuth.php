<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //get access_token
        $access_token=$request->header('access_token');
        if($access_token !== null){
            $user=User::where('access_token','=',$access_token)->first();
            if($user !== null){
                if($user->{'user-type'}=='admin'){

                    return $next($request);
                }else{
                    return response()->json(['message'=>'user type not correct'],404);
                }
               
            }else{
                
                return response()->json(['message'=>'access token not correct'],404);
            }
        }else{
            return response()->json(['message'=>'access token not found'],404);
        }
        
    }
}
