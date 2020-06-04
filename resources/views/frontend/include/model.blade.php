@php
$currentRoute = Route::current()->getName();
@endphp


@if($currentRoute == 'fund-details' || $currentRoute == 'fund-raiser-dashborad' || $currentRoute == 'payment' || $currentRoute == 'planlist' || $currentRoute == 'investor-dashboard' || $currentRoute == 'franchise' || $currentRoute == 'partners')

<div class="modal fade" id="deletemodel" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Delete Record </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are You sure want to delete your company details ?</p><br/>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-primary pull-right m-l" style="margin: 10px;"data-dismiss="modal">Cancel</button>
                <button class="btn btn-sm btn-danger pull-right yes-sure-deleteprofile m-l" style="margin: 10px;"  type="button"><strong><i class="fa fa-trash"></i> Delete </strong></button>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="revokemodel" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Revoke Offer </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are You sure want to revoke your offer ?</p><br/>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-primary pull-right m-l" style="margin: 10px;"data-dismiss="modal">Cancel</button>
                <button class="btn btn-sm btn-danger pull-right revoke m-l" style="margin: 10px;"  type="button"><strong><i class="fa fa-trash"></i> Revoke </strong></button>
            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Upload Profile Picture</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                {{ csrf_field() }}
                <form method="post" action="{{ route('editprofilepic') }}" enctype="multipart/form-data" id="profileimage">
                    <div class="inline-input" style="width: 100%">
                        <center>
                            <input type="file" name="profileimage_new"  placeholder="Enter Partner Code" accept='image/*'/>
                        </center>
                    </div>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" >Edit Profile Picture</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

@endif

