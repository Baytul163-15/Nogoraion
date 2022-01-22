@extends('voyager::master')

@section('page_title','')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop



@section('content')
<div class="page-content container-fluid">
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-news"></i> Bit Police List
        </h1>
        <a href="{{route('bitpolice.add')}}" class="btn btn-success btn-add-new">
            <i class="voyager-plus"></i> <span>Add New</span>
        </a>
        <a href="{{route('bitpolice.group.index')}}" class="btn btn-info btn-add-new">
            <span> Groups</span>
        </a>


    </div>

    <div class="row">

        <div class="col-md-12">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <table id="dataTable" class="table table-striped table-responsive">
                        <tr>
                            <th style="width: 10px;"> # </th>
                            <th>Group Name</th>
                            <th> Designation</th>
                            <th>Phone</th>
                            <th>Mobile</th>
                            <th>Fax</th>
                            <th>Email</th>

                            <th>Status</th>


                            <th style="text-align: right; width:120px">
                                Action
                            </th>
                        </tr>

                        <!-- @dump($mdata) -->

                        @if($mdata)



                        @foreach($mdata as $key => $data)
                        <tr>
                            <td data-value="ID">{{ $key +1 }}</td>
                            <td>{{ isset($data->menu->name)? $data->menu->name : null }} </td>
                            <td>{{ $data->designation }} </td>
                            <td>{{ $data->phone }} </td>
                            <td>{{ $data->mobile }} </td>
                            <td>{{ $data->fax }} </td>
                            <td>{{ $data->email }} </td>
                            <td>{{ $data->is_active }} </td>

                            <td>
                                {{ Form::open(['route' => ['bitpolice.delete', $data->id], 'method' => 'delete']) }}
                                <div class="btn-group btn-group-sm pull-right">
                                    <a href="{{ route('bitpolice.edit', $data->id)}}" class="btn btn-info" target="_blank">
                                        <i class="voyager-edit" aria-hidden="true"></i>
                                    </a>
                                    <button onclick="return confirm('Are you sure?')" class="btn btn-danger">
                                        <i class="voyager-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                                {{ Form::close() }}

                            </td>
                        </tr>


                        @endforeach


                        @endif


                    </table>
                </div>
            </div>


        </div>
    </div>


</div>
@stop

@section('javascript')
<script>
    $('document').ready(function() {
        $('.toggleswitch').bootstrapToggle();
    });

    $(document).ready(function() {
        $('#dataTable').DataTable({


            "columnDefs": [{
                "targets": -1,
                "searchable": false,
                "orderable": false
            }]

        });
    });

    // jQuery(function() {

    //     jQuery('#dataTable').DataTable({
    //         'paging': true,
    //         'lengthChange': false,
    //         'searching': true,
    //         'ordering': true,
    //         'info': true,
    //         'autoWidth': true,
    //         'bInfo': true,
    //         "bPaginate": true,
    //         "bLengthChange": false,
    //         "bFilter": true,
    //         "bInfo": false,
    //         "bAutoWidth": true,
    //         "dom": '<"pull-left"f><"pull-right"l>tip',
    //         "language": {
    //             "paginate": {
    //                 "previous": "&lt;",
    //                 "next": "&gt;"
    //             }
    //         }

    //     })
    // })
</script>


@stop