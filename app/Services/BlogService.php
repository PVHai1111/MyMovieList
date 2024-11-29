<?php

namespace App\Services;

use App\Models\Blog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class BlogService
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

    public function createBlog(array $data)
    {
        return Blog::create([
            'content' => $data['content'],
            'title' => $data['title'],
            'user_id' => $data['user_id'],
            'thumb' => $data['thumb'],
        ]);
    }

    public function updateBlog($id, array $data)
    {
        return Blog::find($id)->update([
            'content' => $data['content'],
            'title' => $data['title'],
            'thumb' => $data['thumb']
        ]);
    }
}
