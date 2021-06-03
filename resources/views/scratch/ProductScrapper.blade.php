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
            <form method="POST" id="frmScrap" action="{{route('scratch.ProductScrap')}}">
            @csrf
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0" style="font-weight: bold;">Step 1. 상품수집</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-2 text-sm-right">상품주소</label>
                            <div class="form-group col-sm-8">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">web</div>
                                    </div>
                                    <input type="text" name="txtScrapURL" id="txtScrapURL" class="form-control" placeholder="상품주소">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-primary btn-flat btnScrapProduct"><i class="fas fa-globe-americas"></i>상품수집</button>
                                    </span>
                                    
                                </div>
                                <div class="row">
                                    <span class="badge badge-success mt-2 ml-3">타오바오</span>
                                    <span class="badge badge-success mt-2 ml-1">티몰</span>
                                    <span class="badge badge-success mt-2 ml-1">비비크</span>
                                    <span class="badge badge-primary mt-2 ml-1">1688 (정액제전용)</span>
                                </div>
                                <span class="text-success ml-1"> 수집완료 후 주소수정하여 저장 가능</span>
                            </div>
                            <div class="form-group col-sm-2">
                                <button class="btn btn-sm btn-outline-success">무수집등록</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0" style="font-weight: bold;">Step 2. 카테고리</h5>
                    </div>
                    <div class="card-body">
                        <fieldset>
                            <div class="form-group row mb-0">
                                    <label class="col-form-label col-sm-2 text-sm-right">등록진행마켓</label>
                                <div class="col-sm-10 row">
                                        <div class="form-group mt-1 mb-1 ml-3 mr-1 row">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="customSwitchdoAll">
                                                <label class="custom-control-label" for="customSwitchdoAll">상품저장만</label>
                                            </div>
                                        </div>
                                        <div class="form-group mt-1 mb-1 ml-3 row">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="customSwitchdoCP">
                                                <label class="custom-control-label" for="customSwitchdoCP">쿠팡</label>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label col-sm-2 text-sm-right"></label>
                                <span class="text-success"> 내설정에 등록된 마켓</span>
                            </div>
                        </fieldset>

                        <fieldset style="color:" >
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-2 text-sm-right">카테고리 통합검색</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="txtCategoryName[]" cate-id="0" class="form-control" placeholder="통합검색">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary btnSearchCategory" type="button"><i class="fas fa-search"></i> 검색</button>
                                        </div>
                                    </div>
                                    <div class="list-group">
                                        <small>
                                        </small>
                                    </div>

                                </div>
                                <button type="button" class="btn btn-xs m-1 btn-outline-success" onclick="window.open('{{route('scratch.ProductScrapScratch.categoryList.Solution')}}','전체카테고리','width=900,height=900,location=no,status=no,scrollbars=no')"> 전체보기</button>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right"></label>
                                <span class="text-success"> 어린이제품, 식품, 북마켓 등 일부마켓 특수권한 필요 카테고리 주의</span>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right">스마트스토어</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="txtCategoryName[]" cate-id="1" class="form-control text-sm check-size" placeholder="미설정">
                                        <div class="input-group-append">
                                            <button class="btn btn-success btnSearchCategory" type="button"><i class="fas fa-search"></i> 검색</button>
                                        </div>
                                    </div>
                                    <div class="list-group">
                                        <small>
                                        </small>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-xs m-1 btn-outline-success" onclick="window.open('{{route('scratch.ProductScrapScratch.categoryList.SmartStore')}}','전체카테고리','width=900,height=900,location=no,status=no,scrollbars=no')"> 전체보기</button>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right">쿠팡</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="txtCategoryName[]" cate-id="2" class="form-control text-sm" placeholder="미설정">
                                        <div class="input-group-append">
                                            <button class="btn btn-success btnSearchCategory" type="button"><i class="fas fa-search"></i> 검색</button>
                                        </div>
                                    </div>
                                    <div class="list-group">
                                        <small>
                                        </small>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-xs m-1 btn-outline-success" onclick="window.open('{{route('scratch.ProductScrapScratch.categoryList.Coupang')}}','전체카테고리','width=900,height=900,location=no,status=no,scrollbars=no')"> 전체보기</button>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right">11번가 글로벌</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="txtCategoryName[]" cate-id="3" class="form-control text-sm" placeholder="미설정">
                                        <div class="input-group-append">
                                            <button class="btn btn-success btnSearchCategory" type="button"><i class="fas fa-search"></i> 검색</button>
                                        </div>
                                    </div>
                                    <div class="list-group">
                                        <small>
                                        </small>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-xs m-1 btn-outline-success" onclick="window.open('{{route('scratch.ProductScrapScratch.categoryList.11thGlobal')}}','전체카테고리','width=900,height=900,location=no,status=no,scrollbars=no')"> 전체보기</button>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right">11번가 일반</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="txtCategoryName[]" cate-id="4" class="form-control text-sm" placeholder="미설정">
                                        <div class="input-group-append">
                                            <button class="btn btn-success btnSearchCategory" type="button"><i class="fas fa-search"></i> 검색</button>
                                        </div>
                                    </div>
                                    <div class="list-group">
                                        <small>
                                        </small>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-xs m-1 btn-outline-success" onclick="window.open('{{route('scratch.ProductScrapScratch.categoryList.11thNormal')}}','전체카테고리','width=900,height=900,location=no,status=no,scrollbars=no')"> 전체보기</button>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right">옥션</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="txtCategoryName[]" cate-id="5" class="form-control text-sm" placeholder="미설정">
                                        <div class="input-group-append">
                                            <button class="btn btn-success btnSearchCategory" type="button"><i class="fas fa-search"></i> 검색</button>
                                        </div>
                                    </div>
                                    <div class="list-group">
                                        <small>
                                        </small>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-xs m-1 btn-outline-success" onclick="window.open('{{route('scratch.ProductScrapScratch.categoryList.Auction')}}','전체카테고리','width=900,height=900,location=no,status=no,scrollbars=no')"> 전체보기</button>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right">G마켓</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="txtCategoryName[]" cate-id="6" class="form-control text-sm" placeholder="미설정">
                                        <div class="input-group-append">
                                            <button class="btn btn-success btnSearchCategory" type="button"><i class="fas fa-search"></i> 검색</button>
                                        </div>
                                    </div>
                                    <div class="list-group">
                                        <small>
                                        </small>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-xs m-1 btn-outline-success" onclick="window.open('{{route('scratch.ProductScrapScratch.categoryList.Gmarket')}}','전체카테고리','width=900,height=900,location=no,status=no,scrollbars=no')"> 전체보기</button>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right">인터파크</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="txtCategoryName[]" cate-id="7" class="form-control text-sm" placeholder="미설정">
                                        <div class="input-group-append">
                                            <button class="btn btn-success btnSearchCategory" type="button"><i class="fas fa-search"></i> 검색</button>
                                        </div>
                                    </div>
                                    <div class="list-group">
                                        <small>
                                        </small>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-xs m-1 btn-outline-success" onclick="window.open('{{route('scratch.ProductScrapScratch.categoryList.InterPark')}}','전체카테고리','width=900,height=900,location=no,status=no,scrollbars=no')"> 전체보기</button>
                            </div>
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-2 text-sm-right">위메프</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="txtCategoryName[]" cate-id="8" class="form-control text-sm" placeholder="미설정">
                                        <div class="input-group-append">
                                            <button class="btn btn-success btnSearchCategory" type="button"><i class="fas fa-search"></i> 검색</button>
                                        </div>
                                    </div>
                                    <div class="list-group">
                                        <small>
                                        </small>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-xs m-1 btn-outline-success" onclick="window.open('{{route('scratch.ProductScrapScratch.categoryList.WeMakePrice')}}','전체카테고리','width=900,height=900,location=no,status=no,scrollbars=no')"> 전체보기</button>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right"></label>
                                <span class="text-success">검색 후 리스트 선택하셔야 정상동작합니다</span>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0" style="font-weight: bold;">Step 3. 상품 기본정보</h5>
                    </div>
                    <div class="card-body">
                        <fieldset >
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right">상품명(CN)</label>
                                <div class="col-sm-8">
                                    <input  type="text" name="txtChMainName" id="txtChMainName" class="form-control form-control-sm" placeholder="상품명">
                                </div>
                                {{-- <div class="col-sm-2 mt-1">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="customSwitchTr">
                                        <label class="custom-control-label" for="customSwitchTr">번역</label>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right">상품명(KO)</label>
                                <div class="col-sm-8">
                                    <input type="text" name="txtKrMainName" id="txtKrMainName" class="form-control form-control-sm" placeholder="상품명">
                                    <span class="text-success" id="titleSizeInfo"></span>
                                    <span class="text-success"> (특수문자 사용불가)</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right"></label>
                                <div class="col-sm-5">
                                    <label>50byte 제한 마켓 상품명 (자동입력)</label>
                                    <input type="text" name="txtKrSubName" id="txtKrSubName" class="form-control form-control-sm" placeholder="50byte 상품명">
                                </div>
                            </div>
                            
                        </fieldset>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0" style="font-weight: bold;">Step 4. 가격설정</h5>
                    </div>
                    <div class="card-body">
                        <fieldset>
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-2 text-sm-right">상품가격</label>
                                <div class="col-sm-10 form-group row mb-0">
                                    <div class="col-sm-4">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">₩</div>
                                            </div>
                                            <input type="text" name="txtProductPrice" id="txtProductPrice" class="form-control" placeholder="Input">
                                            {{-- <div class="input-group-append">
                                                <button class="btn btn-primary" type="button" id="btnReCalculate">다시계산</button>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="col-sm-2 mt-2">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitchPr">
                                            <label class="custom-control-label" for="customSwitchPr">100원<i class="fas fa-arrow-up"></i></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right"> </label>
                                <div class="col-sm-10">
                                    <span class="text-success">아래 원가, 환율, 마진 등 상품가 항목들 수정 후 다시계산 버튼을 누르면 저장된 계산식으로 재계산 됩니다.</span>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-form-label col-sm-2 text-sm-right"></label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        {{-- <div class="form-group col-md-3">
                                            <label class="form-label">원가 (할인전정상가)</label>
                                            <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-globe-americas"></i></div>
                                                </div>
                                                <input type="text" name="txtBasePrice" id="txtBasePrice" class="form-control" value="0" placeholder="원가">
                                                <div class="input-group-append">
                                                    <button class="btn btn-success" id="btnCalWithBasePrice" type="button"> 원가적용</button>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="form-group col-md-3">
                                            <label class="form-label">원가(할인가)</label>
                                            <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-globe-americas"></i></div>
                                                </div>
                                                <input type="text" name="txtDiscountPrice" id="txtDiscountPrice" class="form-control" value="0" placeholder="할인가">
                                                <div class="input-group-append">
                                                    <button class="btn btn-success" id="btnCalWithDiscount" type="button"> 할인가적용</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="form-label">오늘 환율</label>
                                            <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">₩</div>
                                                </div>
                                                <input type="text" name="txtExchangeRate" id="txtExchangeRate" value="173" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="form-label">예상수익 (개당)</label>
                                            <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">₩</div>
                                                </div>
                                                <input type="text" name="txtExpectedRevenue" id="txtExpectedRevenue" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-form-label col-sm-2 text-sm-right"></label>
                                <div class="col-sm-9">
                                    <div class="alert bg-light">
                                        <div class="alert-message">
                                            <span class="badge badge-success">내설정 Load 완료 (상품별 수정가능)</span>
                                            <br><br>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label class="form-label">마진율</label>
                                                    <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">%</div>
                                                        </div>
                                                        <input type="text" name="txtMarginRate" id="txtMarginRate" value="10" class="form-control" placeholder="Input">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="form-label">판매마켓 수수료</label>
                                                    <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">%</div>
                                                        </div>
                                                        <input type="text" name="txtSellerMarketChargeRate" id="txtSellerMarketChargeRate" value="30" class="form-control" placeholder="Input">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="form-label">구매마켓 수수료</label>
                                                    <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">%</div>
                                                        </div>
                                                        <input type="text" name="txtBuyerMarketChargeRate" id="txtBuyerMarketChargeRate"  value="5" class="form-control" placeholder="Input">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="form-label">해외배송비(배대지)</label>
                                                    <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">₩</div>
                                                        </div>
                                                        <input type="text" name="txtOverSeaDeliveryCharge" id="txtOverSeaDeliveryCharge" value="6000" class="form-control" placeholder="Input">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-sm-12">
                                                    <div class="form-group mb-0 ">
                                                        <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">계산식</div>
                                                            </div>
                                                            <input type="text" name="txtFunction" id="txtFunction" value="((환율*원가*(1+구매수수료))+해외배송비)*(1+판매수수료)*(1+마진율)" class="form-control" placeholder="내설정값 없음">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-success btnBasicFunction" type="button">기본식 입력</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <span class="text-success mt-2">
                                                        계산식은 다음 문자들로만 구성 가능합니다.
                                                        <span class="badge badge-success">숫자 1 ~ 9</span> <span class="badge badge-success">+ - * / ( )</span>
                                                        <span class="badge badge-success">원가</span> <span class="badge badge-success">환율</span>
                                                        <span class="badge badge-success">구매수수료</span> <span class="badge badge-success">해외배송비</span>
                                                        <span class="badge badge-success">판매수수료</span> <span class="badge badge-success">마진율</span>
                                                        <br> ex) ((환율*원가*(1+구매수수료))+해외배송비)*(1+판매수수료)*(1+마진율)
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <label class="col-form-label col-sm-2 text-sm-right">배송설정</label>
                                <div class="col-sm-9">
                                    <div class="alert bg-light">
                                        <div class="alert-message">
                                            <span class="badge badge-success">내설정 Load 완료 (상품별 수정가능)</span>
                                            <br><br>
                                            <div class="form-group row mb-0">
                                                <div class="form-group col-md-3 mb-0">
                                                    <label>배송비</label>
                                                    <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">₩</div>
                                                        </div>
                                                        <input type="text" name="txtDeliveryCharge" id="txtDeliverCharge" value="0" class="form-control">
                                                    </div>

                                                </div>
                                                <div class="form-group col-md-3 mb-0">
                                                    <label>반품배송비</label>
                                                    <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">₩</div>
                                                        </div>
                                                        <input type="text" name="txtReturnDeliveryCharge" id="txtReturnDeliveryCharge" value="25000" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3 mb-0">
                                                    <label>교환배송비</label>
                                                    <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">₩</div>
                                                        </div>
                                                        <input type="text" name="txtExchangeDeliveryCharge" id="txtExchangeDeliveryCharge" value="25000" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3 mb-0">
                                                    <label class="form-label">옵션별 재고량</label>
                                                    <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">개</div>
                                                        </div>
                                                        <input type="text" name="txtOptionStock" id="txtOptionStock" value="0" class="form-control" placeholder="Input">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <span class="col-md-9 text-success mt-0"> 판매가 50% 이하, 인터파크 5만원 이하</span>
                                                <span class="col-md-3 text-success mt-0"> 총수량 99,999 이하</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label>쿠팡/ESM 판매가에 개별배송비 적용방법 (상품등록시 1회성 입력값)</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="custom-control custom-radio ml-2 mt-2">
                                            <input name="custom-radio" type="radio" class="custom-control-input">
                                            <span class="custom-control-label pt-1">쿠팡/ESM 판매가에 배송비 합산. 최대구매수량제한 없음</span>
                                        </label>
                                        <label class="custom-control custom-radio ml-4 mt-2">
                                            <input name="custom-radio" type="radio" class="custom-control-input">
                                            <span class="custom-control-label pt-1">쿠팡/ESM 최대구매수량제한</span>
                                        </label>
                                        <input type="text" class="form-control form-control-sm col-md-1 ml-2" placeholder="개">
                                        <label class="ml-1 mt-2">
                                            <span class="pt-1">개</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <label class="col-form-label col-sm-2 text-sm-right">옵션설정</label>
                                <div class="col-sm-9">
                                <fieldset>
                                    <div class="form-group row">
                                        <div class="col-md-12 form-group row">
                                            <div class="col-sm-10">
                                                <div class="alert-message bg-light">
                                                    {{-- <button type="button" class="btn btn-info">
                                                        <i class="fas fa-sync-alt"></i> 옵션 관련 입력한 기준가격 모두보기 (판매가, 스스 ESM 50% 추가금)
                                                    </button>
                                                    <br>
                                                    <span class="text-success"> 조회전용. 기준가격들 수정 시 버튼 재클릭해야 결과값 갱신됨</span>
                                                    <hr> --}}
                                                    <fieldset >
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <label class="form-label">상품 기본가(판매가)</label>
                                                                <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">₩</div>
                                                                    </div>
                                                                    <input type="text" id="txtOptionSellPrice" name="txtOptionSellPrice" class="form-control" placeholder="Input">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="form-label">상품 기본가 원가</label>
                                                                <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">현지화</div>
                                                                    </div>
                                                                    <input type="text" id="txtOptionBasePrice" name="txtOptionBasePrice" class="form-control" placeholder="Input">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="form-label">상품 기본가 할인가</label>
                                                                <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">현지화</div>
                                                                    </div>
                                                                    <input type="text" id="txtOptionDiscountPrice" name="txtOptionDiscountPrice" class="form-control" placeholder="Input">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <label class="form-label">스스 50% 추가금</label>
                                                                <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">₩</div>
                                                                    </div>
                                                                    <input type="text" id="txtOptionSSPrice" name="txtOptionSSPrice" class="form-control" placeholder="Input">
                                                                </div>
                                                                <span class="text-success">(판매가*마켓가중치+할인) / 2</span>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="form-label">ESM 50% 추가금</label>
                                                                <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">₩</div>
                                                                    </div>
                                                                    <input type="text" id="txtOptionESMPrice" name="txtOptionESMPrice" class="form-control" placeholder="Input">
                                                                </div>
                                                                <span class="text-success">(판매가*마켓가중치+할인+개별배송비) / 2</span>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="form-label">판매가 할인</label>
                                                                <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">₩</div>
                                                                    </div>
                                                                <input type="text" id="txtOptionSellDiscountPrice" name="txtOptionSellDiscountPrice" class="form-control" placeholder="Input">
                                                                </div>
                                                                <span class="text-success">우측 상세설정란에서 설정</span>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="form-label">ESM 합산 개별배송비</label>
                                                                <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">₩</div>
                                                                    </div>
                                                                        <input type="text" id="txtOptionESMDeliveryCharge" name="txtOptionESMDeliveryCharge" class="form-control" placeholder="Input">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12 form-group row mb-0">
                                                    <div class="form-group col-md-4 mb-0 ml-0">
                                                            <div class="btn-group btn-group-sm" role="group">
                                                                    <button class="btn btn-success" type="button">옵션원가 적용</button>
                                                                    <button class="btn btn-outline-success" type="button">&nbsp;할인가 적용&nbsp;</button>
                                                            </div>
                                                    </div>
                                                <div class="input-group input-group-sm input-group-sm col-md-4">
                                                    <input type="text" class="form-control">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-success" type="button"> 옵션마진 재계산</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <hr>
                                            </div> --}}
                                            <span class="text-success ml-3">
                                                옵션명 - 한글20자 특수문자 불가,   옵션값 - 한글25자 특수문자 불가,   옵션 조합형 기준 100개 이하<br>
                                                옵션추가금 - 판매가의 50% 이내, 10원단위, 0원 기본옵션 필수<br>
                                                옵션의 원가, 할인가는 총액기준입니다. 필요시 할인가 수정 후 위 '할인가 적용' 버튼을 누르면 계산식(해외배송비 제외)에 의해 계산됩니다.<br>
                                                아래 옵션추가금 옆 입력필드에 금액 입력 후 버튼을 누르면 일괄 합계산됩니다.
                                            </span>
                                            <div class="form-group col-md-12 ml-1 mt-1">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitchOptImgCP">
                                                    <label class="custom-control-label" for="customSwitchOptImgCP">옵션이미지 적용 - 쿠팡만 적용가능, 옵션이미지를 각 옵션상품별 대표이미지로 적용</label>
                                                </div>
                                                <span class="text-success"> jpg, png, 2MB 이하 파일 업로드 가능, 본 기능이 ON 이지만 이미지가 없을 시 자동 비적용 됩니다.</span>
                                            </div>
                                            <div id="divOptionField" class="row">
                                                <div class="col-sm-12">
                                                    <div class="card bg-secondary-light">
                                                        <div class="card-body alert alert-dismissible">
                                                            <label class="form-label font-weight-bold">옵션 1</label>
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                            <br>
                                                            <div class="form-group row">
                                                                <div class="input-group input-group-sm m-3">
                                                                    <input type="text" class="form-control text-center col-md-3 font-weight-bold" value="옵션명" readonly="">
                                                                    <input type="text" name="txtOptionAttr[]" class="form-control text-center">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-12 row">
                                                                    <div class="col-sm-6 row">
                                                                        <div class="col-sm-3 p-0 text-center">
                                                                            <label class="col-form-label pl-0 pr-0 text-center font-weight-bold">이미지</label>
                                                                        </div>
                                                                        <div class="col-sm-9 p-0">
                                                                            <label class="col-form-label col-sm-4 pl-0 pr-0 text-center font-weight-bold">옵션값</label>
                                                                            <button type="button" data-id="0"  class="btn btn-sm btn-dark btnOption1to9"><i class="fas fa-sort-numeric-down"></i></button>
                                                                            <button type="button" data-id="0"  class="btn btn-sm btn-dark btnOptionAtoZ "><i class="fas fa-sort-alpha-down"></i></button>
                                                                            <button type="button" data-id="0"  class="btn btn-sm btn-dark text-sm btnOptionEraserSpecKey"><i class="fas fa-eraser"></i>특수문자</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3 row pl-0">
                                                                        <label class="col-form-label col-sm-5 pl-0 pr-1 text-right font-weight-bold">옵션추가금</label>
                                                                        <div class="input-group input-group-sm col-sm-7 pl-0">
                                                                            <input type="text" name="txtOptionPriceVal[]" id="txtOptionPriceVal_0" class="form-control txtOptionPriceVal">
                                                                            <div class="input-group-append mb-1">
                                                                                <button class="btn btn-sm btn-dark btnAddOptionMoney" data-id="0" type="button">+</button>
                                                                                <button class="btn btn-sm btn-dark btnSubtractOptionMoney" data-id="0" type="button">-</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                            <div id="divOptionContainer_0" class="divOptionContainer">
                                                                
                                                            </div> 
                                                            <button type="button" class="btn btn-success btn-block btnAddOptRow"><i class="fas fa-plus"></i> 추가</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="card bg-secondary-light">
                                                        <div class="card-body alert alert-dismissible">
                                                            <label class="form-label font-weight-bold">옵션 2</label>
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                            <br>
                                                            <div class="form-group row">
                                                                <div class="input-group input-group-sm m-3">
                                                                    <input type="text" class="form-control text-center col-md-3 font-weight-bold" value="옵션명" readonly="">
                                                                    <input type="text" name="txtOptionAttr[]" class="form-control text-center">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-12 row">
                                                                    <div class="col-sm-6 row">
                                                                        <div class="col-sm-3 p-0 text-center">
                                                                            <label class="col-form-label pl-0 pr-0 text-center font-weight-bold">이미지</label>
                                                                        </div>
                                                                        <div class="col-sm-9 p-0">
                                                                            <label class="col-form-label col-sm-4 pl-0 pr-0 text-center font-weight-bold">옵션값</label>
                                                                            <button type="button" data-id="1" class="btn btn-sm btn-dark btnOption1to9"><i class="fas fa-sort-numeric-down"></i></button>
                                                                            <button type="button" data-id="1" class="btn btn-sm btn-dark btnOptionAtoZ "><i class="fas fa-sort-alpha-down"></i></button>
                                                                            <button type="button" data-id="1" class="btn btn-sm btn-dark text-sm btnOptionEraserSpecKey"><i class="fas fa-eraser"></i>특수문자</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3 row pl-0">
                                                                        <label class="col-form-label col-sm-5 pl-0 pr-1 text-right font-weight-bold">옵션추가금</label>
                                                                        <div class="input-group input-group-sm col-sm-7 pl-0">
                                                                            <input type="text" name="txtOptionPriceVal[]" id="txtOptionPriceVal_1" class="form-control txtOptionPriceVal">
                                                                            <span class="input-group-append mb-1">
                                                                                <button class="btn btn-sm btn-dark btnAddOptionMoney" data-id="1" type="button">+</button>
                                                                                <button class="btn btn-sm btn-dark btnSubtractOptionMoney" data-id="1" type="button">-</button>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="divOptionContainer_1">
                                                                
                                                            </div>
                                                            <button type="button" class="btn btn-success btn-block btnAddOptRow"><i class="fas fa-plus"></i> 추가</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <button type="button" class="btn btn-success btn-block btnAddNewOption"><i class="fas fa-plus"></i> 새 옵션명 추가</button>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <div class="alert bg-light">
                                        <div class="alert-message">
                                            <button type="button" class="btn btn-info btnRematchOptComb">
                                                <i class="fas fa-th"></i> 옵션조합보기 &amp; 옵션별 재고입력 (비필수)
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                </div>
                                <div class="col-sm-10">
                                    <div class="alert bg-light">
                                        <div id="divOptionCombinationBox" class="alert-message">
                                            {{-- <button type="button" class="btn btn-info">
                                                <i class="fas fa-undo-alt"></i> 입력취소
                                            </button>
                                            <br>
                                            <br>
                                            <span class="text-success"> 재고 데이터는 DB 저장되지 않는 1회성 입력값</span>
                                            <br> --}}
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="optionCounter">
                                <span  class="badge badge-success mb-2">
                                    옵션1 - 0 개
                                </span>
                                <span class="badge badge-success mb-2">
                                    옵션2 - 0 개
                                </span>
                                <span class="badge badge-primary mb-2">
                                    옵션조합 총갯수 - 0 개
                                </span>
                            </div>
                        </fieldset>
                        {{-- <button class="btn btn-primary btn-lg btn-block"><i class="fas fa-check"></i> 확인</button> --}}
                    </div>
                </div>
                <fieldset >
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0" style="font-weight: bold;">Step 5. 상품 대표이미지 및 상세설명</h5>
                        </div>
                        <div class="card-body">
                            <fieldset style="color:">
                                <div class="form-group row">
                                    <label class="col-form-label col-sm-2 text-sm-right">대표이미지</label>
                                    <div class="col-sm-9 row mb-0">
                                        <label class="col-form-label col-sm-12 text-sm-left text-success">jpg,png만 등록가능, 1000x1000 권장, 600x600 이상, 5000x5000 이하, 2MB이하(인터파크1MB)</label>
                                        <div class="col-sm-4">
                                            <span class="badge badge-primary" id="spanBaseImageInfo_0"></span>
                                            <div class="card text-white bg-warning">
                                                <img class="card-img-top blur baseImage" id="mainImage" data-id="0" src="https://via.placeholder.com/300/FFFFFF?text=Main Image" alt="Unsplash">
                                                <div class="card-body">
                                                    <p class="card-text">대표이미지</p>
                                                    <hr>
                                                    <fieldset>
                                                        <button type="button" class="btn btn-success btn-sm mb-2">권장사이즈</button>
                                                    </fieldset>
                                                    <br>
                                                    <span><i class="fas fa-file-upload text-danger fa-lg"></i> 이미지파일 업로드</span>
                                                    <input type="file">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <span class="badge badge-primary" id="spanBaseImageInfo_1"></span>
                                            <div class="card text-white bg-secondary">
                                                <img class="card-img-top opacity baseImage" id="subImage1" data-id="1" src="https://via.placeholder.com/300/FFFFFF?text=Sub Image1" alt="Unsplash" style="filter:none">
                                                <div class="card-body">
                                                    <p class="card-text">
                                                        추가이미지 1
                                                        <div class="custom-control custom-switch float-right">
                                                            <fieldset>
                                                                <input type="checkbox" class="custom-control-input" id="customSwitchFrontImage1">
                                                                <label class="custom-control-label" for="customSwitchFrontImage1">사용</label>
                                                            </fieldset>
                                                        </div>
                                                    </p>
                                                    <hr>
                                                    <fieldset>
                                                        <button type="button" class="btn btn-success btn-sm mb-2">권장사이즈</button>
                                                    </fieldset>
                                                    <br>
                                                    <span><i class="fas fa-file-upload text-danger fa-lg"></i> 이미지파일 업로드</span>
                                                        <input type="file">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <span class="badge badge-primary" id="spanBaseImageInfo_2"></span>
                                            <div class="card text-white bg-secondary">
                                                <img class="card-img-top opacity baseImage" id="subImage2" data-id="2" src="https://via.placeholder.com/300/FFFFFF?text=Sub Image2" alt="Unsplash" style="filter:none">
                                                <div class="card-body">
                                                    <p class="card-text">
                                                        추가이미지 2
                                                        <div class="custom-control custom-switch float-right">
                                                                <fieldset>
                                                                    <input type="checkbox" class="custom-control-input" id="customSwitchFrontImage2">
                                                                    <label class="custom-control-label" for="customSwitchFrontImage2">사용</label>
                                                                </fieldset>
                                                        </div>
                                                    </p>
                                                    <hr>
                                                    <fieldset>
                                                        <button type="button" class="btn btn-success btn-sm mb-2">권장사이즈</button>
                                                    </fieldset>
                                                    <br>
                                                    <span><i class="fas fa-file-upload text-danger fa-lg"></i> 이미지파일 업로드</span>
                                                        <input type="file">
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <label class="col-form-label col-sm-2 text-sm-right"></label>
                                    <div class="col-sm-9 row mb-0" id="imageContainer">
                                        <div class="col-sm-2 pl-1 pr-0">
                                            <span class="badge badge-primary"></span>
                                            <div class="card">
                                                <img class="card-img-top blur" src="https://via.placeholder.com/300/FFFFFF?text=No%20Image1" alt=" 사용자 업로드이미지">
                                                <div class="card-body p-0">
                                                    <div class="text-center">
                                                        <div class="btn-group btn-block">
                                                            <button class="btn btn-secondary btn-sm pl-0 pr-0">대표</button>
                                                            <button class="btn btn-secondary btn-sm pl-0 pr-0">추가1</button>
                                                            <button class="btn btn-secondary btn-sm pl-0 pr-0">추가2</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 pl-1 pr-0">
                                            <span class="badge badge-primary"></span>
                                            <div class="card">
                                                <img class="card-img-top blur" src="https://via.placeholder.com/300/FFFFFF?text=No%20Image1" alt=" 사용자 업로드이미지">
                                                <div class="card-body p-0">
                                                    <div class="text-center">
                                                        <div class="btn-group btn-block">
                                                            <button class="btn btn-secondary btn-sm pl-0 pr-0">대표</button>
                                                            <button class="btn btn-secondary btn-sm pl-0 pr-0">추가1</button>
                                                            <button class="btn btn-secondary btn-sm pl-0 pr-0">추가2</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 pl-1 pr-0">
                                            <span class="badge badge-primary"></span>
                                            <div class="card">
                                                <img class="card-img-top blur" src="https://via.placeholder.com/300/FFFFFF?text=No%20Image1" alt=" 사용자 업로드이미지">
                                                <div class="card-body p-0">
                                                    <div class="text-center">
                                                        <div class="btn-group btn-block">
                                                            <button class="btn btn-secondary btn-sm pl-0 pr-0">대표</button>
                                                            <button class="btn btn-secondary btn-sm pl-0 pr-0">추가1</button>
                                                            <button class="btn btn-secondary btn-sm pl-0 pr-0">추가2</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 pl-1 pr-0">
                                            <span class="badge badge-primary"></span>
                                            <div class="card">
                                                <img class="card-img-top blur" src="https://via.placeholder.com/300/FFFFFF?text=No%20Image1" alt=" 사용자 업로드이미지">
                                                <div class="card-body p-0">
                                                    <div class="text-center">
                                                        <div class="btn-group btn-block">
                                                            <button class="btn btn-secondary btn-sm pl-0 pr-0">대표</button>
                                                            <button class="btn btn-secondary btn-sm pl-0 pr-0">추가1</button>
                                                            <button class="btn btn-secondary btn-sm pl-0 pr-0">추가2</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 pl-1 pr-0">
                                            <span class="badge badge-primary"></span>
                                            <div class="card">
                                                <img class="card-img-top blur" src="https://via.placeholder.com/300/FFFFFF?text=No%20Image1" alt=" 사용자 업로드이미지">
                                                <div class="card-body p-0">
                                                    <div class="text-center">
                                                        <div class="btn-group btn-block">
                                                            <button class="btn btn-secondary btn-sm pl-0 pr-0">대표</button>
                                                            <button class="btn btn-secondary btn-sm pl-0 pr-0">추가1</button>
                                                            <button class="btn btn-secondary btn-sm pl-0 pr-0">추가2</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                                {{-- <div class="form-group row ml-3">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="customSwitchTr1">
                                        <label class="custom-control-label" for="customSwitchTr1" width="100">대표이미지</label>
                                    </div>
                                     
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="customSwitchTr2">
                                        <label class="custom-control-label" for="customSwitchTr2">옵션이미지</label>
                                    </div>
                                </div> --}}
                            <hr>
                            <span class="text-success"> 마켓별 글자수 제한 글자잘림 유의. 공통 30000 byte 이내 권장.</span>

                            <div class="alert alert-secondary mb-0 mt-2">
                                <div class="alert-message pb-0">
                                    <div class="form-group ml-3">
                                        <span><i class="fas fa-file-upload text-primary fa-lg"></i> 내 이미지파일 삽입(최대2MB) &nbsp;</span>
                                        <input type="file" multiple="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mt-3">
                                    <textarea name="summernote" id="summernote">
                                    </textarea>
                                </div>
                            </div>
                            {{-- 
                            <iframe id="ifSN" width="100%" height="800" src="sn.html" frameborder="0" allowfullscreen=""></iframe>
                                    <button class="btn btn-primary btn-lg btn-block" disabled="">잠시 기다려주세요</button> --}}
                                    <button type="button" class="btn btn-primary btn-lg btn-block btnSaveProduct"><!--!--><i class="fas fa-check"></i> 수집정보 저장</button>
                        </div>
                    </div>
                </fieldset>
                {{-- <div class="row">
                    <div class="col-12 col-lg-2">
                        <button class="btn btn-outline-success btn-block"><i class="far fa-save"></i> 임시저장</button>
                    </div>
                    <div class="col-12 col-lg-2">
                        <button class="btn btn-outline-success btn-block"><i class="far fa-share-square"></i> 임시저장 불러오기</button>
                    </div>
                </div> --}}
                <input type="text" id="hdDescription" class="form-control" hidden="">
            </div>
            </form>
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
            code: '',
            callbacks:{
                onImageUpload: function(files, editor, welEditable) {
                    var url= sendFile(files[0], editor, welEditable);
                },
                onMediaDelete : function(target) {
                    deleteSNImage(target[0].src);
                }
            }
        });
        
        function sendFile(file, editor, welEditable) {
            data = new FormData();
            data.append("file", file);
            $.ajax({
            data: data,
            type: "POST",
            url: "/uploadImage",
            cache: false,
            contentType: false,
            processData: false,
            success: function({success, data}) {
                var image = $('<img>').attr('src', data ).addClass("img-fluid");
                $('#summernote').summernote("insertNode", image[0]);
            }
            });
        }

        function deleteSNImage(src) {
            $.ajax({
                data: {file : src},
                type: "POST",
                url: "/deleteImage", 
                cache: false,
                success: function(data) {
                    console.log(data);
                }
            });
        }
        //$('#summernote').summernote('code', '');
        //delete account
        $('body').on('click', '.btnDelItem', function () {
            var rowId = $(this).attr('data-id');

            $(".subItemsTable tbody").find("#row_" + rowId).remove();
        });
        //대표이미지 바꾸기
        $('body').on('click', '.btnMainImage', function () {
            var img_src = $(this).attr('data-src');
            $('#mainImage').attr('src', img_src);
            $("input[name='txtImage[]']").each(function(index){
                var strVal = $(this).val();
                var arrTemp = strVal.split('::');
                if(arrTemp[0] == 0){
                    $(this).val(index+"::"+arrTemp[1]);
                }
            });
            $(this).parent().parent().parent().prev().val("0::"+img_src);
            $('#mainImage').one('load', function() {
                var width= this.naturalWidth;
                var height = this.naturalHeight;
                var blob = null;
                var xhr = new XMLHttpRequest(); 
                xhr.open('GET', $(this).attr('src'), true); 
                xhr.responseType = 'blob';
                //$('#spanImageInfo_' + index).html('적합 - '+width+'x'+height+', ' + 'KB');
                xhr.onload = function() 
                {
                    blob = xhr.response;
                    $('#spanBaseImageInfo_0').html('적합 - '+width+'x'+height+', ' + Math.round(blob.size/1024) + 'KB');
                }
                xhr.send();
            }).each(function() {
                if(this.complete) $(this).load();
            });
            return false;
        });	
        // 첨부이미지 1 바꾸기
        $('body').on('click', '.btnSubImage1', function () {
            var img_src = $(this).attr('data-src');
            $('#subImage1').attr('src', img_src);
            $("input[name='txtImage[]']").each(function(index){
                var strVal = $(this).val();
                var arrTemp = strVal.split('::');
                if(arrTemp[0] == 1){
                    $(this).val(index+"::"+arrTemp[1]);
                }
            });
            $(this).parent().parent().parent().prev().val("1::"+img_src);
            $('#subImage1').one('load', function() {
                var width= this.naturalWidth;
                var height = this.naturalHeight;
                var blob = null;
                var xhr = new XMLHttpRequest(); 
                xhr.open('GET', $(this).attr('src'), true); 
                xhr.responseType = 'blob';
                //$('#spanImageInfo_' + index).html('적합 - '+width+'x'+height+', ' + 'KB');
                xhr.onload = function() 
                {
                    blob = xhr.response;
                    console.log(width);
                    console.log(height);
                    console.log(blob.size);
                    console.log($(this).attr("data-id"));
                    $('#spanBaseImageInfo_1').html('적합 - '+width+'x'+height+', ' + Math.round(blob.size/1024) + 'KB');
                }
                xhr.send();
            }).each(function() {
                if(this.complete) $(this).load();
            });
            return false;
        });	
        // 첨부이미지 2 바꾸기
        $('body').on('click', '.btnSubImage2', function () {
            var img_src = $(this).attr('data-src');
            $('#subImage2').attr('src', img_src);
            $("input[name='txtImage[]']").each(function(index){
                var strVal = $(this).val();
                var arrTemp = strVal.split('::');
                if(arrTemp[0] == 2){
                    $(this).val(index+"::"+arrTemp[1]);
                }
            });
            $(this).parent().parent().parent().prev().val("2::"+img_src);
            $('#subImage2').one('load', function() {
                var width= this.naturalWidth;
                var height = this.naturalHeight;
                var blob = null;
                var xhr = new XMLHttpRequest(); 
                xhr.open('GET', $(this).attr('src'), true); 
                xhr.responseType = 'blob';
                //$('#spanImageInfo_' + index).html('적합 - '+width+'x'+height+', ' + 'KB');
                xhr.onload = function() 
                {
                    blob = xhr.response;
                    console.log(width);
                    console.log(height);
                    console.log(blob.size);
                    console.log($(this).attr("data-id"));
                    $('#spanBaseImageInfo_2').html('적합 - '+width+'x'+height+', ' + Math.round(blob.size/1024) + 'KB');
                }
                xhr.send();
            }).each(function() {
                if(this.complete) $(this).load();
            });
            return false;
        });	
        $('body').on('click', '.btnSaveProduct', function () {
            // var brandName1 = $('#selBrandName').val();
            // var brandName2 = $('#txtBrandName').val();
            //카테고리 체크
            var checkCategoryVal = true;
            $('input[name="txtCategoryName[]"]').each(function(index, element){
                if(element.value == ""){
                    checkCategoryVal = false;
                    return false;
                }
            });
            if(checkCategoryVal == false){
                alert('카테고리 설정해주세요.');
                return false;
            }
            //기타 입력값 체크
            if($('.is-invalid').length > 0){
                alert('입력값을 확인해주세요.');
                return false;
            }

            if(confirm("수집정보를 저장하시겠습니까")){
                $('#frmScrap').submit();
            }
        });	
        
        $('body').on('click', '.btnBasicFunction', function () {
            $('#txtFunction').val('((환율*원가*(1+구매수수료))+해외배송비)*(1+판매수수료)*(1+마진율)');
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
                    //console.log(data);
                    if(status =="error"){
                        alert("등록된 상품이 존재하지 않습니다");
                        return;
                    }
                    
                    //$("#txtBasePrice").val(data.orginal_price);
                    $("#txtDiscountPrice").val(data.price);
                    var 환율 = 173;
                    var 원가 = data.price;
                    var 마진율 = 0.1;
                    var 판매수수료 = 0.3;
                    var 구매수수료 = 0.05;
                    var 해외배송비 = 6000;
                    var productPrice = eval($('#txtFunction').val());
                    $("#txtProductPrice").val(Math.round(productPrice / 10) * 10);
                    //옵션머니설정가격부분 설정
                    $("#txtOptionSellPrice").val(Math.round(productPrice / 10) * 10);//상품기본가/판매가
                    $("#txtOptionBasePrice").val(data.orginal_price);//상품기본가/원가
                    $("#txtOptionDiscountPrice").val(data.price);//상품기본가 /할인가
                    $("#txtOptionSSPrice").val(Math.round(productPrice / 20) * 10);//스스50프로 추가금
                    $("#txtOptionESMPrice").val(Math.round(productPrice / 20) * 10);
                    $("#txtOptionSellDiscountPrice").val(0);
                    $("#txtOptionESMDeliveryCharge").val(0);
                    
                    $("#txtExpectedRevenue").val(Math.round($("#txtProductPrice").val() * $("#txtMarginRate").val()/100));
                    $("#txtChMainName").val(data.title);
                    
                    var re = new RegExp('.{1,' + 100 + '}', 'g');
                    $("#txtKrMainName").val(data.titleKO.match(re));
                    var titleLength = string_byte_length(data.titleKO);
                    $("#titleSizeInfo").html(string_byte_length(data.titleKO) + ' / 100 byte');
                    if(titleLength > 100){
                        $("#titleSizeInfo").addClass('text-danger');
                        $("#titleSizeInfo").removeClass('text-success');
                        $("#txtKrMainName").addClass('is-invalid');
                    }

                    $("#txtKrSubName").val(substr_utf8_bytes(data.titleKO, 0, 50));
                    var item = "";
                    var optionTags = "";

                    var arrOptionKey = new Array();
                    var arrOptionName= new Array();
                    var indexOption = 0;
                    var index = 0;
                    $.each(data.props_list, function(idx, value) {
                    // do your stuff here
                        
                        var optArr_cn = value.split(':');
                        var optName_cn=optArr_cn[0];
                        var optValue_cn=optArr_cn[1];
                        
                        var optArr_ko = data.props_list_ko[idx].split(':');
                        var optName_ko=optArr_ko[0];
                        var optValue_ko=optArr_ko[1];
                        
                        if(arrOptionName.findIndex(element => element == optName_cn) < 0){
                            arrOptionName.push(optName_cn);
                            var num = indexOption+1;
                            index = indexOption;
                            indexOption++;
                            //combination용
                            optionTags += `<input type="text" class="form-control col text-center font-weight-bold" value="`+ optName_ko +`" readonly="">`;
                            if(item != ""){
                                item += `</div> 
                                            <button type="button" class="btn btn-success btn-block btnAddOptRow" opt-id="0"><i class="fas fa-plus"></i> 추가</button>
                                        </div>
                                    </div>
                                </div>`;
                            }
                            item +=`<div class="col-sm-12">
                                    <div class="card bg-secondary-light">
                                        <div class="card-body alert alert-dismissible">
                                            <label class="form-label font-weight-bold">옵션 `+num+`</label>
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <br>
                                            <div class="form-group row">
                                                <div class="input-group input-group-sm m-3">
                                                    <input type="text" class="form-control text-center col-md-3 font-weight-bold" value="옵션명" readonly="">
                                                    <input type="text" name="txtOptionAttr[]" id="txtOptionAttr_`+ index +`" value=`+ optName_ko +` class="form-control text-center">
                                                    <input type="hidden" name="txtCnOptionAttr[]" id="txtCnOptionAttr_`+ index +`" value=`+ optName_cn +` class="form-control text-center">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 row">
                                                    <div class="col-sm-6 row">
                                                        <div class="col-sm-3 p-0 text-center">
                                                            <label class="col-form-label pl-0 pr-0 text-center font-weight-bold">이미지</label>
                                                        </div>
                                                        <div class="col-sm-9 p-0">
                                                            <label class="col-form-label col-sm-4 pl-0 pr-0 text-center font-weight-bold">옵션값</label>
                                                            <button type="button" class="btn btn-sm btn-dark btnOption1to9"><i class="fas fa-sort-numeric-down"></i></button>
                                                            <button type="button" class="btn btn-sm btn-dark btnOptionAtoZ"><i class="fas fa-sort-alpha-down"></i></button>
                                                            <button type="button" class="btn btn-sm btn-dark text-sm btnOptionEraserSpecKey"><i class="fas fa-eraser"></i>특수문자</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 row pl-0">
                                                        <label class="col-form-label col-sm-5 pl-0 pr-1 text-right font-weight-bold">옵션추가금</label>
                                                        <div class="input-group input-group-sm col-sm-7 pl-0">
                                                            <input type="text" name="txtOptionPriceVal[]" id="txtOptionPriceVal_${index}" class="form-control txtOptionPriceVal">
                                                            <div class="input-group-append mb-1">
                                                                <button class="btn btn-sm btn-dark btnAddOptionMoney" data-id="${index}" type="button">+</button>
                                                                <button class="btn btn-sm btn-dark btnSubtractOptionMoney" data-id="${index}" type="button">-</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div id="divOptionContainer_${index}" class="divOptionContainer">`;
                        }
                        
                        var chkLength = "is-valid";
                        if(string_byte_length(optValue_ko) > 30){
                            chkLength="is-invalid";
                        }
                        var imageUrl = "{{asset('assets/images/system/no-image.png')}}";
                        var realImageUrl = "";
                        // if(el[3].trim() != ""){
                        //     imageUrl=el[3];
                        // }
                        var prop_imgs = data.prop_imgs.prop_img;
                        $.each(prop_imgs, function(imgIdx, el) {
                            if(el.properties == idx){
                                imageUrl=el.url;
                                realImageUrl=el.url;
                            }
                        });

                        item += `<div class="input-group">
                                    <a href="javascript:void(0)" target="_blank">
                                        <img class="rounded" src="`+ imageUrl +`" width="40" height="40">
                                    </a>
                                    <fieldset>
                                        <button type="button" class="btn btn-info p-1 btnImportImage"><label for="inputFileOpt_`+ index +`_`+ idx +`"><i class="fas fa-file-upload fa-lg"></i></label></button>
                                        <input type="file" id="inputFileOpt_`+ index +`_`+ idx +`" hidden="">
                                    </fieldset>
                                    <input type="text" value="`+ optValue_cn +`" name="txtCnOptionName_${index}[]" id="txtCnOptionName_${index}_${idx}" data-id="" opt-id="${index}" item-id="${idx}" class="form-control  col-md-3">
                                    <input type="text" value="`+ optValue_ko +`" name="txtKoOptionName_${index}[]"  id="txtKoOptionName_${index}_${idx}" data-id="" opt-id="${index}" item-id="${idx}" class="form-control txtOptionName ${chkLength} col-md-3">
                                    <input type="text" value="0" name="txtAddOptionPrice_${index}[]" id="txtAddOptionPrice_${index}_${idx}" data-id="" opt-id="${index}" item-id="${idx}" class="form-control col-md-3">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-info border-secondary btnMoveOptRow" >이동</button>
                                        <button type="button" class="btn btn-primary btnInsertOptRow"><i class="fas fa-plus"></i></button>
                                        <button type="button" class="btn btn-danger btnDelOptRow"><i class="far fa-trash-alt"></i></button>
                                    </div>
                                    <input type="hidden" name="txtOptionImage_${index}[]" value="`+realImageUrl+`">
                                </div>`;
                    });

                    item +=  `</div> 
                                <button type="button" class="btn btn-success btn-block btnAddOptRow" opt-id="${index}"><i class="fas fa-plus"></i> 추가</button>
                            </div>
                        </div>
                    </div>`;
                    $('#divOptionField').html(item);
                    //console.log(item);
                    //이미지
                    var imgItem = "";
                    data.item_imgs.forEach( (element, index) => {
                        if(index == 0){
                            $('#mainImage').attr('src', element.url);
                        }
                        if(index == 1){
                            $('#subImage1').attr('src', element.url);
                        }
                        if(index == 2){
                            $('#subImage2').attr('src', element.url);
                        }

                        var img = new Image();
                        var width = 0;
                        var height = 0;
                        var size = 0;
                        img.src = element.url;
                        imgItem +=`<div class="col-sm-2 pl-1 pr-0">
                                        <span class="badge badge-primary" id="spanImageInfo_${index}" >적합 - `+width+`x`+height+`, `+size+`KB</span>
                                        <div class="card">
                                            <img class="card-img-top blur productImage" src="${element.url}" data-id="${index}" id="img_${index}" alt="Product Image" />
                                            <input type="hidden" name="txtImage[]" id="hid_${index}" value="${index}::${element.url}"/>
                                            <div class="card-body p-0">
                                                <div class="text-center">
                                                    <div class="btn-group btn-block">
                                                        <button type="button" class="btn btn-secondary btn-sm pl-0 pr-0 btnMainImage" data-src="${element.url}">대표</button>
                                                        <button type="button" class="btn btn-secondary btn-sm pl-0 pr-0 btnSubImage1" data-src="${element.url}">추가1</button>
                                                        <button type="button" class="btn btn-secondary btn-sm pl-0 pr-0 btnSubImage2" data-src="${element.url}">추가2</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                    });
                    $('#imageContainer').html(imgItem);

                    var optCombination= `<div class="input-group">
                            `+ optionTags +`
                            <!--<input type="text" class="form-control col-md-2 text-center font-weight-bold" value="원가" readonly="">-->
                            <input type="text" class="form-control col-md-2 text-center font-weight-bold" value="원가(할인가)" readonly="">
                            <input type="text" class="form-control col-md-2 text-center font-weight-bold" value="판매가" readonly="">
                            <input type="text" class="form-control col-md-2 text-center font-weight-bold" value="옵션추가금" readonly="">
                            <input type="text" class="form-control col-md-1 text-center font-weight-bold" value="재고" readonly="">
                            <div class="input-group-append">
                                <button type="button" class="btn invisible btnSoldOut">품절</button>
                                <button type="button" class="btn invisible"><i class="far fa-trash-alt"></i></button>
                            </div>
                        </div>`;
                    
                    window.skus = data.skus.sku;
                    //아이템
                    window.skus.forEach((element)=>{
                        var combination = '';
                        // var optData = element.properties_name.split(';');
                        // optData.forEach((el, idx) =>{
                        //     optVal = el.split(':').pop();
                        //     combination +='<input name="optName_'+ idx +'[]" type="text" value="'+ optVal +'" class="form-control col" readonly="">'; 
                        // });
                        var sku_image = "";
                        var properties = element.properties.split(';');
                        properties.forEach((el, idx)=>{
                            optVal = data.props_list_ko[el].split(':').pop();
                            combination +='<input name="optName_'+ idx +'[]" type="text" value="'+ optVal +'" class="form-control col" readonly="">'; 
                            if(data.props_img[el] != undefined){
                               sku_image =  data.props_img[el];
                            }
                            
                        });

                        var 환율 = $('#txtExchangeRate').val()*1;
                        var 원가 = element.price;
                        var 마진율 = $('#txtMarginRate').val()/100;
                        var 판매수수료 = $('#txtSellerMarketChargeRate').val()/100;
                        var 구매수수료 = $('#txtBuyerMarketChargeRate').val()/100;
                        var 해외배송비 = $('#txtOverSeaDeliveryCharge').val()*1;
                        var productPrice = eval($('#txtFunction').val())*1;
                        var sumPrice = (Math.round(productPrice / 10) * 10);
                        
                        var optionPrice = Math.round((element.price-data.price) * 26) *10;
                        optCombination += `<div class="input-group">
                            `+ combination +`
                            <input name="sku_discount_price[]" type="text" value="` + element.price + `" class="form-control col-md-2 optDiscountPrice" readonly="">
                            <input name="sku_sell_price[]" type="text" value="` + sumPrice + `" class="form-control col-md-2 optSellPrice" readonly="">
                            <input name="sku_option_price[]" type="text" value="` + optionPrice + `" class="form-control col-md-2 optAddPrice" readonly="">
                            <input name="sku_stock[]" type="text" value="` + element.quantity + `" class="form-control col-md-1 optComStock">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-warning btnSoldOut">품절</button>
                                <button type="button" class="btn btn-danger btnDeleteCombRow"><i class="far fa-trash-alt"></i></button>
                            </div>
                            <input name="sku_image[]" type="hidden" value="` + sku_image + `">
                        </div>`;
                    });
                    $('#divOptionCombinationBox').html(optCombination);
                    $('#summernote').summernote('code', data.desc);
                    UpdateImageInfo();

                },
                error: function (data) {
                    alert('스크래핑중 오류가 발생했습니다. 잠시후 다시 시도해주십시오.');
                }

            });
        });
        var UpdateImageInfo = function () {
       
            $('.productImage').one('load', function() {
                var width= this.naturalWidth;
                var height = this.naturalHeight;
                var index = $(this).attr("data-id");
                var blob = null;
                var xhr = new XMLHttpRequest(); 
                xhr.open('GET', $(this).attr('src'), true); 
                xhr.responseType = 'blob';
                //$('#spanImageInfo_' + index).html('적합 - '+width+'x'+height+', ' + 'KB');
                xhr.onload = function() 
                {
                    blob = xhr.response;
                    $('#spanImageInfo_' + index).html('적합 - '+width+'x'+height+', ' + Math.round(blob.size/1024) + 'KB');
                }
                xhr.send();
            }).each(function() {
                if(this.complete) $(this).load();
            });
            $('.baseImage').one('load', function() {
                var width= this.naturalWidth;
                var height = this.naturalHeight;
                var index = $(this).attr("data-id");
                var blob = null;
                var xhr = new XMLHttpRequest(); 
                xhr.open('GET', $(this).attr('src'), true); 
                xhr.responseType = 'blob';
                
                xhr.onload = function() 
                {
                    blob = xhr.response;
                    $('#spanBaseImageInfo_' + index).html('적합 - '+width+'x'+height+', ' + Math.round(blob.size/1024) + 'KB');
                }
                xhr.send();
            }).each(function() {
                //if(this.complete) $(this).load();
            });
        };
        $('body').on('click', '.btnOption1to9', function () {
            
            var index = $(this).attr('data-id');
            var value = $('#txtOptionPriceVal_'+index).val();
            var optTags = $('#divOptionContainer_'+index);
            optTags.children().each(function(idx, el){
                
                //var optPrice = $(el).find('input:nth-child(4)').val();
                $(el).find('input:nth-child(4)').val( (idx+1) + "번");
            });
        });
        $('body').on('click', '.btnOptionAtoZ', function () {
            
            var index = $(this).attr('data-id');
            var value = $('#txtOptionPriceVal_'+index).val();
            var optTags = $('#divOptionContainer_'+index);
            optTags.children().each(function(idx, el){
                
                //var optPrice = $(el).find('input:nth-child(4)').val();
                $(el).find('input:nth-child(4)').val( (idx+1) + "번");
            });
        });
        $('body').on('click', '.btnAddOptionMoney', function () {
            
            var index = $(this).attr('data-id');
            var value = $('#txtOptionPriceVal_'+index).val();
            var optTags = $('#divOptionContainer_'+index);
            optTags.children().each(function(idx, el){
                
                var optPrice = $(el).find('input:nth-child(5)').val();
                $(el).find('input:nth-child(5)').val(optPrice*1 + parseInt(value));
            });
        });
        $('body').on('click', '.btnSubtractOptionMoney', function () {
            var index = $(this).attr('data-id');
            var value = $('#txtOptionPriceVal_'+index).val();
            var optTags = $('#divOptionContainer_'+index);
            optTags.children().each(function(idx, el){
                
                var optPrice = $(el).find('input:nth-child(5)').val();
                $(el).find('input:nth-child(5)').val(optPrice*1 - parseInt(value));
            });
        });
        $('body').on('click', '.btnDelOptRow', function () {
            var index = $(this).parent().parent().remove();
        });
        $('body').on('click', '.btnInsertOptRow', function () {
            var element = $(this).parent().parent();
            var content=`<div class="input-group">
                            <a href="` + "{{asset('assets/images/system/no-image.png')}}" + `" target="_blank">
                                <img class="rounded" src="` + "{{asset('assets/images/system/no-image.png')}}" + `" width="40" height="40">
                            </a>
                            <fieldset>
                                <button class="btn btn-info p-1"><label for="inputFileOpt01"><i class="fas fa-file-upload fa-lg"></i></label></button>
                                <input type="file" hidden="">
                            </fieldset>
                            <input type="text" class="form-control col-md-3 ">
                            <input type="text" class="form-control col-md-3 txtOptionName">
                            <input type="text" class="form-control col-md-3">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-info border-secondary btnMoveOptRow ">이동</button>
                                <button type="button" class="btn btn-primary btnInsertOptRow"><i class="fas fa-plus"></i></button>
                                <button type="button" class="btn btn-danger btnDelOptRow"><i class="far fa-trash-alt"></i></button>
                            </div>
                        </div>`;
            $(content).insertBefore(element);
        });
        $('body').on('click', '.btnMoveOptRow', function () {
            var element = $(this).parent().parent();
            if($(this).html() == "이동"){
                console.log($(this).html());
                
                //$(this).removeClass('btnMoveFromOptRow');
                //$(this).addClass('btnMovePosOptRow');
                element.parent().find('button.border-secondary').each(function () {
                    $(this).html('↑삽입');
                });
                $(this).parent().parent().addClass('divMoveRow');
            }
            else if($(this).html() == "↑삽입"){
                var copyRow = $(this).parent().parent().parent().find('.divMoveRow').first();
                element.parent().find('button.border-secondary').each(function () {
                    $(this).html('이동');
                });
                
                //$('<div class="input-group"></div>').prepend(element);
                //copyRow.contents().appendTo(element);
                element.before(copyRow);
                copyRow.removeClass('divMoveRow');
                //copyRow.remove();
            }
            
        });
        $('body').on('click', '.btnAddOptRow', function () {
            var element = $(this).prev();
            var content=`<div class="input-group">
                            <a href="` + "{{asset('assets/images/system/no-image.png')}}" + `" target="_blank">
                                <img class="rounded" src="` + "{{asset('assets/images/system/no-image.png')}}" + `" width="40" height="40">
                            </a>
                            <fieldset>
                                <button class="btn btn-info p-1"><label for="inputFileOpt01"><i class="fas fa-file-upload fa-lg"></i></label></button>
                                <input type="file" hidden="">
                            </fieldset>
                            <input type="text" class="form-control col-md-3">
                            <input type="text" class="form-control col-md-3 txtOptionName">
                            <input type="text" class="form-control col-md-3">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-info border-secondary btnMoveOptRow ">이동</button>
                                <button type="button" class="btn btn-primary btnInsertOptRow"><i class="fas fa-plus"></i></button>
                                <button type="button" class="btn btn-danger btnDelOptRow"><i class="far fa-trash-alt"></i></button>
                            </div>
                        </div>`;
            $(content).appendTo(element); 
        });
        $('body').on('click', '.btnAddNewOption', function () {
            var element = $(this).parent().prev();
            var count = element.children().length;
            if(count > 3){
                alert('등록가능한 옵션수는 최대 3개입니다');
                return;
            }
            var num = count+1; 
            item =`<div class="col-sm-12">
                        <div class="card bg-secondary-light">
                            <div class="card-body alert alert-dismissible">
                                <label class="form-label font-weight-bold">옵션 `+num+`</label>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <br>
                                <div class="form-group row">
                                    <div class="input-group input-group-sm m-3">
                                        <input type="text" class="form-control text-center col-md-3 font-weight-bold" value="옵션명" readonly="">
                                        <input type="text" name="txtOptionAttr[]" id="txtOptionAttr_`+count+`" class="form-control text-center">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 row">
                                        <div class="col-sm-6 row">
                                            <div class="col-sm-3 p-0 text-center">
                                                <label class="col-form-label pl-0 pr-0 text-center font-weight-bold">이미지</label>
                                            </div>
                                            <div class="col-sm-9 p-0">
                                                <label class="col-form-label col-sm-4 pl-0 pr-0 text-center font-weight-bold">옵션값</label>
                                                <button type="button" class="btn btn-sm btn-dark btnOption1to9"><i class="fas fa-sort-numeric-down"></i></button>
                                                <button type="button" class="btn btn-sm btn-dark btnOptionAtoZ"><i class="fas fa-sort-alpha-down"></i></button>
                                                <button type="button" class="btn btn-sm btn-dark text-sm btnOptionEraserSpecKey"><i class="fas fa-eraser"></i>특수문자</button>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 row pl-0">
                                            <label class="col-form-label col-sm-5 pl-0 pr-1 text-right font-weight-bold">옵션추가금</label>
                                            <div class="input-group input-group-sm col-sm-7 pl-0">
                                                <input type="text" name="txtOptionPriceVal[]" id="txtOptionPriceVal_${count}" class="form-control txtOptionPriceVal">
                                                <div class="input-group-append mb-1">
                                                    <button class="btn btn-sm btn-dark btnAddOptionMoney" data-id="${count}" type="button">+</button>
                                                    <button class="btn btn-sm btn-dark btnSubtractOptionMoney" data-id="${count}" type="button">-</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="divOptionContainer_${count}" class="divOptionContainer">
                                </div> 
                                <button type="button" class="btn btn-success btn-block btnAddOptRow" opt-id="${count}"><i class="fas fa-plus"></i> 추가</button>
                            </div>
                        </div>
                    </div>`;
            element.append(item);
            count = element.children().length;
            if(count >= 3){
                $(this).parent().remove();
            }
        });
        $('body').on('click', '.btnRematchOptComb', function() {
            var optionAttrTags = $('[name="txtOptionAttr[]"]');
            var optionTags = "";
            var sumOptPrice = 0;
            var nEmptyOptionCounter = 0;
            optionAttrTags.each(function(idx, el) {
                var optName = $(this).val();
                if(optName.trim() == ""){
                    nEmptyOptionCounter++;
                }
                optionTags +='<input type="text" value="'+ $(this).val() +'" class="form-control text-center font-weight-bold" readonly="">'; 
            });
            if(nEmptyOptionCounter){
                alert('옵션명을 입력하세요');
            }

            // var optionContainer = $('#divOptionField');
            // optionContainer.children().each(function(index, element){
            //     console.log(index);
            // });
            
            var divOptionComb = `<div class="input-group">
                `+ optionTags +`
                <!--<input type="text" class="form-control col-md-2 text-center font-weight-bold" value="원가" readonly="">-->
                <input type="text" class="form-control col-md-2 text-center font-weight-bold" value="원가(할인가)" readonly="">
                <input type="text" class="form-control col-md-2 text-center font-weight-bold" value="판매가" readonly="">
                <input type="text" class="form-control col-md-2 text-center font-weight-bold" value="옵션추가금" readonly="">
                <input type="text" class="form-control col-md-1 text-center font-weight-bold" value="재고" readonly="">
                <div class="input-group-append">
                    <button type="button" class="btn invisible btnSoldOut">품절</button>
                    <button type="button" class="btn invisible"><i class="far fa-trash-alt"></i></button>
                </div>
            </div>`;
            var divOptionContainers = $('.divOptionContainer');
            var arrOptionComb = new Array();
            divOptionContainers.each(function(index, element){
                //console.log('good');
                var arrOption = new Array();
                $(this).children().each(function(idx, el){
                    var optName = $(el).find('input:nth-child(4)').val();
                    var optPrice = $(el).find('input:nth-child(5)').val();
                    var optId = $(el).find('input:nth-child(5)').attr('data-id');
                    var itemId = $(el).find('input:nth-child(5)').attr('item-id');
                    var itemImg = $(el).find('img').attr('src');
                    if(itemImg.includes('no-image.png')){
                        itemImg = "";
                    }
                    var objOption = {optName, optPrice, optId, itemId, itemImg};
                    arrOption.push(objOption);
                    //console.log(optName + optPrice);
                });
                arrOptionComb.push(arrOption);
            });
            
            if(arrOptionComb.length == 1){
                if(arrOptionComb[0].length <= 0){
                    alert('옵션정보를 입력하세요');
                }
                var optionCounterInfor = `<span class="badge badge-success mb-2">옵션1 - ${arrOptionComb[0].length} 개</span>
                    <span class="badge badge-primary mb-2">옵션조합 총갯수 - ${arrOptionComb[0].length}개</span>`;
                $("#optionCounter").html(optionCounterInfor);
                for(i=0; i<arrOptionComb[0].length; i++){
                        var stock=0;
                        var basePrice = $('#txtDiscountPrice').val()*1;
                        var itemPrice = $('#txtDiscountPrice').val()*1;
                        var optionPrice = 0;
                        var sku_image = "";
                        if(window.skus != undefined){
                            window.skus.forEach((el, idx)=>{
                                
                                var itemId = arrOptionComb[0][i].itemId;
                                if(el.properties == itemId )
                                {
                                    stock = el.quantity;
                                    itemPrice = Math.round(el.price);
                                }
                                sku_image = arrOptionComb[0][i].itemImg;
                            });
                        }
                        optTempPrice = arrOptionComb[0][i].optPrice*1
                        optionPrice = optTempPrice + Math.round((itemPrice-basePrice) * 26)* 10 ;

                        var 환율 = $('#txtExchangeRate').val()*1;
                        var 원가 = itemPrice*1;
                        var 마진율 = $('#txtMarginRate').val()/100;
                        var 판매수수료 = $('#txtSellerMarketChargeRate').val()/100;
                        var 구매수수료 = $('#txtBuyerMarketChargeRate').val()/100;
                        var 해외배송비 = $('#txtOverSeaDeliveryCharge').val()*1;
                        var productPrice = eval($('#txtFunction').val());
                        var sellPrice = (Math.round((productPrice + optTempPrice) / 10) * 10);
                        //<input name="sku_base_price[]" type="text" value="${basePrice}" class="form-control col-md-2 optBasePrice" readonly="">
                        divOptionComb += `<div class="input-group">
                                <input name="optName_0[]" type="text" value="`+arrOptionComb[0][i].optName+`" class="form-control col" readonly="">
                                
                                <input name="sku_discount_price[]" type="text" value="${itemPrice}" class="form-control col-md-2 optDiscountPrice" readonly="">
                                <input name="sku_sell_price[]" type="text" value="${sellPrice}" class="form-control col-md-2 optSellPrice" readonly="">
                                <input name="sku_option_price[]" type="text" value="${optionPrice}" class="form-control col-md-2 optAddPrice" readonly="">
                                <input name="sku_stock[]" type="text" value="${stock}" class="form-control col-md-1 optComStock">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-warning btnSoldOut">품절</button>
                                    <button type="button" class="btn btn-danger btnDeleteCombRow"><i class="far fa-trash-alt"></i></button>
                                </div>
                                <input name="sku_image[]" type="hidden" value="` + arrOptionComb[0][i].itemImg + `">
                            </div>`;
                }
            }else if(arrOptionComb.length == 2){
                var optionCounterInfor = `<span class="badge badge-success mb-2">옵션1 - ${arrOptionComb[0].length} 개</span>
                                        <span class="badge badge-success mb-2">옵션2 - ${arrOptionComb[1].length} 개</span>
                                        <span class="badge badge-primary mb-2">옵션조합 총갯수 - ${arrOptionComb[0].length * arrOptionComb[1].length}개</span>`;
                $("#optionCounter").html(optionCounterInfor);
                for(i=0; i<arrOptionComb[0].length; i++){
                    for (j = 0; j < arrOptionComb[1].length; j++) {
                        var stock=0;
                        var basePrice = $('#txtDiscountPrice').val()*1;
                        var itemPrice = $('#txtDiscountPrice').val()*1;
                        var optionPrice = 0;
                        var sku_image = "";

                        if(window.skus != undefined){
                            window.skus.forEach((el, idx)=>{
                                
                                var itemId1 = arrOptionComb[0][i].itemId;
                                var itemId2 = arrOptionComb[1][j].itemId;
                                if(el.properties.indexOf(itemId1) >=0 && el.properties.indexOf(itemId2) >=0)
                                {
                                    stock = el.quantity;
                                    //basePrice = addZeroes(el.orginal_price == undefined ? basePrice : el.orginal_price);
                                    itemPrice = el.price;
                                }
                                sku_image = arrOptionComb[0][i].itemImg != "" ? arrOptionComb[0][i].itemImg : arrOptionComb[1][j].itemImg;
                            });
                        }
                        optTempPrice = arrOptionComb[0][i].optPrice*1 + arrOptionComb[1][j].optPrice*1
                        optionPrice = optTempPrice + Math.round((itemPrice-basePrice) * 26)* 10;

                        var 환율 = $('#txtExchangeRate').val()*1;
                        var 원가 = itemPrice*1;
                        var 마진율 = $('#txtMarginRate').val()/100;
                        var 판매수수료 = $('#txtSellerMarketChargeRate').val()/100;
                        var 구매수수료 = $('#txtBuyerMarketChargeRate').val()/100;
                        var 해외배송비 = $('#txtOverSeaDeliveryCharge').val()*1;
                        var productPrice = eval($('#txtFunction').val());
                        var sellPrice = (Math.round((productPrice + optTempPrice) / 10) * 10);
                        //var sumOptPrice = $('#txtExchangeRate').val();
                        //<input name="sku_base_price[]" type="text" value="${basePrice}" class="form-control col-md-2 optBasePrice" readonly="">
                        divOptionComb += `<div class="input-group">
                                <input name="optName_0[]" type="text" value="`+arrOptionComb[0][i].optName+`" class="form-control col" readonly="">
                                <input name="optName_1[]" type="text" value="`+arrOptionComb[1][j].optName+`" class="form-control col" readonly="">
                                
                                <input name="sku_discount_price[]" type="text" value="${itemPrice}" class="form-control col-md-2 optDiscountPrice" readonly="">
                                <input name="sku_sell_price[]" type="text" value="${sellPrice}" class="form-control col-md-2 optSellPrice" readonly="">
                                <input name="sku_option_price[]" type="text" value="${optionPrice}" class="form-control col-md-2 optAddPrice" readonly="">
                                <input name="sku_stock[]" type="text" value="${stock}" class="form-control col-md-1 optComStock">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-warning btnSoldOut">품절</button>
                                    <button type="button" class="btn btn-danger btnDeleteCombRow"><i class="far fa-trash-alt"></i></button>
                                </div>
                                <input name="sku_image[]" type="hidden" value="` + sku_image + `">
                            </div>`;
                    }
                }
            }else if(arrOptionComb.length == 3){
                var optionCounterInfor = `<span class="badge badge-success mb-2">옵션1 - ${arrOptionComb[0].length} 개</span>
                                        <span class="badge badge-success mb-2">옵션2 - ${arrOptionComb[1].length} 개</span>
                                        <span class="badge badge-success mb-2">옵션2 - ${arrOptionComb[2].length} 개</span>
                                        <span class="badge badge-primary mb-2">옵션조합 총갯수 - ${arrOptionComb[0].length * arrOptionComb[1].length * arrOptionComb[2].length}개</span>`;
                $("#optionCounter").html(optionCounterInfor);
                for(i=0; i<arrOptionComb[0].length; i++){
                    for (j = 0; j < arrOptionComb[1].length; j++) {
                        for (k = 0; k < arrOptionComb[2].length; k++) {
                            var stock=0;
                            var basePrice = $('#txtDiscountPrice').val()*1;
                            var itemPrice = $('#txtDiscountPrice').val()*1;
                            var optionPrice = 0;
                            var sku_image = "";
                            if(window.skus != "undefined"){
                                window.skus.forEach((el, idx)=>{
                                    var itemId1 = arrOptionComb[0][i].itemId;
                                    var itemId2 = arrOptionComb[1][j].itemId;
                                    var itemId3 = arrOptionComb[2][k].itemId;
                                    if(el.properties.indexOf(itemId1) >=0 && el.properties.indexOf(itemId2) >=0 && el.properties.indexOf(itemId3) >=0)
                                    {
                                        stock = el.quantity;
                                        //basePrice = addZeroes(el.orginal_price == undefined ? basePrice : el.orginal_price);
                                        itemPrice = el.price;
                                    }
                                    sku_image = arrOptionComb[0][i].itemImg != "" ? arrOptionComb[0][i].itemImg : (arrOptionComb[1][j].itemImg != "" ? arrOptionComb[1][j].itemImg : arrOptionComb[2][k].itemImg);
                                });
                            }
                            optTempPrice = arrOptionComb[0][i].optPrice*1 + arrOptionComb[1][j].optPrice*1 + arrOptionComb[2][k].optPrice*1;
                            optionPrice = optTempPrice + Math.round((itemPrice-basePrice) * 26)* 10;

                            var 환율 = $('#txtExchangeRate').val()*1;
                            var 원가 = itemPrice*1;
                            var 마진율 = $('#txtMarginRate').val()/100;
                            var 판매수수료 = $('#txtSellerMarketChargeRate').val()/100;
                            var 구매수수료 = $('#txtBuyerMarketChargeRate').val()/100;
                            var 해외배송비 = $('#txtOverSeaDeliveryCharge').val()*1;
                            var productPrice = eval($('#txtFunction').val());
                            var sellPrice = (Math.round((productPrice + optTempPrice) / 10) * 10);
                            //var sumOptPrice = $('#txtExchangeRate').val();
                            //<input name="sku_base_price[]" type="text" value="${basePrice}" class="form-control col-md-2 optBasePrice" readonly="">
                            divOptionComb += `<div class="input-group">
                                <input name="optName_0[]" type="text" value="`+arrOptionComb[0][i].optName+`" class="form-control col" readonly="">
                                <input name="optName_1[]" type="text" value="`+arrOptionComb[1][j].optName+`" class="form-control col" readonly="">
                                <input name="optName_2[]" type="text" value="`+arrOptionComb[2][k].optName+`" class="form-control col" readonly="">
                                
                                <input name="sku_discount_price[]" type="text" value="${itemPrice}" class="form-control col-md-2 optDiscountPrice" readonly="">
                                <input name="sku_sell_price[]" type="text" value="${sellPrice}" class="form-control col-md-2 optSellPrice" readonly="">
                                <input name="sku_option_price[]" type="text" value="${optionPrice}" class="form-control col-md-2 optAddPrice" readonly="">
                                <input name="sku_stock[]" type="text" value="${stock}" class="form-control col-md-1 optComStock">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-warning btnSoldOut">품절</button>
                                    <button type="button" class="btn btn-danger btnDeleteCombRow"><i class="far fa-trash-alt"></i></button>
                                </div>
                                <input name="sku_image[]" type="hidden" value="` + sku_image + `">
                            </div>`;
                        }
                    }
                }
            }
            
            $('#divOptionCombinationBox').html(divOptionComb);
        });
        $('body').on('click', '.btnSearchCategory', function() {
            var inputTag = $(this).parent().prev();
            var cateId = inputTag.attr('cate-id');
            var listGroupTag = $(this).parent().parent().next();
            if(listGroupTag.prop('tagName') == "DIV" && listGroupTag.attr('class') == "list-group"){
                listGroupTag.remove();
            }
            SearchCategorySolution(inputTag, cateId);
        });
        $('body').on('click', '#btnCalWithBasePrice', function() {
            var 환율 = parseFloat($('#txtExchangeRate').val());
            var 원가 = parseInt($('#txtDiscountPrice').val());
            var 마진율 = parseFloat($('#txtMarginRate').val()/100);
            var 판매수수료 = parseFloat($('#txtSellerMarketChargeRate').val()/100);
            var 구매수수료 = parseFloat($('#txtBuyerMarketChargeRate').val()/100);
            var 해외배송비 = parseInt($('#txtOverSeaDeliveryCharge').val());
            var productPrice = eval($('#txtFunction').val());
            $("#txtProductPrice").val(Math.round(productPrice / 10) * 10);
            $("#txtExpectedRevenue").val(Math.round($("#txtProductPrice").val() * $("#txtMarginRate").val()/100));
        });        
        $('body').on('click', '#btnCalWithDiscount', function() {
            var 환율 = parseFloat($('#txtExchangeRate').val());
            var 원가 = parseFloat($('#txtDiscountPrice').val());
            var 마진율 = parseFloat($('#txtMarginRate').val()/100);
            var 판매수수료 = parseFloat($('#txtSellerMarketChargeRate').val()/100);
            var 구매수수료 = parseFloat($('#txtBuyerMarketChargeRate').val()/100);
            var 해외배송비 = parseInt($('#txtOverSeaDeliveryCharge').val());
            var productPrice = eval($('#txtFunction').val());
            $("#txtProductPrice").val(Math.round(productPrice / 10) * 10);
            $("#txtOptionSellPrice").val(Math.round(productPrice / 10) * 10);
            $("#txtOptionSSPrice").val(Math.round(productPrice / 20) * 10);//스스50프로 추가금
            $("#txtOptionESMPrice").val(Math.round(productPrice / 20) * 10);
            $("#txtExpectedRevenue").val(Math.round($("#txtProductPrice").val() * $("#txtMarginRate").val()/100));
        });
        $('body').on('click', '.btnSoldOut', function() {
            $(this).parent().prev().val(0);
        });
        $('body').on('click', '.btnDeleteCombRow', function () {
            var index = $(this).parent().parent().remove();
        });
        var SearchCategorySolution = function (element, cateId) {
            var keyword = element.val();
            var action = '/scratchProductScrap/category/search/'+cateId;// $("#manageMarketAccount").attr("action");
            $.ajax({
                url: action,
                data: {keyword},
                type: "GET",
                dataType: 'json',
                success: function ({status, data}) {
                    var content=`<div class="list-group"><small>`;
                    data.forEach((el, index)=>{
                        content +=`<a href="javascript:void(0)" data-id="${el.nIdx}" data-code="${el.strCateCode}" class="list-group-item list-group-item-action pt-1 pb-1 bg-light categoryItem">${el.strCategoryName}</a>`;
                       
                    });
                    content+="</small></div>";
                    element.parent().after(content);
                },
                error: function (data) {
                    
                }
            });    
        };
        $('body').on('click', '.categoryItem', function() {
            var inputTag = $(this).parent().parent().prev().children().first();

            var cateCode = $(this).attr('data-code') == "null" || $(this).attr('data-code') == "" ? "0" : $(this).attr('data-code');
            inputTag.val(cateCode + " : " + $(this).text());

            $(this).parent().parent().remove();
            if(inputTag.attr('cate-id') == "0"){//카테고리 통합검색이라면
                var action = '/scratchProductScrap/category/select/0';// $("#manageMarketAccount").attr("action");
                var keyword = $(this).text();
                $.ajax({
                    url: action,
                    data: {keyword},
                    type: "GET",
                    dataType: 'json',
                    success: function ({status, data}) {
                        var inputTags = $("input[name='txtCategoryName[]']")
                        data.forEach((element, index) => {
                            if(index > 0 && element != null){
                                    inputTags.eq(index).val(element.strCateCode + " : " + element.strCategoryName);
                            }
                        });
                    },
                    error: function (data) {
                    }
                });
            }
        });
        $(window).keydown(function(event){
            console.log('aaa');
            if(event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        $('body').on('blur', '#txtKrMainName', function() {
            var txt = $(this).val();
            var txtlength = string_byte_length(txt);
            if(txtlength <= 0){
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
                $("#titleSizeInfo").html(string_byte_length(txt) + ' / 100 byte 필수입력!');
                $("#titleSizeInfo").addClass('text-danger');
                $("#titleSizeInfo").removeClass('text-success');
                return false;
            }else if(txtlength <= 100){
                $(this).addClass('is-valid');
                $(this).removeClass('is-invalid');
                $("#titleSizeInfo").html(string_byte_length(txt) + ' / 100 byte');
                $("#titleSizeInfo").removeClass('text-danger');
                $("#titleSizeInfo").addClass('text-success');
            }else{
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
                $("#titleSizeInfo").html(string_byte_length(txt) + ' / 100 byte 글자수초과!');
                $("#titleSizeInfo").addClass('text-danger');
                $("#titleSizeInfo").removeClass('text-success');
            }

                if(string_byte_length(txt) > 50){
                    $("#txtKrSubName").val(substr_utf8_bytes(txt, 0, 50));
                }else{
                    $("#txtKrSubName").val(txt);
                }

            // var pattern = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
            // if ( txt && txt.length > 2 && pattern.test(txt) && txt.length <= 100) {
            //     $(this).removeClass('is-valid');
            //     $(this).addClass('is-invalid');
            // } else {
            //     $(this).removeClass('is-invalid');
            //     $(this).addClass('is-valid');
            //     var temp = $(this).val();
            //     if(string_byte_length(temp) > 50){
            //         $("#txtKrSubName").val(substr_utf8_bytes(temp, 0, 50));
            //     }else{
            //         $("#txtKrSubName").val(temp);
            //     }
            // }
        });
        $('body').on('blur', '.txtOptionName', function() {
            var txt = $(this).val();
            
            if(string_byte_length(txt) > 30 || string_byte_length(txt) <= 0){
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
            }else{
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
            }
        });
    });
    function charByteSize(ch) {
        if (ch == null || ch.length == 0) {
            return 0;
        }
        var charCode = ch.charCodeAt(0);
        if (charCode <= 0x00007F) {
            return 1;
        } else if (charCode <= 0x0007FF) {
            return 2;
        } else if (charCode <= 0x00FFFF) {
            return 3;
        } else {
            return 4;
        }
    }
    function string_byte_length(str) {
        return (new TextEncoder().encode(str)).length;
    }
    function substr_utf8_bytes(str, startInBytes, lengthInBytes) {

        var resultStr = '';
        var startInChars = 0;

        for (bytePos = 0; bytePos < startInBytes; startInChars++) {
            ch = str.charCodeAt(startInChars);
            bytePos += (ch < 128) ? 1 : encode_utf8(str[startInChars]).length;
        }
        end = startInChars + lengthInBytes - 1;
        for (n = startInChars; startInChars <= end; n++) {
            ch = str.charCodeAt(n);
            end -= (ch < 128) ? 1 : encode_utf8(str[n]).length;
            resultStr += str[n];        
        }

        return resultStr;
    }
    function encode_utf8( s )
    {
        return unescape( encodeURIComponent( s ) );
    }
    function IndexChar(index){
        const ColumnBase = 26;
        const DigitMax = 7; // ceil(log26(Int32.Max))
        const Digits = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        if (index <= 0){
            return;
        }
            
        var sb = new StringBuilder().Append(' ', DigitMax);
        var current = index;
        var offset = DigitMax;
        while (current > 0)
        {
            sb[--offset] = Digits[--current % ColumnBase];
            current /= ColumnBase;
        }
        return sb.ToString(offset, DigitMax - offset);
    }

    function addZeroes(num) {
        return parseFloat(num).toFixed(2);
    }
    // const getCombinations = function (arr, selectNumber) {
    //     int lengthArr = arr.length;
    //     loop1:
    //     var fix = arr[0];
    //     arr = arr.slice(1)
    //     for (let index = 0; index < fix.length; index++) {
    //         if(lengthArr > 0){
    //             lengthArr --;
    //             goto loop1;
    //         }       
    //     }
    //     return results; // 결과 담긴 results return
    // }
    const getCombinations1 = function (arr, selectNumber) {
        const results = [];
        if (selectNumber === 1){
            return arr.map((value) => [value]);
        }  // 1개씩 택할 때, 바로 모든 배열의 원소 return

        arr.forEach((fixed, index, origin) => {
            
            const rest = origin.slice(index + 1); // 해당하는 fixed를 제외한 나머지 뒤
            //console.log(rest);
            const combinations = getCombinations(rest, selectNumber - 1); // 나머지에 대해서 조합을 구한다.
            console.log(combinations);
            const attached = combinations.map((combination) => {
               console.log(fixed);
               console.log(combination);
               return [fixed, ...combination];
            }); //  돌아온 조합에 떼 놓은(fixed) 값 붙이기
            // var comArr = [];
            // fixed.forEach((element)=>{

            // });
            results.push(...attached); // 배열 spread syntax 로 모두다 push
        });
        //0,1,2
        //0,1,3
        return results; // 결과 담긴 results return
    }
    </script>
    @endsection
@endsection