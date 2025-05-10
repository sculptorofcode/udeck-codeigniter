<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Tasks extends AuthController
{
    protected $taskModel;

    public function __construct()
    {
        $this->taskModel = new TaskModel();
    }

    public function index()
    {
        // Check if user is authenticated
        $this->checkAuth();

        $userId = $this->getUserId();
        $filter = $this->request->getGet('status');
        
        $data = [
            'tasks' => $this->taskModel->getTasksByUser($userId, $filter),
            'filter' => $filter
        ];
        
        return view('tasks/index', $data);
    }

    public function create()
    {
        // Check if user is authenticated
        $this->checkAuth();
        
        return view('tasks/create');
    }

    public function store()
    {
        // Check if user is authenticated
        $this->checkAuth();

        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'priority' => 'required|in_list[low,medium,high]',
            'status' => 'required|in_list[pending,in-progress,completed]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dueDate = $this->request->getPost('due_date');
        if (empty($dueDate)) {
            $dueDate = null;
        }

        $this->taskModel->save([
            'user_id' => $this->getUserId(),
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'status' => $this->request->getPost('status'),
            'priority' => $this->request->getPost('priority'),
            'due_date' => $dueDate,
        ]);

        return redirect()->to('/tasks')->with('success', 'Task created successfully');
    }

    public function edit($id = null)
    {
        // Check if user is authenticated
        $this->checkAuth();
        
        if ($id === null) {
            return redirect()->to('/tasks')->with('error', 'No task specified');
        }

        $task = $this->taskModel->find($id);
        
        // Check if task exists and belongs to current user
        if (!$task || $task['user_id'] != $this->getUserId()) {
            return redirect()->to('/tasks')->with('error', 'Task not found or access denied');
        }
        
        $data = [
            'task' => $task
        ];
        
        return view('tasks/edit', $data);
    }

    public function update($id = null)
    {
        // Check if user is authenticated
        $this->checkAuth();
        
        if ($id === null) {
            return redirect()->to('/tasks')->with('error', 'No task specified');
        }

        $task = $this->taskModel->find($id);
        
        // Check if task exists and belongs to current user
        if (!$task || $task['user_id'] != $this->getUserId()) {
            return redirect()->to('/tasks')->with('error', 'Task not found or access denied');
        }
        
        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'priority' => 'required|in_list[low,medium,high]',
            'status' => 'required|in_list[pending,in-progress,completed]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dueDate = $this->request->getPost('due_date');
        if (empty($dueDate)) {
            $dueDate = null;
        }

        $this->taskModel->update($id, [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'status' => $this->request->getPost('status'),
            'priority' => $this->request->getPost('priority'),
            'due_date' => $dueDate,
        ]);

        return redirect()->to('/tasks')->with('success', 'Task updated successfully');
    }

    public function delete($id = null)
    {
        // Check if user is authenticated
        $this->checkAuth();
        
        if ($id === null) {
            return redirect()->to('/tasks')->with('error', 'No task specified');
        }

        $task = $this->taskModel->find($id);
        
        // Check if task exists and belongs to current user
        if (!$task || $task['user_id'] != $this->getUserId()) {
            return redirect()->to('/tasks')->with('error', 'Task not found or access denied');
        }
        
        $this->taskModel->delete($id);
        
        return redirect()->to('/tasks')->with('success', 'Task deleted successfully');
    }
}
