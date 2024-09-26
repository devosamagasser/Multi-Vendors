<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AuthenticateUser
{
    public function authenticate($request)
    {
        $username = $request->post(config('fortify.username'));
        $password = $request->password;

        $user = Admin::where('username',$username)
                ->orWhere('email',$username)
                ->orWhere('phone',$username);

        if($user->doesntExist())
            return false;
//            return redirect()->back()->with('error','the creadential is not match our records');

        $user = $user->first();
        if(!Hash::check($password,$user->password))
            return false;
//            return redirect()->back()->with('error','the creadential is not match our records');

//        return Auth::guard('web')->login($user);
        return $user;
    }

}
