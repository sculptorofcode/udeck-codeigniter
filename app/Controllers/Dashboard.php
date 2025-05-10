<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Dashboard extends AuthController
{
    public function index()
    {
        // Check if user is authenticated
        $this->checkAuth();
        
        $taskModel = new TaskModel();
        $userId = $this->getUserId();
        
        // Get task counts by status
        $data = [
            'pendingCount' => count($taskModel->getTasksByUser($userId, 'pending')),
            'inProgressCount' => count($taskModel->getTasksByUser($userId, 'in-progress')),
            'completedCount' => count($taskModel->getTasksByUser($userId, 'completed')),
            // Get the 5 most recent tasks
            'recentTasks' => $taskModel->where('user_id', $userId)
                                      ->orderBy('created_at', 'DESC')
                                      ->limit(5)
                                      ->find()
        ];
        
        return view('dashboard', $data);
    }
}
