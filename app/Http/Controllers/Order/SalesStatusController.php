<?php

namespace App\Http\Controllers\Order;

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

class SalesStatusController extends Controller
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

        $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default

        $title = "판매현황";
        
        
        return view('order.SalesStatusManage');
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
        
        //dd($categories_1);
        return view('product.MarketCategorySearch', compact('marketCode', 'categories_1'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function add(Request $request)
    {
        //$product  = Product::where('nIdx', $request->post('id'))->first();
        $product  = Product::where('nIdx', 1)->first();
        $coupang = new CoupangConnector();
        //$coupang->getCategoryInfoViaCode(56174);
        $coupang->getCategoryMetaInfo(0);
        // $coupang->getCategoryListInfo();
        // $coupang->addOutboundShippingCenter();
        // $coupang->addReturnShippingCenter();
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
        //$product  = Product::where('nIdx', $request->post('id'))->first();
        $product  = Product::where('nIdx', 1)->first();
        $coupang = new CoupangConnector();
        //$coupang->getCategoryInfoViaCode(56174);
        $coupang->getCategoryMetaInfo(56174);
        // $coupang->getCategoryListInfo();
        // $coupang->addOutboundShippingCenter();
        // $coupang->addReturnShippingCenter();
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
