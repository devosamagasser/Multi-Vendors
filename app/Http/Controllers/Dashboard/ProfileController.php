<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Dashboard\UsersInterface;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function __construct(UsersInterface $interface)
    {
        $this->interface = $interface;
        $this->middleware(['auth','verified']);
    }

    public function edit()
    {
        return $this->interface->edit();
    }

    public function update(Request $request)
    {
        return $this->interface->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->interface->destroy($request);
    }
}
