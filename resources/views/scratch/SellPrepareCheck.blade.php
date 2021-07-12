@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="">판매준비검토</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">HOME</a></li>
                <li class="breadcrumb-item"><a href="#">상품수집관리</a></li>
                <li class="breadcrumb-item active">판매준비검토</li>
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
                    <div class="card-header pt-4">
                        <div class="row">
                            {{-- <div class="col-1">
                                <label class="float-right">일짜:</label>
                            </div> --}}
                            <div class="form-group ml-4" style="width:400px;">
                                <div class="input-group">
                                    <label class="input-group-append mt-2 ml-2" style="font-size:14px;">기간:</label>
                                    <input type="text" class="form-control form-control-sm float-right rounded-0 text-center ml-2" id="txtDateRange">
                                    <div class="input-group-append mb-2">
                                        <button type="button" class="btn btn-sm btn-default float-right rounded-0" id="daterange-btn">
                                        <i class="far fa-calendar-alt"></i> 날짜검색
                                        <i class="fas fa-caret-down"></i>
                                        </button>
                                    </div>
                                </div>
                            <!-- /.input group -->
                            </div>
                            <!-- Date and time range -->
                            {{-- <div class="col-3 form-group">
                                <div class="input-group">
                                    <button type="button" class="btn btn-sm btn-default float-right rounded-0" id="daterange-btn">
                                    <i class="far fa-calendar-alt"></i> 날짜검색
                                    <i class="fas fa-caret-down"></i>
                                    </button>
                                </div>
                            </div> --}}
                            <div class="form-group col-3" style="justify-content: space-between !important;">
                                <div class="input-group mt-1">
                                    <label class="input-group-append ml-2" style="font-size:14px;">마켓등록상품:</label>
                                    <div class="input-group-append custom-control custom-radio ml-1" style="width:70px;">
                                        <input class="custom-control-input" type="radio" id="rdoMarketRegProduct0" name="rdoMarketRegProduct" value="-1" checked>
                                        <label for="rdoMarketRegProduct0" class="custom-control-label font-weight-normal">전체</label>
                                    </div>
                                    <div class="input-group-append custom-control custom-radio" style="width:100px;">
                                        <input class="custom-control-input" type="radio" id="rdoMarketRegProduct1" name="rdoMarketRegProduct" value="1">
                                        <label for="rdoMarketRegProduct1" class="custom-control-label font-weight-normal">등록상품</label>
                                    </div>
                                    <div class="input-group-append custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="rdoMarketRegProduct2" name="rdoMarketRegProduct" value="0">
                                        <label for="rdoMarketRegProduct2" class="custom-control-label font-weight-normal">미등록상품</label>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="form-group " style="width:150px;">
                                <div class="input-group">
                                    <label class="input-group-append mt-1 ml-2" style="font-size:14px;">마켓:</label>
                                    <select class="custom-select form-control-border custom-select-sm rounded-0 ml-2" name="selMarket" id="selMarket">
                                        <option value="">==마켓 선택==</option>
                                        @foreach ($markets as $market)
                                            <option value="{{$market->strMarketCode}}" >{{$market->strMarketName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-2">
                                <div class="input-group">
                                    <label class="input-group-append mt-1 ml-2" style="font-size:14px;">검색어:</label>
                                    <input type="text" class="ml-2 form-control form-control-sm rounded-0" name="txtSearchWord" id="txtSearchWord" placeholder="">
                                </div>
                            </div>
                            <div class="col">
                                <a class="btn bg-info btn-sm float-right btnSearchData">
                                    <i class="fas fa-search"></i>
                                    Search
                                </a>
                            </div>
                            {{-- <div class="col-1">
                                <label class="float-right">출항코드:</label>
                            </div>
                            <div class="col-sm-2">
                            <!-- select -->
                                <div class="form-group">
                                    <select class="custom-select form-control-border custom-select-sm" name="selComeName" id="selComeName">
                                        <option value="">==출항코드==</option>
                                        @foreach ($comes as $come)
                                        <option value="{{$come->strComeCode}}" >[{{$come->strComeCode}}] {{$come->strComeName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                        </div>
                        {{-- <div class="row">
                            <div class="col-sm-1">
                                <label class="float-right">마켓등록상품:</label>
                            </div>
                            <div class="form-group col-1">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="rdoMarketRegProduct0" name="rdoMarketRegProduct" value="-1" checked>
                                    <label for="rdoMarketRegProduct0" class="custom-control-label">전체</label>
                                </div>
                            </div>
                            <div class="form-group col-1">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="rdoMarketRegProduct1" name="rdoMarketRegProduct" value="1">
                                    <label for="rdoMarketRegProduct1" class="custom-control-label">등록상품</label>
                                </div>
                            </div>
                            <div class="form-group col-1">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="rdoMarketRegProduct2" name="rdoMarketRegProduct" value="0">
                                    <label for="rdoMarketRegProduct2" class="custom-control-label">미등록상품</label>
                                </div>
                            </div>
                            <div class="form-group col-1">
                                <div class="input-group">
                                    <select class="custom-select form-control-border custom-select-sm" name="selMarket" id="selCategoryName4">
                                        <option value="">==마켓 선택==</option>
                                        @foreach ($markets as $market)
                                        <option value="{{$market->strMarketCode}}" >{{$market->strMarketName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-1">
                                <div class="input-group">
                                    <select class="custom-select form-control-border custom-select-sm" name="selMarketAccount" id="selCategoryName4">
                                        <option value="">==선택==</option>
                                        @foreach ($marketAccounts as $account)
                                        <option value="{{$account->nIdx}}" >{{$account->strAccountId}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                    </div> --}}
                    <hr>
                    <div class="card-body table-responsive">
                        <ul class="nav float-right">
                            <li class="pull-right float-right pr-4 pt-1" style="">
                                <a href="javascript:void(0)" class="btn btn-success btn-xs btnAddMarketProduct" >마켓상품등록</a>
                            </li>
                        </ul>
                        <form id="divProductForm">
                            <table id="productTable" class="table table-dark table-bordered table-striped projects text-xs" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width:20px !important"><input type="checkbox" name="select_all" value="1" id="select_all"></th>
                                        <th style="width:50px !important">대표이미지</th>
                                        <th style="width:500px !important">상품정보</th>
                                        <th style="width:100px !important">등록마켓</th>
                                        <th >옵션</th>
                                        <th style="width:40px !important">공급가<br>판매가</th>
                                        <th style="width:40px !important">마진</th>
                                        <th style="width:70px !important">Action</th>
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
        var table = null;
        tablTran  = $('#productTable');
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
                    //$('#reservation').val(start.format('YYYY-MM-DD') + ' ~ ' + end.format('YYYY-MM-DD'));
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

            table = tablTran.DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                scrollY: "540px",
                ajax: {
                    url: "{{ route('scratch.SellPrepareCheck') }}",
                    data: function ( d ) {
                        d.searchWord = $('#txtSearchWord').val();
                        d.daterange = $('#txtDateRange').val();
                        d.rdoMarketRegProduct = $("input[name='rdoMarketRegProduct']:checked").val();
                        d.selMarket = $('#selMarket option:selected').val();
                    }
                },
                columns: [
                    {data: 'check', name: 'check', orderable : false},
                    {data: 'mainImage', name: 'mainImage'},
                    {data: 'productInfo', name: 'productInfo'},
                    {data: 'marketInfo', name: 'marketInfo', className: "text-center"},
                    {data: 'optionInfo', name: 'optionInfo'},
                    {data: 'priceInfo', name: 'priceInfo', className: "text-right"},
                    {data: 'marginInfo', name: 'marginInfo', className: "text-right"},
                    {data: 'action', name: 'action', className: "text-center"},
                ],
                responsive: true, lengthChange: true,
                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#productTable .col-md-6:eq(0)');
            $('body').on('click', '.btnSearchData', function (e) {
                //table.reload();
                var table = $('#productTable').DataTable(); 
                table.draw();
                e.preventDefault();
            });
            $('#productTable').on('click', '.btnSellPrepare', function (e) {
                var id = $(this).attr('data-id');
                var action = '/scratchSellPrepareCheck/prduct/' + id;// $("#manageMarketAccount").attr("action");
                $.ajax({
                    url: action,
                    type: "PUT",
                    dataType: 'json',
                    success: function ({status, data}) {
                        var table = $('#productTable').DataTable(); 
                        table.draw();
                    },
                    error: function (data) {
                    }
                });
            });

            $('#productTable').on('click', '.btnEditProduct', function (e) {
                var id = $(this).attr('data-id');
                var editType = 0;//판매준비검토 수정
                window.open('/scratchSellPrepareCheck/product/' + id + '/edit/'+ editType, '상품수정', 'scrollbars=1, resizable=1, width=1000, height=900');
            });

            $('#productTable').on('click', '.btnDelProduct', function (e) {
                var id = $(this).attr('data-id');
                var url = '/scratchSellPrepareCheck/product/' + id + '/delete';
                $.ajax({
                    url: url,
                    type: "DELETE",
                    dataType: 'JSON',
                    success: function ({status, data}) {
                        var table = $('#productTable').DataTable(); 
                        table.draw();
                    },
                    error: function (data) {
                    }
                });
                    
            });

            $('#productTable').on('click', '.btnViewDetail', function (e) {
                var id = $(this).attr('data-id');
                window.open('/scratchSellPrepareCheck/product/' + id + '/detail', '상품상세', 'scrollbars=1, resizable=1, width=1000, height=620');
            });
            $('body').on('mousemove', '.preview', function (e) {
                var offset = $(this).offset();
                var imagUrl = $(this).attr('data');
                const img = new Image();
                img.src = imagUrl;
                var xOffset = 80;
                var yOffset = 600;
                if($('#preview').length)
                {
                    var top = offset.top - yOffset > 0 ? offset.top - yOffset : 0; 
                    $("#preview").css({
                        "top": top + "px",
                        "left": (offset.left + xOffset) + "px"
                    }).fadeIn();
                }
                else
                {
                    this.t = this.title,
                    this.title = "";
                    var c = (this.t != "") ? "<br/>" + this.t : "";
                    $("body").append("<p id='preview'><img style='height:600px;' src='" + imagUrl + "' alt='Image preview' />" + c + "</p>");
                    $("#preview").css({
                        "top": (offset.top - yOffset) + "px",
                        "left": (offset.left + xOffset) + "px"
                    }).fadeIn();
                }
            });
            $('body').on('mouseout', '.preview', function (e) {
                $("#preview").remove();
            });

            $('body').on('click', '.btnAddMarketProduct', function () {
                var form = $('#divProductForm');
                var table = $('#productTable').DataTable(); 
                // Iterate over all checkboxes in the table
                var products = "";
                table.$('input[type="checkbox"]').each(function(){
                    // If checkbox doesn't exist in DOM
                    if(this.checked){
                    // Create a hidden element
                        console.log(this.value);
                        products += this.value + "|";
                    }
                });
                products = products.slice(0,-1);
                var data = $('#divProductForm').serialize();
                if(products == "")
                {
                    alert("상품을 하나이상 선택해주세요!");
                    return false;
                }

                window.open('/scratchSellPrepareCheck/marketAccountList?products=' + products, '상품등록', 'scrollbars=1, resizable=1, width=1000, height=620');

                
            });
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
        });	
    </script>
    @endsection
@endsection