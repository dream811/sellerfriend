<?php

namespace App\Http\Controllers\Operation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\Market;
use App\Models\MarketAccount;

class OpenMarketManageController extends Controller
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

        $title = "오픈마켓계정관리";
        $markets = Market::where('bIsDel', 0)
               ->orderBy('strMarketCode')->paginate(15);
        return view('operation.OpenMarketAccountManage', compact('title', 'markets'))
           ->with('i', (request()->input('page', 1) - 1) * 15);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function accounts($marketId = 0)
    {
        
        $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default

        $title = "오픈마켓계정관리";
       
        $marketAccounts = MarketAccount::where('bIsDel', 0)
                ->where('nMarketIdx', $marketId)
                ->where('nUserId', Auth::id())
                ->orderBy('nIdx')->get();
        // return view('operation.OpenMarketAccountManage', compact('title', 'markets'))
        //    ->with('i', (request()->input('page', 1) - 1) * 15);

        return response()->json(["status" => "success", "data" => $marketAccounts]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function accountSave($marketId=0, Request $request)
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
