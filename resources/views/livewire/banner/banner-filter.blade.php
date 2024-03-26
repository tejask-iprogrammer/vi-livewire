<div>
<livewire:banner.banner></livewire:banner.banner>
<div class="table-actions-wrapper">
            <button class="btn btn-sm red table-group-action-delete  deleteData btn btn-primary"><i class="fa fa-trash"></i> Delete</button>
            <select class="form-control changeStatus">
                <option value="" selected>Change Status</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
            <button class="btn btn-sm yellow table-group-action-copy CopyData btn btn-primary"><i class="fa fa-copy"></i> Copy</button>
        </div>
    <div class="table-responsive">
        <table class="myTable" id="myTable">
        <thead>
            <tr>
                <th><input type="checkbox" value="All" id="chkAll" class="form-check-input chkAll"  /></th>
                <th><span class="wordBreak fw-bold">Banner Title<span></th>
                <th><span class="wordBreak fw-bold">Lob<span><span></th>
                <th><span class="wordBreak fw-bold">Postpaid Persona<span></th>
                <th><span class="wordBreak fw-bold">Login Type<span></th>
                <th><span class="wordBreak fw-bold">Brand<span></th>
                <th><span class="wordBreak fw-bold">Circle<span></th>
                <th><span class="wordBreak fw-bold">App Version<span></th>
                <th><span class="wordBreak fw-bold">Screen<span></th>
                <th><span class="wordBreak fw-bold">OS<span></th>
                <th><span class="wordBreak fw-bold">Rank<span></th>
                <th><span class="wordBreak fw-bold">Link<span></th>
                <th><span class="wordBreak fw-bold">Status<span></th>
                <th><span class="wordBreak fw-bold">Updated At<span></th>
                <th><span class="wordBreak lastClass fw-bold">Options<span></th>
            </tr>
            <tr>
            <td>
                </td>
                <td>
                    <span class="wordBreak">
                        <input type="text" class="form-control" wire:model.live="banner_title"/>
                    </span>
                </td>
                <td><span class="wordBreak">
                        <select class="form-control" wire:model.live="lob">
                        <option value="">Select....</option>
                            @foreach($lobList as $key=>$value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </span>
                </td>
                <td>
                    <span class="wordBreak">
                        <select class="form-control" wire:model.live="postpaid_persona">
                        <option value="">Select....</option>
                            @foreach($postpaidPersonaList as $key=>$value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </span>
                </td>
                <td>
                    <span class="wordBreak">
                        <select wire:model.live="loginType" class="form-control">
                            <option value="" selected>Select....</option>
                            @foreach($loginTypeList as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                   </span>
                </td>
                <td>
                    <span class="wordBreak">
                        <select wire:model.live="brand" class="form-control">
                            <option value="" selected>Select....</option>
                            @foreach($brandList as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </span>
                </td>
                <td>
                    <span class="wordBreak">
                        <select wire:model.live="circle" class="form-control">
                            <option value="" selected>Select....</option>
                            @foreach($circleList as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </span>
                </td>
                <td>
                    <span class="wordBreak">
                        <select wire:model.live="appversion" class="form-control">
                            <option value="" selected>Select....</option>
                            @foreach($appVersionList as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </span>
                </td>

                <td>
                    <span class="wordBreak">
                        <select wire:model.live="screen" class="form-control">
                            <option value="" selected>Select....</option>
                            @foreach($screenList as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </span>
                </td>

                <td>
                    <span class="wordBreak">
                        <select wire:model.live="os" class="form-control">
                            <option value="" selected>Select....</option>
                            @foreach($osList as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </span>
                </td>

                <td>
                    <span class="wordBreak">
                        <select wire:model.live="rank" class="form-control">
                            <option value="" selected>Select....</option>
                            @foreach($rankList as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </span>
                </td>
                <td>
                </td>
                <td>
                    <span class="wordBreak">
                        <select wire:model.live="status" class="form-control">
                            <option value="" selected>Select....</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </span>
                </td>
                <td>
                </td>
                <td>
                </td>
            </tr>
        </thead>
        <tbody>

            @forelse($banners as $banner)
            <tr>
                    <td><input class="form-check-input selectMultichk" name="multi_chk[]"  type="checkbox" value="{{$banner->id}}" id="chk_{{$banner->id}}"></td>
                    <td><span class="wordBreak">{{ $banner->banner_title }}</span></td>
                    <td><span class="wordBreak">{{ $banner->lob }}</span></td>
                    <td><span class="wordBreak">{{ $banner->postpaid_persona }}</span></td>
                    <td><span class="wordBreak">{{ $banner->login_type }}</span></td>
                    <td><span class="wordBreak">{{ $banner->brand }}</span></td>
                    <td><span class="wordBreak">{{ $banner->circle }}</span></td>
                    <td><span class="wordBreak">{{ $banner->app_version }}</span></td>
                    <td><span class="wordBreak">{{ $banner->getBannerName->screen_title }}</span></td>
                    <td><span class="wordBreak">{{ $banner->device_os }}</span></td>
                    <td><span class="wordBreak">{{ $banner->banner_rank }}</span></td>
                        @if($banner->internal_link !="")
                            <td><span class="wordBreak"><b>Internal Link: </b>{{ $banner->internal_link }}</span></td>
                        @elseif($banner->external_link !="")
                            <td><span class="wordBreak"><b>External Link: </b>{{ $banner->external_link }}</span></td>
                        @else
                            <td><span class="wordBreak"><b> - </b></span></td>
                        @endif
                    <td>
                        <span class="wordBreak">
                            @if($banner->status == 1)
                                <div class="badge bg-success text-wrap">Active</div>
                            @else
                                <div class="badge bg-danger text-wrap">Inactive</div>
                            @endif
                        </span>
                    </td>
                    <td><span class="wordBreak">{{ $banner->updated_at->format('d M Y, h:i a') }}</span></td>
                    <td>
                        <span class="wordBreak lastClass">
                            <button type="button" class="btn btn-outline-primary mx-auto deleteRow" value="{{ $banner->id }}" data-kt-user-id="{{ $banner->id }}" data-kt-action="delete_row" title="Delete" ><i class="fa fa-trash" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-outline-primary mx-auto updateRow" value="{{ $banner->id }}" data-kt-user-id="{{ $banner->id }}" data-bs-toggle="modal" title="Edit" data-bs-target="#kt_modal_add_banner" data-kt-action="update_row"><i class="fa fa-edit"></i></button>
                        </span>
                    </td>
                    
                </tr>
            @empty
                <tr>
                  <td class="text-center text-muted small" colspan="100%">
                      No Records Found
                  </td>
              </tr>
            @endforelse

        </tbody>
        </table>
        <div class ="pageFilter row align-items-center justify-content-between">
            <div class="col-md-2">
                <div class="d-flex align-items-center">
                    <label class="perpageclass perpageclassTemp" for="">Per Page</label>
                        <select wire:model.live="Byperpage" class="Byperpage byperpageCss form-control" >
                            <option value="10">10</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="500">500</option>
                            <option value="{{$totalCount}}">All</option>
                        </select>
                </div>
                
            </div>
            <div class="col-md-6 TotalRecords">
                <b>Total {{$totalCount}} record(s) found</b>
            </div>
        </div>
       

        @if(count($banners))
            {{$banners->links()}}
        @endif
    </div>
    <div>
    </div>
 </div>
 @push('scripts')
<!-- <script src="{{url('views/pages/apps/banner-management/managebanner/columns/_draw-scripts.js')}}"> </script> -->
<!-- <script src="../views/pages/apps/banner-management/managebanner/columns/_draw-scripts.js"></script> -->
    <script>
                    // $('.CopyData').on('click',function(){
                    //     var get_selected_data_copy = new Array();

                    //     $("input[name='multi_chk[]']").each(function (index, obj) {
                    //         if(this.checked)
                    //             {
                    //                 get_selected_data_copy.push($(this).val());
                    //             }
                    //     });
                    //     @this.set('tempdelete',get_selected_data_copy)
                    // });

                    
                    // Group Action Start
                    $('body').on("click", ".CopyData", function (e) {
                        Swal.fire({
                            text: 'Are you sure to copy the row same as it is ?',
                            icon: 'warning',
                            buttonsStyling: false,
                            showCancelButton: true,
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            customClass: {
                                confirmButton: 'btn btn-danger',
                                cancelButton: 'btn btn-secondary',
                            }
                        }).then((result) => {
                            var get_selected_data_copy = new Array();
                            var mainArrayCopy = new Array();
                            console.log(get_selected_data_copy);
                            $("input[name='multi_chk[]']").each(function (index, obj) {
                            if(this.checked)
                            {
                                get_selected_data_copy.push($(this).val());
                            }
                            });
                            mainArrayCopy={
                                "ids":get_selected_data_copy,
                            }
                            if (result.isConfirmed) {
                                Livewire.dispatch('group_copy', [mainArrayCopy]);
                                // Livewire.emit('group_copy');
                            }
                        });
                    });
                    $('body').on("click", ".deleteData", function (e) {
                        Swal.fire({
                            text: 'Are you sure?',
                            icon: 'warning',
                            buttonsStyling: false,
                            showCancelButton: true,
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            customClass: {
                                confirmButton: 'btn btn-danger',
                                cancelButton: 'btn btn-secondary',
                            }
                        }).then((result) => {
                            var get_selected_data_delete = new Array();
                            var mainArraydelete = new Array();
                            $("input[name='multi_chk[]']").each(function (index, obj) {
                            if(this.checked)
                            {
                                get_selected_data_delete.push($(this).val());
                            }
                            });
                            mainArraydelete={
                                "ids":get_selected_data_delete,
                            }
                            if (result.isConfirmed) {
                                    Livewire.dispatch('group_delete', [mainArraydelete]);
                            }
                        });
                    });

                    
                    $('body').on("click", ".changeStatus", function (e) {
                        Swal.fire({
                            text: 'Are you sure to update the status?',
                            icon: 'warning',
                            buttonsStyling: false,
                            showCancelButton: true,
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            customClass: {
                                confirmButton: 'btn btn-danger',
                                cancelButton: 'btn btn-secondary',
                            }
                        }).then((result) => {
                            var status = $(this).val();
                            var get_selected_data_status = new Array();
                            var mainArray = new Array();
                            $("input[name='multi_chk[]']").each(function (index, obj) {
                            if(this.checked)
                            {
                                get_selected_data_status.push($(this).val());
                            }
                            });
                            mainArray={
                                "ids":get_selected_data_status,
                                "status":status,
                            }
                            if (result.isConfirmed) {

                                Livewire.dispatch('group_status', [mainArray]);
                            }
                        });
                    });

                    $('body').on("click", ".deleteRow", function (e) {
                        Swal.fire({
                            text: 'Are you sure to Delete record ?',
                            icon: 'warning',
                            buttonsStyling: false,
                            showCancelButton: true,
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            customClass: {
                                confirmButton: 'btn btn-danger',
                                cancelButton: 'btn btn-secondary',
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Livewire.dispatch('deleteRow', [$(this).val()]);
                            }
                        });
                    });

                    // // document.querySelectorAll('[data-kt-action="update_row"]').forEach(function (element) {
                    //     $('body').on("click", ".editRow", function (e) {
                    //         alert("temp");
                    //         alert($('.editRow').val());
                    //         Livewire.dispatch('editRow', [$('.editRow').val()]);
                    //     });
                    // // });
                // Group Action End
                // document.querySelectorAll('[data-kt-action="update_row"]').forEach(function (element) {
                //     element.addEventListener('click', function () {
                //         alert("clicke111")
                //         Livewire.dispatch('update_banner', [$(this).val()]);
                //     });
                // });

                $('body').on("click", ".updateRow", function (e) {
                    Livewire.dispatch('update_banner', [$(this).val()]);
                });

    </script>
    @endpush
