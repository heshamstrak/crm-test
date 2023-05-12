@extends('admin.index')

@section('content')

<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title mb-0">Projects</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">Projects
            </li>
          </ol>
        </div>
      </div>
    </div>
</div>

  <div class="content-body"><!-- Basic Tables start -->
    <div class="row">
        
        <div class="col-12">
            <div class="card">
                <div style="padding: 20px">

                    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Create</a>

                    <form method="post" action="{{ route('admin.projects.bulk_delete') }}" style="display: inline-block;">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="record_ids" id="record-ids">
                        <button type="submit" class="btn btn-danger" id="bulk-delete" disabled="true"><i class="fa fa-trash"></i> Delete</button>
                    </form><!-- end of form -->

                    <div class="row" style="margin-top:20px">

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" id="data-table-search" class="form-control" autofocus placeholder="Search">
                            </div>
                        </div>
    
                    </div><!-- end of row -->
                </div>


  

                <div class="card-content collapse show">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table datatable" id="admins-table" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>
                                        <div class="animated-checkbox">
                                            <label class="m-0">
                                                <input type="checkbox" id="record__select-all">
                                                <span class="label-text"></span>
                                            </label>
                                        </div>
                                    </th>
                                    <th>Title</th>
                                    <th>Deadline</th>
                                    <th>Client</th>
                                    <th>User</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                            </table>

                        </div>
                    </div>
            
                </div>
            </div>
        </div>
    </div>
    <!-- Basic Tables end -->
    
</div>







@endsection







@push('js')

    <script>

        let adminsTable = $('#admins-table').DataTable({
            dom: "tiplr",
            serverSide: true,
            processing: true,
            ajax: {
                url: '{{ route('admin.projects.data') }}',
            },
            columns: [
                {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
                {data: 'title', name: 'title'},
                {data: 'deadline', name: 'deadline'},
                {data: 'client_id', name: 'client_id'},
                {data: 'user_id', name: 'user_id'},
          
                {data: 'created_at', name: 'created_at', searchable: false},
                {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%'},
            ],
            order: [[4, 'desc']],
            drawCallback: function (settings) {
                $('.record__select').prop('checked', false);
                $('#record__select-all').prop('checked', false);
                $('#record-ids').val();
                $('#bulk-delete').attr('disabled', true);
            }
        });

        $('#data-table-search').keyup(function () {
            adminsTable.search(this.value).draw();
        })


    </script>

@endpush