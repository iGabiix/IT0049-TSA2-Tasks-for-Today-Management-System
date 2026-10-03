<?php

namespace App\Controllers;

use App\Models\TaskModel;

class TaskController extends BaseController
{
    public function index()
    {
        $taskModel = new TaskModel();

        $data['title'] = 'All Tasks';
        $data['tasks'] = $taskModel
            ->orderBy('task_date', 'ASC')
            ->where('is_archived', 0)
            ->findAll();

        return view('tasks', $data);
    }

    public function createForm()
    {
        return view('task_form', ['title' => 'New Task', 'task' => null]);
    }

    public function create()
    {
        $rules = [
            'title' => 'required|max_length[150]',
            'task_date' => 'required|valid_date[Y-m-d]',
            'status' => 'required|in_list[pending,in progress,completed]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        (new TaskModel())->insert([
            'title' => trim((string) $this->request->getPost('title')),
            'status' => $this->request->getPost('status'),
            'task_date' => $this->request->getPost('task_date'),
            'is_archived' => 0,
        ]);

        return redirect()->to('/tasks')->with('message', 'Task created successfully.');
    }

    public function edit(int $id)
    {
        $task = (new TaskModel())->where('is_archived', 0)->find($id);

        if ($task === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Task not found.');
        }

        return view('task_form', ['title' => 'Edit Task', 'task' => $task]);
    }

    public function update(int $id)
    {
        $model = new TaskModel();
        $task = $model->where('is_archived', 0)->find($id);

        if ($task === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Task not found.');
        }

        $rules = [
            'title' => 'required|max_length[150]',
            'task_date' => 'required|valid_date[Y-m-d]',
            'status' => 'required|in_list[pending,in progress,completed]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model->update($id, [
            'title' => trim((string) $this->request->getPost('title')),
            'status' => $this->request->getPost('status'),
            'task_date' => $this->request->getPost('task_date'),
        ]);

        return redirect()->to('/tasks')->with('message', 'Task updated successfully.');
    }

    public function delete(int $id)
    {
        $model = new TaskModel();
        $task = $model->where('is_archived', 0)->find($id);

        if ($task === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Task not found.');
        }

        $model->update($id, ['is_archived' => 1]);

        return redirect()->to('/tasks')->with('message', 'Task archived successfully.');
    }
}
