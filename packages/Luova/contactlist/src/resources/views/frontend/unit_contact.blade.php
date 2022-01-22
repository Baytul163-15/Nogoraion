@extends('frontend.layouts.app')

@section('content')



<!-- main content section start -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="singleTitle postTitle">
                <h2>Unit Contact</h2>
            </div>
            <div class="contact-search">
                <div class="form-inline">
                    <div class="form-group">

                        {{ Form::select('menu_master',  get_contactlist_master_array(),
                                (!empty($fdata->menu_master) ? $fdata->menu_master : NULL),
                                ['id' => 'menu_master','class' => 'form-control', 'placeholder' => '--Select--']) 
                            }}

                    </div>

                    <div class="form-group" id="contactlistParent">

                    </div>
                    <div class="form-group" id="contactlistChild">

                    </div>
                    <div class="form-group">

                        <a href="{{url()->current()}}" class="btn btn-sm btn-danger"> Reset</a>

                    </div>
                </div>


            </div>
            <div id="viewTable">

            </div>

        </div>


    </div>
</div>






@endsection


@section('cusjs')
<style>
    .singleTitle.postTitle {
        text-align: center;
    }

    .contact-search {
        text-align: center;
        margin-bottom: 25px;
        background: #23569a;
        padding: 15px;
    }

    table.table.table-bordered tbody tr:first-child {
        background: #eee !important;
        color: #000 !important;
    }

    table.table.table-bordered thead tr {
        background: #ff7f50 !important;
        color: #000 !important;
    }
</style>
<script>
    jQuery(document).ready(function($) {
        $.noConflict();

        from_control();

        $(document).on('change', '#menu_master', function(e) {
            var type = 'master';
            var id = $('#menu_master').val();
           
            from_control(type, id);
        });
        $(document).on('change', '#menu_parent', function(e) {
            var type = 'parent';
            var id = $('#menu_parent').val();;
            from_control(type, id);

        });
        $(document).on('change', '#menu_child', function(e) {
            var type = 'child';
            var id = $('#menu_child').val();;
            from_control(type, id);

        });

        function from_control(type = null, id = null) {


            $.ajax({
                url: "{{route('contactlist.find')}}",
                method: 'get',
                data: {
                    id: id,
                    type: type
                },
                success: function(data) {
                    $('#viewTable').html(data.data);

                    if (type == 'master') {
                        $('#contactlistParent').html(data.parent);
                        $('#contactlistChild').html('');
                    }
                    if (type == 'parent') {
                        $('#contactlistChild').html(data.child);
                    }



                    console.log(data);
                },
                error: function() {}
            });

        }




    });
</script>
@endsection