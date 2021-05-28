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
use App\Models\Market;
use App\Models\MarketAccount;
use App\Models\SuccessProduct;
use App\Models\SuccessProductDetail;
use App\Models\SuccessProductImage;
use App\Models\SuccessProductItem;
use App\MyLibs\CoupangConnector;
use Yajra\DataTables\Facades\DataTables as DataTables;

class StoppedProductManageController extends Controller
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
        $markets = Market::where('bIsDel', 0)
                ->get();
        $marketAccounts = MarketAccount::where('bIsDel', 0)
                ->where('nUserId', Auth::id())
                ->get();
        $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default
        $title = "판매중지상품관리";
        

        if ($request->ajax()) {
            $products = SuccessProduct::where('bIsDel', 0)
                ->where('nUserId', Auth::id())
                ->where('nProductWorkProcess', 2);
                //->orderBy('nIdx');

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
                        //옵션
                        $options = explode("§", $row->strKoOption);
                        $optionValue = explode("§", $row->strKoOptionValue);
                        foreach ($options as $key => $value) {
                            $element .= '<li class="list-inline-item">
                                <span style="text-align:left;">'.$value.':</span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="text-align:right;">'.$optionValue[$key].'</span>
                            </li><br>';
                        }
                        $element .= '<li class="list-inline-item">
                                '.$row->strKrMainName.'
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
                                '.$row->productDetail->nProductPrice.'
                            </li>';
                        $element .= '</ul>';
                        return $element;
                    })
                    ->addColumn('acceptPriceInfo', function($row){
                        $marginPrice = number_format(($row->productDetail->nProductPrice) * $row->productDetail->nMarginRate / 100, 2, '', '');
                        $element = '<ul class="list-inline" style="width:100px;">';
                        $element .= '<li class="list-inline-item">
                                '.$marginPrice.'
                            </li><br>';
                        $element .= '<li class="list-inline-item">
                                '.$row->productDetail->nMarginRate.'%
                            </li><br>';
                        $element .= '</ul>';
                        return $element;
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
                    ->addColumn('marginInfo', function($row){
                        $element = '<ul class="list-inline" style="width:100px;">';
                        $element .= '<li class="list-inline-item">
                                '.$row->productDetail->nMarginRate.'%
                            </li><br>';
                        $element .= '<li class="list-inline-item">
                                '.$row->productDetail->nSellerMarketChargeRate.'%
                            </li><br>';
                        $element .= '</ul>';
                        return $element;
                    })
                    ->addColumn('dateInfo', function($row){
                        $element = '<ul class="list-inline" style="width:100px;">';
                        $element .= '<li class="list-inline-item">
                                '.$row->productDetail->created_at.'
                            </li><br>';
                        $element .= '<li class="list-inline-item">
                            '.$row->productDetail->created_at.'-'.$row->productDetail->updated_at.'
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
                        $marketInfo .= '<li class="list-inline-item">
                            '.$row->productMarketSetting->marketAccount->strAccountId.'
                            </li></ul>';
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
                    ->rawColumns(['check', 'productInfo', 'mainImage', 'marketInfo', 'codeInfo', 'priceInfo', 'acceptPriceInfo', 'marginInfo', 'dateInfo'])
                    ->make(true);
                    
        }
        return view('product.StoppedProductManage', compact('title', 'markets', 'marketAccounts'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($productId = 0)
    {
        $product = SuccessProduct::where('bIsDel', 0)
            ->where('nIdx', $productId)
            ->first();
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
        return view('product.StoppedProductDetail', compact('product', 'koOptions', 'arrKoOption', 'cnOptions', 'arrCnOption', 'arrOptionPrice', 'arrOptionImage'));

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
        $product = SuccessProduct::where('nIdx', $productId)->first();

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
        
        SuccessProductItem::where('nProductIdx',$product->nIdx)->delete();
        for ($i=0; $i < $countItem; $i++) { 

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
            $subItemName = "";
            for ($j=0; $j < $cntOptionName; $j++) {
                $productItem['strSubItemKoOptionPattern'.$j] = $arrOptionAttr[$j][$i];
                $subItemName .= $arrOptionAttr[$j][$i]." ";
            }
            $productItem['strSubItemName'] = $subItemName;
            $productItem->save();
        }
        
        SuccessProductImage::where('nProductIdx',$product->nIdx)->delete();
        $countImage = count($request->post('txtImage'));
        $arrDetailImage = $request->post('txtImage');
        //print_r($arrDetailImage);
        for ($i=0; $i < $countImage; $i++) { 
            $arrImgData = explode('::', $arrDetailImage[$i]);
            $productImage = new SuccessProductImage([
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

    

    public function saveSellInfo($productId, Request $request)
    {
        $stopReason = $request->post('txtStopReason');
        $product = SuccessProduct::where('nIdx', $productId)->first();
        $product->update(['nProductWorkProcess' => 1]);//판매상태로 이행
        $productDetail = $product->productDetail->update([
            'strStopReason' => "",
            'strFileURL0' => "",
            'strFileURL1' => "",
            'strFileURL2' => ""
        ]);
        
        return response()->json(["status" => "success", "data" => $productDetail]);
        //return view('product.MarketAccountList', compact('marketAccounts'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function marketProductAdd(Request $request)
    {
        $marketAccounts = MarketAccount::where('nUserId', Auth::id())
                                        ->get();
        //dd($marketAccounts);
        $chkProduct = $request->post('chkProduct');

        if($request->has('select_all')){
            $request->session()->put('post_product_select_all', '1');
        }else{
            $request->session()->put('post_product_select_all', '0');
            $request->session()->push('post_products', $chkProduct);
        }
        //return view('product.MarketAccountList', compact('marketAccounts'));
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
            $request->session()->put('post_marketId_select_all', '1');
        }else{
            $request->session()->put('post_marketId_select_all', '0');
            $request->session()->push('post_marketIds', $chkAccount);
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
        
        return view('product.MarketCategorySearch', compact('marketCode', 'categories_1'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function add(Request $request)
    {
        $product  = Product::where('nIdx', 1)->first();
        $coupang = new CoupangConnector();
        $coupang->getCategoryMetaInfo(0);
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
        $product  = Product::where('nIdx', 1)->first();
        $coupang = new CoupangConnector();
        $coupang->getCategoryMetaInfo(56174);
        $coupang->addProduct();
    }
    /**
     * Display the specified resource.
     *
     */
    public function accountShow($marketId = 0, $accountId = 0)
    {
        //
         $marketAccount  = MarketAccount::where('nIdx', $accountId)->first();
        return response()->json(["status" => "success", "data" => $marketAccount]);
    }


}
