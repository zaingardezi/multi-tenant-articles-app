<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function usershomepage()
    {
        $users=User::all();
        return view('articles.users',compact('users'));
    }

    public function addnewuser(Request $request)
    {
        $this->createvalidate($request);  
        User::create($request->all());
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

    public function updateuser(Request $request, User $user)
    {
        $this->updatevalidate($request,$user);   
        $user->update($request->all());
        return redirect()->route('users.homepage');
    }
        public function usersdelete(User $user)
        {
         $user->delete();
         return redirect()->route('users.homepage');
        }

        public function createvalidate(Request $request)
    {
       $request->validate([
      'name' => 'required|alpha',
      'email' => 'required|email|unique:users,email',
      'phone' => 'required|numeric',
      'age'=> 'required|numeric|min:1|max:119'
     ]);
    }



   public function updatevalidate(Request $request, User $user)
    {
       $request->validate([
      'name' => 'required|alpha',
      'email' => 'required|email|unique:users,email,' . $user->id,
      'phone' => 'required|numeric',
      'age'=>'required|numeric|min:1|max:119'
     ]);
         
    }
    
}
