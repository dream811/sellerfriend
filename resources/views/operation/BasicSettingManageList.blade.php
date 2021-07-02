@extends('layouts.app')
@section('content')
    
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="">오픈마켓 기초설정관리</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">HOME</a></li>
                <li class="breadcrumb-item"><a href="#">운영관리</a></li>
                <li class="breadcrumb-item active">오픈마켓 기초설정관리</li>
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
                        <ul class="nav float-right">
                            <li class="pull-right float-right pr-1 pt-1" style="">
                                <div class="form-group">
                                    <select class="custom-select form-control-border custom-select-sm" name="selMarketIdx" id="selMarketIdx">
                                        <option value="0">== 선택 ==</option>
                                        @foreach ($markets as $market)
                                            @if(count($market->marketAccounts))
                                                <option value="{{$market->nIdx}}" >{{$market->strMarketName}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                            <li class="pull-right float-right pr-1 pt-1" style="">
                                <a href="javascript:void(0)" class="btn btn-sm btn-success btnAddBasicSetting" >새로 등록</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                <form>
                                    <div class="card-body table-responsive p-0" style="height:500px;">
                                        <table class="table table-head-fixed table-bordered table-sm marketSettingTable">
                                            <thead style="text-align: center;">
                                                <tr style="text-align: center;">
                                                <th style="width:10px;">No</th>
                                                <th style="font-size:12px; width:120px;">마켓명</th>
                                                <th style="font-size:12px; width:100px;">ID</th>
                                                <th style="font-size:12px;">제목</th>
                                                <th style="font-size:12px;">사용여부</th>
                                                <th style="font-size:12px;">등록일</th>
                                                <th style="font-size:12px; width:70px">관리</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($settingCoupangs as $setting)
                                                    
                                                    <tr id="{{ $setting->nIdx }}" data-code="{{ $setting->nMarketIdx }}">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $setting->market->strMarketName }}</td>
                                                    <td>{{ $setting->marketAccount->strAccountId }}</td>
                                                    <td>{{ $setting->strTitle }}</td>
                                                    <td>@if( $setting->bIsUsed ) 사용 @else 미사용 @endif</td>
                                                    <td>{{ $setting->created_at }}</td>
                                                    <td class="float-center" style="width: 100px;">
                                                        <a href="javascript:void(0);" market-id="{{$setting->nMarketIdx}}" set-id="{{$setting->nIdx}}"  class="btn btn-primary btn-xs btnEditMarketAccount">
                                                            <span style="font-size:10px;">수정</span>
                                                        </a>
                                                        <a href="javascript:void(0);" market-id="{{$setting->nMarketIdx}}" set-id="{{$setting->nIdx}}"  class="btn btn-danger btn-xs btnDeleteMarketAccount">
                                                            <span style="font-size:10px;">삭제</span>
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
    @section('script')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //기초설정 새로 등록
            $('body').on('click', '.btnAddBasicSetting', function () {
                var market_id = $('#selMarketIdx').val();
                if(market_id == '0'){
                    alert('등록하려는 마켓을 선택해주세요!');
                    return false;
                }
                window.open('/operationBasicSettingManage/' + market_id + '/setting/0', '기초설정', 'scrollbars=1, resizable=1, width=1076, height=1200');
                return false;

                // $.get('operationBasicSettingManage/' + market_code + '/Account/' + market_id, function ({status, data}) {
                    
                // })
            });

            //아이디 수정
            $('body').on('click', '.btnEditMarketAccount', function () {
                var market_id = $(this).attr('market-id');
                var set_id = $(this).attr('set-id');
                window.open('/operationBasicSettingManage/' + market_id + '/setting/' + set_id, '기초설정', 'scrollbars=1, resizable=1, width=1076, height=1200');
                return false;

                // $.get('operationBasicSettingManage/' + market_code + '/Account/' + market_id, function ({status, data}) {
                    
                // })
            });

            //아이디 삭제
            $('body').on('click', '.btnDeleteMarketAccount', function () {
                var market_id = $(this).attr('market-id');
                var set_id = $(this).attr('set-id');
                if(confirm("삭제한 자료는 되살릴수 없습니다, 정말 삭제하시겠습니까?")){
                    $.get('operationBasicSettingManage/' + market_id +'/settingDelete/' + set_id, function ({status, data}) {
                        //$(".marketAccountsTable tbody tr").removeClass("selectedAccount");
                        $(".marketSettingTable tbody").find("#" + set_id).remove();
                        //location.reload();
                    });
                }
                
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
        });	  
    </script>
    @endsection
@endsection