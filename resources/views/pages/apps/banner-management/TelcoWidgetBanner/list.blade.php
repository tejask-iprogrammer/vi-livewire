<x-default-layout>

    @section('title')
        Manage telco widget banners
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('banner-management.TelcoWidgetBanner.index') }}
    @endsection

    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1 d-none">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search Banner" id="mySearchInput"/>
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <!--begin::Add user-->
                    <button type="button" class="btn btn-primary bannerAdd" data-bs-toggle="modal" data-bs-target="#kt_modal_add_telco_widget">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Add Telco Widget Banners
                    </button>
                    <!--end::Add user-->
                </div>
                <!--end::Toolbar-->

                <!--begin::Modal-->
                <livewire:telcowidget.telcowidget></livewire:telcowidget.telcowidget>
                <!--end::Modal-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <div class="table-responsive">
                <livewire:telcowidget.telcowidgetfilter></livewire:telcowidget.telcowidgetfilter>
            </div>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>

    @push('scripts')
        <script type="text/javascript">
                $('body').on("click", ".chkAll", function (e) {
                    if($(".chkAll").prop('checked') == true){
                        $('input:checkbox').prop('checked',true);
                    }else{
                        $('input:checkbox').prop('checked',false);
                    }
                });
                $('body').on("click", ".selectMultichk", function (e) {
                    var allCheked = $('body').find('input[name="multi_chk[]"]:checked').length;
                    var checkCount = $('body').find('input[name="multi_chk[]"]').length;
                    if(allCheked == checkCount){
                        document.getElementById("chkAll").checked = true;
                    }else{
                        document.getElementById("chkAll").checked = false;
                    }
                });

            document.getElementById('mySearchInput').addEventListener('keyup', function () {
                window.LaravelDataTables['banner-table'].search(this.value).draw();
            });
            document.addEventListener('livewire:init', function () {
                Livewire.on('success', function () {
                    $('#kt_modal_add_telco_widget').modal('hide');
                });
            });
            document.addEventListener('livewire:init', function () {
                // $('.js-example-basic-multiple').select2();
            })
                
        </script>
    @endpush

</x-default-layout>