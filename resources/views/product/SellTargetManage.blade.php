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
                            <div class="col-1">
                                <label class="float-right">등록일:</label>
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
                            <div class="col-1">
                                <label class="float-right">집하지:</label>
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
                        </div>
                        <div class="row">
                            <div class="col-1">
                                <label class="float-right">상품상태:</label>
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
                                    <label for="customRadio2" class="custom-control-label">다운로드완료</label>
                                </div>
                            </div>
                            <div class="form-group col-1">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio" checked>
                                    <label for="customRadio2" class="custom-control-label">다운로드대기</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <label class="float-right">배공개여부:</label>
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
                            <div class="form-group col-1">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio" checked>
                                    <label for="customRadio2" class="custom-control-label">멤버공유</label>
                                </div>
                            </div>
                            <div class="form-group col-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                                    <label for="customCheckbox1" class="custom-control-label">내상품</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <label class="float-right">마켓등록상품:</label>
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
                                    <label for="customRadio2" class="custom-control-label">등록상품</label>
                                </div>
                            </div>
                            <div class="form-group col-1">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio" checked>
                                    <label for="customRadio2" class="custom-control-label">미등록상품</label>
                                </div>
                            </div>
                            <div class="form-group col-1">
                                <div class="input-group">
                                    <select class="custom-select form-control-border custom-select-sm" name="selCategoryName4" id="selCategoryName4">
                                        <option value="0">==쇼핑몰 선택==</option>
                                        @foreach ($categories_4 as $category_4)
                                        <option value="{{$category_4->nIdx}}" >{{$category_4->strCategoryName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-1">
                                <div class="input-group">
                                    <select class="custom-select form-control-border custom-select-sm" name="selCategoryName4" id="selCategoryName4">
                                        <option value="0">==쇼핑몰 아이디 선택==</option>
                                        @foreach ($categories_4 as $category_4)
                                        <option value="{{$category_4->nIdx}}" >{{$category_4->strCategoryName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <label class="float-right">검색항목:</label>
                            </div>
                            <div class="col-sm-2">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <a class="btn bg-info btn-sm float-right">
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
                                        <table id="example" class="table table-striped projects dataTable no-footer dtr-inline" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" name="select_all" value="1" id="select_all"></th>
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
                    {data: 'check', name: 'check', orderable: false},
                    {data: 'mainImage', name: 'mainImage'},
                    {data: 'productInfo', name: 'productInfo'},
                    {data: 'marketInfo', name: 'marketInfo'},
                    {data: 'priceInfo', name: 'priceInfo'},
                    {data: 'marginInfo', name: 'marginInfo'},
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
        });	  
    </script>
    @endsection
@endsection