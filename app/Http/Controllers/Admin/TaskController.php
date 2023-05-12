<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TaskRequest;
use App\Models\Admin\Task;
use App\Models\Admin\Project;
use Yajra\DataTables\DataTables;

class TaskController extends Controller
{

    private $modelName = 'tasks';

    public function index()
    {
        return view('admin.'.$this->modelName.'.index');
    }// end of index

    public function data()
    {
        $tasks = Task::select();

        return DataTables::of($tasks)
            ->addColumn('record_select', 'admin.'.$this->modelName.'.data_table.record_select')
            ->addColumn('project_id', function (Task $tasks) {
                return $tasks->project()->title;
            })
            ->editColumn('created_at', function (Task $tasks) {
                return $tasks->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'admin.'.$this->modelName.'.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data

    public function create()
    {
        $projects = Project::get();
        return view('admin.'.$this->modelName.'.create', compact('projects'));

    }// end of create

    public function store(TaskRequest $request)
    {
        $requestData = $request->validated();

        $tasks = Task::create($requestData);

        session()->flash('success', 'Added Successfully');
        return redirect()->route('admin.'.$this->modelName.'.index');

    }// end of store

    public function edit(Task $task)
    {
        $projects = Project::get();
        return view('admin.'.$this->modelName.'.edit', compact('task', 'projects'));

    }// end of edit

    public function update(TaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.'.$this->modelName.'.index');

    }// end of update

    public function destroy(Task $task)
    {
        $this->delete($task);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $task = Task::FindOrFail($recordId);
            $this->delete($task);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Task $task)
    {
        $task->delete();

    }// end of delete

}//end of controller
