<?php

namespace App\Http\Controllers\Auth\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\ReportedPost;

class DashboardController extends Controller
{
    public function index()
    {
        $reports = ReportedPost::orderBy('is_accepted', 'ASC')->get();
        // dd(($reports[0]->post_id)->title);
        return view('dashboard.index', [
            'reports' => $reports
        ]);
    }
}
