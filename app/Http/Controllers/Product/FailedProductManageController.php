<?php

namespace App\Http\Controllers\Product;

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
use App\Models\FailedProduct;
use App\Models\FailedProductDetail;
use App\Models\FailedProductImage;
use App\Models\FailedProductItem;
use App\Models\Market;
use App\Models\MarketAccount;
use App\Models\MarketSettingCoupang;
use App\Models\SuccessProduct;
use App\Models\SuccessProductDetail;
use App\Models\SuccessProductImage;
use App\Models\SuccessProductItem;
use App\MyLibs\CoupangConnector;
use DateTime;
use Illuminate\Support\Facades\View;
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class FailedProductManageController extends Controller
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

        $title = "상품등록 실패관리";

        if ($request->ajax()) {
            $products = FailedProduct::where('bIsDel', 0)
                ->where('nUserId', Auth::id())
                ->orderBy('nIdx', 'DESC');

            return DataTables::eloquent($products)
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
                    $item = '<ul class="list-inline" style="width:100px;">';
                    foreach ($row->productImages as $productImage) {
                        $item .= '<li class="list-inline-item" >
                                    <a href="'.$productImage->strURL.'" class="preview">
                                        <img alt="Avatar" class="table-avatar" src="'.$productImage->strURL.'">
                                    </a>
                                </li>';
                    }
                    $item .= '</ul>';
                    return $item;
                })
                ->addColumn('productInfo', function($row){
                    $strCategory = $row->strCategoryCode0;
                    $category = mb_split(" : ", $strCategory)[1];
                    $element = '<ul class="list-inline" style="">';
                    $element .= '<li class="list-inline-item">
                            '.$category.'
                        </li><br>';
                    $element .= '<li class="list-inline-item">
                            '.$row->strKrSubName.'
                        </li><br>';
                    $element .= '<li class="list-inline-item">
                            '.$row->strKrMainName.'
                        </li><br>';
                    //옵션
                    $options = explode("§", $row->strKoOption);
                    $optionValue = explode("§", $row->strKoOptionValue);
                    foreach ($options as $key => $value) {
                        $element .= '<li class="list-inline-item">
                            <span style="text-align:left;">'.$value.':</span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="text-align:right;">'.$optionValue[$key].'</span>
                        </li><br>';
                    }
                    
                    $element .= '<li class="font-weight-light list-inline-item">
                            '.Auth::user()->name.'['.$row->created_at.']
                        </li><br>';
                    $element .= '<li class="font-weight-light list-inline-item">
                        <code style="font-size: 12px; color: red;" >실패내용:&nbsp;&nbsp;&nbsp;&nbsp;'.$row->strReason.'</code>
                    </li>';
                    $element .= '</ul>';
                    return $element;
                })
                ->addColumn('priceInfo', function($row){
                    $price1 = $row->productDetail->nProductPrice + $row->productDetail->nOptionSellDiscountPrice;
                    $element = '<ul class="list-inline" style="width:100px;">';
                    $element .= '<li class="list-inline-item">
                            '.$row->productDetail->nProductPrice.'
                        </li><br>';
                    $element .= '<li class="list-inline-item">
                            '.$price1.'
                        </li><br>';
                    $element .= '</ul>';
                    return $element;
                })
                ->addColumn('marginInfo', function($row){
                    $element = '<ul class="list-inline" style="width:100px;">';
                    $element .= '<li class="list-inline-item">
                            '.$row->productDetail->nMarginRate.'
                        </li><br>';
                    $element .= '<li class="list-inline-item">
                            '.$row->productDetail->nSellerMarketChargeRate.'
                        </li>';
                            
                    $element .= '</ul>';
                    return $element;
                })
                ->addColumn('marketInfo', function($row){
                    $arrCode = explode(":", $row->strId);
                    $strCode = "";
                    //c이면 쿠팡
                    if($arrCode[0]=="C"){
                        $strCode = "쿠팡";
                    }
                    $marketInfo = '<ul class="list-inline" style="width:100px;">
                        <li class="list-inline-item">
                        '.$strCode.'
                        </li><br>';
                    $marketInfo = '<li class="list-inline-item">
                        '.$row->strMarketAccId.'
                        </li><br>';
                    $marketInfo = '<li class="list-inline-item">
                        '.$row->strSolutionId.'
                        </li><br>';
                    $marketInfo .= '<li class="list-inline-item">
                        '.$row->strId.'
                        </li></ul>';
                    return $marketInfo;
                })
                ->addColumn('codeInfo', function ($row){
                    $element = '<ul class="list-inline" style="width:100px;">';
                    $element .= '<a href="javascript:void(0)" class="openWindow" data-id="'.$row->nIdx.'">';
                    $element .= '<li class="list-inline-item">
                        '.$row->strId.'
                        </li><br>';
                    $element .= '<li class="list-inline-item">
                        '.$row->strSolutionId.'
                        </li></a></ul>';
                    return $element;
                })
                ->addColumn('mainImage', function($row){
                    $main = $row->productImages->where('nImageCode', '0')->first();
                    $mainImage = '<li class="list-inline-item">
                                    <a href="'.$row->strURL.'" target="_blank">
                                        <span data="'.$main->strURL.'" class="preview">
                                            <img alt="gallery thumbnail" style="width: 5rem;" src="'.$main->strURL.'">
                                        </span>
                                    </a>
                                </li>';
                    $arrCode = explode(":", $row->strId);
                    $strCode = "";
                    //c이면 쿠팡
                    if($arrCode[0]=="C"){
                        $strCode = "쿠팡";
                    }else if($arrCode[0]=="11"){
                        $strCode = "11번가";
                    }
                    $mainImage .= '<br><li class="list-inline-item text-center">'.$strCode.'</li>';
                    return $mainImage;
                })
                ->rawColumns(['check', 'productInfo', 'mainImage', 'marketInfo', 'priceInfo', 'marginInfo', 'codeInfo'])
                ->make(true);
                
        }
        return view('product.FailedProductManage', compact('title'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($productId = 0)
    {
        $product = FailedProduct::where('bIsDel', 0)
            ->where('nIdx', $productId)
            ->first();
        $product->productMainImage = $product->productImages->where('nImageCode',0)->first() == null ? new FailedProductImage() : $product->productImages->where('nImageCode',0)->first();
        $product->productSubImage1 = $product->productImages->where('nImageCode',1)->first() == null ? new FailedProductImage() : $product->productImages->where('nImageCode',1)->first();
        $product->productSubImage2 = $product->productImages->where('nImageCode',2)->first() == null ? new FailedProductImage() : $product->productImages->where('nImageCode',2)->first();
            
        $koOptions = explode('§', $product->strKoOption);
        $koOptNames = explode('§', $product->strKoOptionValue);
        $koOptPrice = explode('§', $product->strOptionPrice);
        $OptImage = explode('§', $product->blobOptionImage);

        $cnOptions = explode('§', $product->strCnOption);
        $cnOptNames = explode('§', $product->strCnOptionValue);
        //print_r($cnOptions);
        $arrKoOption = array();
        $arrCnOption = array();
        $arrOptionPrice = array();
        $arrOptionImage = array();
        
        foreach ($koOptions as $key => $value) {
            $arrKoOption[] = explode(',', $koOptNames[$key]);
            $arrCnOption[] = explode(',', array_key_exists($key, $cnOptNames) == true ? $cnOptNames[$key] : ""); 
            $arrOptionPrice[] = explode('¶', array_key_exists($key, $koOptPrice) == true ? $koOptPrice[$key] : ""); 
            $arrOptionImage[] = explode('¶', array_key_exists($key, $OptImage) == true ? $OptImage[$key] : ""); 
        }
        return view('product.FailedProductDetail', compact('product', 'koOptions', 'arrKoOption', 'cnOptions', 'arrCnOption', 'arrOptionPrice', 'arrOptionImage'));

    }

    public function update($productId = 0, Request $request)
    {
        $val = $request->post('txtChMainName');
        
        //옵션명
        $arrKoOptName = $request->post('txtOptionAttr');
        $strKoOption = implode("§", $arrKoOptName);
        //return redirect('scratchProductScrap');
        $arrCnOptName = $request->post('txtCnOptionAttr');
        $strCnOption = implode("§", $arrCnOptName);
        //main data
        $categoryName = $request->post('txtCategoryName');

        $arrOptionAttr = array();
        $arrKoOptionValue = array();
        $arrCnOptionValue = array();
        $arrOptionPrice = array();
        $arrOptionImage = array();
        foreach ($arrKoOptName as $key => $value) {
            $arrOptionAttr[] = $request->post('optName_'.$key);
            $arrKoOptionValue[] = implode(",", $request->post('txtKoOptionName_'.$key));
            $arrCnOptionValue[] = implode(",", $request->post('txtCnOptionName_'.$key));
            $arrOptionPrice[] = implode("¶", $request->post('txtAddOptionPrice_'.$key));
            $arrOptionImage[] = implode("¶", $request->post('txtOptionImage_'.$key));
            
        }
        $strKoOptionValue = implode("§", $arrKoOptionValue);
        $strCnOptionValue = implode("§", $arrCnOptionValue);
        $strOptionPrice = implode("§", $arrOptionPrice);
        $strOptionImage = implode("§", $arrOptionImage);
        $product = FailedProduct::where('nIdx', $productId)->first();

        $product->update([
            'nUserId' => Auth::id(),
            'strURL' => $product->strURL, 
            'strMainName' => $request->post('txtKrMainName'),
            'strSubName' => $request->post('txtKrSubName'),
            'nBrandType' => $product->nBrandType,
            'strBrand' => $product->strBrand,
            'strKeyword' => $product->strKeyword,
            'strKoOption' => $strKoOption,
            'strKoOptionValue' => $strKoOptionValue,
            'strCnOption' => $strCnOption,
            'strCnOptionValue' => $strCnOptionValue,
            'strOptionPrice' => $strOptionPrice,
            'blobOptionImage' => $strOptionImage,
            'strChMainName' => $request->post('txtChMainName'),
            'strKrMainName' => $request->post('txtKrMainName'), 
            'strChSubName' => $request->post('txtChMainName'), 
            'strKrSubName' => $request->post('txtKrSubName'), 
            'strComeCode' => $product->strComeCode,
            'strCategoryCode0' => $categoryName[0], 
            'strCategoryCode1' => $categoryName[1], 
            'strCategoryCode2' => $categoryName[2], 
            'strCategoryCode3' => $categoryName[3], 
            'strCategoryCode4' => $categoryName[4], 
            'strCategoryCode5' => $categoryName[5], 
            'strCategoryCode6' => $categoryName[6], 
            'strCategoryCode7' => $categoryName[7], 
            'strCategoryCode8' => $categoryName[8], 
            'nShareType' => $product->nShareType,
            'nProductWorkProcess' => 2,//stopped product
            'bIsDel'=> 0
        ]);
        $product->save();

        $product->productDetail->update([
            'nProductPrice' => number_format($request->post('txtProductPrice'), 2, '.', ''),
            'nBasePrice' => number_format($request->post('txtBasePrice'), 2, '.', ''),
            'nDiscountPrice' => number_format($request->post('txtDiscountPrice'), 2, '.', ''),//
            'nExchangeRate' => number_format($request->post('txtExchangeRate'), 2, '.', ''),//
            'nExpectedRevenue' => number_format($request->post('txtExpectedRevenue'), 2, '.', ''),//
            'nMarginRate' => number_format($request->post('txtMarginRate'), 2, '.', ''),//
            'nSellerMarketChargeRate' => number_format($request->post('txtSellerMarketChargeRate'), 2, '.', ''),//
            'nBuyerMarketChargeRate' => number_format($request->post('txtBuyerMarketChargeRate'), 2, '.', ''),//
            'nOverSeaDeliveryCharge' => number_format($request->post('txtOverSeaDeliveryCharge'), 2, '.', ''),//
            'strFunction' => $request->post('txtFunction'),//
            'nDeliveryCharge' => number_format($request->post('txtDeliveryCharge'), 2, '.', ''),//
            'nReturnDeliveryCharge' => number_format($request->post('txtReturnDeliveryCharge'), 2, '.', ''),//
            'nExchangeDeliveryCharge' => number_format($request->post('txtExchangeDeliveryCharge'), 2, '.', ''),//
            'nOptionSellPrice' => number_format($request->post('txtOptionSellPrice'), 2, '.', ''),//
            'nOptionBasePrice' => number_format($request->post('txtOptionBasePrice'), 2, '.', ''),//
            'nOptionDiscountPrice' => number_format($request->post('txtOptionDiscountPrice'), 2, '.', ''),//
            'nOptionSSPrice' => number_format($request->post('txtOptionSSPrice'), 2, '.', ''),//
            'nOptionESMPrice' => number_format($request->post('txtOptionESMPrice'), 2, '.', ''),//
            'nOptionSellDiscountPrice' => number_format($request->post('txtOptionSellDiscountPrice'), 2, '.', ''),//
            'nOptionESMDeliveryCharge' => number_format($request->post('txtOptionESMDeliveryCharge'), 2, '.', ''),//
            'blobNote' => $request->post('summernote'),
            'bIsDel'=> 0
        ]);
        
        $arrOptName = $request->post('txtOptionAttr');
        $arrCnOptName = $request->post('txtCnOptionAttr');
        $cntOptionName = count($arrOptName) > 3 ? 3 : count($arrOptName);

        $countItem = count($request->post('sku_sell_price'));
        $sku_base_price = $request->post('sku_discount_price');
        $sku_sell_price = $request->post('sku_sell_price');
        $sku_discount_price = $request->post('sku_discount_price');
        $sku_option_price = $request->post('sku_option_price');
        $sku_stock = $request->post('sku_stock');
        $sku_image = $request->post('sku_image');
        
        FailedProductItem::where('nProductIdx',$product->nIdx)->delete();
        for ($i=0; $i < $countItem; $i++) { 

            $productItem = new FailedProductItem([
                'nProductIdx' => $product->nIdx,
                'nSubItemOptionPrice' => $sku_option_price[$i],
                'nSubItemBasePrice' => $sku_base_price[$i],
                'nSubItemSellPrice' => $sku_sell_price[$i],
                'nSubItemDiscountPrice' => $sku_discount_price[$i],
                'nSubItemQuantity' => $sku_stock[$i],
                'strSubItemImage' => $sku_image[$i],
                'bIsDel' => 0
            ]);
            $subItemName = "";
            for ($j=0; $j < $cntOptionName; $j++) {
                $productItem['strSubItemKoOptionPattern'.$j] = $arrOptionAttr[$j][$i];
                $subItemName .= $arrOptionAttr[$j][$i]." ";
            }
            $productItem['strSubItemName'] = $subItemName;
            $productItem->save();
        }
        
        FailedProductImage::where('nProductIdx',$product->nIdx)->delete();
        $countImage = count($request->post('txtImage'));
        $arrDetailImage = $request->post('txtImage');
        //print_r($arrDetailImage);
        for ($i=0; $i < $countImage; $i++) { 
            $arrImgData = explode('::', $arrDetailImage[$i]);
            $productImage = new FailedProductImage([
                'nProductIdx' => $product->nIdx,
                'nImageCode' => $arrImgData[0],
                'strName' => '',
                'strURL' => $arrImgData[1],
                'nHeight' => 0,
                'nWidth' => 0,
                'strNote' => '',
                'bIsDel' => 0
            ]);
            $productImage->save();
        }

        $data = '<script>alert("수정이 완료되었습니다.");window.opener.location.reload();window.close();</script>';
        return view('test', compact('data'));
    } 

    /**
     * 마켓 카테고리 탐색
     */
    public function marketCategorySearch($marketCode = 'coupang', $categoryCode = 0, Request $request)
    {
        if($marketCode == 'coupang'){
            $coupang = new CoupangConnector();
            $res =  (object)json_decode($coupang->getCategoryInfoViaCode($categoryCode), false);
            //$marketCode
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
        
        //dd($categories_1);
        return view('product.MarketCategorySearch', compact('marketCode', 'categories_1'));
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
    
    //상품등록을 위한 마켓계정 리스트(get)
    public function marketAccountList(Request $request)
    {
        
        $products = $request->get('products');
        // $marketAccounts = MarketAccount::where('nUserId', Auth::id())
        //                                 ->get();
        $settingCoupangs = MarketSettingCoupang::where('nUserId', Auth::id())
                                        ->where('bIsDel', 0)
                                        ->get();

        return view('product.FailedMarketAccountList', compact('settingCoupangs', 'products'));
    }

    //상품등록을 위한 마켓계정 선택(post)
    //상품등록정보
    public function registProduct(Request $request)
    {
        $chkAccount = $request->post('chkAccount');
        $strProduct = $request->post('products');
        $settingCoupangs = MarketSettingCoupang::where('nUserId', Auth::id())
                                        ->whereIn('nIdx', $chkAccount)
                                        ->get();
        
        $markets = Market::where('strMarketCode', 'coupang');
        
        $productIds = explode("|", $strProduct);
        $products = FailedProduct::where('bIsDel', 0)
            ->where('nUserId', Auth::id())
            ->whereIn('nIdx', $productIds)
            ->get();

        $productsCount = count($products);
        $successCount = 0;
        $failedCount = 0;
        foreach ($settingCoupangs as $key1 => $setting) {
            
            $coupang = new CoupangConnector($setting->marketAccount->strAPIAccessKey, $setting->marketAccount->strSecretKey, $setting->marketAccount->strVendorId, $setting->marketAccount->strAccountId);
            foreach ($products as $key2 => $product) {

                //만약 상품이 쿠팡에 이미 등록되였다면 넘긴다
                if($product->bRegCoupang == 1)
                  continue;
                $start = new DateTime($setting->dtSalesPeriodStartDateTime);
                $end = new DateTime($setting->dtSalesPeriodEndDateTime);
                $strOption = $product->strKoOption;
                $arrOption = explode("§", $strOption);

                $strCategory = $product->strCategoryCode2;
                $arrCategory = mb_split(" : ", $strCategory);
                $strCategoryCode = $arrCategory[0];
                $strCategoryNames = mb_split(" > ", $arrCategory[1]);
                $cateMetaInfo = (object)json_decode($coupang->getCategoryMetaInfo($strCategoryCode), true);
                $certifications = array_slice($cateMetaInfo->data['certifications'], 0, 5);
                
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
                //아이템배렬을 만든다
                $productItems = $product->productItems;
                $arrItems = Array();
                foreach ($productItems as $key3 => $item) 
                {
                  //attribute 배렬을 만든다
                  //print_r($cateMetaInfo->data['attributes']);
                  $attrArr = array();
                  foreach ($arrOption as $key =>$value) {
                      $attr = array(
                          "attributeTypeName"=> $value,
                          "attributeValueName"=> $item['strSubItemKoOptionPattern'.$key]
                      );
                      array_push($attrArr, $attr);
                  }
                  //end of attribute
                  $arrItems[] = array(
                      "itemName"=> $item->strSubItemName,
                      "originalPrice"=> $item->nSubItemSellPrice,
                      "salePrice"=> $item->nSubItemSellPrice,
                      "maximumBuyCount"=> $item->nSubItemQuantity > 0 ? $item->nSubItemQuantity : $setting->nUnitQuantity,//$setting->nMaxQtyPerManDayLimit,
                      "maximumBuyForPerson"=> "0",
                      "outboundShippingTimeDay"=> $setting->nOutboundShippingTimeDay,
                      "maximumBuyForPersonPeriod"=> $setting->nMaxQtyPerManQtyLimit,
                      "unitCount"=> 0,//$item->nSubItemQuantity > 0 ? $item->nSubItemQuantity : $setting->nUnitQuantity,
                      "adultOnly"=> $setting->bOnlyAdult == 0 ? "EVERYONE" : "AUDLT_ONLY",
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
                      //"certifications"=> $certifications,
                      "searchTags"=> explode(',',$product->strKeyword),
                      "images"=> array(
                          array(
                              "imageOrder"=> 0,
                              "imageType"=> "REPRESENTATION",
                              "vendorPath"=> "https:".$item->strSubItemImage
                          )
                      ),
                      "certifications"=> array(
                          array(
                            "certificationType"=> "NOT_REQUIRED",
                            "certificationCode"=> ""
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
                  "displayCategoryCode" => $strCategoryCode, //쿠팡카테고리 코드
                  "sellerProductName" => $product->strMainName,
                  "vendorId" => $setting->marketAccount->strVendorId,
                  "saleStartedAt" => $start->format('Y-m-d\TH:i:s'),
                  "saleEndedAt" => $end->format('Y-m-d\TH:i:s'),
                  "displayProductName" => $product->strBrand.$product->strKrMainName,
                  "brand" => $product->strBrand,
                  "generalProductName" => $product->strKrMainName,
                  "productGroup" => $strCategoryNames[count($strCategoryNames)-1],
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
                          "templateName"=> "기타문서",//$setting->requireDocument3->strImageName,
                          "vendorDocumentPath"=> "http://image11.coupangcdn.com/image/product/content/vendorItem/2018/07/02/41579010/eebc0c30-8f35-4a51-8ffd-808953414dc1.jpg"//asset('storage/'. $setting->requireDocument3->strImageURL)
                      )
                  ),
                  "extraInfoMessage"=> "",
                  "manufacture"=> $product->strBrand
                );
                
                $result = $coupang->addProduct(json_encode($objProduct));
                $response = (object)json_decode($result, true);
                if($response->code=="SUCCESS")
                {
                    $successCount++;
                    $product->update(['bRegCoupang' => 1]);
                    //상품등록 성공으로 추가
                    $successProduct = new SuccessProduct([
                        'nUserId' => Auth::id(),
                        'nMarketSetIdx' => $setting->nIdx,
                        'strId' => "C:".$response->data,
                        'strSolutionId' => $product->strSolutionId,
                        'strURL' => $product->strURL, 
                        'strMainName' => $product->strMainName,
                        'strSubName' => $product->strSubName,
                        'nBrandType' => $product->nBrandType,
                        'strBrand' => $product->strBrand,
                        'strKeyword' => $product->strKeyword,
                        'strKoOption' => $product->strKoOption,
                        'strKoOptionValue' => $product->strKoOptionValue,
                        'strCnOption' => $product->strCnOption,
                        'strCnOptionValue' => $product->strCnOptionValue,
                        'strOptionPrice' => $product->strOptionPrice,
                        'blobOptionImage' => $product->blobOptionImage,
                        'strChMainName' => $product->strChMainName,
                        'strKrMainName' => $product->strKrMainName,
                        'strChSubName' => $product->strChSubName,
                        'strKrSubName' => $product->strKrSubName,
                        'strComeCode' => $product->strComeCode,
                        'strCategoryCode0' => $product->strCategoryCode0,
                        'strCategoryCode1' => $product->strCategoryCode1,
                        'strCategoryCode2' => $product->strCategoryCode2,
                        'strCategoryCode3' => $product->strCategoryCode3,
                        'strCategoryCode4' => $product->strCategoryCode4,
                        'strCategoryCode5' => $product->strCategoryCode5,
                        'strCategoryCode6' => $product->strCategoryCode6,
                        'strCategoryCode7' => $product->strCategoryCode7,
                        'strCategoryCode8' => $product->strCategoryCode8,
                        'nShareType' => $product->nShareType,
                        'nProductWorkProcess' => 1,
                        'bIsDel'=> 0
                    ]);
                    $successProduct->save();

                    $productDetail = new SuccessProductDetail([
                        'nProductIdx' => $successProduct->nIdx,
                        'nProductPrice' => $product->productDetail->nProductPrice,
                        'nBasePrice' => $product->productDetail->nBasePrice,
                        'nDiscountPrice' => $product->productDetail->nDiscountPrice,
                        'nExchangeRate' => $product->productDetail->nExchangeRate,
                        'nExpectedRevenue' => $product->productDetail->nExpectedRevenue,
                        'nMarginRate' => $product->productDetail->nMarginRate,
                        'nSellerMarketChargeRate' => $product->productDetail->nSellerMarketChargeRate,
                        'nBuyerMarketChargeRate' => $product->productDetail->nBuyerMarketChargeRate,
                        'nOverSeaDeliveryCharge' => $product->productDetail->nOverSeaDeliveryCharge,
                        'strFunction' => $product->productDetail->strFunction,
                        'nDeliverCharge' => $product->productDetail->nDeliverCharge,
                        'nReturnDeliverCharge' => $product->productDetail->nReturnDeliverCharge,
                        'nExchangeDeliveryCharge' => $product->productDetail->nExchangeDeliveryCharge,
                        'nOptionSellPrice' => $product->productDetail->nOptionSellPrice,
                        'nOptionBasePrice' => $product->productDetail->nOptionBasePrice,
                        'nOptionDiscountPrice' => $product->productDetail->nOptionDiscountPrice,
                        'nOptionSSPrice' => $product->productDetail->nOptionSSPrice,
                        'nOptionESMPrice' => $product->productDetail->nOptionESMPrice,
                        'nOptionSellDiscountPrice' => $product->productDetail->nOptionSellDiscountPrice,
                        'nOptionESMDeliveryCharge' => $product->productDetail->nOptionESMDeliveryCharge,
                        'blobNote' => $product->productDetail->blobNote,
                        'bIsDel'=> 0
                    ]);
                    $productDetail->save();

                    foreach ($product->productImages as $key => $image) {
                        $productImage = new SuccessProductImage([
                            'nProductIdx' => $successProduct->nIdx,
                            'nImageCode' => $image->nImageCode,
                            'strName' => $image->strName,
                            'strURL' => $image->strURL,
                            'nHeight' => $image->nHeight,
                            'nWidth' => $image->nWidth,
                            'strNote' => $image->strNote,
                            'bIsDel' => 0
                        ]);
                        $productImage->save();
                    }

                    foreach ($product->productItems as $key => $item) {
                        $productItem = new SuccessProductItem([
                            'nProductIdx' => $successProduct->nIdx,
                            'strSubItemName' => $item->strSubItemName,
                            'nSubItemOptionPrice' => $item->nSubItemOptionPrice,
                            'nSubItemBasePrice' => $item->nSubItemBasePrice,
                            'nSubItemSellPrice' => $item->nSubItemSellPrice,
                            'nSubItemDiscountPrice' => $item->nSubItemDiscountPrice,
                            'nSubItemQuantity' => $item->nSubItemQuantity,
                            'strSubItemImage' => $item->strSubItemImage,
                            'strSubItemKoOptionPattern0' => $item->strSubItemKoOptionPattern0,
                            'strSubItemKoOptionPattern1' => $item->strSubItemKoOptionPattern1,
                            'strSubItemKoOptionPattern2' => $item->strSubItemKoOptionPattern2,
                            'bIsDel' => 0
                        ]);
                        $productItem->save();
                    }

                }else{
                    $failedCount++;
                    
                    //상품등록 실패로 추가
                    $failedProduct = new FailedProduct([
                        'nUserId' => Auth::id(),
                        'strSolutionId' => $product->strSolutionId,
                        'nMarketSetIdx' => $setting->nIdx,
                        'strURL' => $product->strURL, 
                        'strMainName' => $product->strMainName,
                        'strSubName' => $product->strSubName,
                        'nBrandType' => $product->nBrandType,
                        'strBrand' => $product->strBrand,
                        'strKeyword' => $product->strKeyword,
                        'strKoOption' => $product->strKoOption,
                        'strKoOptionValue' => $product->strKoOptionValue,
                        'strCnOption' => $product->strCnOption,
                        'strCnOptionValue' => $product->strCnOptionValue,
                        'strOptionPrice' => $product->strOptionPrice,
                        'blobOptionImage' => $product->blobOptionImage,
                        'strChMainName' => $product->strChMainName,
                        'strKrMainName' => $product->strKrMainName,
                        'strChSubName' => $product->strChSubName,
                        'strKrSubName' => $product->strKrSubName,
                        'strComeCode' => $product->strComeCode,
                        'strCategoryCode0' => $product->strCategoryCode0,
                        'strCategoryCode1' => $product->strCategoryCode1,
                        'strCategoryCode2' => $product->strCategoryCode2,
                        'strCategoryCode3' => $product->strCategoryCode3,
                        'strCategoryCode4' => $product->strCategoryCode4,
                        'strCategoryCode5' => $product->strCategoryCode5,
                        'strCategoryCode6' => $product->strCategoryCode6,
                        'strCategoryCode7' => $product->strCategoryCode7,
                        'strCategoryCode8' => $product->strCategoryCode8,
                        'nShareType' => $product->nShareType,
                        'nProductWorkProcess' => 0,
                        'strReason' => (strPos($response->message, "'") !== false ? "알수없는 오류가 발생했습니다." : $response->message),
                        'bIsDel'=> 0
                    ]);
                    $failedProduct->save();

                    $productDetail = new FailedProductDetail([
                        'nProductIdx' => $failedProduct->nIdx,
                        'nProductPrice' => $product->productDetail->nProductPrice,
                        'nBasePrice' => $product->productDetail->nBasePrice,
                        'nDiscountPrice' => $product->productDetail->nDiscountPrice,
                        'nExchangeRate' => $product->productDetail->nExchangeRate,
                        'nExpectedRevenue' => $product->productDetail->nExpectedRevenue,
                        'nMarginRate' => $product->productDetail->nMarginRate,
                        'nSellerMarketChargeRate' => $product->productDetail->nSellerMarketChargeRate,
                        'nBuyerMarketChargeRate' => $product->productDetail->nBuyerMarketChargeRate,
                        'nOverSeaDeliveryCharge' => $product->productDetail->nOverSeaDeliveryCharge,
                        'strFunction' => $product->productDetail->strFunction,
                        'nDeliverCharge' => $product->productDetail->nDeliverCharge,
                        'nReturnDeliverCharge' => $product->productDetail->nReturnDeliverCharge,
                        'nExchangeDeliveryCharge' => $product->productDetail->nExchangeDeliveryCharge,
                        'nOptionSellPrice' => $product->productDetail->nOptionSellPrice,
                        'nOptionBasePrice' => $product->productDetail->nOptionBasePrice,
                        'nOptionDiscountPrice' => $product->productDetail->nOptionDiscountPrice,
                        'nOptionSSPrice' => $product->productDetail->nOptionSSPrice,
                        'nOptionESMPrice' => $product->productDetail->nOptionESMPrice,
                        'nOptionSellDiscountPrice' => $product->productDetail->nOptionSellDiscountPrice,
                        'nOptionESMDeliveryCharge' => $product->productDetail->nOptionESMDeliveryCharge,
                        'blobNote' => $product->productDetail->blobNote,
                        'bIsDel'=> 0
                    ]);
                    $productDetail->save();

                    foreach ($product->productImages as $key => $image) {
                        $productImage = new FailedProductImage([
                            'nProductIdx' => $failedProduct->nIdx,
                            'nImageCode' => $image->nImageCode,
                            'strName' => $image->strName,
                            'strURL' => $image->strURL,
                            'nHeight' => $image->nHeight,
                            'nWidth' => $image->nWidth,
                            'strNote' => $image->strNote,
                            'bIsDel' => 0
                        ]);
                        $productImage->save();
                    }

                    foreach ($product->productItems as $key => $item) {
                        $productImage = new FailedProductItem([
                            'nProductIdx' => $failedProduct->nIdx,
                            'strSubItemName' => $item->strSubItemName,
                            'nSubItemOptionPrice' => $item->nSubItemOptionPrice,
                            'nSubItemBasePrice' => $item->nSubItemBasePrice,
                            'nSubItemSellPrice' => $item->nSubItemSellPrice,
                            'nSubItemDiscountPrice' => $item->nSubItemDiscountPrice,
                            'nSubItemQuantity' => $item->nSubItemQuantity,
                            'strSubItemImage' => $item->strSubItemImage,
                            'strSubItemKoOptionPattern0' => $item->strSubItemKoOptionPattern0,
                            'strSubItemKoOptionPattern1' => $item->strSubItemKoOptionPattern1,
                            'strSubItemKoOptionPattern2' => $item->strSubItemKoOptionPattern2,
                            'bIsDel' => 0
                        ]);
                        $productImage->save();
                    }
                }
            }
        }
        return view('scratch.ProductRegistResult', compact('productsCount', 'successCount', 'failedCount'));
    }
}
