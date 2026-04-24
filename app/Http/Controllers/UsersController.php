<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\UserService;
use App\Http\Requests\StoreUserRequest;


class UsersController extends Controller
{
    public function usershomepage(UserService $userservice)
    {
        $users=$userservice->getUsers();
        return view('articles.users',compact('users'));
    }

public function addnewuser(StoreUserRequest $request, UserService $userService)
{
    $userService->createUser($request->validated());
    return redirect()->route('users.homepage');
}

    public function usersview(User $user)
    {
        return view('articles.usersview',compact('user'));
    }

    public function edituser(User $user)
    {
return view('articles.userseditpage',compact('user'));
    }

    public function updateuser(UpdateUserRequest $request, User $user, UserService $userservice)
    {
           
        $userservice->updateUser($request->validated(),$user);
        return redirect()->route('users.homepage');
    }
        public function usersdelete(User $user)
        {
         $user->delete();
         return redirect()->route('users.homepage');
        }

  
    
}
