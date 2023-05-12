<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\User;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{

    public function index()
    {
        return view('admin.admins.index');

    }// end of index

    public function data()
    {
        $admins = User::select();

        return DataTables::of($admins)
            ->addColumn('record_select', 'admin.admins.data_table.record_select')
            ->editColumn('created_at', function (User $admin) {
                return $admin->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'admin.admins.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data

    public function create()
    {
        return view('admin.admins.create');

    }// end of create

    public function store(AdminRequest $request)
    {
        $requestData = $request->validated();
        $requestData['password'] = bcrypt($request->password);

        $admin = User::create($requestData);

        session()->flash('success', 'Added Successfully');
        return redirect()->route('admin.admins.index');

    }// end of store

    public function edit(User $admin)
    {
        return view('admin.admins.edit', compact('admin'));

    }// end of edit

    public function update(AdminRequest $request, User $admin)
    {
        $admin->update($request->validated());
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.admins.index');

    }// end of update

    public function destroy(User $admin)
    {
        $this->delete($admin);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $admin = User::FindOrFail($recordId);
            $this->delete($admin);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(User $admin)
    {
        $admin->delete();

    }// end of delete

}//end of controller
