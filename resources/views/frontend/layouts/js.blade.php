<!-- Modal -->
<div class="modal fade" id="default-model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="default-model-title"></h4>
            </div>
            <div id="default-model-data">
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->

<script src="{{ asset('/frontend/js/jquery.min.js') }}"></script>
<script>
    window.jQuery || document.write('<script src="js/vendor/jquery-3.2.1.min.js"><\/script>')
</script>
<script src="{{ asset('/frontend/js/plugins.js') }}"></script>
<script src="{{ asset('/frontend/js/mousewheel.js') }}"></script>
<script src="{{ asset('/frontend/js/main.js') }}"></script>
<script src="{{ asset('/frontend/js/lightslider.min.js') }}"></script>




<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    @if(Session::has('swal_warning'))
    swal("সতর্কীকরণ!", "<?= Session::get('swal_warning'); ?>", "warning");
    @endif

    @if(Session::has('swal_error'))

    swal("ত্রুটি!", "<?= Session::get('swal_error'); ?>", "error");
    @endif

    @if(Session::has('swal_success'))
    swal("সফল!", "<?= Session::get('swal_success'); ?>", "success");
    @endif

    @if(Session::has('swal_info'))
    swal("তথ্য", "<?= Session::get('swal_info'); ?>", "info");
    @endif
</script>

<style type="text/css">
    #hidden_div {
        display: none;
    }
</style>