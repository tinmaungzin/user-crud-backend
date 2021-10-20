<?php

namespace App\Http\Controllers\API;

use App\Http\Actions\UserCreate;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\CreateUserRequest;
use App\Http\Requests\API\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        responseData('users',$users,200);
    }

    public function create(){
    }


    public function store(CreateUserRequest $request){
        $user = (new UserCreate())->run($request);
        responseData('user',$user,201);

    }
    public function show($id){
        $user = $this->find($id);
        responseData('user',$user,200);
    }

    public function edit($id){
    }

    public function update(UpdateUserRequest $request,$id){
        $user = $this->find($id);
        $user->update([
            'email'=> $request->email,
            'name' => $request->name,
        ]);
        responseData('user',$user,200);
    }

    public function destroy($id){
        $user = $this->find($id);
        $user->delete();
        responseTrue('User is deleted');
    }

    protected function find($id){
        $user = User::find($id);
        return ($user) ? :  responseStatus('The Given User ID is not found',404);
    }
}
