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
                                    <div wire:ignore>
                                        <select class="select2" name="state" multiple>
                                            <option value="AL">Alabama</option>
                                            <option value="WY">Wyoming</option>
                                            <option value="WY">Wyoming</option>
                                            <option value="WY">Wyoming</option>
                                            <option value="WY">Wyoming</option>
                                            <option value="WY">Wyoming</option>
                                        </select>
                                        <!-- Select2 will insert its DOM here. -->
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
@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        alert();
        $('.select2').select2();
    });
            document.addEventListener('livewire:init', function () {
                // $('.js-example-basic-multiple').select2();
                $('.circle.js-example-basic-multiple').on('change',function(){
                        let data = $(this).val();
                        @this.set('circle',data)
                });
                $('.prepaidPersona.js-example-basic-multiple').on('change',function(){
                        let data = $(this).val();
                        @this.set('prepaid_persona',data)
                });

                $('.postpaidPersona.js-example-basic-multiple').on('change',function(){
                        let data = $(this).val();
                        @this.set('postpaid_persona',data)
                });

                $('.redHierarchy.js-example-basic-multiple').on('change',function(){
                        let data = $(this).val();
                        @this.set('red_hierarchy',data)
                });
                $('.serviceType.js-example-basic-multiple').on('change',function(){
                        let data = $(this).val();
                        @this.set('service_type',data)
                });
                $('.appVersion.js-example-basic-multiple').on('change',function(){
                        let data = $(this).val();
                        @this.set('app_version',data)
                });
                $('#kt_modal_add_banner').on('shown.bs.modal', function (e) {
                    setTimeout(function() {
                    $(".js-example-basic-multiple").trigger("change");
                },100);
                })
                $('#kt_modal_add_banner').on('hidden.bs.modal', function (e) {
                        $(".prepaidSelect").prop('disabled', false);
                        $(".socId").prop('disabled', false);
                        $(".postpaidSelect").prop('disabled', false);
                        $(".planSelect").prop('disabled', false);
                        $(".socIDincludeexclude").prop('disabled', false);
                        $(".postpaidSelect").removeClass("postpaidSelectdisable");
                        $(".prepaidSelect").removeClass("prepaidSelectdisable");
                        $('.js-example-basic-multiple').val(null).trigger('change');
                        
                    $("#kt_modal_add_banner_form")[0].reset();
                    let data = false;
                    @this.set('edit_mode',data)
                })
                $('.lobSelect').on('change',function(){
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
</script>
@endpush
