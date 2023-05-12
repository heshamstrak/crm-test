@extends('admin.index')

@section('content')

    <div>
        <h2>Admins</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.admins.index') }}">Admins</a></li>
        <li class="breadcrumb-item">Edit</li>
    </ul>
    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.admins.update', $admin->id) }}">
                    @csrf
                    @method('put')

                    @include('admin.partials._errors')

                    {{--name--}}
                    <div class="form-group">
                        <label>name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $admin->name) }}" required>
                    </div>

                    {{--email--}}
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}" required>
                    </div>



                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection