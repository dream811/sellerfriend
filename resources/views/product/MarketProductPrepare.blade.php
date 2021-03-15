@extends('layouts.window')
@section('third_party_javascript')
{{-- dialog --}}
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection


@section('content')
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
                                    @foreach ($settingCoupangs as $coupang)
                                        <tr  class="text-center align-middle" id="{{ $coupang->nIdx }}">
                                            <td rowspan="4"  class="text-center align-middle">
                                                {{ $coupang->Market->strMarketName }}
                                                &nbsp;<br>
                                                {{ $coupang->strAccountId }}
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
                                            <td >{{ $coupang->marketAccount->strAccountId}}</td>
                                            <td>{{ $coupang->strTitle}}</td>
                                            <td>
                                                <a href="javascript:void(0)" class="btn btn-warning btn-xs" style="font-size:12px !important;">수정</a>
                                            </td>
                                        </tr>
                                        <tr class="text-center align-middle">
                                            <td colspan="2">
                                                카테고리 선택
                                            </td>
                                            <td colspan="2">
                                                <input class="p-0 clsCategoryCode" name="txtCategoryCode[{{ $coupang->Market->strMarketCode}}]" id="cateCode_{{ $coupang->Market->strMarketCode}}_{{$coupang->nIdx}}" style="width:20%" type="text" value="78035" data-code="{{ $coupang->Market->strMarketCode}}" data-id="{{ $coupang->nIdx}}">
                                                <input class="p-0" name="txtCategoryName[{{ $coupang->Market->strMarketCode}}]" id="cateName_{{ $coupang->Market->strMarketCode}}_{{$coupang->nIdx}}" style="width:70%" type="text" value="" readonly>
                                                <a href="javascript:void(0)" onclick="" class="btn btn-warning btn-xs" style="font-size:12px !important;">검색</a>
                                                <br>
                                                <div class="text-xs" style="text-align:left">
                                                    <label style="font-size:12px;">추천검색어:</label><span class="badge badge-secondary mr-1">패션의류</span><span class="badge badge-secondary mr-1">잡화</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="text-center align-middle">
                                            @if ($coupang->Market->strMarketCode == 'coupang')
                                                <td colspan="2">
                                                    옵션매핑
                                                </td>
                                                <td>
                                                    <div id="digOptionMappping_{{ $coupang->Market->strMarketCode}}_{{$coupang->nIdx}}" title="옵션설정"></div>
                                                    <div id="hidOptMappingInfo_{{ $coupang->Market->strMarketCode}}_{{$coupang->nIdx}}" class="d-none"></div>
                                                    <a href="javascript:void(0)" name="setOptionMapping[{{ $coupang->Market->strMarketCode}}]" id="setOptionMapping_{{ $coupang->Market->strMarketCode}}_{{$coupang->nIdx}}" data-code="{{ $coupang->Market->strMarketCode}}" data-id="{{ $coupang->nIdx }}" class="btn btn-secondary btn-xs btnSetOptionMapping" style="font-size:12px !important;">수정</a>
                                                    <input class="p-0" name="txtOptionMapping_{{$coupang->Market->strMarketCode}}_{{$coupang->nIdx}}" id="txtOptionMapping_{{$coupang->Market->strMarketCode}}_{{$coupang->nIdx}}" style="width:70%" type="" value="">
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
@endsection
@section('script')
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
                set_id = $(this).attr('data-id');
                
                window.open('/productSearchMarketCategory/' + market_code + '/category/0/setting/' + set_id, '카테고리', 'scrollbars=1, resizable=1, width=1000, height=800');
                $(this).blur();
                return false;
            });
            $.SetCategoryInfo = function(market_code='coupang', category_code=0, category_tree="", set_id=0){
                $("#cateCode_" + market_code + "_" + set_id).val(category_code);
                $("#cateName_" + market_code + "_" + set_id).val(category_tree);

            }
            //옵션 다이얼로그 박스
            var $dialog;
            $('body').on('click', '.btnSetOptionMapping', function () {
                //$(".ui-dialog-titlebar").hide();
                
                var market_code = $(this).attr('data-code');
                var set_id = $(this).attr('data-id');
                var category_code = $("#cateCode_" + market_code + "_" + set_id).val();
                
                var action = '/productSearchMarketOptionMapping/' + market_code + '/category/' + category_code;

                $('#hidOptMappingInfo_' + market_code + '_' + set_id).html('');//숨김 옵션매팽 테블 삭제
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
                                                    <label><input type="radio" name="mappingOpt[coupang][${set_id}][${index}]" value="${element.attributeTypeName}::사이즈"> 사이즈</label>
                                                    <label><input type="radio" name="mappingOpt[coupang][${set_id}][${index}]" value="${element.attributeTypeName}::컬러"> 컬러</label>
                                                </td>
                                            </tr>`;
                            });
                                                    
                            content +=  `   </tbody>
                                        </table>
                                        <a href="javascript:void(0)" name="confirm" class="btn btn-warning btn-xs float-right btnSaveOptionMapping" data-code="${market_code}" data-id="${set_id}" style="font-size:10px !important;">확인</a>
                                        `;
                            var $dialog = $('#digOptionMappping_' + market_code + '_' + set_id);
                            $dialog.dialog({
                                autoOpen: false,
                                modal: false,
                                position: {
                                    my: 'left top',      //The point on the dialog box
                                    at: 'right bottom',      //The point on the target element
                                    of: $('#setOptionMapping_' + market_code + '_' + set_id)  //The target element
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
                var set_id = $(this).attr('data-id');
                var $dialog = $('#digOptionMappping_' + market_code + '_' + set_id);
                var content = $dialog.html();
                
                ///
                var strOptMapping = "";
                $('#marketOptionMappingTable tbody tr').each(function( index, element ) {
                    var tag = 'input[name="mappingOpt['+ market_code +"]["+set_id+"]["+ index +']"]:checked';
                    strOptMapping += $(tag).val() + ",";
                });
                //$('#hidOptMappingInfo_' + market_code + '_' + set_id).html(content);
                $dialog.html('');
                if(strOptMapping != undefined){
                    $('#txtOptionMapping_' + market_code + '_' + set_id).val(strOptMapping.slice(0, -1));
                }
                //창 닫기
                $dialog.dialog('close');
            });
        });
        

        function SetCategoryInfo(market_code='coupang', category_code=0, category_tree="", set_id=0){
            $.SetCategoryInfo(market_code, category_code, category_tree, set_id);
        }
    </script>
@endsection