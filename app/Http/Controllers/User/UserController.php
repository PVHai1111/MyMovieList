<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UserLoginRequest;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    function register()
    {
        return view('user.user.register');
    }

    function register_handle(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $user = $this->userService->createUser($validated);
        return redirect()->route('user.login');
    }
    function login()
    {
        return view('user.user.login');
    }

    function login_handle(UserLoginRequest $request)
    {
        $validate = $request->validated();
        if ($this->userService->checkLogin($validate)) {
            return redirect()->route('home.index');
        }
        return back()->withErrors(['login_error' => 'Incorrect login information']);
    }
    function logout() {
        Auth::logout();
        return back();
    }
}
