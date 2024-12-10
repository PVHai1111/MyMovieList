<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\UpdateUserStatusRequest;

class AdminUserController extends Controller
{
    function show()
    {
        $users = User::where('id', '!=', Auth::id())->orderBy('created_at')->paginate(10);
        $count = 1;
        return view('admin.users.show', compact('users', 'count'));
    }

    function edit($id)
    {
        if (Auth::user()->id != $id) {
            $user = User::find($id);
            return view('admin.users.edit', compact('user'));
        }
        return redirect()->back()->withErrors(['error' => 'You cannot access this user']);
    }

    function update($id, UpdateUserStatusRequest $request)
    {
        if (Auth::user()->id != $id) {
            $validate = $request->validated();
            $status = $validate['status'];
            $user = User::find($id);
            $user->status = $status;
            $user->save();
            return redirect()->route('admin.user.show');
        }
        return redirect()->back()->withErrors(['error' => 'You cannot access this user']);
    }

    function delete($id){
        if (Auth::user()->id != $id) {
            $user = User::find($id);
            $user->delete();
            return redirect()->route('admin.user.show');
        }
        return redirect()->back()->withErrors(['error' => 'You cannot access this user']);
    }
}
