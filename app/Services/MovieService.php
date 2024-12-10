<?php

namespace App\Services;

use App\Models\Cat;
use App\Models\Movie;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MovieService
{
    public function createMovie(array $data)
    {
        return Movie::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'duration' => $data['duration'],
            'thumb' => $data['thumb'],
            'release_year' => $data['release_year'],
            'serie_id' => $data['serie_id'],
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

    public function updateMovie($id, array $data)
    {
        $movie = Movie::find($id);
        $movie->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'duration' => $data['duration'],
            'thumb' => $data['thumb'],
            'release_year' => $data['release_year'],
            'serie_id' => $data['serie_id'],
        ]);
        return $movie;
    }
}
