<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with task statistics.
     */
    public function index()
    {
        $userId = auth('web')->id();
        
        // Get task statistics
        $totalTasks = Task::where('user_id', $userId)->count();
        $completedTasks = Task::where('user_id', $userId)
            ->where('status', 'completed')
            ->count();
        $pendingTasks = Task::where('user_id', $userId)
            ->where('status', 'pending')
            ->count();
        $inProgressTasks = Task::where('user_id', $userId)
            ->where('status', 'in_progress')
            ->count();
        
        // Get recent tasks (last 5)
        $recentTasks = Task::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('dashboard', compact(
            'totalTasks',
            'completedTasks',
            'pendingTasks',
            'inProgressTasks',
            'recentTasks'
        ));
    }
}
