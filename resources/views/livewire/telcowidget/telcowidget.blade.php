<div class="modal fade" id="kt_modal_add_telco_widget" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-1100px ">
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_telco_widget_header">
                <!--begin::Modal title-->
                <h2>
                    @if($edit_mode) Edit Telcowidget Banenrs @else Add Telcowidget Banner @endif
                </h2>
                <div>
    </div>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                    {!! getIcon('cross','fs-1') !!}
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body px-5 my-7">
                <!--begin::Form-->
                <form id="kt_modal_add_telco_widget_form" class="form" action="#" wire:submit="submit" enctype="multipart/form-data">
                    <input type="hidden" wire:model="record_id" name="record_id" value="{{ $record_id }}"/>
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_telco_widget_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_telco_widget_header" data-kt-scroll-wrappers="#kt_modal_add_telco_widget_scroll" data-kt-scroll-offset="300px">
                        
                        <!-- seleect Circle and Select Screen  -->
                            <div class="row">
                                <div class="col mt-4" >
                                    <div wire:ignore>
                                        <!--begin::Label-->
                                        <label class="required fw-semibold fs-6 mb-2">Circle</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select wire:model="circle" class="circle select2 form-control" multiple>
                                        <!-- <option value="" disabled selected>Choose Circle</option> -->
                                            @foreach($circleList as $key=>$value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    @error('circle')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col mt-4">
                                    <div wire:ignore>
                                        <!--begin::Label-->
                                        <label class="required fw-semibold fs-6 mb-2">App Version</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select wire:model="app_version" class="appVersion select2 form-control" multiple="multiple">
                                            <!-- <option value="" selected>Select Version</option> -->
                                            @foreach($appVersionList as $key=>$value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    @error('app_version')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        <!-- select Login Type and Select Brand  -->
                            <div class="row">
                                <div class="col mt-4">
                                        <!--begin::Label-->
                                        <label class="required fw-semibold fs-6 mb-2">Login Type</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select wire:model="login_type" class="form-control">
                                            <option value="" selected>Select Login Type</option>
                                            @foreach($loginTypeList as $key=>$value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                        <!--begin::Hint-->
                                            <!--end::Hint-->
                                        @error('login_type')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col mt-4">
                                        <!--begin::Label-->
                                        <label class="required fw-semibold fs-6 mb-2">Select Brand</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select wire:model="brand" class="form-control">
                                            <option value="" selected>Select Brand</option>
                                            @foreach($brandList as $key=>$value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                        @error('brand')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mt-4">
                                        <label class="required fw-semibold fs-6 mb-2">Device OS</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select wire:model="device_os" class="form-control">
                                            <option value="" selected>Select Device OS</option>
                                            @foreach($osList as $key=>$value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                        @error('device_os')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col mt-4">
                                    <div wire:ignore>
                                    <!--begin::Label-->
                                    <label class="required fw-semibold fs-6 mb-2">Plan</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select wire:model.live="plan" class="form-control planSelect">
                                        <option value="" selected>Select Plan</option>
                                        @foreach($planList as $key=>$value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Input-->
                                    </div>
                                        @error('plan')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mt-4" >
                                 <div wire:ignore>
                                        <!--begin::Label-->
                                        <label class="required fw-semibold fs-6 mb-2">Prepaid Persona</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <!-- <select wire:model="prepaid_persona" class="form-control"> -->
                                        <select wire:model="prepaid_persona" class="prepaidPersona select2 form-control prepaidSelect" multiple="multiple">
                                            <!-- <option value="" selected>Select Prepaid Persona</option> -->
                                            @foreach($prepaidPersonaList as $key=>$value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                        <!--begin::Hint-->
                                            <!--end::Hint-->
                                </div>
                                    @error('prepaid_persona')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col mt-4">
                                        <label class="required fw-semibold fs-6 mb-2">MRP</label>

                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" wire:model="mrp" name="mrp" class="form-control" placeholder="MRP"/>
                                        <!--end::Input-->
                                        @error('mrp')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mt-4">
                                    <label class="fw-semibold fs-6 mb-2">Pack Type</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select wire:model="pack_type" class="form-control">
                                        <option value="" selected>Pack Type</option>
                                        @foreach($packType as $key=>$value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Input-->
                                    @error('pack_type')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col mt-4">
                                        <label class="required fw-semibold fs-6 mb-2">Analytics tag</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" wire:model="analytics_tag" name="analytics_tag" class="form-control" placeholder="Analytics tag"/>
                                        <!--end::Input-->
                                        @error('analytics_tag')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row">
                                 <div class="col mt-4">
                                        <label class="required fw-semibold fs-6 mb-2">Banner Title</label>
                                        <!-- <span class="help-block">Enter banner title Eg. Postpaid Plan</span> -->

                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" wire:model="banner_title" name="banner_title" class="form-control" placeholder="Banner Title"/>
                                        <!--end::Input-->
                                        @error('banner_title')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                   
                                </div>
                                <div class="col mt-4">
                                        <label class="required fw-semibold fs-6 mb-2">Rail Title</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" wire:model="rail_title" name="rail_title" class="form-control" placeholder="Rail Title"/>
                                        <!--end::Input-->
                                        @error('rail_title')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-4">
                                        <label class="required fw-semibold fs-6 mb-2">View All Rail Redirection</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" wire:model="rail_view_all" name="rail_view_all" class="form-control" placeholder="View All Rail Redirection"/>
                                        <!--end::Input-->
                                        @error('rail_view_all')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mt-4">
                                    <!--begin::Label-->
                                    <label class="fw-semibold fs-6 mb-2">Link Type</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select wire:model="link_type" class="linkType select2 form-control">
                                        <option value="" selected>Select</option>
                                        @foreach($linkTypeList as $key=>$value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Input-->
                                    <!--begin::Hint-->
                                        <!--end::Hint-->
                                    @error('username')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col mt-4">
                                    <!--begin::Label-->
                                    <label class="required fw-semibold fs-6 mb-2">Banner Rank</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select wire:model="banner_rank" class="form-control">
                                        <option value="" selected>Choose Banner Rank</option>
                                        @foreach($rankList as $key=>$value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Input-->
                                    @error('banner_rank')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mt-4"wire:ignore>
                                            <label class="fw-semibold fs-6 mb-2">Internal Link</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" wire:model="internal_link" name="internal_link" class="form-control internalLink" placeholder="Internal Link"/>
                                            <!--end::Input-->
                                            @error('internal_link')
                                            <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col mt-4" wire:ignore>
                                        <label class="fw-semibold fs-6 mb-2">External Link</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" wire:model="external_link" name="external_link" class="form-control externalLink" placeholder="External Link"/>
                                        <!--end::Input-->
                                        @error('external_link')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mt-4">
                                        <!--begin::Label-->
                                        <label class="required d-block fw-semibold fs-6 mb-5">Banner Image</label>
                                        <!--end::Label-->
                                        <!--begin::Image placeholder-->
                                        <style>
                                            .image-input-placeholder {
                                                background-image: url('{{ image('svg/files/blank-image.svg') }}');
                                            }

                                            [data-bs-theme="dark"] .image-input-placeholder {
                                                background-image: url('{{ image('svg/files/blank-image-dark.svg') }}');
                                            }
                                        </style>
                                        <!--end::Image placeholder-->
                                        <!--begin::Image input-->
                                        <div class="image-input image-input-outline image-input-placeholder {{ $banner_name || $saved_avatar ? '' : 'image-input-empty' }}" data-kt-image-input="true">
                                            <!--begin::Preview existing avatar-->
                                            @if($banner_name)
                                            <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ $banner_name ? $banner_name->temporaryUrl() : '' }});"></div>                                           
                                            @else
                                              <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ asset('https://viapprewamp.viapplogs.net')}}/{{$saved_avatar }});"></div>
                                            @endif
                                            <!--end::Preview existing avatar-->
                                            <!--begin::Label-->
                                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                                {!! getIcon('pencil','fs-7') !!}
                                                <!--begin::Inputs-->
                                                <input type="file" wire:model="banner_name" name="avatar" accept=".png, .jpg, .jpeg"/>
                                                <input type="hidden" name="avatar_remove"/>
                                                <!--end::Inputs-->
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Cancel-->
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                                {!! getIcon('cross','fs-2') !!}
                                            </span>
                                                <!--end::Cancel-->
                                            </div>
                                            <!--end::Image input-->
                                            <!--begin::Hint-->
                                            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                            <!--end::Hint-->
                                            @error('banner_name')
                                            <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col mt-3">
                                    <div class="form-group mb-10">
                                        <label class="required fw-semibold fs-6 mb-2">Is Pack Expiry Near</label>
                                        <div class="col-md-8">
                                            <input class="form-check-input" wire:model="is_pack_expiry_near" value="1" type="radio" >
                                            <label class="form-check-label" for="is_pack_expiry_near">
                                                Yes
                                            </label>
                                            <input class="form-check-input" wire:model="is_pack_expiry_near" value="0" type="radio">
                                            <label class="form-check-label" for="is_pack_expiry_near">
                                                No
                                            </label>
                                        </div>
                                        
                                        @error('is_pack_expiry_near')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="form-group mb-10">
                                        <label class="required fw-semibold fs-6 mb-2">Is Data Exausted</label>
                                        <div class="col-md-8">
                                            <input class="form-check-input" wire:model="is_data_exhausted" value="1" type="radio" >
                                            <label class="form-check-label" for="is_data_exhausted">
                                                Yes
                                            </label>
                                            <input class="form-check-input" wire:model="is_data_exhausted" value="0" type="radio">
                                            <label class="form-check-label" for="is_data_exhausted">
                                                No
                                            </label>
                                        </div>

                                        @error('is_data_exhausted')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="form-group mb-10">
                                        <label class="required fw-semibold fs-6 mb-2">Status</label>
                                        <div class="col-md-8">

                                            <input class="form-check-input" wire:model="status" value="1" type="radio" >
                                            <label class="form-check-label" for="status">
                                                Active
                                            </label>
                                            <input class="form-check-input" wire:model="status" value="0" type="radio">
                                            <label class="form-check-label" for="status">
                                                Inactive
                                            </label>
                                        </div>
                                        @error('status')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                
                                </div>
                            </div>
                    </div>                        
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close" wire:loading.attr="disabled">Discard</button>
                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label" wire:loading.remove>Submit</span>
                            <span class="indicator-progress" wire:loading wire:target="submit">
                                Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!-- <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> -->
@push('scripts')
<script type="text/javascript">
            $(document).ready(function() {
                $(".select2").select2();
            });
            document.addEventListener('livewire:init', function () {
                // $('.select2').select2();
                $(document).on('change','.circle.select2',function(e){
                        let data = $(this).val();
                        @this.set('circle',data);
                        setTimeout(function(){
                            $('.select2').select2();
                        }, 1000);
                });
                $(document).on('change','.prepaidPersona.select2',function(){
                        let data = $(this).val();
                        @this.set('prepaid_persona',data)
                        setTimeout(function(){
                            $('.select2').select2();
                        }, 1000);
                });
                $(document).on('change','.appVersion.select2',function(){
                        let data = $(this).val();
                        @this.set('app_version',data)
                        setTimeout(function(){
                            $('.select2').select2();
                        }, 1000);
                });
                $(document).on('change','.linkType.select2',function(){
                        // let data = $(this).val();
                        // @this.set('app_version',data)
                        setTimeout(function(){
                            $('.select2').select2();
                        }, 1000);
                });
                $('#kt_modal_add_telco_widget').on('shown.bs.modal', function (e) {
                    $(".select2").select2();
                })
                $('#kt_modal_add_telco_widget').on('hidden.bs.modal', function (e) {
                    $("#kt_modal_add_telco_widget_form")[0].reset();
                    @this.set('saved_avatar',"");
                    @this.set('banner_name',"")
                    let data = false;
                    @this.set('edit_mode',data)
                })
                // $('.lobSelect').on('change',function(){
            });
            $(document).on('change','.linkType',function(){
                    let selectedLink= $(this).val();
                    if(selectedLink.toLowerCase() == "1"){
                        $(".internalLink").prop('disabled', false);
                        $(".externalLink").prop('disabled', true);
                        @this.set('external_link',"");
                        @this.set('internal_link',"");
                    }else if(selectedLink.toLowerCase() == "2"){
                        $(".internalLink").prop('disabled', true);
                        $(".externalLink").prop('disabled', false);
                        @this.set('external_link',"");
                        @this.set('internal_link',"");
                    }else{
                        $(".internalLink").prop('disabled', false);
                        $(".externalLink").prop('disabled', false);
                        @this.set('external_link',"");
                        @this.set('internal_link',"");
                    }
                });
</script>
@endpush
