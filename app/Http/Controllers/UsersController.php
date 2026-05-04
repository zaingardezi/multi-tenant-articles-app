<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\UserService;
use App\Http\Requests\StoreUserRequest;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class UsersController extends Controller
{
    use AuthorizesRequests;
    public function usershomepage(UserService $userservice)
    {
        $this->authorize('viewAny', User::class);
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
        $this->authorize('view',$user);
        return view('articles.usersview',compact('user'));
    }

    public function edituser(User $user)
    {
        $this->authorize('update',$user);
        return view('articles.userseditpage',compact('user'));
    }

    public function updateuser(UpdateUserRequest $request, User $user, UserService $userservice)
    {
        $this->authorize('update',$user);
        $userservice->updateUser($request->validated(),$user);
        return redirect()->route('users.homepage');
    }
        public function usersdelete(User $user, UserService $userservice)
        {
         $this->authorize('delete',$user);
         $userservice->deleteUser($user);   
         return redirect()->route('users.homepage');
        }

  
    
}
