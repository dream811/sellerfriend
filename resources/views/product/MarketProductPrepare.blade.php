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
    {{-- dialog --}}
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    @yield('third_party_stylesheets')

    @stack('page_css')
</head>
<body class="hold-transition sidebar-mini layout-fixed dark-mode text-sm">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="font-size:16px; font-weight:700;">상품등록정보</h1>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card card-primary card-outline card-tabs">
                    <form id="manageMarketProduct" method="post" action="{{ route('product.MarketAccountProduct') }}"> 
                        @csrf
                        <div class="card-header border-bottom-0">
                            <div class="row col-12 pull-right float-right">
                                <a href="javascript:void(0)" class="btn btn-success btn-xs btnSubmitProduct" style="font-size:12px !important;">상품등록송신</a>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="javascript:void(0)" onclick="window.opener=null; window.close(); return false;" class="btn btn-warning btn-xs" style="font-size:12px !important;">닫기</a>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0" style="height:500px;">
                        
                            <input type="hidden" name="productId" value="productId">
                            <table id="marketAccountTable" class="table table-bordered header-fixed" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>쇼핑몰</th>
                                        <th colspan="4">쇼핑몰 기본정보</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($marketAccounts as $account)
                                        <tr  class="text-center align-middle" id="{{ $account->nIdx }}">
                                            <td rowspan="4"  class="text-center align-middle">
                                                {{ $account->Market->strMarketName }}
                                                &nbsp;<br>
                                                {{ $account->strAccountId }}
                                            </td>
                                            <td >선택</td>
                                            <td>마켓ID</td>
                                            <td>제목</td>
                                            <td>관리</td>
                                        </tr>
                                        <tr  class="text-center align-middle">
                                            <td>
                                                옵션
                                            </td>
                                            <td >{{ $account->strAccountId}}</td>
                                            <td>{{ $account->Market->strMarketName}}</td>
                                            <td>
                                                <a href="javascript:void(0)" class="btn btn-warning btn-xs" style="font-size:12px !important;">수정</a>
                                            </td>
                                        </tr>
                                        <tr class="text-center align-middle">
                                            <td colspan="2">
                                                카테고리 선택
                                            </td>
                                            <td colspan="2">
                                                <input class="p-0 clsCategoryCode" name="txtCategoryCode[{{ $account->Market->strMarketCode}}]" id="cateCode_{{ $account->Market->strMarketCode}}" style="width:20%" type="text" value="78035" data-code="{{ $account->Market->strMarketCode}}">
                                                <input class="p-0" name="txtCategoryName[{{ $account->Market->strMarketCode}}]" id="cateName_{{ $account->Market->strMarketCode}}" style="width:70%" type="text" value="" readonly>
                                                <a href="javascript:void(0)" onclick="" class="btn btn-warning btn-xs" style="font-size:12px !important;">검색</a>
                                                <br>
                                                <span>추천검색어:</span><span>패션의류</span><span>잡화</span>
                                            </td>
                                        </tr>
                                        <tr class="text-center align-middle">
                                            @if ($account->Market->strMarketCode == 'coupang')
                                                <td colspan="2">
                                                    옵션매핑
                                                </td>
                                                <td>
                                                    <div id="digOptionMappping_{{ $account->Market->strMarketCode}}" title="옵션설정"></div>
                                                    <div id="hidOptMappingInfo_{{ $account->Market->strMarketCode}}" class="d-none"></div>
                                                    <a href="javascript:void(0)" name="setOptionMapping[{{ $account->Market->strMarketCode}}]" id="setOptionMapping_{{ $account->Market->strMarketCode}}" data-code="{{ $account->Market->strMarketCode}}" class="btn btn-secondary btn-xs btnSetOptionMapping" style="font-size:12px !important;">수정</a>
                                                    <input class="p-0" name="txtOptionMapping[]" id="txtOptionMapping_{{$account->Market->strMarketCode}}" style="width:70%" type="" value="">
                                                    
                                                </td>
                                                <td>
                                                </td>
                                            @else
                                                <td colspan="2">
                                                    상품정보고시유형
                                                </td>
                                                <td>
                                                    <select name="selComeName" id="selComeName" style="width: 100px;">
                                                        <option value="0">==출항코드==</option>
                                                        {{-- @foreach ($comes as $come)
                                                        <option value="{{$come->nIdx}}" >[{{$come->strComeCode}}] {{$come->strComeName}}</option>
                                                        @endforeach --}}
                                                    </select>
                                                </td>
                                                <td>
                                                </td>
                                            @endif
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                    </form>
                </div>
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
            $('#select_all').on('click', function(){
                // Get all rows with search applied
                // Check/uncheck checkboxes for all rows in the table
                $('input[type="checkbox"]').prop('checked', this.checked);
            });

            $('body').on('click', '.btnSubmitProduct', function () {
                $( "#manageMarketProduct" ).submit();
            });
            $( ".clsCategoryCode" ).focus(function() {
                market_code = $(this).attr('data-code');
                
                window.open('/productSearchMarketCategory/' + market_code + '/category/0', '카테고리', 'scrollbars=1, resizable=1, width=1000, height=800');
                $(this).blur();
                return false;
            });
            $.SetCategoryInfo = function(market_code='coupang', category_code=0, category_tree=""){
                console.log(market_code + category_code + category_tree);
                $("#cateCode_" + market_code).val(category_code);
                $("#cateName_" + market_code).val(category_tree);

            }
            //옵션 다이얼로그 박스
            var $dialog;
            $('body').on('click', '.btnSetOptionMapping', function () {
                //$(".ui-dialog-titlebar").hide();
                
                var market_code = $(this).attr('data-code');
                var category_code = $("#cateCode_" + market_code).val();
                var action = '/productSearchMarketOptionMapping/' + market_code + '/category/' + category_code;

                $('#hidOptMappingInfo_' + market_code).html('');//숨김 옵션매팽 테블 삭제
                $.ajax({
                    url: action,
                    data: {market_code, category_code},
                    type: "GET",
                    dataType: 'json',
                    success: function ({status, data}) {
                        if(status == "success"){
                            
                            var content = `<table id="marketOptionMappingTable" class="table table-bordered text-sm" style="font-size:10px !important;" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>${market_code}옵션</th>
                                                    <th>매핑</th>
                                                </tr>
                                            </thead>
                                            <tbody>`;
                            data.forEach( (element, index) => {
                                content +=  `<tr id="${index}">
                                                <td>${element.attributeTypeName}</td>
                                                <td>
                                                    <label><input type="radio" name="mappingOpt[coupang][${index}]" value="${element.attributeTypeName}::사이즈"> 사이즈</label>
                                                    <label><input type="radio" name="mappingOpt[coupang][${index}]" value="${element.attributeTypeName}::컬러"> 컬러</label>
                                                </td>
                                            </tr>`;
                            });
                                                    
                            content +=  `   </tbody>
                                        </table>
                                        <a href="javascript:void(0)" name="confirm" class="btn btn-warning btn-xs float-right btnSaveOptionMapping" data-code="${market_code}" style="font-size:10px !important;">확인</a>
                                        `;
                            var $dialog = $('#digOptionMappping_' + market_code);
                            $dialog.dialog({
                                autoOpen: false,
                                modal: false,
                                position: {
                                    my: 'left top',      //The point on the dialog box
                                    at: 'right bottom',      //The point on the target element
                                    of: $('#setOptionMapping_' + market_code)  //The target element
                                },
                                //dialogClass: 'noTitleStuff',
                                draggable: true,
                                width: '240px'
                            });
                            $dialog.html(content);
                            $dialog.dialog('open');
                        }else{
                            alert('관리카테고리를 찾을수 없는 노출카테고리코드 입니다. 담당MD에게 확인하고 유효한 노출카테고리를 입력해주세요.');
                        }
                    },
                    error: function (data) {

                    }
                });
                
            });
            $('body').on('click', '.btnSaveOptionMapping', function () {
                var market_code = $(this).attr('data-code');
                var $dialog = $('#digOptionMappping_' + market_code);
                var content = $dialog.html();
                
                ///
                var strOptMapping = "";
                $('#marketOptionMappingTable tbody tr').each(function( index, element ) {
                    strOptMapping += $('input[name="mappingOpt['+ market_code +']['+ index +']"]:checked').val();
                });
                $('#hidOptMappingInfo_' + market_code).html(content);
                $dialog.html('');
                $('#txtOptionMapping_' + market_code).val(strOptMapping);
                //창 닫기
                $dialog.dialog('close');
            });
        });
        

        function SetCategoryInfo(market_code='coupang', category_code=0, category_tree=""){
            $.SetCategoryInfo(market_code, category_code, category_tree);
        }
    </script>
</body>
</html>

