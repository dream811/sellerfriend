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
use App\Models\Come;
use App\Models\Brand;
use App\Models\Category;
use DataTables;
use App\MyLibs\CoupangConnector;

class ProductGetManageController extends Controller
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
        $title = "상품수집관리";
        
        if ($request->ajax()) {
            $products = Product::where('bIsDel', 0)
                ->where('nUserId', Auth::id())
                ->where('nProductWorkProcess', 0)
                ->orderBy('nIdx');

            return Datatables::eloquent($products)
                    ->addIndexColumn()
                    ->addColumn('check', function($row){
                        $check = '<input type="checkbox" name="chkProduct[]" onclick="$(this).val(this.checked ? 1 : 0)" value="'.$row->nIdx.'" id="example-select-all">';
                        return $check;
                    })
                    ->addColumn('action', function($row){
                        $btn = '';
                        return $btn;
                    })
                    ->addColumn('images', function($row){
                        $btn = '<ul class="list-inline" style="width:100px;">';
                        foreach ($row->productImages as $productImage) {
                            $btn .= '<li class="list-inline-item">
                                        <img alt="Avatar" class="table-avatar" src="'.$productImage->strUrl.'">
                                    </li>';
                        }
                        $btn .= '</ul>';
                        return $btn;
                    })
                    ->addColumn('productInfo', function($row){
                        $element = '<ul class="list-inline" style="">';
                        $element .= '<li class="list-inline-item">
                                    '.$row->nCategoryCode1.'>'.$row->nCategoryCode2.'>'.$row->nCategoryCode3.'>'.$row->nCategoryCode4.'
                                </li><br>';
                        $element .= '<li class="list-inline-item">
                                    '.$row->strKrSubName.'
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
                                '.$row->productDetail->nBasePrice.'
                            </li>';
                                
                        $element .= '</ul>';
                        return $element;
                    })
                    ->addColumn('marginInfo', function($row){
                        $element = '<ul class="list-inline" style="width:100px;">';
                        $element .= '<li class="list-inline-item">
                                '.$row->productDetail->nBasePrice.'
                            </li><br>';
                        $element .= '<li class="list-inline-item">
                                '.$row->productDetail->nBasePrice.'
                            </li>';
                                
                        $element .= '</ul>';
                        return $element;
                    })
                    ->addColumn('marketInfo', function($row){
                        $marketInfo = '<span style="width:20px;" class="badge badge-success">C</span>
                                <span style="width:20px;" class="badge badge-success">11</span>
                                <span style="width:20px;" class="badge badge-success">A</span>
                                <span style="width:20px;" class="badge badge-success">G</span>
                                <br/>
                                <span style="width:20px;" class="badge badge-success">I</span>
                                <span style="width:20px;" class="badge badge-success">S</span>
                                <span style="width:20px;" class="badge badge-success">T</span>
                                <span style="width:20px;" class="badge badge-success">W</span>
                                ';
                        return $marketInfo;
                    })
                    ->addColumn('mainImage', function($row){
                        $btn = '<img alt="Avatar" style="width: 5rem;" class="table-product-image" src="'.asset('assets/images/product/image.jpg').'">';
                        return $btn;
                    })
                    ->rawColumns(['check', 'productInfo', 'mainImage', 'marketInfo', 'priceInfo', 'marginInfo'])
                    ->make(true);
                    
        }
        return view('scratch.ProductGetManage', compact('title', 'brands', 'comes', 'categories_1', 'categories_2', 'categories_3', 'categories_4', 'shareType', 'basePriceTypes', 'countryShippingCostTypes', 'worldShippingCostTypes', 'weightTypes'));
    }

    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addMarketProduct(Request $request)
    {
        //$product  = Product::where('nIdx', $request->post('id'))->first();
        $product  = Product::where('nIdx', 1)->first();
        $coupang = new CoupangConnector();
        $coupang->addProduct();
        //return response()->json(["status" => "success", "data" => $marketAccount]);
    }
    /**
     * Display the specified resource.
     *
     */
    public function accountShow($marketId = 0, $accountId = 0)
    {
        //
        // $marketAccount  = MarketAccount::where('nIdx', $accountId)->first();
        return response()->json(["status" => "success", "data" => $marketAccount]);
    }

    public function accountUpdate($marketId=0, $accountId=0, Request $request)
    {
        // $marketAccount = MarketAccount::find($accountId);
        // $marketAccount->strAccountId = $request->post('txtAccountId');
        // $marketAccount->strAccountPwd = $request->post('txtAccountPwd');
        // $marketAccount->strAPIAccessKey = $request->post('txtAPIAccessKey');
        // $marketAccount->update();
        return response()->json(["status" => "success", "data" => $marketAccount]);

        // $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default

        // $title = "오픈마켓계정관리";
       
        // $marketAccounts = MarketAccount::where('bIsDel', 0)
        //         ->where('nMarketIdx', $id)
        //         ->where('nUserId', Auth::id())
        //         ->orderBy('nIdx')->paginate(15);
              //dd($markets);
        // return view('operation.OpenMarketAccountManage', compact('title', 'markets'))
        //    ->with('i', (request()->input('page', 1) - 1) * 15);
        //return response()->json(["status" => "success", "data" => $marketAccount]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $accountId
     * @return \Illuminate\Http\Response
     */
    public function accountDelete($marketId, $accountId)
    {
        //
        //$marketAccount = MarketAccount::where('nIdx', $accountId)->delete();
        return response()->json(["status" => "success", "data" => $marketAccount]);
    }
}
