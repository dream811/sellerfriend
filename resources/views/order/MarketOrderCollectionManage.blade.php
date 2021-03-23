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
                            <div class="col-1">
                                <label class="float-right">검색:</label>
                            </div>
                            <div class="col-sm-2">
                            <!-- select -->
                                <div class="form-group">
                                    <select class="custom-select form-control-border custom-select-sm" name="selSearchType" id="selSearchType">
                                        <option value="">==전체==</option>
                                        <option value="OrderNo" >주문번호</option>
                                        <option value="ProductName" >상품명</option>
                                        <option value="OrderName" >주문자</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-sm-2">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="txtSearchWord" id="txtSearchWord">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1">
                                <label class="float-right">마켓:</label>
                            </div>
                            <div class="col-sm-2">
                            <!-- select -->
                                <div class="form-group">
                                    <select class="custom-select form-control-border custom-select-sm" name="selMarketIdx" id="selMarketIdx">
                                        <option value="">==전체==</option>
                                        @foreach ($markets as $market)
                                            @if(count($market->marketAccounts))
                                                <option value="{{$market->nIdx}}" >{{$market->strMarketName}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <label class="float-right">매칭:</label>
                            </div>
                            <div class="form-group col-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="chkMatchN" name="chkMatchN" value="1">
                                    <label for="chkMatchN" class="custom-control-label">미매칭</label>
                                </div>
                            </div>
                            <div class="form-group col-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="chkMatchY" name="chkMatchY" value="1">
                                    <label for="chkMatchY" class="custom-control-label">매칭완료</label>
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
                                                    <th style="width:50px !important">대표이미지</th>
                                                    <th style="width:800px !important">상품정보</th>
                                                    <th style="width:100px !important">등록마켓</th>
                                                    <th style="width:40px !important">공급가/판매가</th>
                                                    <th style="width:40px !important">마진</th>
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

            table = tableTran.DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                scrollY: "400px",
                ajax: {
                    url: "{{ route('product.SellTargetManage') }}",
                    data: function ( d ) {
                        d.searchWord = $('#txtSearchWord').val();
                        d.selSearchType = $('#selSearchType option:selected').val();
                        d.selMarketIdx = $('#selMarketIdx option:selected').val();
                        d.chkMatchN = $("#chkMatchN").attr("checked") ? 1 : 0;
                        d.chkMatchY = $("#chkMatchY").attr("checked") ? 1 : 0;
                    }
                },
                columns: [
                    {data: 'check', name: 'check', orderable : false},
                    {data: 'mainImage', name: 'mainImage'},
                    {data: 'productInfo', name: 'productInfo'},
                    {data: 'marketInfo', name: 'marketInfo', className: "text-center"},
                    {data: 'priceInfo', name: 'priceInfo', className: "text-right"},
                    {data: 'marginInfo', name: 'marginInfo', className: "text-right"},
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
                window.open('/order/marketAccountList', '상품주문수집', 'scrollbars=1, resizable=1, width=1000, height=620');
                return false;
                
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