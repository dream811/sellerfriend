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
                                            <input type="text" class="form-control form-control-sm" id="txtSelMnbdNckNm" name="txtSelMnbdNckNm" value="{{ $marketSetting->detail->strSelMnbdNckNm }}" placeholder="닉네임을 입력하세요.">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">판매방식<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-10 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSelMthdCd1" name="rdoSelMthdCd" @if( $marketSetting->detail->strSelMthdCd == '01' ) checked @endif value="01" >
                                            <label for="rdoSelMthdCd1" class="custom-control-label pt-1" style="font-size:12px;">고정가판매</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSelMthdCd4" name="rdoSelMthdCd" @if( $marketSetting->detail->strSelMthdCd == '04' ) checked @endif value="04">
                                            <label for="rdoSelMthdCd4" class="custom-control-label pt-1" style="font-size:12px;">예약판매</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSelMthdCd5" name="rdoSelMthdCd" @if( $marketSetting->detail->strSelMthdCd == '05' ) checked @endif value="05">
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
                                            <option value="{{$deliveryType->nIdx}}" @if ($marketSetting->detail->nDeliveryType == $deliveryType->nIdx) selected @endif>{{$deliveryType->strDeliveryName}}</option>
                                            @endforeach --}}
                                            <option value="01" @if ($marketSetting->detail->strPrdTypCd == '01') selected @endif>일반배송상품</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">해외구매대행상품<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-10 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoForAbrdBuyClfN" name="rdoForAbrdBuyClf" @if( $marketSetting->detail->strForAbrdBuyClf == '01' ) checked @endif value="01" >
                                            <label for="rdoForAbrdBuyClfN" class="custom-control-label pt-1" style="font-size:12px;">일반상품</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoForAbrdBuyClfY" name="rdoForAbrdBuyClf" @if( $marketSetting->detail->strForAbrdBuyClf == '02' ) checked @endif value="02">
                                            <label for="rdoForAbrdBuyClfY" class="custom-control-label pt-1" style="font-size:12px;">해외구매대행상품</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">상품상태<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-10 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoPrdStatCd_01" name="rdoPrdStatCd" @if( $marketSetting->detail->strPrdStatCd == '01' ) checked @endif value="01" >
                                            <label for="rdoPrdStatCd_01" class="custom-control-label pt-1" style="font-size:12px;">신상품</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoForAbrdBuyClf_03" name="rdoPrdStatCd" @if( $marketSetting->detail->strPrdStatCd == '03' ) checked @endif value="03">
                                            <label for="rdoForAbrdBuyClf_03" class="custom-control-label pt-1" style="font-size:12px;">재고상품</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoForAbrdBuyClf_10" name="rdoPrdStatCd" @if( $marketSetting->detail->strPrdStatCd == '10' ) checked @endif value="10">
                                            <label for="rdoForAbrdBuyClf_10" class="custom-control-label pt-1" style="font-size:12px;">주문제작상품</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">판매기간<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-10 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSelTermUseYn_N" name="rdoSelTermUseYn" @if( $marketSetting->detail->strSelTermUseYn == 'N' ) checked @endif value="N" >
                                            <label for="rdoSelTermUseYn_N" class="custom-control-label pt-1" style="font-size:12px;">설정안함</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSelTermUseYn_Y" name="rdoSelTermUseYn" @if( $marketSetting->detail->strSelTermUseYn == 'Y' ) checked @endif value="Y">
                                            <label for="rdoSelTermUseYn_Y" class="custom-control-label pt-1" style="font-size:12px;">설정함</label>
                                        </div>
                                        
                                        <div style="display:inline-block">
                                            <select class="mb-1 custom-select form-control-border custom-select-sm" name="selSelPrdClfCd" id="selSelPrdClfCd">
                                                <option value="">= 선택 =</option>
                                                <option value="3:101" @if ($marketSetting->detail->strSelPrdClfCd == '3:101') selected @endif>3일</option>
                                                <option value="5:102" @if ($marketSetting->detail->strSelPrdClfCd == '5:102') selected @endif>5일</option>
                                                <option value="7:103" @if ($marketSetting->detail->strSelPrdClfCd == '7:103') selected @endif>7일</option>
                                                <option value="15:104" @if ($marketSetting->detail->strSelPrdClfCd == '15:104') selected @endif>15일</option>
                                                <option value="30:105" @if ($marketSetting->detail->strSelPrdClfCd == '30:105') selected @endif>30일(1개월)</option>
                                                <option value="60:106" @if ($marketSetting->detail->strSelPrdClfCd == '60:106') selected @endif>60일(2개월)</option>
                                                <option value="90:107" @if ($marketSetting->detail->strSelPrdClfCd == '90:107') selected @endif>90일(3개월)</option>
                                                <option value="120:108" @if ($marketSetting->detail->strSelPrdClfCd == '120:108') selected @endif>120일(4개월)</option>
                                                <option value="0:400" @if ($marketSetting->detail->strSelPrdClfCd == '0:400') selected @endif>직접입력</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div style="display:inline-block">
                                            <input type="text" style="width:80px" class="form-control form-control-sm float-right text-right" name="txtAplBgnDy" id="txtAplBgnDy" value="{{ $marketSetting->detail->dtAplBgnDy }}">
                                        </div>
                                        ~
                                        <div style="display:inline-block">
                                            <input type="text" style="width:80px" class="form-control form-control-sm float-right text-right" name="txtAplEndDy" id="txtAplEndDy" value="{{ $marketSetting->detail->dtAplEndDy }}">
                                        </div>
                                        <span class="pb-2" style="margin-left:1rem; font-size:12px; color: red;">※ 2019-04-20 과 같은 형식으로 입력해 주세요.</span>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">최소구매수량</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSelMinLimitTypCd_00" name="rdoSelMinLimitTypCd" @if( $marketSetting->detail->strSelMinLimitTypCd == '00' ) checked @endif value="00" >
                                            <label for="rdoSelMinLimitTypCd_00" class="custom-control-label pt-1" style="font-size:12px;">제한없음</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSelMinLimitTypCd_01" name="rdoSelMinLimitTypCd" @if( $marketSetting->detail->strSelMinLimitTypCd == '01' ) checked @endif value="01">
                                            <label for="rdoSelMinLimitTypCd_01" class="custom-control-label pt-1" style="font-size:12px;">1회제한</label>
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" style="width:50px" class="form-control form-control-sm float-right text-right" name="txtSelMinLimitQty" id="txtSelMinLimitQty" value="{{ $marketSetting->detail->nSelMinLimitQty }}">
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
                                            <input class="custom-control-input" type="radio" id="rdoSelLimitTypCd_00" name="rdoSelLimitTypCd" @if( $marketSetting->detail->strSelLimitTypCd == '00' ) checked @endif value="00" >
                                            <label for="rdoSelLimitTypCd_00" class="custom-control-label pt-1" style="font-size:12px;">제한없음</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSelLimitTypCd_01" name="rdoSelLimitTypCd" @if( $marketSetting->detail->strSelLimitTypCd == '01' ) checked @endif value="01">
                                            <label for="rdoSelLimitTypCd_01" class="custom-control-label pt-1" style="font-size:12px;">1회제한</label>
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" style="width:50px" class="form-control form-control-sm float-right text-right" name="txtSelLimitQty" id="txtSelLimitQty" value="{{ $marketSetting->detail->nSelLimitQty }}">
                                        </div>
                                        <div style="display:inline-block; font-size:10px;">
                                            개
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSelLimitTypCd_02" name="rdoSelLimitTypCd" @if( $marketSetting->detail->strSelLimitTypCd == '02' ) checked @endif value="02">
                                            <label for="rdoSelLimitTypCd_02" class="custom-control-label pt-1" style="font-size:12px;">기간제한 한ID당</label>
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" style="width:50px" class="form-control form-control-sm float-right text-right" name="txtTownSelLmtDy" id="txtTownSelLmtDy" value="{{ $marketSetting->detail->nTownSelLmtDy }}">
                                        </div>
                                        <div style="display:inline-block; font-size:10px;">
                                            일 동안 쵀대
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" style="width:50px" class="form-control form-control-sm float-right text-right" name="txtTownSelLmtQty" id="txtTownSelLmtQty" value="{{ $marketSetting->detail->nTownSelLmtQty }}">
                                        </div>
                                        <div style="display:inline-block; font-size:10px;">
                                            개
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">상품명초과시 처리방법</label>
                                    <div class="col-sm-9 col-md-10 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoOverThenPrdNmLen1" name="rdoOverThenPrdNmLen" value="ERROR"  @if( $marketSetting->detail->strOverThenPrdNmLen == "ERROR" ) checked @endif>
                                            <label for="rdoOverThenPrdNmLen1" class="custom-control-label pt-1" style="font-size:12px;">에러처리</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoOverThenPrdNmLen2" name="rdoOverThenPrdNmLen" value="W100"  @if( $marketSetting->detail->strOverThenPrdNmLen == "W100" ) checked @endif>
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
                                            <option value="A" @if ($marketSetting->detail->strAbrdBuyPlace == "A") selected @endif>A : 해당 브랜드 정식 도매</option>
                                            <option value="B" @if ($marketSetting->detail->strAbrdBuyPlace == "B") selected @endif>B : 해당 브랜드 직영 온/오프라인 매장(백화점포함)</option>
                                            <option value="C" @if ($marketSetting->detail->strAbrdBuyPlace == "C") selected @endif>C : 오프라인 아울렛</option>
                                            <option value="D" @if ($marketSetting->detail->strAbrdBuyPlace == "D") selected @endif>D : 현지 온라인 쇼핑몰</option>
                                            <option value="E" @if ($marketSetting->detail->strAbrdBuyPlace == "E") selected @endif>E : A~D에 해당되지 않는 구입처(경매 등)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">부가세/면세상품</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio" id="rdoSuplDtyfrPrdClfCd_01" name="rdoSuplDtyfrPrdClfCd" @if( $marketSetting->detail->strSuplDtyfrPrdClfCd == '01' ) checked @endif value="01" >
                                        <label for="rdoSuplDtyfrPrdClfCd_01" class="custom-control-label pt-1" style="font-size:12px;">과세상품</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio" id="rdoSuplDtyfrPrdClfCd_02" name="rdoSuplDtyfrPrdClfCd" @if( $marketSetting->detail->strSuplDtyfrPrdClfCd == '03' ) checked @endif value="02">
                                        <label for="rdoSuplDtyfrPrdClfCd_02" class="custom-control-label pt-1" style="font-size:12px;">면세상품</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio" id="rdoSuplDtyfrPrdClfCd_03" name="rdoSuplDtyfrPrdClfCd" @if( $marketSetting->detail->strSuplDtyfrPrdClfCd == '10' ) checked @endif value="03">
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
                                                    <li><input type="radio" name="rdoCrtfGrpTypCd01" value="01"  @if( $marketSetting->detail->strCrtfGrpTypCd01 == '01' ) checked @endif> KC인증대상</li>
                                                    <li><input type="radio" name="rdoCrtfGrpTypCd01" value="02"  @if( $marketSetting->detail->strCrtfGrpTypCd01 == '02' ) checked @endif> KC면제대상</li>
                                                    <li><input type="radio" name="rdoCrtfGrpTypCd01" value="03"  @if( $marketSetting->detail->strCrtfGrpTypCd01 == '03' ) checked @endif> KC인증대상 아님</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>어린이제품 KC인증</th>
                                            <td style="text-align:left;">
                                                <ul class="liListType">
                                                    <li><input type="radio" name="rdoCrtfGrpTypCd02" value="01" @if( $marketSetting->detail->strCrtfGrpTypCd02 == '01' ) checked @endif> KC인증대상</li>
                                                    <li><input type="radio" name="rdoCrtfGrpTypCd02" value="03" @if( $marketSetting->detail->strCrtfGrpTypCd02 == '03' ) checked @endif> KC인증대상 아님</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>방송통신기자재 KC인증</th>
                                            <td style="text-align:left;">
                                                <ul class="liListType">
                                                    <li><input type="radio" name="rdoCrtfGrpTypCd03" value="01" @if( $marketSetting->detail->strCrtfGrpTypCd03 == '01' ) checked @endif> KC인증대상</li>
                                                    <li><input type="radio" name="rdoCrtfGrpTypCd03" value="03" @if( $marketSetting->detail->strCrtfGrpTypCd03 == '03' ) checked @endif> KC인증대상 아님</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>위해우려제품</th>
                                            <td style="text-align:left;">
                                                <ul class="liListType">
                                                    <li><input type="radio" name="rdoCrtfGrpTypCd04" value="04" @if( $marketSetting->detail->strCrtfGrpTypCd04 == '04' ) checked @endif> 위해우려제품 대상</li>
                                                    <li><input type="radio" name="rdoCrtfGrpTypCd04" value="05" @if( $marketSetting->detail->strCrtfGrpTypCd04 == '05' ) checked @endif> 위해우려제품 대상 아님</li>
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
                                            <option value="01" @if ($marketSetting->detail->strDlvCnAreaCd == "01") selected @endif>전국</option>
                                            <option value="02" @if ($marketSetting->detail->strDlvCnAreaCd == "02") selected @endif>*전국(제주 도서산간지역 제외)</option>
                                            <option value="03" @if ($marketSetting->detail->strDlvCnAreaCd == "03") selected @endif>서울</option>
                                            <option value="04" @if ($marketSetting->detail->strDlvCnAreaCd == "04") selected @endif>인천</option>
                                            <option value="05" @if ($marketSetting->detail->strDlvCnAreaCd == "05") selected @endif>광주</option>
                                            <option value="06" @if ($marketSetting->detail->strDlvCnAreaCd == "06") selected @endif>대구</option>
                                            <option value="07" @if ($marketSetting->detail->strDlvCnAreaCd == "07") selected @endif>대전</option>
                                            <option value="08" @if ($marketSetting->detail->strDlvCnAreaCd == "08") selected @endif>부산</option>
                                            <option value="09" @if ($marketSetting->detail->strDlvCnAreaCd == "09") selected @endif>울산</option>
                                            <option value="10" @if ($marketSetting->detail->strDlvCnAreaCd == "10") selected @endif>경기</option>
                                            <option value="11" @if ($marketSetting->detail->strDlvCnAreaCd == "11") selected @endif>강원</option>
                                            <option value="12" @if ($marketSetting->detail->strDlvCnAreaCd == "12") selected @endif>충남</option>
                                            <option value="13" @if ($marketSetting->detail->strDlvCnAreaCd == "13") selected @endif>충북</option>
                                            <option value="14" @if ($marketSetting->detail->strDlvCnAreaCd == "14") selected @endif>경남</option>
                                            <option value="15" @if ($marketSetting->detail->strDlvCnAreaCd == "15") selected @endif>경북</option>
                                            <option value="16" @if ($marketSetting->detail->strDlvCnAreaCd == "16") selected @endif>전남</option>
                                            <option value="17" @if ($marketSetting->detail->strDlvCnAreaCd == "17") selected @endif>전북</option>
                                            <option value="18" @if ($marketSetting->detail->strDlvCnAreaCd == "18") selected @endif>제주</option>
                                            <option value="19" @if ($marketSetting->detail->strDlvCnAreaCd == "19") selected @endif>서울/경기</option>
                                            <option value="20" @if ($marketSetting->detail->strDlvCnAreaCd == "20") selected @endif>서울/경기/대전</option>
                                            <option value="21" @if ($marketSetting->detail->strDlvCnAreaCd == "21") selected @endif>충북/충남</option>
                                            <option value="22" @if ($marketSetting->detail->strDlvCnAreaCd == "22") selected @endif>경북/경남</option>
                                            <option value="23" @if ($marketSetting->detail->strDlvCnAreaCd == "23") selected @endif>전북/전남</option>
                                            <option value="24" @if ($marketSetting->detail->strDlvCnAreaCd == "24") selected @endif>부산/울산</option>
                                            <option value="25" @if ($marketSetting->detail->strDlvCnAreaCd == "25") selected @endif>서울/경기/제주도서산간 제외지역</option>
                                            <option value="26" @if ($marketSetting->detail->strDlvCnAreaCd == "26") selected @endif>일부지역불가</option>
                                            {{-- @foreach ($deliveryTypes as $deliveryType)
                                            <option value="{{$deliveryType->nIdx}}" @if ($marketSetting->detail->nDeliveryType == $deliveryType->nIdx) selected @endif>{{$deliveryType->strDeliveryName}}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">배송방법 <code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-2">
                                        <select class="custom-select form-control-border custom-select-sm" name="selDlvWyCd" id="selDlvWyCd">
                                            <option value="">= 선택 =</option>
                                            <option value="01"  @if ($marketSetting->detail->strDlvWyCd == "01") selected @endif>택배</option>
                                            <option value="02"  @if ($marketSetting->detail->strDlvWyCd == "02") selected @endif>우편(소포/등기)</option>
                                            <option value="03"  @if ($marketSetting->detail->strDlvWyCd == "03") selected @endif>직접전달(화물배달)</option>
                                            <option value="04"  @if ($marketSetting->detail->strDlvWyCd == "04") selected @endif>퀵서비스</option>
                                            <option value="05"  @if ($marketSetting->detail->strDlvWyCd == "05") selected @endif>배송필요없음</option>
                                            {{-- @foreach ($deliveryTypes as $deliveryType)
                                            <option value="{{$deliveryType->nIdx}}" @if ($marketSetting->detail->nDeliveryType == $deliveryType->nIdx) selected @endif>{{$deliveryType->strDeliveryName}}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">발송택배사 <code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-2">
                                        <select class="custom-select form-control-border custom-select-sm" name="selDlvEtprsCd" id="selDlvEtprsCd">
                                            <option value="">= 선택 =</option>
                                            <option value="00034" @if ($marketSetting->detail->strDlvEtprsCd == "00034") selected @endif>CJ대한통운</option>
                                            {{-- @foreach ($deliveryTypes as $deliveryType)
                                            <option value="{{$deliveryType->nIdx}}" @if ($marketSetting->detail->nDeliveryType == $deliveryType->nIdx) selected @endif>{{$deliveryType->strDeliveryName}}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">발송방법<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-6 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSendClfCdDmy1" name="rdoSendClfCdDmy" @if ($marketSetting->detail->strSendClfCdDmy == '01') checked @endif value="01">
                                            <label for="rdoSendClfCdDmy1" class="custom-control-label pt-1" style="font-size:12px;">오늘발송</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSendClfCdDmy2" name="rdoSendClfCdDmy" @if ($marketSetting->detail->strSendClfCdDmy == '02') checked @endif value="02">
                                            <label for="rdoSendClfCdDmy2" class="custom-control-label pt-1" style="font-size:12px;">일반발송</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoSendClfCdDmy3" name="rdoSendClfCdDmy" @if ($marketSetting->detail->strSendClfCdDmy == '03') checked @endif value="03">
                                            <label for="rdoSendClfCdDmy3" class="custom-control-label pt-1" style="font-size:12px;">재고확인후 순차발송</label>
                                        </div>
                                        </br>
                                        <div style="display:inline-block">
                                            <span class="pt-1" style="font-size:12px;">발송마감 기준</span>
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" class="form-control form-control-sm text-right" id="txtDlvSendCloseTmpltNo" name="txtDlvSendCloseTmpltNo" value="{{ $marketSetting->detail->strDlvSendCloseTmpltNo }}" placeholder="" >
                                        </div>
                                        <div style="display:inline-block">
                                            <a href="javascript:void(0);"  style="height:26px;" class="btn btn-primary btn-xs mt-0 btnSearchDlvSendCloseTmpltNo">
                                                <span style="font-size:10px;">검 색</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">출고지<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-6">
                                        <div style="display:inline-block">
                                            <input type="text" class="form-control form-control-sm text-right" id="txtAddrSeqOutAddr" name="txtAddrSeqOutAddr" value="{{ $marketSetting->detail->strAddrSeqOutAddr }}" placeholder="">
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
                                            <input type="text" class="form-control form-control-sm text-right" id="txtAddrSeqInAddr" name="txtAddrSeqInAddr" value="{{ $marketSetting->detail->strAddrSeqInAddr }}" placeholder="">
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
                                                <td style="text-align:left;"><input type="radio" name="rdoDlvCstInstBasiCd" value="01" @if ($marketSetting->detail->strDlvCstInstBasiCd == '01') checked @endif> 무료</td>
                                                <td>0원</td>
                                                <td>수량/주문금액에 상관없이 무조건 무료</td>
                                                <td>
                                                    <select name="selBndlDlvCnYn01">
                                                        <option value="Y" @if ($marketSetting->detail->strBndlDlvCnYn01 == "Y") selected @endif>가능</option>
                                                        <option value="N" @if ($marketSetting->detail->strBndlDlvCnYn01 == "N") selected @endif>불가</option>
                                                    </select>
                                                </td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td rowspan="7">구매자</td>
                                                <td style="text-align:left;"><input type="radio" name="rdoDlvCstInstBasiCd" value="07"  @if ($marketSetting->detail->strDlvCstInstBasiCd == '07') checked @endif> 판매자 조건부 배송비</td>
                                                <td colspan="2">판매자 조건부 배송비 설정된 금액</td>
                                                <td>가능</td>
                                                <td rowspan="6">
                                                    <select name="selDlvCstPayTypCd">
                                                        <option value="01" @if ($marketSetting->detail->strDlvCstPayTypCd == "01") selected @endif>선불+착불</option>
                                                        <option value="03" @if ($marketSetting->detail->strDlvCstPayTypCd == "02") selected @endif>선불</option>
                                                        <option value="02" @if ($marketSetting->detail->strDlvCstPayTypCd == "03") selected @endif>착불</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left;"><input type="radio" name="rdoDlvCstInstBasiCd" value="08"  @if ($marketSetting->detail->strDlvCstInstBasiCd == '08') checked @endif> 출고지 조건부 배송비</td>
                                                <td colspan="2">출고지 조건부 배송비 설정된 금액</td>
                                                <td>가능</td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left;"><input type="radio" name="rdoDlvCstInstBasiCd" value="03"  @if ($marketSetting->detail->strDlvCstInstBasiCd == '03') checked @endif> 상품 조건부 무료</td>
                                                <td><input type="text" style="width:50px;" name="txtDlvCst1_03" class="cntNum" value="{{$marketSetting->detail->nDlvCst1_03}}">원 </td>
                                                <td>이 상품<input type="text" name="txtPrdFrDlvBasiAmt" value="{{$marketSetting->detail->nPrdFrDlvBasiAmt}}" class="cntNum">원 이상 구매시 무료</td>
                                                <td>불가</td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left;"><input type="radio" name="rdoDlvCstInstBasiCd" value="04"  @if ($marketSetting->detail->strDlvCstInstBasiCd == '04') checked @endif> 수량별 차등</td>
                                                <td style="vertical-align:top;">
                                                    <dl>
                                                        <dd><input type="text" name="txtDlvCst3[0]" value="{{$marketSetting->detail->nDlvCst3_0}}" class="cntNum">원 </dd>
                                                        <dd><input type="text" name="txtDlvCst3[1]" value="{{$marketSetting->detail->nDlvCst3_1}}" class="cntNum">원 </dd>
                                                        <dd><input type="text" name="txtDlvCst3[2]" value="{{$marketSetting->detail->nDlvCst3_2}}" class="cntNum">원 </dd>
                                                        <dd><input type="text" name="txtDlvCst3[3]" value="{{$marketSetting->detail->nDlvCst3_3}}" class="cntNum">원 </dd>
                                                        <dd><input type="text" name="txtDlvCst3[4]" value="{{$marketSetting->detail->nDlvCst3_4}}" class="cntNum">원 </dd>
                                                    </dl>
                                                </td>
                                                <td style="vertical-align:top;">
                                                    <dl>
                                                        <dd><input type="hidden" name="txtDlvCnt1[0]" value="1" class="cntNum"><span class="cntNumTxt">1개</span> ~ <input type="text" name="txtDlvCnt2[0]" value="{{$marketSetting->detail->nDlvCnt2_0}}" class="cntNum">개</dd>
                                                        <dd><input type="text" name="txtDlvCnt1[1]" value="{{$marketSetting->detail->nDlvCnt1_1}}" class="cntNum">개 ~ <input type="text" name="txtDlvCnt2[1]" value="{{$marketSetting->detail->nDlvCnt2_1}}" class="cntNum">개</dd>
                                                        <dd><input type="text" name="txtDlvCnt1[2]" value="{{$marketSetting->detail->nDlvCnt1_2}}" class="cntNum">개 ~ <input type="text" name="txtDlvCnt2[2]" value="{{$marketSetting->detail->nDlvCnt2_2}}" class="cntNum">개</dd>
                                                        <dd><input type="text" name="txtDlvCnt1[3]" value="{{$marketSetting->detail->nDlvCnt1_3}}" class="cntNum">개 ~ <input type="text" name="txtDlvCnt2[3]" value="{{$marketSetting->detail->nDlvCnt2_3}}" class="cntNum">개</dd>
                                                        <dd><input type="text" name="txtDlvCnt1[4]" value="{{$marketSetting->detail->nDlvCnt1_4}}" class="cntNum">개 ~ <input type="text" name="txtDlvCnt2[4]" value="{{$marketSetting->detail->nDlvCnt2_4}}" class="cntNum">개</dd>
                                                    </dl>
                                                    <span class="txtRed">~개 이상일때는 빈칸으로 두시면 자동입력 됩니다.</span>
                                                </td>
                                                <td>
                                                    <select name="selBndlDlvCnYn04">
                                                        <option value="Y" @if ($marketSetting->detail->strBndlDlvCnYn04 == "Y") selected @endif>가능</option>
                                                        <option value="N" @if ($marketSetting->detail->strBndlDlvCnYn04 == "N") selected @endif>불가</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left;"><input type="radio" name="rdoDlvCstInstBasiCd" value="05"  @if ($marketSetting->detail->strDlvCstInstBasiCd == '05') checked @endif> 1개당 배송비</td>
                                                <td><input type="text" name="txtDlvCst4" value="{{$marketSetting->detail->nDlvCst4}}" class="cntNum">원</td>
                                                <td>수량 1개마다 배송비 추가</td>
                                                <td>불가</td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left;" rowspan="2"><input type="radio" name="rdoDlvCstInstBasiCd" value="02"  @if ($marketSetting->detail->strDlvCstInstBasiCd == '02') checked @endif> 고정 배송비</td>
                                                <td><input type="text" name="txtDlvCst1_02" value="{{$marketSetting->detail->nDlvCst1_02}}" class="cntNum">원</td>
                                                <td style="text-align:left;">수량/주문금액과 상관없이 고정 배송비</td>
                                                <td>
                                                    <select name="selBndlDlvCnYn02">
                                                        <option value="Y" @if ($marketSetting->detail->strBndlDlvCnYn02 == "Y") selected @endif>가능</option>
                                                        <option value="N" @if ($marketSetting->detail->strBndlDlvCnYn02 == "N") selected @endif>불가</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    배송비 추가 안내
                                                    <select name="selDlvCstInfoCd">
                                                        <option value="">해당없음</option>
                                                        <option value="01" @if ($marketSetting->detail->strDlvCstInfoCd == "01") selected @endif>(상품상세참고)</option>
                                                        <option value="02" @if ($marketSetting->detail->strDlvCstInfoCd == "02") selected @endif>(상품별 차등 적용)</option>
                                                        <option value="03" @if ($marketSetting->detail->strDlvCstInfoCd == "03") selected @endif>(지역별 차등 적용)</option>
                                                        <option value="04" @if ($marketSetting->detail->strDlvCstInfoCd == "04") selected @endif>(상품/지역별 차등)</option>
                                                        <option value="06" @if ($marketSetting->detail->strDlvCstInfoCd == "06") selected @endif>(서울/경기 무료, 이외 추가비용)</option>
                                                    </select>
                                                    (선결제 불가만 설정 가능)
                                                </td>
                                            </tr>
                                            <tr class="etcLine">
                                                <td colspan="2"><input type="checkbox" name="chkUseIslandJejuDlvCst" value="Y" @if($marketSetting->detail->strUseIslandJejuDlvCst == "Y") checked @endif>제주/도서산간 추가배송비 설정</td>
                                                <td colspan="5" style="text-align:left;">
                                                    제주 <input type="text" name="txtJejuDlvCst" value="{{$marketSetting->detail->nJejuDlvCst}}" class="cntNum">원 &nbsp; / &nbsp;
                                                    도서산간 <input type="text" name="txtIslandDlvCst" value="{{$marketSetting->detail->nIslandDlvCst}}" class="cntNum">원
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
                                            <input type="text" class="form-control form-control-sm text-right" id="txtRtngdDlvCst" name="txtRtngdDlvCst" value="{{ $marketSetting->detail->nRtngdDlvCst }}" placeholder="" >
                                        </div>
                                        <div style="display:inline-block; font-size:12px;">
                                            원 &nbsp;&nbsp;&nbsp;&nbsp;[초기배송비 무료시 부가방법
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoRtngdDlvCd01" name="rdoRtngdDlvCd" @if ($marketSetting->detail->strRtngdDlvCd == '01') checked @endif value="01">
                                            <label for="rdoRtngdDlvCd01" class="custom-control-label pt-1" style="font-size:12px;">왕복(편도x2) </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline mr-0">
                                            <input class="custom-control-input" type="radio" id="rdoRtngdDlvCd02" name="rdoRtngdDlvCd" @if ($marketSetting->detail->strRtngdDlvCd == '02') checked @endif value="02">
                                            <label for="rdoRtngdDlvCd02" class="custom-control-label pt-1" style="font-size:12px;">편도</label>
                                        </div>
                                        <div style="display:inline-block; font-size:12px;">
                                            ]
                                        </div>
                                        </br>
                                        <div style="display:inline-block">
                                            <span class="pt-1" style="font-size:12px;">교환 배송비 왕복</span>
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" class="form-control form-control-sm text-right" id="txtExchDlvCst" name="txtExchDlvCst" value="{{ $marketSetting->detail->nExchDlvCst }}" placeholder="" >
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
                                            <textarea class="form-control text-xs" rows="3" placeholder="" name="txtAsDetail" id="txtAsDetail">{{$marketSetting->detail->strAsDetail}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">반품/교환 안내<code style="color:red !important;">[필수]</code></label>
                                    <div class="col-sm-9 col-md-6 mt-1">
                                        <div>
                                            <textarea class="form-control text-xs" rows="3" placeholder="" name="txtRtngExchDetail" id="txtRtngExchDetail">{{$marketSetting->detail->strRtngExchDetail}}</textarea>
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
                                            <input type="text" style="width:250px;" class="form-control form-control-sm text-right" name="txtAdvrtStmt" id="txtAdvrtStmt" value="{{ $marketSetting->detail->strAdvrtStmt }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">가격비교 사이트 등록</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoPrcCmpExpYn_00" name="rdoPrcCmpExpYn" @if( $marketSetting->detail->strPrcCmpExpYn == 'Y' ) checked @endif value="Y" >
                                            <label for="rdoPrcCmpExpYn_00" class="custom-control-label pt-1" style="font-size:12px;">등록함</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoPrcCmpExpYn_01" name="rdoPrcCmpExpYn" @if( $marketSetting->detail->strPrcCmpExpYn == 'N' ) checked @endif value="N">
                                            <label for="rdoPrcCmpExpYn_01" class="custom-control-label pt-1" style="font-size:12px;">등록안함</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">상품리뷰/구매후기</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoReviewDispYn_00" name="rdoReviewDispYn" @if( $marketSetting->detail->strReviewDispYn == '00' ) checked @endif value="00" >
                                            <label for="rdoReviewDispYn_00" class="custom-control-label pt-1" style="font-size:12px;">노출함</label>
                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input class="custom-control-input" type="checkbox" name="chkReviewOptDispYn" id="chkReviewOptDispYn" @if($marketSetting->detail->strReviewOptDispYn == "Y") checked @endif>
                                            <label for="chkReviewOptDispYn" style="font-size:12px;" class="custom-control-label pt-1">옵션비노출</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" id="rdoReviewDispYn_01" name="rdoReviewDispYn" @if( $marketSetting->detail->strReviewDispYn == '01' ) checked @endif value="01">
                                            <label for="rdoReviewDispYn_01" class="custom-control-label pt-1" style="font-size:12px;">노출안함</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">기본즉시할인</label>
                                    <div class="col-sm-9 col-md-10 bg-light">
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input class="custom-control-input" type="checkbox" name="chkCuponcheck" id="chkCuponcheck" @if( $marketSetting->detail->strCuponcheck == 'Y' ) checked @endif>
                                            <label for="chkCuponcheck" class="custom-control-label">설정함</label>
                                        </div>
                                        <br>
                                        <div style="display:inline-block">
                                            <span class="pt-1" style="font-size:12px;">판매가에서</span>
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" style="width:50px;" class="form-control form-control-sm text-right" id="txtDscAmtPercnt" name="txtDscAmtPercnt" value="{{ $marketSetting->detail->nDscAmtPercnt }}" placeholder="" >
                                        </div>
                                        <div style="display:inline-block">
                                            <select class="mb-1 custom-select form-control-border custom-select-sm" name="selCupnDscMthdCd" id="selCupnDscMthdCd">
                                                <option value="01"  @if ($marketSetting->detail->strCupnDscMthdCd == '01') selected @endif>%</option>
                                                <option value="02"  @if ($marketSetting->detail->strCupnDscMthdCd == '02') selected @endif>원</option>
                                                
                                                
                                            </select>
                                        </div>
                                        <div style="display:inline-block">
                                            <span class="pt-1" style="font-size:12px;">할인</span>
                                        </div>
                                        <br>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input class="custom-control-input" type="checkbox" name="chkCupnUseLmtDyYn" id="chkCupnUseLmtDyYn" @if( $marketSetting->detail->strCupnUseLmtDyYn == 'Y' ) checked @endif>
                                            <label for="chkCupnUseLmtDyYn" class="custom-control-label pt-1" style="font-size:12px;">쿠폰 지급기간 설정</label>
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" style="width:100px;" class="form-control form-control-sm text-right" id="txtCupnIssStartDy" name="txtCupnIssStartDy" value="{{ $marketSetting->detail->dtCupnIssStartDy }}" placeholder="" >
                                        </div>
                                        ~
                                        <div style="display:inline-block">
                                            <input type="text" style="width:100px;" class="form-control form-control-sm text-right" id="txtCupnIssEndDy" name="txtCupnIssEndDy" value="{{ $marketSetting->detail->dtCupnIssEndDy }}" placeholder="" >
                                        </div>
                                        <br>
                                        <div style="display:inline-block">
                                            <span class="pt-1" style="font-size:12px;">적용금액이 </span>
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" style="width:50px;" class="form-control form-control-sm text-right" id="txtCupnMinPrice" name="txtCupnMinPrice" value="{{ $marketSetting->detail->nCupnMinPrice }}" placeholder="" >
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
                                            <input class="custom-control-input" type="checkbox" name="chkPay11YN" id="chkPay11YN" @if( $marketSetting->detail->strPay11YN == 'Y' ) checked @endif >
                                            <label for="chkPay11YN" class="custom-control-label pt-1" style="font-size:12px;">설정함</label>
                                        </div>
                                        <br>
                                        <div style="display:inline-block">
                                            <span class="pt-1" style="font-size:12px;">판매가에서</span>
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" style="width:50px;" class="form-control form-control-sm text-right" id="txtPay11Value" name="txtPay11Value" value="{{ $marketSetting->detail->nPay11Value }}" placeholder="" >
                                        </div>
                                        <div style="display:inline-block">
                                            <select class="mb-1 custom-select form-control-border custom-select-sm" name="selPay11WyCd" id="selPay11WyCd">
                                                <option value="01" @if ($marketSetting->detail->strPay11WyCd == '01') selected @endif>원</option>
                                                <option value="02" @if ($marketSetting->detail->strPay11WyCd == '02') selected @endif>%</option>
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
                                            <input class="custom-control-input" type="checkbox" name="chkIntFreeYN" id="chkIntFreeYN"  @if( $marketSetting->detail->strIntFreeYN == 'Y' ) checked @endif>
                                            <label for="chkIntFreeYN" style="font-size:12px;" class="custom-control-label pt-1">설정함</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">복수구매할인</label>
                                    <div class="col-sm-9 col-md-10 bg-light">
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input class="custom-control-input" type="checkbox" name="chkPluYN" id="chkPluYN" @if( $marketSetting->detail->strPluYN == 'Y' ) checked @endif>
                                            <label for="chkPluYN" style="font-size:12px;" class="custom-control-label pt-1">설정함</label>
                                        </div>
                                        <br>
                                        <div style="display:inline-block">
                                            <select class="mb-1 custom-select form-control-border custom-select-sm" name="selPluDscBasis" id="selPluDscBasis">
                                                <option value="01" @if ($marketSetting->detail->strPluDscBasis == '01') selected @endif>수량기준</option>
                                                <option value="02" @if ($marketSetting->detail->strPluDscBasis == '02') selected @endif>금액기준</option>
                                            </select>
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" style="width:50px;" class="form-control form-control-sm text-right" id="txtPluDscBasis" name="txtPluDscBasis" value="{{ $marketSetting->detail->strPluDscBasis }}" placeholder="" >
                                        </div>
                                        <div style="display:inline-block">
                                            <span class="pt-1" style="font-size:12px;">개 이상 구매시 판매가(+옵션가)에서 개당</span>
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" style="width:50px;" class="form-control form-control-sm text-right" id="txtPluDscAmtPercnt" name="txtPluDscAmtPercnt" value="{{ $marketSetting->detail->nPluDscAmtPercnt }}" placeholder="" >
                                        </div>
                                        <div style="display:inline-block">
                                            <select class="mb-1 custom-select form-control-border custom-select-sm" name="selPluDscMthdCd" id="selPluDscMthdCd">
                                                <option value="01" @if ($marketSetting->detail->strPluDscMthdCd == '01') selected @endif>%</option>
                                                <option value="02" @if ($marketSetting->detail->strPluDscMthdCd == '02') selected @endif>원</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input class="custom-control-input" type="checkbox" name="chkPluUseLmtDyYn" id="chkPluUseLmtDyYn" @if( $marketSetting->detail->strPluUseLmtDyYn == 'Y' ) checked @endif >
                                            <label for="chkPluUseLmtDyYn" class="custom-control-label pt-1" style="font-size:12px;">할인 적용기간 설정</label>
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" style="width:100px;" class="form-control form-control-sm text-right" id="txtPluIssStartDy" name="txtPluIssStartDy" value="{{ $marketSetting->detail->dtPluIssStartDy }}" placeholder="" >
                                        </div>
                                        ~
                                        <div style="display:inline-block">
                                            <input type="text" style="width:100px;" class="form-control form-control-sm text-right" id="txtPluIssEndDy" name="txtPluIssEndDy" value="{{ $marketSetting->detail->dtPluIssEndDy }}" placeholder="" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">희망후원 설정</label>
                                    <div class="col-sm-9 col-md-10 bg-light mt-1">
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input class="custom-control-input" type="checkbox" name="chkHopeShpYn" id="chkHopeShpYn" @if( $marketSetting->detail->strHopeShpYn == 'Y' ) checked @endif >
                                            <label for="chkHopeShpYn" style="font-size:12px;" class="custom-control-label pt-1">설정함</label>
                                        </div>
                                        <br>
                                        <div style="display:inline-block">
                                            <span class="pt-1" style="font-size:12px;">판매가에서</span>
                                        </div>
                                        <div style="display:inline-block">
                                            <input type="text" style="width:50px;" class="form-control form-control-sm text-right" id="txtHopeShpPnt" name="txtHopeShpPnt" value="{{ $marketSetting->detail->nHopeShpPnt }}" placeholder="" >
                                        </div>
                                        <div style="display:inline-block">
                                            <select class="mb-1 custom-select form-control-border custom-select-sm" name="selHopeShpWyCd" id="selHopeShpWyCd">
                                                <option value="01" @if ($marketSetting->detail->strHopeShpWyCd == '01') selected @endif>%</option>
                                                <option value="02" @if ($marketSetting->detail->strHopeShpWyCd == '02') selected @endif>원</option>
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
                                            <input type="text" style="width:50px;" class="form-control form-control-sm text-right" id="txtHopeShpMinPrice" name="txtHopeShpMinPrice" value="{{ $marketSetting->detail->nHopeShpMinPrice }}" placeholder="" >
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
                var nickName = $("#txtSelMnbdNckNm").val();
                if(nickName == ""){
                    alert('닉네임을 입력해주세요!');
                    return false;
                }
                var selMth = $("input[name='rdoSelMthdCd']:checked").val();
                if(selMth == undefined){
                    alert('판매방식을 선택해주세요!');
                    return false;
                }
                var selPrdTypCd = $('#selPrdTypCd option:selected').val();
                if(selPrdTypCd == ""){
                    alert('서비스상품을 선택해주세요!');
                    return false;
                }

                var rdoForAbrdBuyClf = $("input[name='rdoForAbrdBuyClf']:checked").val();
                if(rdoForAbrdBuyClf == undefined){
                    alert('해외구매대행상품을 선택해주세요!');
                    return false;
                }

                var rdoPrdStatCd = $("input[name='rdoPrdStatCd']:checked").val();
                if(rdoPrdStatCd == undefined){
                    alert('상품상태를 선택해주세요!');
                    return false;
                }

                var rdoSelTermUseYn = $("input[name='rdoSelTermUseYn']:checked").val();
                if(rdoSelTermUseYn == undefined){
                    alert('판매기간을 선택해주세요!');
                    return false;
                }else if(rdoSelTermUseYn == "Y"){
                    var selSelPrdClfCd = $('#selSelPrdClfCd option:selected').val();
                    if(selSelPrdClfCd == ""){
                        alert('날짜범위를 선택해주세요!');
                        return false;
                    }else if(selSelPrdClfCd == "0"){
                        if($("#txtAplBgnDy").val() == "" || $("#txtAplEndDy").val() == ""){
                            alert('날짜범위를 선택해주세요!');
                            return false;
                        }
                    }
                }
                
                var cond = $("input[name='rdoSelMinLimitTypCd']:checked").val();
                if(cond == undefined){
                    alert('최소구매수량을 선택해주세요!');
                    return false;
                }else if(cond=="01"){
                    if($("#txtSelMinLimitQty").val() == ""){
                        alert('구매수량을 입력해주세요!');
                        return false;
                    }
                }

                cond = $("input[name='rdoSelLimitTypCd']:checked").val();
                if(cond == undefined){
                    alert('최대구매수량을 선택해주세요!');
                    return false;
                }else if(cond=="01"){
                    if($("#txtSelLimitQty").val() == ""){
                        alert('구매수량을 입력해주세요!');
                        return false;
                    }
                }else if(cond=="02"){
                    if($("#txtTownSelLmtDy").val() == "" || $("#txtTownSelLmtQty").val() == ""){
                        alert('구매수량을 입력해주세요!');
                        return false;
                    }
                }

                cond = $('#selAbrdBuyPlace option:selected').val();
                if(cond == ""){
                    alert('구입처를 선택해주세요!');
                    return false;
                }

                cond = $('#selDlvCnAreaCd option:selected').val();
                if(cond == ""){
                    alert('배송가능지역을 선택해주세요!');
                    return false;
                }

                cond = $('#selDlvWyCd option:selected').val();
                if(cond == ""){
                    alert('배송방법을 선택해주세요!');
                    return false;
                }

                cond = $('#selDlvEtprsCd option:selected').val();
                if(cond == ""){
                    alert('발송택배사를 선택해주세요!');
                    return false;
                }

                cond = $("input[name='rdoSendClfCdDmy']:checked").val();
                if(cond == undefined){
                    alert('발송방법을 선택해주세요!');
                    return false;
                }else if(cond == "03"){
                    if($("txtDlvSendCloseTmpltNo").val() == ""){
                        alert('발송마감기준값을 입력해주세요!');
                        return false;
                    }
                }

                if($("txtAddrSeqOutAddr").val() == ""){
                    alert('출고지를 입력해주세요!');
                    return false;
                }

                cond = $("txtAddrSeqInAddr").val();
                if(cond == ""){
                    alert('반품지를 선택해주세요!');
                    return false;
                }

                if($("txtRtngdDlvCst").val() || $("txtExchDlvCst").val()){
                    alert('반품/교환지주소를 입력해주세요!');
                    return false;
                }

                if($("txtRtngdDlvCst").val() || $("txtExchDlvCst").val()){
                    alert('반품/교환지주소를 입력해주세요!');
                    return false;
                }
                
                var txtAsDetail = $("txtarea#txtAsDetail").val();
                if(txtAsDetail == ""){
                    alert('A/S안내 내용을 입력해주세요!');
                    return false;
                }
                var txtRtngExchDetail = $("#txtRtngExchDetail").val();
                if(txtRtngExchDetail == ""){
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
            //발송 마감 기준 템플렛 선택
            $('body').on('click', '.btnSearchDlvSendCloseTmpltNo', function () {
                var market_id = $("#market_id").val();
                var account_id = $('#selAccountId option:selected').val();
                if(account_id == ""){
                    alert('등록하려는 계정을 선택해주세요!');
                    return false;
                }
                window.open('/operationBasicSettingManage/Search11thSendCloseTpl/' + market_id + '/account/' + account_id, '출고지선택', 'scrollbars=1, resizable=1, width=1076, height=500');
                return false;
            });
            $.SetOutboundShippingPlace = function(outboudCode=0){
                $("#txtAddrSeqOutAddr").val(outboudCode);
            }
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
            $.SetSendCloseTpl = function(sendCloseTplCode=0){
                $("#txtDlvSendCloseTmpltNo").val(sendCloseTplCode);
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
                $("#txtAddrSeqInAddr").val(returnCode);
            }
            
        });
        function SetOutboundShippingPlace(outboudCode=0){
            $.SetOutboundShippingPlace(outboudCode);
        }
        function SetReturnShippingCenter(returnCode=0, returnName="name", returnContact = "contact", returnZip="111", returnAddress="address", returnDetail="detail address"){
            $.SetReturnCenter(returnCode, returnName, returnContact, returnZip, returnAddress, returnDetail);
        }
        function SetSendCloseTpl(sendCloseTplCode=0){
            $.SetSendCloseTpl(sendCloseTplCode);
        }
    </script>
</body>
</html>

