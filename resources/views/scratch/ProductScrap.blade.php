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
                                <form method="POST" action="{{route('scratch.ProductScrap')}}">
                                @csrf
                                    <div class="form-group row col-12">
                                        <label for="txtScrapURL">대상URL</label>
                                        <div class="input-group input-group-sm">
                                            <input type="url" class="form-control" name="txtScrapURL" id="txtScrapURL" value="http://www.tmall.asfasdfdasf" placeholder="1688, Taobao의 상품을 URL을 붙여넣기(Ctrl+V)해 주세요.">
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-danger btn-flat">상품수집</button>
                                            </span>
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-warning ">보관</button>
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
                                                        <option value="{{$come->nIdx}}" >[{{$come->strComeCode}}] {{$come->strComeName}}</option>
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
                                                        <option value="{{$category_1->nIdx}}" >{{$category_1->strCategoryName}}</option>
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
                                                        <option value="{{$category_2->nIdx}}" >{{$category_2->strCategoryName}}</option>
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
                                                        <option value="{{$category_3->nIdx}}" >{{$category_3->strCategoryName}}</option>
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
                                                        <option value="{{$category_4->nIdx}}" >{{$category_4->strCategoryName}}</option>
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
                                        <input type="text" class="form-control form-control-sm" name="txtChMainName" id="txtChMainName" placeholder="" value="{{$strChMainName}}">
                                    </div>
                                    <div class="form-group row col-12">
                                        <label for="txtKrMainName">상품명(KR)</label>
                                        <input type="text" class="form-control form-control-sm" name="txtKrMainName" id="txtKrMainName" value="{{$strKrMainName}}" placeholder="">
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
                                                        @foreach ($basePriceTypes as $basePriceType)
                                                        <option value="{{$basePriceType}}" >{{$basePriceType}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <code style=""><br></code>
                                                <input type="number" class="form-control form-control-sm" id="txtBasePrice" name="txtBasePrice" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <code style="">내륙배송비</code>
                                                <div class="input-group input-group-sm">
                                                    <select class="custom-select form-control-border" name="selCountryShippingCostType" id="selCountryShippingCostType">
                                                        <option value="0">통화</option>
                                                        @foreach ($countryShippingCostTypes as $countryShippingCostType)
                                                        <option value="{{$countryShippingCostType}}" >{{$countryShippingCostType}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <code style=""><br></code>
                                                <input type="number" class="form-control form-control-sm" id="txtCountryShippingCost" name="txtCountryShippingCost" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <code style="">국제배송비</code>
                                                <div class="input-group input-group-sm">
                                                    <select class="custom-select form-control-border" name="selWorldShippingCostType" id="selWorldShippingCostType">
                                                        <option value="0">통화</option>
                                                        @foreach ($worldShippingCostTypes as $worldShippingCostType)
                                                        <option value="{{$worldShippingCostType}}" >{{$worldShippingCostType}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <code style=""><br></code>
                                                <input type="number" class="form-control form-control-sm" name="txtWorldShippingCost" id="txtWorldShippingCost" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <label for="scrapURL">무게</label>
                                                <input type="number" class="form-control form-control-sm" name="txtWeight" id="txtWeight" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <label for=""> </label>
                                                <div class="input-group input-group-sm mt-2">
                                                    <select class="custom-select form-control-border" name="selWeightType" id="selWeightType">
                                                        <option  value="0">무게</option>
                                                        @foreach ($weightTypes as $weightType)
                                                        <option value="{{$weightType}}" >{{$weightType}}</option>
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
                                        <input type="text" class="form-control" name="txtKeyword" id="txtKeyword" placeholder="">
                                    </div>
                                    <div class="form-group row col-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-radio col-2">
                                                <input class="custom-control-input" type="radio" id="rdoMultiPriceOptionType1" name="rdoMultiPriceOptionType" value="0">
                                                <label for="rdoMultiPriceOptionType1" class="custom-control-label">다중가격사용안함</label>
                                            </div>
                                            <div class="custom-control custom-radio col-2">
                                                <input class="custom-control-input" type="radio" id="rdoMultiPriceOptionType2" name="rdoMultiPriceOptionType" value="1">
                                                <label for="rdoMultiPriceOptionType2" class="custom-control-label">다중가격사용</label>
                                            </div>
                                            <div class="custom-control custom-radio col-2">
                                                <input class="custom-control-input" type="radio" id="rdoMultiPriceOptionType3" name="rdoMultiPriceOptionType" value="2" checked="">
                                                <label for="rdoMultiPriceOptionType3" class="custom-control-label">멤버공유</label>
                                            </div>
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
                                        <table class="table table-head-fixed table-bordered text-nowrap subItemsTable">
                                            <thead>
                                                <tr>
                                                    <th>옵션사진</th>
                                                    <th>컬러/패턴</th>
                                                    <th>사이즈</th>
                                                    <th style="width:20px;!important">옵션원가<br>(CNY)</th>
                                                    <th style="width:20px;">상품원가</th>
                                                    <th style="width:20px;">판매가</th>
                                                    <th style="width:20px;">무게</th>
                                                    <th style="width:20px;">삭제</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr id="0">
                                                    <td class="p-0 m-0" style="width: 3rem">
                                                        <img style="width: 3rem;" class="table-product-image p-0 m-0" src="{{asset('assets/images/product/image.jpg')}}">
                                                        <input class="p-0" name="txtSubItemImage[]" id="txtSubItemImage[]" type="hidden" value="{{asset('assets/images/product/image.jpg')}}">
                                                    </td>
                                                    <td>
                                                        <input class="p-0" name="txtSubItemKrColorPattern[]" id="txtSubItemKrColorPattern" style="width:100%" type="text" value="네이비 블루">
                                                        <br>
                                                        <input class="p-0" name="txtSubItemChColorPattern[]" id="txtSubItemChColorPattern" style="width:100%" type="hidden" value="藏青色">
                                                        <span name="spnSubItemChColorPattern" id="spnSubItemChColorPattern" >藏青色</span>
                                                    </td>
                                                    <td>
                                                        <input class="p-0" name="txtSubItemKrSize[]" id="txtSubItemKrSize" style="width:100%" type="text" value="S">
                                                        <br>
                                                        <input class="p-0" name="txtSubItemChSize[]" id="txtSubItemChSize" style="width:100%" type="hidden" value="S">
                                                        <span>S</span>
                                                    </td>
                                                    <td style="width:70px !important" >
                                                        <input style="width:100% !important" name="txtSubItemOptionPrice[]" id="txtSubItemOptionPrice" class="p-0" type="text" value="497.50">
                                                    </td>
                                                    <td style="width:70px !important" >
                                                        <input style="width:100% !important" name="txtSubItemBasePrice[]" id="txtSubItemBasePrice" class="p-0" type="text" value="95600">
                                                    </td>
                                                    <td style="width:70px !important" >
                                                        <input style="width:100% !important" name="txtSubItemSalePrice[]" id="txtSubItemSalePrice" class="p-0" type="text" value="136600">
                                                    </td>
                                                    <td style="width:70px !important" >
                                                        <input style="width:100% !important" name="txtSubItemWeight[]" id="txtSubItemWeight" class="p-0" type="text" value="1">
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="javascript:void(0);"  data-id="0" class="btn btn-danger btn-sm btnDelItem">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr id="1">
                                                    <td class="p-0 m-0" style="width: 3rem">
                                                        <img style="width: 3rem;" class="table-product-image p-0 m-0" src="{{asset('assets/images/product/image.jpg')}}">
                                                        <input class="p-0" name="txtSubItemImage[]" id="txtSubItemImage[]" type="hidden" value="{{asset('assets/images/product/image.jpg')}}">
                                                    </td>
                                                    <td>
                                                        <input class="p-0" name="txtSubItemKrColorPattern[]" id="txtSubItemKrColorPattern" style="width:100%" type="text" value="네이비 블루">
                                                        <br>
                                                        <input class="p-0" name="txtSubItemChColorPattern[]" id="txtSubItemChColorPattern" style="width:100%" type="hidden" value="藏青色">
                                                        <span name="spnSubItemChColorPattern" id="spnSubItemChColorPattern" >藏青色</span>
                                                    </td>
                                                    <td>
                                                        <input class="p-0" name="txtSubItemKrSize[]" id="txtSubItemKrSize" style="width:100%" type="text" value="S">
                                                        <br>
                                                        <input class="p-0" name="txtSubItemChSize[]" id="txtSubItemChSize" style="width:100%" type="hidden" value="S">
                                                        <span>S</span>
                                                    </td>
                                                    <td style="width:70px !important" >
                                                        <input style="width:100% !important" name="txtSubItemOptionPrice[]" id="txtSubItemOptionPrice" class="p-0" type="text" value="497.50">
                                                    </td>
                                                    <td style="width:70px !important" >
                                                        <input style="width:100% !important" name="txtSubItemBasePrice[]" id="txtSubItemBasePrice" class="p-0" type="text" value="95600">
                                                    </td>
                                                    <td style="width:70px !important" >
                                                        <input style="width:100% !important" name="txtSubItemSalePrice[]" id="txtSubItemSalePrice" class="p-0" type="text" value="136600">
                                                    </td>
                                                    <td style="width:70px !important" >
                                                        <input style="width:100% !important" name="txtSubItemWeight[]" id="txtSubItemWeight" class="p-0" type="text" value="1">
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="javascript:void(0);" data-id="1" class="btn btn-danger btn-sm btnDelItem">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 product-image-thumbs">
                                            <div class="product-image-thumb img-wrapper">
                                                <img class="img-responsive" src="{{asset('assets/images/product/image.jpg')}}" alt="Product Image" />
                                                <input type="hidden" name="txtImage[]" value="{{asset('assets/images/product/image.jpg')}}"/>
                                                <div class="img-overlay">
                                                    <button class="btn btn-xs btn-success"><span style="font-size:10px;">대표</span></button>
                                                    <button class="btn btn-xs btn-success"><span style="font-size:10px;">첨부1</span></button>
                                                    <button class="btn btn-xs btn-success"><span style="font-size:10px;">첨부2</span></button>
                                                </div>
                                            </div>
                                            <div class="product-image-thumb img-wrapper">
                                                <img class="img-responsive" src="{{asset('assets/images/product/image.jpg')}}" alt="Product Image" />
                                                <input type="hidden" name="txtImage[]" value="{{asset('assets/images/product/image.jpg')}}"/>
                                                <div class="img-overlay">
                                                    <button class="btn btn-xs btn-success"><span style="font-size:10px;">대표</span></button>
                                                    <button class="btn btn-xs btn-success"><span style="font-size:10px;">첨부1</span></button>
                                                    <button class="btn btn-xs btn-success"><span style="font-size:10px;">첨부2</span></button>
                                                </div>
                                            </div>
                                            <div class="product-image-thumb img-wrapper">
                                                <img class="img-responsive" src="{{asset('assets/images/product/image.jpg')}}" alt="Product Image" />
                                                <input type="hidden" name="txtImage[]" value="{{asset('assets/images/product/image.jpg')}}"/>
                                                <div class="img-overlay">
                                                    <button class="btn btn-xs btn-success"><span style="font-size:10px;">대표</span></button>
                                                    <button class="btn btn-xs btn-success"><span style="font-size:10px;">첨부1</span></button>
                                                    <button class="btn btn-xs btn-success"><span style="font-size:10px;">첨부2</span></button>
                                                </div>
                                            </div>
                                            <div class="product-image-thumb img-wrapper">
                                                <img class="img-responsive" src="{{asset('assets/images/product/image.jpg')}}" alt="Product Image" />
                                                <input type="hidden" name="txtImage[]" value="{{asset('assets/images/product/image.jpg')}}"/>
                                                <div class="img-overlay">
                                                    <button class="btn btn-xs btn-success"><span style="font-size:10px;">대표</span></button>
                                                    <button class="btn btn-xs btn-success"><span style="font-size:10px;">첨부1</span></button>
                                                    <button class="btn btn-xs btn-success"><span style="font-size:10px;">첨부2</span></button>
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
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#summernote').summernote({
            height: '300px',
        });
        var html=`
            <div style="text-align:center;"><div style="padding-bottom:20px;"><p>[조끼, S]</p>
            <p><img src="https://img.alicdn.com/imgextra/i1/1695868671/TB2Y.miaiGO.eBjSZFjXXcU9FXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[조끼, M]</p>
            <p><img src="https://img.alicdn.com/imgextra/i1/1695868671/TB2Y.miaiGO.eBjSZFjXXcU9FXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[조끼, L]</p>
            <p><img src="https://img.alicdn.com/imgextra/i1/1695868671/TB2Y.miaiGO.eBjSZFjXXcU9FXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[조끼, XL]</p>
            <p><img src="https://img.alicdn.com/imgextra/i1/1695868671/TB2Y.miaiGO.eBjSZFjXXcU9FXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[조끼, 2XL]</p>
            <p><img src="https://img.alicdn.com/imgextra/i1/1695868671/TB2Y.miaiGO.eBjSZFjXXcU9FXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[조끼, 3XL]</p>
            <p><img src="https://img.alicdn.com/imgextra/i1/1695868671/TB2Y.miaiGO.eBjSZFjXXcU9FXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[셔츠, S]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB2D1IrX89J.eBjy0FoXXXyvpXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[셔츠, M]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB2D1IrX89J.eBjy0FoXXXyvpXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[셔츠, L]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB2D1IrX89J.eBjy0FoXXXyvpXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[셔츠, XL]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB2D1IrX89J.eBjy0FoXXXyvpXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[셔츠, 2XL]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB2D1IrX89J.eBjy0FoXXXyvpXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[셔츠, 3XL]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB2D1IrX89J.eBjy0FoXXXyvpXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[소송, S]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB2XUKkakWM.eBjSZFhXXbdWpXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[소송, M]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB2XUKkakWM.eBjSZFhXXbdWpXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[소송, L]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB2XUKkakWM.eBjSZFhXXbdWpXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[소송, XL]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB2XUKkakWM.eBjSZFhXXbdWpXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[소송, 2XL]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB2XUKkakWM.eBjSZFhXXbdWpXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[소송, 3XL]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB2XUKkakWM.eBjSZFhXXbdWpXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[바지, S]</p>
            <p><img src="https://img.alicdn.com/imgextra/i1/1695868671/TB29pejaiGO.eBjSZFjXXcU9FXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[바지, M]</p>
            <p><img src="https://img.alicdn.com/imgextra/i1/1695868671/TB29pejaiGO.eBjSZFjXXcU9FXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[바지, L]</p>
            <p><img src="https://img.alicdn.com/imgextra/i1/1695868671/TB29pejaiGO.eBjSZFjXXcU9FXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[바지, XL]</p>
            <p><img src="https://img.alicdn.com/imgextra/i1/1695868671/TB29pejaiGO.eBjSZFjXXcU9FXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[바지, 2XL]</p>
            <p><img src="https://img.alicdn.com/imgextra/i1/1695868671/TB29pejaiGO.eBjSZFjXXcU9FXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[바지, 3XL]</p>
            <p><img src="https://img.alicdn.com/imgextra/i1/1695868671/TB29pejaiGO.eBjSZFjXXcU9FXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[셔츠 바지, S]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB21rSmaheK.eBjSZFuXXcT4FXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[셔츠 바지, M]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB21rSmaheK.eBjSZFuXXcT4FXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[셔츠 바지, L]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB21rSmaheK.eBjSZFuXXcT4FXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[셔츠 바지, XL]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB21rSmaheK.eBjSZFuXXcT4FXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[셔츠 바지, 2XL]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB21rSmaheK.eBjSZFuXXcT4FXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[셔츠 바지, 3XL]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB21rSmaheK.eBjSZFuXXcT4FXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[조끼 바지, S]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB2shClaX5N.eBjSZFvXXbvMFXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[조끼 바지, M]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB2shClaX5N.eBjSZFvXXbvMFXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[조끼 바지, L]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB2shClaX5N.eBjSZFvXXbvMFXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[조끼 바지, XL]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB2shClaX5N.eBjSZFvXXbvMFXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[조끼 바지, 2XL]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB2shClaX5N.eBjSZFvXXbvMFXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[조끼 바지, 3XL]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB2shClaX5N.eBjSZFvXXbvMFXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[셔츠, 조끼 및 바지, S]</p>
            <p><img src="https://img.alicdn.com/imgextra/i3/1695868671/TB2vFynaoOO.eBjSZFLXXcxmXXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[셔츠, 조끼 및 바지, M]</p>
            <p><img src="https://img.alicdn.com/imgextra/i3/1695868671/TB2vFynaoOO.eBjSZFLXXcxmXXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[셔츠, 조끼 및 바지, L]</p>
            <p><img src="https://img.alicdn.com/imgextra/i3/1695868671/TB2vFynaoOO.eBjSZFLXXcxmXXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[셔츠, 조끼 및 바지, XL]</p>
            <p><img src="https://img.alicdn.com/imgextra/i3/1695868671/TB2vFynaoOO.eBjSZFLXXcxmXXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[셔츠, 조끼 및 바지, 2XL]</p>
            <p><img src="https://img.alicdn.com/imgextra/i3/1695868671/TB2vFynaoOO.eBjSZFLXXcxmXXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[셔츠, 조끼 및 바지, 3XL]</p>
            <p><img src="https://img.alicdn.com/imgextra/i3/1695868671/TB2vFynaoOO.eBjSZFLXXcxmXXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[정장 셔츠 조끼 바지, S]</p>
            <p><img src="https://img.alicdn.com/imgextra/i2/1695868671/TB2QXSmalyN.eBjSZFgXXXmGXXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[정장 셔츠 조끼 바지, M]</p>
            <p><img src="https://img.alicdn.com/imgextra/i2/1695868671/TB2QXSmalyN.eBjSZFgXXXmGXXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[정장 셔츠 조끼 바지, L]</p>
            <p><img src="https://img.alicdn.com/imgextra/i2/1695868671/TB2QXSmalyN.eBjSZFgXXXmGXXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[정장 셔츠 조끼 바지, XL]</p>
            <p><img src="https://img.alicdn.com/imgextra/i2/1695868671/TB2QXSmalyN.eBjSZFgXXXmGXXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[정장 셔츠 조끼 바지, 2XL]</p>
            <p><img src="https://img.alicdn.com/imgextra/i2/1695868671/TB2QXSmalyN.eBjSZFgXXXmGXXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[정장 셔츠 조끼 바지, 3XL]</p>
            <p><img src="https://img.alicdn.com/imgextra/i2/1695868671/TB2QXSmalyN.eBjSZFgXXXmGXXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[정장 조끼 셔츠 하프 스커트 바지, S]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB2SLSgafOM.eBjSZFqXXculVXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[정장 조끼 셔츠 하프 스커트 바지, M]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB2SLSgafOM.eBjSZFqXXculVXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[정장 조끼 셔츠 하프 스커트 바지, L]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB2SLSgafOM.eBjSZFqXXculVXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[정장 조끼 셔츠 하프 스커트 바지, XL]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB2SLSgafOM.eBjSZFqXXculVXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[정장 조끼 셔츠 하프 스커트 바지, 2XL]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB2SLSgafOM.eBjSZFqXXculVXa_!!1695868671.jpg_600x600q90.jpg"></p></div><div style="padding-bottom:20px;"><p>[정장 조끼 셔츠 하프 스커트 바지, 3XL]</p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB2SLSgafOM.eBjSZFqXXculVXa_!!1695868671.jpg_600x600q90.jpg"></p></div><p><img src="https://assets.alicdn.com/kissy/1.0.0/build/imglazyload/spaceball.gif"></p>
            <p><img src="https://img.alicdn.com/imgextra/i2/1695868671/TB23.IlXY1J.eBjSspnXXbUeXXa_!!1695868671.jpg"></p>
            <p><img src="https://img.alicdn.com/imgextra/i3/1695868671/TB26t.kX4aJ.eBjSsziXXaJ_XXa_!!1695868671.jpg"></p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB2ykckX9iJ.eBjSszfXXa4bVXa_!!1695868671.jpg"></p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB2OGakaiGO.eBjSZFjXXcU9FXa_!!1695868671.jpg"></p>
            <p><img src="https://assets.alicdn.com/kissy/1.0.0/build/imglazyload/spaceball.gif"></p>
            <p><img src="https://img.alicdn.com/imgextra/i1/1695868671/TB2701.exTI8KJjSspiXXbM4FXa_!!1695868671.jpg"></p>
            <p><img src="https://img.alicdn.com/imgextra/i3/1695868671/TB2rJ9nafSM.eBjSZFNXXbgYpXa_!!1695868671.jpg"></p>
            <p><img src="https://img.alicdn.com/imgextra/i1/1695868671/TB2ji9pamiK.eBjSZFyXXaS4pXa_!!1695868671.jpg"></p>
            <p><img src="https://img.alicdn.com/imgextra/i3/1695868671/TB2SFWmakWM.eBjSZFhXXbdWpXa_!!1695868671.jpg"></p>
            <p><img src="https://img.alicdn.com/imgextra/i3/1695868671/TB2809nafSM.eBjSZFNXXbgYpXa_!!1695868671.jpg"></p>
            <p><img src="https://img.alicdn.com/imgextra/i2/1695868671/TB2rSuhahaK.eBjSZFwXXXjsFXa_!!1695868671.jpg"></p>
            <p><img src="https://assets.alicdn.com/kissy/1.0.0/build/imglazyload/spaceball.gif"></p>
            <p><img src="https://img.alicdn.com/imgextra/i3/1695868671/TB2EQChajm2.eBjSZFtXXX56VXa_!!1695868671.jpg"></p>
            <p><img src="https://img.alicdn.com/imgextra/i1/1695868671/TB2rgqhafOM.eBjSZFqXXculVXa_!!1695868671.jpg"></p>
            <p><img src="https://img.alicdn.com/imgextra/i3/1695868671/TB2Kmuiak1M.eBjSZFFXXc3vVXa_!!1695868671.jpg"></p>
            <p><img src="https://img.alicdn.com/imgextra/i3/1695868671/TB2d6snX9qJ.eBjy1zbXXbx8FXa_!!1695868671.jpg"></p>
            <p><img src="https://img.alicdn.com/imgextra/i3/1695868671/TB2YpEnX9iJ.eBjSspiXXbqAFXa_!!1695868671.jpg"></p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB2ZlgkX9iJ.eBjSszfXXa4bVXa_!!1695868671.jpg"></p>
            <p><img src="https://img.alicdn.com/imgextra/i2/1695868671/TB2.8kpX3SI.eBjy1XcXXc1jXXa_!!1695868671.jpg"></p>
            <p><img src="https://assets.alicdn.com/kissy/1.0.0/build/imglazyload/spaceball.gif"></p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB2AGZmX4mJ.eBjy0FhXXbBdFXa_!!1695868671.jpg"></p>
            <p><img src="https://img.alicdn.com/imgextra/i4/1695868671/TB22ywlXZeJ.eBjy0FiXXXqapXa_!!1695868671.jpg"></p></div>
        `;
        $('#summernote').summernote('code', html);
        //delete account
        $('body').on('click', '.btnDelItem', function () {
                var market_id = $(".subItemsTable tbody .selectedMarket").attr('id');
                var account_id = $(this).attr('data-id');
                $.get('operationOpenMarketManage/' + market_id +'/AccountDelete/' + account_id, function ({status, data}) {
                    //$(".marketAccountsTable tbody tr").removeClass("selectedAccount");
                    $(".subItemsTable tbody").find("#" + account_id).remove();
                })
            });	
    });
    </script>        
    @endsection
@endsection