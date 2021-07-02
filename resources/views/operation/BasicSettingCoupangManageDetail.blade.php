<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{asset('js/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('js/summernote/summernote-bs4.min.css')}}">

    <!-- DataTables  & Plugins -->
    <script src="{{asset('js/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('js/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('js/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <!-- <script src="{{asset('js/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('js/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('js/pdfmake/vfs_fonts.js')}}"></script> -->
    <script src="{{asset('js/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('js/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('js/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('js/summernote/summernote-bs4.min.js')}}"></script>
    @yield('third_party_stylesheets')

    @stack('page_css')
</head>
<body class="hold-transition sidebar-mini layout-fixed dark-mode text-sm">
    <div class="content-header " >
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="font-size:20px; font-weight:700;">{{'쿠팡'}} 기초설정</h1>
            </div><!-- /.col -->
            <div class="col-sm-6 float-right text-right" >
                <div style="position: fixed; z-index: 99; padding: 4px; right: 20px; background-color: lightgray; border-radius: 0.5rem;">
                    <button type="submit" class="btn btn-primary btn-xs btnSaveSetting">설정저장</button>
                    <button type="button" class="btn bg-indigo btn-xs btnClose">닫기</button>
                </div>
                
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12 text-sm">
                    <form id="manageMarketAccount" method="post" action=""> 
                        @csrf
                        <input type="hidden" name="market_id" id="market_id" value="{{ $market_id }}">
                        <input type="hidden" name="set_id" id="set_id" value="{{ $set_id }}">
                        <div class="card card-danger" style="margin-bottom:0px;">
                            <div class="card-header">
                              <h3 class="card-title text-sm">계정정보</h3>
                              <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-minus"></i>
                                </button>
                              </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">쇼핑몰계정<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-6">
                                        <select class="custom-select form-control-border custom-select-sm" name="selAccountId" id="selAccountId">
                                            <option value="">= 계정 선택 =</option>
                                            @foreach ($marketAccounts as $account)
                                            <option value="{{$account->nIdx}}" @if ( $account->nIdx == $marketSetting->nMarketAccIdx) selected @endif>{{$account->strAccountId}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">사용여부<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-6 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoIsUsed1" name="rdoIsUsed" value="1" @if( $marketSetting->bIsUsed ) checked @endif>
                                            <label for="rdoIsUsed1" class="custom-control-label pt-1" style="font-size:12px;" >사용함</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoIsUsed2" name="rdoIsUsed" value="0" @if( !$marketSetting->bIsUsed ) checked @endif>
                                            <label for="rdoIsUsed2" class="custom-control-label pt-1" style="font-size:12px;">사용안함</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">제목<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-6">
                                      <input type="text" class="form-control form-control-sm" id="txtTitle" name="txtTitle" value="{{ $marketSetting->strTitle }}" placeholder="제목">
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">지원옵션<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-6 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSupportOption" name="rdoSupportOption"  @if( $marketSetting->nSupportOption ) checked @endif value="1">
                                            <label for="rdoSupportOption" class="custom-control-label pt-1" style="font-size:12px;">[조합형2단까지] 지원</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">버전선택<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-6 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoVersion" name="rdoVersion"  @if( $marketSetting->nVersion == 2 ) checked @endif value="2">
                                            <label for="rdoVersion" class="custom-control-label pt-1" style="font-size:12px;">2.0</label>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            <!-- /.card-body -->
                        </div>
                        <div class="card card-primary" style="margin-bottom:0px;">
                            <div class="card-header">
                              <h3 class="card-title text-sm">기본정보</h3>
                              <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-minus"></i>
                                </button>
                              </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row mb-0">
                                    <label for="" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">판매대행 수수료(%)</label>
                                    <div class="col-sm-9 col-md-6">
                                        <div style="display:inline-block">
                                            <input type="number" class="form-control form-control-sm text-right" id="txtSalesAgentRate" name="txtSalesAgentRate" value="{{ $marketSetting->detail->nSalesAgentRate }}"  step="0.01" placeholder="0~100까지의 수값을 입력하세요.">
                                        </div>
                                        <div style="display:inline-block">%</div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="txtSalesPeriodStartDateTime" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">판매요청일자<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-6 mt-1 mb-1">
                                        <div style="display:inline-block">
                                            <div class="input-group">
                                                <div class="input-group-prepend mt-2 font-weight-bold">
                                                    시작일:
                                                </div>
                                                <input type="text" class="form-control form-control-sm float-right" name="txtSalesPeriodStartDateTime" id="txtSalesPeriodStartDateTime" value="{{ $marketSetting->detail->dtSalesPeriodStartDateTime }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <br>
                                        <div style="display:inline-block">
                                            <div class="input-group">
                                                <div class="input-group-prepend mt-2 font-weight-bold" >
                                                    종료일:
                                                </div>
                                                <input type="text" class="form-control form-control-sm float-right" name="txtSalesPeriodEndDateTime" id="txtSalesPeriodEndDateTime"  value="{{ $marketSetting->detail->dtSalesPeriodEndDateTime }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        <!-- /.input group -->
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mt-1 mb-0">
                                    <label for="txtUnityQuantity" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">단위수량<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-6">
                                        <div style="display:inline-block">
                                            <input type="number" class="form-control form-control-sm float-right text-right" id="txtUnityQuantity" name="txtUnityQuantity" value="{{ $marketSetting->detail->nUnitQuantity }}" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">인당최대구매수량<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-10">
                                        <div style="display:inline-block">
                                            <input type="text" class="form-control form-control-sm float-right text-right" name="txtMaxQtyPerManDayLimit" id="txtMaxQtyPerManDayLimit" value="{{ $marketSetting->detail->nMaxQtyPerManDayLimit }}">
                                        </div>
                                        <div style="display:inline-block">
                                            일
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" class="form-control form-control-sm float-right text-right" name="txtMaxQtyPerManQtyLimit" id="txtMaxQtyPerManQtyLimit" value="{{ $marketSetting->detail->nMaxQtyPerManQtyLimit }}">
                                        </div>
                                        <div style="display:inline-block">
                                            개<span style="margin-left:1rem; font-size:12px; color: red;">※ 0개는 무한대</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">병행수입 여부<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-10 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoParallelImportY" name="rdoParallelImport" @if( $marketSetting->detail->bParallelImport == 1 ) checked @endif value="1" >
                                            <label for="rdoParallelImportY" class="custom-control-label pt-1" style="font-size:12px;">병행수입</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoParallelImportN" name="rdoParallelImport" @if( $marketSetting->detail->bParallelImport == 0 ) checked @endif value="0">
                                            <label for="rdoParallelImportN" class="custom-control-label pt-1" style="font-size:12px;">비병행수입</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <span style="margin-left:1rem; font-size:12px; color: red;"> ※ 병행수입 선택시 상품정보의 수입문서이미지를 반드시 업로드해 주세요.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">해외구매대행 여부<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-6 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoOverSeaPurchaseAgentY" name="rdoOverSeaPurchaseAgent" @if( $marketSetting->detail->bOverSeaPurchaseAgent == 1 ) checked @endif value="1">
                                            <label for="rdoOverSeaPurchaseAgentY" class="custom-control-label pt-1" style="font-size:12px;">예</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoOverSeaPurchaseAgentN" name="rdoOverSeaPurchaseAgent" @if( $marketSetting->detail->bOverSeaPurchaseAgent == 0 ) checked @endif value="0">
                                            <label for="rdoOverSeaPurchaseAgentN" class="custom-control-label pt-1" style="font-size:12px;">아니</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">미성년 구매<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-6 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoOnlyAdultY" name="rdoOnlyAdult" @if( $marketSetting->detail->bOnlyAdult == 0 ) checked @endif value="0">
                                            <label for="rdoOnlyAdultY" class="custom-control-label pt-1" style="font-size:12px;">가능</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoOnlyAdultN" name="rdoOnlyAdult" @if( $marketSetting->detail->bOnlyAdult == 1 ) checked @endif value="1">
                                            <label for="rdoOnlyAdultN" class="custom-control-label pt-1" style="font-size:12px;">불가능</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">이미지 처리방법</label>
                                    <div class="col-sm-9 col-md-10 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoImageProcessType1" name="rdoImageProcessType" value="0"  @if( $marketSetting->nImageProcessType == 0 ) checked @endif>
                                            <label for="rdoImageProcessType1" class="custom-control-label pt-1" style="font-size:12px;">에러처리</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoImageProcessType2" name="rdoImageProcessType" value="1"  @if( $marketSetting->nImageProcessType == 1 ) checked @endif>
                                            <label for="rdoImageProcessType2" class="custom-control-label pt-1" style="font-size:12px;">500 x 500으로 자동등록</label>
                                            <span class="pt-1" style="margin-left:1rem; font-size:12px; color: red;">※ 이미지가 500보다 작을때 500으로 늘려서 등록됩니다. 이미지 깨짐에 유의해 주세요.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            <!-- /.card-body -->
                        </div>
                        <div class="card card-success" style="margin-bottom:0px;">
                            <div class="card-header">
                              <h3 class="card-title text-sm">배송정보 설정</h3>
                              <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-minus"></i>
                                </button>
                              </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">배송방법 <code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-2">
                                        
                                        <select class="custom-select form-control-border custom-select-sm" name="selDeliveryType" id="selDeliveryType">
                                            <option value="">= 선택 =</option>
                                            @foreach ($deliveryTypes as $deliveryType)
                                            <option value="{{$deliveryType->nIdx}}{{--{{$deliveryType->strDeliveryCode}}--}}" @if ($marketSetting->detail->nDeliveryType == $deliveryType->nIdx) selected @endif>{{$deliveryType->strDeliveryName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">개인통관부호필수<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-6 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoPersonPassingCodeType1" name="rdoPersonPassingCodeType" value="1" @if ($marketSetting->detail->nPersonPassingCodeType == 1) checked @endif>
                                            <label for="rdoPersonPassingCodeType1" class="custom-control-label pt-1" style="font-size:12px;">필수</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoPersonPassingCodeType2" name="rdoPersonPassingCodeType" value="0" @if ($marketSetting->detail->nPersonPassingCodeType == 0) checked @endif>
                                            <label for="rdoPersonPassingCodeType2" class="custom-control-label pt-1" style="font-size:12px;">비필수</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <span class="pt-1" style="margin-left:1rem; font-size:12px; color: red;">※ 배송방법이 [구매대행]일 경우 입력 바랍니다.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">묶음배송 <code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-7 row">
                                        <div class="col text-right mt-2 font-weight-bold" style="font-size:12px;">
                                                묶음배송여부
                                        </div>
                                        <div class="col">
                                            <select class="custom-select custom-select-sm" name="selUnionDeliveryType" id="selUnionDeliveryType">
                                                <option value="">= 선택 =</option>
                                                <option value="UNION_DELIVERY" @if ($marketSetting->detail->strUnionDeliveryType == "UNION_DELIVERY") selected @endif>묶음배송</option>
                                                <option value="NOT_UNION_DELIVERY" @if ($marketSetting->detail->strUnionDeliveryType == "NOT_UNION_DELIVERY") selected @endif>묶음배송불가</option>
                                            </select>
                                        </div>
                                        <div class="col text-right mt-2 font-weight-bold" style="font-size:12px;">
                                            묶음배송수량
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control form-control-sm text-right" name="txtUnionDeliveryQty" id="txtUnionDeliveryQty" value="{{$marketSetting->detail->nUnionDeliveryQty}}">
                                        </div>
                                        <div class="col mt-2 font-weight-bold" style="font-size:12px;">
                                            개
                                        </div>
                                        <div class="ml-auto">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">도서산간배송여부<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-6 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoRemoteAreaDeliveryType0" name="rdoRemoteAreaDeliveryType" @if ($marketSetting->detail->nRemoteAreaDeliveryType == 1) checked @endif value="1">
                                            <label for="rdoRemoteAreaDeliveryType0" class="custom-control-label pt-1" style="font-size:12px;">가능</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoRemoteAreaDeliveryType1" name="rdoRemoteAreaDeliveryType" @if ($marketSetting->detail->nRemoteAreaDeliveryType == 0) checked @endif value="0">
                                            <label for="rdoRemoteAreaDeliveryType1" class="custom-control-label pt-1" style="font-size:12px;">불가</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">출고소요시간 <code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-6">
                                        <div style="display:inline-block">
                                            <input type="number" class="form-control form-control-sm text-right" id="txtOutboundShippingTimeDay" name="txtOutboundShippingTimeDay" value="{{ $marketSetting->detail->nOutboundShippingTimeDay }}" placeholder="">
                                        </div>
                                        <div style="display:inline-block">일</div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">출고지<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-6">
                                        <div style="display:inline-block">
                                            <input type="text" class="form-control form-control-sm text-right" id="txtOutboundShippingPlaceCode" name="txtOutboundShippingPlaceCode" value="{{ $marketSetting->detail->strOutboundShippingPlaceCode }}" placeholder="" readonly>
                                        </div>
                                        <div style="display:inline-block">
                                            <a href="javascript:void(0);" style="height:26px;" class="btn btn-primary btn-xs mt-0 btnSearchOutboundShippingPlace">
                                                <span style="font-size:10px;">검 색</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">택배사<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-3">
                                        <select class="custom-select custom-select-sm" name="selDeliveryCompanyCode" id="selDeliveryCompanyCode">
                                            <option value="">= 선택 =</option>
                                            @foreach ($deliveryCompanies as $company)
                                            <option value="{{$company->strCompanyCode}}" @if ($marketSetting->detail->strDeliveryCompanyCode == $company->strCompanyCode) selected @endif>{{$company->strCompanyName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">배송비 종류<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-3">
                                        <select class="custom-select custom-select-sm" name="selDeliveryChargeType" id="selDeliveryChargeType">
                                            <option value="">= 선택 =</option>
                                            <option value="FREE" @if ($marketSetting->detail->strDeliveryChargeType == "FREE") selected @endif>무료배송</option>
                                            <option value="NOT_FREE" @if ($marketSetting->detail->strDeliveryChargeType == "NOT_FREE") selected @endif>유료배송</option>
                                            <option value="CHARGE_RECEIVED" @if ($marketSetting->detail->strDeliveryChargeType == "CHARGE_RECEIVED") selected @endif>착불배송</option>
                                            <option value="FREE_DELIVERY_OVER" @if ($marketSetting->detail->strDeliveryChargeType == "FREE_DELIVERY_OVER") selected @endif>조건부무료배송</option>
                                            {{-- @foreach ($categories_2 as $category_2)
                                            <option value="{{$category_2->nIdx}}" >{{$category_2->strCategoryName}}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">배송비<code style="color:red !important;">[필수]</code></label>
                                    <div class="bg-light col-sm-9 col-md-7 pt-2 mb-1 row">
                                        <dt class="col-sm-5 text-sm-right mt-1">기본배송비</dt>
                                        <dd class="col-sm-6" >
                                            <input type="number" class="form-control form-control-sm text-right" id="txtDeliveryCharge" name="txtDeliveryCharge" value="{{ $marketSetting->detail->nDeliveryCharge }}" placeholder="">
                                        </dd>
                                        <dd class="col-sm-1 mt-1" >
                                            <span >원</span>
                                        </dd>
                                    
                                        <dt class="col-sm-5 text-sm-right mt-1">조건부무료</dt>
                                        <dd class="col-sm-6" >
                                            <input type="number" class="form-control form-control-sm text-right" id="txtFreeShipOverAmount" name="txtFreeShipOverAmount" value="{{ $marketSetting->detail->nFreeShipOverAmount }}" placeholder="">
                                        </dd>
                                        <dd class="col-sm-1 mt-1" >
                                            <span >원</span>
                                        </dd>
                                        <dt class="col-sm-5 text-sm-right mt-1">초도반품배송비(편도)</dt>
                                        <dd class="col-6" >
                                            <input type="number" class="form-control form-control-sm text-right" id="txtDeliveryChargeOnReturn" name="txtDeliveryChargeOnReturn" value="{{ $marketSetting->detail->nDeliveryChargeOnReturn }}" placeholder="">
                                        </dd>
                                        <dd class="col-sm-1 mt-1" >
                                            <span >원</span>
                                        </dd>
                                    
                                        <dt class="col-sm-5 text-sm-right mt-1">반품배송비(편도)</dt>
                                        <dd class="col-sm-6" >
                                            <input type="number" class="form-control form-control-sm text-right" id="txtReturnDeliveryCharge" name="txtReturnDeliveryCharge" value="{{ $marketSetting->detail->nReturnDeliveryCharge }}" placeholder="">
                                        </dd>
                                        <dd class="col-sm-1 mt-1" >
                                            <span >원</span>
                                        </dd>
                                    
                                        <dt class="col-sm-5 text-sm-right mt-1">도서산간 추가배송비(제주지역)</dt>
                                        <dd class="col-sm-6" >
                                            <input type="number" class="form-control form-control-sm text-right" id="txtJejuDeliveryCharge" name="txtJejuDeliveryCharge" value="{{ $marketSetting->detail->nJejuDeliveryCharge }}" placeholder="">
                                        </dd>
                                        <dd class="col-sm-1 mt-1" >
                                            <span >원</span>
                                        </dd>
                                   
                                        <dt class="col-sm-5 text-sm-right mt-1">도서산간 추가배송비(제주외지역)</dt>
                                        <dd class="col-sm-6" >
                                            <input type="number" class="form-control form-control-sm text-right" id="txtNotJejuDeliveryCharge" name="txtNotJejuDeliveryCharge" value="{{ $marketSetting->detail->nNotJejuDeliveryCharge }}" placeholder="">
                                        </dd>
                                        <dd class="col-sm-1 mt-1" >
                                            <span >원</span>
                                        </dd>
                                        <dd class="col-sm-12 mt-1" >
                                            <span class="pt-1" style="margin-left:1rem; font-size:12px; color: red;">※ 무료배송 설정 시 초도반품배송비(편도)와, 반품배송비(편도)금액 설정</span>
                                        </dd>
                                        <dd class="col-sm-12 mt-1" >
                                            <span class="pt-1" style="margin-left:1rem; font-size:12px; color: red;">※ 유료배송 설정 시 기본배송비와 반품배송비(편도) 금액 설정</span>
                                        </dd>
                                        <dd class="col-sm-12 mt-1" >
                                            <span class="pt-1" style="margin-left:1rem; font-size:12px; color: red;">※ 조건부 무료배송 설정 시 기본배송비와 반품배송비(편도) 금액 설정</span>
                                        </dd>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">반품지<code style="color:red !important;">[필수]</code></label>
                                    <div class="bg-light col-sm-9 col-md-7 pt-2 mb-1 row">
                                        <dt class="col-sm-5 text-sm-right mt-1">반품지</dt>
                                        <dd class="col-sm-6" >
                                            <input type="text" class="form-control form-control-sm" id="txtReturnCenterCode" name="txtReturnCenterCode" value="{{ $marketSetting->detail->strReturnCenterCode }}" placeholder="" readonly>
                                        </dd>
                                        <dd class="col-sm-1 mt-1" >
                                            <a href="javascript:void(0);" style="height:26px;" class="btn btn-primary btn-xs mt-0 btnSearchReturnShippingCenter">
                                                <span style="font-size:10px;">검 색</span>
                                            </a>
                                        </dd>
                                        <dt class="col-sm-5 text-sm-right mt-1">판매자명</dt>
                                        <dd class="col-sm-7" >
                                            <input type="text" class="form-control form-control-sm" id="txtReturnSellerName" name="txtReturnSellerName" value="{{ $marketSetting->detail->strReturnSellerName }}" placeholder="">
                                        </dd>
                                        <dt class="col-sm-5 text-sm-right mt-1">판매자전화</dt>
                                        <dd class="col-sm-7" >
                                            <input type="text" class="form-control form-control-sm" id="txtCompanyContactNumber" name="txtCompanyContactNumber" value="{{ $marketSetting->detail->strCompanyContactNumber }}" placeholder="">
                                        </dd>
                                        <dt class="col-sm-5 text-sm-right mt-1">우편번호</dt>
                                        <dd class="col-sm-7" >
                                            <input type="text" class="form-control form-control-sm" id="txtReturnZipCode" name="txtReturnZipCode" value="{{ $marketSetting->detail->strReturnZipCode }}" placeholder="">
                                        </dd>
                                        <dt class="col-sm-5 text-sm-right mt-1">주소</dt>
                                        <dd class="col-sm-7" >
                                            <input type="text" class="form-control form-control-sm" id="txtReturnAddress" name="txtReturnAddress" value="{{ $marketSetting->detail->strReturnAddress }}" placeholder="">
                                        </dd>
                                        <dt class="col-sm-5 text-sm-right mt-1">상세주소</dt>
                                        <dd class="col-sm-7" >
                                            <input type="text" class="form-control form-control-sm" id="txtReturnAddressDetail" name="txtReturnAddressDetail" value="{{ $marketSetting->detail->strReturnAddressDetail }}" placeholder="">
                                        </dd>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">교환방법<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-6 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoExchangeType0" name="rdoExchangeType" value="A" @if ($marketSetting->detail->strExchangeType == "A") checked @endif>
                                            <label for="rdoExchangeType0" class="custom-control-label pt-1" style="font-size:12px;">선교환</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoExchangeType1" name="rdoExchangeType" value="B" @if ($marketSetting->detail->strExchangeType == "B") checked @endif>
                                            <label for="rdoExchangeType1" class="custom-control-label pt-1" style="font-size:12px;">후교환</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoExchangeType2" name="rdoExchangeType" value="C" @if ($marketSetting->detail->strExchangeType == "C") checked @endif>
                                            <label for="rdoExchangeType2" class="custom-control-label pt-1" style="font-size:12px;">맞교환</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoExchangeType3" name="rdoExchangeType" value="D" @if ($marketSetting->detail->strExchangeType == "D") checked @endif>
                                            <label for="rdoExchangeType3" class="custom-control-label pt-1" style="font-size:12px;">후교환(업체직송)</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoExchangeType4" name="rdoExchangeType" value="X" @if ($marketSetting->detail->strExchangeType == "X") checked @endif>
                                            <label for="rdoExchangeType4" class="custom-control-label pt-1" style="font-size:12px;">교환불가</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">착불여부<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-6 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoReturnChargeVendorType0" name="rdoReturnChargeVendorType" value="N" @if ($marketSetting->detail->strReturnChargeVendorType == "N") checked @endif>
                                            <label for="rdoReturnChargeVendorType0" class="custom-control-label pt-1" style="font-size:12px;">선불</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoReturnChargeVendorType1" name="rdoReturnChargeVendorType" value="Y" @if ($marketSetting->detail->strReturnChargeVendorType == "Y") checked @endif>
                                            <label for="rdoReturnChargeVendorType1" class="custom-control-label pt-1" style="font-size:12px;">착불</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">A/S안내<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-6 mt-1">
                                        <div>
                                            <select class="custom-select form-control-border custom-select-sm" name="selAfterServiceGuideType" id="selAfterServiceGuideType">
                                                <option value="">= 선택 =</option>
                                                @foreach ($asManuals as $asManual)
                                                <option value="{{$asManual->strAsCode}}" @if ($marketSetting->detail->strAfterServiceGuideType == $asManual->strAsCode) selected @endif >{{$asManual->strAsContent}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <textarea class="form-control text-xs" rows="3" placeholder="" name="txtAfterServiceGuide" id="txtAfterServiceGuide">{{$marketSetting->detail->strAfterServiceGuide}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">A/S전화번호<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-6 mt-1">
                                        <input type="text" class="form-control form-control-sm" id="txtAfterServiceContactNumber" name="txtAfterServiceContactNumber" value="{{ $marketSetting->detail->strAfterServiceContactNumber }}" placeholder="전화번호">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-warning" style="margin-bottom:0px;">
                            <div class="card-header">
                              <h3 class="card-title text-sm">기타정보 설정</h3>
                              <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-minus"></i>
                                </button>
                              </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">인증서선택</label>
                                    <div class="bg-light col-sm-9 col-md-7 pt-2 mb-1 row">
                                        <dt class="col-sm-5 text-sm-right mt-1">필수인증서류1</dt>
                                        <dd class="col-sm-7" >
                                            <select class="custom-select form-control-border custom-select-sm" name="selRequireDocument1" id="selRequireDocument1">
                                                <option value="">= 선택 =</option>
                                                @foreach ($documentImages as $image)
                                                <option value="{{$image->nIdx}}" @if($marketSetting->topImage && $marketSetting->detail->nRequireDocument1 == $image->nIdx) selected @endif>{{$image->strImageName}}</option>
                                                @endforeach
                                            </select>
                                        </dd>
                                        <dt class="col-sm-5 text-sm-right mt-1">필수인증서류2</dt>
                                        <dd class="col-sm-7" >
                                            <select class="custom-select form-control-border custom-select-sm" name="selRequireDocument2" id="selRequireDocument2">
                                                <option value="">= 선택 =</option>
                                                @foreach ($documentImages as $image)
                                                <option value="{{$image->nIdx}}" @if($marketSetting->topImage && $marketSetting->detail->nRequireDocument2 == $image->nIdx) selected @endif>{{$image->strImageName}}</option>
                                                @endforeach
                                            </select>
                                        </dd>
                                        <dt class="col-sm-5 text-sm-right mt-1">기타인증서류</dt>
                                        <dd class="col-sm-7" >
                                            <select class="custom-select form-control-border custom-select-sm" name="selRequireDocument3" id="selRequireDocument3">
                                                <option value="">= 선택 =</option>
                                                @foreach ($documentImages as $image)
                                                <option value="{{$image->nIdx}}" @if($marketSetting->topImage && $marketSetting->detail->nRequireDocument3 == $image->nIdx) selected @endif>{{$image->strImageName}}</option>
                                                @endforeach
                                            </select>
                                        </dd>
                                        <dt class="col-sm-5 text-sm-right mt-1">수입신고필증(병행수입시)</dt>
                                        <dd class="col-sm-7" >
                                            <select class="custom-select form-control-border custom-select-sm" name="selRequireDocument4" id="selRequireDocument4">
                                                <option value="">= 선택 =</option>
                                                @foreach ($documentImages as $image)
                                                <option value="{{$image->nIdx}}" @if($marketSetting->topImage && $marketSetting->detail->nRequireDocument4 == $image->nIdx) selected @endif>{{$image->strImageName}}</option>
                                                @endforeach
                                            </select>
                                        </dd>
                                        <dt class="col-sm-5 text-sm-right mt-1">인보이스영수증(해외구매대행시)</dt>
                                        <dd class="col-sm-7" >
                                            <select class="custom-select form-control-border custom-select-sm" name="selRequireDocument5" id="selRequireDocument5">
                                                <option value="">= 선택 =</option>
                                                @foreach ($documentImages as $image)
                                                <option value="{{$image->nIdx}}" @if($marketSetting->topImage && $marketSetting->detail->nRequireDocument5 == $image->nIdx) selected @endif>{{$image->strImageName}}</option>
                                                @endforeach
                                            </select>
                                        </dd>
                                        <dt class="col-sm-5 text-sm-right mt-1">국내제품정품인증서류<br>(고위험군카테고리)</dt>
                                        <dd class="col-sm-7" >
                                            <select class="custom-select form-control-border custom-select-sm" name="selRequireDocument6" id="selRequireDocument6">
                                                <option value="">= 선택 =</option>
                                                @foreach ($documentImages as $image)
                                                <option value="{{$image->nIdx}}" @if($marketSetting->topImage && $marketSetting->detail->nRequireDocument6 == $image->nIdx) selected @endif>{{$image->strImageName}}</option>
                                                @endforeach
                                            </select>
                                        </dd>
                                        <dd class="col-sm-12 mt-1" >
                                            <span class="pt-1" style="margin-left:1rem; font-size:12px; color: red;">※ KC인증은 상품정보의 인증문서이미지, 수입신고필증(병행수입 선택시)은 수입문서이미지로 적용됩니다.</span>
                                        </dd>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-secondary" style="margin-bottom:0px;">
                            <div class="card-header">
                              <h3 class="card-title text-sm">상하단문구추가</h3>
                              <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-minus"></i>
                                </button>
                              </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">상/하단 문구</label>
                                    <div class="bg-light col-sm-9 col-md-7 pt-2 mb-1 row">
                                        <dd class="col-sm-6" >
                                            <select class="custom-select form-control-border custom-select-sm" name="selTopImage" id="selTopImage">
                                                <option value="" data-url="">= 선택 =</option>
                                                @foreach ($documentImages as $image)
                                                    @if ($image->strImageType == "TOP")
                                                        <option value="{{$image->nIdx}}" data-url="{{$image->strImageURL}}" @if($marketSetting->topImage && $marketSetting->nTopImageIdx == $image->nIdx) selected @endif>{{$image->strImageName}}</option>    
                                                    @endif
                                                @endforeach
                                            </select>
                                            <div>
                                                <div class="bg-gray border border-danger"  style="height: 200px;">
                                                    <img name="imgTopPrev" id="imgTopPrev" @if($marketSetting->topImage) src="{{$marketSetting->topImage->strImageURL}}" @else src="https://via.placeholder.com/300/FFFFFF?text=No%20Image" @endif style="width:100%; height:100%;" alt="">
                                                </div>
                                            </div>
                                        </dd>
                                        <dd class="col-sm-6">
                                            <select class="custom-select form-control-border custom-select-sm" name="selDownImage" id="selDownImage">
                                                <option value="" data-url="">= 선택 =</option>
                                                @foreach ($documentImages as $image)
                                                    @if ($image->strImageType == "DOWN")
                                                        <option value="{{$image->nIdx}}" data-url="{{ $image->strImageURL}}" @if($marketSetting->nDownImageIdx == $image->nIdx) selected @endif>{{$image->strImageName}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <div>
                                                <div class="bg-gray border border-danger" style="height: 200px;">
                                                    <img name="imgDownPrev" id="imgDownPrev" @if($marketSetting->downImage) src="{{$marketSetting->downImage->strImageURL}}" @else src="https://via.placeholder.com/300/FFFFFF?text=No%20Image" @endif style="width:100%; height:100%;" alt="">
                                                </div>
                                            </div>
                                        </dd>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#txtSalesPeriodStartDateTime').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: true,
                timePicker24Hour: true,
                timePickerSeconds: true,
                locale: {
                format: 'YYYY-MM-DD HH:mm:ss'
                },
                minYear: parseInt(moment().format('YYYY'),10)-1
            }, function(start, end, label) {
                var years = moment().diff(start, 'years');
                
            });
            
            $('#txtSalesPeriodEndDateTime').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: true,
                timePicker24Hour: true,
                timePickerSeconds: true,
                locale: {
                format: 'YYYY-MM-DD HH:mm:ss'
                },
                minYear: parseInt(moment().format('YYYY'),10)-1,
                // maxYear: parseInt(moment().format('YYYY'),10)
            }, function(start, end, label) {
                var years = moment().diff(start, 'years');
                
            });

            $('.chkMarcketAccount').on('change', function(){
                if(!this.checked){
                    $('#select_all').prop('checked', false);
                }
                // Get all rows with search applied
                // Check/uncheck checkboxes for all rows in the table
                //$('input[type="checkbox"]').prop('checked', this.checked);
            });
            $('#selAfterServiceGuideType').change(function(){ 
                var content = $('#selAfterServiceGuideType option:selected' ).text();
                $( 'textarea#txtAfterServiceGuide' ).val(content);
            });
            $('#selTopImage').change(function(){ 
                var link = $('#selTopImage option:selected' ).attr('data-url');
                $('#imgTopPrev' ).attr('src', link);
            });
            $('#selDownImage').change(function(){ 
                var link = $('#selDownImage option:selected' ).attr('data-url');
                $('#imgDownPrev' ).attr('src', link);
            });

            //설정 보관
            $('body').on('click', '.btnSaveSetting', function () {
                var market_id = $('#market_id').val();
                var set_id = $('#set_id').val();
                if(market_id == '0'){
                    alert('등록하려는 마켓을 선택해주세요!');
                    return false;
                }
                var account_id = $('#selAccountId option:selected').val();
                if(account_id == ""){
                    alert('등록하려는 계정을 선택해주세요!');
                    return false;
                }
                var isUsed = $("input[name='rdoIsUsed']:checked").val();
                if(isUsed == ""){
                    alert('사용여부를 선택해주세요!');
                    return false;
                }
                var title = $("#txtTitle").val();
                if(title == ""){
                    alert('제목을 입력해주세요!');
                    return false;
                }
                var supportOption = $("input[name='rdoSupportOption']:checked").val();
                if(supportOption == undefined){
                    alert('지원옵션을 선택해주세요!');
                    return false;
                }
                var version = $("input[name='rdoVersion']:checked").val();
                if(version == undefined){
                    alert('버전을 선택해주세요!');
                    return false;
                }
                var salesAgentRate = $("#txtSalesAgentRate").val();
                if(salesAgentRate == ""){
                    alert('판매대행 수수료를 입력해주세요!');
                    return false;
                }
                var txtSalesPeriodStartDateTime = $("#txtSalesPeriodStartDateTime").val();
                if(txtSalesPeriodStartDateTime == ""){
                    alert('판매요청 시작일을 입력해주세요!');
                    return false;
                }
                var txtSalesPeriodEndDateTime = $("#txtSalesPeriodEndDateTime").val();
                if(txtSalesPeriodEndDateTime == ""){
                    alert('판매요청 종료일을 입력해주세요!');
                    return false;
                }
                var txtUnityQuantity = $("#txtUnityQuantity").val();
                if(txtUnityQuantity == ""){
                    alert('단위수량을 입력해주세요!');
                    return false;
                }
                var txtMaxQtyPerManDayLimit = $("#txtMaxQtyPerManDayLimit").val();
                var txtMaxQtyPerManQtyLimit = $("#txtMaxQtyPerManQtyLimit").val();
                if(txtMaxQtyPerManDayLimit == "" || txtMaxQtyPerManQtyLimit == ""){
                    alert('인구당최대구매수량을 입력해주세요!');
                    return false;
                }
                var rdoParallelImport = $("input[name='rdoParallelImport']:checked").val();
                if(rdoParallelImport == undefined){
                    alert('병행수입여부를 선택해주세요!');
                    return false;
                }
                var selDeliveryType = $('#selDeliveryType option:selected').val();
                if(selDeliveryType == ""){
                    alert('배송방법을 선택해주세요!');
                    return false;
                }
                var selUnionDeliveryType = $('#selUnionDeliveryType option:selected').val();
                var txtUnionDeliveryQty = $("#txtUnionDeliveryQty").val();
                if(selUnionDeliveryType == "" || txtUnionDeliveryQty == ""){
                    alert('묶음배송정보를 입력해주세요!');
                    return false;
                }
                var txtOutboundShippingTimeDay = $("#txtOutboundShippingTimeDay").val();
                if(txtOutboundShippingTimeDay == ""){
                    alert('출고소요시간을 입력해주세요!');
                    return false;
                }
                var txtOutboundShippingPlaceCode = $("#txtOutboundShippingPlaceCode").val();
                if(txtOutboundShippingPlaceCode == ""){
                    alert('출고지를 입력해주세요!');
                    return false;
                }
                var selDeliveryCompanyCode = $("#selDeliveryCompanyCode option:selected").val();
                if(selDeliveryCompanyCode == ""){
                    alert('택배사를 선택해주세요!');
                    return false;
                }
                var selDeliveryChargeType = $("#selDeliveryChargeType option:selected").val();
                if(selDeliveryChargeType == ""){
                    alert('배송비종류를 선택해주세요!');
                    return false;
                }
                var txtDeliveryCharge = $("#txtDeliveryCharge").val();
                var txtFreeShipOverAmount = $("#txtFreeShipOverAmount").val();
                var txtDeliveryChargeOnReturn = $("#txtDeliveryChargeOnReturn").val();
                var txtReturnDeliveryCharge = $("#txtReturnDeliveryCharge").val();
                var txtJejuDeliveryCharge = $("#txtJejuDeliveryCharge").val();
                var txtNotJejuDeliveryCharge = $("#txtNotJejuDeliveryCharge").val();
                if(txtDeliveryCharge == "" || txtFreeShipOverAmount == "" || txtDeliveryChargeOnReturn == "" || txtReturnDeliveryCharge == "" || txtJejuDeliveryCharge == "" || txtNotJejuDeliveryCharge == ""){
                    alert('배송비를 입력해주세요!');
                    return false;
                }
                var txtReturnCenterCode = $("#txtReturnCenterCode").val();
                var txtReturnSellerName = $("#txtReturnSellerName").val();
                var txtCompanyContactNumber = $("#txtCompanyContactNumber").val();
                var txtReturnZipCode = $("#txtReturnZipCode").val();
                var txtReturnAddress = $("#txtReturnAddress").val();
                var txtReturnAddressDetail = $("#txtReturnAddressDetail").val();
                if(txtReturnCenterCode == "" || txtReturnSellerName == "" || txtCompanyContactNumber == "" || txtReturnZipCode == "" || txtReturnAddress == "" || txtReturnAddressDetail == ""){
                    alert('반품지를 입력해주세요!');
                    return false;
                }
                var rdoExchangeType = $("input[name='rdoExchangeType']:checked").val();
                if(rdoExchangeType == undefined){
                    alert('교환방법을 선택해주세요!');
                    return false;
                }
                var rdoReturnChargeVendorType = $("input[name='rdoReturnChargeVendorType']:checked").val();
                if(rdoReturnChargeVendorType == undefined){
                    alert('착불여부정보를 선택해주세요!');
                    return false;
                }
                var txtAfterServiceGuide = $("txtarea#txtAfterServiceGuide").val();
                if(txtAfterServiceGuide == ""){
                    alert('A/S안내 내용을 입력해주세요!');
                    return false;
                }
                var txtAfterServiceContactNumber = $("#txtAfterServiceContactNumber").val();
                if(txtAfterServiceContactNumber == ""){
                    alert('A/S전화번호를 입력해주세요!');
                    return false;
                }

                $( "#manageMarketAccount" ).submit();
                window.opener.location.reload();
            });
            $('body').on('click', '.btnClose', function () {
                var market_id = $('#market_id').val();
                var set_id = $('#set_id').val();
                window.close();
            });
            //출고지 선택
            $('body').on('click', '.btnSearchOutboundShippingPlace', function () {
                var market_id = $("#market_id").val();
                var account_id = $('#selAccountId option:selected').val();
                if(account_id == ""){
                    alert('등록하려는 계정을 선택해주세요!');
                    return false;
                }
                window.open('/operationBasicSettingManage/SearchOutboundShippingPlace/' + market_id + '/account/' + account_id, '출고지선택', 'scrollbars=1, resizable=1, width=1076, height=500');
                return false;
            });
            $.SetOutboundShippingPlace = function(outboudCode=0){
                $("#txtOutboundShippingPlaceCode").val(outboudCode);
            }
            //반품지 선택
            $('body').on('click', '.btnSearchReturnShippingCenter', function () {
                var market_id = $("#market_id").val();
                var account_id = $('#selAccountId option:selected').val();
                if(account_id == ""){
                    alert('등록하려는 계정을 선택해주세요!');
                    return false;
                }
                window.open('/operationBasicSettingManage/SearchReturnShippingCenter/' + market_id + '/account/' + account_id, '반품지선택', 'scrollbars=1, resizable=1, width=1076, height=500');
                return false;
            });
            $.SetReturnCenter = function(returnCode=0, returnSellerName, companyContactNumber, returnZipCode, returnAddress, returnAddressDetail){
                $("#txtReturnCenterCode").val(returnCode);
                $("#txtReturnSellerName").val(returnSellerName);
                $("#txtCompanyContactNumber").val(companyContactNumber);
                $("#txtReturnZipCode").val(returnZipCode);
                $("#txtReturnAddress").val(returnAddress);
                $("#txtReturnAddressDetail").val(returnAddressDetail);
            }
            
        });
        function SetOutboundShippingPlace(outboudCode=0){
            $.SetOutboundShippingPlace(outboudCode);
        }
        function SetReturnShippingCenter(returnCode=0, returnName="name", returnContact = "contact", returnZip="111", returnAddress="address", returnDetail="detail address"){
            $.SetReturnCenter(returnCode, returnName, returnContact, returnZip, returnAddress, returnDetail);
        }
    </script>
</body>
</html>

