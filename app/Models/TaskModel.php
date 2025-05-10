<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table            = 'tasks';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'title', 'description', 'status', 'priority', 'due_date'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'user_id'     => 'required|integer',
        'title'       => 'required|min_length[3]|max_length[255]',
        'description' => 'permit_empty',
        'status'      => 'required|in_list[pending,in-progress,completed]',
        'priority'    => 'required|in_list[low,medium,high]',
        'due_date'    => 'permit_empty|valid_date',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;

    // Find tasks by user
    public function getTasksByUser($userId, $status = null)
    {
        $query = $this->where('user_id', $userId);
        
        if ($status !== null) {
            $query = $query->where('status', $status);
        }
        
        return $query->orderBy('due_date', 'ASC')->findAll();
    }
}
