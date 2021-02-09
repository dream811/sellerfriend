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
        $shareType = "1";
        $basePriceTypes= array('CNY', 'KRW', 'USD', 'JPY');
        $countryShippingCostTypes= array('CNY', 'KRW', 'USD', 'JPY');
        $worldShippingCostTypes= array('KRW');
        $weightTypes= array('Kg');
        $tr = new GoogleTranslate('ko');
        $tr->setSource('zh-cn');
        $tr->setTarget('ko');
        $strChMainName = '秋冬加厚职业套装2020新款毛呢大衣中长款套裙工作服工装妮子外套';
        $strKrMainName = $tr->translate($strChMainName);
        $title = "상품스크랩";
        return view('scratch.ProductScrap', compact('title', 'strChMainName', 'strKrMainName', 'brands', 'comes', 'categories_1', 'categories_2', 'categories_3', 'categories_4', 'shareType', 'basePriceTypes', 'countryShippingCostTypes', 'worldShippingCostTypes', 'weightTypes'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function save(Request $request)
    {
        //main data
        echo "fs".$brand = $request->post('txtBrandName');
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
            'nComeCode' => $request->post('selComeName'), 
            'nCategoryCode1' => $request->post('selCategoryName1'), 
            'nCategoryCode2' => $request->post('selCategoryName2'), 
            'nCategoryCode3' => $request->post('selCategoryName3'), 
            'nCategoryCode4' => $request->post('selCategoryName4'), 
            'strCategoryName' => $request->post('txtCategoryName'), 
            'nShareType' => $request->post('rdoShareType'),
            'bIsDel'=> 0
        ]);
        $product->save();
        //detail data
        $productDetail = new ProductDetail([
            'nProductIdx' => $product->nIdx,
            'nBasePriceType' => $request->post('selBasePriceType'),
            'nBasePrice' => number_format($request->post('txtBasePrice')),
            'nCountryShippingCostType' => $request->post('selCountryShippingCostType'),
            'nCountryShippingCost' => number_format($request->post('txtCountryShippingCost')),
            'nWorldShippingCostType' => $request->post('selWorldShippingCostType'),
            'nWorldShippingCost' => number_format($request->post('txtWorldShippingCost')),
            'nWeightType' => $request->post('selWeightType'),
            'nWeight' => number_format($request->post('txtWeight')),
            'bAdditionalOption1' => number_format($request->post('chkAdditionalOption1')),
            'bAdditionalOption2' => number_format($request->post('chkAdditionalOption2')),
            'bAdditionalOption3' => number_format($request->post('chkAdditionalOption3')),
            'bAdditionalOption4' => number_format($request->post('chkAdditionalOption4')),
            'nMultiPriceOptionType' => number_format($request->post('selCategoryName1')),
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
                'strName' => '',
                'strURL' => $arrDetailImage[$i],
                'nHeight' => 0,
                'nWidth' => 0,
                'strNote' => '',
                'bIsDel' => 0
            ]);
            $productImage->save();
        }

        //return redirect('scratchProductScrap');
    }
}
