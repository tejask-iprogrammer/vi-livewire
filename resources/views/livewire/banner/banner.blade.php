<div class="modal fade" id="kt_modal_add_banner" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-1000px">
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
            <div class="modal-header" id="kt_modal_add_banner_header">
                <!--begin::Modal title-->
                <h2>
                    @if($edit_mode) Edit Banner @else Add Banner @endif
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
                <form id="kt_modal_add_banner_form" class="form" action="#" wire:submit="submit" enctype="multipart/form-data">
                    <input type="hidden" wire:model="user_id" name="user_id" value="{{ $user_id }}"/>
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_banner_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_banner_header" data-kt-scroll-wrappers="#kt_modal_add_banner_scroll" data-kt-scroll-offset="300px">
                        
                        <!-- seleect Circle and Select Screen  -->
                            <div class="row">
                                <div class="col mt-4">
                                    <!--begin::Label-->
                                    <label class="required fw-semibold fs-6 mb-2">Select Screen</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select wire:model="banner_screen" class="form-control">
                                        <option value="" selected>Select Screen</option>
                                        @foreach($screenList as $key=>$value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Input-->
                                    <!--begin::Hint-->
                                        <!--end::Hint-->
                                    @error('banner_screen')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
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
                            </div>
                        <!-- select Login Type and Select Brand  -->
                            <div class="row">
                                    <div class="col mt-4">
                                        <!--begin::Label-->
                                        <label class="fw-semibold fs-6 mb-2">Login Type</label>
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
                         <!-- select Select LOB and Select Plan  -->
                            <div class="row">
                                <div class="col mt-4">
                                    <!--begin::Label-->
                                    <label class="required fw-semibold fs-6 mb-2">Select LOB</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select wire:model="lob" class="form-control lobSelect">
                                        <option value="" selected>Select LOB</option>
                                        @foreach($lobList as $key=>$value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Input-->
                                    <!--begin::Hint-->
                                        <!--end::Hint-->
                                    @error('lob')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col mt-4">
                                    <div wire:ignore>
                                    <!--begin::Label-->
                                    <label class="fw-semibold fs-6 mb-2">Plan</label>
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
                        <!-- select prepaid and postpaid persona -->
                            <div class="row">
                                <div class="col mt-4" >
                                 <div wire:ignore>
                                        <!--begin::Label-->
                                        <label class="fw-semibold fs-6 mb-2">Prepaid Persona</label>
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
                                    <div wire:ignore>
                                        <!--begin::Label-->
                                        <label class="fw-semibold fs-6 mb-2">Postpaid Persona</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select wire:model="postpaid_persona" class="postpaidPersona select2 form-control postpaidSelect" multiple="multiple">
                                            <!-- <option value="" selected>Select Postpaid Persona</option> -->
                                            @foreach($postpaidPersonaList as $key=>$value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    @error('postpaid_persona')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        <!-- Select SocId Include or Exclude and Enter SocId -->
                            <div class="row">
                                <div class="col mt-4">
                                    <div wire:ignore>
                                    <!--begin::Label-->
                                    <label class="fw-semibold fs-6 mb-2">Select SocId Include or Exclude</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select wire:model="socid_include_exclude" class="form-control socIDincludeexclude">
                                        <option value="" selected>Select SocId Include or Exclude</option>
                                        @foreach($socidIncludeExcludeList as $key=>$value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Input-->
                                    <!--begin::Hint-->
                                        <!--end::Hint-->
                                </div>
                                    @error('socid_include_exclude')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col mt-4">
                                    <div wire:ignore>
                                        <label class="fw-semibold fs-6 mb-2">Enter SocId</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" wire:model="socid" name="socid" class="form-control socId" placeholder="SocId"/>
                                        <!--end::Input-->
                                    </div>
                                        @error('socid')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row">
                                 <div class="col mt-4">
                                        <label class="required fw-semibold fs-6 mb-2">Banner Title</label>
                                        <span class="help-block">Enter banner title Eg. Postpaid Plan</span>

                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" wire:model="banner_title" name="banner_title" class="form-control" placeholder="Banner Title"/>
                                        <!--end::Input-->
                                        @error('banner_title')
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
                                        <label class="fw-semibold fs-6 mb-2">Banner Subtitle</label>
                                        <span class="help-block">Enter banner title Eg. Postpaid Plan</span>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" wire:model="subtitle" name="subtitle" class="form-control" placeholder="Banner Subtitle"/>
                                        <!--end::Input-->
                                        @error('subtitle')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                 <div class="col mt-4">
                                        <label class="fw-semibold fs-6 mb-2">Country</label>

                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" wire:model="country" name="country" class="form-control" placeholder="Country"/>
                                        <!--end::Input-->
                                        @error('country')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mt-4">
                                 <div wire:ignore>
                                    <!--begin::Label-->
                                    <label class="required fw-semibold fs-6 mb-2">Red Hierarchy</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select wire:model="red_hierarchy" class="redHierarchy select2 form-control" multiple="multiple">
                                        <!-- <option value="" selected>Select</option> -->
                                        @foreach($redHierarchyList as $key=>$value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Input-->
                                    <!--begin::Hint-->
                                        <!--end::Hint-->
                                </div>
                                    @error('red_hierarchy')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                 <div class="col mt-4">
                                        <label class="fw-semibold fs-6 mb-2">MRP</label>

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
                                    <!--begin::Label-->
                                    <label class="fw-semibold fs-6 mb-2">Link Type</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select wire:model="link_type" class="linkType form-control">
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
                                        <label class="fw-semibold fs-6 mb-2">Select Tab</label>

                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select wire:model="tab_name" class="form-control">
                                            <option value="" selected>Select</option>
                                            @foreach($tabsList as $key=>$value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                        @error('fname')
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
                                        <label class="fw-semibold fs-6 mb-2">Campaign Id</label>
                                        <span class="help-block">Enter - if internal link is cyb plan related else blank</span>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" wire:model="campaign_id" name="campaign_id" class="form-control" placeholder="Campaign Id"/>
                                        <!--end::Input-->
                                        @error('campaign_id')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col mt-4">
                                        <label class="fw-semibold fs-6 mb-2">Banner CTA</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" wire:model="cta_name" name="cta_name" class="form-control" placeholder="Banner CTA"/>
                                        <!--end::Input-->
                                        @error('cta_name')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mt-4">
                                        <label class="fw-semibold fs-6 mb-2">Downtime Start</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input id="start_date_time" type="datetime-local"  wire:model="start_date_time" name="partydate" class="form-control" value="2017-06-01T08:30" />
                                        <!--end::Input-->
                                        @error('start_date_time')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col mt-4">
                                        <label class="fw-semibold fs-6 mb-2">Downtime End</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input id="end_date_time" type="datetime-local"  wire:model="end_date_time" name="partydate" class="form-control" value="2017-06-01T08:30" />
                                        <!--end::Input-->
                                        @error('end_date_time')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mt-4" >
                                    <div wire:ignore>
                                        <label class="fw-semibold fs-6 mb-2">Service Type</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select wire:model="service_type" class="serviceType select2 form-control" multiple="multiple">
                                            <!-- <option value="" selected>Select Service Type</option> -->
                                            @foreach($serviceTypeList as $key=>$value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                </div>
                                        @error('service_type')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
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
                            </div>

                            <div class="row">
                                <div class="col mt-4">
                                        <label class="fw-semibold fs-6 mb-2">Banner Text Content</label>
                                        <textarea class="form-control" wire:model="banner_text_content" id="banner_text_content" rows="4"></textarea>
                                        <!--end::Input-->
                                        @error('banner_text_content')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col mt-3">
                                    <div class="form-group">
                                    <label class="fw-semibold fs-6 mb-2">Coupon Code</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" wire:model="coupon_code" name="coupon_code" class="form-control" placeholder="Coupon Code"/>
                                        <!--end::Input-->
                                        @error('coupon_code')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                    <label class="fw-semibold fs-6 mb-2">Validity Period</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" wire:model="validity_period" name="validity_period" class="form-control" placeholder="Validity Period"/>
                                        <!--end::Input-->
                                        @error('validity_period')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
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
                                            @error('saved_avatar')
                                            <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col mt-4">
                                        <!--begin::Label-->
                                        <label class="d-block fw-semibold fs-6 mb-5">Notified Banner</label>
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
                                        <div class="image-input image-input-outline image-input-placeholder {{ $avatar || $saved_avatar ? '' : 'image-input-empty' }}" data-kt-image-input="true">
                                            <!--begin::Preview existing avatar-->
                                            @if($avatar)
                                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ $avatar ? $avatar->temporaryUrl() : '' }});"></div>
                                            @else
                                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ $saved_avatar }});"></div>
                                            @endif
                                            <!--end::Preview existing avatar-->
                                            <!--begin::Label-->
                                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                                {!! getIcon('pencil','fs-7') !!}
                                                <!--begin::Inputs-->
                                                <input type="file" wire:model="notified_banner" name="avatar" accept=".png, .jpg, .jpeg"/>
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
                                            @error('avatar')
                                            <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row">
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
                                <div class="col mt-4">
                                    <label class="required fw-semibold fs-6 mb-2">Status</label>
                                    <input class="form-check-input" wire:model="status" value="1" type="radio" >
                                    <label class="form-check-label" for="status">
                                        Active
                                    </label>
                                    <input class="form-check-input" wire:model="status" value="0" type="radio">
                                    <label class="form-check-label" for="status">
                                        Inactive
                                    </label>
                                    @error('status')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col mt-4">
                                    <label class="required fw-semibold fs-6 mb-2">is Notified</label>
                                    <input class="form-check-input" type="radio" wire:model="isnotified" value="1" >
                                    <label class="form-check-label" for="isnotified">
                                        Active
                                    </label>
                                    <input class="form-check-input" type="radio" wire:model="isnotified" value="0" >
                                    <label class="form-check-label" for="isnotified">
                                        Inactive
                                    </label>
                                    @error('isnotified')
                                    <span class="text-danger">{{ $message }}</span> @enderror
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
                $('.select2').select2().val("0014");
            });
            document.addEventListener('livewire:init', function () {
                // $('.select2').select2();
                $(document).on('change','.circle.select2',function(e){
                        let data = $(this).val();
                        @this.set('circle',data);
                        $('.circle.select2').select2();
                });
                $(document).on('change','.prepaidPersona.select2',function(){
                        let data = $(this).val();
                        @this.set('prepaid_persona',data)
                });
                $(document).on('change','.postpaidPersona.select2',function(){
                        let data = $(this).val();
                        @this.set('postpaid_persona',data)
                });
                $(document).on('change','.redHierarchy.select2',function(){
                        let data = $(this).val();
                        @this.set('red_hierarchy',data)
                });
                $(document).on('change','.serviceType.select2',function(){
                        let data = $(this).val();
                        @this.set('service_type',data)
                });
                $(document).on('change','.appVersion.select2',function(){
                        let data = $(this).val();
                        @this.set('app_version',data)
                });
                $('#kt_modal_add_banner').on('shown.bs.modal', function (e) {
                    $(".select2").select2();
                })
                $('#kt_modal_add_banner').on('hidden.bs.modal', function (e) {
                        $(".prepaidSelect").prop('disabled', false);
                        $(".socId").prop('disabled', false);
                        $(".postpaidSelect").prop('disabled', false);
                        $(".planSelect").prop('disabled', false);
                        $(".socIDincludeexclude").prop('disabled', false);
                        $(".postpaidSelect").removeClass("postpaidSelectdisable");
                        $(".prepaidSelect").removeClass("prepaidSelectdisable");
                        $(".internalLink").prop('disabled', false);
                        $(".externalLink").prop('disabled', false);
                        // $('.select2').val(null).trigger('change');
                        
                    $("#kt_modal_add_banner_form")[0].reset();
                    let data = false;
                    @this.set('edit_mode',data)
                })
                // $('.lobSelect').on('change',function(){
                $(document).on('change','.lobSelect',function(){
                    let selectedLob = $(this).val();
                    if(selectedLob.toLowerCase() == "prepaid"){
                        $(".postpaidSelect").prop('disabled', true);
                        $(".socId").prop('disabled', true);
                        $(".prepaidSelect").prop('disabled', false);
                        $(".planSelect").prop('disabled', false);
                        $(".socIDincludeexclude").prop('disabled', true);
                        $(".postpaidSelect").addClass("postpaidSelectdisable");
                        $(".prepaidSelect").removeClass("prepaidSelectdisable");
                        $('.socId').val('');
                        $('.postpaidSelect').val(null).trigger('change');
                        $('.prepaidSelect').val(null).trigger('change');
                        $(".planSelect option:selected").prop("selected", false);
                        @this.set('socid',"");
                        @this.set('prepaid_persona',"");
                        @this.set('plan',"");
                        @this.set('socid_include_exclude',"");
                        @this.set('postpaid_persona',"");
                    }else if(selectedLob.toLowerCase() == "postpaid"){
                        $(".prepaidSelect").prop('disabled', true);
                        $(".planSelect").prop('disabled', true);
                        $(".postpaidSelect").prop('disabled', false);
                        $(".socId").prop('disabled', false);
                        $(".prepaidSelect").addClass("prepaidSelectdisable");
                        $(".postpaidSelect").removeClass("postpaidSelectdisable");
                        $(".socIDincludeexclude").prop('disabled', false);
                        $('.prepaidSelect').val(null).trigger('change');
                        $('.postpaidSelect').val(null).trigger('change');
                        $(".planSelect option:selected").prop("selected", false);
                        @this.set('socid',"");
                        @this.set('prepaid_persona',"");
                        @this.set('plan',"");
                        @this.set('socid_include_exclude',"");
                        @this.set('postpaid_persona',"");
                    }else if(selectedLob.toLowerCase() == "both"){
                        $(".prepaidSelect").prop('disabled', false);
                        $(".socId").prop('disabled', false);
                        $(".postpaidSelect").prop('disabled', false);
                        $(".planSelect").prop('disabled', false);
                        $(".postpaidSelect").removeClass("postpaidSelectdisable");
                        $(".prepaidSelect").removeClass("prepaidSelectdisable");
                        $('.socId').val('');
                        $(".socIDincludeexclude").prop('disabled', false);
                        $(".planSelect option:selected").prop("selected", false);
                        $('.postpaidSelect').val(null).trigger('change');
                        $('.prepaidSelect').val(null).trigger('change');
                        @this.set('socid',"");
                        @this.set('prepaid_persona',"");
                        @this.set('plan',"");
                        @this.set('socid_include_exclude',"");
                        @this.set('postpaid_persona',"");
                    }else{
                        $(".prepaidSelect").prop('disabled', false);
                        $(".socId").prop('disabled', false);
                        $(".postpaidSelect").prop('disabled', false);
                        $(".planSelect").prop('disabled', false);
                        $(".socIDincludeexclude").prop('disabled', false);
                        $(".postpaidSelect").removeClass("postpaidSelectdisable");
                        $(".prepaidSelect").removeClass("prepaidSelectdisable");
                        $('.socId').val('');
                        $(".planSelect option:selected").prop("selected", false);
                        $('.postpaidSelect').val(null).trigger('change');
                        $('.prepaidSelect').val(null).trigger('change');
                        @this.set('socid',"");
                        @this.set('prepaid_persona',"");
                        @this.set('plan',"");
                        @this.set('socid_include_exclude',"");
                        @this.set('postpaid_persona',"");
                    }
                });
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
