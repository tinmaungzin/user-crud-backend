<?php

namespace App\Http\Controllers\API;

use App\Http\Actions\UserCreate;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\CreateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(CreateUserRequest $request){
        $user = (new UserCreate())->run($request);
        $user->token  =  $this->createToken($user);
        responseData('user',$user,200);
    }

    public function login(Request $request){
        $is_auth = $this->checkEmailAndPassword($request);
        if($is_auth){
            $user = auth()->user();
            $user->token =  $this->createToken($user);
            responseData('user',$user,200);
        }
        responseStatus('Email and password are not corrected',400);
    }

    public function logout(Request $request){
       $is_logout =  $request->user()->currentAccessToken()->delete();
       if($is_logout){
           responseTrue('Successfully Logout');
       }
       responseFalse();
    }

    protected function checkEmailAndPassword($data): bool{
        return  Auth::guard('api')->attempt([
            'email' => $data->email,
            'password' => $data->password
        ]);
    }

    protected function createToken($user){
        return  $user->createToken('LaravelSanctumAuth')->plainTextToken;
    }


}
