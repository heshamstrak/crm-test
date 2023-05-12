@extends('admin.index')

@section('content')

    <div>
        <h2>Tasks</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.tasks.index') }}">Tasks</a></li>
        <li class="breadcrumb-item">Create</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.tasks.store') }}" >
                    @csrf
                    @method('post')

                    @include('admin.partials._errors')

                    {{--name--}}
                    <div class="form-group">
                        <label>title <span class="text-danger">*</span></label>
                        <input type="text" name="title" autofocus class="form-control" value="{{ old('title') }}" required>
                    </div>

                    {{--description--}}
                    <div class="form-group">
                        <label>Description <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control" cols="30" rows="10" required>{{ old('description') }}</textarea>
                    </div>

                    {{--deadline--}}
                    <div class="form-group">
                        <label>Deadline <span class="text-danger">*</span></label>
                        <input type="date" name="deadline" class="form-control" value="{{ old('deadline') }}" required>
                    </div>

                    {{--Projects--}}
                    <div class="form-group">
                        <label>Projects <span class="text-danger">*</span></label>
                        <select name="project_id"  class="form-control" >
                            @foreach ($projects as $project)
                                <option value="{{$project->id}}" {{ old('project_id') == $project->id ? 'selected' : '' }}>{{$project->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    {{--Status--}}
                    <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <select name="status"  class="form-control" >
                            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>close</option>
                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>open</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>Create</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection