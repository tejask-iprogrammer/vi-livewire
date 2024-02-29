<div>
<livewire:banner.banner></livewire:banner.banner>
<div class="table-actions-wrapper">
            <button class="btn btn-sm red table-group-action-delete  deleteData btn btn-primary"><i class="fa fa-trash"></i> Delete</button>
            <select class="form-control changeStatus">
                <option value="" selected>change Status</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
            <button class="btn btn-sm yellow table-group-action-copy CopyData btn btn-primary"><i class="fa fa-copy"></i> Copy</button>
        </div>
    <div class="table-responsive">
        <table class="table" id="myTable">
        <thead>
            <tr>
                <th><input type="checkbox" value="All" id="chkAll" class="form-check-input chkAll"  /></th>
                <th><span class="wordBreak">Banner Title<span></th>
                <th><span class="wordBreak">lob<span><span></th>
                <th><span class="wordBreak">Postpaid Persona<span></th>
                <th><span class="wordBreak">Login Type<span></th>
                <th><span class="wordBreak">Brand<span></th>
                <th><span class="wordBreak">circle<span></th>
                <th><span class="wordBreak">App Version<span></th>
                <th><span class="wordBreak">Screen<span></th>
                <th><span class="wordBreak">OS<span></th>
                <th><span class="wordBreak">Rank<span></th>
                <th><span class="wordBreak">Link<span></th>
                <th><span class="wordBreak">status<span></th>
                <th><span class="wordBreak">Updated At<span></th>
                <th><span class="wordBreak">options<span></th>
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
                        <option value="">-- choose lob --</option>
                            @foreach($lobList as $key=>$value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </span>
                </td>
                <td>
                    <span class="wordBreak">
                        <select class="form-control" wire:model.live="postpaid_persona">
                        <option value="">-- choose postpaid persona --</option>
                            @foreach($postpaidPersonaList as $key=>$value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </span>
                </td>
                <td>
                    <span class="wordBreak">
                        <select wire:model.live="loginType" class="form-control">
                            <option value="" selected>Select login Type</option>
                            @foreach($loginTypeList as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                   </span>
                </td>
                <td>
                    <span class="wordBreak">
                        <select wire:model.live="brand" class="form-control">
                            <option value="" selected>Select Brand</option>
                            @foreach($brandList as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </span>
                </td>
                <td>
                    <span class="wordBreak">
                        <select wire:model.live="circle" class="form-control">
                            <option value="" selected>Select circle</option>
                            @foreach($circleList as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </span>
                </td>
                <td>
                    <span class="wordBreak">
                        <select wire:model.live="appversion" class="form-control">
                            <option value="" selected>Select app version</option>
                            @foreach($appVersionList as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </span>
                </td>

                <td>
                    <span class="wordBreak">
                        <select wire:model.live="screen" class="form-control">
                            <option value="" selected>Select Screen</option>
                            @foreach($screenList as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </span>
                </td>

                <td>
                    <span class="wordBreak">
                        <select wire:model.live="os" class="form-control">
                            <option value="" selected>Select OS</option>
                            @foreach($osList as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </span>
                </td>

                <td>
                    <span class="wordBreak">
                        <select wire:model.live="rank" class="form-control">
                            <option value="" selected>Select Rank</option>
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
                            <option value="" selected>Select status</option>
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
                    <td><span class="wordBreak">{{ $banner->link }}</span></td>
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
                        <span class="wordBreak">
                            <button type="button" id= "{{ $banner->id }}" value="{{ $banner->id }}"class="btn btn-success editRow">Edit</button>
                            <button type="button" id= "{{ $banner->id }}" value="{{ $banner->id }}"class="btn btn-danger deleteRow">Delete</button>
                        </span>
                    </td>
                    
                </tr>
            @empty
                <tr>
                  <td class="text-center text-muted small" colspan="100%">
                      No Products Found
                  </td>
              </tr>
            @endforelse

        </tbody>
        </table>
        <div class ="row align-items-center justify-content-between">
            <div class="col-md-2">
                <div class="d-flex align-items-center justify-content-center">
                    <label class="perpageclass" for="">Per Page</label>
                    <select wire:model.live="Byperpage" class="form-control" >
                        <option value="10">10</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="500">500</option>
                        <option value="{{$totalCount}}">All</option>
                    </select>
                </div>
                
            </div>
            <div class="col-md-6 text-end">
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
                                if(get_selected_data_delete.length >0){
                                    Livewire.dispatch('group_delete', [mainArraydelete]);
                                }else{}
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
                                Livewire.dispatch('deleteRow', [$('.deleteRow').val()]);
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

    </script>
    @endpush
