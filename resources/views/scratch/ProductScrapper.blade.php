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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Step 1. 상품수집</h5>
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
                        <h5 class="card-title mb-0">Step 2. 카테고리</h5>
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
                                        <input type="text" class="form-control" placeholder="통합검색">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" id="button-search"><i class="fas fa-search"></i> 검색</button>
                                        </div>
                                    </div>
                                    <div class="list-group">
                                        <small>
                                        </small>
                                    </div>

                                </div>
                                <button type="button" class="btn btn-xs m-1 btn-outline-success" onclick="window.open('/ctg_n.html','전체카테고리','width=900,height=900,location=no,status=no,scrollbars=no')"> 전체보기</button>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right"></label>
                                <span class="text-success"> 어린이제품, 식품, 북마켓 등 일부마켓 특수권한 필요 카테고리 주의</span>
                            </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-sm-2 text-sm-right">스마트스토어</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control text-sm" placeholder="미설정">
                                            <div class="input-group-append">
                                                <button class="btn btn-success" type="button" id="button-search"><i class="fas fa-search"></i> 검색</button>
                                            </div>
                                        </div>
                                        <div class="list-group">
                                            <small>
                                            </small>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-xs m-1 btn-outline-success" onclick="window.open('/ctg_n.html','전체카테고리','width=900,height=900,location=no,status=no,scrollbars=no')"> 전체보기</button>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-sm-2 text-sm-right">쿠팡</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control text-sm" placeholder="미설정">
                                            <div class="input-group-append">
                                                <button class="btn btn-success" type="button" id="button-search"><i class="fas fa-search"></i> 검색</button>
                                            </div>
                                        </div>
                                        <div class="list-group">
                                            <small>
                                            </small>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-xs m-1 btn-outline-success" onclick="window.open('/ctg_c.html','전체카테고리','width=900,height=900,location=no,status=no,scrollbars=no')"> 전체보기</button>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-sm-2 text-sm-right">11번가 글로벌</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control text-sm" placeholder="미설정">
                                            <div class="input-group-append">
                                                <button class="btn btn-success" type="button" id="button-search"><i class="fas fa-search"></i> 검색</button>
                                            </div>
                                        </div>
                                        <div class="list-group">
                                            <small>
                                            </small>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-xs m-1 btn-outline-success" onclick="window.open('/ctg_1.html','전체카테고리','width=900,height=900,location=no,status=no,scrollbars=no')"> 전체보기</button>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-sm-2 text-sm-right">11번가 일반</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control text-sm" placeholder="미설정">
                                            <div class="input-group-append">
                                                <button class="btn btn-success" type="button" id="button-search"><i class="fas fa-search"></i> 검색</button>
                                            </div>
                                        </div>
                                        <div class="list-group">
                                            <small>
                                            </small>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-xs m-1 btn-outline-success" onclick="window.open('/ctg_1r.html','전체카테고리','width=900,height=900,location=no,status=no,scrollbars=no')"> 전체보기</button>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-sm-2 text-sm-right">옥션</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control text-sm" placeholder="미설정">
                                            <div class="input-group-append">
                                                <button class="btn btn-success" type="button" id="button-search"><i class="fas fa-search"></i> 검색</button>
                                            </div>
                                        </div>
                                        <div class="list-group">
                                            <small>
                                            </small>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-xs m-1 btn-outline-success" onclick="window.open('/ctg_a.html','전체카테고리','width=900,height=900,location=no,status=no,scrollbars=no')"> 전체보기</button>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-sm-2 text-sm-right">G마켓</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control text-sm" placeholder="미설정">
                                            <div class="input-group-append">
                                                <button class="btn btn-success" type="button" id="button-search"><i class="fas fa-search"></i> 검색</button>
                                            </div>
                                        </div>
                                        <div class="list-group">
                                            <small>
                                            </small>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-xs m-1 btn-outline-success" onclick="window.open('/ctg_g.html','전체카테고리','width=900,height=900,location=no,status=no,scrollbars=no')"> 전체보기</button>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-sm-2 text-sm-right">인터파크</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control text-sm" placeholder="미설정">
                                            <div class="input-group-append">
                                                <button class="btn btn-success" type="button" id="button-search"><i class="fas fa-search"></i> 검색</button>
                                            </div>
                                        </div>
                                        <div class="list-group">
                                            <small>
                                            </small>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-xs m-1 btn-outline-success" onclick="window.open('/ctg_i.html','전체카테고리','width=900,height=900,location=no,status=no,scrollbars=no')"> 전체보기</button>
                                </div>
                                <div class="form-group row mb-0">
                                    <label class="col-form-label col-sm-2 text-sm-right">위메프</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control text-sm" placeholder="미설정">
                                            <div class="input-group-append">
                                                <button class="btn btn-success" type="button" id="button-search"><i class="fas fa-search"></i> 검색</button>
                                            </div>
                                        </div>
                                        <div class="list-group">
                                            <small>
                                            </small>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-xs m-1 btn-outline-success" onclick="window.open('/ctg_w.html','전체카테고리','width=900,height=900,location=no,status=no,scrollbars=no')"> 전체보기</button>
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
                        <h5 class="card-title mb-0">Step 3. 상품 기본정보</h5>
                    </div>
                    <div class="card-body">
                        <fieldset >
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right">상품명(CN)</label>
                                <div class="col-sm-8">
                                    <input  type="url" name="txtChMainName" id="txtChMainName" value="" class="form-control form-control-sm" placeholder="상품명">
                                </div>
                                <div class="col-sm-2 mt-1">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="customSwitchTr">
                                        <label class="custom-control-label" for="customSwitchTr">번역</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right">상품명(KO)</label>
                                <div class="col-sm-8">
                                    <input type="text" name="txtKrMainName" id="txtKrMainName" class="form-control form-control-sm" placeholder="상품명">
                                        <span class="text-success"> 93 / 100 byte </span>
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
                            <hr>
                            <fieldset style="color:">
                                <div class="form-group row">
                                    <label class="col-form-label col-sm-2 text-sm-right">대표이미지</label>
                                    <div class="col-sm-9 row mb-0">
                                        <label class="col-form-label col-sm-12 text-sm-left text-success">jpg,png만 등록가능, 1000x1000 권장, 600x600 이상, 5000x5000 이하, 2MB이하(인터파크1MB)</label>
                                        <div class="col-sm-4">
                                            <span class="badge badge-primary">적합 - 800x800, 232KB</span>
                                            <div class="card text-white bg-warning">
                                                <img class="card-img-top blur" id="mainImage" src="https://via.placeholder.com/300/FFFFFF?text=Main Image" alt="Unsplash">
                                                <div class="card-body">
                                                    <p class="card-text">대표이미지</p>
                                                    <hr>
                                                    <fieldset>
                                                        <button class="btn btn-success btn-sm mb-2">권장사이즈 리사이징</button>
                                                    </fieldset>
                                                    <br>
                                                    <span><i class="fas fa-file-upload text-danger fa-lg"></i> 이미지파일 업로드</span>
                                                    <input type="file" _bl_1b3118da-5512-4ddc-a786-9e8765f0c0a6="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <span class="badge badge-primary">적합 - 800x800, 188KB</span>
                                            <div class="card text-white bg-secondary">
                                                <img class="card-img-top opacity" id="subImage1" src="https://via.placeholder.com/300/FFFFFF?text=Sub Image1" alt="Unsplash" style="filter:none">
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
                                                        <button class="btn btn-success btn-sm mb-2">권장사이즈 리사이징</button>
                                                    </fieldset>
                                                    <br>
                                                    <span><i class="fas fa-file-upload text-danger fa-lg"></i> 이미지파일 업로드</span>
                                                        <input type="file" _bl_31553d72-6893-4655-9b47-d8c306bbc156="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <span class="badge badge-primary">적합 - 800x800, 252KB</span>
                                            <div class="card text-white bg-secondary">
                                                <img class="card-img-top opacity" id="subImage2" src="https://via.placeholder.com/300/FFFFFF?text=Sub Image2" alt="Unsplash" style="filter:none">
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
                                                        <button class="btn btn-success btn-sm mb-2">권장사이즈 리사이징</button>
                                                    </fieldset>
                                                    <br>
                                                    <span><i class="fas fa-file-upload text-danger fa-lg"></i> 이미지파일 업로드</span>
                                                        <input type="file" _bl_4c09d0e2-faa7-45d8-8667-5b60e07517fd="">
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <label class="col-form-label col-sm-2 text-sm-right"></label>
                                    <div class="col-sm-9 row mb-0" id="imageContainer">
                                        <div class="col-sm-2 pl-1 pr-0">
                                            <span class="badge badge-primary">적합 - 800x800, 127KB</span>
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
                                                    <span class="badge badge-primary">적합 - 800x800, 145KB</span>
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
                                            <span class="badge badge-primary">적합 - 800x800, 99KB</span>
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
                                            <span class="badge badge-primary">적합 - 800x800, 122KB</span>
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
                                            <span class="badge badge-primary">적합 - 800x800, 178KB</span>
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
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button" id="button-search">다시계산</button>
                                            </div>
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
                                        <div class="form-group col-md-3">
                                            <label class="form-label">원가 (할인전정상가)</label>
                                            <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-globe-americas"></i></div>
                                                </div>
                                                <input type="text" name="txtBasePrice" id="txtBasePrice" class="form-control" placeholder="원가">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="form-label">할인가</label>
                                            <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-globe-americas"></i></div>
                                                </div>
                                                <input type="text" name="txtDiscountPrice" id="txtDiscountPrice" class="form-control" placeholder="할인가">
                                                <div class="input-group-append">
                                                    <button class="btn btn-success" type="button"> 원가로적용</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="form-label">오늘 환율</label>
                                            <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">₩</div>
                                                </div>
                                                <input type="text" name="txtExchageRate" id="txtExchangeRate" value="173" class="form-control">
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
                                                        <input type="text" name="txtSellerMarketCharge" id="txtSellerMarketCharge" value="30" class="form-control" placeholder="Input">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="form-label">구매마켓 수수료</label>
                                                    <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">%</div>
                                                        </div>
                                                        <input type="text" name="txtBuyerMarketCharge" id="txtBuyerMarketCharge"  value="5" class="form-control" placeholder="Input">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="form-label">해외배송비(배대지)</label>
                                                    <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">₩</div>
                                                        </div>
                                                        <input type="text" name="txtOverSeaCharge" id="txtOverSeaCharge" value="6000" class="form-control" placeholder="Input">
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
                                                                <button class="btn btn-success" type="button">기본식 입력</button>
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
                                                        <input type="text" name="txtReturnDeliveryCharge" id="txtReturnDeliverCharge" value="25000" class="form-control">
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
                                                        <input type="text" name="txtOptionStock" id="txtOptionStock" value="999" class="form-control" placeholder="Input">
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
                                                    <button type="button" class="btn btn-info">
                                                        <i class="fas fa-sync-alt"></i> 옵션 관련 입력한 기준가격 모두보기 (판매가, 스스 ESM 50% 추가금)
                                                    </button>
                                                    <br>
                                                    <span class="text-success"> 조회전용. 기준가격들 수정 시 버튼 재클릭해야 결과값 갱신됨</span>
                                                    <hr>
                                                    {{-- <fieldset >
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <label class="form-label">상품 기본가(판매가)</label>
                                                                <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">₩</div>
                                                                    </div>
                                                                    <input type="text" class="form-control" placeholder="Input">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="form-label">상품 기본가 원가</label>
                                                                <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">현지화</div>
                                                                    </div>
                                                                    <input type="text" class="form-control" placeholder="Input">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="form-label">상품 기본가 할인가</label>
                                                                <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">현지화</div>
                                                                    </div>
                                                                    <input type="text" class="form-control" placeholder="Input">
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
                                                                    <input type="text" class="form-control" placeholder="Input">
                                                                </div>
                                                                <span class="text-success">(판매가*마켓가중치+할인) / 2</span>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="form-label">ESM 50% 추가금</label>
                                                                <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">₩</div>
                                                                    </div>
                                                                    <input type="text" class="form-control" placeholder="Input">
                                                                </div>
                                                                <span class="text-success">(판매가*마켓가중치+할인+개별배송비) / 2</span>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="form-label">판매가 할인</label>
                                                                <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">₩</div>
                                                                    </div>
                                                                <input type="text" class="form-control" placeholder="Input" value="미설정">
                                                                </div>
                                                                <span class="text-success">우측 상세설정란에서 설정</span>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="form-label">ESM 합산 개별배송비</label>
                                                                <div class="input-group input-group-sm mb-2 mr-sm-2">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">₩</div>
                                                                    </div>
                                                                        <input type="text" class="form-control" placeholder="Input">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset> --}}
                                                </div>
                                            </div>
                                            <div class="col-md-12 form-group row mb-0">
                                                    <div class="form-group col-md-3 mb-0 ml-0">
                                                            <div class="btn-group btn-group-sm" role="group">
                                                                    <button class="btn btn-success" type="button">옵션원가 적용</button>
                                                                    <button class="btn btn-outline-success" type="button">&nbsp;할인가 적용&nbsp;</button>
                                                            </div>
                                                    </div>
                                                <div class="input-group input-group-sm input-group-sm col-md-3">
                                                    <input type="text" class="form-control">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-success" type="button"> 옵션마진 재계산</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <hr>
                                            </div>
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
                                            <div id="divOptionField">
                                                {{-- <div class="col-sm-12">
                                                    <div class="card bg-secondary-light">
                                                        <div class="card-body">
                                                            <label class="form-label font-weight-bold">옵션 1</label>
                                                            <button type="button" class="close text-danger">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                            <br>
                                                            <div class="form-group row">
                                                                <div class="input-group input-group-sm m-3">
                                                                    <input type="text" class="form-control text-center col-md-3 font-weight-bold" value="옵션명" readonly="">
                                                                    <input type="text" class="form-control text-center">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-11 row">
                                                                    <div class="col-sm-6 row">
                                                                        <div class="col-sm-3 p-0 text-center">
                                                                            <label class="col-form-label pl-0 pr-0 text-center font-weight-bold">이미지</label>
                                                                        </div>
                                                                        <div class="col-sm-9 p-0">
                                                                            <label class="col-form-label col-sm-4 pl-0 pr-0 text-center font-weight-bold">옵션값</label>
                                                                            <button class="btn btn-sm btn-dark"><i class="fas fa-sort-numeric-down"></i></button>
                                                                            <button class="btn btn-sm btn-dark"><i class="fas fa-sort-alpha-down"></i></button>
                                                                            <button class="btn btn-sm btn-dark text-sm"><i class="fas fa-eraser"></i>특수문자</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3 row pl-0">
                                                                        <label class="col-form-label col-sm-5 pl-0 pr-1 text-right font-weight-bold">옵션추가금</label>
                                                                        <div class="input-group input-group-sm col-sm-7 pl-0">
                                                                            <input type="text" class="form-control">
                                                                            <div class="input-group-append mb-1">
                                                                                <button class="btn btn-sm btn-dark" type="button">+</button>
                                                                                <button class="btn btn-sm btn-dark" type="button">-</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                        <div class="col-sm-3 row">
                                                                            <label class="col-form-label col-sm-5 text-left font-weight-bold pl-0 pr-0">추가(현)</label>
                                                                            <label class="col-form-label col-sm-3 text-center font-weight-bold pl-0 pr-0">원가</label>
                                                                            <label class="col-form-label col-sm-4 text-right font-weight-bold pl-0 pr-0">할인가</label>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                            <div id="divOptionContainer_0">
                                                                <div class="input-group">
                                                                    <a href="img/no-image.png" target="_blank">
                                                                        <img class="rounded" src="img/no-image.png" width="40" height="40">
                                                                    </a>
                                                                    <fieldset>
                                                                        <button class="btn btn-info p-1"><label for="inputFileOpt01"><i class="fas fa-file-upload fa-lg"></i></label></button>
                                                                        <input type="file" id="inputFileOpt01" hidden="" _bl_86b8e158-2648-446a-97db-03609da33643="">
                                                                    </fieldset>
                                                                    <input type="text" class="form-control col-md-3">
                                                                    <input type="text" class="form-control col-md-3">
                                                                    <input type="text" class="form-control col-md-3">
                                                                    <input type="text" class="form-control col-md-1" readonly="">
                                                                    <input type="text" class="form-control col-md-1" readonly="">
                                                                    <input type="text" class="form-control col-md-1">
                                                                    <div class="input-group-append">
                                                                            <button class="btn btn-info border-secondary">이동</button>
                                                                        <button class="btn btn-primary"><i class="fas fa-plus"></i></button>
                                                                        <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                            <button class="btn btn-success btn-block"><i class="fas fa-plus"></i> 추가</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="card bg-secondary-light">
                                                        <div class="card-body">
                                                            <label class="form-label font-weight-bold">옵션 2</label>
                                                            <button type="button" class="close text-danger">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                            <br>
                                                            <div class="form-group row">
                                                                <div class="input-group input-group-sm m-3">
                                                                    <input type="text" class="form-control text-center col-md-3 font-weight-bold" value="옵션명" readonly="">
                                                                    <input type="text" class="form-control text-center">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-11 row">
                                                                    <div class="col-sm-6 row">
                                                                        <div class="col-sm-3 p-0 text-center">
                                                                            <span class="badge badge-success">기준</span>
                                                                            <label class="col-form-label pl-0 pr-0 text-center font-weight-bold">이미지</label>
                                                                        </div>
                                                                        <div class="col-sm-9 p-0">
                                                                            <label class="col-form-label col-sm-4 pl-0 pr-0 text-center font-weight-bold">옵션값</label>
                                                                            <button class="btn btn-sm btn-dark"><i class="fas fa-sort-numeric-down"></i></button>
                                                                            <button class="btn btn-sm btn-dark"><i class="fas fa-sort-alpha-down"></i></button>
                                                                            <button class="btn btn-sm btn-dark text-sm"><i class="fas fa-eraser"></i>특수문자</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3 row pl-0">
                                                                        <label class="col-form-label col-sm-5 pl-0 pr-1 text-right font-weight-bold">옵션추가금</label>
                                                                        <div class="input-group input-group-sm col-sm-7 pl-0">
                                                                            <input type="text" class="form-control">
                                                                            <span class="input-group-append mb-1">
                                                                            <button class="btn btn-dark" type="button">+</button>
                                                                            </span>
                                                                            <span class="input-group-append mb-1">
                                                                            <button class="btn btn-dark" type="button">-</button>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                        <div class="col-sm-3 row">
                                                                            <label class="col-form-label col-sm-5 text-left font-weight-bold pl-0 pr-0">추가(현)</label>
                                                                            <label class="col-form-label col-sm-3 text-center font-weight-bold pl-0 pr-0">원가</label>
                                                                            <label class="col-form-label col-sm-4 text-right font-weight-bold pl-0 pr-0">할인가</label>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                            <div id="divOptionContainter_1">
                                                                <div class="input-group">
                                                                    <a href="https://img.alicdn.com/imgextra/i1/2423612906/O1CN016NTFbv1XKzXazcB3u_!!2423612906.jpg_600x600q90.jpg" target="_blank">
                                                                        <img class="rounded" src="https://img.alicdn.com/imgextra/i1/2423612906/O1CN016NTFbv1XKzXazcB3u_!!2423612906.jpg_600x600q90.jpg" width="40" height="40">
                                                                    </a>
                                                                    <fieldset>
                                                                        <button class="btn btn-info p-1"><label for="inputFileOpt11"><i class="fas fa-file-upload fa-lg"></i></label></button>
                                                                        <input type="file" id="inputFileOpt11" hidden="" _bl_a4fe7226-dc05-4134-b89b-66818883ea5d="">
                                                                    </fieldset>
                                                                    <input type="text" class="form-control col-md-3">
                                                                    <input type="text" class="form-control col-md-3">
                                                                    <input type="text" class="form-control col-md-3">
                                                                    <input type="text" class="form-control col-md-1" readonly="">
                                                                    <input type="text" class="form-control col-md-1" readonly="">
                                                                    <input type="text" class="form-control col-md-1">
                                                                    <div class="input-group-append">
                                                                            <button class="btn btn-info border-secondary">이동</button>
                                                                        <button class="btn btn-primary"><i class="fas fa-plus"></i></button>
                                                                        <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button class="btn btn-success btn-block"><i class="fas fa-plus"></i> 추가</button>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                            <div class="col-sm-12">
                                                <button class="btn btn-success btn-block"><i class="fas fa-plus"></i> 새 옵션명 추가</button>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                {{-- <div class="col-sm-12">
                                    <div class="alert bg-light">
                                        <div class="alert-message">
                                            <button type="button" class="btn btn-info">
                                                <i class="fas fa-th"></i> 옵션조합보기 &amp; 옵션별 재고입력 (비필수)
                                            </button>
                                        </div>
                                    </div>
                                </div> --}}
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
                                    옵션1 - 11 개
                                </span>
                                <span class="badge badge-success mb-2">
                                    옵션2 - 36 개
                                </span>
                                <span class="badge badge-primary mb-2">
                                    옵션조합 총갯수 - 396 개
                                </span>
                            </div>
                        </fieldset>
                        {{-- <button class="btn btn-primary btn-lg btn-block"><i class="fas fa-check"></i> 확인</button> --}}
                    </div>
                </div>
                <fieldset >
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Step 5. 상품 상세설명</h5>
                        </div>
                        <div class="card-body">
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

                            <span class="text-success"> 마켓별 글자수 제한 글자잘림 유의. 공통 30000 byte 이내 권장.</span>

                            <div class="alert alert-secondary mb-0 mt-2">
                                <div class="alert-message pb-0">
                                    <div class="form-group ml-3">
                                        <span><i class="fas fa-file-upload text-primary fa-lg"></i> 내 이미지파일 삽입(최대2MB) &nbsp;</span>
                                        <input type="file" multiple="" _bl_2ccc0c2d-aaa9-4aea-a408-da28302f0ea7="">
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
                                    <button class="btn btn-primary btn-lg btn-block"><!--!--><i class="fas fa-check"></i> 상품등록</button>
                        </div>
                    </div>
                </fieldset>
                <div class="row">
                    <div class="col-12 col-lg-2">
                        <button class="btn btn-outline-success btn-block"><i class="far fa-save"></i> 임시저장</button>
                    </div>
                    <div class="col-12 col-lg-2">
                        <button class="btn btn-outline-success btn-block"><i class="far fa-share-square"></i> 임시저장 불러오기</button>
                    </div>
                </div>
                <input type="text" id="hdDescription" class="form-control" hidden="">
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
            var img_src = $(this).attr('data-src');
            $('#mainImage').attr('src', img_src);
            return false;
        });	
        // 첨부이미지 1 바꾸기
        $('body').on('click', '.btnSubImage1', function () {
            var img_src = $(this).attr('data-src');
            $('#subImage1').attr('src', img_src);
            return false;
        });	
        // 첨부이미지 2 바꾸기
        $('body').on('click', '.btnSubImage2', function () {
            var img_src = $(this).attr('data-src');
            $('#subImage2').attr('src', img_src);
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
                        $("#txtDiscountPrice").val(data.price);
                        $("#txtBasePrice").val(data.price);
                        var 환율 = 173;
                        var 원가 = data.price;
                        var 마진율 = 0.1;
                        var 판매수수료 = 0.3;
                        var 구매수수료 = 0.05;
                        var 해외배송비 = 6000;
                        var productPrice = eval($('#txtFunction').val());
                        $("#txtProductPrice").val(Math.round(productPrice / 10) * 10);

                        var 마진율 = 0;
                        var 판매수수료 = 0;
                        var 구매수수료 = 0;
                        var productPrice = eval($('#txtFunction').val());
                        $("#txtExpectedRevenue").val($("#txtProductPrice").val() - Math.round(productPrice / 10) * 10);
                        //$("#selBasePriceType").val('CNY');
                        //$("#selCountryShippingCostType").val('CNY');
                        //$("#selWorldShippingCostType").val('KRW');
                        //$("#selWeightType").val('kg');
                        $("#txtChMainName").val(data.chMainName);
                        var re = new RegExp('.{1,' + 100 + '}', 'g');
                        //console.log(C_getByteLength(data.krMainName));
                        $("#txtKrMainName").val(data.krMainName.match(re));
                        re = new RegExp('.{1,' + 50 + '}', 'g');
                        $("#txtKrSubName").val(data.krMainName.match(re));
                        //$("#txtKeyword").val(data.keyword);
                        //$('.subItemsTable tbody').html('');
                        var item = "";
                        var optionTags = "";
                        data.options.forEach( (element, index) => {
                            var num = index+1;
                            optionTags += `<input type="text" class="form-control col-md-3 text-center font-weight-bold" value="`+element.optKoName+`" readonly="">`;
                            item +=`<div class="col-sm-12">
                                        <div class="card bg-secondary-light">
                                            <div class="card-body">
                                                <label class="form-label font-weight-bold">옵션 `+num+`</label>
                                                <button type="button" class="close text-danger">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <br>
                                                <div class="form-group row">
                                                    <div class="input-group input-group-sm m-3">
                                                        <input type="text" class="form-control text-center col-md-3 font-weight-bold" value="옵션명" readonly="">
                                                        <input type="text" name="txtOptionName[]" id="txtOptionName_`+index+`" value=`+ element.optKoName +` class="form-control text-center">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-11 row">
                                                        <div class="col-sm-6 row">
                                                            <div class="col-sm-3 p-0 text-center">
                                                                <label class="col-form-label pl-0 pr-0 text-center font-weight-bold">이미지</label>
                                                            </div>
                                                            <div class="col-sm-9 p-0">
                                                                <label class="col-form-label col-sm-4 pl-0 pr-0 text-center font-weight-bold">옵션값</label>
                                                                <button class="btn btn-sm btn-dark"><i class="fas fa-sort-numeric-down"></i></button>
                                                                <button class="btn btn-sm btn-dark"><i class="fas fa-sort-alpha-down"></i></button>
                                                                <button class="btn btn-sm btn-dark text-sm"><i class="fas fa-eraser"></i>특수문자</button>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 row pl-0">
                                                            <label class="col-form-label col-sm-5 pl-0 pr-1 text-right font-weight-bold">옵션추가금</label>
                                                            <div class="input-group input-group-sm col-sm-7 pl-0">
                                                                <input type="text" class="form-control">
                                                                <div class="input-group-append mb-1">
                                                                    <button class="btn btn-sm btn-dark" type="button">+</button>
                                                                    <button class="btn btn-sm btn-dark" type="button">-</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            <div class="col-sm-3 row">
                                                                <label class="col-form-label col-sm-5 text-left font-weight-bold pl-0 pr-0">추가(현)</label>
                                                                <label class="col-form-label col-sm-3 text-center font-weight-bold pl-0 pr-0">원가</label>
                                                                <label class="col-form-label col-sm-4 text-right font-weight-bold pl-0 pr-0">할인가</label>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div id="divOptionContainer_0">`;
                                        console.log(element.optItems);
                                        var subItem="";
                                        element.optItems.forEach((el, idx) => {
                                            subItem += `<div class="input-group">
                                                        <a href="javascript:void(0)" target="_blank">
                                                            <img class="rounded" src="`+ el[3] +`" width="40" height="40">
                                                        </a>
                                                        <fieldset>
                                                            <button class="btn btn-info p-1"><label for="inputFileOpt_0_"><i class="fas fa-file-upload fa-lg"></i></label></button>
                                                            <input type="file" id="inputFileOpt_`+ index +`_`+ idx +`" hidden="">
                                                        </fieldset>
                                                        <input type="text" value="`+ el[2] +`" class="form-control col-md-3">
                                                        <input type="text" value="`+ el[1] +`" class="form-control col-md-3">
                                                        <input type="text" value="0" class="form-control col-md-3">
                                                        <input type="text" value="0" class="form-control col-md-1" readonly="">
                                                        <input type="text" value="0" class="form-control col-md-1" readonly="">
                                                        <input type="text" value="0" class="form-control col-md-1">
                                                        <div class="input-group-append">
                                                            <!--<button class="btn btn-info border-secondary">이동</button>
                                                            <button class="btn btn-primary"><i class="fas fa-plus"></i></button>--!>
                                                            <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                                        </div>
                                                    </div>`;
                                        });
                                        item +=  subItem + `</div> 
                                                <button class="btn btn-success btn-block"><i class="fas fa-plus"></i> 추가</button>
                                            </div>
                                        </div>
                                    </div>`;
                            
                        });

                        $('#divOptionField').html(item);
                        var imgItem = "";
                        data.images.forEach( (element, index) => {
                            if(index == 0){
                                $('#mainImage').attr('src', element);
                            }
                            if(index == 1){
                                $('#subImage1').attr('src', element);
                            }
                            if(index == 2){
                                $('#subImage2').attr('src', element);
                            }
                            imgItem +=`<div class="col-sm-2 pl-1 pr-0">
                                            <span class="badge badge-primary">적합 - 800x800, 127KB</span>
                                            <div class="card">
                                                <img class="card-img-top blur" src="${element}" id="img_${index}" alt="Product Image" />
                                                <input type="hidden" name="txtImage[]" id="hid_${index}" value="${element}"/>
                                                <div class="card-body p-0">
                                                    <div class="text-center">
                                                        <div class="btn-group btn-block">
                                                            <button class="btn btn-secondary btn-sm pl-0 pr-0 btnMainImage" data-src="${element}">대표</button>
                                                            <button class="btn btn-secondary btn-sm pl-0 pr-0 btnSubImage1" data-src="${element}">추가1</button>
                                                            <button class="btn btn-secondary btn-sm pl-0 pr-0 btnSubImage2" data-src="${element}">추가2</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`;
                        });
                        var optCombination= `<div class="input-group">
                                `+ optionTags +`
                                <input type="text" class="form-control col-md-2 text-center font-weight-bold" value="옵션추가금" readonly="">
                                <input type="text" class="form-control col-md-1 text-center font-weight-bold" value="재고" readonly="">
                                <div class="input-group-append">
                                    <button class="btn invisible">품절</button>
                                </div>
                            </div>`;
                        data.items.forEach((element, index)=>{
                            var combination = '';
                            element.options.forEach((el, idx) =>{
                                combination +='<input type="text" value="'+ el +'" class="form-control col-md-3" readonly="">'; 
                            });
                            
                            optCombination += `<div class="input-group">
                                `+ combination +`
                                <input type="text" value="` + element.price + `" class="form-control col-md-2" readonly="">
                                <input type="text" value="` + element.stock + `" class="form-control col-md-1">
                                <div class="input-group-append">
                                    <button class="btn btn-danger">품절</button>
                                </div>
                            </div>`;
                        });
                        $('#divOptionCombinationBox').html(optCombination);
                        $('#imageContainer').html(imgItem);
                        $('#summernote').summernote('code', data.description);
                    },
                    error: function (data) {
                        alert('스크래핑중 오류가 발생했습니다. 잠시후 다시 시도해주십시오.');
                    }
                });
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

    </script>        
    @endsection
@endsection