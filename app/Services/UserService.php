<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
class UserService
{
    public function createUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function checkLogin(array $data){
        return Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    public function uploadFile(UploadedFile $file)
    {
        if ($file->isValid()) {
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            
            $filePath = $file->storeAs('public', $fileName);
            
            return str_replace('public/', 'storage/', $filePath);;
        }
        
        return null;
    }

    public function updateCurrentUser(array $data){
        $user = Auth::user();
        $user->name = $data['name'];
        if ($data['password']) {
            $user->password = Hash::make($data['password']);
        }
        $user->thumb = $data['thumb'];
        $user->save();
    }
}
