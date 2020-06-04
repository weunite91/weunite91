<script src="{{ asset('public/backend/assets/plugins/jquery/jquery.min.js') }}" ></script>

<script src="{{ asset('public/backend/assets/plugins/popper/popper.min.js') }}" ></script>
<script src="{{ asset('public/backend/assets/plugins/jquery-blockui/jquery.blockui.min.js') }}" ></script>
<script src="{{ asset('public/backend/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- bootstrap -->
<script src="{{ asset('public/backend/assets/plugins/bootstrap/js/bootstrap.min.js') }}" ></script>
<script src="{{ asset('public/backend/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" ></script>
<script src="{{ asset('public/backend/assets/plugins/sparkline/jquery.sparkline.min.js') }}" ></script>
<script src="{{ asset('public/backend/assets/js/pages/sparkline/sparkline-data.js') }}" ></script>
<!-- Common js-->
<script src="{{ asset('public/backend/assets/js/app.js') }}" ></script>
<script src="{{ asset('public/backend/assets/js/layout.js') }}" ></script>
<script src="{{ asset('public/backend/assets/js/theme-color.js') }}" ></script>
<!-- material -->
<script src="{{ asset('public/backend/assets/plugins/material/material.min.js') }}"></script>
<!-- animation -->
<script src="{{ asset('public/backend/assets/js/pages/ui/animations.js') }}" ></script>
<!-- morris chart -->


<script src="{{ asset('public/frontend/js/validate/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/backend/assets/plugins/datatables/jquery.dataTables.min.js') }}" ></script>
<script src="{{ asset('public/backend/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js') }}" ></script>
<script src="{{ asset('public/backend/assets/plugins/datatables/plugins/bootstrap/select.js') }}" ></script>
<script src="http://cdn.datatables.net/plug-ins/1.10.19/pagination/select.js" ></script>
<script src="{{ asset('public/backend/assets/js/comman_function.js') }}" ></script>
<script src="{{ asset('public/backend/assets/js/toastr.min.js') }}" ></script>

@if (!empty($pluginjs))
@foreach ($pluginjs as $value)
<script src="{{ url('public/backend/assets/js/plugins/'.$value) }}" type="text/javascript"></script>
@endforeach
@endif
@if (!empty($js))
@foreach ($js as $value)
<script src="{{ url('public/backend/assets/js/customjs/'.$value) }}" type="text/javascript"></script>
@endforeach
@endif
<script>
jQuery(document).ready(function() {
@if (!empty($funinit))
        @foreach ($funinit as $value)
{{ $value }}
@endforeach
        @endif
}
);
</script>

<div id="deleteModel" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12"><h3 class="m-t-none m-b">Delete Record</h3>
                        Are You sure want to delete record ?<br/>
                        <input type="hidden" value="0" id="hidmodalDeleteId" />
                            <div>
                                <button class="btn btn-sm btn-primary pull-right m-l" style="margin: 10px;"data-dismiss="modal">Cancel</button>
                                <button class="btn btn-sm btn-danger pull-right yes-sure m-l btnDelete" style="margin: 10px;"  type="button" ><strong><i class="fa fa-trash"></i> Delete </strong></button>
                            </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div id="passcodeModel" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12"><h3 class="m-t-none m-b">Generate Passcode</h3>
                        Are You sure want to Generate Passcode ?<br/>
                        <input type="hidden" value="0" id="hidmodalDeleteId" />
                            <div>
                                <button class="btn btn-sm btn-primary pull-right m-l" style="margin: 10px;" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-sm btn-success pull-right passcode-yes-sure m-l" style="margin: 10px;"  type="button" ><strong> Generate Passcode </strong></button>
                            </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div id="ReactivateModel" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12"><h3 class="m-t-none m-b">Reactivate User Profile</h3>
                        Are You sure want to Reactviate Profile ?<br/>

                            <div>
                                <button class="btn btn-sm btn-primary pull-right m-l" style="margin: 10px;"data-dismiss="modal">Cancel</button>
                                <button class="btn btn-sm btn-danger pull-right reactivate-yes-sure m-l " style="margin: 10px;"  type="button" ><strong><i class="fa fa-check-circle"></i> ReActivate </strong></button>
                            </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
