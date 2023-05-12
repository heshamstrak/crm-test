@extends('admin.index')

@section('content')

    <div>
        <h2>Projects</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.projects.index') }}">Projects</a></li>
        <li class="breadcrumb-item">Edit</li>
    </ul>
    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.projects.update', $project->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    @include('admin.partials._errors')

          
                    {{--name--}}
                    <div class="form-group">
                        <label>title <span class="text-danger">*</span></label>
                        <input type="text" name="title" autofocus class="form-control" value="{{ old('title', $project->title) }}" required>
                    </div>

                    {{--description--}}
                    <div class="form-group">
                        <label>Description <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control" cols="30" rows="10" required>{{ old('description', $project->description) }}</textarea>
                    </div>

                    {{--deadline--}}
                    <div class="form-group">
                        <label>Deadline <span class="text-danger">*</span></label>
                        <input type="date" name="deadline" class="form-control" value="{{ old('deadline', $project->deadline) }}" required>
                    </div>

                    {{--User--}}
                    <div class="form-group">
                        <label>User <span class="text-danger">*</span></label>
                        <select name="user_id" class="form-control">
                            @foreach ($users as $user)
                                <option value="{{$user->id}}" {{ $project->user_id == $user->id ? 'selected' : '' }}>{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>

                     {{--Client--}}
                     <div class="form-group">
                        <label>Client <span class="text-danger">*</span></label>
                        <select name="client_id" class="form-control">
                            @foreach ($clients as $client)
                                <option value="{{$client->id}}" {{ $project->client_id == $client->id ? 'selected' : '' }}>{{$client->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    {{--Status--}}
                    <div class="form-group" >
                        <label>Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control">
                            <option value="0" {{ $project->status == 0 ? 'selected' : '' }}>close</option>
                            <option value="1" {{ $project->status == 1 ? 'selected' : '' }}>open</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection