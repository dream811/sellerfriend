@extends('layouts.app')
@section('content')
    
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="">판매대상상품</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">HOME</a></li>
                <li class="breadcrumb-item"><a href="#">주문관리</a></li>
                <li class="breadcrumb-item active">오픈마켓 주문수집</li>
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
                        <div class="row">
                            <div class="form-group col-2">
                                <div class="input-group">
                                    <label class="input-group-append mt-1 ml-2" style="font-size:14px;">검색어:</label>
                                    <input type="text" class="ml-2 form-control form-control-sm rounded-0 ml-2" name="txtSearchWord" id="txtSearchWord" placeholder="">
                                </div>
                            </div>
                            <div class="form-group" style="justify-content: space-between !important; width: 220px;">
                                <div class="input-group mt-1">
                                    <label class="input-group-append ml-2" style="font-size:14px;">매칭:</label>
                                    <div class="custom-control custom-checkbox ml-3">
                                        <input class="custom-control-input" type="checkbox" id="chkMatchN" name="chkMatchN" value="1">
                                        <label for="chkMatchN" style="font-size:13px;padding-top:3px;" class="custom-control-label font-weight-normal">미매칭</label>
                                    </div>
                                    <div class="custom-control custom-checkbox ml-3">
                                        <input class="custom-control-input" type="checkbox" id="chkMatchY" name="chkMatchY" value="1">
                                        <label for="chkMatchY" style="font-size:13px;padding-top:3px;" class="custom-control-label font-weight-normal">매칭완료</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group " style="">
                                <div class="input-group">
                                    <label class="input-group-append mt-1 ml-2" style="font-size:14px;">마켓:</label>
                                    <select style="width:150px" class="custom-select form-control-border custom-select-sm rounded-0 ml-3" name="selMarketId" id="selMarketId">
                                        <option value="0">==마켓 선택==</option>
                                        @foreach ($markets as $market)
                                            <option value="{{$market->nIdx}}" >{{$market->strMarketName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col">
                                <a class="btn bg-info btn-sm float-right btnSearchData">
                                    <i class="fas fa-search"></i>
                                    Search
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">목록스타일</a>
                            </li>
                            
                        </ul>
                        <ul class="nav float-right">
                            <li class="pull-right float-right pr-1 pt-1" style="">
                                <a href="javascript:void(0)" class="btn btn-success btn-sm btnGetNewOrderList" >오픈마켓주문수집</a>
                            </li>
                            <li class="pull-right float-right pr-1 pt-1" style="">
                                <a href="javascript:void(0)" class="btn btn-danger btn-sm btnMoveDelList" >삭제리스트로이동</a>
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
                                                    <th class="m-0 p-0"></th>
                                                    <th>마켓</th>
                                                    <th class="text-center">이미지</th>
                                                    <th class="text-center" width="400px">상품정보</th>
                                                    <th class="text-center" width="100px">마켓상품번호<br>자사상품번호</th>
                                                    <th class="text-center">주문번호</th>
                                                    <th width="120px">주문일자<br>결제일시</th>
                                                    <th width="30px" class="text-center">수량</th>
                                                    <th class="text-center">주문자/배송정보</th>
                                                    <th width="50px" class="mr-1 text-center">조작</th>
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
                        separator: " ~ ",
                        customRangeLabel: "사용자지정",
                    },
                    ranges   : {
                    '오늘'       : [moment(), moment()],
                    '어제'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '지난 7일' : [moment().subtract(6, 'days'), moment()],
                    '지난 30일': [moment().subtract(29, 'days'), moment()],
                    '이달'  : [moment().startOf('month'), moment().endOf('month')],
                    '지난 달'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    // showCustomRangeLabel: false,
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

            var table = $('#productTable').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                scrollY: "400px",
                ajax: {
                    url: "{{ route('order.MarketOrderCollection') }}",
                    data: function ( d ) {
                        d.searchWord = $('#txtSearchWord').val();
                        // d.selSearchType = $('#selSearchType option:selected').val();
                        d.selMarketId = $('#selMarketId option:selected').val();
                        d.chkMatchN = $("#chkMatchN").prop("checked") ? 1 : 0;
                        d.chkMatchY = $("#chkMatchY").prop("checked") ? 1 : 0;
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable  : false},
                    {data: 'marketInfo', name: 'marketInfo', className: "text-center"},
                    {data: 'mainImage', name: 'mainImage'},
                    {data: 'productInfo', name: 'productInfo'},
                    {data: 'ICNumber', name: 'ICNumber', className: "text-center"},
                    {data: 'orderNumber', name: 'orderNumber', className: "text-center"},
                    {data: 'OrderPayDate', name: 'OrderPayDate', className: "text-center"},
                    {data: 'nShippingCount', name: 'nShippingCount', className: "text-right"},
                    {data: 'ODInfo', name: 'ODInfo'},
                    {data: 'action', name: 'action', className: "", orderable : false},
                ],
                responsive: true, lengthChange: true,
                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#productTable_wrapper .col-md-6:eq(0)');
            
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

            $('body').on('click', '.btnGetNewOrderList', function () {
                window.open('/orderMarketOrderCollection/getMarketAccountList', '상품주문수집', 'scrollbars=1, resizable=1, width=1000, height=620');
                return false;
                
            });
            $('body').on('click', '.rdoRequestType', function () {
                var id = $(this).attr('data-id');
                var value = $(this).val();
                var action = "/orderMarketOrderCollection/updateRequestType/" + id;
                $.ajax({
                    url: action,
                    data: {value},
                    type: "PUT",
                    dataType: 'json',
                    success: function ({status, data}) {
                        console.log(data);
                    },
                    error: function (data) {
                    }
                });
            });

            $('body').on('click', '.btnMatching', function () {
                var id = $(this).attr('data-id');
                window.open('/orderMarketOrderCollection/matchProduct/' + id, '상품매칭', 'scrollbars=1, resizable=1, width=1000, height=620');
            });

            $('body').on('click', '.btnSearchData', function (e) {
                //table.reload();
                var table = $('#productTable').DataTable(); 
                table.draw();
                e.preventDefault();
            });

            $('body').on('mousemove', '.preview', function (e) {
                var offset = $(this).offset();
                var imagUrl = $(this).attr('data');
                const img = new Image();
                img.src = imagUrl;
                var xOffset = 80;
                var yOffset = 700-50;
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
        function drawTable() {
            
        }
    </script>
    @endsection
@endsection