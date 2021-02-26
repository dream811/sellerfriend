@extends('layouts.app')
@section('content')
    
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="">상하단 이미지관리</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">HOME</a></li>
                <li class="breadcrumb-item"><a href="#">운영관리</a></li>
                <li class="breadcrumb-item active">상하단이미지관리</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card card-primary card-outline card-tabs">
                        
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">목록스타일</a>
                            </li>
                            
                        </ul>
                        <ul class="nav float-right">
                            <li class="pull-right float-right pr-2 pt-2" style="">
                                <a href="javascript:void(0)" class="btn btn-success btn-sm btnAdd" >등록</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                <form id="divProductForm">
                                    <div class="card-body p-0" >
                                        <table id="productTable" class="table table-dark table-bordered table-striped projects text-xs" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th style="width:50px !important">No</th>
                                                    <th>구분</th>
                                                    <th>이미지</th>
                                                    <th>이름</th>
                                                    <th style="width:70px !important">Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
    @section('script')
    <script>
        var table = null;
        tableTran  = $('#productTable');
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //Date range picker
            $('#txtDateRange').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD',
                    separator: " ~ "
                },
                startDate: moment().subtract(29, 'days'),
                endDate  : moment()
            });
            //Date range as a button
            $('#daterange-btn').daterangepicker(
                {
                    locale: {
                        format: 'YYYY-MM-DD',
                        separator: " ~ "
                    },
                    ranges   : {
                    'Today'       : [moment(), moment()],
                    'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                    'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate  : moment()
                },
                function (start, end) {
                    $('#txtDateRange').daterangepicker({
                        locale: {
                            format: 'YYYY-MM-DD',
                            separator: " ~ "
                        }, 
                        startDate: start.format('YYYY-MM-DD'), 
                        endDate: end.format('YYYY-MM-DD') 
                    });
                }
            );

            table = tableTran.DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                scrollY: "400px",
                ajax: {
                    url: "{{ route('operation.TopDownImageManage') }}"
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false},
                    {data: 'strImageType', name: 'strImageType'},
                    {data: 'image', name: 'image'},
                    {data: 'strImageName', name: 'strImageName'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                responsive: true, lengthChange: true,
                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#productTable_wrapper .col-md-6:eq(0)');
            
            //var allPages = table.allPages();

            // $('#select-all').click(function () {
            //     if ($(this).hasClass('allChecked')) {
            //         $(allPages).find('input[type="checkbox"]').prop('checked', false);
            //     } else {
            //         $(allPages).find('input[type="checkbox"]').prop('checked', true);
            //     }
            //     $(this).toggleClass('allChecked');
            // })
            // Handle click on "Select all" control
            $('#select_all').on('click', function(){
                var table = $('#productTable').DataTable(); 
                // Get all rows with search applied
                var rows = table.rows({ 'search': 'applied' }).nodes();
                // Check/uncheck checkboxes for all rows in the table
                $('input[type="checkbox"]', rows).prop('checked', this.checked);
            });

            // Handle click on checkbox to set state of "Select all" control
            $('#productTable tbody').on('change', 'input[type="checkbox"]', function(){
                // If checkbox is not checked
                if(!this.checked){
                    var el = $('#select_all').get(0);
                    // If "Select all" control is checked and has 'indeterminate' property
                    if(el && el.checked && ('indeterminate' in el)){
                        // Set visual state of "Select all" control
                        // as 'indeterminate'
                        el.indeterminate = true;
                    }
                }
            });

            // Handle form submission event
            // $('#divProductForm').on('submit', function(e){
            //     var form = this;

            //     // Iterate over all checkboxes in the table
            //     table.$('input[type="checkbox"]').each(function(){
            //         // If checkbox doesn't exist in DOM
            //         if(!$.contains(document, this)){
            //             // If checkbox is checked
            //             if(this.checked){
            //             // Create a hidden element
            //             $(form).append(
            //                 $('<input>')
            //                     .attr('type', 'hidden')
            //                     .attr('name', this.name)
            //                     .val(this.value)
            //             );
            //             }
            //         }
            //     });
            // });

            $('body').on('click', '.btnAddMarketProduct', function () {
                var form = $('#divProductForm');
                var table = $('#productTable').DataTable(); 
                // Iterate over all checkboxes in the table
                table.$('input[type="checkbox"]').each(function(){
                    // If checkbox doesn't exist in DOM
                    if(!$.contains(document, this)){
                        // If checkbox is checked
                        if(this.checked){
                        // Create a hidden element
                        $(form).append(
                            $('<input>')
                                .attr('type', 'hidden')
                                .attr('name', this.name)
                                .val(this.value)
                        );
                        }
                    }
                });

                var action = '/productSellTargetManageProducts/marketProductAdd';// $("#manageMarketAccount").attr("action");
                var data = $('#divProductForm').serialize();
                if(data.includes("chkProduct") <= 0)
                {
                    alert("상품을 하나이상 선택해주세요!");
                    return false;
                }
                $.ajax({
                    url: action,
                    data: data,
                    type: "POST",
                    dataType: 'json',
                    success: function ({status, data}) {
                        if(status == "success"){
                            window.open('/productSellTargetManageProducts/marketAccountList', '상품등록', 'scrollbars=1, resizable=1, width=1000, height=620');
                            return false;
                        }
                    },
                    error: function (data) {
                    }
                });
                
            });
            $('body').on('click', '.btnAdd', function (e) {
                // table.reload();
                // var table = $('#productTable').DataTable(); 
                // table.draw();
                // e.preventDefault();
                
            });
            $('body').on('click', '.btnEdit', function (e) {
                // table.reload();
                // var table = $('#productTable').DataTable(); 
                // table.draw();
                // e.preventDefault();
                
            });
            $('body').on('click', '.btnDelete', function (e) {
                // table.reload();
                // var table = $('#productTable').DataTable(); 
                // table.draw();
                // e.preventDefault();
            });
        });	  
    </script>
    @endsection
@endsection