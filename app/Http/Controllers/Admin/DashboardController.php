<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalNews' => News::count(),
            'totalUsers' => User::count(),
            'latestNews' => News::latest()->take(5)->get(),
        ];

        return view('admin.dashboard', $data);
    }
} 