<div class="panel panel-default">
    <div class="panel-heading" style="padding:15px">Type info</div>
    <div class="panel-body">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col" style="width: 20px">#</th>
                    <th scope="col" style="width: 40%">Titel</th>
                    <th scope="col" style="width: 40%">Link</th>
                    <th scope="col" style="width: 15%">Target</th>
                    <th scope="col" style="width: 5%">Action </th>


                </tr>
            </thead>
            <tbody id="appendRow">

                @if($fdata && $fdata->listing)
                {{-- Start Edit form data  --}}
                @php
                $listing = json_decode($fdata->listing, true);
                $rn = array_key_last($listing) + 1;
                @endphp
                @include('widget::part.listingpart.edit_form', ['rows' => $listing])
                {{-- End Edit form data  --}}
                @else
                @php
                $default_form = [1,2,3,4,5];
                $rn = 5;
                @endphp
                @include('widget::part.listingpart.default_form', ['rows' => $default_form])
                @endif



            </tbody>

            <tfoot>
                <tr>
                    <td colspan="6" style="text-align: right;">
                        <button class="btn btn-info btn-sm" style="margin-top: 7px;" onclick="append_row();"
                            type="button">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Add More
                        </button>
                    </td>

                </tr>
            </tfoot>
        </table>

    </div>
</div>

@section('javascript')
<script>
    var count = "{{$rn + 1}}";
    count = Number(count);
    jQuery(document).ready(function($) {
        $(document).on('click', '.removeRow', function(e) {
            var id = $(this).data('id');

            $('#row-' + id).remove();

        });


    });

    function append_row() {
        var $ = jQuery;
        
            let route = "{{ route('lvwidget.ajax.rowitem') }}";
            var rows = count;
            $.ajax({
                type:'GET',
                url:route,
                data:{
                    rows:rows
                },
                success:function(data){
                    console.log(data.html);
                    $('#appendRow').append(data.html);
                     count = count + 1;
                }
            });
    }
</script>
@stop