@extends('admin.index')

@section('content')

    <div>
        <h2>Clients</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.clients.index') }}">Clients</a></li>
        <li class="breadcrumb-item">Edit</li>
    </ul>
    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.clients.update', $client->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    @include('admin.partials._errors')

                    {{--name--}}
                    <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" autofocus class="form-control" value="{{ old('name', $client->name) }}" required>
                    </div>

                    {{--email--}}
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $client->email) }}" required>
                    </div>

                    {{--phone--}}
                    <div class="form-group">
                        <label>Phone Number <span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $client->phone) }}" required>
                    </div>

                    {{--Image--}}
                    <div class="form-group">
                        <label>Image <span class="text-danger">*</span></label>
                        <input type="file" name="image" class="form-control" value="">
                    </div>
                    <div class="card"  style="height: 150px; width: 150px">
                        <img src="{{$client->image_path}}" alt="">
                    </div>

                    <br><br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection