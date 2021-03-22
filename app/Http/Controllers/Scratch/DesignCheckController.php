<?php

namespace App\Http\Controllers\Scratch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\Product;
use App\Models\Come;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Country;
use Exception;
use Yajra\DataTables\DataTables;

class DesignCheckController extends Controller
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
        $countries = Country::where('bIsDel', 0)
                ->orderBy('strCountryCode')
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
        $shareType = "1";
        $basePriceTypes= array('CNY', 'KRW', 'USD', 'JPY');
        $countryShippingCostTypes= array('CNY', 'KRW', 'USD', 'JPY');
        $worldShippingCostTypes= array('KRW');
        $weightTypes= array('Kg');
        $tr = new GoogleTranslate('ko');
        $tr->setSource('zh-cn');
        $tr->setTarget('ko');
        $title = "디자인검토";
        
        if ($request->ajax()) {
            $products = Product::where('bIsDel', 0)
                ->where('nUserId', Auth::id())
                ->where('nProductWorkProcess', 2)
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
                    $btn = '<button type="button" data-id="'.$row->nIdx.'" style="font-size:10px !important;" class="btn btn-xs btn-primary btnSellTargetProduct">판매대상상품</button>';
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
                    if($request->get('selCountry')){
                        $query->where('nCountryCode', '=', "{$request->get('selCountry')}");
                    }
                    if ($request->get('searchWord') != "") {
                        $query->where('strKrSubName', 'like', "%{$request->get('searchWord')}%")
                            ->orWhere('strChSubName', 'like', "%{$request->get('searchWord')}%");
                    }
                })
                ->make(true);
        }
        return view('scratch.DesignCheck', compact('title', 'brands', 'comes', 'countries', 'categories_1', 'categories_2', 'categories_3', 'categories_4', 'shareType', 'basePriceTypes', 'countryShippingCostTypes', 'worldShippingCostTypes', 'weightTypes'));
    }

    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update($nIdx)
    {
        //$product  = Product::where('nIdx', $request->post('id'))->first();
        try {
            Product::find($nIdx)->update(['nProductWorkProcess' => 3]);
            return response()->json(["status" => "success", "data" => "Resource updated."]);
        }
        catch(Exception $ex)
        {
            return response()->json(["status" => "error", "data" => "Resource update error."]);
        }
        
    }
    
}
