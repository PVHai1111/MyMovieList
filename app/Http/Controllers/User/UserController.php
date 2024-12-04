<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UpdateUserRequest;
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
        return redirect()->route('login');
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
    function logout()
    {
        Auth::logout();
        return back();
    }

    function edit()
    {
        $user = Auth::user();
        return view('user.user.edit', compact('user'));
    }

    function update(UpdateUserRequest $request)
    {
        $validate = $request->validated();
        if ($request->hasFile('thumb')) {
            $file = $request->file('thumb');
            $filePath = $this->userService->uploadFile($file);
            if ($filePath) {
                $validate['thumb'] = $filePath;
            }
        } else $validate['thumb'] = Auth::user()->thumb;
        $this->userService->updateCurrentUser($validate);
        return redirect()->route('user.edit');
    }
}
