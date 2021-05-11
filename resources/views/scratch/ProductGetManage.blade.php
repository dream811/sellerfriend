@extends('layouts.app')
@section('content')
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
                                <label class="float-right">일짜:</label>
                            </div>
                            {{-- 
                            <div class="col-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="txtSearchWord" id="txtSearchWord" placeholder="">
                                </div>
                            </div>
                            <div class="col-1">
                                <label class="float-right">일짜:</label>
                            </div> --}}
                            <div class="col-3 form-group">
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
                            <div class="col-3 form-group">
                                <div class="input-group">
                                    <button type="button" class="btn btn-sm btn-default float-right" id="daterange-btn">
                                    <i class="far fa-calendar-alt"></i> 날짜검색
                                    <i class="fas fa-caret-down"></i>
                                    </button>
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
                            <div class="col-1">
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
                            <div class="col-sm-2">
                                <div class="form-group form-group form-group-sm">
                                    <input type="text" class="form-control form-control-sm" name="txtCategoryName" id="txtCategoryName" value="" placeholder="">
                                </div>
                            </div>
                        </div> --}}                        
                        {{-- <div class="row">
                            <div class="col-sm-1">
                                <label class="float-right">배공개여부</label>
                            </div>
                            <div class="form-group col-1">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="rdoShareType0" name="rdoShareType" value="-1" {{ ($shareType =="2")? "checked" : "" }}>
                                    <label for="rdoShareType0" class="custom-control-label">전체</label>
                                </div>
                            </div>
                            <div class="form-group col-1">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="rdoShareType2" name="rdoShareType" value="1" {{ ($shareType =="1")? "checked" : "" }}>
                                    <label for="rdoShareType2" class="custom-control-label">공개</label>
                                </div>
                            </div>
                            <div class="form-group col-1">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="rdoShareType1" name="rdoShareType" value="0" {{ ($shareType =="0")? "checked" : "" }}>
                                    <label for="rdoShareType1" class="custom-control-label">비공개</label>
                                </div>
                            </div>
                            <div class="col-1">
                                <label class="float-right">국가별상품:</label>
                            </div>
                            <div class="col-sm-2">
                            <!-- select -->
                                <div class="form-group">
                                    <select class="custom-select form-control-border custom-select-sm" name="selCountryName" id="selCountryName">
                                        <option value="">==국가==</option>
                                        @foreach ($countries as $country)
                                        <option value="{{$country->strCountryCode}}" >{{$country->strCountryName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                        </div> --}}
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
                                        <table id="example" class="table table-dark table-bordered table-striped projects text-xs" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th style="width:20px !important"><input type="checkbox" name="select_all" value="1" id="select-all"></th>
                                                    <th style="width:50px !important">대표이미지</th>
                                                    <th style="width:800px !important">상품정보</th>
                                                    <th style="width:100px !important">등록마켓</th>
                                                    <th style="width:40px !important">공급가/판매가</th>
                                                    <th style="width:40px !important">마진</th>
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
        tablTran  = $('#example');
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
                scrollY: "400px",
                //ajax: "{{ route('product.SellTargetManage') }}",
                ajax: {
                    url: "{{ route('scratch.ProductGetManage') }}",
                    data: function ( d ) {
                        //d.searchWord = $('#txtSearchWord').val();
                        d.daterange = $('#txtDateRange').val();
                        //d.selCome = $('#selComeName option:selected').val();
                        //d.category1 = $('#selCategoryName1 option:selected').val();
                        //d.category2 = $('#selCategoryName2 option:selected').val();
                        //d.category3 = $('#selCategoryName3 option:selected').val();
                        //d.category4 = $('#selCategoryName4 option:selected').val();
                        //d.categoryName = $('#txtCategoryName').val();
                        //d.shareType = $("input[name='rdoShareType']:checked").val();
                        //d.selCountry = $('#selCountryName option:selected').val();
                    }
                },
                columns: [
                    {data: 'check', name: 'check'},
                    {data: 'mainImage', name: 'mainImage'},
                    {data: 'productInfo', name: 'productInfo'},
                    {data: 'marketInfo', name: 'marketInfo', className: "text-center"},
                    {data: 'priceInfo', name: 'priceInfo', className: "text-right"},
                    {data: 'marginInfo', name: 'marginInfo', className: "text-right"},
                    {data: 'action', name: 'action', className: "text-center"},
                ],
                responsive: true, lengthChange: true,
                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('body').on('click', '.btnSearchData', function (e) {
                var table = $('#example').DataTable(); 
                table.draw();
                e.preventDefault();
            });
            $('#example').on('click', '.btnSellPrepare', function (e) {
                var id = $(this).attr('data-id');
                var action = '/scratchProductGetManage/' + id;// $("#manageMarketAccount").attr("action");
                $.ajax({
                    url: action,
                    type: "PUT",
                    dataType: 'json',
                    success: function ({status, data}) {
                        var table = $('#example').DataTable(); 
                        table.draw();
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