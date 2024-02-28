<div>
<livewire:banner.banner></livewire:banner.banner>
    <div class="table-responsive">
        <table class="table" id="myTable">
        <thead>
            <tr>
                <th><input type="checkbox" value="All" id="chkAll" class="form-check-input chkAll"  /></th>
                <th>Banner Title</th>
                <th>lob</th>
                <th>Postpaid Persona</th>
                <th>Login Type</th>
                <th>Brand</th>
                <th>circle</th>
                <th>App Version</th>
                <th>Screen</th>
                <th>OS</th>
                <th>Rank</th>
                <th>Link</th>
                <th>status</th>
                <th>Updated At</th>
                <th>options</th>
            </tr>
            <tr>
            <td>
                </td>
                <td>
                    <input type="text" class="form-control" wire:model.live="banner_title"/>
                </td>
                <td>
                    <select class="form-control" wire:model.live="lob">
                    <option value="">-- choose lob --</option>
                        @foreach($lobList as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select class="form-control" wire:model.live="postpaid_persona">
                    <option value="">-- choose postpaid persona --</option>
                        @foreach($postpaidPersonaList as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select wire:model.live="loginType" class="form-control">
                        <option value="" selected>Select login Type</option>
                        @foreach($loginTypeList as $key=>$value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select wire:model.live="brand" class="form-control">
                        <option value="" selected>Select Brand</option>
                        @foreach($brandList as $key=>$value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select wire:model.live="circle" class="form-control">
                        <option value="" selected>Select circle</option>
                        @foreach($circleList as $key=>$value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select wire:model.live="appversion" class="form-control">
                        <option value="" selected>Select app version</option>
                        @foreach($appVersionList as $key=>$value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </td>

                <td>
                    <select wire:model.live="screen" class="form-control">
                        <option value="" selected>Select Screen</option>
                        @foreach($screenList as $key=>$value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </td>

                <td>
                    <select wire:model.live="os" class="form-control">
                        <option value="" selected>Select OS</option>
                        @foreach($osList as $key=>$value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </td>

                <td>
                    <select wire:model.live="rank" class="form-control">
                        <option value="" selected>Select Rank</option>
                        @foreach($rankList as $key=>$value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                </td>
                <td>
                    <select wire:model.live="status" class="form-control">
                        <option value="" selected>Select status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
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
                    <td><input class="form-check-input" name="multi_chk[]"  type="checkbox" value="{{$banner->id}}" id="chk_{{$banner->id}}" ></td>
                    <td>{{ $banner->banner_title }}</td>
                    <td>{{ $banner->lob }}</td>
                    <td>{{ $banner->postpaid_persona }}</td>
                    <td>{{ $banner->login_type }}</td>
                    <td>{{ $banner->brand }}</td>
                    <td><span class="wordBreak">{{ $banner->circle }}</span></td>
                    <td><span class="wordBreak">{{ $banner->app_version }}</span></td>
                    <td>{{ $banner->banner_screen }}</td>
                    <td>{{ $banner->device_os }}</td>
                    <td>{{ $banner->banner_rank }}</td>
                    <td>{{ $banner->link }}</td>
                    <td>
                        @if($banner->link == 1)
                            <div class="badge bg-success text-wrap">Active</div>
                        @else
                            <div class="badge bg-danger text-wrap">Inactive</div>
                        @endif
                    </td>
                    <td>{{ $banner->updated_at }}</td>
                    <td>
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
    </div>
        {{$banners->links()}}
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
