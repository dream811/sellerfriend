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
                <li class="breadcrumb-item"><a href="#">운영관리</a></li>
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
                                <form>
                                    <div class="form-group row col-12">
                                        <label for="scrapURL">대상URL</label>
                                        <div class="input-group input-group-sm">
                                            <input type="url" class="form-control" id="scrapURL" placeholder="1688, Taobao의 상품을 URL을 붙여넣기(Ctrl+V)해 주세요.">
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-danger btn-flat">Go!</button>
                                            </span>
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-warning ">Save</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="">집하지</label>
                                                <div class="input-group input-group-sm">
                                                    <select class="custom-select form-control-border" id="select">
                                                        <option>Value 1</option>
                                                        <option>Value 2</option>
                                                        <option>Value 3</option>
                                                    </select>
                                                </div>
                                            </div>    
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <label for=""></label>
                                                <div class="custom-control custom-checkbox mt-2">
                                                    <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                                                    <label class="custom-control-label" for="exampleCheck1"><strong style="color:red">선택데이터 유지</strong>[수집정보 등록 후 "집하지/브랜드/카테고리/키워드/내륙배송비" 정보를 유지합니다.]</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group form-group">
                                                <label for="">브랜드</label>
                                                <input type="url" class="form-control form-control-sm" id="scrapURL" placeholder="1688, Taobao의 상품을 URL을 붙여넣기(Ctrl+V)해 주세요.">
                                            </div>    
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for=""> </label>
                                                <div class="input-group input-group-sm mt-2">
                                                    <select class="custom-select form-control-border" id="select">
                                                        <option>Value 1</option>
                                                        <option>Value 2</option>
                                                        <option>Value 3</option>
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
                                                    <select class="custom-select form-control-border" id="select">
                                                        <option>Value 1</option>
                                                        <option>Value 2</option>
                                                        <option>Value 3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <label for=""> </label>
                                                <div class="input-group input-group-sm mt-2">
                                                    <select class="custom-select form-control-border" id="select">
                                                        <option>Value 1</option>
                                                        <option>Value 2</option>
                                                        <option>Value 3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <label for=""> </label>
                                                <div class="input-group input-group-sm mt-2">
                                                    <select class="custom-select form-control-border" id="select">
                                                        <option>Value 1</option>
                                                        <option>Value 2</option>
                                                        <option>Value 3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <label for=""> </label>
                                                <div class="input-group input-group-sm mt-2">
                                                    <select class="custom-select form-control-border" id="select">
                                                        <option>Value 1</option>
                                                        <option>Value 2</option>
                                                        <option>Value 3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group form-group mt-2">
                                                <label for=""></label>
                                                <input type="url" class="form-control form-control-sm" id="scrapURL" placeholder="1688, Taobao의 상품을 URL을 붙여넣기(Ctrl+V)해 주세요.">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row col-12">
                                        <label for="scrapURL">비공개여부</label>
                                        <div class="input-group">
                                            <div class="custom-control custom-radio col-2">
                                                <input class="custom-control-input" type="radio" id="customRadio1" name="customRadio">
                                                <label for="customRadio1" class="custom-control-label">비공개</label>
                                            </div>
                                            <div class="custom-control custom-radio col-2">
                                                <input class="custom-control-input" type="radio" id="customRadio3" disabled="">
                                                <label for="customRadio3" class="custom-control-label">공개</label>
                                            </div>
                                            <div class="custom-control custom-radio col-2">
                                                <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio" checked="">
                                                <label for="customRadio2" class="custom-control-label">멤버공유</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row col-12">
                                        <label for="scrapURL">상품명(CN)</label>
                                        <input type="url" class="form-control form-control-sm" id="scrapURL" placeholder="1688, Taobao의 상품을 URL을 붙여넣기(Ctrl+V)해 주세요.">
                                    </div>
                                    <div class="form-group row col-12">
                                        <label for="scrapURL">상품명(KR)</label>
                                        <input type="url" class="form-control form-control-sm" id="scrapURL" placeholder="1688, Taobao의 상품을 URL을 붙여넣기(Ctrl+V)해 주세요.">
                                    </div>
                                    <div class="row col-12">
                                        <label>금액</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <code style="">상품원가</code>
                                                <div class="input-group input-group-sm">
                                                    <select class="custom-select form-control-border" id="select">
                                                        <option>Value 1</option>
                                                        <option>Value 2</option>
                                                        <option>Value 3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <code style=""><br></code>
                                                <input type="url" class="form-control form-control-sm" id="scrapURL" placeholder="1688, Taobao의 상품을 URL을 붙여넣기(Ctrl+V)해 주세요.">
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <code style="">내륙배송비</code>
                                                <div class="input-group input-group-sm">
                                                    <select class="custom-select form-control-border" id="select">
                                                        <option>Value 1</option>
                                                        <option>Value 2</option>
                                                        <option>Value 3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <code style=""><br></code>
                                                <input type="url" class="form-control form-control-sm" id="scrapURL" placeholder="1688, Taobao의 상품을 URL을 붙여넣기(Ctrl+V)해 주세요.">
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <code style="">국제배송비</code>
                                                <div class="input-group input-group-sm">
                                                    <select class="custom-select form-control-border" id="select">
                                                        <option>Value 1</option>
                                                        <option>Value 2</option>
                                                        <option>Value 3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <code style=""><br></code>
                                                <input type="url" class="form-control form-control-sm" id="scrapURL" placeholder="1688, Taobao의 상품을 URL을 붙여넣기(Ctrl+V)해 주세요.">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <label for="scrapURL">무게</label>
                                                <input type="url" class="form-control form-control-sm" id="scrapURL" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <label for=""> </label>
                                                <div class="input-group input-group-sm mt-2">
                                                    <select class="custom-select form-control-border" id="select">
                                                        <option>Value 1</option>
                                                        <option>Value 2</option>
                                                        <option>Value 3</option>
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
                                                <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                                                <label for="customCheckbox1" class="custom-control-label"><i class="fab fa-get-pocket"></i>돼지코(1,000원)</label>
                                            </div>
                                            <div class="custom-control custom-checkbox col-3">
                                                <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                                                <label for="customCheckbox1" class="custom-control-label"><i class="fas fa-glass-martini-alt"></i>안전포장(소형 100Cm이하, 2,000원)</label>
                                            </div>
                                            <div class="custom-control custom-checkbox col-2">
                                                <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                                                <label for="customCheckbox1" class="custom-control-label"><i class="fas fa-camera"></i>사진요청(1,000원)</label>
                                            </div>
                                            <div class="custom-control custom-checkbox col-2">
                                                <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                                                <label for="customCheckbox1" class="custom-control-label"><i class="fas fa-search-plus"></i>디테일검수(2,000원)</label>
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
                                        <label for="scrapURL">키워드</label>
                                        <input type="url" class="form-control" id="scrapURL" placeholder="1688, Taobao의 상품을 URL을 붙여넣기(Ctrl+V)해 주세요.">
                                    </div>
                                    <div class="form-group row col-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-radio col-2">
                                                <input class="custom-control-input" type="radio" id="customRadio1" name="customRadio">
                                                <label for="customRadio1" class="custom-control-label">다중가격사용안함</label>
                                            </div>
                                            <div class="custom-control custom-radio col-2">
                                                <input class="custom-control-input" type="radio" id="customRadio3" disabled="">
                                                <label for="customRadio3" class="custom-control-label">다중가격사용</label>
                                            </div>
                                            <div class="custom-control custom-radio col-2">
                                                <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio" checked="">
                                                <label for="customRadio2" class="custom-control-label">멤버공유</label>
                                            </div>
                                            <div class="btn-group col-2">
                                                <button type="button" class="btn btn-info btn-flat">
                                                숫자
                                                </button>
                                                <button type="button" class="btn btn-info btn-flat">
                                                A-Z
                                                </button>
                                                <button type="button" class="btn btn-info btn-flat">
                                                단어변경
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive p-0" style="height:300px;">
                                        <table class="table table-head-fixed table-bordered text-nowrap">
                                            <thead>
                                                <tr>
                                                <th>ID</th>
                                                <th>User</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Reason</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 product-image-thumbs">
                                            <div class="product-image-thumb active"><img src="../../dist/img/prod-1.jpg" alt="Product Image"></div>
                                            <div class="product-image-thumb"><img src="../../dist/img/prod-2.jpg" alt="Product Image"></div>
                                            <div class="product-image-thumb"><img src="../../dist/img/prod-3.jpg" alt="Product Image"></div>
                                            <div class="product-image-thumb"><img src="../../dist/img/prod-4.jpg" alt="Product Image"></div>
                                            <div class="product-image-thumb"><img src="../../dist/img/prod-5.jpg" alt="Product Image"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card card-outline card-info">
                                                <textarea id="summernote">
                                                    Place <em>some</em> <u>text</u> <strong>here</strong>
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
            //delete account
            $('body').on('click', '.btnDelete', function () {
                var market_id = $(".marketsTable tbody .selectedMarket").attr('id');
                var account_id = $(this).attr('data-id');
                $.get('operationOpenMarketManage/' + market_id +'/AccountDelete/' + account_id, function ({status, data}) {
                    //$(".marketAccountsTable tbody tr").removeClass("selectedAccount");
                    $(".marketAccountsTable tbody").find("#" + account_id).remove();
                    $('.marketsTable tbody .selectedMarket .marketNo').html($('.marketAccountsTable tbody tr').length);
                })
            });	
        });
    </script>
    @endsection
@endsection