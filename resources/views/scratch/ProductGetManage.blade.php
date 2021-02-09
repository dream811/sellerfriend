@extends('layouts.app')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="">상품수집관리</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">HOME</a></li>
                <li class="breadcrumb-item"><a href="#">상품수집관리</a></li>
                <li class="breadcrumb-item active">상품수집관리</li>
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
                    <div class="card-header">
                        <div class="row">
                            <div class="col-1">
                                <label class="float-right">검색어:</label>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" id="id" placeholder="">
                                </div>
                            </div>
                            <div class="col-1">
                                <label class="float-right">출항코드:</label>
                            </div>
                            <div class="col-sm-2">
                            <!-- select -->
                                <div class="form-group">
                                    <select class="custom-select form-control-border custom-select-sm" name="selComeName" id="selComeName">
                                        <option value="0">==출항코드==</option>
                                        @foreach ($comes as $come)
                                        <option value="{{$come->nIdx}}" >[{{$come->strComeCode}}] {{$come->strComeName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1">
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
                        </div>
                        <div class="row">
                            <div class="col-1">
                                <label class="float-right">일짜:</label>
                            </div>
                            <div class="col-3 form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm float-right" id="reservation">
                                </div>
                            <!-- /.input group -->
                            </div>
                            <!-- Date and time range -->
                            <div class="col-6 form-group">
                                <div class="input-group">
                                    <button type="button" class="btn btn-sm btn-default float-right" id="daterange-btn">
                                    <i class="far fa-calendar-alt"></i> 날짜검색
                                    <i class="fas fa-caret-down"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-1">
                                <label class="float-right">배공개여부</label>
                            </div>
                            <div class="form-group col-1">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="customRadio1" name="customRadio">
                                    <label for="customRadio1" class="custom-control-label">전체</label>
                                </div>
                            </div>
                            <div class="form-group col-1">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio" checked>
                                    <label for="customRadio2" class="custom-control-label">공개</label>
                                </div>
                            </div>
                            <div class="form-group col-1">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio" checked>
                                    <label for="customRadio2" class="custom-control-label">비공개</label>
                                </div>
                            </div>
                            <div class="col-1">
                                <label class="float-right">국가별상품:</label>
                            </div>
                            <div class="col-sm-2">
                            <!-- select -->
                                <div class="form-group">
                                    <select class="custom-select form-control-border custom-select-sm" name="selComeName" id="selComeName">
                                        <option value="0">==국가==</option>
                                        @foreach ($comes as $come)
                                        <option value="{{$come->nIdx}}" >[{{$come->strComeCode}}] {{$come->strComeName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">목록스타일</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                <form>
                                    <div class="card-body table-responsive p-0" >
                                        <table id="example" class="table table-striped projects" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" name="select_all" value="1" id="select-all"></th>
                                                    <th>상품정보</th>
                                                    <th></th>
                                                    <th>등록마켓관리</th>
                                                    <th>공급가/판매가</th>
                                                    <th>마진</th>
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
    <!-- //==Modal==// -->
    <div class="modal fade"  id="modal-id_manage">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title text-sm" style="font-weight: 700">오픈마켓 아이디등록관리</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div>
                <form id="manageMarketAccount" method="post" action="{{ route('operation.OpenMarketManageAccountSave', 1) }}"> 
                    <div class="form-group row">
                        <label for="txtAccountId" class="col-sm-2 col-form-label lb-sm" style="font-size:12px;">아이디</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" name="txtAccountId" id="txtAccountId" placeholder="ID">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txtAccountPwd" class="col-sm-2 col-form-label lb-sm" style="font-size:12px;">비밀번호</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" name="txtAccountPwd" id="txtAccountPwd" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txtAPIAccessKey" class="col-sm-2 col-form-label lb-sm" style="font-size:12px;">Access API Key</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" name="txtAPIAccessKey" id="txtAPIAccessKey" placeholder="API Access Key">
                        </div>
                    </div>
                    <div class="form-group row float-right">
                        <div class="col-12 btn-group">
                            <button type="button" class="btn btn-success btn-flat btn-xs btnChkUnregMarketAccount" >
                            아이디 유효성검사
                            </button>
                            <button type="submit" class="btn btn-info btn-flat btn-xs btnAddMarketAccount">
                            아이디등록
                            </button>
                            <button type="button" class="btn btn-primary btn-flat btn-xs btnChkRegMarketAccount">
                            등록된 아이디 유효성검사
                            </button>
                        </div>
                    </div>
                </form>    
                </div>
                <br>
                <hr>
                <div>
                    <table class="table table-bordered marketAccountsTable">
                    <thead>
                        <tr class="asd">
                        <th style="width: 10px">#</th>
                        <th>ID</th>
                        <th>비밀번호</th>
                        <th>Access API Key</th>
                        <th>사용여부</th>
                        <th style="width: 120px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                    </table>
                </div>
            </div>
            
            <div class="modal-footer ">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
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
                processing: true,
                serverSide: true,
                scrollY: "400px",
                //ajax: "{{ route('product.SellTargetManage') }}",
                ajax: {
                    url: "{{ route('product.SellTargetManage') }}",
                    data: function ( d ) {
                        d.daterange = $('#reservation').val();
                        d.comecode = $('#reservation').val();
                    }
                },
                columns: [
                    {data: 'check', name: 'check'},
                    {data: 'mainImage', name: 'mainImage'},
                    {data: 'productInfo', name: 'productInfo'},
                    {data: 'marketInfo', name: 'marketInfo'},
                    {data: 'priceInfo', name: 'priceInfo'},
                    {data: 'marginInfo', name: 'marginInfo'},
                ],
                responsive: true, lengthChange: true, autoWidth: false,
                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');

            $('body').on('click', '.btnAddMarketProduct', function () {
                var action = '/productSellTargetManageProducts/addMarketProduct';// $("#manageMarketAccount").attr("action");
                $.ajax({
                    url: action,
                    type: "POST",
                    dataType: 'json',
                    success: function ({status, data}) {
                        
                    },
                    error: function (data) {
                    }
                });
            });
        });	  
    </script>
    @endsection
@endsection