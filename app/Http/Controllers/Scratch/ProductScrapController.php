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
use App\Models\WeightType;
use App\Models\MoneyType;

class ProductScrapController extends Controller
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
        $moneyTypes = MoneyType::where('bIsDel', 0)
                ->get();
        $weightTypes = WeightType::where('bIsDel', 0)
                ->get();
        $shareType = "1";
        $tr = new GoogleTranslate('ko');
        $tr->setSource('zh-cn');
        $tr->setTarget('ko');
        $strChMainName = '秋冬加厚职业套装2020新款毛呢大衣中长款套裙工作服工装妮子外套';
        $strKrMainName = $tr->translate($strChMainName);
        $title = "상품스크랩";
        return view('scratch.ProductScrap', compact('title', 'strChMainName', 'strKrMainName', 'brands', 'comes', 'categories_1', 'categories_2', 'categories_3', 'categories_4', 'shareType', 'moneyTypes', 'weightTypes'));
    }
    /**
     * 상품수집
     */
    public function scratch(Request $request)
    {
        //스크래핑시간이 오래므로 400초정도 여유를 준다.
        set_time_limit(400);
        $scrapURL = $request->get('scrapURL');
        $cURLConnection = curl_init();
        curl_setopt($cURLConnection, CURLOPT_URL, 'http://localhost:8004/url='.$scrapURL);
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cURLConnection, CURLOPT_CONNECTTIMEOUT, 0); 
        curl_setopt($cURLConnection, CURLOPT_TIMEOUT, 400); //timeout in seconds
        $result = curl_exec($cURLConnection);
        curl_close($cURLConnection);
        $tr = new GoogleTranslate('ko');
        $tr->setSource('zh-cn');
        $tr->setTarget('ko');
        if (str_contains($result, 'failed')) return;
        
        $arrResponse = (array)json_decode($result, true);
        if(str_contains($scrapURL, "detail.tmall.com")){
            
            // print_r($arrResponse['sizes']);
            //size
            $tranString = implode("|", $arrResponse['sizes']);
            $tempString = $tr->translate($tranString);
            $tempArr = explode("|",$tempString);
            // print_r($tempArr);
            $arrKrSize = array();
            $i = 0;
            foreach ($arrResponse['sizes'] as $key => $value) {
                if (array_key_exists($i, $tempArr)) {
                    $arrKrSize[$key] = $tempArr[$i];
                }else{
                    $arrKrSize[$key] = "";
                }
                $i++;
            }
            //color
            $tranString = implode("|", $arrResponse['colors']);
            $tempString = $tr->translate($tranString);
            $tempArr = explode("|",$tempString);
            $arrKrColor = array();
            $i = 0;
            foreach ($arrResponse['colors'] as $key => $value) {
                if (array_key_exists($i, $tempArr)) {
                    $arrKrColor[$key] = $tempArr[$i];
                }else{
                    $arrKrColor[$key] = "";
                }
                $i++;
            }
            // $stackCount = count($tranArr);
            // $transResult = array();
            // $i=0;
            // while ($i < $stackCount) {
            //     $transStack = array_slice($tranArr, $i, min(10, count($tranArr) - $i));
            //     $transData = json_encode($transStack, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
            //     $temp = $tr->translate($transData);
            //     $trnasResStack = (array)json_decode($temp, true);
            //     $transResult = array_merge($transResult, $trnasResStack);
            //     $i += 10;
            // }
            
            $descData = "";
            foreach ($arrResponse['valItemInfo']['skuList'] as $key => $value) {
                $price = $arrResponse['valItemInfo']['skuMap'][';'.$arrResponse['valItemInfo']['skuList'][$key]['pvs'].';']['price'];
                $arrKey = explode(";",$value['pvs']);
                $ChSize = $arrResponse['sizes'][$arrKey[0]];
                $KrSize = $arrKrSize[$arrKey[0]];
                $ChColor = count($arrKey) <= 1 ? "" : $arrResponse['colors'][$arrKey[1]]; 
                $KrColor = count($arrKey) <= 1 ? "" : $arrKrColor[$arrKey[1]];
                
                $arrResponse['valItemInfo']['skuList'][$key]['price'] = $price;
                $arrResponse['valItemInfo']['skuList'][$key]['basePrice'] = number_format($price * 170, 2, '.', '');
                $arrResponse['valItemInfo']['skuList'][$key]['salePrice'] = number_format(round(($price + $price * 0.3) * 170, -1), 2, '.', '');
                $arrResponse['valItemInfo']['skuList'][$key]['KrSize'] = $KrSize;//$tr->translate($ChSize[0]);
                $arrResponse['valItemInfo']['skuList'][$key]['ChSize'] = $ChSize;
                $arrResponse['valItemInfo']['skuList'][$key]['KrColorPattern'] = $KrColor;//$tr->translate($ChSize[1].$ChSize[2]);
                $arrResponse['valItemInfo']['skuList'][$key]['ChColorPattern'] = $ChColor;
                $temp = explode(";", $arrResponse['valItemInfo']['skuList'][$key]['pvs']);
                $arrResponse['valItemInfo']['skuList'][$key]['image'] = count($arrKey) <= 1 ? $arrResponse['propertyPics'][';'.$arrKey[0].';'][0] : $arrResponse['propertyPics'][';'.$arrKey[1].';'][0];
                $arrResponse['valItemInfo']['skuList'][$key]['weight'] = 0;
                $descData .= '<div style="text-align: center;"><p>['.$KrColor.', '.$KrSize.']</p><p><img src="'.$arrResponse['valItemInfo']['skuList'][$key]['image'].'"></p></div>';
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
            $descData .= substr($res, 11, -2);
            $resDetailTmall = array(
                'chMainName' => $arrResponse['itemDO']['title'],
                'krMainName' => $krTitle,
                'keyword' => str_replace(' ', ',', $krTitle),
                'price' => $arrResponse['itemDO']['reservePrice'],
                'items' => $arrResponse['valItemInfo']['skuList'],
                'images' => $arrResponse['propertyPics']['default'],
                'description' => $descData
            );
            
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
            //컬러 패턴 번역
            //color
            $tranString = implode("|", $arrResponse['colors']);
            $tempString = $tr->translate($tranString);
            $tempArr = explode("|",$tempString);
            
            $transResArr = array();
            $i = 0;
            foreach ($arrResponse['colors'] as $key => $value) {
                if (array_key_exists($i, $tempArr)) {
                    $transResArr[$key] = $tempArr[$i];
                }else{
                    $transResArr[$key] = "";
                }
                $i++;
            }
            
            $price = 0;
            foreach ($arrResponse['skuMap'] as $key => $value) {
                // $price = $arrResponse['valItemInfo']['skuMap'][';'.$arrResponse['valItemInfo']['skuList'][$key]['pvs'].';']['price'];
                // $ChSize = explode(" ", array_values($arrResponse['valItemInfo']['skuList'][$key])[0], 2);
                // $KrSize = explode(" ", array_values($trnasResult[$key])[0], 2);
                if($value['price'] > $price){
                    $price = $value['price'];
                }
                $val = array(
                    "pvs" => $key,
                    "price" => $value['price'],
                    "basePrice" => number_format($value['price'] * 170, 2, '.', ''),
                    "salePrice" => number_format(round(($value['price'] + $value['price'] * 0.3) * 170, -1), 2, '.', ''),
                    "ChSize" => !isset($arrResponse['sizes']) ? "" : $arrResponse['sizes'][explode(';', $key)[1]],
                    "KrSize" => !isset($arrResponse['sizes']) ? "" : $arrResponse['sizes'][explode(';', $key)[1]],
                    "ChColorPattern" => !isset($arrResponse['colors']) ? "" : (!isset($arrResponse['sizes']) ? $arrResponse['colors'][explode(';', $key)[1]] : $arrResponse['colors'][explode(';', $key)[2]]),
                    "KrColorPattern" => !isset($arrResponse['colors']) ? "" : (!isset($arrResponse['sizes']) ? $arrResponse['colors'][explode(';', $key)[1]] :$transResArr[explode(';', $key)[2]]),
                    "image" => !isset($arrResponse['sizes']) ? $arrResponse['colorImages'][explode(';', $key)[1]] :$arrResponse['colorImages'][explode(';', $key)[2]],
                    "weight" => 0
                );
                $resDetailTaobao['items'][] = $val;
                $descData .= '<div style="pdding-botton:10px; text-align: center;"><p>['.$val['KrColorPattern'].", ".$val['KrSize'].']</p><p><img src="'.$val['image'].'"></p></div>';
            }
            
            $resDetailTaobao['description'] = $descData.str_replace("|", "\"",$arrResponse['description']);
            $resDetailTaobao['images'] = $arrResponse['auctionImages'];
            $resDetailTaobao['price'] = $price;
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
    }
    /**
     * Show the application dashboard.
     *
     * 상품보관
     */
    public function save(Request $request)
    {
        //main data
        $brand = $request->post('txtBrandName');
        $product = new Product([
            'nUserId' => Auth::id(),
            'strURL' => $request->post('txtScrapURL'), 
            'strMainName' => mb_substr($request->post('txtKrMainName'), 0, mb_strlen( $request->post('txtKrMainName')) > 25 ? 25 : mb_strlen( $request->post('txtKrMainName'))), 
            'strSubName' => mb_substr($request->post('txtKrMainName'), 0, mb_strlen( $request->post('txtKrMainName')) > 25 ? 25 : mb_strlen( $request->post('txtKrMainName'))),
            'nUserId' => Auth::id(), 
            'nBrandType' => $request->post('selBrandName'), 
            'strBrand' => ($request->post('txtBrandName') == "" ? $request->post('selBrandName') : $request->post('txtBrandName')),
            'strKeyword' => $request->post('txtKeyword'), 
            'strChMainName' => $request->post('txtKrMainName'), 
            'strKrMainName' => $request->post('txtKrMainName'), 
            'strChSubName' => $request->post('txtChMainName'), 
            'strKrSubName' => $request->post('txtKrMainName'), 
            'strComeCode' => $request->post('selComeName'), 
            'strCategoryCode1' => $request->post('selCategoryName1'), 
            'strCategoryCode2' => $request->post('selCategoryName2'), 
            'strCategoryCode3' => $request->post('selCategoryName3'), 
            'strCategoryCode4' => $request->post('selCategoryName4'), 
            'strCategoryName' => $request->post('txtCategoryName'), 
            'nShareType' => $request->post('rdoShareType'),
            'nProductWorkProcess' => 0,
            'bIsDel'=> 0
        ]);
        $product->save();
        //detail data
        $nMarketPrice = number_format(($request->post('txtBasePrice') + $request->post('txtCountryShippingCost'))*170 + $request->post('txtWorldShippingCost'), 2, '.', '');
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
        //if($countItem > 10)
            ini_set('max_input_vars','10000' );

        $arrImage = $request->post('txtSubItemImage');
        $arrKrColorPattern = $request->post('txtSubItemKrColorPattern');
        $arrChColorPattern = $request->post('txtSubItemChColorPattern');
        $arrKrSize = $request->post('txtSubItemKrSize');
        $arrChSize = $request->post('txtSubItemChSize');
        $arrOptionPrice = $request->post('txtSubItemOptionPrice');
        
        $arrBasePrice = $request->post('txtSubItemBasePrice');
        $arrSalePrice = $request->post('txtSubItemSalePrice');
        $arrWeight = $request->post('txtSubItemWeight');
        for ($i=0; $i < $countItem; $i++) { 
            $productItem = new ProductItem([
                'nProductIdx' => $product->nIdx,
                'strSubItemName' => $arrKrColorPattern[$i],
                'nSubItemOptionPrice' => $arrOptionPrice[$i],
                'nSubItemBasePrice' => $arrBasePrice[$i],
                'nSubItemSalePrice' => $arrSalePrice[$i],
                'nSubItemWeight' => $arrWeight[$i],
                'strSubItemImage' => $arrImage[$i],
                'strSubItemChColorPattern' => $arrChColorPattern[$i],
                'strSubItemKrColorPattern' => $arrKrColorPattern[$i],
                'strSubItemChSize' => $arrChSize[$i],
                'strSubItemKrSize' => $arrKrSize[$i],
                'bIsDel' => 0
            ]);
            $productItem->save();
        }
        //image data
        $countImage = count($request->post('txtImage'));
        $arrDetailImage = $request->post('txtImage');
        for ($i=0; $i < $countImage; $i++) { 
            
            $productImage = new ProductImage([
                'nProductIdx' => $product->nIdx,
                'nImageCode' => $i,
                'strName' => '',
                'strURL' => $arrDetailImage[$i],
                'nHeight' => 0,
                'nWidth' => 0,
                'strNote' => '',
                'bIsDel' => 0
            ]);
            $productImage->save();
        }

        return redirect('scratchProductScrap');
    }
}
