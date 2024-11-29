<?php

namespace App\Services;

use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MemberService
{
    public function uploadFile(UploadedFile $file)
    {
        if ($file->isValid()) {
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            
            $filePath = $file->storeAs('public', $fileName);
            
            return str_replace('public/', 'storage/', $filePath);;
        }
        
        return null;
    }

    public function deleteFile(string $filePath)
    {
        return Storage::delete($filePath);
    }

    public function createMember(array $data){
        return Member::create([
            'name' => $data['name'],
            'biography' => $data['biography'],
            'dob' => $data['dob'],
            'dod' => $data['dod'],
            'role' => $data['role'],
            'thumb' => $data['thumb']
        ]);
    }

    public function updateMember($id, array $data){
        return Member::find($id)->update([
            'name' => $data['name'],
            'biography' => $data['biography'],
            'dob' => $data['dob'],
            'dod' => $data['dod'],
            'role' => $data['role'],
            'thumb' => $data['thumb']
        ]);
    }
}
