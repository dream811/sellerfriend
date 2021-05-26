@extends('layouts.app')
@section('content')
    
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="">등록상품관리</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">HOME</a></li>
                <li class="breadcrumb-item"><a href="#">상품관리</a></li>
                <li class="breadcrumb-item active">등록상품관리</li>
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
                    <div class="card-header border-bottom-0">
                        {{-- <div class="row">
                            <div class="col-sm-1">
                                <label class="float-right">카테고리:</label>
                            </div>
                            <div class="col-sm-1">
                                <!-- select -->
                                    <div class="form-group">
                                        <div class="input-group">
                                            <select class="custom-select form-control-border custom-select-sm" name="selCategoryName1" id="selCategoryName1">
                                                <option value="0">카테고리 1</option>
                                                @foreach ($categories_1 as $category_1)
                                                <option value="{{$category_1->nIdx}}" >{{$category_1->strCategoryName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <div class="input-group">
                                        <select class="custom-select form-control-border custom-select-sm" name="selCategoryName2" id="selCategoryName2">
                                            <option value="0">카테고리 2</option>
                                            @foreach ($categories_2 as $category_2)
                                            <option value="{{$category_2->nIdx}}" >{{$category_2->strCategoryName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <div class="input-group">
                                        <select class="custom-select form-control-border custom-select-sm" name="selCategoryName3" id="selCategoryName3">
                                            <option value="0">카테고리 3</option>
                                            @foreach ($categories_3 as $category_3)
                                            <option value="{{$category_3->nIdx}}" >{{$category_3->strCategoryName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <div class="input-group">
                                        <select class="custom-select form-control-border custom-select-sm" name="selCategoryName4" id="selCategoryName4">
                                            <option value="0">카테고리 4</option>
                                            @foreach ($categories_4 as $category_4)
                                            <option value="{{$category_4->nIdx}}" >{{$category_4->strCategoryName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group form-group form-group-sm">
                                    <input type="text" class="form-control form-control-sm" name="txtCategoryName" id="txtCategoryName" value="" placeholder="">
                                </div>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-1">
                                <label class="float-right">검색항목:</label>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-group form-group-sm">
                                    <input type="text" class="form-control form-control-sm" name="txtCategoryName" id="txtCategoryName" value="" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <label class="float-right">마켓:</label>
                            </div>
                            <div class="form-group col-2">
                                <div class="input-group">
                                    <select class="custom-select form-control-border custom-select-sm" name="market" id="market">
                                        <option value="0">==쇼핑몰 선택==</option>
                                        @foreach ($markets as $market)
                                        <option value="{{$market->nIdx}}" >{{$market->strMarketName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-2">
                                <div class="input-group">
                                    <select class="custom-select form-control-border custom-select-sm" name="marketAccount" id="marketAccount">
                                        <option value="0">==쇼핑몰 아이디 선택==</option>
                                        @foreach ($marketAccounts as $account)
                                        <option value="{{$account->nIdx}}" >{{$account->strAccountId}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <a class="btn bg-info btn-sm float-right">
                                    <i class="fas fa-search"></i>
                                    Search
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    
                    <div class="card-body">
                        {{-- <ul class="nav float-right mr-3">
                            <li class="pull-right float-right pr-1 pt-1" style="">
                                <a href="javascript:void(0)" class="btn btn-success btn-xs btnAddMarketProduct" >수정전송</a>
                            </li>
                        </ul> --}}
                        <form id="divProductForm">
                            <table id="example" class="table table-dark table-bordered table-striped projects text-xs" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" name="select_all" value="1" id="select_all"></th>
                                        <th>이미지</th>
                                        <th>상품정보</th>
                                        <th>마켓아이디</th>
                                        <th>연동코드</th>
                                        <th>판매가</th>
                                        <th>적용판매가<br>할인율</th>
                                        <th>마진</th>
                                        <th>판매기간<br>상품전송일</th>
                                    </tr>
                                </thead>
                            </table>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
    @section('script')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //Date range picker
            $('#reservation').daterangepicker({
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
                    //$('#reservation').val(start.format('YYYY-MM-DD') + ' ~ ' + end.format('YYYY-MM-DD'));
                    $('#reservation').daterangepicker({
                        locale: {
                            format: 'YYYY-MM-DD',
                            separator: " ~ "
                        }, 
                        startDate: start.format('YYYY-MM-DD'), 
                        endDate: end.format('YYYY-MM-DD') 
                    });
                }
            );

            var table = $('#example').DataTable({
                stateSave: true,
                processing: true,
                serverSide: true,
                scrollY: "500px",
                //ajax: "{{ route('product.SellTargetManage') }}",
                ajax: {
                    url: "{{ route('product.RegisteredProductManage') }}",
                    data: function ( d ) {
                        // d.daterange = $('#reservation').val();
                        // d.comecode = $('#reservation').val();
                    }
                },
                columns: [
                    {data: 'check', name: 'check', orderable: false},
                    {data: 'mainImage', name: 'mainImage'},
                    {data: 'productInfo', name: 'productInfo'},
                    {data: 'marketInfo', name: 'marketInfo'},
                    {data: 'codeInfo', name: 'codeInfo'},
                    {data: 'priceInfo', name: 'priceInfo', className: "text-right"},
                    {data: 'acceptPriceInfo', name: 'acceptPriceInfo', className: "text-right"},
                    {data: 'marginInfo', name: 'marginInfo', className: "text-right"},
                    {data: 'dateInfo', name: 'dateInfo'},
                ],
                responsive: true, lengthChange: true, autoWidth: false
            });
            
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
                // Get all rows with search applied
                var rows = table.rows({ 'search': 'applied' }).nodes();
                // Check/uncheck checkboxes for all rows in the table
                $('input[type="checkbox"]', rows).prop('checked', this.checked);
            });

            // Handle click on checkbox to set state of "Select all" control
            $('#example tbody').on('change', 'input[type="checkbox"]', function(){
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

            // // Handle form submission event
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

            $('body').on('click', '.openWindow', function(){
                console.log('good');
                var id = $(this).attr('data-id');
                window.open('/productRegisteredProductManage/'+id+'/edit','전체카테고리','width=900,height=900,location=no,status=no,scrollbars=no');
            })

            $('body').on('click', '.btnAddMarketProduct', function () {
                var form = $('#divProductForm');

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
            $('body').on('mousemove', '.preview', function (e) {
                var offset = $(this).offset();
                var imagUrl = $(this).attr('data');
                const img = new Image();
                img.src = imagUrl;
                var xOffset = 80;
                var yOffset = 700-50;
                console.log(offset.top);
                console.log(offset.left);
                if($('#preview').length)
                {
                    $("#preview").css({
                        "top": (offset.top - yOffset) + "px",
                        "left": (offset.left + xOffset) + "px"
                    }).fadeIn();
                }
                else
                {
                    this.t = this.title,
                    this.title = "";
                    var c = (this.t != "") ? "<br/>" + this.t : "";
                    $("body").append("<p id='preview'><img style='height:700px;' src='" + imagUrl + "' alt='Image preview' />" + c + "</p>");
                    $("#preview").css({
                        "top": (offset.top - yOffset) + "px",
                        "left": (offset.left + xOffset) + "px"
                    }).fadeIn();
                }
            });
            $('body').on('mouseout', '.preview', function (e) {
                $("#preview").remove();
            });
        });	  
    </script>
    @endsection
@endsection