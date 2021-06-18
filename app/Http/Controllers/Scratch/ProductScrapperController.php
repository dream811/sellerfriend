<?php

namespace App\Http\Controllers\Scratch;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\ProductImage;
use App\Models\ProductDetail;
use App\Models\Come;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Category11thGlobal;
use App\Models\Category11thNormal;
use App\Models\CategoryAuction;
use App\Models\CategoryCoupang;
use App\Models\CategoryGmarket;
use App\Models\CategoryInterPark;
use App\Models\CategorySmartStore;
use App\Models\CategorySolution;
use App\Models\CategoryWeMakePrice;
use App\Models\DocumentImage;
use App\Models\WeightType;
use App\Models\MoneyType;
use App\Models\ProductOption;
use App\Mylibs\ScrapperAPI;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Storage;
use Laravel\Ui\Presets\React;
use Stringable;

class ProductScrapperController extends Controller
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
    public function index()
    {
        // $tr = new GoogleTranslate('ko');
        // $tr->setSource('zh-cn');
        // $tr->setTarget('ko');
        // $strChMainName = '秋冬加厚职业套装2020新款毛呢大衣中长款套裙工作服工装妮子外套';
        // $strKrMainName = $tr->translate($strChMainName);
        $title = "상품스크랩";
        return view('scratch.ProductScrapper', compact('title'));
    }
    /**
     * 상품수집
     */
    public function scratch(Request $request)
    {
        //스크래핑시간이 오래므로 400초정도 여유를 준다.
        set_time_limit(400);
        $scrapURL = $request->get('scrapURL');
        //url로부터 id 추츨
        $url_components = parse_url($scrapURL);
        $api = new ScrapperAPI("tel18563102241", "20210422", "1688", "item_get");
        
        $result ="";
        if(str_contains($scrapURL, "tmall")){
            parse_str($url_components['query'], $params);
            $itemId = $params['id'];
            $result = $api->getCategoryMetaInfo("taobao", $itemId);
        }else if(str_contains($scrapURL, "taobao")){
            parse_str($url_components['query'], $params);
            $itemId = $params['id'];
            $result = $api->getCategoryMetaInfo("taobao", $itemId);
        }else if(str_contains($scrapURL, "vvic")){
            $itemId = str_replace('/item/', '' ,$url_components['path']);
            $result = $api->getCategoryMetaInfo("vvic", $itemId);
        }else if(str_contains($scrapURL, "1688")){
            $itemId = str_replace('/offer/', '' ,$url_components['path']);
            $itemId = str_replace('.html', '' ,$itemId);
            $result = $api->getCategoryMetaInfo("1688", $itemId);
        }
        

        //상하단 이미지
        $topImage = DocumentImage::where('strImageType', 'TOP')
                    ->where('nUserId', Auth::id())->first();
        
        $downImage = DocumentImage::where('strImageType', 'DOWN')
                    ->where('nUserId', Auth::id())->first();

        $arrResponse = (array)json_decode($result, true);
        
        if (!array_key_exists("item",$arrResponse))
        {
            return response()->json(["status" => "error", "data" => "자료가 존재하지 않습니다" ]);
        }
        
        $tr = new GoogleTranslate('ko');
        $tr->setSource('zh-cn');
        $tr->setTarget('ko');
        //ko title
        $arrResponse['item']['titleKO'] = $tr->translate($arrResponse['item']['title'] == null ? "" : $arrResponse['item']['title']);
        //ko props name
        $str_props_list = implode("|\n", $arrResponse['item']['props_list']);
        $trans_str_props_list = $tr->translate($str_props_list);
        $trans_arr_props_list = explode("|\n", $trans_str_props_list);
        $trans_ko_props_list = array();
        $index = 0;
        foreach ($arrResponse['item']['props_list'] as $key => $value) {
            
            if (array_key_exists($index, $trans_arr_props_list)) {
                $trans_ko_props_list[$key] = $trans_arr_props_list[$index];
            }else{
                $trans_ko_props_list[$key] = $value;
            }
            $index++;
        }
        $arrResponse['item']['props_list_ko'] = $trans_ko_props_list;
        
        // $trans_str_desc = $tr->translate($arrResponse['item']['desc']);
        $topImageURL = $topImage == null ? "" : $topImage->strImageURL;
        $downImageURL = $downImage == null ? "" : $downImage->strImageURL;
        $arrResponse['item']['desc'] = '<image src="'.$topImageURL.'">'.$arrResponse['item']['desc'].'<image src="'.$downImageURL.'">';
        
        return response()->json(["status" => "success", "data" => $arrResponse['item'] ]);
        

    }
    /**
     * Show the application dashboard.
     *
     * 상품보관
     */
    public function save(Request $request)
    {
        //만약 아이템이 없다면 끝낸다
        if(!$request->exists('sku_sell_price'))
            return redirect('scratchProductScrap');
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
        $date = new DateTime('now');
        $tid = "T".$date->format('YmdHisv');
        
        $product = new Product([
            'nUserId' => Auth::id(),
            'strSolutionId' => $tid,
            'strURL' => $request->post('txtScrapURL'), 
            'strMainName' => $request->post('txtKrMainName'), 
            'strSubName' => $request->post('txtKrSubName'),
            'nUserId' => Auth::id(), 
            'nBrandType' => 0, 
            'strBrand' => "",
            'strKeyword' => str_replace(' ', ',', $request->post('txtKrMainName')),
            'strKoOption' => $strKoOption, 
            'strKoOptionValue' => $strKoOptionValue,
            'strCnOption' => $strCnOption, 
            'strCnOptionValue' => $strCnOptionValue,
            'strOptionPrice' => $strOptionPrice,
            'blobOptionImage' => $strOptionImage,
            'strChMainName' =>  $request->post('txtChMainName'), 
            'strKrMainName' =>  $request->post('txtKrMainName'), 
            'strChSubName' =>   $request->post('txtChMainName'), 
            'strKrSubName' =>   $request->post('txtKrSubName'), 
            //'strComeCode' => $request->post('selComeName'), 
            'strCategoryCode0' => $categoryName[0], 
            'strCategoryCode1' => $categoryName[1], 
            'strCategoryCode2' => $categoryName[2], 
            'strCategoryCode3' => $categoryName[3], 
            'strCategoryCode4' => $categoryName[4], 
            'strCategoryCode5' => $categoryName[5], 
            'strCategoryCode6' => $categoryName[6], 
            'strCategoryCode7' => $categoryName[7], 
            'strCategoryCode8' => $categoryName[8], 
            //'strCategoryName' => $request->post('txtCategoryName'), 
            //'nShareType' => $request->post('rdoShareType'),
            'nProductWorkProcess' => 0,
            'bIsDel'=> 0
        ]);
        $product->save();
        //detail data
        $nMarketPrice = $request->post('txtProductPrice');
        $nMarginPercent = $request->post('txtMarginRate');
        
        $productDetail = new ProductDetail([
            'nProductIdx' => $product->nIdx,
            //'strBasePriceType' => $request->post('selBasePriceType'),
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
        $productDetail->save();
        //SKU data
        
        $countItem = count($request->post('sku_sell_price'));
        
        //만일 서브아이템이 10개 이상이라면 최대입력수를 늘인다
        if($countItem > 10)
            ini_set('max_input_vars','10000' );

        
        //옵션명
        $arrOptName = $request->post('txtOptionAttr');
        $arrCnOptName = $request->post('txtCnOptionAttr');
        $cntOptionName = count($arrOptName) > 3 ? 3 : count($arrOptName);
        
        
        //옵션저장

        $sku_base_price = $request->post('sku_discount_price');
        $sku_sell_price = $request->post('sku_sell_price');
        $sku_discount_price = $request->post('sku_discount_price');
        $sku_option_price = $request->post('sku_option_price');
        $sku_stock = $request->post('sku_stock');
        $sku_image = $request->post('sku_image');
        //
        for ($i=0; $i < $countItem; $i++) { 

            $productItem = new ProductItem([
                'nProductIdx' => $product->nIdx,
                // 'nProductOptIdx0' => $product->nIdx,
                // 'nProductOptIdx1' => $product->nIdx,
                // 'nProductOptIdx2' => $product->nIdx,
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
        if(!Storage::disk('public')->exists('/uploads/users/'.Auth::id().'/document_images')) {
            Storage::disk('public')->makeDirectory('/uploads/users/'.Auth::id().'/document_images', 0775, true); //creates directory
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
                $productImage->save();
            }
        }
        return redirect('scratchSellPrepareCheck');
    }

    public function categoryListSolution()
    {
        return view('scratch.CategorySolutionList');
    }

    public function categorySearch($cateId=0, Request $request)
    {
        $keyword = $request->get('keyword');
        //통합검색
        if($cateId==0){
            $categories = CategorySolution::where('bIsDel', 0)->where('strCategoryName', 'like', '%'.$keyword.'%')->get();
        }else if($cateId==1){
            $categories = CategorySmartStore::where('bIsDel', 0)->where('strCategoryName', 'like', '%'.$keyword.'%')->get();
        }else if($cateId==2){
            $categories = CategoryCoupang::where('bIsDel', 0)->where('strCategoryName', 'like', '%'.$keyword.'%')->get();
        }else if($cateId==3){
            $categories = Category11thGlobal::where('bIsDel', 0)->where('strCategoryName', 'like', '%'.$keyword.'%')->get();
        }else if($cateId==4){
            $categories = Category11thNormal::where('bIsDel', 0)->where('strCategoryName', 'like', '%'.$keyword.'%')->get();
        }else if($cateId==5){
            $categories = CategoryAuction::where('bIsDel', 0)->where('strCategoryName', 'like', '%'.$keyword.'%')->get();
        }else if($cateId==6){
            $categories = CategoryGmarket::where('bIsDel', 0)->where('strCategoryName', 'like', '%'.$keyword.'%')->get();
        }else if($cateId==7){
            $categories = CategoryInterPark::where('bIsDel', 0)->where('strCategoryName', 'like', '%'.$keyword.'%')->get();
        }else if($cateId==8){
            $categories = CategoryWeMakePrice::where('bIsDel', 0)->where('strCategoryName', 'like', '%'.$keyword.'%')->get();
        }

        return response()->json(["status" => "success", "data" => $categories]);
    }

    public function categorySelect($cateId = 0, Request $request)
    {
        
        $keyword = $request->get('keyword');
        $keyword = str_replace(' ', '', $keyword);
        $keywords = array();
        if(strpos($keyword, ':') !== false){
            $temp = explode(' : ', $keyword);
            $keywords = preg_split('/[> ]/', $temp[1]);
        }else{
            $keywords = preg_split('/[> ]/', $keyword);
        }
        $keywords = array_reverse($keywords);
        //print_r($keywords);
        $categories = array();
        $categories[] = null;//솔루션 카테고리
        $categories[] = CategorySmartStore::where('bIsDel', 0)
                        //->whereIn('strCategoryName', 'like', '%'.$keyword.'%')
                        ->where('strCategoryName', 'like', '%'.$keywords[0].'%')
                        ->where('strCategoryName', 'like', '%'.$keywords[1].'%')
                        ->first();
        $categoriy_c = CategoryCoupang::where('bIsDel', 0)
                        //->whereIn('strCategoryName', 'like', '%'.$keyword.'%')
                        ->where('strCategoryName', 'like',  '%' . $keywords[0] .'%')->first();
        if($categoriy_c == null){
            $categories[] = CategoryCoupang::where('bIsDel', 0)
                //->whereIn('strCategoryName', 'like', '%'.$keyword.'%')
                ->where('strCategoryName', 'like', '%'.$keywords[0].'%')
                ->where('strCategoryName', 'like', '%'.$keywords[1].'%')
                ->first();
        }else{
            $categories[] = $categoriy_c;
        }

        $categories[] = Category11thGlobal::where('bIsDel', 0)
                        //->whereIn('strCategoryName', 'like', '%'.$keyword.'%')
                        ->where('strCategoryName', 'like', '%'.$keywords[0].'%')
                        ->where('strCategoryName', 'like', '%'.$keywords[1].'%')
                        ->first();
        $categories[] = Category11thNormal::where('bIsDel', 0)
                        //->whereIn('strCategoryName', 'like', '%'.$keyword.'%')
                        ->where('strCategoryName', 'like', '%'.$keywords[0].'%')
                        ->where('strCategoryName', 'like', '%'.$keywords[1].'%')
                        ->first();
        $categories[] = CategoryAuction::where('bIsDel', 0)
                        //->whereIn('strCategoryName', 'like', '%'.$keyword.'%')
                        ->where('strCategoryName', 'like', '%'.$keywords[0].'%')
                        ->where('strCategoryName', 'like', '%'.$keywords[1].'%')
                        ->first();
        $categories[] = CategoryGmarket::where('bIsDel', 0)
                        //->whereIn('strCategoryName', 'like', '%'.$keyword.'%')
                        ->where('strCategoryName', 'like', '%'.$keywords[0].'%')
                        ->where('strCategoryName', 'like', '%'.$keywords[1].'%')
                        ->first();
        $categories[] = CategoryInterPark::where('bIsDel', 0)
                        //->whereIn('strCategoryName', 'like', '%'.$keyword.'%')
                        ->where('strCategoryName', 'like', '%'.$keywords[0].'%')
                        ->where('strCategoryName', 'like', '%'.$keywords[1].'%')
                        ->first();
        $categories[] = CategoryWeMakePrice::where('bIsDel', 0)
                        //->whereIn('strCategoryName', 'like', '%'.$keyword.'%')
                        ->where('strCategoryName', 'like', '%'.$keywords[0].'%')
                        ->where('strCategoryName', 'like', '%'.$keywords[1].'%')
                        ->first();
        return response()->json(["status" => "success", "data" => $categories]);
    }

    public function categoryListSmartStore()
    {
        return view('scratch.CategorySmartStoreList');
    }

    public function categoryListCoupang()
    {
        return view('scratch.CategoryCoupangList');
    }

    public function categoryList11thGlobal()
    {
        return view('scratch.Category11thGlobalList');
    }

    public function categoryList11thNormal()
    {
        return view('scratch.Category11thNormalList');
    }

    public function categoryListAuction()
    {
        return view('scratch.CategoryAuctionList');
    }

    public function categoryListInterPark()
    {
        return view('scratch.CategoryInterParkList');
    }

    public function categoryListWeMakePrice()
    {
        return view('scratch.CategoryWeMakePriceList');
    }

    public function categoryListGmarket()
    {
        return view('scratch.CategoryGmarketList');
    }
}
