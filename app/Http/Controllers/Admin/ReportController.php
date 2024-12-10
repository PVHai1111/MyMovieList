<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    function show()
    {
        $reports = Report::orderBy('created_at')->paginate(10);
        $count = 1;
        return view('admin.reports.show', compact('reports', 'count'));
    }

    function delete($id)
    {
        $report = Report::find($id);
        $report->delete();
        return redirect()->back();
    }
}
