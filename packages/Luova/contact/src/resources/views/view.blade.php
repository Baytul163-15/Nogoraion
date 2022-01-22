@extends('voyager::master')

@section('page_title','')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop



@section('content')
<div class="page-content container-fluid">
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-news"></i> Contacts Email
        </h1>

        <a href="{{route('contact.index')}}" class="btn btn-danger btn-add-new">
            <i class="voyager-angle-left"></i> <span>Back</span>
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
                    <div class="row">
                        <div class="col-md-6">
                            <b> Nmae:</b> {{ $fdata->name }}<br>
                            <b> Eamil:</b> {{ $fdata->email }}<br>
                            <b> Subject:</b> {{ $fdata->subject }}

                        </div>
                        <div class="col-md-6 text-right">
                            <b> Date: </b> {{ date('d-M-Y h:i a', strtotime($fdata->created_at ))}}<br>
                            <b> To: </b>{{ $fdata->to_mail }}

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            {!! $fdata->message !!}

                        </div>

                    </div>


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