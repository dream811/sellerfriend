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
                    <li class="breadcrumb-item active">상품스크랩</li>
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
                                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">상품스크랩</a>
                            </li>
                            
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                <form method="POST" id="frmScrap" action="{{route('scratch.ProductScrap')}}">
                                @csrf
                                    <div class="form-group row col-12">
                                        <label for="txtScrapURL">대상URL</label>
                                        <div class="input-group input-group-sm">
                                            <input type="url" class="form-control" name="txtScrapURL" id="txtScrapURL" value="" placeholder="Tmall, Taobao, 1688, vvic의 상품URL을 붙여넣기(Ctrl+V)해 주세요.">
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-danger btn-flat btnScrapProduct">상품수집</button>
                                            </span>
                                            <span class="input-group-append">
                                                <div class="btn btn-warning btnSaveProduct">보관</div>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="">집하지</label>
                                                <div class="input-group input-group-sm">
                                                    <select class="custom-select form-control-border" name="selComeName" id="selComeName">
                                                        <option value="0">==출항코드==</option>
                                                        @foreach ($comes as $come)
                                                        <option value="{{$come->strComeCode}}" >[{{$come->strComeCode}}] {{$come->strComeName}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>    
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <label for=""></label>
                                                <div class="custom-control custom-checkbox mt-2">
                                                    <input type="checkbox" name="keepDataState" class="custom-control-input" id="keepDataState">
                                                    <label class="custom-control-label" for="ke"><strong style="color:red;">선택데이터 유지</strong>[수집정보 등록 후 "집하지/브랜드/카테고리/키워드/내륙배송비" 정보를 유지합니다.]</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group form-group">
                                                <label for="">브랜드</label>
                                                <input type="text" class="form-control form-control-sm" name="txtBrandName" id="txtBrandName" placeholder="">
                                            </div>    
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for=""> </label>
                                                <div class="input-group input-group-sm mt-2">
                                                    <select class="custom-select form-control-border" name="selBrandName" id="selBrandName">
                                                        <option value="0">==직접입력==</option>
                                                        @foreach ($brands as $brand)
                                                        <option value="{{$brand->nIdx}}" >{{$brand->strBrandName}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row col-12" style="margin-top:-0.5rem;">
                                        <code>- 판매자님의 상점명 또는 브랜드명을 입력해주세요</code>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <label for="">카테고리</label>
                                                <div class="input-group input-group-sm">
                                                    <select class="custom-select form-control-border" name="selCategoryName1" id="selCategoryName1">
                                                        <option value="0">카테고리 1</option>
                                                        @foreach ($categories_1 as $category_1)
                                                        <option value="{{$category_1->strCategoryTree}}" >{{$category_1->strCategoryName}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <label for=""> </label>
                                                <div class="input-group input-group-sm mt-2">
                                                    <select class="custom-select form-control-border" name="selCategoryName2" id="selCategoryName2">
                                                        <option value="0">카테고리 2</option>
                                                        @foreach ($categories_2 as $category_2)
                                                        <option value="{{$category_2->strCategoryTree}}" >{{$category_2->strCategoryName}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <label for=""> </label>
                                                <div class="input-group input-group-sm mt-2">
                                                    <select class="custom-select form-control-border" name="selCategoryName3" id="selCategoryName3">
                                                        <option value="0">카테고리 3</option>
                                                        @foreach ($categories_3 as $category_3)
                                                        <option value="{{$category_3->strCategoryTree}}" >{{$category_3->strCategoryName}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <label for=""> </label>
                                                <div class="input-group input-group-sm mt-2">
                                                    <select class="custom-select form-control-border" name="selCategoryName4" id="selCategoryName4">
                                                        <option value="0">카테고리 4</option>
                                                        @foreach ($categories_4 as $category_4)
                                                        <option value="{{$category_4->strCategoryTree}}" >{{$category_4->strCategoryName}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group form-group mt-2">
                                                <label for=""></label>
                                                <input type="text" class="form-control form-control-sm" name="txtCategoryName" id="txtCategoryName" value="" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row col-12">
                                        <label for="scrapURL">비공개여부</label>
                                        <div class="input-group">
                                            <div class="custom-control custom-radio col-2">
                                                <input class="custom-control-input" type="radio" id="rdoShareType1" name="rdoShareType" value="0" {{ ($shareType =="0")? "checked" : "" }}>
                                                <label for="rdoShareType1" class="custom-control-label">비공개</label>
                                            </div>
                                            <div class="custom-control custom-radio col-2">
                                                <input class="custom-control-input" type="radio" id="rdoShareType2" name="rdoShareType" value="1" {{ ($shareType =="1")? "checked" : "" }}>
                                                <label for="rdoShareType2" class="custom-control-label">공개</label>
                                            </div>
                                            <div class="custom-control custom-radio col-2">
                                                <input class="custom-control-input" type="radio" id="rdoShareType3" name="rdoShareType" value="2" {{ ($shareType =="2")? "checked" : "" }}>
                                                <label for="rdoShareType3" class="custom-control-label">멤버공유</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row col-12">
                                        <label for="txtChMainName">상품명(CN)</label>
                                        <input type="text" class="form-control form-control-sm" name="txtChMainName" id="txtChMainName" placeholder="" value="">
                                    </div>
                                    <div class="form-group row col-12">
                                        <label for="txtKrMainName">상품명(KR)</label>
                                        <input type="text" class="form-control form-control-sm" name="txtKrMainName" id="txtKrMainName" value="" placeholder="">
                                    </div>
                                    <div class="row col-12">
                                        <label>금액</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <code style="">상품원가</code>
                                                <div class="input-group input-group-sm">
                                                    <select class="custom-select form-control-border" name="selBasePriceType" id="selBasePriceType">
                                                        <option value="0">통화</option>
                                                        @foreach ($moneyTypes as $moneyType)
                                                        <option value="{{$moneyType->strMoneyCode }}" >{{$moneyType->strMoneyName}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <code style=""><br></code>
                                                <input type="number" class="form-control form-control-sm" min="0" value="0" id="txtBasePrice" name="txtBasePrice" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <code style="">내륙배송비</code>
                                                <div class="input-group input-group-sm">
                                                    <select class="custom-select form-control-border" name="selCountryShippingCostType" id="selCountryShippingCostType">
                                                        <option value="0">통화</option>
                                                        @foreach ($moneyTypes as $moneyType)
                                                        <option value="{{$moneyType->strMoneyCode }}" >{{$moneyType->strMoneyName}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <code style=""><br></code>
                                                <input type="number" class="form-control form-control-sm" min="0" value="0" id="txtCountryShippingCost" name="txtCountryShippingCost" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <code style="">국제배송비</code>
                                                <div class="input-group input-group-sm">
                                                    <select class="custom-select form-control-border" name="selWorldShippingCostType" id="selWorldShippingCostType">
                                                        <option value="0">통화</option>
                                                        @foreach ($moneyTypes as $moneyType)
                                                        <option value="{{$moneyType->strMoneyCode }}" >{{$moneyType->strMoneyName}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <code style=""><br></code>
                                                <input type="number" class="form-control form-control-sm" min="0" value="6000" name="txtWorldShippingCost" id="txtWorldShippingCost" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <label for="scrapURL">무게</label>
                                                <input type="number" class="form-control form-control-sm" min="0" value="0" step="0.1" name="txtWeight" id="txtWeight" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <label for=""> </label>
                                                <div class="input-group input-group-sm mt-2">
                                                    <select class="custom-select form-control-border" name="selWeightType" id="selWeightType">
                                                        <option  value="0">무게</option>
                                                        @foreach ($weightTypes as $weightType)
                                                        <option value="{{$weightType->strWeightCode}}" >{{$weightType->strWeightName}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mt-0 mb-2">
                                            <code>
                                                - 통관시 필요한 값이며, 무게는 자동으로 가져오지 못하는 경우가 있습니다.<br>
                                                - 상세페이지에 무게가 표시되어있지 않은 경우 예상 무게를 적어주시면 됩니다.<br>
                                                - 의류 : 0.2 ~ 0.3kg 정도, 운동화 : 0.3 ~ 0.7kg 정도 기입해 주세요.<br>
                                                - 1Kg이상 상품에 대해서는 추가 비용이 발생되오니 구간별 무게를 확인하시고 입력해 주세요.<br>
                                            </code>
                                        </div>
                                    </div>
                                    <div class="form-group row col-12">
                                        <label for="">추가옵션</label>
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox col-2">
                                                <input class="custom-control-input" type="checkbox" name="chkAdditionalOption1" id="chkAdditionalOption1" onclick="$(this).val(this.checked ? 1 : 0)" value="0">
                                                <label for="chkAdditionalOption1" class="custom-control-label"><i class="fab fa-get-pocket"></i>돼지코(1,000원)</label>
                                            </div>
                                            <div class="custom-control custom-checkbox col-3">
                                                <input class="custom-control-input" type="checkbox" name="chkAdditionalOption2" id="chkAdditionalOption2" onclick="$(this).val(this.checked ? 1 : 0)" value="0">
                                                <label for="chkAdditionalOption2" class="custom-control-label"><i class="fas fa-glass-martini-alt"></i>안전포장(소형 100Cm이하, 2,000원)</label>
                                            </div>
                                            <div class="custom-control custom-checkbox col-2">
                                                <input class="custom-control-input" type="checkbox" name="chkAdditionalOption3" id="chkAdditionalOption3" onclick="$(this).val(this.checked ? 1 : 0)" value="0">
                                                <label for="chkAdditionalOption3" class="custom-control-label"><i class="fas fa-camera"></i>사진요청(1,000원)</label>
                                            </div>
                                            <div class="custom-control custom-checkbox col-2">
                                                <input class="custom-control-input" type="checkbox" name="chkAdditionalOption4" id="chkAdditionalOption4" onclick="$(this).val(this.checked ? 1 : 0)" value="0">
                                                <label for="chkAdditionalOption4" class="custom-control-label"><i class="fas fa-search-plus"></i>디테일검수(2,000원)</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <code>
                                            - 안전포장은 가로x세로x깊이의 합이 100Cm 이하 사이즈 가격 입니다. 사이즈별 안전포장비는 물류비 안내를 참고해 주세요. 물류비안내 바로가기 >
                                            </code>
                                        </div>
                                    </div>
                                    <div class="form-group row col-12">
                                        <label for="txtKeyword">키워드</label>
                                        <input type="text" class="form-control" name="txtKeyword" id="txtKeyword" placeholder=",으로 구분하여 입력해주세요">
                                    </div>
                                    <div class="form-group row col-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-radio col-2">
                                                <input class="custom-control-input" type="radio" id="rdoMultiPriceOptionType1" name="rdoMultiPriceOptionType" value="0">
                                                <label for="rdoMultiPriceOptionType1" class="custom-control-label">다중가격사용안함</label>
                                            </div>
                                            <div class="custom-control custom-radio col-2">
                                                <input class="custom-control-input" type="radio" id="rdoMultiPriceOptionType2" name="rdoMultiPriceOptionType" value="1" checked>
                                                <label for="rdoMultiPriceOptionType2" class="custom-control-label">다중가격사용</label>
                                            </div>
                                            {{-- <div class="custom-control custom-radio col-2">
                                                <input class="custom-control-input" type="radio" id="rdoMultiPriceOptionType3" name="rdoMultiPriceOptionType" value="2" checked="">
                                                <label for="rdoMultiPriceOptionType3" class="custom-control-label">멤버공유</label>
                                            </div> --}}
                                            {{-- <div class="btn-group col-2">
                                                <button type="button" class="btn btn-info btn-flat">
                                                숫자
                                                </button>
                                                <button type="button" class="btn btn-info btn-flat">
                                                A-Z
                                                </button>
                                                <button type="button" class="btn btn-info btn-flat">
                                                단어변경
                                                </button>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive p-0" style="height:300px;">
                                        <style>
                                            td {
                                                padding: 0px !important ;
                                            }
                                            .img-wrapper {
                                                position: relative;
                                            }

                                            .img-responsive {
                                                width: 100%;
                                                height: auto;
                                            }

                                            .img-overlay {
                                                position: absolute;
                                                top: 0;
                                                bottom: 0;
                                                left: 0;
                                                right: 0;
                                                text-align: center;
                                                vertical-align: bottom;
                                            }

                                            .img-overlay:before {
                                                content: ' ';
                                                display: block;
                                                /* adjust 'height' to position overlay content vertically */
                                                height: 50%;
                                            }
                                        </style>
                                        <table class="table table-fixed-header table-bordered text-nowrap table-sm subItemsTable">
                                            <thead class="thead-dark">
                                                <tr class="thead-dark">
                                                    <th style="width:20px !important; text-align:center; vertical-align:center;">옵션사진</th>
                                                    <th style="text-align: center !important;">컬러/패턴</th>
                                                    <th style="text-align: center !important;">사이즈</th>
                                                    <th style="width:20px !important; text-align: center;">옵션원가<br>(CNY)</th>
                                                    <th style="width:20px; text-align: center;">상품원가</th>
                                                    <th style="width:20px ">판매가</th>
                                                    <th style="width:20px ">무게</th>
                                                    <th style="width:20px ">삭제</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 product-image-thumbs" id="divImageContainer">
                                            <div class="p-0 product-image-thumb img-wrapper">
                                                <img class="img-responsive" id="img_0" src="https://via.placeholder.com/300/FFFFFF?text=No%20Image0" alt="Product Image" />
                                                <input type="hidden" id="hid_0" name="txtImage[]" value=""/>
                                                <div class="img-overlay mt-5">
                                                    <div class="btn btn-xs btn-danger btnMainImage" data-id="0"><span style="font-size:10px;">대표</span></div>
                                                    <div class="btn btn-xs btn-success btnSubImage1" data-id="0"><span style="font-size:10px;">첨부1</span></div>
                                                    <div class="btn btn-xs btn-success btnSubImage2" data-id="0"><span style="font-size:10px;">첨부2</span></div>
                                                </div>
                                            </div>
                                            <div class="p-0 product-image-thumb img-wrapper">
                                                <img class="img-responsive" id="img_1" src="https://via.placeholder.com/300/FFFFFF?text=No%20Image1" alt="Product Image" />
                                                <input type="hidden" id="hid_1" name="txtImage[]" value=""/>
                                                <div class="img-overlay mt-5">
                                                    <div class="btn btn-xs btn-danger btnMainImage" data-id="1"><span style="font-size:10px;">대표</span></div>
                                                    <div class="btn btn-xs btn-success btnSubImage1" data-id="1"><span style="font-size:10px;">첨부1</span></div>
                                                    <div class="btn btn-xs btn-success btnSubImage2" data-id="1"><span style="font-size:10px;">첨부2</span></div>
                                                </div>
                                            </div>
                                            <div class="p-0 product-image-thumb img-wrapper">
                                                <img class="img-responsive" id="img_2" src="https://via.placeholder.com/300/FFFFFF?text=No%20Image2" alt="Product Image" />
                                                <input type="hidden" id="hid_2" name="txtImage[]" value=""/>
                                                <div class="img-overlay mt-5">
                                                    <div class="btn btn-xs btn-danger btnMainImage" data-id="2"><span style="font-size:10px;">대표</span></div>
                                                    <div class="btn btn-xs btn-success btnSubImage1" data-id="2"><span style="font-size:10px;">첨부1</span></div>
                                                    <div class="btn btn-xs btn-success btnSubImage2" data-id="2"><span style="font-size:10px;">첨부2</span></div>
                                                </div>
                                            </div>
                                            <div class="p-0 product-image-thumb img-wrapper">
                                                <img class="img-responsive" id="img_3" src="https://via.placeholder.com/300/FFFFFF?text=No%20Image3" alt="Product Image" />
                                                <input type="hidden" id="hid_3" name="txtImage[]" value=""/>
                                                <div class="img-overlay mt-5">
                                                    <div class="btn btn-xs btn-danger btnMainImage" data-id="3"><span style="font-size:10px;">대표</span></div>
                                                    <div class="btn btn-xs btn-success btnSubImage1" data-id="3"><span style="font-size:10px;">첨부1</span></div>
                                                    <div class="btn btn-xs btn-success btnSubImage2" data-id="3"><span style="font-size:10px;">첨부2</span></div>
                                                </div>
                                            </div>
                                            <div class="p-0 product-image-thumb img-wrapper">
                                                <img class="img-responsive" id="img_4" src="https://via.placeholder.com/300/FFFFFF?text=No%20Image4" alt="Product Image" />
                                                <input type="hidden" id="hid_4" name="txtImage[]" value=""/>
                                                <div class="img-overlay mt-5">
                                                    <div class="btn btn-xs btn-danger btnMainImage" data-id="4"><span style="font-size:10px;">대표</span></div>
                                                    <div class="btn btn-xs btn-success btnSubImage1" data-id="4"><span style="font-size:10px;">첨부1</span></div>
                                                    <div class="btn btn-xs btn-success btnSubImage2" data-id="4"><span style="font-size:10px;">첨부2</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mt-3">
                                                <textarea name="summernote" id="summernote">
                                                </textarea>
                                            </div>
                                        </div>
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
    $(document).on({
        ajaxStart: function(){
            $("body").addClass("loading"); 
        },
        ajaxStop: function(){ 
            $("body").removeClass("loading"); 
        }    
    });
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $( "#selBrandName" ).change(function() {
            $('#txtBrandName').val($("#selBrandName  option:selected").html());
        });
        $('#summernote').summernote({
            height: '300px',
        });
        
        $('#summernote').summernote('code', '');
        //delete account
        $('body').on('click', '.btnDelItem', function () {
            var rowId = $(this).attr('data-id');

            $(".subItemsTable tbody").find("#row_" + rowId).remove();
        });
        //	대표이미지 바꾸기
        $('body').on('click', '.btnMainImage', function () {
            var img_id = $(this).attr('data-id');
            var oldMainImage = $('#img_0').attr('src');
            $('#img_0').attr('src', $('#img_'+ img_id).attr('src'));
            $('#hid_0').attr('src', $('#img_'+ img_id).attr('src'));
            $('#img_' + img_id).attr('src', oldMainImage);
            $('#hid_' + img_id).attr('src', oldMainImage);
            return false;
        });	
        // 첨부이미지 1 바꾸기
        $('body').on('click', '.btnSubImage1', function () {
            var img_id = $(this).attr('data-id');
            var oldSubImage = $('#img_1').attr('src');
            $('#img_1').attr('src', $('#img_'+ img_id).attr('src'));
            $('#hid_1').attr('src', $('#img_'+ img_id).attr('src'));
            $('#img_' + img_id).attr('src', oldSubImage);
            $('#hid_' + img_id).attr('src', oldSubImage);
            return false;
        });	
        // 첨부이미지 2 바꾸기
        $('body').on('click', '.btnSubImage2', function () {
            var img_id = $(this).attr('data-id');
            var oldSubImage = $('#img_2').attr('src');
            $('#img_2').attr('src', $('#img_'+ img_id).attr('src'));
            $('#hid_2').attr('src', $('#img_'+ img_id).attr('src'));
            $('#img_' + img_id).attr('src', oldSubImage);
            $('#hid_' + img_id).attr('src', oldSubImage);
            return false;
        });	
        $('body').on('click', '.btnSaveProduct', function () {
            var brandName1 = $('#selBrandName').val();
            var brandName2 = $('#txtBrandName').val();
            if($('#selComeName').val() == 0){
                alert("집하지를 선택해주세요!");
                return false;
            }
            if($('#selBrandName').val() == 0 && $('#txtBrandName').val().trim() == ""){
                alert("브랜드를 입력해주세요!");
                return false;
            }
            if($('#selCategoryName1').val() == 0 && $('#selCategoryName2').val() == 0 && $('#selCategoryName3').val() == 0 && $('#selCategoryName4').val() == 0 && $('#txtCategoryName').val().trim() == ""){
                alert("카테고리를 입력해주세요!");
                return false;
            }
            if($('#txtChMainName').val().trim() == ""){
                alert("상품명(CN) 입력해주세요!");
                return false;
            }
            if($('#txtKrMainName').val().trim() == ""){
                alert("상품명(KR) 입력해주세요!");
                return false;
            }
            if($('#txtBasePrice').val() == 0){
                alert("상품원가를 입력해주세요!");
                return false;
            }
            if($('#txtCountryShippingCost').val() == 0){
                alert("내륙배송비를 입력해주세요!");
                return false;
            }
            if($('#txtWorldShippingCost').val() == 0){
                alert("국제배송비를 입력해주세요!");
                return false;
            }
            if($('#txtWeight').val() == 0){
                alert("무게를 입력해주세요!");
                return false;
            }
            $('#frmScrap').submit();
        });	
        $('body').on('click', '.btnScrapProduct', function () {
            var scrapURL = $("#txtScrapURL").val();
            if(scrapURL == ""){
                alert("URL을 입력해주세요!");
                return false;
            }
            if(!scrapURL.includes("detail.tmall.com") && 
                !scrapURL.includes("item.taobao.com") && 
                !scrapURL.includes("detail.1688.com") && 
                !scrapURL.includes("www.vvic.com")  
                )
            {
                alert("URL을 다시 확인해주세요!");
                return false;
            }
            
            var action = '/scratchProductScrap/scratch';// $("#manageMarketAccount").attr("action");
                $.ajax({
                    url: action,
                    data: {scrapURL},
                    type: "GET",
                    dataType: 'json',
                    success: function ({status, data}) {
                        $("#txtBasePrice").val(data.price);
                        $("#selBasePriceType").val('CNY');
                        $("#selCountryShippingCostType").val('CNY');
                        $("#selWorldShippingCostType").val('KRW');
                        $("#selWeightType").val('kg');
                        $("#txtChMainName").val(data.chMainName);
                        $("#txtKrMainName").val(data.krMainName);
                        $("#txtKeyword").val(data.keyword);
                        $('.subItemsTable tbody').html('');
                        data.items.forEach( (element, index) => {
                            item =`<tr id="row_${index}">
                                        <td class="p-0 m-0" style="width: 3rem">
                                            <img style="width: 3rem;" class="table-product-image p-0 m-0" src="${element.image}">
                                            <input class="p-0" name="txtSubItemImage[]" id="txtSubItemImage[]" type="hidden" value="${element.image}">
                                        </td>
                                        <td>
                                            <input class="p-0" name="txtSubItemKrColorPattern[]" id="txtSubItemKrColorPattern_${index}" style="width:100%" type="text" value="${element.KrColorPattern}">
                                            <br>
                                            <input class="p-0" name="txtSubItemChColorPattern[]" id="txtSubItemChColorPattern_${index}" style="width:100%" type="hidden" value="${element.ChColorPattern}">
                                            <span name="spnSubItemChColorPattern" id="spnSubItemChColorPattern_${index}">${element.ChColorPattern}</span>
                                        </td>
                                        <td>
                                            <input class="p-0" name="txtSubItemKrSize[]" id="txtSubItemKrSize_${index}" style="width:100%" type="text" value="${element.KrSize}">
                                            <br>
                                            <input class="p-0" name="txtSubItemChSize[]" id="txtSubItemChSize_${index}" style="width:100%" type="hidden" value="${element.ChSize}">
                                            <span>${element.ChSize}</span>
                                        </td>
                                        <td style="width:70px !important">
                                            <input style="width:100% !important" name="txtSubItemOptionPrice[]" id="txtSubItemOptionPrice_${index}" class="p-0" type="text" value="${element.price}">
                                        </td>
                                        <td style="width:70px !important">
                                            <input style="width:100% !important" name="txtSubItemBasePrice[]" id="txtSubItemBasePrice_${index}" class="p-0" type="text" value="${element.basePrice}">
                                        </td>
                                        <td style="width:70px !important">
                                            <input style="width:100% !important" name="txtSubItemSalePrice[]" id="txtSubItemSalePrice_${index}" class="p-0" type="text" value="${element.salePrice}">
                                        </td>
                                        <td style="width:70px !important">
                                            <input style="width:100% !important" name="txtSubItemWeight[]" id="txtSubItemWeight_${index}" class="p-0" type="text" value="${element.weight}">
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:void(0);" data-id="${index}" class="btn btn-danger btn-sm btnDelItem">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>`;
                            $('.subItemsTable tbody').append(item);
                        });
                        var imgItem = "";
                        data.images.forEach( (element, index) => {
                            imgItem +=`<div class="p-0 product-image-thumb img-wrapper">
                                        <img class="img-responsive" src="${element}" id="img_${index}" alt="Product Image" />
                                        <input type="hidden" name="txtImage[]" id="hid_${index}" value="${element}"/>
                                        <div class="img-overlay mt-5">
                                            <div class="btn btn-xs btn-danger btnMainImage" data-id="${index}"><span style="font-size:10px;">대표</span></div>
                                            <div class="btn btn-xs btn-success btnSubImage1" data-id="${index}"><span style="font-size:10px;">첨부1</span></div>
                                            <div class="btn btn-xs btn-success btnSubImage2" data-id="${index}"><span style="font-size:10px;">첨부2</span></div>
                                        </div>
                                    </div>`;
                        });
                        $('#divImageContainer').html(imgItem);
                        $('#summernote').summernote('code', data.description);
                    },
                    error: function (data) {
                        alert('스크래핑중 오류가 발생했습니다. 잠시후 다시 시도해주십시오.');
                    }
                });
            });
    });
    
    </script>        
    @endsection
@endsection