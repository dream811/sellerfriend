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
use App\Models\Market;
use App\Models\MarketAccount;
use App\MyLibs\CoupangConnector;
use Exception;
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
                    $btn = '<button type="button" data-id="'.$row->nIdx.'" style="font-size:10px !important;" class="btn btn-xs btn-primary btnSellPrepare">디자인검토</button>';
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
                            '.Auth::user()->name.'['.$row->created_at.']
                        </li>';
                    $element .= '</ul>';
                    return $element;
                })
                ->addColumn('priceInfo', function($row){
                    $element = '<ul class="list-inline" style="width:100px;">';
                    $element .= '<li class="list-inline-item">
                            '.$row->productDetail->nProductPrice.'
                        </li><br>';
                    $element .= '<li class="list-inline-item">
                            '.$row->productDetail->nExpectedRevenue.'
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
                    $arrTemp = explode("|", $row->strOptionValue);
                    $element = '<ul class="list-inline">';
                    foreach ($arrTemp as $key => $value) {
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
                ->rawColumns(['check', 'productInfo', 'mainImage', 'marketInfo', 'priceInfo', 'marginInfo', 'optionInfo', 'action'])
                ->filter(function($query) use ($request){
                    
                    if($request->get('daterange')){
                        $dates = explode(' ~ ', $request->get('daterange'));
                        $endDate = date('Y-m-d H:i:s', strtotime($dates[1] . ' +1 day'));
                        $query->whereBetween('created_at', [$dates[0], $endDate]);
                    }
                    if($request->get('rdoMarketRegProduct') == 0){
                        $query->orWhere('bReg11thhouse', 0)
                            ->orWhere('bRegAuction', 0)
                            ->orWhere('bRegCoupang', 0)
                            ->orWhere('bRegGmarket', 0)
                            ->orWhere('bRegInterpark', 0)
                            ->orWhere('bRegLotteon', 0)
                            ->orWhere('bRegSmartstore', 0)
                            ->orWhere('bRegTmon', 0)
                            ->orWhere('bRegWemakeprice', 0);
                    }else if($request->get('rdoMarketRegProduct') == 1){
                        $query->orWhere('bReg11thhouse', 1)
                            ->orWhere('bRegAuction', 1)
                            ->orWhere('bRegCoupang', 1)
                            ->orWhere('bRegGmarket', 1)
                            ->orWhere('bRegInterpark', 1)
                            ->orWhere('bRegLotteon', 1)
                            ->orWhere('bRegSmartstore', 1)
                            ->orWhere('bRegTmon', 1)
                            ->orWhere('bRegWemakeprice', 1);
                    }
                    
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
    public function update($nIdx)
    {
        //$product  = Product::where('nIdx', $request->post('id'))->first();
        try {
            Product::find($nIdx)->update(['nProductWorkProcess' => 2]);
            return response()->json(["status" => "success", "data" => "Resource updated."]);
        }
        catch(Exception $ex)
        {
            return response()->json(["status" => "error", "data" => "Resource update error."]);
        }
        
    }
    
}
