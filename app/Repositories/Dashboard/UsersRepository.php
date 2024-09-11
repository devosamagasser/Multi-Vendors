<?php

namespace App\Repositories\Dashboard;
use App\Interfaces\Dashboard\UsersInterface;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;
class UsersRepository implements UsersInterface
{
    public function index()
    {
        $data = [
            'user' => Auth::user(),
            'countries' => Countries::getNames(),
            'local' => Languages::getNames(),
            'section' => 'profile' ,
            'pageTitle' => 'edit' ,
        ];
        return view('dashboard.profile.edit',compact('data'));
    }

    public function edit()
    {
        $data = [
            'user' => Auth::user(),
            'countries' => Countries::getNames(),
            'local' => Languages::getNames(),
            'section' => 'profile' ,
            'pageTitle' => 'edit' ,
        ];
        return view('dashboard.profile.edit',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function update($request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birthday' => 'nullable|date|before:today',
            'gender' => 'in:male,female',
            'country' => 'required|string|size:2',
        ]);
        $user = $request->user();

        $user->profile->fill($request->all())->save();

        Alert::success('done','updated');
        return redirect()->route('dashboard.profile.edit');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function destroy($request)
    {

    }
}
