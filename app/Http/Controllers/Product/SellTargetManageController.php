<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\Market;
use App\Models\MarketAccount;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\ProductImage;
use App\Models\ProductDetail;
use App\Models\Come;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MarketSettingCoupang;
use Yajra\DataTables\Facades\DataTables;
use App\MyLibs\CoupangConnector;
use DateTime;
use PhpParser\Node\Stmt\Switch_;

class SellTargetManageController extends Controller
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
        $markets = Market::where('bIsDel', 0)
                ->get();
        $marketAccounts = MarketAccount::where('bIsDel', 0)
                ->where('nUserId', Auth::id())
                ->get();
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
        
        

        if ($request->ajax()) {
            $products = Product::where('bIsDel', 0)
                ->where('nUserId', Auth::id())
                ->where('nProductWorkProcess', 3)//디자인 검토 완료상품
                ->orderBy('nIdx');

            return Datatables::of($products)
                ->addIndexColumn()
                ->addColumn('check', function($row){
                    $element = '<input type="checkbox" name="chkProduct[]" onclick="" value="'.$row->nIdx.'">';
                    $shareTag = $row->nShareType != 2 ? '<span class="badge badge-danger">비공개</span>': '';

                    $element .= '<li class="font-weight-light list-inline-item">'.$shareTag.'</li><br>';
                    return $element;
                })
                ->addColumn('images', function($row){
                    $btn = '<ul class="list-inline" style="width:100px;">';
                    foreach ($row->productImages as $productImage) {
                        $btn .= '<li class="list-inline-item" >
                                    <a href="'.$productImage->strURL.'" class="preview">
                                        <img alt="Avatar" class="table-avatar" src="'.$productImage->strURL.'">
                                    </a>
                                </li>';
                    }
                    $btn .= '</ul>';
                    return $btn;
                })
                ->addColumn('productInfo', function($row){
                    $element = '<ul class="list-inline" style="">';
                    $element .= '<li class="list-inline-item">'
                                    .Category::where('strCategoryTree', $row->strCategoryCode1)->first()->strCategoryName.'>'
                                    .Category::where('strCategoryTree', $row->strCategoryCode2)->first()->strCategoryName.'>'
                                    .Category::where('strCategoryTree', $row->strCategoryCode3)->first()->strCategoryName.'>'
                                    .Category::where('strCategoryTree', $row->strCategoryCode4)->first()->strCategoryName.
                                '</li><br>';
                    $element .= '<li class="font-weight-bold list-inline-item">
                                    '.$row->strKrSubName.'
                                </li><br>';
                    $element .= '<li class="font-weight-light list-inline-item">
                                    '.$row->strChSubName.'
                                </li><br>';
                    $productOptTag = $row->productDetail->nMultiPriceOptionType==1 ? '<span class="badge badge-danger mr-1">다중가격</span>': '';
                    $productOptTag .= $row->productDetail->bAdditionalOption1==1 ? '<span class="badge badge-primary mr-1">돼지코</span>': '';
                    $productOptTag .= $row->productDetail->bAdditionalOption2==1 ? '<span class="badge badge-primary mr-1">안전포장</span>': '';
                    $productOptTag .= $row->productDetail->bAdditionalOption3==1 ? '<span class="badge badge-primary mr-1">사진요청</span>': '';
                    $productOptTag .= $row->productDetail->bAdditionalOption4==1 ? '<span class="badge badge-primary mr-1">디테일검수</span>': '';
                    $element .= '<li class="font-weight-light list-inline-item">
                                '.$productOptTag.'
                            </li><br>';
                    $element .= '<li class="font-weight-light list-inline-item">
                                    '.Auth::user()->name.'['.$row->created_at.']
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
                            '.$row->productDetail->nMarketPrice.'
                        </li><br>';
                            
                    $element .= '</ul>';
                    return $element;
                })
                ->addColumn('marginInfo', function($row) use ($request){
                    
                    $element = '<ul class="list-inline" style="width:100px;">';
                    $element .= '<li class="list-inline-item">
                            '.$row->productDetail->nMarginPrice.'
                        </li><br>';
                    $element .= '<li class="list-inline-item">
                        '.$row->productDetail->nMarginPercent.'%
                    </li><br>';
                      
                    $element .= '</ul>';
                    return $element;
                })
                ->addColumn('marketInfo', function($row){
                    $_11thhouseTag = $row->bReg11thhouse == 0 ? 'badge-secondary' : 'badge-success';
                    $autionTag = $row->bRegAuction == 0 ? 'badge-secondary' : 'badge-success';
                    $coupangTag = $row->bRegCoupang == 0 ? 'badge-secondary' : 'badge-success';
                    $gmarketTag = $row->bRegGmarket == 0 ? 'badge-secondary' : 'badge-success';
                    $interparkTag = $row->bRegInterpark == 0 ? 'badge-secondary' : 'badge-success';
                    $lotteonTag = $row->bRegLotteon == 0 ? 'badge-secondary' : 'badge-success';
                    $smartstoreTag = $row->bRegSmartstore == 0 ? 'badge-secondary' : 'badge-success';
                    $tmonTag = $row->bRegTmon == 0 ? 'badge-secondary' : 'badge-success';
                    $wemakepriceTag = $row->bRegWemakeprice == 0 ? 'badge-secondary' : 'badge-success';
                    
                    $marketInfo = '
                            <span style="width:20px;" class="badge '.$coupangTag.'">C</span>
                            <span style="width:20px;" class="badge '.$_11thhouseTag.'">11</span>
                            <span style="width:20px;" class="badge '.$autionTag.'">A</span>
                            <span style="width:20px;" class="badge '.$gmarketTag.'">G</span>
                            <br/>
                            <span style="width:20px;" class="badge '.$interparkTag.'">I</span>
                            <span style="width:20px;" class="badge '.$smartstoreTag.'">S</span>
                            <span style="width:20px;" class="badge '.$tmonTag.'">T</span>
                            <span style="width:20px;" class="badge '.$wemakepriceTag.'">W</span>
                            ';
                    return $marketInfo;
                })
                ->addColumn('mainImage', function($row){
                    $main = $row->productImages->where('nImageCode', '0')->first();
                    // $btn = '<img alt="Avatar" style="width: 5rem;" class="table-product-image" src="'.$main->strURL.'">';
                    $mainImage = '<li class="list-inline-item" >
                                    <a href="'.$row->strURL.'" target="_blank">
                                        <span data="'.$main->strURL.'" class="preview">
                                            <img alt="gallery thumbnail" style="width: 5rem;" src="'.$main->strURL.'">
                                        </span>
                                    </a>
                                </li>';
                    return $mainImage;
                })
                ->rawColumns(['check', 'productInfo', 'mainImage', 'marketInfo', 'priceInfo', 'marginInfo', 'action'])
                ->filter(function($query) use ($request){
                    if ($request->get('selCome') != "") {
                        $query->where('strComeCode', "=", "{$request->get('selCome')}");
                    }
                    //상품상태
                    // if ($request->get('productState') != "") {
                    //     $query->where('strComeCode', "=", "{$request->get('selCome')}");
                    // }
                    // 마켓등록상품
                    // if ($request->get('marketRegProduct') != "") {
                    //     $query->where('strComeCode', "=", "{$request->get('marketRegProduct')}");
                    // }
                    // 내상품
                    // if ($request->get('myProduct') != "") {
                    //     $query->where('strComeCode', "=", "{$request->get('myProduct')}");
                    // }
                    //마켓
                    if($request->get('market') != ""){
                        switch ($request->get('market')) {
                            case '11thhouse':
                                $query->where('bReg11thhouse', 1);
                                break;
                            case 'auction':
                                $query->where('bRegAuction', 1);
                                break;
                            case 'coupang':
                                $query->where('bRegCoupang', 1);
                                break;
                            case 'gmarket':
                                $query->where('bRegGmarket', 1);
                                break;
                            case 'interpark':
                                $query->where('bRegInterpark', 1);
                                break;
                            case 'lotteon':
                                $query->where('bRegLotteon', 1);
                                break;
                            case 'smartstore':
                                $query->where('bRegSmartstore', 1);
                                break;
                            case 'tmon':
                                $query->where('bRegTmon', 1);
                                break;
                            case 'wemakeprice':
                                $query->where('bRegWemakeprice', 1);
                                break;
                            default:
                                break;
                        }
                    }
                    //마켓계정
                    if($request->get('market') != ""){
                        //$query->where('bRegTmon', 1);
                    }
                    //
                    if($request->get('daterange')){
                        $dates = explode(' ~ ', $request->get('daterange'));
                        $endDate = date('Y-m-d H:i:s', strtotime($dates[1] . ' +1 day'));
                        $query->whereBetween('created_at', [$dates[0], $endDate]);
                    }
                    if($request->get('category1') != ""){
                        $query->where('strCategoryCode1', '=', "{$request->get('category1')}");
                    }
                    if($request->get('category2') != ""){
                        $query->where('strCategoryCode2', '=', "{$request->get('category2')}");
                    }
                    if($request->get('category3') != ""){
                        $query->where('strCategoryCode3', '=', "{$request->get('category3')}");
                    }
                    if($request->get('category4') != ""){
                        $query->where('strCategoryCode4', '=', "{$request->get('category4')}");
                    }
                    if($request->get('shareType') != -1){
                        $query->where('nShareType', '=', "{$request->get('shareType')}");
                    }
                    if($request->get('shareType') != -1){
                        $query->where('nShareType', '=', "{$request->get('shareType')}");
                    }
                    if ($request->get('searchWord') != "") {
                        $query->where('strKrSubName', 'like', "%{$request->get('searchWord')}%")
                            ->orWhere('strChSubName', 'like', "%{$request->get('searchWord')}%");
                    }
                })
                ->make(true);
        }
        return view('product.SellTargetManage', compact('title', 'brands', 'markets', 'marketAccounts', 'comes', 'categories_1', 'categories_2', 'categories_3', 'categories_4'));
    }

    /**
     * 상품등록선택후 마켓상품등록버튼
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function marketProductAdd(Request $request)
    {
        
        //dd($marketAccounts);
        $chkProduct = $request->post('chkProduct');
        $select_all = $request->post('select_all');
        if($request->has('select_all')){
            session()->put('post_product_select_all', '1');
            session()->put('post_products', $chkProduct);
        }else{
            session()->put('post_product_select_all', '0');
            session()->put('post_products', $chkProduct);
        }
        
        return response()->json(["status" => "success", "data" => $chkProduct]);
    }
    //상품등록을 위한 마켓계정 리스트(get)
    //쇼핑몰 아이디 선택
    public function marketAccountList()
    {
        // $marketAccounts = MarketAccount::where('nUserId', Auth::id())
        //                                 ->get();
        $settingCoupangs = MarketSettingCoupang::where('nUserId', Auth::id())
                                        ->where('bIsDel', 0)
                                        ->get();
        return view('product.MarketAccountList', compact('settingCoupangs'));
    }
    //상품등록을 위한 마켓계정 선택(post)
    //상품등록정보
    public function marketAccountSave(Request $request)
    {
        $chkAccount = $request->post('chkAccount');
        $settingCoupangs = MarketSettingCoupang::where('nUserId', Auth::id())
                                        ->whereIn('nIdx', $chkAccount)
                                        ->get();
        
        $markets = Market::where('strMarketCode', 'coupang');
        if($request->has('select_all')){
            session()->put('post_marketId_select_all', '1');
            session()->put('post_marketIds', $chkAccount);
        }else{
            session()->put('post_marketId_select_all', '0');
            session()->put('post_marketIds', $chkAccount);
        }
        $market_select_all = session()->get('post_marketId_select_all', 0);
        $market_selected = session()->get('post_marketIds', Array());
        $product_select_all = session()->get('post_product_select_all', 0);
        
        return view('product.MarketProductPrepare', compact('settingCoupangs', 'markets'));
    }
    /**
     * 마켓 카테고리 탐색
     */
    public function marketCategorySearch($marketCode = 'coupang', $categoryCode = 0, $setId=0, Request $request)
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
        
        return view('product.MarketCategorySearch', compact('marketCode', 'categories_1', 'setId'));
    }

    /**
     * 
     */
    public function marketOptionMappingSearch($marketCode = 'coupang', $categoryCode = 0, Request $request)
    {
        //옵션매핑에 필요한 정보를 얻는다
        if($marketCode == 'coupang'){
            $coupang = new CoupangConnector();
            $res =  (object)json_decode($coupang->getCategoryMetaInfo($categoryCode), false);
            $attrs = array();
            if(isset($res->code) && isset($res->data)){
                if($res->code = "SUCCESS"){
                    $data = $res->data;
                    if(empty($data->isAllowSingleItem)){
                        $attrs = $data->attributes;
                        $cnt = count($attrs);
                        //print_r($attrs);
                        foreach($attrs as $key => $attr){
                            // if( $attr->required != "MANDATORY" && (mb_strpos($attr->attributeTypeName, "사이즈", 0, "UTF-8") === false && mb_strpos($attr->attributeTypeName, "색상", 0, "UTF-8") === false)){
                            // //if( ( mb_strpos($attr->attributeTypeName, "수량") === false)){
                            //     unset($attrs[$key]);//=> 0,2...
                            //     //array_splice($attrs, $key, 1);//=> 0,1...
                            // }
                            if( ( $attr->required != "MANDATORY")){
                                unset($attrs[$key]);//=> 0,2...
                            }

                        }
                        $attrs = array_values($attrs);
                    }
                }
                return response()->json(["status" => "success", "data" => $attrs]);
            }else{
                return response()->json(["status" => "error", "data" => array()]);
            }
            
        }
        
        
    }
    /**
     * 상품등록송신
     */
    public function marketAccountProduct(Request $request)
    {
        //선택상품
        $product_select_all = session()->get('post_product_select_all', 0);
        $product_selected = session()->get('post_products', Array());
        
        if($product_select_all == 1) {
            $products = Product::where('bIsDel', 0)
                ->where('nUserId', Auth::id())
                ->where('nProductWorkProcess', 3)
                ->orderBy('nIdx')
                ->get();
        }else{
            $products = Product::where('bIsDel', 0)
                ->where('nUserId', Auth::id())
                ->where('nProductWorkProcess', 3)
                ->whereIn('nIdx', $product_selected)
                ->orderBy('nIdx')
                ->get();
        }
        $productsCount = count($products);
        $successCount = 0;
        $failedCount = 0;

        //선택마켓계정
        $marketAcc_select_all = session()->get('post_marketId_select_all', 0);
        $marketAcc_selected = session()->get('post_marketIds', Array());
        if($marketAcc_select_all == 1) {
            $settingCoupangs = MarketSettingCoupang::where('bIsDel', 0)
                ->where('nUserId', Auth::id())
                ->orderBy('nIdx')
                ->get();
        }else{
            $settingCoupangs = MarketSettingCoupang::where('bIsDel', 0)
                ->where('nUserId', Auth::id())
                ->whereIn('nIdx', $marketAcc_selected)
                ->orderBy('nIdx')
                ->get();
        }
        $arrCategoryCode = $request->post('txtCategoryCode');
        $arrCategoryName = $request->post('txtCategoryName');
        
        $CoupangCategoryCode = $arrCategoryCode["coupang"];
        $CoupangCategoryName = $arrCategoryName["coupang"];
        $coupang = new CoupangConnector();
        $cateMetaInfo = (object)json_decode($coupang->getCategoryMetaInfo($CoupangCategoryCode), true);
        //print_r($cateMetaInfo);
        //print_r($cateMetaInfo->data['attributes']);
        //notice 배렬을 만든다
        $noticeArr = array();
        if(count($cateMetaInfo->data['noticeCategories']) < 2){
            foreach ($cateMetaInfo->data['noticeCategories'][0]['noticeCategoryDetailNames'] as $key =>$value) {
                $notice = array(
                    "noticeCategoryName"=> $cateMetaInfo->data['noticeCategories'][0]['noticeCategoryName'],
                    "noticeCategoryDetailName"=> $cateMetaInfo->data['noticeCategories'][0]['noticeCategoryDetailNames'][$key]['noticeCategoryDetailName'],
                    "content"=> "상세페이지 참조"
                );
                array_push($noticeArr, $notice);
            }
        }else{
            foreach ($cateMetaInfo->data['noticeCategories'][1]['noticeCategoryDetailNames'] as $key =>$value) {
                $notice = array(
                    "noticeCategoryName"=> $cateMetaInfo->data['noticeCategories'][1]['noticeCategoryName'],
                    "noticeCategoryDetailName"=> $cateMetaInfo->data['noticeCategories'][1]['noticeCategoryDetailNames'][$key]['noticeCategoryDetailName'],
                    "content"=> "상세페이지 참조"
                );
                array_push($noticeArr, $notice);
            }
        }
        //print_r($cateMetaInfo->data['noticeCategories']);
        //print_r($noticeArr);
        //end of notice
        
        foreach ($settingCoupangs as $key1 => $setting) {
            //$outboundInfo = (object)json_decode($coupang->getOutboundShippingCenterInfo("", $setting->strOutboundShippingPlaceCode), true);
            //$returnCenterInfo = (object)json_decode($coupang->getReturnShippingCenterInfo($setting->strReturnCenterCode), true);
            $optMappingData = $request->post('txtOptionMapping_coupang_'.$setting->nIdx);
            $optMapping = mb_split(",", $optMappingData);
            $arrOptMapping = array();
            foreach ($optMapping as $key => $value) {
                $key_val= mb_split("::", $value);
                $arrOptMapping[$key_val[0]] = $key_val[1];
            }
            foreach ($products as $key2 => $product) {
                
                $start = new DateTime($setting->dtSalesPeriodStartDateTime);
                $end = new DateTime($setting->dtSalesPeriodStartDateTime);
                $categoryNameList = mb_split(" > ", $CoupangCategoryName);
                //아이템배렬을 만든다
                $productItems = $product->productItems;
                $arrItems = Array();
                foreach ($productItems as $key3 => $item) 
                {
                    //attribute 배렬을 만든다
                    //print_r($cateMetaInfo->data['attributes']);
                    $attrArr = array();
                    foreach ($cateMetaInfo->data['attributes'] as $key =>$value) {
                        if($cateMetaInfo->data['attributes'][$key]['required'] == "MANDATORY"){
                            $attributeValueName = "";
                            if($arrOptMapping[$cateMetaInfo->data['attributes'][$key]['attributeTypeName']] == "사이즈")
                                $attributeValueName = $item->strSubItemKrSize;
                            if($arrOptMapping[$cateMetaInfo->data['attributes'][$key]['attributeTypeName']] == "컬러")
                                $attributeValueName = $item->strSubItemKrColorPattern;
                                
                            $attr = array(
                                "attributeTypeName"=> $cateMetaInfo->data['attributes'][$key]['attributeTypeName'],
                                "attributeValueName"=> mb_substr($attributeValueName, 0, 30)
                            );
                            array_push($attrArr, $attr);
                        }
                        
                    }
                    //end of attribute

                    $arrItems[] = array(
                        "itemName"=> $item->strSubItemKrColorPattern."_".$item->strSubItemKrSize,
                        "originalPrice"=> $item->nSubItemBasePrice,
                        "salePrice"=> $item->nSubItemSalePrice,
                        "maximumBuyCount"=> $setting->nMaxQtyPerManDayLimit,
                        "maximumBuyForPerson"=> "0",
                        "outboundShippingTimeDay"=> $setting->nOutboundShippingTimeDay,
                        "maximumBuyForPersonPeriod"=> $setting->nMaxQtyPerManQtyLimit,
                        "unitCount"=> $setting->nUnitQuantity,
                        "adultOnly"=> $setting->bOnlyAdult == 0 ? "AUDLT_ONLY" : "EVERYONE",
                        "taxType"=> "TAX",
                        "parallelImported"=> $setting->bParallelImport == 1 ? "PARALLEL_IMPORTED" : "NOT_PARALLEL_IMPORTED",
                        "overseasPurchased"=> $setting->bOverSeaPurchaseAgent == 1 ? "OVERSEAS_PURCHASED" :"NOT_OVERSEAS_PURCHASED",
                        "pccNeeded"=> $setting->nPersonPassingCodeType == 1 ? "true" : "false",
                        "externalVendorSku"=> "0001",
                        "barcode"=> "",
                        "emptyBarcode"=> true,
                        "emptyBarcodeReason"=> "상품확인불가_바코드없음사유",
                        "modelNo"=> "1717171",
                        "extraProperties"=> null,
                        "certifications"=> $cateMetaInfo->data['certifications'],
                        "searchTags"=> explode(",",$product->strKeyword),
                        "images"=> array(
                            array(
                                "imageOrder"=> 0,
                                "imageType"=> "REPRESENTATION",
                                "vendorPath"=> "https:".$product->productImages->first()->strURL
                            ),
                            array(
                                "imageOrder"=> 1,
                                "imageType"=> "DETAIL",
                                "vendorPath"=> "https:".$product->productImages->where('nImageCode', 1)->first()->strURL
                            ),
                            array(
                                "imageOrder"=> 2,
                                "imageType"=> "DETAIL",
                                "vendorPath"=> "https:".$product->productImages->where('nImageCode', 2)->first()->strURL
                            )
                        ),
                        "notices"=> $noticeArr,
                        "attributes"=> $attrArr,
                        "contents"=> array(
                            array(
                                "contentsType"=> "TEXT",
                                "contentDetails"=> array(
                                    array(
                                        "content"=> $product->productDetail->blobNote,
                                        "detailType"=> "TEXT"
                                    )
                                )
                            )
                        ),
                        "offerCondition" => "NEW",
                        "offerDescription" => ""
                    );
                }
                //print_r($arrItems);
                //기본 상품배렬을 만든다
                $objProduct = array(
                    "displayCategoryCode" => $CoupangCategoryCode, //쿠팡카테고리 코드
                    "sellerProductName" => $product->strMainName,
                    "vendorId" => $setting->marketAccount->strVendorId,
                    "saleStartedAt" => $start->format('Y-m-d\TH:i:s'),
                    "saleEndedAt" => $end->format('Y-m-d\TH:i:s'),
                    "displayProductName" => $product->strBrand.$product->strKrMainName,
                    "brand" => $product->strBrand,
                    "generalProductName" => $product->strKrMainName,
                    "productGroup" => $categoryNameList[count($categoryNameList)-1],
                    "deliveryMethod" => $setting->deliveryType->strDeliveryCode,
                    "deliveryCompanyCode" => $setting->strDeliveryCompanyCode,
                    "deliveryChargeType" => $setting->strDeliveryChargeType,
                    "deliveryCharge" => $setting->nDeliveryCharge,
                    "freeShipOverAmount" => $setting->nFreeShipOverAmount,
                    "deliveryChargeOnReturn" => $setting->nDeliveryChargeOnReturn,
                    "remoteAreaDeliverable" => $setting->nRemoteAreaDeliveryType == 1 ? "Y" : "N",
                    "unionDeliveryType" => $setting->strUnionDeliveryType,
                    "returnCenterCode" => $setting->strReturnCenterCode,
                    "returnChargeName" => $setting->strReturnSellerName,
                    "companyContactNumber" => $setting->strCompanyContactNumber,
                    "returnZipCode" => $setting->strReturnZipCode,
                    "returnAddress" => $setting->strReturnAddress,
                    "returnAddressDetail" => $setting->strReturnAddressDetail,
                    "returnCharge" => $setting->nReturnDeliveryCharge,
                    "returnChargeVendor" => $setting->strReturnChargeVendorType,
                    "afterServiceInformation" => $setting->strAfterServiceGuide,
                    "afterServiceContactNumber" => $setting->strAfterServiceContactNumber,
                    "outboundShippingPlaceCode" => $setting->strOutboundShippingPlaceCode,
                    "vendorUserId" => $setting->marketAccount->strAccountId,
                    "requested" => false,
                    "items" => $arrItems,
                    "requiredDocuments"=> array(
                        array(
                            "templateName"=> $setting->requireDocument3->strImageName,
                            "vendorDocumentPath"=> asset('storage/'. $setting->requireDocument3->strImageURL)
                        )
                    ),
                    "extraInfoMessage"=> "",
                    "manufacture"=> $product->strBrand
                );
                // echo json_encode($objProduct);
                $result = $coupang->addProduct(json_encode($objProduct));
                $response = (object)json_decode($result, true);
                if($response->code=="SUCCESS")
                {
                    $successCount++;
                    //return response()->json(["status" => "success", "data" => "Successfully uploaded products."]);
                }
                else{
                    //return response()->json(["status" => "failed", "data" => "Failed to upload product."]);
                    $failedCount++;
                }
            }
        }
        return view('product.ProductUploadResult', compact('productsCount', 'successCount', 'failedCount'));
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
        // return response()->json(["status" => "success", "data" => $marketAccount]);
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
        // return response()->json(["status" => "success", "data" => $marketAccount]);
    }
}
