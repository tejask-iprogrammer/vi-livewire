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
                    <button type="button" class="btn btn-primary bannerAdd" data-bs-toggle="modal" data-bs-target="#kt_modal_add_banner">
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
        <div class="table-actions-wrapper">
            <button class="btn btn-sm red table-group-action-delete btn btn-primary"><i class="fa fa-trash"></i> Delete</button>
            <select class="form-control changeStatus">
                <option value="" selected>change Status</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
            <button class="btn btn-sm yellow table-group-action-copy btn btn-primary"><i class="fa fa-copy"></i> Copy</button>
        </div>
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
                window.LaravelDataTables['banner-table'].search(this.value).draw();
            });
            document.addEventListener('livewire:init', function () {
                Livewire.on('success', function () {
                    $('#kt_modal_add_banner').modal('hide');
                    const form = element.querySelector('#kt_modal_add_banner_form');
                    form.reset();
                    window.LaravelDataTables['banner-table'].ajax.reload();
                });
             
                $('#banner-table').on( 'draw.dt', function () {
                    $("#banner-table").find('.bannerTitle').parent().first().addClass("ClassAdded");
                    $('.ClassAdded th').each(function(i) {
                        if ( i === 0 ) {
                        $(this).html('<input type="checkbox" value="All" id="chkAll" class="form-check-input chkAll"  />');
                        }
                    });
                } );
                $('body').on("click", ".chkAll", function (e) {
                    if($(".chkAll").prop('checked') == true){
                        $('.selectMultichk').attr('checked',true);
                        // document.getElementsByClassName("selectMultichk").checked = true;
                    }else{
                        $('.selectMultichk').attr('checked',false);
                        // document.getElementsByClassName("selectMultichk").checked = false;
                    }
                });
                $('body').on("click", ".selectMultichk", function (e) {
                    var allCheked = $('body').find('input[name="multi_chk[]"]:checked').length;
                    var checkCount = $('body').find('input[name="multi_chk[]"]').length;
                    if(allCheked == checkCount){
                        // $('.chkAll').attr('checked',true);
                        document.getElementById("chkAll").checked = true;
                    }else{
                        // $('.chkAll').attr('checked',false);
                        document.getElementById("chkAll").checked = false;

                    }
                });
            //    $('.bannerAdd').on('click',function(){
            //     // const form = element.querySelector('#kt_modal_add_banner_form');
            //         // form.reset();
            //             $("#kt_modal_add_banner_form")
            //                 .find("input,textarea,select")
            //                 .val('')
            //                 .end()
            //                 .find("input[type=checkbox], input[type=radio]")
            //                 .prop("checked", "")
            //                 .end();
            //         window.LaravelDataTables['banner-table'].ajax.reload();

            //     });


            });
            document.addEventListener('livewire:init', function () {
                $('.js-example-basic-multiple').select2();
            })
               $('.lobSelect').on('change',function(){
                    let selectedLob = $(this).val();
                    if(selectedLob.toLowerCase() == "prepaid"){
                        $(".postpaidSelect").prop('disabled', true);
                        $(".socId").prop('disabled', true);
                        $(".prepaidSelect").prop('disabled', false);
                        $(".planSelect").prop('disabled', false);
                        $(".postpaidSelect").addClass("postpaidSelectdisable");
                        $(".prepaidSelect").removeClass("prepaidSelectdisable");
                        $('.socId').val('');
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
                        $('.socId').val('');
                    }else{
                        $(".prepaidSelect").prop('disabled', false);
                        $(".socId").prop('disabled', false);
                        $(".postpaidSelect").prop('disabled', false);
                        $(".planSelect").prop('disabled', false);
                        $(".postpaidSelect").removeClass("postpaidSelectdisable");
                        $(".prepaidSelect").removeClass("prepaidSelectdisable");
                        $('.socId').val('');
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
                 

                    $('body').on("click", ".table-group-action-delete", function (e) {
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
                            var get_selected_data = new Array();
                            $("input[name='multi_chk[]']").each(function (index, obj) {
                            if(this.checked)
                            {
                                    get_selected_data.push($(this).val());
                            }
                            });
                            
                            if (result.isConfirmed) {
                                if(get_selected_data.length >0){
                                    Livewire.dispatch('group_delete', [get_selected_data]);
                                }else{}
                            }
                        });
                    });

                    $('body').on("click", ".table-group-action-copy", function (e) {
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
                            var get_selected_data = new Array();
                            $("input[name='multi_chk[]']").each(function (index, obj) {
                            if(this.checked)
                            {
                                    get_selected_data.push($(this).val());
                            }
                            });
                            if (result.isConfirmed) {
                                Livewire.dispatch('group_copy', [get_selected_data]);
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
                            var get_selected_data = new Array();
                            var mainArray = new Array();
                            $("input[name='multi_chk[]']").each(function (index, obj) {
                            if(this.checked)
                            {
                                    get_selected_data.push($(this).val());
                            }
                            });
                            mainArray={
                                "ids":get_selected_data,
                                "status":status,
                            }
                            console.log(mainArray);
                            if (result.isConfirmed) {
                                Livewire.dispatch('group_status', [mainArray]);
                            }
                        });
                    });
        </script>
    @endpush

</x-default-layout>