<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientRequest;
use App\Models\Admin\Client;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{

    private $modelName = 'clients';

    public function index()
    {
        return view('admin.'.$this->modelName.'.index');
    }// end of index

    public function data()
    {
        $clients = Client::select();

        return DataTables::of($clients)
            ->addColumn('record_select', 'admin.'.$this->modelName.'.data_table.record_select')
            ->editColumn('created_at', function (Client $clients) {
                return $clients->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'admin.'.$this->modelName.'.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data

    public function create()
    {
        return view('admin.'.$this->modelName.'.create');

    }// end of create

    public function store(ClientRequest $request)
    {
        $requestData = $request->validated();
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $imgName = time().str_replace(" ","",$request->image->getClientOriginalName());
                $extension = $request->image->extension();
                $request->image->storeas($this->modelName.'/images/',$imgName, 'public'); 
                $requestData['image'] = $this->modelName."/images/".$imgName;
            }
        }
        $client = Client::create($requestData);

        session()->flash('success', 'Added Successfully');
        return redirect()->route('admin.'.$this->modelName.'.index');

    }// end of store

    public function edit(Client $client)
    {
        return view('admin.'.$this->modelName.'.edit', compact('client'));

    }// end of edit

    public function update(ClientRequest $request, Client $client)
    {
        $requestData = $request->validated();
        if ($request->hasFile('image')) {
            $this->deleteFile($client->image);
            if ($request->file('image')->isValid()) {
                $imgName = time().str_replace(" ","",$request->image->getClientOriginalName());
                $extension = $request->image->extension();
                $request->image->storeas($this->modelName.'/images/',$imgName, 'public'); 
                $requestData['image'] = $this->modelName."/images/".$imgName;
            }
        }
        $client->update($requestData);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.'.$this->modelName.'.index');

    }// end of update

    public function destroy(Client $client)
    {
        $this->delete($client);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $client = Client::FindOrFail($recordId);
            $this->deleteFile($client->image);
            $this->delete($client);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Client $client)
    {
        $this->deleteFile($client->image);
        $client->delete();

    }// end of delete

    
    private function deleteFile($name){
        return  File::delete(public_path('storage/').$name);
    }// end of delete file

}//end of controller
