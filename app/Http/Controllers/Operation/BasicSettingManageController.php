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
use App\Mylibs\CoupangConnector;
use App\Mylibs\EleventhConnector;

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
            if($set_id == 0){
                $newEndingDate = date("Y-m-d", strtotime(date("Y-m-d") . " + 1 year"));
                $marketSetting->dtSalesPeriodEndDateTime = $newEndingDate;
            }
            
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
            return view('operation.BasicSettingCoupangManageDetail', compact('marketAccounts', 'market', 'marketSetting', 'deliveryTypes', 'deliveryCompanies', 'market_id', 'set_id',  'asManuals', 'documentImages'));
        }else if($market->strMarketCode == '11thhouse'){
            $marketSetting = MarketSettingCoupang::where('bIsDel', 0)
                ->where('nUserId', Auth::id())
                ->where('nIdx', $set_id)
                ->where('bIsUsed', 1)
                ->firstOrNew();
            if($set_id == 0){
                $marketSetting->nSupportOption = 1;
                $marketSetting->nVersion = 2;
                $newEndingDate = date("Y-m-d", strtotime(date("Y-m-d") . " + 1 year"));
                $marketSetting->dtSalesPeriodEndDateTime = $newEndingDate;
                $marketSetting->strSelMinLimitTypCd = "00";
                $marketSetting->strSelLimitTypCd = "00";
                $marketSetting->strOverThenPrdNmLen = "W100";
                $marketSetting->strCrtfGrpTypCd01 = "03";
                $marketSetting->strCrtfGrpTypCd02 = "03";
                $marketSetting->strCrtfGrpTypCd03 = "03";
                $marketSetting->strCrtfGrpTypCd04 = "05";
            }
            
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
            //
            // $eleConnector = new EleventhConnector();
            //$result = $eleConnector->getCategoryListInfo();
            // $result = $eleConnector->getCategoryInfo();
            // $result = $eleConnector->getOutboundListInfo();
            return view('operation.BasicSetting11thhouseManageDetail', compact('marketAccounts', 'market', 'marketSetting', 'deliveryTypes', 'deliveryCompanies', 'market_id', 'set_id',  'asManuals', 'documentImages'));
        }else if($market->strMarketCode == 'tmon'){
            $marketSetting = MarketSettingCoupang::where('bIsDel', 0)
                ->where('nUserId', Auth::id())
                ->where('nIdx', $set_id)
                ->where('bIsUsed', 1)
                ->firstOrNew();
            if($set_id == 0){
                $newEndingDate = date("Y-m-d", strtotime(date("Y-m-d") . " + 1 year"));
                $marketSetting->dtSalesPeriodEndDateTime = $newEndingDate;
            }
            
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
            return view('operation.BasicSetting11thhouseManageDetail', compact('marketAccounts', 'market', 'marketSetting', 'deliveryTypes', 'deliveryCompanies', 'market_id', 'set_id',  'asManuals', 'documentImages'));
        }else if($market->strMarketCode == 'wemakeprice'){
            $marketSetting = MarketSettingCoupang::where('bIsDel', 0)
                ->where('nUserId', Auth::id())
                ->where('nIdx', $set_id)
                ->where('bIsUsed', 1)
                ->firstOrNew();
            if($set_id == 0){
                $newEndingDate = date("Y-m-d", strtotime(date("Y-m-d") . " + 1 year"));
                $marketSetting->dtSalesPeriodEndDateTime = $newEndingDate;
            }
            
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
            return view('operation.BasicSetting11thhouseManageDetail', compact('marketAccounts', 'market', 'marketSetting', 'deliveryTypes', 'deliveryCompanies', 'market_id', 'set_id',  'asManuals', 'documentImages'));
        }else{
            echo "기타 사이트는 점검중입니다.";
        }
        
        
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function settingSave($market_id=3, $set_id = 0, Request $request)
    {
        // $marketAccounts = MarketAccount::where('bIsDel', 0)
        //     ->where('nMarketIdx', $market_id)
        //     ->where('nUserId', Auth::id())
        //     ->get();

        // $market = Market::where('bIsDel', 0)
        //     ->where('nIdx', $market_id)
        //     ->where('bIsUsed', 1)
        //     ->first();
        
        if($market_id == 3){
            $settingCoupang = MarketSettingCoupang::updateOrCreate(
                ['nIdx' => $set_id],
                [
                    'nMarketIdx' => $request->post('market_id'),
                    'nUserId' => Auth::id(),
                    'nMarketAccIdx' => $request->post('selAccountId'),
                    'strTitle'=> $request->post('txtTitle'),
                    'nSupportOption'=> $request->post('rdoSupportOption'),
                    'nVersion'=> $request->post('rdoVersion'),
                    'nSalesAgentRate'=> $request->post('txtSalesAgentRate'),
                    'dtSalesPeriodStartDateTime'=> $request->post('txtSalesPeriodStartDateTime'),
                    'dtSalesPeriodEndDateTime'=> $request->post('txtSalesPeriodEndDateTime'),
                    'nUnitQuantity'=> $request->post('txtUnityQuantity'),
                    'nMaxQtyPerManDayLimit'=> $request->post('txtMaxQtyPerManDayLimit'),
                    'nMaxQtyPerManQtyLimit'=> $request->post('txtMaxQtyPerManQtyLimit'),
                    'bParallelImport'=> $request->post('rdoParallelImport'),
                    'bOverSeaPurchaseAgent'=> $request->post('rdoOverSeaPurchaseAgent'),///????
                    'bOnlyAdult'=> $request->post('rdoOnlyAdult'),
                    'nImageProcessType'=> $request->post('rdoImageProcessType'),
                    'nDeliveryType'=> $request->post('selDeliveryType'),
                    'nPersonPassingCodeType'=> $request->post('rdoPersonPassingCodeType'),
                    'strUnionDeliveryType'=> $request->post('selUnionDeliveryType'),
                    'nUnionDeliveryQty'=> $request->post('txtUnionDeliveryQty'),
                    'nRemoteAreaDeliveryType'=> $request->post('rdoRemoteAreaDeliveryType'),
                    'nOutboundShippingTimeDay'=> $request->post('txtOutboundShippingTimeDay'),
                    'strOutboundShippingPlaceCode'=> $request->post('txtOutboundShippingPlaceCode'),
                    'strDeliveryCompanyCode'=> $request->post('selDeliveryCompanyCode'),
                    'strDeliveryChargeType'=> $request->post('selDeliveryChargeType'),
                    'nDeliveryCharge'=> $request->post('txtDeliveryCharge'),
                    'nFreeShipOverAmount'=> $request->post('txtFreeShipOverAmount'),
                    'nDeliveryChargeOnReturn'=> $request->post('txtDeliveryChargeOnReturn'),
                    'nReturnDeliveryCharge'=> $request->post('txtReturnDeliveryCharge'),
                    'nJejuDeliveryCharge'=> $request->post('txtJejuDeliveryCharge'),
                    'nNotJejuDeliveryCharge'=> $request->post('txtNotJejuDeliveryCharge'),
                    'strReturnCenterCode'=> $request->post('txtReturnCenterCode'),
                    'strReturnSellerName'=> $request->post('txtReturnSellerName'),
                    'strCompanyContactNumber'=> $request->post('txtCompanyContactNumber'),
                    'strReturnZipCode'=> $request->post('txtReturnZipCode'),
                    'strReturnAddress'=> $request->post('txtReturnAddress'),
                    'strReturnAddressDetail'=> $request->post('txtReturnAddressDetail'),
                    'strExchangeType'=> $request->post('rdoExchangeType'),
                    'strReturnChargeVendorType'=> $request->post('rdoReturnChargeVendorType'),
                    'strAfterServiceGuideType'=> $request->post('selAfterServiceGuideType'),
                    'strAfterServiceGuide'=> $request->post('txtAfterServiceGuide'),
                    'strAfterServiceContactNumber'=> $request->post('txtAfterServiceContactNumber'),
                    'nRequireDocument1'=> $request->post('selRequireDocument1'),
                    'nRequireDocument2'=> $request->post('selRequireDocument2'),
                    'nRequireDocument3'=> $request->post('selRequireDocument3'),
                    'nRequireDocument4'=> $request->post('selRequireDocument4'),
                    'nRequireDocument5'=> $request->post('selRequireDocument5'),
                    'nRequireDocument6'=> $request->post('selRequireDocument6'),
                    'nTopImageIdx'=> $request->post('selTopImage'),
                    'nDownImageIdx'=> $request->post('selDownImage'),
                    'bIsUsed'=> $request->post('rdoIsUsed'),
                    'bIsDel'=> 0,
                ]
            );
            $set_id = $settingCoupang->nIdx;
            return redirect("/operationBasicSettingManage/{$market_id}/setting/{$set_id}");
            //return view('operation.BasicSettingManageDetail', compact('marketAccounts', 'market', 'marketSetting', 'deliveryTypes', 'deliveryCompanies', 'market_id', 'set_id',  'asManuals', 'documentImages'));
        }else if ($market_id == 1){//11번가
            print_r($request->input());
            $settingCoupang = MarketSettingCoupang::updateOrCreate(
                ['nIdx' => $set_id],
                [
                    'nMarketIdx' => $request->post('market_id'),
                    'nUserId' => Auth::id(),
                    'nMarketAccIdx' => $request->post('selAccountId'),
                    'strTitle'=> $request->post('txtTitle'),
                    'nSupportOption'=> $request->post('rdoSupportOption'),
                    'nVersion'=> $request->post('rdoVersion'),
                    'nImageProcessType' => $request->post('rdoImageProcessType'),
                    'nTopImageIdx'=> $request->post('selTopImage'),
                    'nDownImageIdx'=> $request->post('selDownImage'),
                    'bIsUsed'=> $request->post('rdoIsUsed'),
                    'bIsDel'=> 0,
                    'strSelMnbdNckNm' => $request->post('txtSelMnbdNckNm'),
                    'strSelMthdCd' => $request->post('rdoSelMthdCd'),
                    'strPrdTypCd' => $request->post('selPrdTypCd'),
                    'strForAbrdBuyClf' => $request->post('rdoForAbrdBuyClf'),
                    'strPrdStatCd' => $request->post('rdoPrdStatCd'),
                    'strSelTermUseYn' => $request->post('rdoSelTermUseYn'),
                    'strSelPrdClfCd' => $request->post('selSelPrdClfCd'),
                    'dtAplBgnDy' => $request->post('txtAplBgnDy'),
                    'dtAplEndDy' => $request->post('txtAplEndDy'),
                    'strSelMinLimitTypCd' => $request->post('rdoSelMinLimitTypCd'),
                    'nSelMinLimitQty' => $request->post('txtSelMinLimitQty'),
                    'strSelLimitTypCd' => $request->post('rdoSelLimitTypCd'),
                    'nSelLimitQty' => $request->post('txtSelLimitQty'),
                    'nTownSelLmtDy' => $request->post('txtTownSelLmtDy'),
                    'nTownSelLmtQty' => $request->post('txtTownSelLmtQty'),
                    'strOverThenPrdNmLen' => $request->post('rdoOverThenPrdNmLen'),
                    'strAbrdBuyPlace' => $request->post('selAbrdBuyPlace'),
                    'strSuplDtyfrPrdClfCd' => $request->post('rdoSuplDtyfrPrdClfCd'),
                    'strCrtfGrpTypCd01' => $request->post('rdoCrtfGrpTypCd01'),
                    'strCrtfGrpTypCd02' => $request->post('rdoCrtfGrpTypCd02'),
                    'strCrtfGrpTypCd03' => $request->post('rdoCrtfGrpTypCd03'),
                    'strCrtfGrpTypCd04' => $request->post('rdoCrtfGrpTypCd04'),
                    'strDlvCnAreaCd' => $request->post('selDlvCnAreaCd'),
                    'strDlvWyCd' => $request->post('selDlvWyCd'),
                    'strDlvEtprsCd' => $request->post('selDlvEtprsCd'),
                    'strSendClfCdDmy' => $request->post('rdoSendClfCdDmy'),
                    'strDlvSendCloseTmpltNo' => $request->post('txtDlvSendCloseTmpltNo'),
                    'strAddrSeqOutAddr' => $request->post('txtAddrSeqOutAddr'),
                    'strAddrSeqInAddr' => $request->post('txtAddrSeqInAddr'),
                    'strDlvCstInstBasiCd' => $request->post('rdoDlvCstInstBasiCd'),
                    'strBndlDlvCnYn01' => $request->post('selBndlDlvCnYn01'),
                    'strDlvCstPayTypCd' => $request->post('selDlvCstPayTypCd'),
                    'nDlvCst1_03' => $request->post('txtDlvCst1_03'),
                    'nPrdFrDlvBasiAmt' => $request->post('txtPrdFrDlvBasiAmt'),
                    'nDlvCst3_0' => $request->post('txtDlvCst3')[0],
                    'nDlvCst3_1' => $request->post('txtDlvCst3')[1],
                    'nDlvCst3_2' => $request->post('txtDlvCst3')[2],
                    'nDlvCst3_3' => $request->post('txtDlvCst3')[3],
                    'nDlvCst3_4' => $request->post('txtDlvCst3')[4],
                    'nDlvCnt1_0' => $request->post('txtDlvCnt1')[0],
                    'nDlvCnt1_1' => $request->post('txtDlvCnt1')[1],
                    'nDlvCnt1_2' => $request->post('txtDlvCnt1')[2],
                    'nDlvCnt1_3' => $request->post('txtDlvCnt1')[3],
                    'nDlvCnt1_4' => $request->post('txtDlvCnt1')[4],
                    'nDlvCnt2_0' => $request->post('txtDlvCnt2')[0],
                    'nDlvCnt2_1' => $request->post('txtDlvCnt2')[1],
                    'nDlvCnt2_2' => $request->post('txtDlvCnt2')[2],
                    'nDlvCnt2_3' => $request->post('txtDlvCnt2')[3],
                    'nDlvCnt2_4' => $request->post('txtDlvCnt2')[4],
                    'strBndlDlvCnYn04' => $request->post('selBndlDlvCnYn04'),
                    'nDlvCst4' => $request->post('txtDlvCst4'),
                    'nDlvCst1_02' => $request->post('txtDlvCst1_02'),
                    'strBndlDlvCnYn02' => $request->post('selBndlDlvCnYn02'),
                    'strDlvCstInfoCd' => $request->post('selDlvCstInfoCd'),
                    'strUseIslandJejuDlvCst' => $request->has('chkUseIslandJejuDlvCst') ? 'Y' : 'N',
                    'nJejuDlvCst' => $request->post('txtJejuDlvCst'),
                    'nIslandDlvCst' => $request->post('txtIslandDlvCst'),
                    'nRtngdDlvCst' => $request->post('txtRtngdDlvCst'),
                    'strRtngdDlvCd' => $request->post('rdoRtngdDlvCd'),
                    'nExchDlvCst' => $request->post('txtExchDlvCst'),
                    'strAsDetail' => $request->post('txtAsDetail'),
                    'strRtngExchDetail' => $request->post('txtRtngExchDetail'),
                    'strAdvrtStmt' => $request->post('txtAdvrtStmt'),
                    'strPrcCmpExpYn' => $request->post('rdoPrcCmpExpYn'),
                    'strReviewDispYn' => $request->post('rdoReviewDispYn'),
                    'strReviewOptDispYn' =>$request->has('chkReviewOptDispYn') ? 'Y': 'N',
                    'strCuponcheck' => $request->has('chkCuponcheck') ? 'Y': 'N',
                    'nDscAmtPercnt' => $request->post('txtDscAmtPercnt'),
                    'strCupnDscMthdCd' => $request->post('selCupnDscMthdCd'),
                    'dtCupnIssStartDy' => $request->post('txtCupnIssStartDy'),
                    'strCupnUseLmtDyYn' => $request->has('chkCupnUseLmtDyYn') ? 'Y' : 'N',
                    'dtCupnIssEndDy' => $request->post('txtCupnIssEndDy'),
                    'nCupnMinPrice' => $request->post('txtCupnMinPrice'),
                    'strPay11YN' => $request->has('chkPay11YN') ? 'Y' : 'N',
                    'nPay11Value' => $request->post('txtPay11Value'),
                    'strPay11WyCd' => $request->post('selPay11WyCd'),
                    'strIntFreeYN' => $request->has('chkIntFreeYN') ? 'Y' : 'N',
                    'strPluYN' => $request->has('chkPluYN') ? 'Y' : 'N',
                    'strPluDscBasis' => $request->post('selPluDscBasis'),
                    'nPluDscBasis' => $request->post('txtPluDscBasis'),
                    'nPluDscAmtPercnt' => $request->post('txtPluDscAmtPercnt'),
                    'strPluDscMthdCd' => $request->post('selPluDscMthdCd'),
                    'strPluUseLmtDyYn' => $request->has('chkPluUseLmtDyYn') ? 'Y' : 'N',
                    'dtPluIssStartDy' => $request->post('txtPluIssStartDy'),
                    'dtPluIssEndDy' => $request->post('txtPluIssEndDy'),
                    'strHopeShpYn' => $request->has('chkHopeShpYn') ? 'Y' : 'N',
                    'nHopeShpPnt' => $request->post('txtHopeShpPnt'),
                    'strHopeShpWyCd' => $request->post('selHopeShpWyCd'),
                    'nHopeShpMinPrice' => $request->post('txtHopeShpMinPrice'),
                ]
            );
            $set_id = $settingCoupang->nIdx;
            return redirect("/operationBasicSettingManage/{$market_id}/setting/{$set_id}");
        }
    }
    
    /**
     * Display the specified resource.
     *
     */
    public function searchOutboundShippingPlace($market_id = 0, $accountId = 0)
    {
        //출고지 목록
        $market = Market::where('nIdx', $market_id)->first();
        $marketAccount  = MarketAccount::where('nIdx', $accountId)->first();
        $outbouds = array();
        $strMarketCode = $market->strMarketCode;
        if($market->strMarketCode == "coupang"){
            $coupang = new CoupangConnector($marketAccount->strAPIAccessKey, $marketAccount->strSecretKey, $marketAccount->strVendorId, $marketAccount->strAccountId);
            $result = $coupang->getOutboundShippingCenterList();
            $resArr = (array)json_decode($result, true);
            $outbouds = $resArr['content'];
        }else{
            $_11thhouse = new EleventhConnector($marketAccount->strAPIAccessKey, $marketAccount->marketAccount->strAccountId, $marketAccount->marketAccount->strAccountPwd);
            //$outbouds = $_11thhouse->getOutboundListInfo();
            $_11thhouse->addProduct();
            //$resArr = (array)json_decode($result, true);
            //$outbouds = $resArr['content'];
        }
        // return response()->json(["status" => "success", "data" => $resArr]);
        return view('operation.OutboundShippingPlaceList', compact('strMarketCode', 'outbouds'));
    }

    /**
     * Display the specified resource.
     *
     */
    public function searchReturnShippingCenter($market_id = 0, $accountId = 0)
    {
        //반품지목록
        $market = Market::where('nIdx', $market_id)->first();
        $marketAccount  = MarketAccount::where('nIdx', $accountId)->first();
        $returnCenters = array();
        $strMarketCode = $market->strMarketCode;
        if($market->strMarketCode == "coupang"){
            $coupang = new CoupangConnector($marketAccount->strAPIAccessKey, $marketAccount->strSecretKey, $marketAccount->strVendorId, $marketAccount->strAccountId);
            $result = $coupang->getReturnShippingCenterList();
            $resArr = (array)json_decode($result, true);
            $returnCenters = $resArr['data']['content'];
        }else if($market->strMarketCode == "11thhouse"){
            $_11thhouse = new EleventhConnector($marketAccount->strAPIAccessKey, $marketAccount->marketAccount->strAccountId, $marketAccount->marketAccount->strAccountPwd);
            $returnCenters = $_11thhouse->getInboundListInfo();
        }
        return view('operation.ReturnShippingCenterList', compact('strMarketCode', 'returnCenters'));
    }

    /**
     * 11번가 발송 템플렛
     *
     */
    public function search11thSendCloseTpl($market_id = 0, $accountId = 0)
    {
        //발송템플렛
        $market = Market::where('nIdx', $market_id)->first();
        $marketAccount  = MarketAccount::where('nIdx', $accountId)->first();
        $sendCloseTpls = array();
        $strMarketCode = $market->strMarketCode;
        if($market->strMarketCode == "11thhouse"){
            $_11thhouse = new EleventhConnector($marketAccount->strAPIAccessKey, $marketAccount->marketAccount->strAccountId, $marketAccount->marketAccount->strAccountPwd);
            $sendCloseTpls = $_11thhouse->getSendCloseTplListInfo();
        }
        return view('operation.SendCloseTplList', compact('strMarketCode', 'sendCloseTpls'));
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
    public function settingDelete($marketId, $setId)
    {
        //
        $market = Market::find($marketId);
        if($market->strMarketCode == 'coupang'){
            MarketSettingCoupang::find($setId)->delete();
            return response()->json(["status" => "success", "data" => "Successfully removed!"]);
        }
    }
}
