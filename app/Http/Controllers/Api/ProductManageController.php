<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiTokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\ProductImage;
use App\Models\ProductDetail;
use App\Models\MarketSetting;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProductManageController extends ApiTokenController
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('api');
        
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function products(Request $request)
    {
        $this->checkToken($request);
        if($this->USER){
            // $products = Product::where('bIsDel', 0)
            //     ->where('nUserId', $this->USER->id)
            //     ->orderBy('nIdx', 'DESC')->get();
            $products = DB::table('tb_products')
                            ->where('tb_products.nUserId', $this->USER->id)
                            ->orderBy('tb_products.nIdx', 'DESC')
                            ->leftJoin( 'tb_product_details', 'tb_products.nIdx', '=', 'tb_product_details.nProductIdx' )->get();
            return response()->json(["status" => "success", "data" => $products]);
        }else{
            return response()->json(["status" => "failed", "data" => array()]);
        }
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function marketAccounts(Request $request)
    {
        $this->checkToken($request);
        if($this->USER){
            // $settings = MarketSetting::where('nUserId', Auth::id())
            //                     ->where('bIsDel', 0)
            //                     ->get();
            $settings = DB::table('tb_market_user_setting')
                    ->where('tb_market_user_setting.nUserId', $this->USER->id)
                    ->orderBy('tb_market_user_setting.nIdx')
                    ->leftJoin( 'tb_market_accounts', 'tb_market_user_setting.nMarketAccIdx', '=', 'tb_market_accounts.nIdx' )
                    ->leftJoin( 'tb_markets', 'tb_market_user_setting.nMarketIdx', '=', 'tb_markets.nIdx' )->get();
            return response()->json(["status" => "success", "data" => $settings]);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function items(Request $request)
    {
        $details = ProductDetail::where('bIsDel', 0)
                //->where('nUserId', Auth::id())
                ->orderBy('nIdx', 'DESC')->get();
        return response()->json(["status" => "success", "data" => $details]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function options(Request $request)
    {
        $details = ProductDetail::where('bIsDel', 0)
                //->where('nUserId', Auth::id())
                ->orderBy('nIdx', 'DESC')->get();
        return response()->json(["status" => "success", "data" => $details]);
    }
}
