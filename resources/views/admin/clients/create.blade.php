@extends('admin.index')

@section('content')

    <div>
        <h2>Clients</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.clients.index') }}">Clients</a></li>
        <li class="breadcrumb-item">Create</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.clients.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    @include('admin.partials._errors')

                    {{--name--}}
                    <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" autofocus class="form-control" value="{{ old('name') }}" required>
                    </div>

                    {{--email--}}
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>

                    {{--phone--}}
                    <div class="form-group">
                        <label>Phone Number <span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                    </div>

                    {{--Image--}}
                    <div class="form-group">
                        <label>Image <span class="text-danger">*</span></label>
                        <input type="file" name="image" class="form-control" value="" required>
                    </div>

         

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>Create</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection