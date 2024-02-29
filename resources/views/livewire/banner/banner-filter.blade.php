<div>
<livewire:banner.banner></livewire:banner.banner>
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
                        <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            Actions
                            <i class="ki-duotone ki-down fs-5 ms-1"></i>
                        </a>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-user-id="{{ $banner->id }}" data-bs-toggle="modal" data-bs-target="#kt_modal_add_banner" data-kt-action="update_row">
                                    Edit
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-user-id="{{ $banner->id }}" data-kt-action="delete_row">
                                    Delete
                                </a>
                            </div>
                        </div>
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
        <div>
            <div class="col-md-2">
                <label for="">Per Page</label>
                    <select wire:model.live="Byperpage" class="form-control" >
                        <option value="10">10</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="500">500</option>
                        <option value="{{$totalCount}}">All</option>
                    </select>
            </div>
            <div class="col-md-2">
                <span class="separator">|</span><b>Total {{$totalCount}} record(s) found</b>
                
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
        // document.addEventListener('livewire:init', function () {
        //     //     $('.js-example-basic-multiple').select2();
        //     //     new DataTable('#myTable', {
        //     //     ordering: false
        //     // });
        //     })
        // let table =  new DataTable('#myTable', {
        //         ordering: false
        //     });
            
        
    </script>
    @endpush
