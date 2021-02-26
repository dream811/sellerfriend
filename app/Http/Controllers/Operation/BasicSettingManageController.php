<?php

namespace App\Http\Controllers\Operation;

use App\Http\Controllers\Controller;
use App\Models\AsManual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\Market;
use App\Models\MarketAccount;
use App\Models\MarketSettingCoupang;
use App\Models\DeliveryType;
use App\Models\DeliveryCompany;
use App\Models\DocumentImage;

class BasicSettingManageController extends Controller
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
        
        $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default

        $title = "기초설정관리";
        $settingCoupangs = MarketSettingCoupang::where('nUserId', Auth::id())
                ->where('bIsDel', 0)
                ->where('bIsUsed', 1)
                ->get();
        $markets = Market::where('bIsDel', 0)
                ->where('bIsUsed', 1)
                ->get();

        return view('operation.BasicSettingManageList', compact('title', 'settingCoupangs', 'markets'))
          ->with('i', (request()->input('page', 1) - 1) * 15);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function setting($market_id = 0, $set_id = 0)
    {
        $marketAccounts = MarketAccount::where('bIsDel', 0)
            ->where('nMarketIdx', $market_id)
            ->where('nUserId', Auth::id())
            ->get();

        $market = Market::where('bIsDel', 0)
            ->where('nIdx', $market_id)
            ->where('bIsUsed', 1)
            ->first();
        if($market->strMarketCode == 'coupang'){
            $marketSetting = MarketSettingCoupang::where('bIsDel', 0)
                ->where('nUserId', Auth::id())
                ->where('nIdx', $set_id)
                ->where('bIsUsed', 1)
                ->firstOrNew();
            $deliveryTypes = DeliveryType::where('bIsDel', 0)
                ->where('nMarketIdx', $market->nIdx)
                ->get();
            $deliveryCompanies = DeliveryCompany::where('bIsDel', 0)
                ->where('nMarketIdx', $market->nIdx)
                ->get();
            $asManuals = AsManual::where('bIsDel', 0)
                ->get(); 
            $documentImages = DocumentImage::where('bIsDel', 0)
                ->where('nUserId', Auth::id())
                ->get();
            return view('operation.BasicSettingManageDetail', compact('marketAccounts', 'market', 'marketSetting', 'deliveryTypes', 'deliveryCompanies', 'set_id',  'asManuals', 'documentImages'));
        }else{
            echo "현재 쿠팡만 운영중입니다.";
        }
        
        
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function settingSave($marketId=0, Request $request)
    {
        $marketAccount = new MarketAccount([
            'nMarketIdx' => $marketId,
            'nUserId' => Auth::id(),
            'strAccountId' => $request->post('txtAccountId'),
            'strAccountPwd'=> $request->post('txtAccountPwd'),
            'strVendorId'=> $request->post('txtVendorId'),
            'strAPIAccessKey'=> $request->post('txtAPIAccessKey'),
            'strSecretKey'=> $request->post('txtSecretKey'),
            'bIsUsed'=> 1,
            'bIsDel'=> 0
        ]);
		$marketAccount->save();    
        return response()->json(["status" => "success", "data" => $marketAccount]);
    }
    /**
     * Display the specified resource.
     *
     */
    public function accountShow($marketId = 0, $accountId = 0)
    {
        //
        $marketAccount  = MarketAccount::where('nIdx', $accountId)->first();
        return response()->json(["status" => "success", "data" => $marketAccount]);
    }

    public function accountUpdate($marketId=0, $accountId=0, Request $request)
    {
        $marketAccount = MarketAccount::find($accountId);
        $marketAccount->strAccountId = $request->post('txtAccountId');
        $marketAccount->strAccountPwd = $request->post('txtAccountPwd');
        $marketAccount->strAPIAccessKey = $request->post('txtAPIAccessKey');
        $marketAccount->strSecretKey = $request->post('txtSecretKey');
        $marketAccount->update();
        return response()->json(["status" => "success", "data" => $marketAccount]);
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
        $marketAccount = MarketAccount::where('nIdx', $accountId)->delete();
        return response()->json(["status" => "success", "data" => $marketAccount]);
    }

}
