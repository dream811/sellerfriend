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
                <li class="breadcrumb-item"><a href="#">상품관리</a></li>
                <li class="breadcrumb-item active">판매대상상품</li>
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
                            <!-- /.form group -->
                            <div class="col-sm-1">
                                <label class="float-right">등록일:</label>
                            </div>
                            <div class="col-sm-2 form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm float-right" id="txtDateRange">
                                </div>
                            <!-- /.input group -->
                            </div>
                            <!-- Date and time range -->
                            <div class="col-sm-1">
                                <div class="input-group">
                                    <button type="button" class="btn btn-sm btn-default" id="daterange-btn">
                                    <i class="far fa-calendar-alt"></i><span class="text-xs font-weight-bold">날짜검색</span>
                                    <i class="fas fa-caret-down"></i>
                                    </button>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-1">
                                <label class="float-right">집하지:</label>
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
                            </div>
                            <div class="col-sm-1">
                                <label class="float-right">검색항목:</label>
                            </div>
                            <div class="col-sm-2">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <label class="float-right">카테고리:</label>
                            </div>
                            <div class="col-sm-1">
                                <!-- select -->
                                    <div class="form-group">
                                        <div class="input-group">
                                            <select class="custom-select form-control-border custom-select-sm" name="selCategoryName1" id="selCategoryName1">
                                                <option value="">카테고리 1</option>
                                                @foreach ($categories_1 as $category_1)
                                                <option value="{{$category_1->strCategoryTree}}" >{{$category_1->strCategoryName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <div class="input-group">
                                        <select class="custom-select form-control-border custom-select-sm" name="selCategoryName2" id="selCategoryName2">
                                            <option value="">카테고리 2</option>
                                            @foreach ($categories_2 as $category_2)
                                            <option value="{{$category_2->strCategoryTree}}" >{{$category_2->strCategoryName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <div class="input-group">
                                        <select class="custom-select form-control-border custom-select-sm" name="selCategoryName3" id="selCategoryName3">
                                            <option value="">카테고리 3</option>
                                            @foreach ($categories_3 as $category_3)
                                            <option value="{{$category_3->strCategoryTree}}" >{{$category_3->strCategoryName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <div class="input-group">
                                        <select class="custom-select form-control-border custom-select-sm" name="selCategoryName4" id="selCategoryName4">
                                            <option value="">카테고리 4</option>
                                            @foreach ($categories_4 as $category_4)
                                            <option value="{{$category_4->strCategoryTree}}" >{{$category_4->strCategoryName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group form-group form-group-sm">
                                    <input type="text" class="form-control form-control-sm" name="txtCategoryName" id="txtCategoryName" value="" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1">
                                <label class="float-right">상품상태:</label>
                            </div>
                            <div class="form-group col-1">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="rdoProductState0" name="rdoProductState" value="-1" checked>
                                    <label for="rdoProductState0" class="custom-control-label">전체</label>
                                </div>
                            </div>
                            <div class="form-group col-1">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="rdoProductState1" name="rdoProductState" value="1">
                                    <label for="rdoProductState1" class="custom-control-label">다운로드완료</label>
                                </div>
                            </div>
                            <div class="form-group col-1">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="rdoProductState2" name="rdoProductState" value="0">
                                    <label for="rdoProductState2" class="custom-control-label text-sm">다운로드대기</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <label class="float-right">배공개여부:</label>
                            </div>
                            <div class="form-group col-1">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="rdoShareType0" name="rdoShareType" value="-1" checked>
                                    <label for="rdoShareType0" class="custom-control-label">전체</label>
                                </div>
                            </div>
                            <div class="form-group col-1">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="rdoShareType2" name="rdoShareType" value="1" >
                                    <label for="rdoShareType2" class="custom-control-label">공개</label>
                                </div>
                            </div>
                            <div class="form-group col-1">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="rdoShareType1" name="rdoShareType" value="0">
                                    <label for="rdoShareType1" class="custom-control-label">비공개</label>
                                </div>
                            </div>
                            <div class="form-group col-1">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="rdoShareType3" name="rdoShareType" value="2">
                                    <label for="rdoShareType3" class="custom-control-label">멤버공유</label>
                                </div>
                            </div>
                            <div class="form-group col-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="chkMyProduct" name="chkMyProduct" value="1">
                                    <label for="chkMyProduct" class="custom-control-label">내상품</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
                            <div class="col">
                                <a class="btn bg-info btn-sm float-right btnSearchData">
                                    <i class="fas fa-search"></i>
                                    Search
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header border-bottom-0">
                        <div class="row justify-content-md-center">
                            <div class="col-sm-1">
                                <img width="30px;" src="{{asset('assets/images/country/china.ico')}}">
                                <label>0</label>
                            </div>
                            <div class="col-sm-1">
                                <img width="30px;" src="{{asset('assets/images/country/south_korea.ico')}}">
                                <label>0</label>
                            </div>
                            <div class="col-sm-1">
                                <img width="30px;" src="{{asset('assets/images/country/united_kingdom.ico')}}">
                                <label>0</label>
                            </div>
                            <div class="col-sm-1">
                                <img width="30px;" src="{{asset('assets/images/country/japan.ico')}}">
                                <label>0</label>
                            </div>
                            <div class="col-sm-1">
                                <img width="30px;" src="{{asset('assets/images/country/hong_kong.ico')}}">
                                <label>0</label>
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
                                <a href="javascript:void(0)" class="btn btn-success btnAddMarketProduct" >마켓상품등록</a>
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
                                                    <th style="width:20px !important"><input type="checkbox" name="select_all" value="1" id="select_all"></th>
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
                    url: "{{ route('product.SellTargetManage') }}",
                    data: function ( d ) {
                        d.searchWord = $('#txtSearchWord').val();
                        d.daterange = $('#txtDateRange').val();
                        d.selCome = $('#selComeName option:selected').val();
                        d.category1 = $('#selCategoryName1 option:selected').val();
                        d.category2 = $('#selCategoryName2 option:selected').val();
                        d.category3 = $('#selCategoryName3 option:selected').val();
                        d.category4 = $('#selCategoryName4 option:selected').val();
                        d.categoryName = $('#txtCategoryName').val();
                        d.productState = $("input[name='rdoProductState']:checked").val();
                        d.shareType = $("input[name='rdoShareType']:checked").val();
                        d.marketRegProduct = $("input[name='rdoMarketRegProduct']:checked").val();
                        d.market = $('#selMarket option:selected').val();
                        d.marketAccount = $('#selMarketAccount option:selected').val();
                        d.myProduct = $("#chkMyProduct").attr("checked") ? 1 : 0;
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
            $('body').on('click', '.btnSearchData', function (e) {
                //table.reload();
                var table = $('#productTable').DataTable(); 
                table.draw();
                e.preventDefault();
            });
        });	  
    </script>
    @endsection
@endsection