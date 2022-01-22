@extends('frontend.layouts.app')
@section('content')

    <div class="container user_panel">


        @if (Route::has('login'))
            @php $pogress = 1;
                if(!empty($fdata['step'])){
                    if($fdata['step'] == 'two'){
                        $pogress = 2;
                    }elseif ($fdata['step'] == 'two'){
                        $pogress = 3;
                    }
                }

            @endphp


            <div class="contractor_apply">
                {{Form::open(array('url' => 'contractor_apply_submit', 'method' => 'post', 'id' => 'contactor-apply', 'class' => 'form-horizontal','files'=>'true'))}}
                <h2>তালিকাভূক্তি / তালিকাভূক্তি নবায়নের আবেদন</h2>

                {{ Form::hidden('id', (!empty($fdata['id']) ? $fdata['id'] : NULL), []) }}
                @if(Request::post('step') == 'two')
                    @include('frontend.contractor.contractor_profile_setp_two')
                @elseif(Request::post('step') == 'three')
                    @include('frontend.contractor.contractor_profile_setp_three')
                @else
                    @include('frontend.contractor.contractor_profile_setp_one')
                @endif

                {{ Form::close() }}

            </div>

        @endif
    </div>
@endsection

@section('cusjs')


    <script>
        $(document).ready(function () {

            $('input[name=application_type]').on('change', function() {
                master_function();
            });
            master_function();
            $(function () {
                $(".date-pick").datepicker({format: 'dd-mm-yyyy'}).val();
            });


            $('#upload_form').on('submit', function (event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('contractor_apply_file') }}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $('#message').css('display', 'block');
                        $('#message').html(data.message);
                        $('#message').addClass(data.class_name);
                        $('#uploaded_image').html(data.uploaded_image);
                    }
                })
            });


            window.upload_file = function (self) {
                var id = $(self).data('class');
                $("#myModal").modal();
            }


            function master_function() {
               var application_type =  $('input[name=application_type]:checked', '#contactor-apply').val();
                if(application_type == 'New'){
                    $('.reg_notification_no').html('তালিকাভুক্তি বিজ্ঞপ্তি নংঃ');
                    $('#reg_notification_no').attr('placeholder','তালিকাভুক্তি বিজ্ঞপ্তি নং...');
                }else {
                    $('.reg_notification_no').html('কন্টাক্টর আইডিঃ');
                    $('#reg_notification_no').attr('placeholder','কন্টাক্টর আইডি...');
                }
            }



        });
        function add_financial_ability(self) {
            var sl = $(self).data('sl');
            var sl_bn = '{{e_to_b('+sl+')}}';
            var sl_next = sl+1;
            var html = '';
                html += '<tr><th>#</th>';
                html += '<td><input required="" class="form-control" placeholder="অর্থের উৎস.." name="financial_ability['+sl+'][source_of_money]" type="text" value=""></td>';
                html += '<td><input required="" class="form-control" placeholder="অর্থের পরিমান.." name="financial_ability['+sl+'][amount]" type="text" value=""></td>';
                html += '<td><a class="btn btn-danger btn-xs" href="javascript:void(0)" onclick="remove_financial_ability(this);"> <i class="fa fa-minus-square" aria-hidden="true"></i></a></td>';
                html += '</tr>';
            $("#financial_ability_table tbody").append(html);
            $(self).data('sl',sl_next);


        }

        function add_construction_machinery(self) {
            var sl = $(self).data('sl');
            var sl_bn = '{{e_to_b('+sl+')}}';
            var sl_next = sl+1;
            var html = '';
            html += '<tr><th>#</th>';
            html += '<td><input required="" class="form-control" placeholder="যন্ত্রপাতির নাম.." name="construction_machinery['+sl+'][equipment_name]" type="text" value=""></td>';
            html += '<td><input required="" class="form-control" placeholder="সংখ্যা.." name="construction_machinery['+sl+'][qty]" type="number" value=""></td>';
            html += '<td><input required="" class="form-control" placeholder="সংগ্রহ / ক্রয়ের বছর.." name="construction_machinery['+sl+'][purchase_year]" type="text" value=""></td>';
            html += '<td><input required="" class="form-control" placeholder="টবর্তমান অবস্থা.." name="construction_machinery['+sl+'][current_status]" type="text" value=""></td>';
            html += '<td><a class="btn btn-danger btn-xs" href="javascript:void(0)" onclick="remove_construction_machinery(this);"> <i class="fa fa-minus-square" aria-hidden="true"></i></a></td>';
            html += '</tr>';
            $("#construction_machinery_table tbody").append(html);
            $(self).data('sl',sl_next);

        }
        
        function remove_financial_ability(self) {
            $(self).parents("tr").remove();
        }



        function remove_construction_machinery(self) {
            $(self).parents("tr").remove();
        }

        function upload_contactor_file(self) {
            var id = $(self).data('id');
            var name = $(self).data('name');
            var url = "{{ url('/contactor_file_upload') }}";

            var html = '';
            html += '<form method="post"  action="'+url+'" enctype="multipart/form-data" class="form-inline">';
            html += ' <div class="modal-body">';
            html += '{{ csrf_field() }}';
            html += '<input type="hidden" name="name" value="'+name+'"/>';
            html += '<input type="hidden" name="id" value="'+id+'"/>';
            html += '<div class="form-group"><input type="file" name="select_file" id="select_file" class="form-control"/> </div>';
            html += '</div>';

            html += '<div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button><button type="submit" class="btn btn-primary">Upload</button></div>';
            html += '</form>';
//alert(html);
            $("#default-model-title").html('File Upload');
            $("#default-model-data").html(html);
            $('#default-model').modal('show');
        }


    </script>
@endsection

