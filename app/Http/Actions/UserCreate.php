<?php


namespace App\Http\Actions;


use App\Models\User;

class UserCreate
{
    public function run($request){
        $user =  User::create([
            'email'=> $request->email,
            'name' => $request->name,
            'password' => $request->password
        ]);
        return ($user) ?  : responseFalse();
    }
}
