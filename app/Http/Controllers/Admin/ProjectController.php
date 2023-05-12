<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProjectRequest;
use App\Models\Admin\Project;
use App\Models\Admin\Client;
use App\Models\User;
use Yajra\DataTables\DataTables;

class ProjectController extends Controller
{

    private $modelName = 'projects';

    public function index()
    {
        return view('admin.'.$this->modelName.'.index');
    }// end of index

    public function data()
    {
        $projects = Project::select();

        return DataTables::of($projects)
            ->addColumn('record_select', 'admin.'.$this->modelName.'.data_table.record_select')
            ->addColumn('client_id', function (Project $projects) {
                return $projects->client()->name;
            })
            ->addColumn('user_id', function (Project $projects) {
                return $projects->user()->name;
            })
            ->editColumn('created_at', function (Project $projects) {
                return $projects->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'admin.'.$this->modelName.'.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data

    public function create()
    {
        $clients = Client::get();
        $users = User::get();

        return view('admin.'.$this->modelName.'.create', compact('clients', 'users'));

    }// end of create

    public function store(ProjectRequest $request)
    {
        $requestData = $request->validated();

        $project = Project::create($requestData);

        session()->flash('success', 'Added Successfully');
        return redirect()->route('admin.'.$this->modelName.'.index');

    }// end of store

    public function edit(Project $project)
    {
        $clients = Client::get();
        $users = User::get();
        return view('admin.'.$this->modelName.'.edit', compact('project', 'clients', 'users'));

    }// end of edit

    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->validated());
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.'.$this->modelName.'.index');

    }// end of update

    public function destroy(Project $project)
    {
        $this->delete($project);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $project = Project::FindOrFail($recordId);
            $this->delete($project);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Project $project)
    {
        $project->delete();

    }// end of delete

}//end of controller
