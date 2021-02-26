<?php

namespace App\Http\Controllers\Tpl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\ProductImage;
use App\Models\ProductDetail;
use App\Models\Come;
use App\Models\Brand;
use App\Models\Category;
use DataTables;
use App\MyLibs\CoupangConnector;

class PurchaseRequestKrWarehouseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default
        $title = "판매대상상품";
        $comes = Come::where('bIsDel', 0)
                ->orderBy('strComeCode')
                ->get();
                //dd($comes);
        $brands = Brand::where('bIsDel', 0)
                ->orderBy('strBrandCode')
                ->get();
        $categories_1 = Category::where('bIsDel', 0)
                ->where('nCategoryType', 1)
                ->orderBy('strCategoryName')
                ->get();
        $categories_2 = Category::where('bIsDel', 0)
                ->where('nCategoryType', 2)
                ->orderBy('strCategoryName')
                ->get();

        $categories_3 = Category::where('bIsDel', 0)
                ->where('nCategoryType', 3)
                ->orderBy('strCategoryName')
                ->get();
        $categories_4 = Category::where('bIsDel', 0)
                ->where('nCategoryType', 4)
                ->orderBy('strCategoryName')
                ->get();
        $shareType = "1";
        $basePriceTypes= array('CNY', 'KRW', 'USD', 'JPY');
        $countryShippingCostTypes= array('CNY', 'KRW', 'USD', 'JPY');
        $worldShippingCostTypes= array('KRW');
        $weightTypes= array('Kg');

        if ($request->ajax()) {
            $products = Product::where('bIsDel', 0)
                ->where('nUserId', Auth::id())
                ->where('nProductWorkProcess', 0)
                ->orderBy('nIdx');

            return Datatables::eloquent($products)
                    ->addIndexColumn()
                    ->addColumn('check', function($row){
                        $check = '<input type="checkbox" name="chkProduct[]" onclick="" value="'.$row->nIdx.'">';
                        return $check;
                    })
                    ->addColumn('action', function($row){
                        $btn = '';
                        return $btn;
                    })
                    ->addColumn('images', function($row){
                        $btn = '<ul class="list-inline" style="width:100px;">';
                        foreach ($row->productImages as $productImage) {
                            $btn .= '<li class="list-inline-item">
                                        <img alt="Avatar" class="table-avatar" src="'.$productImage->strURL.'">
                                    </li>';
                        }
                        $btn .= '</ul>';
                        return $btn;
                    })
                    ->addColumn('productInfo', function($row){
                        $element = '<ul class="list-inline" style="">';
                        $element .= '<li class="list-inline-item">
                                    '.$row->strCategoryCode1.'>'.$row->strCategoryCode2.'>'.$row->strCategoryCode3.'>'.$row->strCategoryCode4.'
                                </li><br>';
                        $element .= '<li class="list-inline-item">
                                    '.$row->strKrSubName.'
                                </li>';

                        $element .= '</ul>';
                        return $element;
                    })
                    ->addColumn('priceInfo', function($row){
                        $element = '<ul class="list-inline" style="width:100px;">';
                        $element .= '<li class="list-inline-item">
                                '.$row->productDetail->nBasePrice.'
                            </li><br>';
                        $element .= '<li class="list-inline-item">
                                '.$row->productDetail->nBasePrice.'
                            </li>';
                                
                        $element .= '</ul>';
                        return $element;
                    })
                    ->addColumn('marginInfo', function($row){
                        $element = '<ul class="list-inline" style="width:100px;">';
                        $element .= '<li class="list-inline-item">
                                '.$row->productDetail->nBasePrice.'
                            </li><br>';
                        $element .= '<li class="list-inline-item">
                                '.$row->productDetail->nBasePrice.'
                            </li>';
                                
                        $element .= '</ul>';
                        return $element;
                    })
                    ->addColumn('marketInfo', function($row){
                        $marketInfo = '
                                <span style="width:20px;" class="badge badge-success">C</span>
                                <span style="width:20px;" class="badge badge-success">11</span>
                                <span style="width:20px;" class="badge badge-success">A</span>
                                <span style="width:20px;" class="badge badge-success">G</span>
                                <br/>
                                <span style="width:20px;" class="badge badge-success">I</span>
                                <span style="width:20px;" class="badge badge-success">S</span>
                                <span style="width:20px;" class="badge badge-success">T</span>
                                <span style="width:20px;" class="badge badge-success">W</span>
                                ';
                        return $marketInfo;
                    })
                    ->addColumn('mainImage', function($row){
                        $btn = '<img alt="Avatar" style="width: 5rem;" class="table-product-image" src="'.asset('assets/images/product/image.jpg').'">';
                        return $btn;
                    })
                    ->rawColumns(['check', 'productInfo', 'mainImage', 'marketInfo', 'priceInfo', 'marginInfo'])
                    ->make(true);
                    
        }
        return view('product.SellTargetManage', compact('title', 'brands', 'comes', 'categories_1', 'categories_2', 'categories_3', 'categories_4', 'shareType', 'basePriceTypes', 'countryShippingCostTypes', 'worldShippingCostTypes', 'weightTypes'));
    }

    /**
     * 상품등록선택후 마켓상품등록버튼
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function marketProductAdd(Request $request)
    {
        $marketAccounts = MarketAccount::where('nUserId', Auth::id())
                                        ->get();
        //dd($marketAccounts);
        $chkProduct = $request->post('chkProduct');
        //print_r($chkProduct);
        $select_all = $request->post('select_all');
        if($request->has('select_all')){
            session()->put('post_product_select_all', '1');
            session()->put('post_products', $chkProduct);
        }else{
            session()->put('post_product_select_all', '0');
            session()->put('post_products', $chkProduct);
        }
        
        return response()->json(["status" => "success", "data" => $marketAccounts]);
    }
    //상품등록을 위한 마켓계정 리스트(get)
    public function marketAccountList()
    {
        // $request->session()->put('key', 'value');
        // $request->session()->push('user.teams', 'developers');
        // $value = $request->session()->pull('key', 'default');
        // $request->session()->forget('key');
        // $request->session()->flush();
        $marketAccounts = MarketAccount::where('nUserId', Auth::id())
                                        ->get();

        return view('product.MarketAccountList', compact('marketAccounts'));
    }
    //상품등록을 위한 마켓계정 선택(post)
    public function marketAccountSelect(Request $request)
    {
        $chkAccount = $request->post('chkAccount');
        
        $marketAccounts = MarketAccount::where('nUserId', Auth::id())
                                        ->join('tb_markets', 'tb_market_accounts.nMarketIdx', '=', 'tb_markets.nIdx')
                                        ->where('tb_markets.strMarketCode', 'coupang')
                                        ->get();

        $markets = Market::where('strMarketCode', 'coupang');
        if($request->has('select_all')){
            session()->put('post_marketId_select_all', '1');
            session()->put('post_marketIds', $chkAccount);
        }else{
            session()->put('post_marketId_select_all', '0');
            session()->put('post_marketIds', $chkAccount);
        }
        
        return view('product.MarketProductPrepare', compact('marketAccounts', 'markets'));
    }
    /**
     * 마켓 카테고리 탐색
     */
    public function marketCategorySearch($marketCode = 'coupang', $categoryCode = 0, Request $request)
    {
        if($marketCode == 'coupang'){
            $coupang = new CoupangConnector();
            $res =  (object)json_decode($coupang->getCategoryInfoViaCode($categoryCode));
            if($res->code = "SUCCESS"){
                $categories_1 = $res->data->child;
            }
        }
        
        if ($request->ajax()) {
            if($res->code = "SUCCESS"){
                $categories = $res->data->child;
                return response()->json(["status" => "success", "data" => $categories]);
            }
            return response()->json(["status" => "error", "data" => array()]);
        }
        
        return view('product.MarketCategorySearch', compact('marketCode', 'categories_1'));
    }
    /**
     * 상품등록송신
     */
    public function marketAccountProduct(Request $request)
    {
        $value = session()->get('post_products');
        $product_select_all = session()->get('post_product_select_all', 0);
        $product_selected = session()->get('post_products', Array());
        $product_select_all = session()->get('post_product_select_all', 0);
        $arrCategoryCode = $request->post('txtCategoryCode');
        $arrCategoryName = $request->post('txtCategoryName');
        
        $CoupangcategoryCode = $arrCategoryCode["coupang"];
        $CoupangcategoryName = $arrCategoryName["coupang"];
        $coupang = new CoupangConnector();
        
        $cateMetaInfo = (object)json_decode($coupang->getCategoryMetaInfo($categoryCode), true);
        $place_codes= '3244320';
        $outboundInfo = (object)json_decode($coupang->getOutboundShippingCenterInfo("", $place_codes), true);
        $outboundInfo = (object)json_decode($coupang->getOutboundShippingCenterInfo("", $place_codes), true);

        if($product_select_all == 1) {
            $products = Product::where('bIsDel', 0)
                ->where('nUserId', Auth::id())
                ->where('nProductWorkProcess', 0)
                ->whereIn('nIdx', $product_selected)
                ->orderBy('nIdx');
        }else{
            $products = Product::where('bIsDel', 0)
                ->where('nUserId', Auth::id())
                ->where('nProductWorkProcess', 0)
                ->whereIn('nIdx', $product_selected)
                ->orderBy('nIdx');
        }
        $today = new DateTime;
        foreach ($products as $key => $product) {
            $categoryNameList = mb_split(" > ", $CoupangcategoryName);
            $objProduct = array(
                "displayCategoryCode" => $categoryCode, //쿠팡카테고리 코드
                "sellerProductName" => $product->strMainName,
                "vendorId" => $this->VENDOR_ID,
                "saleStartedAt" => $today->format('Y-m-d\TH:i:s'),
                "saleEndedAt" => "2099-01-01T23:59:59",
                "displayProductName" => $product->strBrand.$product->strMainKrName,
                "brand" => $product->strBrand,
                "generalProductName" => $product->strMainKrName,
                "productGroup" => $categoryNameList[count($categoryNameList)-1],
                "deliveryMethod" => "SEQUENCIAL",
                "deliveryCompanyCode" => $outboundInfo->str,
                "deliveryChargeType" => "FREE",
                "deliveryCharge" => 0,
                "freeShipOverAmount" => 0,
                "deliveryChargeOnReturn" => 2500,
                "remoteAreaDeliverable" => "N",
                "unionDeliveryType" => "UNION_DELIVERY",
                "returnCenterCode" => "1000274592",
                "returnChargeName" => "반품지_1",
                "companyContactNumber" => "02-1234-678",
                "returnZipCode" => "135-090",
                "returnAddress" => "서울특별시 강남구 삼성동",
                "returnAddressDetail" => "333",
                "returnCharge" => 2500,
                "returnChargeVendor" => "N",
                "afterServiceInformation" => "A/S안내 1544-1255",
                "afterServiceContactNumber" => "1544-1255",
                "outboundShippingPlaceCode" => "74010",
                "vendorUserId" => "user01",
                "requested" => false
            );
        }
        $strjson='
            {
                "displayCategoryCode": 56174,
                "sellerProductName": "상품등록_example",
                "vendorId": "'.$this->VENDOR_ID.'",
                "saleStartedAt": "2018-08-13T00:00:00",
                "saleEndedAt": "2099-01-01T23:59:59",
                "displayProductName": "해피바스 솝베리 클렌징 오일",
                "brand": "해피바스",
                "generalProductName": "솝베리 클렌징 오일",
                "productGroup": "클렌징 오일",
                "deliveryMethod": "SEQUENCIAL",
                "deliveryCompanyCode": "KGB",
                "deliveryChargeType": "FREE",
                "deliveryCharge": 0,
                "freeShipOverAmount": 0,
                "deliveryChargeOnReturn": 2500,
                "remoteAreaDeliverable": "N",
                "unionDeliveryType": "UNION_DELIVERY",
                "returnCenterCode": "1000274592",
                "returnChargeName": "반품지_1",
                "companyContactNumber": "02-1234-678",
                "returnZipCode": "135-090",
                "returnAddress": "서울특별시 강남구 삼성동",
                "returnAddressDetail": "333",
                "returnCharge": 2500,
                "returnChargeVendor": "N",
                "afterServiceInformation": "A/S안내 1544-1255",
                "afterServiceContactNumber": "1544-1255",
                "outboundShippingPlaceCode": "74010",
                "vendorUserId": "user01",
                "requested": false,
                "items": [
                    {
                        "itemName": "200ml_1개",
                        "originalPrice": 13000,
                        "salePrice": 10000,
                        "maximumBuyCount": "100",
                        "maximumBuyForPerson": "0",
                        "outboundShippingTimeDay": "1",
                        "maximumBuyForPersonPeriod": "1",
                        "unitCount": 1,
                        "adultOnly": "EVERYONE",
                        "taxType": "TAX",
                        "parallelImported": "NOT_PARALLEL_IMPORTED",
                        "overseasPurchased": "NOT_OVERSEAS_PURCHASED",
                        "pccNeeded": "false",
                        "externalVendorSku": "0001",
                        "barcode": "",
                        "emptyBarcode": true,
                        "emptyBarcodeReason": "상품확인불가_바코드없음사유",
                        "modelNo": "1717171",
                        "extraProperties": null,
                        "certifications": [
                            {
                                "certificationType": "NOT_REQUIRED",
                                "certificationCode": ""
                            }
                        ],
                        "searchTags": [
                            "검색어1",
                            "검색어2"
                        ],
                        "images": [
                            {
                                "imageOrder": 0,
                                "imageType": "REPRESENTATION",
                                "vendorPath": "http://image11.coupangcdn.com/image/product/image/vendoritem/2018/06/25/3719529368/27a6b898-ff3b-4a27-b1e4-330a90c25e9c.jpg"
                            },
                            {
                                "imageOrder": 1,
                                "imageType": "DETAIL",
                                "vendorPath": "http://image11.coupangcdn.com/image/product/image/vendoritem/2017/02/21/3000169918/34b79649-d625-4f49-a260-b78bf7a573a8.jpg"
                            },
                            {
                                "imageOrder": 2,
                                "imageType": "DETAIL",
                                "vendorPath": "http://image11.coupangcdn.com/image/product/image/vendoritem/2018/06/28/3000169918/5716aa61-70bd-47cd-8f3d-f3d49e7f496d.jpg"
                            }
                        ],
                        "notices": [
                            {
                                "noticeCategoryName": "일반오일1",
                                "noticeCategoryDetailName": "용량(중량)",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "일반오일1",
                                "noticeCategoryDetailName": "제품 주요 사양",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "일반오일1",
                                "noticeCategoryDetailName": "사용기한 또는 개봉 후 사용기간",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "일반오일1",
                                "noticeCategoryDetailName": "사용방법",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "일반오일1",
                                "noticeCategoryDetailName": "제조업자 및 제조판매업자",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "일반오일1",
                                "noticeCategoryDetailName": "제조국",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "일반오일1",
                                "noticeCategoryDetailName": "화장품법에 따라 기재, 표시하여야 하는 모든 성분",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "일반오일1",
                                "noticeCategoryDetailName": "식품의약품안전처 심사 필 유무",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "일반오일1",
                                "noticeCategoryDetailName": "사용할 때 주의사항",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "일반오일1",
                                "noticeCategoryDetailName": "품질보증기준",
                                "content": "제품 이상 시 공정거래위원회 고시 소비자분쟁해결기준에 의거 보상합니다."
                            },
                            {
                                "noticeCategoryName": "일반오일1",
                                "noticeCategoryDetailName": "소비자상담관련 전화번호",
                                "content": "상세페이지 참조"
                            }
                        ],
                        "attributes": [
                            {
                                "attributeTypeName": "수량",
                                "attributeValueName": "1개"
                            },
                            {
                                "attributeTypeName": "개당 용량",
                                "attributeValueName": "200ml"
                            }
                        ],
                        "contents": [
                            {
                                "contentsType": "TEXT",
                                "contentDetails": [
                                    {
                                        "content": "'.$image.'",
                                        "detailType": "TEXT"
                                    }
                                ]
                            }
                        ],
                        "offerCondition": "NEW",
                        "offerDescription": ""
                    },
                    
                ],
                "requiredDocuments": [
                    {
                        "templateName": "기타인증서류",
                        "vendorDocumentPath": "http://image11.coupangcdn.com/image/product/content/vendorItem/2018/07/02/41579010/eebc0c30-8f35-4a51-8ffd-808953414dc1.jpg"
                    }
                ],
                "extraInfoMessage": "",
                "manufacture": "아모레퍼시픽"
            }
        ';
        dd($data);
        //if($request->post('')
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function add(Request $request)
    {
        //$product  = Product::where('nIdx', $request->post('id'))->first();
        $product  = Product::where('nIdx', 1)->first();
        $coupang = new CoupangConnector();
        //$coupang->getCategoryInfoViaCode(56174);
        $coupang->getCategoryMetaInfo(0);
        // $coupang->getCategoryListInfo();
        // $coupang->addOutboundShippingCenter();
        // $coupang->addReturnShippingCenter();
        $coupang->addProduct();
        return view('product.MarketIDList');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function saveMarketProduct(Request $request)
    {
        //$product  = Product::where('nIdx', $request->post('id'))->first();
        $product  = Product::where('nIdx', 1)->first();
        $coupang = new CoupangConnector();
        //$coupang->getCategoryInfoViaCode(56174);
        $coupang->getCategoryMetaInfo(56174);
        // $coupang->getCategoryListInfo();
        // $coupang->addOutboundShippingCenter();
        // $coupang->addReturnShippingCenter();
        $coupang->addProduct();
        //return response()->json(["status" => "success", "data" => $marketAccount]);
    }
    /**
     * Display the specified resource.
     *
     */
    public function accountShow($marketId = 0, $accountId = 0)
    {
        //
        // $marketAccount  = MarketAccount::where('nIdx', $accountId)->first();
        return response()->json(["status" => "success", "data" => $marketAccount]);
    }

    public function accountUpdate($marketId=0, $accountId=0, Request $request)
    {
        // $marketAccount = MarketAccount::find($accountId);
        // $marketAccount->strAccountId = $request->post('txtAccountId');
        // $marketAccount->strAccountPwd = $request->post('txtAccountPwd');
        // $marketAccount->strAPIAccessKey = $request->post('txtAPIAccessKey');
        // $marketAccount->update();
        return response()->json(["status" => "success", "data" => $marketAccount]);

        // $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default

        // $title = "오픈마켓계정관리";
       
        // $marketAccounts = MarketAccount::where('bIsDel', 0)
        //         ->where('nMarketIdx', $id)
        //         ->where('nUserId', Auth::id())
        //         ->orderBy('nIdx')->paginate(15);
              //dd($markets);
        // return view('operation.OpenMarketAccountManage', compact('title', 'markets'))
        //    ->with('i', (request()->input('page', 1) - 1) * 15);
        //return response()->json(["status" => "success", "data" => $marketAccount]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $accountId
     * @return \Illuminate\Http\Response
     */
    public function accountDelete($marketId, $accountId)
    {
        //
        //$marketAccount = MarketAccount::where('nIdx', $accountId)->delete();
        return response()->json(["status" => "success", "data" => $marketAccount]);
    }
}
