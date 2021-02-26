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
        //$scrapURL = 'https://item.taobao.com/item.htm?spm=2013.1.0.0.5c77577bM4iKJj&id=604441926066&scm=1007.12144.95220.42296_0_0&pvid=38083436-f8a4-412c-ba84-e54b99d0f8d7&utparam=%7B"x_hestia_source"%3A"42296"%2C"x_object_type"%3A"item"%2C"x_hestia_subsource"%3A"default"%2C"x_mt"%3A0%2C"x_src"%3A"42296"%2C"x_pos"%3A1%2C"wh_pid"%3A-1%2C"x_pvid"%3A"38083436-f8a4-412c-ba84-e54b99d0f8d7"%2C"scm"%3A"1007.12144.95220.42296_0_0"%2C"x_object_id"%3A604441926066%7D';
        curl_setopt($cURLConnection, CURLOPT_URL, 'http://localhost:8004/url='.$scrapURL);
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cURLConnection, CURLOPT_CONNECTTIMEOUT, 0); 
        curl_setopt($cURLConnection, CURLOPT_TIMEOUT, 400); //timeout in seconds
        $result = curl_exec($cURLConnection);
        curl_close($cURLConnection);
        $tr = new GoogleTranslate('ko');
        $tr->setSource('zh-cn');
        $tr->setTarget('ko');
        
        $arrResponse = (array)json_decode($result, true);
                
        if(str_contains($scrapURL, "detail.tmall.com")){
            $tranArr = $arrResponse['valItemInfo']['skuList'];
            foreach ($tranArr as $key => $value) {
                unset($value['pvs']);
                unset($value['skuId']);
                $tranArr[$key] = $value;  
            }
            $transData = json_encode($tranArr, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
            $trnasResult = (array)json_decode($tr->translate($transData), true);
            //
            //print_r($trnasResult);
            $descData = "";
            foreach ($arrResponse['valItemInfo']['skuList'] as $key => $value) {
                $price = $arrResponse['valItemInfo']['skuMap'][';'.$arrResponse['valItemInfo']['skuList'][$key]['pvs'].';']['price'];
                $ChSize = explode(" ", array_values($arrResponse['valItemInfo']['skuList'][$key])[0], 2);
                $KrSize = explode(" ", array_values($trnasResult[$key])[0], 2);
                $arrResponse['valItemInfo']['skuList'][$key]['price'] = $price;
                $arrResponse['valItemInfo']['skuList'][$key]['basePrice'] = number_format($price * 170, 2, '.', '');
                $arrResponse['valItemInfo']['skuList'][$key]['salePrice'] = number_format(($price + $price * 0.3) * 170, 2, '.', '');
                $arrResponse['valItemInfo']['skuList'][$key]['KrSize'] = $KrSize[0];//$tr->translate($ChSize[0]);
                $arrResponse['valItemInfo']['skuList'][$key]['ChSize'] = $ChSize[0];
                $arrResponse['valItemInfo']['skuList'][$key]['KrColorPattern'] = $KrSize[1];//$tr->translate($ChSize[1].$ChSize[2]);
                $arrResponse['valItemInfo']['skuList'][$key]['ChColorPattern'] = $ChSize[1];
                $arrResponse['valItemInfo']['skuList'][$key]['image'] = $arrResponse['propertyPics'][';'.explode(";", $arrResponse['valItemInfo']['skuList'][$key]['pvs'])[1].';'][0];
                $arrResponse['valItemInfo']['skuList'][$key]['weight'] = 0;
                $descData .= '<div style="pdding-botton:10px; text-align: center;"><p>['.$arrResponse['valItemInfo']['skuList'][$key]['KrColorPattern'].', '.$arrResponse['valItemInfo']['skuList'][$key]['KrSize'].']</p><p><img src="'.$arrResponse['valItemInfo']['skuList'][$key]['image'].'"></p></div>';
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
            //print_r($resDetailTmall);
            return response()->json(["status" => "success", "data" => $resDetailTmall]);
        }
        else if(str_contains($scrapURL, "item.taobao.com"))
        {
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
            $transData = json_encode(array_values($arrResponse['colors']), JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
            $trnasResult = $tr->translate($transData);
            $transResArr = json_decode($trnasResult);
            $idx=0;
            foreach ($arrResponse['colors'] as $key => $value) {
                $transResArr[$key] = $transResArr[$idx];
                unset($transResArr[$idx]);
                $idx++;
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
                    "basePrice" => number_format($value['price'] * 170, 2, ',', ''),
                    "salePrice" => number_format(($value['price'] + $value['price'] * 0.3) * 170, 2, '.', ''),
                    "ChSize" => $arrResponse['sizes'][explode(';', $key)[1]],
                    "KrSize" => $arrResponse['sizes'][explode(';', $key)[1]],
                    "ChColorPattern" => $arrResponse['colors'][explode(';', $key)[2]],
                    "KrColorPattern" => $transResArr[explode(';', $key)[2]],
                    "image" => $arrResponse['colorImages'][explode(';', $key)[2]],
                    "weight" => 0
                );
                $resDetailTaobao['items'][] = $val;
                $descData .= '<div style="pdding-botton:10px; text-align: center;"><p>['.$val['KrColorPattern'].", ".$val['KrSize'].']</p><p><img src="'.$val['image'].'"></p></div>';
            }
            
            $resDetailTaobao['description'] = $descData.str_replace("|", "\"",$arrResponse['description']);
            $resDetailTaobao['images'] = $arrResponse['auctionImages'];
            $resDetailTaobao['price'] = $price;
            return response()->json(["status" => "success", "data" => $resDetailTaobao]);
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
            'nMarginPrice' => number_format($nMarketPrice / (100 - $nMarginPercent) /100 + $nMarketPrice, 2, '.', ''),
            'nMarginPercent' => $nMarginPercent,
            'blobNote' => $request->post('summernote'),
            'bIsDel'=> 0
        ]);
        $productDetail->save();
        //subitem data
        $countItem = count($request->post('txtSubItemImage'));
        
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
