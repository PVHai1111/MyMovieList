<?php

namespace App\Services;

use App\Models\Report;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
class ReportService
{

    public function createReport(array $data)
    {
        return Report::create([
            'reason' => $data['reason'],
            'reportable_id' => $data['reportable_id'],
            'reportable_type' => $data['reportable_type'],
        ]);
    }
}
