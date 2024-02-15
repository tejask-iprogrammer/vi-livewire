<x-default-layout>

    @section('title')
        Users
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('user-management.users.index') }}
    @endsection

    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_banner">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Add Banner
                    </button>
                    <!--end::Add user-->
                </div>
                <!--end::Toolbar-->

                <!--begin::Modal-->
                <livewire:banner.banner></livewire:banner.banner>
                <!--end::Modal-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>

    @push('scripts')
        {{ $dataTable->scripts() }}
        <script>
            document.getElementById('mySearchInput').addEventListener('keyup', function () {
                window.LaravelDataTables['users-table'].search(this.value).draw();
            });
            document.addEventListener('livewire:init', function () {
                Livewire.on('success', function () {
                    $('#kt_modal_add_banner').modal('hide');
                    window.LaravelDataTables['users-table'].ajax.reload();
                });
            });
            document.addEventListener('livewire:init', function () {
                // $('.js-example-basic-multiple').select2({
                // placeholder: {
                //     // id: '', // the value of the option
                //     // text: 'Select options'
                // },
                // allowClear: true
                // });
                $('.js-example-basic-multiple').select2();
            })
               $('.lobSelect').on('change',function(){
                    let selectedLob = $(this).val();
                    // alert(selectedLob.toLowerCase());
                    if(selectedLob.toLowerCase() == "prepaid"){
                        $(".postpaidSelect").prop('disabled', true);
                        $(".socId").prop('disabled', true);
                        $(".prepaidSelect").prop('disabled', false);
                        $(".planSelect").prop('disabled', false);
                        $(".postpaidSelect").addClass("postpaidSelectdisable");
                        $(".prepaidSelect").removeClass("prepaidSelectdisable");
                    }else if(selectedLob.toLowerCase() == "postpaid"){
                        $(".prepaidSelect").prop('disabled', true);
                        $(".planSelect").prop('disabled', true);
                        $(".postpaidSelect").prop('disabled', false);
                        $(".socId").prop('disabled', false);
                        $(".prepaidSelect").addClass("prepaidSelectdisable");
                        $(".postpaidSelect").removeClass("postpaidSelectdisable");
                    }else if(selectedLob.toLowerCase() == "both"){
                        $(".prepaidSelect").prop('disabled', true);
                        $(".socId").prop('disabled', true);
                        $(".postpaidSelect").prop('disabled', true);
                        $(".planSelect").prop('disabled', true);
                        $(".postpaidSelect").addClass("postpaidSelectdisable");
                        $(".prepaidSelect").addClass("prepaidSelectdisable");
                    }else{
                        $(".prepaidSelect").prop('disabled', false);
                        $(".socId").prop('disabled', false);
                        $(".postpaidSelect").prop('disabled', false);
                        $(".planSelect").prop('disabled', false);
                        $(".postpaidSelect").removeClass("postpaidSelectdisable");
                        $(".prepaidSelect").removeClass("prepaidSelectdisable");
                    }
                });
                $('.linkType').on('change',function(){
                    let selectedLink= $(this).val();
                    if(selectedLink.toLowerCase() == "1"){
                        $(".internalLink").prop('disabled', false);
                        $(".externalLink").prop('disabled', true);
                    }else if(selectedLink.toLowerCase() == "2"){
                        $(".internalLink").prop('disabled', true);
                        $(".externalLink").prop('disabled', false);
                    }
                });

        </script>
    @endpush

</x-default-layout>