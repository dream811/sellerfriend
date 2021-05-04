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
use App\Mylibs\ScrapperAPI;
use Exception;
use Laravel\Ui\Presets\React;

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
        $arrResponse['item']['titleKO'] = $tr->translate($arrResponse['item']['title']);
        
        
        $arrOption = array();
        $arrResponse['item']['desc'] = '<image src="'.asset('storage/'.$topImage->strImageURL).'">'.$arrResponse['item']['desc'].'<image src="'.asset('storage/'.$downImage->strImageURL).'">';
        
        return response()->json(["status" => "success", "data" => $arrResponse['item'] ]);
        
/*
        if(str_contains($scrapURL, "detail.tmall.com")){
            $arrKrItem = array();
            foreach ($arrResponse['arrOption'] as $key1 => $item) { 
                $KrOptionId = $tr->translate($key1);
                $tranString = implode(" | ", $item);
                $tempString = $tr->translate($tranString);
                $tempArr = explode("|",$tempString);
                // print_r($tempArr);
                $arrOptItem = array();
                
                $i = 0;
                foreach ($item as $key2 => $value) {
                    $image = array_key_exists(";".$key2.";", $arrResponse['propertyPics']) ? $arrResponse['propertyPics'][';'.$key2.';'][0]:"";
                    if (array_key_exists($i, $tempArr)) {
                        $arrKrItem[$key2] = $tempArr[$i];
                        //$arrKrSize[] = $tempArr[$i];
                        $arrOptItem[] = array(
                            $key2,
                            $tempArr[$i],
                            $item[$key2],
                            $image
                        );
                    }else{
                        $arrKrItem[$key2] = "";
                        //$arrKrSize[] = "";
                        $arrOptItem[] = array(
                            $key2,
                            "",
                            $item[$key2],
                            $image
                        );
                    }
                    $i++;
                }
                $arrOption[] = array(
                    'optCnName' => $key1,
                    'optKoName' => $KrOptionId,
                    'optItems' => $arrOptItem
                );
            }
                        
            $descData = "";
            foreach ($arrResponse['valItemInfo']['skuList'] as $key => $value) {
                $price = $arrResponse['valItemInfo']['skuMap'][';'.$arrResponse['valItemInfo']['skuList'][$key]['pvs'].';']['price'];
                $arrKey = explode(";",$value['pvs']);
                $arrResponse['valItemInfo']['skuList'][$key]['price'] = $price;
                $arrResponse['valItemInfo']['skuList'][$key]['basePrice'] = number_format($price * 170, 2, '.', '');
                $arrResponse['valItemInfo']['skuList'][$key]['salePrice'] = number_format(round(($price + $price * 0.3) * 170, -1), 2, '.', '');
                $temp = explode(";", $arrResponse['valItemInfo']['skuList'][$key]['pvs']);
                $options = array();
                for ($i=0; $i < count($temp); $i++) { 
                    if($temp[$i] == ""){
                        continue;
                    }else{
                        $options[] = $arrKrItem[$temp[$i]];
                    }
                }
                //$arrResponse['valItemInfo']['skuList'][$key]['image'] = count($arrKey) <= 1 ? $arrResponse['propertyPics'][';'.$arrKey[0].';'][0] : $arrResponse['propertyPics'][';'.$arrKey[1].';'][0];
                $arrResponse['valItemInfo']['skuList'][$key]['options'] = $options;
                $arrResponse['valItemInfo']['skuList'][$key]['stock'] = $arrResponse['valItemInfo']['skuMap'][';'.$arrResponse['valItemInfo']['skuList'][$key]['pvs'].';']['stock'];
                //$descData .= '<div style="text-align: center;"><p>['.$KrColor.', '.$KrSize.']</p><p><img src="'.$arrResponse['valItemInfo']['skuList'][$key]['image'].'"></p></div>';
            }
            //상세이미지 얻는 요청
            $descURL = "http:".$arrResponse['api']['descUrl'];
            $cURLConnection = curl_init();
            
            curl_setopt($cURLConnection, CURLOPT_URL, $descURL);
            curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($cURLConnection, CURLOPT_CONNECTTIMEOUT, 0); 
            curl_setopt($cURLConnection, CURLOPT_TIMEOUT, 400); //timeout in seconds
            $res = curl_exec($cURLConnection);
            curl_close($cURLConnection);
            
            $krTitle = $tr->translate($arrResponse['itemDO']['title']);
            $descData = substr($res, 11, -2);
            $resDetailTmall = array(
                'chMainName' => $arrResponse['itemDO']['title'],
                'krMainName' => $krTitle,
                'keyword' => str_replace(' ', ',', $krTitle),
                'price' => $arrResponse['itemDO']['reservePrice'],
                'items' => $arrResponse['valItemInfo']['skuList'],
                'images' => $arrResponse['propertyPics']['default'],
                'options' => $arrOption,
            );
            $resDetailTmall['description'] ='<image src="'.asset('storage/'.$topImage->strImageURL).'">'.utf8_encode($descData).'<image src="'.asset('storage/'.$downImage->strImageURL).'">';
            return response()->json(["status" => "success", "data" => $resDetailTmall]);
        }else if(str_contains($scrapURL, "item.taobao.com")){
            //print_r($arrResponse);
            $descData = "";
            $krTitle = $tr->translate($arrResponse['title']);
            $resDetailTaobao = array(
                "id" => $arrResponse['id'],
                "chMainName" => $arrResponse['title'],
                "krMainName" => $krTitle,
                'keyword' => str_replace(' ', ',', $krTitle),
                "skuList" => array(),
                "images" => array()
            );
            $arrOption = array();
            $arrKrItem = array();
            foreach ($arrResponse['arrOption'] as $key1 => $item) { 
                $KrOptionId = $tr->translate($key1);
                $tranString = implode(" | ", $item);
                $tempString = $tr->translate($tranString);
                $tempArr = explode("|",$tempString);
                // print_r($tempArr);
                $arrOptItem = array();
                
                $i = 0;
                foreach ($item as $key2 => $value) {
                    $image = array_key_exists($key2, $arrResponse['arrImage']) ? $arrResponse['arrImage'][$key2]:"";
                    if (array_key_exists($i, $tempArr)) {
                        $arrKrItem[$key2] = $tempArr[$i];
                        //$arrKrSize[] = $tempArr[$i];
                        $arrOptItem[] = array(
                            $key2,//id
                            $tempArr[$i],// translated name
                            $item[$key2],//name
                            $image// image
                        );
                    }else{
                        $arrKrItem[$key2] = "";
                        //$arrKrSize[] = "";
                        $arrOptItem[] = array(
                            $key2,
                            "",
                            $item[$key2],
                            $image
                        );
                    }
                    $i++;
                }
                $arrOption[] = array(
                    'optCnName' => $key1,
                    'optKoName' => $KrOptionId,
                    'optItems' => $arrOptItem
                );
            }
            
            $price = 0;
            foreach ($arrResponse['skuMap'] as $key => $value) {
                // $price = $arrResponse['valItemInfo']['skuMap'][';'.$arrResponse['valItemInfo']['skuList'][$key]['pvs'].';']['price'];
                // $ChSize = explode(" ", array_values($arrResponse['valItemInfo']['skuList'][$key])[0], 2);
                // $KrSize = explode(" ", array_values($trnasResult[$key])[0], 2);
                if($value['price'] > $price){
                    $price = $value['price'];
                }
                $temp = explode(";", $key);
                $options = array();
                for ($i=0; $i < count($temp); $i++) { 
                    if($temp[$i] == ""){
                        continue;
                    }else{
                        $options[] = $arrKrItem[$temp[$i]];
                    }
                }

                $val = array(
                    "pvs" => $key,
                    "price" => $value['price'],
                    "basePrice" => number_format($value['price'] * 170, 2, '.', ''),
                    "salePrice" => number_format(round(($value['price'] + $value['price'] * 0.3) * 170, -1), 2, '.', ''),
                    "options" => $options,
                    "stock" => $value['stock'],
                    //"ChSize" => !isset($arrResponse['sizes']) ? "" : $arrResponse['sizes'][explode(';', $key)[1]],
                    //"KrSize" => !isset($arrResponse['sizes']) ? "" : $arrResponse['sizes'][explode(';', $key)[1]],
                    //"ChColorPattern" => $ChColorSize,
                    //"KrColorPattern" => $KrColorPattern,
                    //"image" => !isset($arrResponse['sizes']) ? $arrResponse['colorImages'][explode(';', $key)[1]] :$arrResponse['colorImages'][explode(';', $key)[2]],
                    "weight" => 0
                );
                $resDetailTaobao['items'][] = $val;
                //$descData .= '<div style="pdding-botton:10px; text-align: center;"><p>['.$val['KrColorPattern'].", ".$val['KrSize'].']</p><p><img src="'.$val['image'].'"></p></div>';
            }
            
            $resDetailTaobao['description'] = '<image src="'.asset('storage/'.$topImage->strImageURL).'">'.$descData.str_replace("|", "\"",$arrResponse['description']).'<image src="'.asset('storage/'.$downImage->strImageURL).'">';
            $resDetailTaobao['images'] = $arrResponse['auctionImages'];
            $resDetailTaobao['price'] = $price;
            $resDetailTaobao['options'] = $arrOption;
            return response()->json(["status" => "success", "data" => $resDetailTaobao]);
        }else if(str_contains($scrapURL, "detail.1688.com")){
            //print_r($arrResponse);
            $krTitle = $tr->translate($arrResponse['title']);

            $descData = "";
            $krTitle = $tr->translate($arrResponse['title']);
            $resDetail1688 = array(
                "id" => $arrResponse['id'],
                "chMainName" => $arrResponse['title'],
                "krMainName" => $krTitle,
                'keyword' => str_replace(' ', ',', $krTitle),
                "skuList" => array(),
                "images" => array()
            );
            // //컬러 패턴 번역
            // $transData = json_encode(array_values($arrResponse['colors']), JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
            // $trnasResult = $tr->translate($transData);
            // $transResArr = json_decode($trnasResult);
            // $idx=0;
            foreach ($arrResponse['images'] as $key => $value) {
                $arrResponse['images'][$key] = $value['original'];
            }
            //print_r($arrResponse['images']);
            //print_r($arrResponse);
            $resTransArr = array_keys($arrResponse['detailData']['sku']['skuMap']);
            $transData = implode('||||', array_values($resTransArr));
            $transData = str_replace("&gt;","***", $transData);

            $trnasResult = $tr->translate($transData);
            $transResult = preg_replace('/\s+/', '', str_replace(' ', '', $trnasResult));

            $skuProp = explode('||||', $transResult);
            //echo $transData;
            //print_r($skuProp);
            $idx = 0;
            foreach ($arrResponse['detailData']['sku']['skuMap'] as $key => $value) {
                
                $Cn_Size_Color = explode('&gt;', $key);
                $itemCnColor = $Cn_Size_Color[0];
                $itemCnSize = $Cn_Size_Color[1];
                //
                $Ko_Size_Color = explode('***', $skuProp[$idx]);
                
                $idx++;
                $itemKoColor = $Ko_Size_Color[0];
                $itemKoSize = $Ko_Size_Color[1];
                $val = array(
                    "price" => $value['price'],
                    "basePrice" => number_format($value['price'] * 170, 2, '.', ''),
                    "salePrice" => number_format(round(($value['price'] + $value['price'] * 0.3) * 170, -1), 2, '.', ''),
                    "ChSize" => $itemCnSize,
                    "KrSize" => $itemKoSize,
                    "ChColorPattern" => $itemCnColor,
                    "KrColorPattern" => $itemKoColor,
                    "image" => $arrResponse['colors'][$itemCnColor]['original'],
                    "weight" => 0
                );
                $resDetail1688['items'][] = $val;
                $descData .= '<div style="pdding-botton:10px; text-align: center;"><p>['.$val['KrColorPattern'].", ".$val['KrSize'].']</p><p><img src="'.$val['image'].'"></p></div>';
            }
            
            $resDetail1688['description'] = $descData;
            $resDetail1688['images'] = $arrResponse['images'];
            $resDetail1688['price'] = $arrResponse['price'];;
            return response()->json(["status" => "success", "data" => $resDetail1688]);
        }else if(str_contains($scrapURL, "www.vvic.com")){
            $krTitle = $tr->translate($arrResponse['title']);

            $descData = "";
            $krTitle = $tr->translate($arrResponse['title']);
            $resDetailVvic = array(
                "id" => $arrResponse['id'],
                "chMainName" => $arrResponse['title'],
                "krMainName" => $krTitle,
                'keyword' => str_replace(' ', ',', $krTitle),
                "skuList" => array(),
                "images" => array()
            );
            // //컬러 패턴 번역
            $images = explode(',', $arrResponse['images']);
            
            $transData = "";
            foreach ($arrResponse['skuMap'] as $key => $value) {
                $transData .= ($value['color_name']."||||");
            }

            $trnasResult = $tr->translate($transData);
            $transResult = preg_replace('/\s+/', '', str_replace(' ', '', $trnasResult));
            $skuProp = explode('||||', $transResult);

            $idx = 0;
            foreach ($arrResponse['skuMap'] as $key => $value) {
                $val = array(
                    "price" => $value['price'],
                    "basePrice" => number_format($value['price'] * 170, 2, '.', ''),
                    "salePrice" => number_format(round(($value['price'] + $value['price'] * 0.3) * 170, -1), 2, '.', ''),
                    "ChSize" => $value['size_name'],
                    "KrSize" => $value['size_name'],
                    "ChColorPattern" => $value['color_name'],
                    "KrColorPattern" => $skuProp[$key],
                    "image" => $value['color_pic'],
                    "weight" => number_format($value['weight']/1000, 2, '.', '')
                );
                $resDetailVvic['items'][] = $val;
                $descData .= '<div style="pdding-botton:10px; text-align: center;"><p>['.$val['KrColorPattern'].", ".$val['KrSize'].']</p><p><img src="'.$val['image'].'"></p></div>';
            }
            $description = str_replace('|', '"', $arrResponse['description']);
            $resDetailVvic['description'] = $descData.$description;
            $resDetailVvic['images'] = $images;
            $resDetailVvic['price'] = $arrResponse['price'];

            return response()->json(["status" => "success", "data" => $resDetailVvic]);
        }
        */
    }
    /**
     * Show the application dashboard.
     *
     * 상품보관
     */
    public function save(Request $request)
    {
        
        return redirect('scratchProductScrap');
        //main data
        $categoryName = $request->post('txtCategoryName');
        $product = new Product([
            'nUserId' => Auth::id(),
            'strURL' => $request->post('txtScrapURL'), 
            'strMainName' => $request->post('txtKrMainName'), 
            'strSubName' => $request->post('txtKrSubName'),
            'nUserId' => Auth::id(), 
            'nBrandType' => "", 
            'strBrand' => "",
            'strKeyword' => "", 
            'strChMainName' => $request->post('txtChMainName'), 
            'strKrMainName' => $request->post('txtKrMainName'), 
            'strChSubName' => $request->post('txtChMainName'), 
            'strKrSubName' => $request->post('txtKrSubName'), 
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
        $nMarginPercent = 30;
        $productDetail = new ProductDetail([
            'nProductIdx' => $product->nIdx,
            'strBasePriceType' => $request->post('selBasePriceType'),
            'nBasePrice' => number_format($request->post('txtBasePrice'), 2, '.', ''),
            'strCountryShippingCostType' => $request->post('selCountryShippingCostType'),
            'nCountryShippingCost' => number_format($request->post('txtCountryShippingCost'), 2, '.', ''),
            'strWorldShippingCostType' => $request->post('selWorldShippingCostType'),
            'nWorldShippingCost' => $request->post('txtWorldShippingCost'),
            'strWeightType' => $request->post('selWeightType'),
            'nWeight' => number_format($request->post('txtWeight'), 2, '.', ''),
            'bAdditionalOption1' => number_format($request->post('chkAdditionalOption1')),
            'bAdditionalOption2' => number_format($request->post('chkAdditionalOption2')),
            'bAdditionalOption3' => number_format($request->post('chkAdditionalOption3')),
            'bAdditionalOption4' => number_format($request->post('chkAdditionalOption4')),
            'nMultiPriceOptionType' => number_format($request->post('rdoMultiPriceOptionType')),
            'nMarketPrice' => $nMarketPrice,
            'nMarginPrice' => number_format(round($nMarketPrice / (100 - $nMarginPercent) /100 + $nMarketPrice, -1), 2, '.', ''),
            'nMarginPercent' => $nMarginPercent,
            'blobNote' => $request->post('summernote'),
            'bIsDel'=> 0
        ]);
        $productDetail->save();
        //subitem data
        $countItem = count($request->post('txtSubItemImage'));
        
        //만일 서브아이템이 10개 이상이라면 최대입력수를 늘인다
        if($countItem > 10)
            ini_set('max_input_vars','10000' );

        // $arrImage = $request->post('txtSubItemImage');
        // $arrKrColorPattern = $request->post('txtSubItemKrColorPattern');
        // $arrChColorPattern = $request->post('txtSubItemChColorPattern');
        // $arrKrSize = $request->post('txtSubItemKrSize');
        // $arrChSize = $request->post('txtSubItemChSize');
        // $arrOptionPrice = $request->post('txtSubItemOptionPrice');
        
        // $arrBasePrice = $request->post('txtSubItemBasePrice');
        // $arrSalePrice = $request->post('txtSubItemSalePrice');
        // $arrWeight = $request->post('txtSubItemWeight');
        // for ($i=0; $i < $countItem; $i++) { 
        //     $productItem = new ProductItem([
        //         'nProductIdx' => $product->nIdx,
        //         'strSubItemName' => $arrKrColorPattern[$i],
        //         'nSubItemOptionPrice' => $arrOptionPrice[$i],
        //         'nSubItemBasePrice' => $arrBasePrice[$i],
        //         'nSubItemSalePrice' => $arrSalePrice[$i],
        //         'nSubItemWeight' => $arrWeight[$i],
        //         'strSubItemImage' => $arrImage[$i],
        //         'strSubItemChColorPattern' => $arrChColorPattern[$i],
        //         'strSubItemKrColorPattern' => $arrKrColorPattern[$i],
        //         'strSubItemChSize' => $arrChSize[$i],
        //         'strSubItemKrSize' => $arrKrSize[$i],
        //         'bIsDel' => 0
        //     ]);
        //     $productItem->save();
        // }
        // //image data
        // $countImage = count($request->post('txtImage'));
        // $arrDetailImage = $request->post('txtImage');
        // for ($i=0; $i < $countImage; $i++) { 
            
        //     $productImage = new ProductImage([
        //         'nProductIdx' => $product->nIdx,
        //         'nImageCode' => $i,
        //         'strName' => '',
        //         'strURL' => $arrDetailImage[$i],
        //         'nHeight' => 0,
        //         'nWidth' => 0,
        //         'strNote' => '',
        //         'bIsDel' => 0
        //     ]);
        //     $productImage->save();
        // }

        return redirect('scratchProductScrap');
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
            $keywords = preg_split('/[> \/]/', $temp[1]);
        }else{
            $keywords = preg_split('/[> \/]/', $keyword);
        }
        $keywords = array_reverse($keywords);
        $categories = array();
        $categories[] = null;//솔루션 카테고리
        $categories[] = CategorySmartStore::where('bIsDel', 0)
                        //->whereIn('strCategoryName', 'like', '%'.$keyword.'%')
                        ->where(function ($query) use($keywords) {
                            for ($i = 0; $i < count($keywords); $i++){
                                $query->orWhere('strCategoryName', 'like',  '%' . $keywords[$i] .'%');
                            }      
                        })->first();
        $categoriy_c = CategoryCoupang::where('bIsDel', 0)
                        //->whereIn('strCategoryName', 'like', '%'.$keyword.'%')
                        ->where('strCategoryName', 'like',  '%' . $keywords[0] .'%')->first();
        if($categoriy_c == null){
            $categories[] = CategoryCoupang::where('bIsDel', 0)
                //->whereIn('strCategoryName', 'like', '%'.$keyword.'%')
                ->where(function ($query) use($keywords) {
                    for ($i = 0; $i < count($keywords); $i++){
                        $query->orWhere('strCategoryName', 'like',  '%' . $keywords[$i] .'%');
                    }      
                })->first();
        }else{
            $categories[] = $categoriy_c;
        }

        $categories[] = Category11thGlobal::where('bIsDel', 0)
                        //->whereIn('strCategoryName', 'like', '%'.$keyword.'%')
                        ->where(function ($query) use($keywords) {
                            for ($i = 0; $i < count($keywords); $i++){
                                $query->orWhere('strCategoryName', 'like',  '%' . $keywords[$i] .'%');
                            }      
                        })->first();
        $categories[] = Category11thNormal::where('bIsDel', 0)
                        //->whereIn('strCategoryName', 'like', '%'.$keyword.'%')
                        ->where(function ($query) use($keywords) {
                            for ($i = 0; $i < count($keywords); $i++){
                                $query->orWhere('strCategoryName', 'like',  '%' . $keywords[$i] .'%');
                            }      
                        })->first();
        $categories[] = CategoryAuction::where('bIsDel', 0)
                        //->whereIn('strCategoryName', 'like', '%'.$keyword.'%')
                        ->where(function ($query) use($keywords) {
                            for ($i = 0; $i < count($keywords); $i++){
                                $query->orWhere('strCategoryName', 'like',  '%' . $keywords[$i] .'%');
                            }      
                        })->first();
        $categories[] = CategoryGmarket::where('bIsDel', 0)
                        //->whereIn('strCategoryName', 'like', '%'.$keyword.'%')
                        ->where(function ($query) use($keywords) {
                            for ($i = 0; $i < count($keywords); $i++){
                                $query->orWhere('strCategoryName', 'like',  '%' . $keywords[$i] .'%');
                            }      
                        })->first();
        $categories[] = CategoryInterPark::where('bIsDel', 0)
                        //->whereIn('strCategoryName', 'like', '%'.$keyword.'%')
                        ->where(function ($query) use($keywords) {
                            for ($i = 0; $i < count($keywords); $i++){
                                $query->orWhere('strCategoryName', 'like',  '%' . $keywords[$i] .'%');
                            }      
                        })->first();
        $categories[] = CategoryWeMakePrice::where('bIsDel', 0)
                        //->whereIn('strCategoryName', 'like', '%'.$keyword.'%')
                        ->where(function ($query) use($keywords) {
                            for ($i = 0; $i < count($keywords); $i++){
                                $query->orWhere('strCategoryName', 'like',  '%' . $keywords[$i] .'%');
                            }      
                        })->first();
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
