@extends('layouts.app')
@section('content')
    
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style=""></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"><a href="#">HOME</a></li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner row">
                        <dt class="col-sm-8 ">기본배송비</dt>
                        <dd class="col-sm-4 text-sm-right" >
                            0건
                        </dd>
                        <dt class="col-sm-8 ">준비중</dt>
                        <dd class="col-sm-4 text-sm-right" >
                            0건
                        </dd>
                        <dt class="col-sm-8 ">구매후발송대기</dt>
                        <dd class="col-sm-4 text-sm-right" >
                            0건
                        </dd>
                        <dt class="col-sm-8 ">중국배송중</dt>
                        <dd class="col-sm-4 text-sm-right" >
                            0건
                        </dd>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner row">
                        <dt class="col-sm-8 ">집하지도착</dt>
                        <dd class="col-sm-4 text-sm-right" >
                            0건
                        </dd>
                        <dt class="col-sm-8 ">통관중</dt>
                        <dd class="col-sm-4 text-sm-right" >
                            0건
                        </dd>
                        <dt class="col-sm-8 ">한국배송중</dt>
                        <dd class="col-sm-4 text-sm-right" >
                            0건
                        </dd>
                        <dt class="col-sm-8 ">배송완료</dt>
                        <dd class="col-sm-4 text-sm-right" >
                            0건
                        </dd>
                    </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner row">
                        <dt class="col-sm-8 ">품절체크확인</dt>
                        <dd class="col-sm-4 text-sm-right" >
                            0건
                        </dd>
                        <dt class="col-sm-8 ">구매확정</dt>
                        <dd class="col-sm-4 text-sm-right" >
                            0건
                        </dd>
                        <dt class="col-sm-8 ">취소상품</dt>
                        <dd class="col-sm-4 text-sm-right" >
                            0건
                        </dd>
                        <dt class="col-sm-8 ">판매중지상품</dt>
                        <dd class="col-sm-4 text-sm-right" >
                            0건
                        </dd>
                    </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <!-- ./col -->
        </div>
        <div class="row">
            <div class="col-6 col-sm-6">
                <div class="card ">
                    <div class="card-header">
                        <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        월 매출통계
                        </h3>
                        <div class="card-tools">
                        {{-- <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                            <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                            </li>
                        </ul> --}}
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content p-0">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane active" id="revenue-chart"
                            style="position: relative; height: 300px;">
                            <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                        </div>
                        
                        <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2">
                              <i class="fas fa-square text-primary"></i> 매입금액
                            </span>
          
                            <span>
                              <i class="fas fa-square text-gray"></i> 마진금액
                            </span>
                          </div>
                        </div>
                    </div><!-- /.card-body -->
                </div>
            </div>
            <div class="col-6 col-sm-6">
                <div class="card">
                    {{-- <div class="card-header border-0">
                      <div class="d-flex justify-content-between">
                        <h3 class="card-title">월 마켓별통계</h3>
                        <a href="javascript:void(0);">View Report</a>
                      </div>
                    </div> --}}
                    <div class="card-header">
                        <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        월 마켓별통계
                        </h3>
                        <div class="card-tools">
                        {{-- <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                            <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                            </li>
                        </ul> --}}
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                      <div class="d-flex">
                        {{-- <p class="d-flex flex-column">
                          <span class="text-bold text-lg">820</span>
                          <span>Visitors Over Time</span>
                        </p> --}}
                        {{-- <p class="ml-auto d-flex flex-column text-right">
                          <span class="text-success">
                            <i class="fas fa-arrow-up"></i> 12.5%
                          </span>
                          <span class="text-muted">Since last week</span>
                        </p> --}}
                      </div>
                      <!-- /.d-flex -->
      
                      <div class="position-relative mb-4">
                        <canvas id="visitors-chart" height="300"></canvas>
                      </div>
      
                      <div class="d-flex flex-row justify-content-end">
                        <span class="mr-2">
                          <i class="fas fa-square text-primary"></i> 매입금액
                        </span>
                        <span>
                          <i class="fas fa-square text-gray"></i> 마진금액
                        </span>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-0">
                      <h3 class="card-title">월 마켓별 매출통계</h3>
                      <div class="card-tools">
                        <a href="#" class="btn btn-tool btn-sm">
                          <i class="fas fa-download"></i>
                        </a>
                        <a href="#" class="btn btn-tool btn-sm">
                          <i class="fas fa-bars"></i>
                        </a>
                      </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                      <table class="table table-striped table-valign-middle">
                        <thead>
                        <tr>
                          <th>마켓</th>
                          <th>주문건</th>
                          <th>판매금액</th>
                          <th>매입금액</th>
                          <th>취소건</th>
                          <th>취소금액</th>
                          <th>반품불량</th>
                          <th>금액</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                          <td>
                            <img src="dist/img/default-150x150.png" alt="" class="img-circle img-size-32 mr-2">
                            Some Product
                          </td>
                          <td>0</td>
                          <td>
                            <small class="text-danger mr-1">
                              <i class="fas fa-arrow-up"></i>
                              0%
                            </small>
                            0
                          </td>
                          <td>
                            <small class="text-danger mr-1">
                              <i class="fas fa-arrow-up"></i>
                              0%
                            </small>
                            0
                          </td>
                          <td>
                            <small class="text-danger mr-1">
                              <i class="fas fa-arrow-up"></i>
                              0%
                            </small>
                            0
                          </td>
                          <td>
                            <small class="text-danger mr-1">
                              <i class="fas fa-arrow-up"></i>
                              0%
                            </small>
                            0
                          </td>
                          <td>
                            <small class="text-danger mr-1">
                              <i class="fas fa-arrow-up"></i>
                              0%
                            </small>
                            0
                          </td>
                          <td>
                            <small class="text-success mr-1">
                              <i class="fas fa-arrow-up"></i>
                              0%
                            </small>
                            0
                          </td>
                        </tr>
                        </tbody>
                      </table>
                    </div>
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