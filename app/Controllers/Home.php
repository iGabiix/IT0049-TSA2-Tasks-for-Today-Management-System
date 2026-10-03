<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Home extends BaseController
{
    public function index()
    {
        $taskModel = new TaskModel();

        $data['title'] = "Today's Tasks";
        $data['tasks'] = $taskModel
            ->where('task_date', date('Y-m-d'))
            ->where('is_archived', 0)
            ->orderBy('id', 'ASC')
            ->findAll();

        return view('home', $data);
    }
}
