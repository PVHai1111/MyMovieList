<?php

namespace App\Services;

use App\Models\Cat;
use Illuminate\Support\Facades\Hash;

class CatService
{
    public function createCat(array $data)
    {
        return Cat::create([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);
    }

    public function updateCat($id, array $data)
    {
        return Cat::find($id)->update([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);
    }
}
