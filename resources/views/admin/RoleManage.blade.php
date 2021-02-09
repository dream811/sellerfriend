@extends('layouts.app')
@section('content')
    
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="">오픈마켓 계정관리</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">HOME</a></li>
                <li class="breadcrumb-item"><a href="#">운영관리</a></li>
                <li class="breadcrumb-item active">오픈마켓 계정관리</li>
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
                                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">오픈마켓 계정관리</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                <form>
                                    <div class="card-body table-responsive p-0" style="height:500px;">
                                        <table class="table table-head-fixed table-bordered table-sm marketsTable">
                                            <thead style="text-align: center;">
                                                <tr style="text-align: center;">
                                                <th rowspan="2">ID</th>
                                                <th rowspan="2" style="font-size:12px; width:120px;">오픈마켓명</th>
                                                <th rowspan="2" style="font-size:12px; width:100px;">판매자센터<br>바로가기</th>
                                                <th rowspan="2" style="font-size:12px;">등록아이디</th>
                                                <th colspan="4" style="font-size:12px;">기능</th>
                                                <th rowspan="2" style="font-size:12px;">관리</th>
                                                </tr>
                                                <tr>
                                                <th style="font-size:12px;">상품등록</th>
                                                <th style="font-size:12px;">주문수집</th>
                                                <th style="font-size:12px;">송장전송</th>
                                                <th style="font-size:12px;">클레임</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($markets as $market)
                                                    <tr id="{{ $market->nIdx }}" data-code="{{ $market->strMarketCode }}">
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $market->strMarketName }}</td>
                                                    <td><span class="tag tag-success"><a href="{{ $market->strMarketLink }}">판매자센터</a></span></td>
                                                    <td class="marketNo">{{ $market->MarketAccounts->count() }}</td>
                                                    <td>
                                                        @if($market->bIsUpLoad =='1')업로드기능 @else -- @endif
                                                    </td>
                                                    <td>
                                                        @if($market->bIsOrder =='1')주문수집기능 @else -- @endif
                                                    </td>
                                                    <td>
                                                        @if($market->bIsInvoice =='1')송장전송기능 @else -- @endif
                                                    </td>
                                                    <td>
                                                        @if($market->bIsClaim =='1')클레임기능 @else -- @endif
                                                    </td>
                                                    <td style="width:120px;">
                                                        <a href="javascript:void(0);" data-target="#modal-id_manage" data-code="{{$market->strMarketCode}}" data-id="{{$market->nIdx}}"  class="btn btn-info btn-sm btnManageMarketAccount">
                                                            <i class="fa fa-bell"></i>ID관리
                                                        </a>
                                                    </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
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
                    @csrf
                    <div id="divForm">
                        
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

            //When click ID Management 아이디 관리(목록)
            $('body').on('click', '.btnManageMarketAccount', function () {
                var market_id = $(this).attr('data-id');
                var market_code = $(this).attr('data-code');
                $(".marketsTable tbody tr").removeClass("selectedMarket");
                $(".marketsTable tbody").find("#" + market_id).addClass("selectedMarket");

                $('.marketAccountsTable tbody').html("");
                $('.marketAccountsTable thead').html(`
                    <tr class="asd">
                        <th style="width: 10px">#</th>
                        <th>ID</th>
                        <th>비밀번호</th>
                        <th>계정구분</th>
                        <th>Vendor ID</th>
                        <th>Access API Key</th>
                        <th>Secret Key</th>
                        <th>사용여부</th>
                        <th style="width: 120px">관리</th>
                    </tr>
                `);
                $('#divForm').html(`
                    
                    <div class="form-group row">
                        <label for="txtAccountId" class="col-sm-2 col-form-label lb-sm" style="font-size:12px;">아이디</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" name="txtAccountId" id="txtAccountId" placeholder="ID">
                        </div>
                    </div>
                    <div class="form-group row" >
                        <label for="txtAccountPwd" class="col-sm-2 col-form-label lb-sm" style="font-size:12px;">비밀번호</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" name="txtAccountPwd" id="txtAccountPwd" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group row" id="divVendorId">
                        <label for="txtVendorId" class="col-sm-2 col-form-label lb-sm" style="font-size:12px;">업체코드</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" name="txtVendorId" id="txtVendorId" placeholder="VendorId">
                        </div>
                    </div>
                    <div class="form-group row"  id="divAccessAPIKey">
                        <label for="txtAPIAccessKey" class="col-sm-2 col-form-label lb-sm" style="font-size:12px;">Access API Key</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" name="txtAPIAccessKey" id="txtAPIAccessKey" placeholder="API Access Key">
                        </div>
                    </div>
                    <div class="form-group row" id="divSecretKey">
                        <label for="txtSecretKey" class="col-sm-2 col-form-label lb-sm" style="font-size:12px;">Secret Key</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" name="txtSecretKey" id="txtSecretKey" placeholder="Secret Key">
                        </div>
                    </div>
                    <div class="form-group row" id="divAccountType">
                        <label for="txtSecretKey" class="col-sm-2 col-form-label lb-sm" style="font-size:12px;">계정구분</label>
                        <div class="col-sm-10">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="rdoAccountType" name="rdoAccountType" value="1">
                                <label for="rdoAccountType" class="custom-control-label">판매자 아이디</label>
                            </div>
                        </div>
                    </div>
                `);

                $.get('operationOpenMarketManage/' + market_id + '/Accounts', function ({status, data}) {
                    //var data = response.data;
                    
                    
                    ///**행삭제**///
                    //11번가 옥션
                    if(market_code == "11thhouse" || market_code == "auction"){
                        $('#divAccountType').remove();
                        $('#divVendorId').remove();
                        $('#divSecretKey').remove();
                        $('.marketAccountsTable thead tr').each(function() {
                            $(this).children("th:eq(3)").remove();
                        });
                        $('.marketAccountsTable thead tr').each(function() {
                            $(this).children("th:eq(3)").remove();
                        });
                        
                        $('.marketAccountsTable thead tr').each(function() {
                            $(this).children("th:eq(4)").remove();
                        });
                    }
                    //롯데온 지마켓 인터파크
                    if(market_code == "lotteon" || market_code == "gmarket" || market_code == "interpark"){
                        $('#divAccountType').remove();
                        $('#divVendorId').remove();
                        $('#divSecretKey').remove();
                        $('#divAccessAPIKey').remove();
                        $('.marketAccountsTable thead tr').each(function() {
                            $(this).children("th:eq(3)").remove();
                        });
                        $('.marketAccountsTable thead tr').each(function() {
                            $(this).children("th:eq(3)").remove();
                        });
                        $('.marketAccountsTable thead tr').each(function() {
                            $(this).children("th:eq(3)").remove();
                        });
                        $('.marketAccountsTable thead tr').each(function() {
                            $(this).children("th:eq(3)").remove();
                        });
                    }
                    //스마트스토어
                    if(market_code == "smartstore"){
                        $('#divVendorId').remove();
                        $('#divSecretKey').remove();
                        $('#divAccessAPIKey').remove();
                        $('.marketAccountsTable thead tr').each(function() {
                            $(this).children("th:eq(4)").remove();
                        });
                        $('.marketAccountsTable thead tr').each(function() {
                            $(this).children("th:eq(4)").remove();
                        });
                        $('.marketAccountsTable thead tr').each(function() {
                            $(this).children("th:eq(4)").remove();
                        });
                        //
                    }
                    //위메프 티몬
                    if(market_code == "wemakeprice" || market_code == "tmon"){
                        $('#divAccountType').remove();
                        $('#divVendorId').remove();
                        $('#divSecretKey').remove();
                        $('.marketAccountsTable thead tr').each(function() {
                            $(this).children("th:eq(3)").remove();
                        });
                        $('.marketAccountsTable thead tr').each(function() {
                            $(this).children("th:eq(3)").remove();
                        });
                        $('.marketAccountsTable thead tr').each(function() {
                            $(this).children("th:eq(4)").remove();
                        });
                        
                    }
                    //쿠팡
                    if(market_code == "coupang"){
                        $('#divAccountType').remove();
                        $('.marketAccountsTable thead tr').each(function() {
                            $(this).children("th:eq(3)").remove();
                        });
                    }
                    data.forEach( (element, index) => {
                        var account = '<tr id="'+element.nIdx+'">';
                        account += '<td>' + (index + 1) + '</td>';//idx
                        account += '<td>' + element.strAccountId + '</td>';//account id
                        account += '<td>*****</td>';//account password
                        //계정구분
                        if(market_code == "smartstore"){
                            account += '<td>'+ (element.nAccountType == 1 ? '판매자계정': '---') +'</td>';//vendor id
                        }

                        ///
                        if(market_code == "coupang"){
                            account += '<td>*****</td>';//vendor id
                        }
                        if(market_code == "11thhouse" || market_code == "auction" || market_code == "coupang" || market_code == "tmon" || market_code == "wemakeprice"){
                            account += '<td>*****</td>';//api access key
                        }
                        if(market_code == "coupang"){
                            account += '<td>*****</td>';//Secret Key
                        }
                        
                        var dispText = element.bIsUsed > 0 ? "사용중" : "미사용";
                        account += '<td>' + dispText + '</td>';//Is Useable
                        account += '<td class="align-center"><a data-id="' + element.nIdx + '" class="btn btn-primary btn-xs btnEdit">수정</a>&nbsp;&nbsp;<a data-id="' + element.nIdx + '" class="btn btn-danger btn-xs btnDelete">삭제</a></td>';
                        account += '</tr>';
                        $('.marketAccountsTable tbody').append(account);
                    });
                    $('#modal-id_manage').modal('show');
                    //$('#updateStudent #txtAddress').val(data.address);
                })
            });

            $('body').on('click', '.btnEdit', function () {
                var market_id = $(".marketsTable tbody .selectedMarket").attr('id');
                var account_id = $(this).attr('data-id');
                var market_code = $(".marketsTable tbody .selectedMarket").attr('data-code');
                $.get('operationOpenMarketManage/' + market_id +'/AccountShow/' + account_id, function ({status, data}) {
                    $('#manageMarketAccount #txtAccountId').val(data.strAccountId);
                    $('#manageMarketAccount #txtAccountPwd').val(data.strAccountPwd);
                    if(market_code == "smartstore"){
                        $('#manageMarketAccount #rdoAccountType').val("1");
                        $('#manageMarketAccount #rdoAccountType').attr('checked', true);

                    }
                    if(market_code == "coupang"){
                        $('#manageMarketAccount #txtVendorId').val(data.strVendorId);
                    }
                    if(market_code == "11thhouse" || market_code == "auction" || market_code == "coupang" || market_code == "tmon" || market_code == "wemakeprice"){
                        $('#manageMarketAccount #txtAPIAccessKey').val(data.strAPIAccessKey);
                    }
                    if(market_code == "coupang"){
                        $('#manageMarketAccount #txtSecretKey').val(data.strSecretKey);
                    }
                    //$('#manageMarketAccount #txtAPIAccessKey').val(data.strAPIAccessKey);
                    $(".marketAccountsTable tbody tr").removeClass("selectedAccount");
                    $(".marketAccountsTable tbody").find("#" + account_id).addClass("selectedAccount");
                })
            });

            // Add & Update the Market Account
            $("#manageMarketAccount").validate({
                rules: {
                        txtAccountId: "required",
                        txtAccountPwd: "required",
                        txtAPIAccessKey: {
                            required: function(element) {
                                //return $('#').is(':checked')
                                var market_code = $(".marketsTable tbody .selectedMarket").attr('data-code')
                                if(market_code == "11thhouse" || market_code == "auction" || market_code == "coupang" || market_code == "tmon" || market_code == "wemakeprice"){
                                    return true;
                                }else{
                                    return false;
                                }
                            }
                        },
                        txtVendorId:  {
                            required: function(element) {
                                var market_code = $(".marketsTable tbody .selectedMarket").attr('data-code')
                                if(market_code == "coupang"){
                                    return true;
                                }else{
                                    return false;
                                }
                            }
                        },
                        txtSecretKey: {
                            required: function(element) {
                                var market_code = $(".marketsTable tbody .selectedMarket").attr('data-code')
                                if(market_code == "coupang"){
                                    return true;
                                }else{
                                    return false;
                                }
                            }
                        },
                        rdoAccountType: {
                            required: function(element) {
                                var market_code = $(".marketsTable tbody .selectedMarket").attr('data-code')
                                if(market_code == "smartstore"){
                                    return true;
                                }else{
                                    return false;
                                }
                            }
                        }
                    },
                    messages: {
                    },
        
                submitHandler: function(form) {
                    
                    var account_id = $(".marketAccountsTable tbody .selectedAccount").attr('id');
                    if(account_id > 0){
                        //$("#manageMarketAccount").updateProcess();
                        updateProcess(account_id);
                    }else{
                        newProcess();
                    }
                }
            });		
            
            $("#modal-id_manage").on('hide.bs.modal', function(){
                $(".marketsTable tbody .selectedMarket").removeClass( "selectedMarket");
                $(".marketAccountsTable tbody .selectedAccount").removeClass( "selectedAccount");
            });

            //delete account
            $('body').on('click', '.btnDelete', function () {
                var market_id = $(".marketsTable tbody .selectedMarket").attr('id');
                var account_id = $(this).attr('data-id');
                $.get('operationOpenMarketManage/' + market_id +'/AccountDelete/' + account_id, function ({status, data}) {
                    //$(".marketAccountsTable tbody tr").removeClass("selectedAccount");
                    $(".marketAccountsTable tbody").find("#" + account_id).remove();
                    $('.marketsTable tbody .selectedMarket .marketNo').html($('.marketAccountsTable tbody tr').length);
                })
            });	
            
            newProcess = function(){
                $(".marketsTable tbody #" + market_id).addClass("selectedMarket");
                var market_id = $(".marketsTable tbody .selectedMarket").attr('id');

                var form_action = 'operationOpenMarketManage/' + market_id + '/AccountSave';// $("#manageMarketAccount").attr("action");
                $.ajax({
                    data: $('#manageMarketAccount').serialize(),
                    url: form_action,
                    type: "POST",
                    dataType: 'json',
                    success: function ({status, data}) {
                        var market_code = $(".marketsTable tbody .selectedMarket").attr('data-code')
                        var account = '<tr id="'+ data.nIdx +'">';
                        account += '<td>' + ($('.marketAccountsTable tbody tr').length + 1) + '</td>';//idx
                        account += '<td>' + data.strAccountId + '</td>';//account id
                        account += '<td>*****</td>';//account password data.strAccountPwd
                        
                        //계정구분
                        if(market_code == "smartstore"){
                            account += '<td>'+ (data.nAccountType == 1 ? '판매자계정': '---') +'</td>';//vendor id
                        }
                        if(market_code == "coupang"){
                            account += '<td>*****</td>';//vendor id
                        }
                        if(market_code == "11thhouse" || market_code == "auction" || market_code == "coupang" || market_code == "tmon" || market_code == "wemakeprice"){
                            account += '<td>*****</td>';//api access key data.strAPIAccessKey
                        }
                        if(market_code == "coupang"){
                            account += '<td>*****</td>';//Secret Key
                        }
                        var dispText = data.bIsUsed > 0 ? "사용중" : "미사용";
                        account += '<td>' + dispText + '</td>';//Is Useable
                        account += '<td class="align-center"><a data-id="' + data.nIdx + '" class="btn btn-primary btn-xs btnEdit">수정</a>&nbsp;&nbsp;<a data-id="' + data.nIdx + '" class="btn btn-danger btn-xs btnDelete">삭제</a></td>';
                        account += '</tr>';            
                        $('.marketAccountsTable tbody').append(account);
                        $('#manageMarketAccount')[0].reset();
                        $('.marketsTable tbody #'+ data.nMarketIdx + ' .marketNo').html($('.marketAccountsTable tbody tr').length);
                        //$('#modal-id_manage').modal('hide');
                    },
                    error: function (data) {
                    }
                });
            }

            updateProcess = function(account_id){
                var market_id = $(".marketsTable tbody .selectedMarket").attr('id');
                var market_code = $(".marketsTable tbody .selectedMarket").attr('data-code')
                var rowIdx = $(".marketAccountsTable tbody .selectedAccount").index();
                var form_action = 'operationOpenMarketManage/' + market_id + '/AccountUpdate/' + account_id;// $("#manageMarketAccount").attr("action");

                $.ajax({
                    data: $('#manageMarketAccount').serialize(),
                    url: form_action,
                    type: "POST",
                    dataType: 'json',
                    success: function ({status, data}) {
                        var account = '<tr id="'+ data.nIdx +'">';
                        account += '<td>' + (rowIdx+1) + '</td>';//idx
                        account += '<td>' + data.strAccountId + '</td>';//account id
                        account += '<td>******</td>';//account password data.strAccountPwd
                        
                        //계정구분
                        if(market_code == "smartstore"){
                            account += '<td>'+ (data.nAccountType == 1 ? '판매자계정': '---') +'</td>';//vendor id
                        }
                        if(market_code == "coupang"){
                            account += '<td>*****</td>';//vendor id
                        }
                        if(market_code == "11thhouse" || market_code == "auction" || market_code == "coupang" || market_code == "tmon" || market_code == "wemakeprice"){
                            account += '<td>*****</td>';//api access key data.strAPIAccessKey
                        }
                        if(market_code == "coupang"){
                            account += '<td>*****</td>';//Secret Key
                        }
                        var dispText = data.bIsUsed > 0 ? "사용중" : "미사용";
                        account += '<td>' + dispText + '</td>';//Is Useable
                        account += '<td class="align-center"><a data-id="' + data.nIdx + '" class="btn btn-primary btn-xs btnEdit">수정</a>&nbsp;&nbsp;<a data-id="' + data.nIdx + '" class="btn btn-danger btn-xs btnDelete">삭제</a></td>';
                        account += '</tr>';   
                        //insert using class(selectedAccount)
                        //$(account).insertBefore($(".marketAccountsTable tbody .selectedAccount"));
                        $('.marketAccountsTable tbody tr').eq(rowIdx).after(account);
                        $(".marketAccountsTable tbody .selectedAccount").remove();
                        //$('.marketAccountsTable tbody').append(account);
                        $('#manageMarketAccount')[0].reset();
                    },
                    error: function (data) {
                    }
                });
            }
        });	  
    </script>
    @endsection
@endsection