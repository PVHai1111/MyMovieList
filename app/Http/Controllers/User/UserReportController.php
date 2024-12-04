<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Http\Requests\StoreReportRequest;
use App\Services\ReportService;
class UserReportController extends Controller
{
    //
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }
    function handle(StoreReportRequest $request){
        $validate = $request->validated();
        $report = $this->reportService->createReport($validate);
        return response()->json($report);
    }
}
