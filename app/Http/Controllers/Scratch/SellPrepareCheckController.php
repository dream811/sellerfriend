<?php

namespace App\Http\Controllers\Scratch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\ProductImage;
use App\Models\ProductDetail;
use App\Models\ProductRegCoupang;
use App\Models\ProductReg11thhouse;
use App\Models\ProductRegAuction;
use App\Models\ProductRegGmarket;
use App\Models\ProductRegTmon;
use App\Models\ProductRegLotteon;
use App\Models\ProductRegInterpark;
use App\Models\ProductRegSmartstore;
use App\Models\ProductRegWemakeprice;
use App\Models\Come;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Country;
use App\Models\FailedProduct;
use App\Models\FailedProductDetail;
use App\Models\FailedProductImage;
use App\Models\FailedProductItem;
use App\Models\Market;
use App\Models\MarketAccount;
use App\Models\MarketSetting;
use App\Models\MarketSettingCoupang;
use App\Models\SuccessProduct;
use App\Models\SuccessProductDetail;
use App\Models\SuccessProductImage;
use App\Models\SuccessProductItem;
use App\MyLibs\CoupangConnector;
use App\Mylibs\EleventhConnector;
use App\Mylibs\Snoopy;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Storage;
use SimpleXMLElement;
use Yajra\DataTables\DataTables;

class SellPrepareCheckController extends Controller
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
        
        $comes = Come::where('bIsDel', 0)
                ->orderBy('strComeCode')
                ->get();
        $markets = Market::where('bIsDel', 0)
                ->orderBy('nIdx')
                ->get();
        $marketAccounts = MarketAccount::where('nUserId', Auth::id())
                ->get();
        
        
        $tr = new GoogleTranslate('ko');
        $tr->setSource('zh-cn');
        $tr->setTarget('ko');
        $title = "판매준비검토";
        
        if ($request->ajax()) {
            $products = Product::where('bIsDel', 0)
                ->where('nUserId', Auth::id())
                ->where('nProductWorkProcess', 0)
                ->orderBy('nIdx');
            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('check', function($row){
                    $element = '<input type="checkbox" name="chkProduct[]" onclick="" value="'.$row->nIdx.'">';
                    $shareTag = $row->nShareType != 2 ? '<span class="badge badge-danger">비공개</span>': '';
                    $element .= '<li class="font-weight-light list-inline-item">'.$shareTag.'</li><br>';
                    return $element;
                })
                ->addColumn('action', function($row){
                    //$btn = '<button type="button" data-id="'.$row->nIdx.'" style="font-size:10px !important;" class="btn btn-xs btn-primary btnSellPrepare">디자인검토</button>';
                    $btn = '<button type="button" data-id="'.$row->nIdx.'" style="font-size:10px !important;" class="btn btn-xs btn-primary btnEditProduct mt-1">상품  수정</button>';
                    $btn .= '<button type="button" data-id="'.$row->nIdx.'" style="font-size:10px !important;" class="btn btn-xs btn-primary btnViewDetail mt-1">상품  상세</button>';
                    $btn .= '<button type="button" data-id="'.$row->nIdx.'" style="font-size:10px !important;" class="btn btn-xs btn-danger btnDelProduct mt-1">상품  삭제</button>';
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
                    $element = '<ul class="list-inline">';
                    $element .= '<li class="list-inline-item">
                            '.$category.'
                        </li><br>';
                    $element .= '<li class="list-inline-item" style="font-size: 14px;">
                            '.$row->strKrSubName.'
                        </li><br>';
                    $element .= '<li class="list-inline-item" style="font-size: 14px;">
                        '.$row->strKrMainName.'
                    </li><br>';
                    $element .= '<li class="list-inline-item">
                            '.$row->strChSubName.'
                        </li><br>';
                    // //옵션
                    // $options = explode("|", $row->strOption);
                    // $optionValue = explode("|", $row->strOptionValue);
                    // foreach ($options as $key => $value) {
                    //     $element .= '<li class="list-inline-item">
                    //         <span style="text-align:left;">'.$value.':</span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="text-align:right;">'.$optionValue[$key].'</span>
                    //     </li><br>';
                    // }
                    // $element .= '<li class="list-inline-item">
                    //         '.$row->strKrMainName.'
                    //     </li><br>';
                    $element .= '<li class="font-weight-light list-inline-item">
                            '.Auth::user()->name.'['.$row->created_at.']&nbsp;&nbsp;<span class="bg-warning">'.$row->strSolutionId.'</span>
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
                ->addColumn('marginInfo', function($row) use ($request){
                    
                    $element = '<ul class="list-inline" style="width:100px;">';
                    $element .= '<li class="list-inline-item">
                            '.$row->productDetail->nMarginRate.'
                        </li><br>';
                    $element .= '<li class="list-inline-item">
                        '.$row->productDetail->nSellerMarketChargeRate.'%
                    </li><br>';
                      
                    $element .= '</ul>';
                    return $element;
                })
                ->addColumn('optionInfo', function($row) use ($request){
                    $arrKoTemp = explode("§", $row->strKoOptionValue);
                    $element = '<ul class="list-inline">';
                    foreach ($arrKoTemp as $key => $value) {
                        $element .= '<li>
                            '.$value.'
                        </li>';
                    }
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
                    //$btn = '<img alt="Avatar" style="width: 5rem;" class="table-product-image" src="'.$main->strURL.'">';
                    $mainImage = '<li class="list-inline-item" >
                                    <a href="'.$row->strURL.'" target="_blank">
                                        <span data="'.$main->strURL.'" class="preview">
                                            <img alt="gallery thumbnail" style="width: 5rem;" src="'.$main->strURL.'">
                                        </span>
                                    </a>
                                </li>';
                    return $mainImage;
                })
                ->rawColumns(['check', 'productInfo', 'mainImage', 'marketInfo', 'priceInfo', 'marginInfo', 'optionInfo', 'action'])
                ->filter(function($query) use ($request){
                    $query->where(function($query1) use ($request){
                            $dates = explode(' ~ ', $request->get('daterange'));
                            $endDate = date('Y-m-d H:i:s', strtotime($dates[1] . ' +1 day'));
                            $query1->whereBetween('created_at', [$dates[0], $endDate]);
                            
                        })
                        ->when($request->get('selMarket') != "", function($query2) use ($request) {
                            $cond = $request->get('selMarket');
                            switch ($cond) {
                                case '11thhouse':
                                    $query2->where('bReg11thhouse', 1);
                                    break;
                                case 'auction':
                                    $query2->where('bRegAuction', 1);
                                    break;
                                case 'coupang':
                                    $query2->where('bRegCoupang', 1);
                                    break;
                                case 'gmarket':
                                    $query2->where('bRegGmarket', 1);
                                    break;
                                case 'interpark':
                                    $query2->where('bRegInterpark', 1);
                                    break;
                                case 'lotteon':
                                    $query2->where('bRegLotteon', 1);
                                    break;
                                case 'tmon':
                                    $query2->where('bRegTmon', 1);
                                    break;
                                case 'wemakeprice':
                                    $query2->where('bRegWemakeprice', 1);
                                    break;
                                default:
                                    break;
                            }
                        })
                        ->when($request->get('searchWord') != "", function($query2) use ($request) {
                            $cond = $request->get('searchWord');
                            $query2->where('strChSubName', 'like', '%'.$cond.'%')
                                ->orWhere('strKrSubName', 'like', '%'.$cond.'%')
                                ->orWhere('strKoOption', 'like', '%'.$cond.'%')
                                ->orWhere('strKoOptionValue', 'like', '%'.$cond.'%')
                                ->orWhere('strCnOption', 'like', '%'.$cond.'%')
                                ->orWhere('strCnOptionValue', 'like', '%'.$cond.'%')
                                ->orWhere('strCategoryCode0', 'like', '%'.$cond.'%');
                                
                        })
                        ->when($request->get('rdoMarketRegProduct') >= 0, function($query2) use ($request) {
                            $cond = $request->get('rdoMarketRegProduct');
                                if($cond == 1) {
                                    $query2->where('bRegCoupang', $cond)
                                        ->orWhere('bReg11thhouse', $cond)
                                        ->orWhere('bRegAuction', $cond)
                                        ->orWhere('bRegGmarket', $cond)
                                        ->orWhere('bRegInterpark', $cond)
                                        ->orWhere('bRegLotteon', $cond)
                                        ->orWhere('bRegSmartstore', $cond)
                                        ->orWhere('bRegTmon', $cond)
                                        ->orWhere('bRegWemakeprice', $cond);
                                } else {
                                    $query2->where('bReg11thhouse', $cond)
                                        ->where('bRegAuction', $cond)
                                        ->where('bRegCoupang', $cond)
                                        ->where('bRegGmarket', $cond)
                                        ->where('bRegInterpark', $cond)
                                        ->where('bRegLotteon', $cond)
                                        ->where('bRegSmartstore', $cond)
                                        ->where('bRegTmon', $cond)
                                        ->where('bRegWemakeprice', $cond);
                                }
                        });
                })
                ->make(true);
        }
        return view('scratch.SellPrepareCheck', compact('title', 'markets', 'marketAccounts'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editProduct($productId = 0, $editType = 0)
    {
        
        $product = null;
        if($editType == 0){
            $product = Product::where('bIsDel', 0)
                ->where('nIdx', $productId)
                ->first();
        }else if($editType == 1 || $editType == 2){//등록상품이거나 판매중지상품
            $product = SuccessProduct::where('bIsDel', 0)
            ->where('nIdx', $productId)
            ->first();
        }else if($editType == 3){//등록실패상품
            $product = FailedProduct::where('bIsDel', 0)
            ->where('nIdx', $productId)
            ->first();
        }

        $product->productMainImage = $product->productImages->where('nImageCode',0)->first() == null ? new SuccessProductImage() : $product->productImages->where('nImageCode',0)->first();
        $product->productSubImage1 = $product->productImages->where('nImageCode',1)->first() == null ? new SuccessProductImage() : $product->productImages->where('nImageCode',1)->first();
        $product->productSubImage2 = $product->productImages->where('nImageCode',2)->first() == null ? new SuccessProductImage() : $product->productImages->where('nImageCode',2)->first();
        
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
        return view('scratch.ProductDetail', compact('product', 'editType', 'koOptions', 'arrKoOption', 'cnOptions', 'arrCnOption', 'arrOptionPrice', 'arrOptionImage'));

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function detailProduct($productId = 0)
    {
        $product = Product::where('bIsDel', 0)
            ->where('nIdx', $productId)
            ->first();
        return view('scratch.ProductDescription', compact('product'));

    }

    /**
     * 상품수정
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update($productId, Request $request)
    {

        //$val = $request->post('txtChMainName');
        $editType = $request->post('txtEditType');
        
        //옵션명
        $arrKoOptName = $request->post('txtOptionAttr');
        $strKoOption = implode("§", $arrKoOptName);
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
        
        $product = null;
        if($editType == 0){
            $product = Product::where('nIdx', $productId)->first();
        }else if($editType == 1 || $editType == 2){//등록상품 이거나 판매중지상품
            $product = SuccessProduct::where('nIdx', $productId)->first();
        }else if($editType == 3){//등록실패상품
            $product = FailedProduct::where('nIdx', $productId)->first();
        }
        //$product = Product::where('nIdx', $productId)->first();

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
            // 'nProductWorkProcess' => 0,//stopped product
            'bIsDel'=> 0
        ]);
        //$product->save();

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
        
        //$product->productItems->delete();
        if($editType == 0){
            ProductItem::where('nProductIdx',$product->nIdx)->delete();
        }else if($editType == 1 || $editType == 2){//등록상품 이거나 판매중지상품
            SuccessProductItem::where('nProductIdx',$product->nIdx)->delete();
        }else if($editType == 3){//등록실패상품
            FailedProductItem::where('nProductIdx',$product->nIdx)->delete();
        }
        
        for ($i=0; $i < $countItem; $i++) { 
            $productItem = null;
            if($editType == 0){
                //ProductItem::where('nProductIdx',$product->nIdx)->delete();
                $productItem = new ProductItem([
                    'nProductIdx' => $product->nIdx,
                    'nSubItemOptionPrice' => $sku_option_price[$i],
                    'nSubItemBasePrice' => $sku_base_price[$i],
                    'nSubItemSellPrice' => $sku_sell_price[$i],
                    'nSubItemDiscountPrice' => $sku_discount_price[$i],
                    'nSubItemQuantity' => $sku_stock[$i],
                    'strSubItemImage' => $sku_image[$i],
                    'bIsDel' => 0
                ]);
            }else if($editType == 1 || $editType == 2){//등록상품 이거나 판매중지상품
                //SuccessProductItem::where('nProductIdx',$product->nIdx)->delete();
                $productItem = new SuccessProductItem([
                    'nProductIdx' => $product->nIdx,
                    'nSubItemOptionPrice' => $sku_option_price[$i],
                    'nSubItemBasePrice' => $sku_base_price[$i],
                    'nSubItemSellPrice' => $sku_sell_price[$i],
                    'nSubItemDiscountPrice' => $sku_discount_price[$i],
                    'nSubItemQuantity' => $sku_stock[$i],
                    'strSubItemImage' => $sku_image[$i],
                    'bIsDel' => 0
                ]);
            }else if($editType == 3){//등록실패상품
                //FailedProductItem::where('nProductIdx',$product->nIdx)->delete();
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
            }
            
            $subItemName = "";
            for ($j=0; $j < $cntOptionName; $j++) {
                $productItem['strSubItemKoOptionPattern'.$j] = $arrOptionAttr[$j][$i];
                $subItemName .= $arrOptionAttr[$j][$i]." ";
            }
            $productItem['strSubItemName'] = $subItemName;
            $productItem->save();
        }
        
        
        if($editType == 0){
            ProductImage::where('nProductIdx',$product->nIdx)->delete();
        }else if($editType == 1 || $editType == 2){//등록상품 이거나 판매중지상품
            SuccessProductImage::where('nProductIdx',$product->nIdx)->delete();
        }else if($editType == 3){//등록실패상품
            FailedProductImage::where('nProductIdx',$product->nIdx)->delete();
        }
        $arrImage = $request->post('imgLink');
        $countImage = count($request->post('imgLink'));
        for ($i=0; $i < $countImage; $i++) { 
            if($arrImage[$i] != ""){
                $fileLink = "";
                if(substr($arrImage[$i], 0, 10) == "data:image"){
                    $base64Data = $arrImage[$i];

                    $extension = explode('/', explode(':', substr($base64Data, 0, strpos($base64Data, ';')))[1])[1];   // .jpg .png .pdf
                    $replace = substr($base64Data, 0, strpos($base64Data, ',')+1); 
                    $image = str_replace($replace, '', $base64Data); 
                    $image = str_replace(' ', '+', $image); 
                    $date = new DateTime('now');
                    $path = 'uploads/users/'.Auth::id().'/document_images/' . $date->format('YmdHisv') . '.' . $extension;
                    Storage::disk('public')->put($path, base64_decode($image));
                    $fileLink = asset('storage/'.$path);
                }else{
                    $fileLink = $arrImage[$i];
                }

                $productImage = null;
                if($editType == 0){
                    $productImage = new ProductImage([
                        'nProductIdx' => $product->nIdx,
                        'nImageCode' => $i,
                        'strName' => '',
                        'strURL' => $fileLink,
                        'nHeight' => 0,
                        'nWidth' => 0,
                        'strNote' => '',
                        'bIsDel' => 0
                    ]);
                }else if($editType == 1 || $editType == 2){//등록상품 이거나 판매중지상품
                    $productImage = new SuccessProductImage([
                        'nProductIdx' => $product->nIdx,
                        'nImageCode' => $i,
                        'strName' => '',
                        'strURL' => $fileLink,
                        'nHeight' => 0,
                        'nWidth' => 0,
                        'strNote' => '',
                        'bIsDel' => 0
                    ]);
                }else if($editType == 3){//등록실패상품
                    $productImage = new FailedProductImage([
                        'nProductIdx' => $product->nIdx,
                        'nImageCode' => $i,
                        'strName' => '',
                        'strURL' => $fileLink,
                        'nHeight' => 0,
                        'nWidth' => 0,
                        'strNote' => '',
                        'bIsDel' => 0
                    ]);
                }
                
                $productImage->save();
            }
        }

        $data = '<script>alert("수정이 완료되었습니다.");window.opener.location.reload();window.close();</script>';
        return view('test', compact('data'));
    }
    
    public function updateDescription($productId, Request $request)
    {
        $product = Product::where('nIdx', $productId)->first();

        $product->productDetail->update([
            'blobNote' => $request->post('summernote'),
        ]);
    }
    //상품등록을 위한 마켓계정 리스트(get)
    //쇼핑몰 아이디 선택
    public function marketAccountList(Request $request)
    {
        $products = $request->get('products');
        // $marketAccounts = MarketAccount::where('nUserId', Auth::id())
        //                                 ->get();
        $settings = MarketSetting::where('nUserId', Auth::id())
                                        ->where('bIsDel', 0)
                                        ->get();

        return view('scratch.MarketAccountList', compact('settings', 'products'));
    }

    //상품등록을 위한 마켓계정 선택(post)
    //상품등록정보
    public function registProduct(Request $request)
    {
        $chkAccount = $request->post('chkAccount');
        $strProduct = $request->post('products');
        $settings = MarketSetting::where('nUserId', Auth::id())
                                        ->whereIn('nIdx', $chkAccount)
                                        ->get();
        
        $markets = Market::where('strMarketCode', 'coupang');
        
        $productIds = explode("|", $strProduct);
        $products = Product::where('bIsDel', 0)
            ->where('nUserId', Auth::id())
            ->where('nProductWorkProcess', 0)
            ->whereIn('nIdx', $productIds)
            ->orderBy('nIdx')
            ->get();

        $productsCount = count($products);
        
        $uploadResults = array(); 
        foreach ($settings as $setting) {
            $settingResult = array();
            $settingResult['marketAccount'] = $setting->marketAccount->strAccountId;
            $settingResult['allProduct'] = $productsCount;
            $settingResult['successProduct'] = 0;
            $settingResult['failedProduct'] = 0;
            if($setting->nMarketIdx == 33){//쿠팡
                $settingResult['marketName'] = "쿠팡";
                
                $coupang = new CoupangConnector($setting->marketAccount->strAPIAccessKey, $setting->marketAccount->strSecretKey, $setting->marketAccount->strVendorId, $setting->marketAccount->strAccountId);
                foreach ($products as $key2 => $product) {

                    // //만약 상품이 쿠팡에 이미 등록되였다면 넘긴다
                    // if($product->bRegCoupang == 1)
                    //   continue;
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
                        "outboundShippingTimeDay"=> $setting->detail->nOutboundShippingTimeDay,
                        "maximumBuyForPersonPeriod"=> $setting->detail->nMaxQtyPerManDayLimit,
                        "unitCount"=> 0,//$item->nSubItemQuantity > 0 ? $item->nSubItemQuantity : $setting->detail->nUnitQuantity,
                        "adultOnly"=> $setting->detail->bOnlyAdult == 0 ? "EVERYONE" : "AUDLT_ONLY",
                        "taxType"=> "TAX",
                        "parallelImported"=> $setting->detail->bParallelImport == 1 ? "PARALLEL_IMPORTED" : "NOT_PARALLEL_IMPORTED",
                        "overseasPurchased"=> $setting->detail->bOverSeaPurchaseAgent == 1 ? "OVERSEAS_PURCHASED" :"NOT_OVERSEAS_PURCHASED",
                        "pccNeeded"=> $setting->detail->nPersonPassingCodeType == 1 ? "true" : "false",
                        "externalVendorSku"=> "0001",
                        "barcode"=> "",
                        "emptyBarcode"=> true,
                        "emptyBarcodeReason"=> "상품확인불가_바코드없음사유",
                        "modelNo"=> "1717171",
                        "extraProperties"=> null,
                        //"certifications"=> $certifications,
                        "searchTags"=> array("키워드1", "키워드2"),
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
                    "deliveryMethod" => $setting->detail->deliveryType->strDeliveryCode,
                    "deliveryCompanyCode" => $setting->detail->strDeliveryCompanyCode,
                    "deliveryChargeType" => $setting->detail->strDeliveryChargeType,
                    "deliveryCharge" => $setting->detail->nDeliveryCharge,
                    "freeShipOverAmount" => $setting->detail->nFreeShipOverAmount,
                    "deliveryChargeOnReturn" => $setting->detail->nDeliveryChargeOnReturn,
                    "remoteAreaDeliverable" => $setting->detail->nRemoteAreaDeliveryType == 1 ? "Y" : "N",
                    "unionDeliveryType" => $setting->detail->strUnionDeliveryType,
                    "returnCenterCode" => $setting->detail->strReturnCenterCode,
                    "returnChargeName" => $setting->detail->strReturnSellerName,
                    "companyContactNumber" => $setting->detail->strCompanyContactNumber,
                    "returnZipCode" => $setting->detail->strReturnZipCode,
                    "returnAddress" => $setting->detail->strReturnAddress,
                    "returnAddressDetail" => $setting->detail->strReturnAddressDetail,
                    "returnCharge" => $setting->detail->nReturnDeliveryCharge,
                    //"returnChargeVendor" => $setting->detail->strReturnChargeVendorType,
                    //"afterServiceInformation" => $setting->detail->strAfterServiceGuide,
                    //"afterServiceContactNumber" => $setting->detail->strAfterServiceContactNumber,
                    "outboundShippingPlaceCode" => $setting->detail->strOutboundShippingPlaceCode,
                    "vendorUserId" => $setting->marketAccount->strAccountId,
                    "requested" => true,
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
                    //print_r($objProduct);
                    $result = $coupang->addProduct(json_encode($objProduct));
                    $response = (object)json_decode($result, true);
                    if($response->code=="SUCCESS")
                    {
                        $settingResult['successProduct']++;
                        $product->update(['bRegCoupang' => 1]);
                        //상품등록 성공으로 추가
                        $uploadedProdId = "C:".$response->data;
                        $this->procSuccessUpload($product, $setting, $start, $end, $uploadedProdId);
                    }else{
                        $settingResult['failedProduct']++;
                        $failedProdId = "C:FAILED";
                        $this->procFailedUpload($product, $setting, $response->message, $failedProdId);
                        
                    }
                }
            }else if($setting->nMarketIdx == 31){//11번가
                $settingResult['marketName'] = "11번가";
                $_11thhouse = new EleventhConnector($setting->marketAccount->strAPIAccessKey, $setting->marketAccount->strAccountId, $setting->marketAccount->strAccountPwd);
                foreach ($products as $key2 => $product) {
                    $strCategory = $product->strCategoryCode3;
                    $arrCategory = mb_split(" : ", $strCategory);
                    $strCategoryCode = $arrCategory[0];
{/** */
                    $data= new SimpleXMLElement('<?xml version="1.0" encoding="euc-kr" ?><Product/>');
                    // $data->addChild('abrdBuyPlace', "A");
                    // $data->addChild('abrdSizetableDispYn', "Y");
                    $data->addChild('selMnbdNckNm', $setting->detail->strSelMnbdNckNm);
                    $data->addChild('selMthdCd', $setting->detail->strSelMthdCd);
                    $data->addChild('dispCtgrNo', $strCategoryCode);
                    $data->addChild('prdTypCd', $setting->detail->strPrdTypCd);
                    //$data->addChild('hsCode', "1233");
                    $data->addChild('prdNm', "<![CDATA[".$product->strKrMainName."]]>");
                    //$data->addChild('prdNmEng', "asdf");
                    $data->addChild('advrtStmt', "<![CDATA[".$setting->detail->strAdvrtStmt."]]>");
                    $data->addChild('brand', "&#39;알수없음&#39;");
                    //$data->addChild('apiPrdAttrBrandCd', "asdf");
                    $data->addChild('rmaterialTypCd', "05");
                    $data->addChild('orgnTypCd', "03");
                    //$data->addChild('orgnTypDtlsCd', "");
                    $data->addChild('orgnNmVal', "중국");
                    // $ProductRmaterial = $data->addChild('ProductRmaterial');
                    //     $ProductRmaterial->addChild('rmaterialNm', 'asdf');
                    //     $ProductRmaterial->addChild('ingredNm', 'asdf');
                    //     $ProductRmaterial->addChild('orgnCountry', 'asdf');
                    //     $ProductRmaterial->addChild('content', 'asdf');
                    $data->addChild('beefTraceStat', "03");
                    //$data->addChild('beefTraceNo', "03");
                    $data->addChild('sellerPrdCd', $product->strSolutionId);
                    $data->addChild('suplDtyfrPrdClfCd', $setting->detail->strSuplDtyfrPrdClfCd);
                    $data->addChild('yearEndTaxYn', "N");
                    $data->addChild('forAbrdBuyClf', $setting->detail->strForAbrdBuyClf);
                    $data->addChild('importFeeCd', "03");
                    $data->addChild('prdStatCd', $setting->detail->strPrdStatCd);
                    if($setting->detail->strSelMthdCd == "05"){
                        $data->addChild('useMon', "99999");
                        $data->addChild('paidSelPrc', "5000");
                        $data->addChild('exteriorSpecialNote', "<![CDATA[중고판매]]>");
                    }
                    $data->addChild('minorSelCnYn', "Y");//미성년자 구매 가능
                    $data->addChild('prdImage01', $product->productMainImage[0]->strURL);
                    // $data->addChild('prdImage02', "https://img.alicdn.com/imgextra/i2/2207918533633/O1CN01HoIFGY1chxVxNh2lN_!!2207918533633.jpg");
                    // $data->addChild('prdImage03', "https://img.alicdn.com/imgextra/i2/2207918533633/O1CN01HoIFGY1chxVxNh2lN_!!2207918533633.jpg");
                    // $data->addChild('prdImage04', "https://img.alicdn.com/imgextra/i2/2207918533633/O1CN01HoIFGY1chxVxNh2lN_!!2207918533633.jpg");
                    // $data->addChild('prdImage05', "https://img.alicdn.com/imgextra/i2/2207918533633/O1CN01HoIFGY1chxVxNh2lN_!!2207918533633.jpg");
                    // $data->addChild('prdImage09', "https://img.alicdn.com/imgextra/i2/2207918533633/O1CN01HoIFGY1chxVxNh2lN_!!2207918533633.jpg");
                    $data->addChild('htmlDetail', "<![CDATA[".$product->productDetail->blobNote."]]>");
                    $ProductCertGroup = $data->addChild('ProductCertGroup');
                        $ProductCertGroup->addChild('crtfGrpTypCd', '');
                        $ProductCertGroup->addChild('crtfGrpObjClfCd', '03');
                        $ProductCertGroup->addChild('crtfGrpExptTypCd', '03');
                        $ProductCert = $ProductCertGroup->addChild('ProductCert');
                            $ProductCert->addChild('certTypeCd', '134');
                            $ProductCert->addChild('certTypeCd', '13411');
                    // $ProductMedical = $data->addChild('ProductMedical');
                    //     $ProductMedical->addChild('MedicalKey', '01');
                    //     $ProductMedical->addChild('MedicalRetail', '01');
                    //     $ProductMedical->addChild('MedicalAd', '01');
                    // $data->addChild('reviewDispYn', "Y");
                    // $data->addChild('reviewOptDispYn', "Y");
                    // $data->addChild('selPrdClfCd', "0:100");
                    $data->addChild('aplBgnDy', date_format(date_create($setting->detail->dtAplBgnDy),"Y/m/d"));
                    $data->addChild('aplEndDy', date_format(date_create($setting->detail->dtAplEndDy),"Y/m/d"));
                    $data->addChild('setFpSelTermYn', "N");
                    $data->addChild('selTermUseYn', "N");
                    $data->addChild('selPrdClfFpCd', "3y:110");
                    $data->addChild('wrhsPlnDy', "2025/12/31");
                    $data->addChild('contractCd', "01");
                    $data->addChild('chargeCd', "1231111");
                    $data->addChild('periodCd', "01");
                    $data->addChild('phonePrc', "60000");
                    $data->addChild('maktPrc', "60000");
                    $data->addChild('selPrc', number_format($product->productDetail->nProductPrice, 0));
                    $data->addChild('cuponcheck', "Y");
                    $data->addChild('dscAmtPercnt', "100");
                    $data->addChild('cupnDscMthdCd', "01");
                    $data->addChild('cupnUseLmtDyYn', "Y");
                    $data->addChild('cupnIssEndDy', "2021/08/06");
                    $data->addChild('pay11YN', "N");
                    $data->addChild('pay11Value', "1000");
                    $data->addChild('pay11WyCd', "01");
                    $data->addChild('intFreeYN', "Y");
                    $data->addChild('intfreeMonClfCd', "05");
                    $data->addChild('pluYN', "Y");
                    $data->addChild('pluDscCd', "01");
                    $data->addChild('pluDscBasis', "1000");
                    $data->addChild('pluDscAmtPercnt', "10");
                    $data->addChild('pluDscMthdCd', "%");
                    $data->addChild('pluUseLmtDyYn', "Y");
                    $data->addChild('pluIssStartDy', "2021/07/08");
                    $data->addChild('pluIssEndDy', "2021/08/08");
                    $data->addChild('hopeShpYn', "Y");
                    $data->addChild('hopeShpPnt', "10");
                    $data->addChild('hopeShpWyCd', "01");
                    $data->addChild('optSelectYn', "Y");
                    $data->addChild('txtColCnt', "1");
                    $data->addChild('optionAllQty', "9999");
                    $data->addChild('optionAllAddPrc', "0");
                    $data->addChild('optionAllAddWght', "200");
                    $data->addChild('prdExposeClfCd', "01");
                    $data->addChild('optMixYn', "Y");
                    $ProductOption = $data->addChild('ProductOption');
                        $ProductOption->addChild('useYn', "Y");
                        $ProductOption->addChild('colOptPrice', "0");
                        $ProductOption->addChild('colValue0', "레드");
                        $ProductOption->addChild('colCount', "100");
                        $ProductOption->addChild('colSellerStockCd', "101001");
                    $ProductRootOption = $data->addChild('ProductRootOption');
                        $ProductRootOption->addChild('colTitle', "색상");
                        $productOption = $ProductRootOption->addChild('ProductOption');
                            $productOption->addChild('colOptPrice', "0");
                            $productOption->addChild('colValue0', "검정색");
                    $ProductOptionExt = $data->addChild('ProductOptionExt');
                        $productOption = $ProductOptionExt->addChild('ProductOption');
                            $productOption->addChild('useYn', "Y");
                            $productOption->addChild('colOptPrice', "0");
                            $productOption->addChild('colOptCount', "10");
                            $productOption->addChild('colCount', "10");
                            $productOption->addChild('optWght', "10");
                            $productOption->addChild('colSellerStockCd', "11110");
                            $productOption->addChild('optionMappingKey', "옵션값2");
                    $ProductCustOption = $data->addChild('ProductCustOption');
                        $ProductCustOption->addChild('colOptName', "색상");
                        $ProductCustOption->addChild('colOptUseYn', "Y");
                    $data->addChild('useOptCalc', "N");
                    $data->addChild('optCalcTranType', "reg");
                    $data->addChild('optTypCd', "계산형옵션값");
                    $data->addChild('gblDlvYn', "N");
                    $data->addChild('dlvCnAreaCd', $setting->detail->strDlvCnAreaCd);
                    $data->addChild('dlvWyCd', $setting->detail->strDlvWyCd);
                    $data->addChild('dlvEtprsCd', $setting->detail->strDlvEtprsCd);
                    $data->addChild('dlvSendCloseTmpltNo', $setting->detail->strDlvSendCloseTmpltNo);
                    $data->addChild('dlvCstInstBasiCd', $setting->detail->strDlvCstInstBasiCd);
                    $data->addChild('dlvCst1', "2500");
                    $data->addChild('dlvCst3', "2500");
                    $data->addChild('dlvCst4', "2500");
                    $data->addChild('dlvCstInfoCd', "01");
                    $data->addChild('PrdFrDlvBasiAmt', "5000");
                    $data->addChild('dlvCnt1', "2");
                    $data->addChild('dlvCnt2', "2");
                    $data->addChild('bndlDlvCnYn', "N");
                    $data->addChild('dlvCstPayTypCd', "01");
                    $data->addChild('jejuDlvCst', "2500");
                    $data->addChild('islandDlvCst', "2500");
                    $data->addChild('addrSeqOut', $setting->detail->strAddrSeqOutAddr);
                    $data->addChild('outsideYnOut', "N");
                    $data->addChild('visitDlvYn', "N");
                    $data->addChild('visitDlvAddrSeq', "11121");
                    $data->addChild('addrSeqOutMemNo', "123123");
                    $data->addChild('addrSeqIn', $setting->detail->strAddrSeqInAddr);
                    $data->addChild('outsideYnIn', "N");
                    $data->addChild('addrSeqInMemNo', "67417413");
                    $data->addChild('abrdCnDlvCst', "600");
                    $data->addChild('rtngdDlvCst', $setting->detail->nRtngdDlvCst);
                    $data->addChild('exchDlvCst', $setting->detail->nExchDlvCst);
                    $data->addChild('rtngdDlvCd', $setting->detail->strRtngdDlvCd);
                    $data->addChild('asDetail', $setting->detail->strAsDetail);
                    $data->addChild('rtngExchDetail', $setting->detail->strRtngExchDetail);
                    $data->addChild('dlvClf', "02");
                    $data->addChild('abrdInCd', "03");
                    $data->addChild('prdWght', "200");
                    $data->addChild('ntShortNm', "CN");
                    $data->addChild('globalOutAddrSeq', "012311");
                    $data->addChild('mbAddrLocation05', "01");
                    $data->addChild('globalInAddrSeq', "67417413");
                    $data->addChild('mbAddrLocation06', "01");
                    $data->addChild('mnfcDy', "2020/02/02");
                    $data->addChild('eftvDy', "2024/02/02");
                    $data->addChild('eftvDy', "2024/02/02");
                    $ProductNotification = $data->addChild('ProductNotification');
                        $ProductNotification->addChild('type', "qwaqqq");
                        $item = $ProductNotification->addChild('item');
                            $item->addChild('code', "1231111");
                            $item->addChild('name', "qeqqq");
                    $data->addChild('company', "없음");
                    $data->addChild('modelNm', "없음");
                    $data->addChild('modelCd', "SQBAB9401");
                    $data->addChild('mnfcDy', "2020/02/02");
                    $data->addChild('mainTitle', "도서");
                    $data->addChild('artist', "도서");
                    $data->addChild('mudvdLabel', "도서");
                    $data->addChild('maker', "도서");
                    $data->addChild('albumNm', "도서");
                    $data->addChild('bcktExYn', "N");
                    $data->addChild('prcCmpExpYn', "Y");
                    $data->addChild('stdPrdYn', "N");
                    $ProductTag = $data->addChild('ProductTag');
                        $ProductTag->addChild('tagName', "qwaqqq");
}/** */             
                    $data = $data->asXML();
                    $response = $_11thhouse->addProduct($data);
                    if(isset($response[0]['productNo'])){
                        $settingResult['successProduct']++;
                        $start = new DateTime($setting->detail->dtAplBgnDy);
                        $end = new DateTime($setting->detail->dtAplEndDy);
                        $product->update(['bReg11thhouse' => 1]);
                        $uploadedProdId = "11:".$response[0]['productNo'];
                        $this->procSuccessUpload($product, $setting, $start, $end, $uploadedProdId);
                    }else{
                        $settingResult['failedProduct']++;
                        $failedProdId = "11:FAILED";
                        $this->procFailedUpload($product, $setting, $response[0]['message'], $failedProdId);
                    }
                }
            }else if($setting->nMarketIdx == 3){// ($setting->nMarketIdx == 2 || $setting->nMarketIdx == 4){//esmplus(옥션과 지마켓)
                $snoopy = new Snoopy;
                $snoopy->agent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36";
                //login
                $loginUri = 'https://www.esmplus.com/Member/SignIn/Authenticate';

                $snoopy->httpmethod = "POST";
                //$auth['id'] = $setting->marketAccount->strAccountId;
                $auth['Id'] = "songfh0502";
                //$auth['password'] = $setting->marketAccount->strAccountPwd;
                $auth['Password'] = "Putongba159!@";
                $auth['ReturnUrl'] = "/Home/Home";
                $auth['RememberMe'] = "false";
                $snoopy->submit($loginUri, $auth);

                $snoopy->setcookies();	//로그인에 쿠키를 사용하는 경우가 있으니 쿠키정보를 저장
                $snoopy->results;
                $loginResult = json_decode($snoopy->results);
                //print_r($loginResult);
                $settingResult['marketName'] = "11번가";
                $settingResult['failedProduct']++;
                $settingResult['successProduct']++;
                //$report_data = array();
            }else if($setting->nMarketIdx == 5){//인터파크

            }else if($setting->nMarketIdx == 6){//롯데온

            }else if($setting->nMarketIdx == 7){//스마트스토어

            }else if($setting->nMarketIdx == 8){//위메프

            }
            $uploadResults[] = $settingResult;
        }
        //return view('scratch.ProductRegistResult', compact('uploadResults'));
        //return view('product.MarketProductPrepare', compact('settingCoupangs', 'markets'));
    }

    public function procSuccessUpload($product, $setting, $start, $end, $uploadedProdId)
    {
        // $product = Product::where('bIsDel', 0)
        //     ->where('nUserId', Auth::id())
        //     ->where('nIdx', $productId)
        //     ->orderBy('nIdx')
        //     ->first();
        
        $product->update(['bRegCoupang' => 1]);
        //상품등록 성공으로 추가
        $successProduct = new SuccessProduct([
            'nUserId' => Auth::id(),
            'nMarketSetIdx' => $setting->nIdx,
            'strMarketAccId' => $setting->marketAccount->strAccountId,
            'strId' => $uploadedProdId,
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
            'bRegCoupang' => 1,
            'dtSellStartDate' => $start->format('Y-m-d'),
            'dtSellEndDate' => $end->format('Y-m-d'),
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
    }

    public function procFailedUpload($product, $setting, $reason, $failedProdId)
    {
        $failedProduct = new FailedProduct([
            'nUserId' => Auth::id(),
            'strSolutionId' => $product->strSolutionId,
            'nMarketSetIdx' => $setting->nIdx,
            'strMarketAccId' => $setting->marketAccount->strAccountId,
            'strId' => $failedProdId,
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
            'strReason' =>  $reason,
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
            $productItem = new FailedProductItem([
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
            $productItem->save();
        }
    }
    
    public function delete($productId)
    {
        $product = Product::find($productId);
        $product->delete();
        ProductDetail::find($productId)->delete();
        ProductItem::where('nProductIdx', $productId)->delete();
        ProductImage::where('nProductIdx', $productId)->delete();
        return response()->json(["status" => "success", "data" => "Successfully removed!"]);
    }
}
