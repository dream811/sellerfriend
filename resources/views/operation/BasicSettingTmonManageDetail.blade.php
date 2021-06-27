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
                <h1 class="m-0" style="font-size:20px; font-weight:700;">{{'11번가'}} 기초설정</h1>
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
                                    <label for="" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">닉네임<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-6">
                                        <div style="display:inline-block">
                                            <input type="text" class="form-control form-control-sm" id="txtSelMnbdNckNm" name="txtSelMnbdNckNm" value="{{ $marketSetting->strSelMnbdNckNm }}" placeholder="닉네임을 입력하세요.">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">판매방식<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-10 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSelMthdCd1" name="rdoSelMthdCd" @if( $marketSetting->strSelMthdCd == '01' ) checked @endif value="01" >
                                            <label for="rdoSelMthdCd1" class="custom-control-label pt-1" style="font-size:12px;">고정가판매</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSelMthdCd4" name="rdoSelMthdCd" @if( $marketSetting->strSelMthdCd == '04' ) checked @endif value="04">
                                            <label for="rdoSelMthdCd4" class="custom-control-label pt-1" style="font-size:12px;">예약판매</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSelMthdCd5" name="rdoSelMthdCd" @if( $marketSetting->strSelMthdCd == '05' ) checked @endif value="05">
                                            <label for="rdoSelMthdCd5" class="custom-control-label pt-1" style="font-size:12px;">중고판매</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">서비스상품 <code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-2">
                                        
                                        <select class="custom-select form-control-border custom-select-sm" name="selPrdTypCd" id="selPrdTypCd">
                                            <option value="">= 선택 =</option>
                                            {{-- @foreach ($deliveryTypes as $deliveryType)
                                            <option value="{{$deliveryType->nIdx}}" @if ($marketSetting->nDeliveryType == $deliveryType->nIdx) selected @endif>{{$deliveryType->strDeliveryName}}</option>
                                            @endforeach --}}
                                            <option value="01" @if ($marketSetting->strPrdTypCd == '01') selected @endif>일반배송상품</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">해외구매대행상품<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-10 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoForAbrdBuyClfN" name="rdoForAbrdBuyClf" @if( $marketSetting->strForAbrdBuyClf == 'N' ) checked @endif value="N" >
                                            <label for="rdoForAbrdBuyClfN" class="custom-control-label pt-1" style="font-size:12px;">일반상품</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoForAbrdBuyClfY" name="rdoForAbrdBuyClf" @if( $marketSetting->strForAbrdBuyClf == 'Y' ) checked @endif value="Y">
                                            <label for="rdoForAbrdBuyClfY" class="custom-control-label pt-1" style="font-size:12px;">해외구매대행상품</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">상품상태<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-10 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoPrdStatCd_01" name="rdoPrdStatCd" @if( $marketSetting->strForAbrdBuyClf == '01' ) checked @endif value="01" >
                                            <label for="rdoPrdStatCd_01" class="custom-control-label pt-1" style="font-size:12px;">신상품</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoForAbrdBuyClf_03" name="rdoPrdStatCd" @if( $marketSetting->strForAbrdBuyClf == '03' ) checked @endif value="03">
                                            <label for="rdoForAbrdBuyClf_03" class="custom-control-label pt-1" style="font-size:12px;">재고상품</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoForAbrdBuyClf_10" name="rdoPrdStatCd" @if( $marketSetting->strForAbrdBuyClf == '10' ) checked @endif value="10">
                                            <label for="rdoForAbrdBuyClf_10" class="custom-control-label pt-1" style="font-size:12px;">주문제작상품</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">판매기간<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-10 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSelTermUseYn_N" name="rdoSelTermUseYn" @if( $marketSetting->strSelTermUseYn == 'N' ) checked @endif value="N" >
                                            <label for="rdoSelTermUseYn_N" class="custom-control-label pt-1" style="font-size:12px;">설정안함</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSelTermUseYn_Y" name="rdoSelTermUseYn" @if( $marketSetting->rdoSelTermUseYn == 'Y' ) checked @endif value="Y">
                                            <label for="rdoSelTermUseYn_Y" class="custom-control-label pt-1" style="font-size:12px;">설정함</label>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">최소구매수량</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSelMinLimitTypCd_00" name="rdoSelMinLimitTypCd" @if( $marketSetting->strForAbrdBuyClf == '00' ) checked @endif value="00" >
                                            <label for="rdoSelMinLimitTypCd_00" class="custom-control-label pt-1" style="font-size:12px;">제한없음</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSelMinLimitTypCd_01" name="rdoSelMinLimitTypCd" @if( $marketSetting->strForAbrdBuyClf == '01' ) checked @endif value="01">
                                            <label for="rdoSelMinLimitTypCd_01" class="custom-control-label pt-1" style="font-size:12px;">1회제한</label>
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" style="width:50px" class="form-control form-control-sm float-right text-right " name="txtSelMinLimitQty" id="txtSelMinLimitQty" value="{{ $marketSetting->nSelMinLimitQty }}">
                                        </div>
                                        <div style="display:inline-block; font-size:10px;">
                                            개
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">최대구매수량</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSelLimitTypCd_00" name="rdoSelLimitTypCd" @if( $marketSetting->strSelLimitTypCd == '00' ) checked @endif value="00" >
                                            <label for="rdoSelLimitTypCd_00" class="custom-control-label pt-1" style="font-size:12px;">제한없음</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSelLimitTypCd_01" name="rdoSelLimitTypCd" @if( $marketSetting->strSelLimitTypCd == '01' ) checked @endif value="01">
                                            <label for="rdoSelLimitTypCd_01" class="custom-control-label pt-1" style="font-size:12px;">1회제한</label>
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" style="width:50px" class="form-control form-control-sm float-right text-right" name="txtSelLimitQty" id="txtSelLimitQty" value="{{ $marketSetting->nSelLimitQty }}">
                                        </div>
                                        <div style="display:inline-block; font-size:10px;">
                                            개
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSelLimitTypCd_02" name="rdoSelLimitTypCd" @if( $marketSetting->strSelLimitTypCd == '03' ) checked @endif value="03">
                                            <label for="rdoSelLimitTypCd_02" class="custom-control-label pt-1" style="font-size:12px;">기간제한 한ID당</label>
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" style="width:50px" class="form-control form-control-sm float-right text-right" name="txtTownSelLmtDy" id="txtTownSelLmtDy" value="{{ $marketSetting->nTownSelLmtDy }}">
                                        </div>
                                        <div style="display:inline-block; font-size:10px;">
                                            일 동안 쵀대
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" style="width:50px" class="form-control form-control-sm float-right text-right" name="txtTownSelLmtQty" id="txtTownSelLmtQty" value="{{ $marketSetting->nTownSelLmtQty }}">
                                        </div>
                                        <div style="display:inline-block; font-size:10px;">
                                            개
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">미성년자 구매가능<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-6 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoOnlyAdult0" name="rdoOnlyAdult" @if( $marketSetting->bOnlyAdult == 0 ) checked @endif value="0">
                                            <label for="rdoOnlyAdult0" class="custom-control-label pt-1" style="font-size:12px;">가능</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoOnlyAdult1" name="rdoOnlyAdult" @if( $marketSetting->bOnlyAdult == 1 ) checked @endif value="1">
                                            <label for="rdoOnlyAdult1" class="custom-control-label pt-1" style="font-size:12px;">불가능</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">상품명초과시 처리방법</label>
                                    <div class="col-sm-9 col-md-10 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoOverThenPrdNmLen1" name="rdoOverThenPrdNmLen" value="0"  @if( $marketSetting->strOverThenPrdNmLen == "ERROR" ) checked @endif>
                                            <label for="rdoOverThenPrdNmLen1" class="custom-control-label pt-1" style="font-size:12px;">에러처리</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoOverThenPrdNmLen2" name="rdoOverThenPrdNmLen" value="1"  @if( $marketSetting->strOverThenPrdNmLen == "W100" ) checked @endif>
                                            <label for="rdoOverThenPrdNmLen2" class="custom-control-label pt-1" style="font-size:12px;">100byte로 자동등록</label>
                                            <span class="pt-1" style="margin-left:1rem; font-size:12px; color: red;">※ 한글50자 영/숫자 100자 초과시 100byte 까지만 자동 짤림 등록</span>
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
                                            <label for="rdoImageProcessType2" class="custom-control-label pt-1" style="font-size:12px;">600 x 600으로 자동등록</label>
                                            <span class="pt-1" style="margin-left:1rem; font-size:12px; color: red;">※ 이미지가 600보다 작을때 600으로 늘려서 등록됩니다. 이미지 깨짐에 유의해 주세요.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">구입처선택 <code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-2">
                                        <select class="custom-select form-control-border custom-select-sm" name="selAbrdBuyPlace" id="selAbrdBuyPlace">
                                            <option value="">= 선택 =</option>
                                            <option value="A" @if ($marketSetting->strAbrdBuyPlace == "A") selected @endif>A : 해당 브랜드 정식 도매</option>
                                            {{-- @foreach ($deliveryTypes as $deliveryType)
                                            <option value="{{$deliveryType->nIdx}}" @if ($marketSetting->nDeliveryType == $deliveryType->nIdx) selected @endif>{{$deliveryType->strDeliveryName}}</option>
                                            @endforeach --}}
                                            <option value="B"  @if ($marketSetting->strAbrdBuyPlace == "B") selected @endif>B : 해당 브랜드 직영 온/오프라인 매장(백화점포함)</option>
                                            <option value="C"  @if ($marketSetting->strAbrdBuyPlace == "C") selected @endif>C : 오프라인 아울렛</option>
                                            <option value="D"  @if ($marketSetting->strAbrdBuyPlace == "D") selected @endif>D : 현지 온라인 쇼핑몰</option>
                                            <option value="E"  @if ($marketSetting->strAbrdBuyPlace == "E") selected @endif>E : A~D에 해당되지 않는 구입처(경매 등)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">부가세/면세상품</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio" id="rdoSuplDtyfrPrdClfCd_01" name="rdoSuplDtyfrPrdClfCd" @if( $marketSetting->strSuplDtyfrPrdClfCd == '01' ) checked @endif value="01" >
                                        <label for="rdoSuplDtyfrPrdClfCd_01" class="custom-control-label pt-1" style="font-size:12px;">과세상품</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio" id="rdoSuplDtyfrPrdClfCd_02" name="rdoSuplDtyfrPrdClfCd" @if( $marketSetting->strSuplDtyfrPrdClfCd == '03' ) checked @endif value="02">
                                        <label for="rdoSuplDtyfrPrdClfCd_02" class="custom-control-label pt-1" style="font-size:12px;">면세상품</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio" id="rdoSuplDtyfrPrdClfCd_03" name="rdoSuplDtyfrPrdClfCd" @if( $marketSetting->strSuplDtyfrPrdClfCd == '10' ) checked @endif value="03">
                                        <label for="rdoSuplDtyfrPrdClfCd_03" class="custom-control-label pt-1" style="font-size:12px;">영세상품</label>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">인증정보</label>
                                    <style>
                                        table.tableForm th {
                                            width: 130px;
                                            letter-spacing: -1px;
                                            text-align: left;
                                            padding: 6px 0 6px 16px !important;
                                            font-size: 11px;
                                            font-weight: normal;
                                            border: 1px solid #dcdcdc;
                                            background: #f6f6f6;
                                        }
                                        table.tableDelList table td, table.tableForm table td, table.tableInList table td, table.tableList td {
                                            padding: 5px;
                                            height: 20px;
                                            text-align: center;
                                            border: 1px solid #d2d0d0;
                                        }
                                        table.tableForm td {
                                            padding: 5px;
                                            height: 20px;
                                            border: 1px solid #d2d0d0;
                                        }
                                        ul.liListType{
                                            margin-bottom: 0px;
                                        }
                                        ul.liListType li {
                                            display: inline-block;
                                            padding-right: 20px;
                                            font-size:12px;
                                        }
                                        .cntNum{
                                            width:50px;
                                        }
                                    </style>
                                    <table class="tableForm col-8">
                                        <tbody><tr>
                                            <th style="width:150px;">전기용품 / 생활용품 KC 인증</th>
                                            <td style="text-align:left;">
                                                <ul class="liListType">
                                                    <li><input type="radio" name="selCrtfGrpTypCd01" value="01"  @if( $marketSetting->strCrtfGrpTypCd01 == '01' ) checked @endif> KC인증대상</li>
                                                    <li><input type="radio" name="selCrtfGrpTypCd01" value="02"  @if( $marketSetting->strCrtfGrpTypCd01 == '02' ) checked @endif> KC면제대상</li>
                                                    <li><input type="radio" name="selCrtfGrpTypCd01" value="03"  @if( $marketSetting->strCrtfGrpTypCd01 == '03' ) checked @endif> KC인증대상 아님</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>어린이제품 KC인증</th>
                                            <td style="text-align:left;">
                                                <ul class="liListType">
                                                    <li><input type="radio" name="selCrtfGrpTypCd02" value="01" @if( $marketSetting->strCrtfGrpTypCd01 == '01' ) checked @endif> KC인증대상</li>
                                                    <li><input type="radio" name="selCrtfGrpTypCd02" value="03" @if( $marketSetting->strCrtfGrpTypCd01 == '03' ) checked @endif> KC인증대상 아님</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>방송통신기자재 KC인증</th>
                                            <td style="text-align:left;">
                                                <ul class="liListType">
                                                    <li><input type="radio" name="selCrtfGrpTypCd03" value="01" @if( $marketSetting->selCrtfGrpTypCd03 == '01' ) checked @endif> KC인증대상</li>
                                                    <li><input type="radio" name="selCrtfGrpTypCd03" value="03" @if( $marketSetting->selCrtfGrpTypCd03 == '03' ) checked @endif> KC인증대상 아님</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>위해우려제품</th>
                                            <td style="text-align:left;">
                                                <ul class="liListType">
                                                    <li><input type="radio" name="selCrtfGrpTypCd04" value="04" @if( $marketSetting->selCrtfGrpTypCd04 == '04' ) checked @endif> 위해우려제품 대상</li>
                                                    <li><input type="radio" name="selCrtfGrpTypCd04" value="05" @if( $marketSetting->selCrtfGrpTypCd04 == '05' ) checked @endif> 위해우려제품 대상 아님</li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody></table>
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
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">배송가능지역 <code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-2">
                                        <select class="custom-select form-control-border custom-select-sm" name="selDlvCnAreaCd" id="selDlvCnAreaCd">
                                            <option value="">= 선택 =</option>
                                            <option value="01">전국</option>
                                            <option value="02">*전국(제주 도서산간지역 제외)</option>
                                            <option value="03">서울</option>
                                            <option value="04">인천</option>
                                            <option value="05">광주</option>
                                            <option value="06">대구</option>
                                            <option value="07">대전</option>
                                            <option value="08">부산</option>
                                            <option value="09">울산</option>
                                            <option value="10">경기</option>
                                            <option value="11">강원</option>
                                            <option value="12">충남</option>
                                            <option value="13">충북</option>
                                            <option value="14">경남</option>
                                            <option value="15">경북</option>
                                            <option value="16">전남</option>
                                            <option value="17">전북</option>
                                            <option value="18">제주</option>
                                            <option value="19">서울/경기</option>
                                            <option value="20">서울/경기/대전</option>
                                            <option value="21">충북/충남</option>
                                            <option value="22">경북/경남</option>
                                            <option value="23">전북/전남</option>
                                            <option value="24">부산/울산</option>
                                            <option value="25">서울/경기/제주도서산간 제외지역</option>
                                            <option value="26">일부지역불가</option>
                                            {{-- @foreach ($deliveryTypes as $deliveryType)
                                            <option value="{{$deliveryType->nIdx}}" @if ($marketSetting->nDeliveryType == $deliveryType->nIdx) selected @endif>{{$deliveryType->strDeliveryName}}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">배송방법 <code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-2">
                                        <select class="custom-select form-control-border custom-select-sm" name="selDlvWyCd" id="selDlvWyCd">
                                            <option value="">= 선택 =</option>
                                            <option value="01">택배</option>
                                            <option value="02">우편(소포/등기)</option>
                                            <option value="03">직접전달(화물배달)</option>
                                            <option value="04">퀵서비스</option>
                                            <option value="05">배송필요없음</option>
                                            {{-- @foreach ($deliveryTypes as $deliveryType)
                                            <option value="{{$deliveryType->nIdx}}" @if ($marketSetting->nDeliveryType == $deliveryType->nIdx) selected @endif>{{$deliveryType->strDeliveryName}}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">발송택배사 <code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-2">
                                        <select class="custom-select form-control-border custom-select-sm" name="selDlvEtprsCd" id="selDlvEtprsCd">
                                            <option value="">= 선택 =</option>
                                            <option value="00034">CJ대한통운</option>
                                            {{-- @foreach ($deliveryTypes as $deliveryType)
                                            <option value="{{$deliveryType->nIdx}}" @if ($marketSetting->nDeliveryType == $deliveryType->nIdx) selected @endif>{{$deliveryType->strDeliveryName}}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">발송방법<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-6 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSendClfCdDmy1" name="rdoSendClfCdDmy" @if ($marketSetting->nRemoteAreaDeliveryType == 1) checked @endif value="1">
                                            <label for="rdoSendClfCdDmy1" class="custom-control-label pt-1" style="font-size:12px;">오늘발송</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSendClfCdDmy2" name="rdoSendClfCdDmy" @if ($marketSetting->nRemoteAreaDeliveryType == 0) checked @endif value="0">
                                            <label for="rdoSendClfCdDmy2" class="custom-control-label pt-1" style="font-size:12px;">일반발송</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSendClfCdDmy3" name="rdoSendClfCdDmy" @if ($marketSetting->nRemoteAreaDeliveryType == 0) checked @endif value="0">
                                            <label for="rdoSendClfCdDmy3" class="custom-control-label pt-1" style="font-size:12px;">재고확인후 순차발송</label>
                                        </div>
                                        </br>
                                        <div style="display:inline-block">
                                            <span class="pt-1" style="font-size:12px;">발송마감 기준</span>
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" class="form-control form-control-sm text-right" id="txtOutboundShippingPlaceCode" name="txtOutboundShippingPlaceCode" value="{{ $marketSetting->strOutboundShippingPlaceCode }}" placeholder="" >
                                        </div>
                                        <div style="display:inline-block">
                                            <a href="javascript:void(0);" style="height:26px;" class="btn btn-primary btn-xs mt-0 btnSearchOutboundShippingPlace">
                                                <span style="font-size:10px;">검 색</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">출고지<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-6">
                                        <div style="display:inline-block">
                                            <input type="text" class="form-control form-control-sm text-right" id="txtOutboundShippingPlaceCode" name="txtOutboundShippingPlaceCode" value="{{ $marketSetting->strOutboundShippingPlaceCode }}" placeholder="">
                                        </div>
                                        <div style="display:inline-block">
                                            <a href="javascript:void(0);" style="height:26px;" class="btn btn-primary btn-xs mt-0 btnSearchOutboundShippingPlace">
                                                <span style="font-size:10px;">검 색</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">반품지<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-6">
                                        <div style="display:inline-block">
                                            <input type="text" class="form-control form-control-sm text-right" id="txtReturnCenterCode" name="txtReturnCenterCode" value="{{ $marketSetting->strReturnCenterCode }}" placeholder="">
                                        </div>
                                        <div style="display:inline-block">
                                            <a href="javascript:void(0);" style="height:26px;" class="btn btn-primary btn-xs mt-0 btnSearchReturnShippingCenter">
                                                <span style="font-size:10px;">검 색</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">배송비 설정<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-9">
                                        <table class="tableForm" style="font-size:12px;">
                                            <colgroup>
                                                <col>
                                                <col>
                                                <col>
                                                <col>
                                                <col>
                                                <col>
                                            </colgroup>
                                            <tbody><tr>
                                                <th style="width:60px;padding:5px 0 !important;text-align:center;">부담</th>
                                                <th style="width:170px;padding:5px 0 !important;text-align:center;">배송비종류</th>
                                                <th style="padding:5px 0 !important;text-align:center;">배송비</th>
                                                <th style="width:230px;padding:5px 0 !important;text-align:center;">기준(구매금액:판매가+옵션가+추가구성상품금액)</th>
                                                <th style="width:50px;padding:5px 0 !important;text-align:center;">묶음배송</th>
                                                <th style="width:50px;padding:5px 0 !important;text-align:center;">결제방법</th>
                                            </tr>
                                            <tr>
                                                <td>판매자</td>
                                                <td style="text-align:left;"><input type="radio" name="mpbseDlvCstInstBasiCd" value="01"> 무료</td>
                                                <td>0원</td>
                                                <td>수량/주문금액에 상관없이 무조건 무료</td>
                                                <td>
                                                    <select name="mpbseBndlDlvCnYn01">
                                                        <option value="Y">가능</option>
                                                        <option value="N">불가</option>
                                                    </select>
                                                </td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td rowspan="7">구매자</td>
                                                <td style="text-align:left;"><input type="radio" name="mpbseDlvCstInstBasiCd" value="07"> 판매자 조건부 배송비</td>
                                                <td colspan="2">판매자 조건부 배송비 설정된 금액</td>
                                                <td>가능</td>
                                                <td rowspan="6">
                                                    <select name="mpbseDlvCstPayTypCd">
                                                        <option value="01">선불+착불</option>
                                                        <option value="03">선불</option>
                                                        <option value="02">착불</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left;"><input type="radio" name="mpbseDlvCstInstBasiCd" value="08"> 출고지 조건부 배송비</td>
                                                <td colspan="2">출고지 조건부 배송비 설정된 금액</td>
                                                <td>가능</td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left;"><input type="radio" name="mpbseDlvCstInstBasiCd" value="03"> 상품 조건부 무료</td>
                                                <td><input type="text" style="width:50px;" name="mpbseDlvCst1_03" class="cntNum" value="">원 </td>
                                                <td>이 상품<input type="text" name="mpbsePrdFrDlvBasiAmt" value="" class="cntNum">원 이상 구매시 무료</td>
                                                <td>불가</td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left;"><input type="radio" name="mpbseDlvCstInstBasiCd" value="04"> 수량별 차등</td>
                                                <td style="vertical-align:top;">
                                                    <dl>
                                                        <dd><input type="text" name="mpbseDlvCst3[0]" value="" class="cntNum">원 </dd>
                                                        <dd><input type="text" name="mpbseDlvCst3[1]" value="" class="cntNum">원 </dd>
                                                        <dd><input type="text" name="mpbseDlvCst3[2]" value="" class="cntNum">원 </dd>
                                                        <dd><input type="text" name="mpbseDlvCst3[3]" value="" class="cntNum">원 </dd>
                                                        <dd><input type="text" name="mpbseDlvCst3[4]" value="" class="cntNum">원 </dd>
                                                    </dl>
                                                </td>
                                                <td style="vertical-align:top;">
                                                    <dl>
                                                        <dd><input type="hidden" name="mpbseDlvCnt1[0]" value="1" class="cntNum"><span class="cntNumTxt">1개</span> ~ <input type="text" name="mpbseDlvCnt2[0]" value="" class="cntNum">개</dd>
                                                        <dd><input type="text" name="mpbseDlvCnt1[1]" value="" class="cntNum">개 ~ <input type="text" name="mpbseDlvCnt2[1]" value="" class="cntNum">개</dd>
                                                        <dd><input type="text" name="mpbseDlvCnt1[2]" value="" class="cntNum">개 ~ <input type="text" name="mpbseDlvCnt2[2]" value="" class="cntNum">개</dd>
                                                        <dd><input type="text" name="mpbseDlvCnt1[3]" value="" class="cntNum">개 ~ <input type="text" name="mpbseDlvCnt2[3]" value="" class="cntNum">개</dd>
                                                        <dd><input type="text" name="mpbseDlvCnt1[4]" value="" class="cntNum">개 ~ <input type="text" name="mpbseDlvCnt2[4]" value="" class="cntNum">개</dd>
                                                    </dl>
                                                    <span class="txtRed">~개 이상일때는 빈칸으로 두시면 자동입력 됩니다.</span>
                                                </td>
                                                <td>
                                                    <select name="mpbseBndlDlvCnYn04">
                                                        <option value="Y">가능</option>
                                                        <option value="N">불가</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left;"><input type="radio" name="mpbseDlvCstInstBasiCd" value="05"> 1개당 배송비</td>
                                                <td><input type="text" name="mpbseDlvCst4" value="" class="cntNum">원</td>
                                                <td>수량 1개마다 배송비 추가</td>
                                                <td>불가</td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left;" rowspan="2"><input type="radio" name="mpbseDlvCstInstBasiCd" value="02"> 고정 배송비</td>
                                                <td><input type="text" name="mpbseDlvCst1_02" value="" class="cntNum">원</td>
                                                <td style="text-align:left;">수량/주문금액과 상관없이 고정 배송비</td>
                                                <td>
                                                    <select name="mpbseBndlDlvCnYn02">
                                                        <option value="Y">가능</option>
                                                        <option value="N">불가</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    배송비 추가 안내
                                                    <select name="mpbseDlvCstInfoCd">
                                                        <option value="">해당없음</option>
                                                        <option value="01">(상품상세참고)</option>
                                                        <option value="02">(상품별 차등 적용)</option>
                                                        <option value="03">(지역별 차등 적용)</option>
                                                        <option value="04">(상품/지역별 차등)</option>
                                                        <option value="06">(서울/경기 무료, 이외 추가비용)</option>
                                                    </select>
                                                    (선결제 불가만 설정 가능)
                                                </td>
                                            </tr>
                                            <tr class="etcLine">
                                                <td colspan="2"><input type="checkbox" name="mpbseUseIslandJejuDlvCst" value="Y">제주/도서산간 추가배송비 설정</td>
                                                <td colspan="5" style="text-align:left;">
                                                    제주 <input type="text" name="mpbseJejuDlvCst" value="" class="cntNum">원 &nbsp; / &nbsp;
                                                    도서산간 <input type="text" name="mpbseIslandDlvCst" value="" class="cntNum">원
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">반품/교환 배송비<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-9 mt-1">
                                        <div style="display:inline-block">
                                            <span class="pt-1" style="font-size:12px;">반품 배송비 편도</span>
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" class="form-control form-control-sm text-right" id="txtOutboundShippingPlaceCode" name="txtOutboundShippingPlaceCode" value="{{ $marketSetting->strOutboundShippingPlaceCode }}" placeholder="" >
                                        </div>
                                        <div style="display:inline-block; font-size:12px;">
                                            원 &nbsp;&nbsp;&nbsp;&nbsp;[초기배송비 무료시 부가방법
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSendClfCdDmy2" name="rdoSendClfCdDmy" @if ($marketSetting->nRemoteAreaDeliveryType == 0) checked @endif value="0">
                                            <label for="rdoSendClfCdDmy2" class="custom-control-label pt-1" style="font-size:12px;">왕복(편도x2) </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline mr-0">
                                            <input class="custom-control-input" type="radio" id="rdoSendClfCdDmy3" name="rdoSendClfCdDmy" @if ($marketSetting->nRemoteAreaDeliveryType == 0) checked @endif value="0">
                                            <label for="rdoSendClfCdDmy3" class="custom-control-label pt-1" style="font-size:12px;">편도</label>
                                        </div>
                                        <div style="display:inline-block; font-size:12px;">
                                            ]
                                        </div>
                                        </br>
                                        <div style="display:inline-block">
                                            <span class="pt-1" style="font-size:12px;">교환 배송비 왕복</span>
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" class="form-control form-control-sm text-right" id="txtOutboundShippingPlaceCode" name="txtOutboundShippingPlaceCode" value="{{ $marketSetting->strOutboundShippingPlaceCode }}" placeholder="" >
                                        </div>
                                        <div style="display:inline-block; font-size:12px;">
                                            원
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">A/S안내<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-6 mt-1">
                                        <div>
                                            <textarea class="form-control text-xs" rows="3" placeholder="" name="txtAsDetail" id="txtAsDetail">{{$marketSetting->strAsDetail}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">반품/교환 안내<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-6 mt-1">
                                        <div>
                                            <textarea class="form-control text-xs" rows="3" placeholder="" name="txtRtngExchDetail" id="txtRtngExchDetail">{{$marketSetting->strAfterServiceGuide}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-warning" style="margin-bottom:0px;">
                            <div class="card-header">
                              <h3 class="card-title text-sm">유료 및 기타정보 설정</h3>
                              <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-minus"></i>
                                </button>
                              </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">상품홍보문구</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div style="display:inline-block">
                                            <input type="text" style="width:250px;" class="form-control form-control-sm text-right" name="txtSelMinLimitQty" id="txtSelMinLimitQty" value="{{ $marketSetting->nSelMinLimitQty }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">가격비교 사이트 등록</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSelMinLimitTypCd_00" name="rdoSelMinLimitTypCd" @if( $marketSetting->strForAbrdBuyClf == '00' ) checked @endif value="00" >
                                            <label for="rdoSelMinLimitTypCd_00" class="custom-control-label pt-1" style="font-size:12px;">등록함</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSelMinLimitTypCd_01" name="rdoSelMinLimitTypCd" @if( $marketSetting->strForAbrdBuyClf == '01' ) checked @endif value="01">
                                            <label for="rdoSelMinLimitTypCd_01" class="custom-control-label pt-1" style="font-size:12px;">등록안함</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">상품리뷰/구매후기</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSelMinLimitTypCd_00" name="rdoSelMinLimitTypCd" @if( $marketSetting->strForAbrdBuyClf == '00' ) checked @endif value="00" >
                                            <label for="rdoSelMinLimitTypCd_00" class="custom-control-label pt-1" style="font-size:12px;">노출함</label>
                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox3" >
                                            <label for="customCheckbox3" style="font-size:12px;" class="custom-control-label pt-1">옵션비노출</label>
                                          </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSelMinLimitTypCd_01" name="rdoSelMinLimitTypCd" @if( $marketSetting->strForAbrdBuyClf == '01' ) checked @endif value="01">
                                            <label for="rdoSelMinLimitTypCd_01" class="custom-control-label pt-1" style="font-size:12px;">노출안함</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">기본즉시할인</label>
                                    <div class="col-sm-9 col-md-10 bg-light">
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox3" >
                                            <label for="customCheckbox3" class="custom-control-label">설정함</label>
                                        </div>
                                        <br>
                                        <div style="display:inline-block">
                                            <span class="pt-1" style="font-size:12px;">판매가에서</span>
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" style="width:50px;" class="form-control form-control-sm text-right" id="txtOutboundShippingPlaceCode" name="txtOutboundShippingPlaceCode" value="{{ $marketSetting->strOutboundShippingPlaceCode }}" placeholder="" >
                                        </div>
                                        <div style="display:inline-block">
                                            <select class="mb-1 custom-select form-control-border custom-select-sm" name="selDlvEtprsCd" id="selDlvEtprsCd">
                                                <option value="02">%</option>
                                                <option value="01">원</option>
                                                
                                            </select>
                                        </div>
                                        <div style="display:inline-block">
                                            <span class="pt-1" style="font-size:12px;">할인</span>
                                        </div>
                                        <br>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox3" >
                                            <label for="customCheckbox3" class="custom-control-label pt-1" style="font-size:12px;">쿠폰 지급기간 설정</label>
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" style="width:100px;" class="form-control form-control-sm text-right" id="txtOutboundShippingPlaceCode" name="txtOutboundShippingPlaceCode" value="{{ $marketSetting->strOutboundShippingPlaceCode }}" placeholder="" >
                                        </div>
                                        ~
                                        <div style="display:inline-block">
                                            <input type="text" style="width:100px;" class="form-control form-control-sm text-right" id="txtOutboundShippingPlaceCode" name="txtOutboundShippingPlaceCode" value="{{ $marketSetting->strOutboundShippingPlaceCode }}" placeholder="" >
                                        </div>
                                        <br>
                                        <div style="display:inline-block">
                                            <span class="pt-1" style="font-size:12px;">적용금액이 </span>
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" style="width:50px;" class="form-control form-control-sm text-right" id="txtOutboundShippingPlaceCode" name="txtOutboundShippingPlaceCode" value="{{ $marketSetting->strOutboundShippingPlaceCode }}" placeholder="" >
                                        </div>
                                        <div style="display:inline-block">
                                            <span class="pt-1" style="font-size:12px;">원 보다 작을경우 이 금액으로 전송 </span>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">SK pay point 지급</label>
                                    <div class="col-sm-9 col-md-10 bg-light mt-1">
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox3" >
                                            <label for="customCheckbox3" class="custom-control-label pt-1" style="font-size:12px;">설정함</label>
                                        </div>
                                        <br>
                                        <div style="display:inline-block">
                                            <span class="pt-1" style="font-size:12px;">판매가에서</span>
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" style="width:50px;" class="form-control form-control-sm text-right" id="txtOutboundShippingPlaceCode" name="txtOutboundShippingPlaceCode" value="{{ $marketSetting->strOutboundShippingPlaceCode }}" placeholder="" >
                                        </div>
                                        <div style="display:inline-block">
                                            <select class="mb-1 custom-select form-control-border custom-select-sm" name="selDlvEtprsCd" id="selDlvEtprsCd">
                                                <option value="02">%</option>
                                                <option value="01">원</option>
                                            </select>
                                        </div>
                                        <div style="display:inline-block">
                                            <span class="pt-1" style="font-size:12px;">할인</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">무이자 할부 제공</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox3" >
                                            <label for="customCheckbox3" style="font-size:12px;" class="custom-control-label pt-1">설정함</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">복수구매할인</label>
                                    <div class="col-sm-9 col-md-10 bg-light">
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox3">
                                            <label for="customCheckbox3" style="font-size:12px;" class="custom-control-label pt-1">설정함</label>
                                        </div>
                                        <br>
                                        <div style="display:inline-block">
                                            <select class="mb-1 custom-select form-control-border custom-select-sm" name="selDlvEtprsCd" id="selDlvEtprsCd">
                                                <option value="01">수량기준</option>
                                                <option value="02">금액기준</option>
                                            </select>
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" style="width:50px;" class="form-control form-control-sm text-right" id="txtOutboundShippingPlaceCode" name="txtOutboundShippingPlaceCode" value="{{ $marketSetting->strOutboundShippingPlaceCode }}" placeholder="" >
                                        </div>
                                        <div style="display:inline-block">
                                            <span class="pt-1" style="font-size:12px;">개 이상 구매시 판매가(+옵션가)에서 개당</span>
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" style="width:50px;" class="form-control form-control-sm text-right" id="txtOutboundShippingPlaceCode" name="txtOutboundShippingPlaceCode" value="{{ $marketSetting->strOutboundShippingPlaceCode }}" placeholder="" >
                                        </div>
                                        <div style="display:inline-block">
                                            <select class="mb-1 custom-select form-control-border custom-select-sm" name="selDlvEtprsCd" id="selDlvEtprsCd">
                                                <option value="02">%</option>
                                                <option value="01">원</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox3">
                                            <label for="customCheckbox3" class="custom-control-label pt-1" style="font-size:12px;">할인 적용기간 설정</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">희망후원 설정</label>
                                    <div class="col-sm-9 col-md-10 bg-light mt-1">
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox3" >
                                            <label for="customCheckbox3" style="font-size:12px;" class="custom-control-label pt-1">설정함</label>
                                        </div>
                                        <br>
                                        <div style="display:inline-block">
                                            <span class="pt-1" style="font-size:12px;">판매가에서</span>
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" style="width:50px;" class="form-control form-control-sm text-right" id="txtOutboundShippingPlaceCode" name="txtOutboundShippingPlaceCode" value="{{ $marketSetting->strOutboundShippingPlaceCode }}" placeholder="" >
                                        </div>
                                        <div style="display:inline-block">
                                            <select class="mb-1 custom-select form-control-border custom-select-sm" name="selDlvEtprsCd" id="selDlvEtprsCd">
                                                <option value="02">%</option>
                                                <option value="01">원</option>
                                            </select>
                                        </div>
                                        <div style="display:inline-block">
                                            <span class="pt-1" style="font-size:12px;">기부 * 정율을 선택한 경우 판매가-기본즉시할인 기준으로 설정됨.</span>
                                        </div>
                                        <br>
                                        <div style="display:inline-block">
                                            <span class="pt-1" style="font-size:12px;">적용금액이</span>
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" style="width:50px;" class="form-control form-control-sm text-right" id="txtOutboundShippingPlaceCode" name="txtOutboundShippingPlaceCode" value="{{ $marketSetting->strOutboundShippingPlaceCode }}" placeholder="" >
                                        </div>
                                        <div style="display:inline-block">
                                            <span class="pt-1" style="font-size:12px;">원 보다 작을경우 이 금액으로 전송</span>
                                        </div>
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

