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
use App\Models\Category11thGlobal;
use App\Models\Category11thNormal;
use App\Models\CategoryAuction;
use App\Models\CategoryCoupang;
use App\Models\CategoryGmarket;
use App\Models\CategoryInterPark;
use App\Models\CategorySmartStore;
use App\Models\CategorySolution;
use App\Models\CategoryWeMakePrice;
use App\Models\WeightType;
use App\Models\MoneyType;
use Exception;
use Laravel\Ui\Presets\React;

class ProductScrapperController extends Controller
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

        $title = "상품스크랩";
        return view('scratch.ProductScrapper', compact('title'));
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
        curl_setopt($cURLConnection, CURLOPT_URL, 'http://localhost:8004/url='.$scrapURL);
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cURLConnection, CURLOPT_CONNECTTIMEOUT, 0); 
        curl_setopt($cURLConnection, CURLOPT_TIMEOUT, 400); //timeout in seconds
        $result = curl_exec($cURLConnection);
        curl_close($cURLConnection);
        //$result='{"valItemInfo":{"skuList":[{"names":"170 9666黑色 ","pvs":"20509:137291;1627207:35216916","skuId":"3922991501701"},{"names":"175 9666黑色 ","pvs":"20509:137292;1627207:35216916","skuId":"3922991501702"},{"names":"180 9666黑色 ","pvs":"20509:44722;1627207:35216916","skuId":"3922991501703"},{"names":"185 9666黑色 ","pvs":"20509:137293;1627207:35216916","skuId":"3922991501704"},{"names":"190 9666黑色 ","pvs":"20509:3286454;1627207:35216916","skuId":"3922991501705"},{"names":"195 9666黑色 ","pvs":"20509:1071;1627207:35216916","skuId":"3922991501706"},{"names":"170 1905黑色 ","pvs":"20509:137291;1627207:28663874","skuId":"3922991501707"},{"names":"175 1905黑色 ","pvs":"20509:137292;1627207:28663874","skuId":"3922991501708"},{"names":"180 1905黑色 ","pvs":"20509:44722;1627207:28663874","skuId":"3922991501709"},{"names":"185 1905黑色 ","pvs":"20509:137293;1627207:28663874","skuId":"3922991501710"},{"names":"190 1905黑色 ","pvs":"20509:3286454;1627207:28663874","skuId":"3922991501711"},{"names":"195 1905黑色 ","pvs":"20509:1071;1627207:28663874","skuId":"3922991501712"},{"names":"170 1905米色 ","pvs":"20509:137291;1627207:87264677","skuId":"4622888866839"},{"names":"175 1905米色 ","pvs":"20509:137292;1627207:87264677","skuId":"4622888866845"},{"names":"180 1905米色 ","pvs":"20509:44722;1627207:87264677","skuId":"4622888866863"},{"names":"185 1905米色 ","pvs":"20509:137293;1627207:87264677","skuId":"4622888866851"},{"names":"190 1905米色 ","pvs":"20509:3286454;1627207:87264677","skuId":"4622888866857"},{"names":"195 1905米色 ","pvs":"20509:1071;1627207:87264677","skuId":"4622888866833"},{"names":"170 1909黑色 ","pvs":"20509:137291;1627207:7369958","skuId":"4622888866837"},{"names":"175 1909黑色 ","pvs":"20509:137292;1627207:7369958","skuId":"4622888866843"},{"names":"180 1909黑色 ","pvs":"20509:44722;1627207:7369958","skuId":"4622888866861"},{"names":"185 1909黑色 ","pvs":"20509:137293;1627207:7369958","skuId":"4622888866849"},{"names":"190 1909黑色 ","pvs":"20509:3286454;1627207:7369958","skuId":"4622888866855"},{"names":"195 1909黑色 ","pvs":"20509:1071;1627207:7369958","skuId":"4622888866831"},{"names":"170 1909米色 ","pvs":"20509:137291;1627207:147077234","skuId":"4622888866836"},{"names":"175 1909米色 ","pvs":"20509:137292;1627207:147077234","skuId":"4622888866842"},{"names":"180 1909米色 ","pvs":"20509:44722;1627207:147077234","skuId":"4622888866860"},{"names":"185 1909米色 ","pvs":"20509:137293;1627207:147077234","skuId":"4622888866848"},{"names":"190 1909米色 ","pvs":"20509:3286454;1627207:147077234","skuId":"4622888866854"},{"names":"195 1909米色 ","pvs":"20509:1071;1627207:147077234","skuId":"4622888866830"},{"names":"170 1988黑色 ","pvs":"20509:137291;1627207:132596882","skuId":"4622888866835"},{"names":"175 1988黑色 ","pvs":"20509:137292;1627207:132596882","skuId":"4622888866841"},{"names":"180 1988黑色 ","pvs":"20509:44722;1627207:132596882","skuId":"4622888866859"},{"names":"185 1988黑色 ","pvs":"20509:137293;1627207:132596882","skuId":"4622888866847"},{"names":"190 1988黑色 ","pvs":"20509:3286454;1627207:132596882","skuId":"4622888866853"},{"names":"195 1988黑色 ","pvs":"20509:1071;1627207:132596882","skuId":"4622888866829"},{"names":"170 1988灰色 ","pvs":"20509:137291;1627207:761664726","skuId":"4622888866838"},{"names":"175 1988灰色 ","pvs":"20509:137292;1627207:761664726","skuId":"4622888866844"},{"names":"180 1988灰色 ","pvs":"20509:44722;1627207:761664726","skuId":"4622888866862"},{"names":"185 1988灰色 ","pvs":"20509:137293;1627207:761664726","skuId":"4622888866850"},{"names":"190 1988灰色 ","pvs":"20509:3286454;1627207:761664726","skuId":"4622888866856"},{"names":"195 1988灰色 ","pvs":"20509:1071;1627207:761664726","skuId":"4622888866832"}],"defSelected":[],"skuMap":{";20509:137293;1627207:761664726;":{"priceCent":99800,"price":"998.00","stock":989,"skuId":"4622888866850"},";20509:1071;1627207:35216916;":{"priceCent":99800,"price":"998.00","stock":961,"skuId":"3922991501706"},";20509:137291;1627207:35216916;":{"priceCent":99800,"price":"998.00","stock":947,"skuId":"3922991501701"},";20509:44722;1627207:761664726;":{"priceCent":99800,"price":"998.00","stock":987,"skuId":"4622888866862"},";20509:44722;1627207:28663874;":{"priceCent":99800,"price":"998.00","stock":934,"skuId":"3922991501709"},";20509:137293;1627207:147077234;":{"priceCent":99800,"price":"998.00","stock":996,"skuId":"4622888866848"},";20509:137293;1627207:28663874;":{"priceCent":99800,"price":"998.00","stock":973,"skuId":"3922991501710"},";20509:137292;1627207:761664726;":{"priceCent":99800,"price":"998.00","stock":988,"skuId":"4622888866844"},";20509:137292;1627207:147077234;":{"priceCent":99800,"price":"998.00","stock":998,"skuId":"4622888866842"},";20509:137291;1627207:761664726;":{"priceCent":99800,"price":"998.00","stock":997,"skuId":"4622888866838"},";20509:137293;1627207:132596882;":{"priceCent":99800,"price":"998.00","stock":993,"skuId":"4622888866847"},";20509:44722;1627207:7369958;":{"priceCent":99800,"price":"998.00","stock":986,"skuId":"4622888866861"},";20509:44722;1627207:147077234;":{"priceCent":99800,"price":"998.00","stock":996,"skuId":"4622888866860"},";20509:137292;1627207:132596882;":{"priceCent":99800,"price":"998.00","stock":995,"skuId":"4622888866841"},";20509:1071;1627207:7369958;":{"priceCent":99800,"price":"998.00","stock":997,"skuId":"4622888866831"},";20509:137292;1627207:7369958;":{"priceCent":99800,"price":"998.00","stock":986,"skuId":"4622888866843"},";20509:137291;1627207:132596882;":{"priceCent":99800,"price":"998.00","stock":998,"skuId":"4622888866835"},";20509:137293;1627207:87264677;":{"priceCent":99800,"price":"998.00","stock":989,"skuId":"4622888866851"},";20509:1071;1627207:28663874;":{"priceCent":99800,"price":"998.00","stock":994,"skuId":"3922991501712"},";20509:3286454;1627207:87264677;":{"priceCent":99800,"price":"998.00","stock":999,"skuId":"4622888866857"},";20509:3286454;1627207:28663874;":{"priceCent":99800,"price":"998.00","stock":988,"skuId":"3922991501711"},";20509:44722;1627207:132596882;":{"priceCent":99800,"price":"998.00","stock":992,"skuId":"4622888866859"},";20509:44722;1627207:35216916;":{"priceCent":99800,"price":"998.00","stock":771,"skuId":"3922991501703"},";20509:137291;1627207:28663874;":{"priceCent":99800,"price":"998.00","stock":991,"skuId":"3922991501707"},";20509:1071;1627207:147077234;":{"priceCent":99800,"price":"998.00","stock":999,"skuId":"4622888866830"},";20509:137293;1627207:7369958;":{"priceCent":99800,"price":"998.00","stock":991,"skuId":"4622888866849"},";20509:1071;1627207:761664726;":{"priceCent":99800,"price":"998.00","stock":994,"skuId":"4622888866832"},";20509:3286454;1627207:147077234;":{"priceCent":99800,"price":"998.00","stock":998,"skuId":"4622888866854"},";20509:137291;1627207:87264677;":{"priceCent":99800,"price":"998.00","stock":998,"skuId":"4622888866839"},";20509:1071;1627207:87264677;":{"priceCent":99800,"price":"998.00","stock":1000,"skuId":"4622888866833"},";20509:3286454;1627207:7369958;":{"priceCent":99800,"price":"998.00","stock":999,"skuId":"4622888866855"},";20509:137292;1627207:35216916;":{"priceCent":99800,"price":"998.00","stock":776,"skuId":"3922991501702"},";20509:3286454;1627207:35216916;":{"priceCent":99800,"price":"998.00","stock":960,"skuId":"3922991501705"},";20509:44722;1627207:87264677;":{"priceCent":99800,"price":"998.00","stock":996,"skuId":"4622888866863"},";20509:3286454;1627207:132596882;":{"priceCent":99800,"price":"998.00","stock":999,"skuId":"4622888866853"},";20509:3286454;1627207:761664726;":{"priceCent":99800,"price":"998.00","stock":996,"skuId":"4622888866856"},";20509:137292;1627207:28663874;":{"priceCent":99800,"price":"998.00","stock":956,"skuId":"3922991501708"},";20509:137293;1627207:35216916;":{"priceCent":99800,"price":"998.00","stock":861,"skuId":"3922991501704"},";20509:137291;1627207:147077234;":{"priceCent":99800,"price":"998.00","stock":1000,"skuId":"4622888866836"},";20509:1071;1627207:132596882;":{"priceCent":99800,"price":"998.00","stock":998,"skuId":"4622888866829"},";20509:137292;1627207:87264677;":{"priceCent":99800,"price":"998.00","stock":992,"skuId":"4622888866845"},";20509:137291;1627207:7369958;":{"priceCent":99800,"price":"998.00","stock":998,"skuId":"4622888866837"}},"salesProp":{}},"valLoginIndicator":"//buy.taobao.com/auction/buy.htm?from=itemDetail&id=582939044915","isShowSizeRecommend":false,"isDoubleElevenItem":true,"isHouseholdService":false,"isSevenDaysRefundment":false,"apiBidCount":"//tbskip.taobao.com/json/show_bid_count.htm?itemNumId=582939044915&old_quantity=24000&date=1616919178000","valTimeLeft":318397,"standingDate":0,"tradeParams":{},"api":{"descUrl":"//dscnew.taobao.com/i4/580/931/582939044915/TB141i7tQvoK1RjSZFw8qwiCFla.desc%7Cvar%5Edesc%3Bsign%5E34690f7389c90e2e2a6d3707af1cf7b5%3Blang%5Egbk%3Bt%5E1612494172","httpsDescUrl":"//descnew.taobao.com/i4/580/931/582939044915/TB141i7tQvoK1RjSZFw8qwiCFla.desc%7Cvar%5Edesc%3Bsign%5E34690f7389c90e2e2a6d3707af1cf7b5%3Blang%5Egbk%3Bt%5E1612494172","fetchDcUrl":"//hdc1new.taobao.com/asyn.htm?pageId=275521915&userId=504839697"},"tag":{"isShowMeiliXinde":false,"isMedical":false,"isRightRecommend":true,"isShowEcityIcon":false,"isShowYuanchuanIcon":false,"isBrandAttr":true,"isShowTryReport":false,"isAsynDesc":true,"isBrandSiteRightColumn":true,"isShowHouseIcon":false},"isService":false,"isTripUser":false,"cmCatId":"0","cartEnable":true,"renderSystemServer":"//render.taobao.com","carCascade":false,"isWTContract":false,"isOnlyInMobile":false,"isAreaSell":false,"isMultiPoint":true,"isShowSizeHelper":false,"isMeiz":false,"newSelectCityApi":"//mdskip.taobao.com/json/detailSelectCity.do?isAreaSell=false&itemId=582939044915","initCspuExtraApi":"//ext-mdskip.taobao.com/extension/initCspuExtra.htm","detail":{"isMemberShopItem":false,"isBundleItem":false,"canEditInItemDet":true,"isAllowReport":true,"isHiddenShopAction":false,"isDownShelf":false,"is0YuanBuy":false,"isCarService":false,"isShowEcityBasicSign":false,"isItemAllowSellerView":true,"goNewAuctionFlow":false,"isShowEcityVerticalSign":false,"reviewListType":1,"rxShowTitle":"本品为处方药，请在医师指导下使用。","isVaccine":false,"isHasPos":false,"recommendBigMarkDownEndTime":"1477880000000","isAutoYushou":false,"isOnePriceCar":false,"isVitual3C":false,"rxIcon":"https://gw.alicdn.com/tfs/TB13T_zHHrpK1RjSZTEXXcWAVXa-216-84.png","isFullCarSell":false,"isHideAttentionBtn":false,"isNABundleItem":false,"double11StartTime":"","showDiscountRecommend":false,"enableAliMedicalComponent":true,"isOtcDrug":false,"isYYZY":false,"mlhNewDesc":false,"isMainLiaoSku":false,"isHkMilk":false,"isEnableAppleSku":true,"isHkItem":false,"isShowContentModuleTitle":false,"isRx2Count":true,"isHiddenNonBuyprice":false,"isH5NewLogin":true,"isHkO2OItem":false,"isSavingEnergy":false,"showFushiPoiInfo":false,"defaultItemPrice":"998.00","globalSellItem":false,"isShowEcityDesc":false,"isSkuColorShow":false,"autoccUser":false,"isMenDianInventroy":false,"isMeilihui":false,"isLadderGroupon":false,"isHidePoi":false,"isNewAttraction":true,"isPreSellBrand":false,"loginBeforeCart":false,"isAutoFinancing":false,"showSuperMarketBuy":false,"isPrescriptionDrug":false,"isHasQualification":false,"recommendBigMarkDownStartTime":"1478793600000","pageType":"default","isIFCShop":false,"isAlicomMasterCard":false,"isCarCascade":false,"isDianQiMeiJia":false,"isSkuMemorized":false,"addressLevel":2,"isRx2":false,"isTeMai":false,"allowRate":true,"isShowPreClosed":false,"isO2OStaging":false,"isPurchaseMallVipBuyer":false,"cdn75":false,"isNewMedical":false,"isCarYuEBao":false,"isAliHouse":false,"isCyclePurchase":false,"isChineseMedicinalMaterial":false,"isAliTelecomNew":false,"show9sVideo":true,"isHkDirectSale":false,"isTspace":false,"tryReportDisable":false,"isB2Byao":false,"isRegionLevel":false,"isContractPhoneItem":false,"isYY":false,"supermarketAndQianggou":false,"isZhengChe":false,"isDianZiMendian":false,"isNextDayService":false,"timeKillAuction":false},"apiAddCart":"//cart.taobao.com/add_cart_item.htm?item_id=582939044915","apiBeans":"//count.taobao.com/counter3?keys=SM_368_dsr-504839697,ICCP_1_582939044915","idsMod":[],"initApi":"//mdskip.taobao.com/core/initItemDetail.htm?isUseInventoryCenter=false&cartEnable=true&service3C=false&isApparel=true&isSecKill=false&tmallBuySupport=true&isAreaSell=false&tryBeforeBuy=false&offlineShop=false&itemId=582939044915&showShopProm=false&isPurchaseMallPage=false&itemGmtModified=1616941589000&isRegionLevel=false&household=false&sellerPreview=false&queryMemberRight=true&addressLevel=2&isForbidBuyItem=false","valPointTimes":1.0,"changeLocationApi":"//mdskip.taobao.com/core/changeLocation.htm?isUseInventoryCenter=false&cartEnable=true&sellerUserTag3=144748506807058560&service3C=false&sellerUserTag2=18020085650163712&isSecKill=false&isAreaSell=false&sellerUserTag4=1729391190578595203&offlineShop=false&itemId=582939044915&sellerUserTag=307826720&showShopProm=false&tgTag=false&isPurchaseMallPage=false&isRegionLevel=false&household=false&notAllowOriginPrice=false&addressLevel=2","isTmallComboSupport":false,"serviceIconList":[],"valPointRate":0.5,"tradeType":2,"valMode":128,"initExtraApi":"//ext-mdskip.taobao.com/extension/initExtra.htm","itemDO":{"isInRepository":false,"isSupportTryBeforeBuy":false,"reservePrice":"998.00","imgVedioPic":"https://img.alicdn.com/bao/uploaded/i1/504839697/O1CN01ZvHEm92LVHDJeFGQH_!!504839697.jpg","isSecondKillFromMobile":false,"cspuCategorySwitch":false,"isOnline":true,"title":"恒源祥中年连帽男士冬季外套加厚中长款棉袄爸爸冬装棉衣羽绒棉服","isEnterprisePath":false,"showCompanyPurchase":false,"isDcAsyn":true,"feature":"1","attachImgUrl":["//img.alicdn.com/imgextra/i4/504839697/TB2QyqcrTJYBeNjy1zeXXahzVXa_!!504839697.jpg","//img.alicdn.com/imgextra/i2/504839697/TB2zp3zrxSYBuNjSspjXXX73VXa_!!504839697.jpg"],"isElecCouponItem":false,"brandSiteId":"0","brandSpecialSold":"false","sellerNickName":"%E6%81%92%E6%BA%90%E7%A5%A5%E4%B9%9D%E5%B7%9E%E9%B8%BF%E8%BF%90%E4%B8%93%E5%8D%96","isSecondKillFromPC":false,"auctionType":"b","encryptSellerId":"UMFN0OmvSMCku","prov":"浙江","brand":"恒源祥","imgVedioUrl":"//cloud.video.taobao.com/play/u/504839697/p/1/e/1/t/8/214889632925.swf","isDefaultChooseTryBeforeBuy":false,"quantity":40956,"isBidden":false,"hasSku":true,"isNewProGroup":false,"weight":"0","imgVedioID":"214889632925","userId":"504839697","rootCatId":"30","itemId":"582939044915","validatorUrl":"//store.taobao.com/tadget/shop_stats.htm","isCustomizedItem":false,"auctionStatus":"0","isSecondKillFromPCAndWap":false,"brandId":"46864","sellProgressiveRate":"3_100_1.60;6_0_4.50;9_0_6.00","spuId":"1119289835","categoryId":"50011165"},"rateConfig":{"itemId":582939044915,"sellerId":504839697,"rateScoreCacheDisable":false,"rateSubjectDisable":false,"tryReportDisable":false,"rateScoreDisable":false,"rateEnable":true,"spuId":1119289835,"rateNewChartDisable":false,"listType":1,"rateCloudDisable":false},"rstShopId":62690030,"propertyPics":{";1627207:132596882;":["//img.alicdn.com/imgextra/i4/504839697/O1CN01rmH2gf2LVHH0EXLXg_!!504839697.jpg"],";1627207:35216916;":["//img.alicdn.com/imgextra/i1/504839697/O1CN01pXFiZZ2LVHGzHBAVP_!!504839697.jpg"],";1627207:87264677;":["//img.alicdn.com/imgextra/i4/504839697/O1CN01wpuoJ92LVHH1D1oan_!!504839697.jpg"],"default":["//img.alicdn.com/imgextra/https://img.alicdn.com/bao/uploaded/i1/504839697/O1CN01ZvHEm92LVHDJeFGQH_!!504839697.jpg","//img.alicdn.com/imgextra/https://img.alicdn.com/imgextra/i4/504839697/O1CN01BrBrXE2LVH8FpbJQ8_!!504839697.jpg","//img.alicdn.com/imgextra/https://img.alicdn.com/imgextra/i3/504839697/O1CN018y0spR2LVH8DvwKWC_!!504839697.jpg","//img.alicdn.com/imgextra/https://img.alicdn.com/imgextra/i1/504839697/O1CN01SpmAsl2LVH8FMYDp2_!!504839697.jpg","//img.alicdn.com/imgextra/https://img.alicdn.com/imgextra/i2/504839697/O1CN01gcTg632LVH8DbavrO_!!504839697.jpg"],";1627207:7369958;":["//img.alicdn.com/imgextra/i1/504839697/O1CN01BHjUBU2LVHGyQOtJn_!!504839697.jpg"],";1627207:147077234;":["//img.alicdn.com/imgextra/i1/504839697/O1CN011aGkrx2LVHH0txi1P_!!504839697.jpg"],";1627207:761664726;":["//img.alicdn.com/imgextra/i1/504839697/O1CN019g7pOn2LVHGvwqYWn_!!504839697.jpg"],";1627207:28663874;":["//img.alicdn.com/imgextra/i1/504839697/O1CN0104MMSb2LVHGuuLpJ8_!!504839697.jpg"]},"tmallRateType":0,"selectRegionApi":"//mdskip.taobao.com/core/selectRegion.do?isAreaSell=false&itemId=582939044915","apiItemViews":"//count.taobao.com/counter2?keys=ICVT_7_582939044915&inc=ICVT_7_582939044915&sign=4783ebec8d39232e4ef885cb37042cd2543","tagsId":"83201,123905,166402,2049,30977,249858,28930,60418,214273,218369,236801,112386,149761,161793,188673,192769,4614,542466,4107,3851,1803,2059,4363,4619,6411,7947,11531,23563,24075,1240834,1286402,1470466,1353218,1373186,1391874,1833218,1606402,1618946,1619202,1649922,1665026,1840642,1846018,82241,70465,84801,87361,89665,91713,122177,30273,34369,36161,36417,37953,39233,200002,206657,48706,49218,63042,218177,227137,235585,237121,244033,107842,141121,491074,4678,4166,11083,4171,2123,2635,11339,11595,17739,18763,24139,1373250,1791554,1801282,1833282,1619266,1649474,91777,101761,106881,108929,115329,143746,175490,22145,10369,20609,385,30337,35713,51329,249986,257922,49282,62082,217985,222337,233089,236673,244353,248193,82306,101762,131713,150145,156801,161921,191873,297858,3974,11143,348546,349570,368770,371074,538754,2187,907,1163,1675,2443,4491,17803,22155,1373058,1374082,1418882,1712770,1747330,1821826,1823618,1826434,1618306,1649282,1837186,84673,67521,108225,21697,28353,29889,32961,33217,37569,15554,21442,25282,41922,57026,207297,107458,155073,159169,178625,188609,427458,493250,299202,299458,302530,1478,364482,3019,4811,1483,1227,2507,4555,5835,6603,7371,11467,15563,18379,23755,1784002,1800898,1829570,1619138,1649602,1664962","url":{"tbskip":"//tbskip.taobao.com","mdskip":"//mdskip.taobao.com","tradeForOldTmallBuy":"//stay.buy.tmall.com/order/confirm_order.htm","tgDetailDomain":"//detail.ju.taobao.com","detailServer":"//detail.taobao.com","buyBase":"//buy.taobao.com/auction","mallList":"//list.tmall.com","extMdskip":"//ext-mdskip.taobao.com","xCrossServer":"//mdetail.tmall.com","tgDomain":"//ju.taobao.com","rate":"//rate.tmall.com","tradeBaseUrl":"//trade.taobao.com/trade","topUploadServerBaseUrl":"//upload.taobao.com","BIDRedirectionitemDomain":"//paimai.taobao.com"},"tradeConfig":{"1":"//buy.taobao.com/auction/buy_now.jhtml","2":"//buy.tmall.com/order/confirm_order.htm","3":"//obuy.tmall.com/home/order/confirm_order.htm","4":"","7":"//tw.taobao.com/buy/auction/buy_now.jhtml"},"valCartInfo":{"itemId":"582939044915","cartUrl":"//cart.taobao.com/my_cart.htm?from=bdetail","statsUrl":"//go.mmstat.com/1.gif?logtype=2&category=cart_{loc}_50011165"},"isAliTripHK":false,"selectCityApi":"//mdskip.taobao.com/core/selectCity.htm?isAreaSell=false&itemId=582939044915","getProgressiveInfoApi":"//mdskip.taobao.com/core/getProgressiveInfo.do?platform_type=b2c&fromTryBeforeBuy=false&sellerId=504839697&platform=tmall&category=50011165&sellerPercent=3_100_1.60;6_0_4.50;9_0_6.00","arrOption":{"尺码":{"20509:137291" : "170","20509:137292" : "175","20509:44722" : "180","20509:137293" : "185","20509:3286454" : "190","20509:1071" : "195"},"颜色":{"1627207:35216916" : "9666黑色","1627207:28663874" : "1905黑色","1627207:87264677" : "1905米色","1627207:7369958" : "1909黑色","1627207:147077234" : "1909米色","1627207:132596882" : "1988黑色","1627207:761664726" : "1988灰色"}}}';
        $tr = new GoogleTranslate('ko');
        $tr->setSource('zh-cn');
        $tr->setTarget('ko');
        if (str_contains($result, 'failed')) return;
        
        $arrResponse = (array)json_decode($result, true);
        $arrOption = array();

        if(str_contains($scrapURL, "detail.tmall.com")){
            $arrKrItem = array();
            foreach ($arrResponse['arrOption'] as $key1 => $item) { 
                $KrOptionId = $tr->translate($key1);
                $tranString = implode(" | ", $item);
                $tempString = $tr->translate($tranString);
                $tempArr = explode("|",$tempString);
                // print_r($tempArr);
                $arrOptItem = array();
                
                $i = 0;
                foreach ($item as $key2 => $value) {
                    $image = array_key_exists(";".$key2.";", $arrResponse['propertyPics']) ? $arrResponse['propertyPics'][';'.$key2.';'][0]:"";
                    if (array_key_exists($i, $tempArr)) {
                        $arrKrItem[$key2] = $tempArr[$i];
                        //$arrKrSize[] = $tempArr[$i];
                        $arrOptItem[] = array(
                            $key2,
                            $tempArr[$i],
                            $item[$key2],
                            $image
                        );
                    }else{
                        $arrKrItem[$key2] = "";
                        //$arrKrSize[] = "";
                        $arrOptItem[] = array(
                            $key2,
                            "",
                            $item[$key2],
                            $image
                        );
                    }
                    $i++;
                }
                $arrOption[] = array(
                    'optCnName' => $key1,
                    'optKoName' => $KrOptionId,
                    'optItems' => $arrOptItem
                );
            }
                        
            $descData = "";
            foreach ($arrResponse['valItemInfo']['skuList'] as $key => $value) {
                $price = $arrResponse['valItemInfo']['skuMap'][';'.$arrResponse['valItemInfo']['skuList'][$key]['pvs'].';']['price'];
                $arrKey = explode(";",$value['pvs']);
                $arrResponse['valItemInfo']['skuList'][$key]['price'] = $price;
                $arrResponse['valItemInfo']['skuList'][$key]['basePrice'] = number_format($price * 170, 2, '.', '');
                $arrResponse['valItemInfo']['skuList'][$key]['salePrice'] = number_format(round(($price + $price * 0.3) * 170, -1), 2, '.', '');
                $temp = explode(";", $arrResponse['valItemInfo']['skuList'][$key]['pvs']);
                $options = array();
                for ($i=0; $i < count($temp); $i++) { 
                    if($temp[$i] == ""){
                        continue;
                    }else{
                        $options[] = $arrKrItem[$temp[$i]];
                    }
                }
                //$arrResponse['valItemInfo']['skuList'][$key]['image'] = count($arrKey) <= 1 ? $arrResponse['propertyPics'][';'.$arrKey[0].';'][0] : $arrResponse['propertyPics'][';'.$arrKey[1].';'][0];
                $arrResponse['valItemInfo']['skuList'][$key]['options'] = $options;
                $arrResponse['valItemInfo']['skuList'][$key]['stock'] = $arrResponse['valItemInfo']['skuMap'][';'.$arrResponse['valItemInfo']['skuList'][$key]['pvs'].';']['stock'];
                //$descData .= '<div style="text-align: center;"><p>['.$KrColor.', '.$KrSize.']</p><p><img src="'.$arrResponse['valItemInfo']['skuList'][$key]['image'].'"></p></div>';
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
            $descData = substr($res, 11, -2);
            $resDetailTmall = array(
                'chMainName' => $arrResponse['itemDO']['title'],
                'krMainName' => $krTitle,
                'keyword' => str_replace(' ', ',', $krTitle),
                'price' => $arrResponse['itemDO']['reservePrice'],
                'items' => $arrResponse['valItemInfo']['skuList'],
                'images' => $arrResponse['propertyPics']['default'],
                'options' => $arrOption,
                'description' => utf8_encode($descData)
            );
            return response()->json(["status" => "success", "data" => $resDetailTmall]);
        }else if(str_contains($scrapURL, "item.taobao.com")){
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
            $arrOption = array();
            $arrKrItem = array();
            foreach ($arrResponse['arrOption'] as $key1 => $item) { 
                $KrOptionId = $tr->translate($key1);
                $tranString = implode(" | ", $item);
                $tempString = $tr->translate($tranString);
                $tempArr = explode("|",$tempString);
                // print_r($tempArr);
                $arrOptItem = array();
                
                $i = 0;
                foreach ($item as $key2 => $value) {
                    $image = array_key_exists($key2, $arrResponse['arrImage']) ? $arrResponse['arrImage'][$key2]:"";
                    if (array_key_exists($i, $tempArr)) {
                        $arrKrItem[$key2] = $tempArr[$i];
                        //$arrKrSize[] = $tempArr[$i];
                        $arrOptItem[] = array(
                            $key2,//id
                            $tempArr[$i],// translated name
                            $item[$key2],//name
                            $image// image
                        );
                    }else{
                        $arrKrItem[$key2] = "";
                        //$arrKrSize[] = "";
                        $arrOptItem[] = array(
                            $key2,
                            "",
                            $item[$key2],
                            $image
                        );
                    }
                    $i++;
                }
                $arrOption[] = array(
                    'optCnName' => $key1,
                    'optKoName' => $KrOptionId,
                    'optItems' => $arrOptItem
                );
            }
            
            $price = 0;
            foreach ($arrResponse['skuMap'] as $key => $value) {
                // $price = $arrResponse['valItemInfo']['skuMap'][';'.$arrResponse['valItemInfo']['skuList'][$key]['pvs'].';']['price'];
                // $ChSize = explode(" ", array_values($arrResponse['valItemInfo']['skuList'][$key])[0], 2);
                // $KrSize = explode(" ", array_values($trnasResult[$key])[0], 2);
                if($value['price'] > $price){
                    $price = $value['price'];
                }
                $temp = explode(";", $key);
                $options = array();
                for ($i=0; $i < count($temp); $i++) { 
                    if($temp[$i] == ""){
                        continue;
                    }else{
                        $options[] = $arrKrItem[$temp[$i]];
                    }
                }

                $val = array(
                    "pvs" => $key,
                    "price" => $value['price'],
                    "basePrice" => number_format($value['price'] * 170, 2, '.', ''),
                    "salePrice" => number_format(round(($value['price'] + $value['price'] * 0.3) * 170, -1), 2, '.', ''),
                    "options" => $options,
                    "stock" => $value['stock'],
                    //"ChSize" => !isset($arrResponse['sizes']) ? "" : $arrResponse['sizes'][explode(';', $key)[1]],
                    //"KrSize" => !isset($arrResponse['sizes']) ? "" : $arrResponse['sizes'][explode(';', $key)[1]],
                    //"ChColorPattern" => $ChColorSize,
                    //"KrColorPattern" => $KrColorPattern,
                    //"image" => !isset($arrResponse['sizes']) ? $arrResponse['colorImages'][explode(';', $key)[1]] :$arrResponse['colorImages'][explode(';', $key)[2]],
                    "weight" => 0
                );
                $resDetailTaobao['items'][] = $val;
                //$descData .= '<div style="pdding-botton:10px; text-align: center;"><p>['.$val['KrColorPattern'].", ".$val['KrSize'].']</p><p><img src="'.$val['image'].'"></p></div>';
            }
            
            $resDetailTaobao['description'] = $descData.str_replace("|", "\"",$arrResponse['description']);
            $resDetailTaobao['images'] = $arrResponse['auctionImages'];
            $resDetailTaobao['price'] = $price;
            $resDetailTaobao['options'] = $arrOption;
            return response()->json(["status" => "success", "data" => $resDetailTaobao]);
        }else if(str_contains($scrapURL, "detail.1688.com")){
            //print_r($arrResponse);
            $krTitle = $tr->translate($arrResponse['title']);

            $descData = "";
            $krTitle = $tr->translate($arrResponse['title']);
            $resDetail1688 = array(
                "id" => $arrResponse['id'],
                "chMainName" => $arrResponse['title'],
                "krMainName" => $krTitle,
                'keyword' => str_replace(' ', ',', $krTitle),
                "skuList" => array(),
                "images" => array()
            );
            // //컬러 패턴 번역
            // $transData = json_encode(array_values($arrResponse['colors']), JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
            // $trnasResult = $tr->translate($transData);
            // $transResArr = json_decode($trnasResult);
            // $idx=0;
            foreach ($arrResponse['images'] as $key => $value) {
                $arrResponse['images'][$key] = $value['original'];
            }
            //print_r($arrResponse['images']);
            //print_r($arrResponse);
            $resTransArr = array_keys($arrResponse['detailData']['sku']['skuMap']);
            $transData = implode('||||', array_values($resTransArr));
            $transData = str_replace("&gt;","***", $transData);

            $trnasResult = $tr->translate($transData);
            $transResult = preg_replace('/\s+/', '', str_replace(' ', '', $trnasResult));

            $skuProp = explode('||||', $transResult);
            //echo $transData;
            //print_r($skuProp);
            $idx = 0;
            foreach ($arrResponse['detailData']['sku']['skuMap'] as $key => $value) {
                
                $Cn_Size_Color = explode('&gt;', $key);
                $itemCnColor = $Cn_Size_Color[0];
                $itemCnSize = $Cn_Size_Color[1];
                //
                $Ko_Size_Color = explode('***', $skuProp[$idx]);
                
                $idx++;
                $itemKoColor = $Ko_Size_Color[0];
                $itemKoSize = $Ko_Size_Color[1];
                $val = array(
                    "price" => $value['price'],
                    "basePrice" => number_format($value['price'] * 170, 2, '.', ''),
                    "salePrice" => number_format(round(($value['price'] + $value['price'] * 0.3) * 170, -1), 2, '.', ''),
                    "ChSize" => $itemCnSize,
                    "KrSize" => $itemKoSize,
                    "ChColorPattern" => $itemCnColor,
                    "KrColorPattern" => $itemKoColor,
                    "image" => $arrResponse['colors'][$itemCnColor]['original'],
                    "weight" => 0
                );
                $resDetail1688['items'][] = $val;
                $descData .= '<div style="pdding-botton:10px; text-align: center;"><p>['.$val['KrColorPattern'].", ".$val['KrSize'].']</p><p><img src="'.$val['image'].'"></p></div>';
            }
            
            $resDetail1688['description'] = $descData;
            $resDetail1688['images'] = $arrResponse['images'];
            $resDetail1688['price'] = $arrResponse['price'];;
            return response()->json(["status" => "success", "data" => $resDetail1688]);
        }else if(str_contains($scrapURL, "www.vvic.com")){
            $krTitle = $tr->translate($arrResponse['title']);

            $descData = "";
            $krTitle = $tr->translate($arrResponse['title']);
            $resDetailVvic = array(
                "id" => $arrResponse['id'],
                "chMainName" => $arrResponse['title'],
                "krMainName" => $krTitle,
                'keyword' => str_replace(' ', ',', $krTitle),
                "skuList" => array(),
                "images" => array()
            );
            // //컬러 패턴 번역
            $images = explode(',', $arrResponse['images']);
            
            $transData = "";
            foreach ($arrResponse['skuMap'] as $key => $value) {
                $transData .= ($value['color_name']."||||");
            }

            $trnasResult = $tr->translate($transData);
            $transResult = preg_replace('/\s+/', '', str_replace(' ', '', $trnasResult));
            $skuProp = explode('||||', $transResult);

            $idx = 0;
            foreach ($arrResponse['skuMap'] as $key => $value) {
                $val = array(
                    "price" => $value['price'],
                    "basePrice" => number_format($value['price'] * 170, 2, '.', ''),
                    "salePrice" => number_format(round(($value['price'] + $value['price'] * 0.3) * 170, -1), 2, '.', ''),
                    "ChSize" => $value['size_name'],
                    "KrSize" => $value['size_name'],
                    "ChColorPattern" => $value['color_name'],
                    "KrColorPattern" => $skuProp[$key],
                    "image" => $value['color_pic'],
                    "weight" => number_format($value['weight']/1000, 2, '.', '')
                );
                $resDetailVvic['items'][] = $val;
                $descData .= '<div style="pdding-botton:10px; text-align: center;"><p>['.$val['KrColorPattern'].", ".$val['KrSize'].']</p><p><img src="'.$val['image'].'"></p></div>';
            }
            $description = str_replace('|', '"', $arrResponse['description']);
            $resDetailVvic['description'] = $descData.$description;
            $resDetailVvic['images'] = $images;
            $resDetailVvic['price'] = $arrResponse['price'];

            return response()->json(["status" => "success", "data" => $resDetailVvic]);
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
        // $brand = $request->post('txtBrandName');
        // $product = new Product([
        //     'nUserId' => Auth::id(),
        //     'strURL' => $request->post('txtScrapURL'), 
        //     'strMainName' => mb_substr($request->post('txtKrMainName'), 0, mb_strlen( $request->post('txtKrMainName')) > 25 ? 25 : mb_strlen( $request->post('txtKrMainName'))), 
        //     'strSubName' => mb_substr($request->post('txtKrMainName'), 0, mb_strlen( $request->post('txtKrMainName')) > 25 ? 25 : mb_strlen( $request->post('txtKrMainName'))),
        //     'nUserId' => Auth::id(), 
        //     'nBrandType' => $request->post('selBrandName'), 
        //     'strBrand' => ($request->post('txtBrandName') == "" ? $request->post('selBrandName') : $request->post('txtBrandName')),
        //     'strKeyword' => $request->post('txtKeyword'), 
        //     'strChMainName' => $request->post('txtKrMainName'), 
        //     'strKrMainName' => $request->post('txtKrMainName'), 
        //     'strChSubName' => $request->post('txtChMainName'), 
        //     'strKrSubName' => $request->post('txtKrMainName'), 
        //     'strComeCode' => $request->post('selComeName'), 
        //     'strCategoryCode1' => $request->post('selCategoryName1'), 
        //     'strCategoryCode2' => $request->post('selCategoryName2'), 
        //     'strCategoryCode3' => $request->post('selCategoryName3'), 
        //     'strCategoryCode4' => $request->post('selCategoryName4'), 
        //     'strCategoryName' => $request->post('txtCategoryName'), 
        //     'nShareType' => $request->post('rdoShareType'),
        //     'nProductWorkProcess' => 0,
        //     'bIsDel'=> 0
        // ]);
        // $product->save();
        //detail data
        // $nMarketPrice = number_format(($request->post('txtBasePrice') + $request->post('txtCountryShippingCost'))*170 + $request->post('txtWorldShippingCost'), 2, '.', '');
        // $nMarginPercent = 30;
        // $productDetail = new ProductDetail([
        //     'nProductIdx' => $product->nIdx,
        //     'strBasePriceType' => $request->post('selBasePriceType'),
        //     'nBasePrice' => number_format($request->post('txtBasePrice'), 2, '.', ''),
        //     'strCountryShippingCostType' => $request->post('selCountryShippingCostType'),
        //     'nCountryShippingCost' => number_format($request->post('txtCountryShippingCost'), 2, '.', ''),
        //     'strWorldShippingCostType' => $request->post('selWorldShippingCostType'),
        //     'nWorldShippingCost' => $request->post('txtWorldShippingCost'),
        //     'strWeightType' => $request->post('selWeightType'),
        //     'nWeight' => number_format($request->post('txtWeight'), 2, '.', ''),
        //     'bAdditionalOption1' => number_format($request->post('chkAdditionalOption1')),
        //     'bAdditionalOption2' => number_format($request->post('chkAdditionalOption2')),
        //     'bAdditionalOption3' => number_format($request->post('chkAdditionalOption3')),
        //     'bAdditionalOption4' => number_format($request->post('chkAdditionalOption4')),
        //     'nMultiPriceOptionType' => number_format($request->post('rdoMultiPriceOptionType')),
        //     'nMarketPrice' => $nMarketPrice,
        //     'nMarginPrice' => number_format(round($nMarketPrice / (100 - $nMarginPercent) /100 + $nMarketPrice, -1), 2, '.', ''),
        //     'nMarginPercent' => $nMarginPercent,
        //     'blobNote' => $request->post('summernote'),
        //     'bIsDel'=> 0
        // ]);
        // $productDetail->save();
        // //subitem data
        // $countItem = count($request->post('txtSubItemImage'));
        
        // //만일 서브아이템이 10개 이상이라면 최대입력수를 늘인다
        // //if($countItem > 10)
        //     ini_set('max_input_vars','10000' );

        // $arrImage = $request->post('txtSubItemImage');
        // $arrKrColorPattern = $request->post('txtSubItemKrColorPattern');
        // $arrChColorPattern = $request->post('txtSubItemChColorPattern');
        // $arrKrSize = $request->post('txtSubItemKrSize');
        // $arrChSize = $request->post('txtSubItemChSize');
        // $arrOptionPrice = $request->post('txtSubItemOptionPrice');
        
        // $arrBasePrice = $request->post('txtSubItemBasePrice');
        // $arrSalePrice = $request->post('txtSubItemSalePrice');
        // $arrWeight = $request->post('txtSubItemWeight');
        // for ($i=0; $i < $countItem; $i++) { 
        //     $productItem = new ProductItem([
        //         'nProductIdx' => $product->nIdx,
        //         'strSubItemName' => $arrKrColorPattern[$i],
        //         'nSubItemOptionPrice' => $arrOptionPrice[$i],
        //         'nSubItemBasePrice' => $arrBasePrice[$i],
        //         'nSubItemSalePrice' => $arrSalePrice[$i],
        //         'nSubItemWeight' => $arrWeight[$i],
        //         'strSubItemImage' => $arrImage[$i],
        //         'strSubItemChColorPattern' => $arrChColorPattern[$i],
        //         'strSubItemKrColorPattern' => $arrKrColorPattern[$i],
        //         'strSubItemChSize' => $arrChSize[$i],
        //         'strSubItemKrSize' => $arrKrSize[$i],
        //         'bIsDel' => 0
        //     ]);
        //     $productItem->save();
        // }
        // //image data
        // $countImage = count($request->post('txtImage'));
        // $arrDetailImage = $request->post('txtImage');
        // for ($i=0; $i < $countImage; $i++) { 
            
        //     $productImage = new ProductImage([
        //         'nProductIdx' => $product->nIdx,
        //         'nImageCode' => $i,
        //         'strName' => '',
        //         'strURL' => $arrDetailImage[$i],
        //         'nHeight' => 0,
        //         'nWidth' => 0,
        //         'strNote' => '',
        //         'bIsDel' => 0
        //     ]);
        //     $productImage->save();
        // }

        return redirect('scratchProductScrap');
    }

    public function categoryListSolution()
    {
        return view('scratch.CategorySolutionList');
    }

    public function categorySearch($cateId=0, Request $request)
    {
        $keyword = $request->get('keyword');
        //통합검색
        if($cateId==0){
            $categories = CategorySolution::where('bIsDel', 0)->where('strCategoryName', 'like', '%'.$keyword.'%')->get();
        }else if($cateId==1){
            $categories = CategorySmartStore::where('bIsDel', 0)->where('strCategoryName', 'like', '%'.$keyword.'%')->get();
        }else if($cateId==2){
            $categories = CategoryCoupang::where('bIsDel', 0)->where('strCategoryName', 'like', '%'.$keyword.'%')->get();
        }else if($cateId==3){
            $categories = Category11thGlobal::where('bIsDel', 0)->where('strCategoryName', 'like', '%'.$keyword.'%')->get();
        }else if($cateId==4){
            $categories = Category11thNormal::where('bIsDel', 0)->where('strCategoryName', 'like', '%'.$keyword.'%')->get();
        }else if($cateId==5){
            $categories = CategoryAuction::where('bIsDel', 0)->where('strCategoryName', 'like', '%'.$keyword.'%')->get();
        }else if($cateId==6){
            $categories = CategoryGmarket::where('bIsDel', 0)->where('strCategoryName', 'like', '%'.$keyword.'%')->get();
        }else if($cateId==7){
            $categories = CategoryInterPark::where('bIsDel', 0)->where('strCategoryName', 'like', '%'.$keyword.'%')->get();
        }else if($cateId==8){
            $categories = CategoryWeMakePrice::where('bIsDel', 0)->where('strCategoryName', 'like', '%'.$keyword.'%')->get();
        }

        return response()->json(["status" => "success", "data" => $categories]);
    }

    public function categorySelect($cateId = 0, Request $request)
    {
        
        $keyword = $request->get('keyword');
        $keyword = str_replace(' ', '', $keyword);
        $keywords = array();
        if(strpos($keyword, ':') !== false){
            $temp = explode(' : ', $keyword);
            $keywords = preg_split('/[> \/]/', $temp[1]);
        }else{
            $keywords = preg_split('/[> \/]/', $keyword);
        }
        $keywords = array_reverse($keywords);
        $categories = array();
        $categories[] = null;//솔루션 카테고리
        $categories[] = CategorySmartStore::where('bIsDel', 0)
                        //->whereIn('strCategoryName', 'like', '%'.$keyword.'%')
                        ->where(function ($query) use($keywords) {
                            for ($i = 0; $i < count($keywords); $i++){
                                $query->orWhere('strCategoryName', 'like',  '%' . $keywords[$i] .'%');
                            }      
                        })->first();
        $categoriy_c = CategoryCoupang::where('bIsDel', 0)
                        //->whereIn('strCategoryName', 'like', '%'.$keyword.'%')
                        ->where('strCategoryName', 'like',  '%' . $keywords[0] .'%')->first();
        if($categoriy_c == null){
            $categories[] = CategoryCoupang::where('bIsDel', 0)
                //->whereIn('strCategoryName', 'like', '%'.$keyword.'%')
                ->where(function ($query) use($keywords) {
                    for ($i = 0; $i < count($keywords); $i++){
                        $query->orWhere('strCategoryName', 'like',  '%' . $keywords[$i] .'%');
                    }      
                })->first();
        }else{
            $categories[] = $categoriy_c;
        }

        $categories[] = Category11thGlobal::where('bIsDel', 0)
                        //->whereIn('strCategoryName', 'like', '%'.$keyword.'%')
                        ->where(function ($query) use($keywords) {
                            for ($i = 0; $i < count($keywords); $i++){
                                $query->orWhere('strCategoryName', 'like',  '%' . $keywords[$i] .'%');
                            }      
                        })->first();
        $categories[] = Category11thNormal::where('bIsDel', 0)
                        //->whereIn('strCategoryName', 'like', '%'.$keyword.'%')
                        ->where(function ($query) use($keywords) {
                            for ($i = 0; $i < count($keywords); $i++){
                                $query->orWhere('strCategoryName', 'like',  '%' . $keywords[$i] .'%');
                            }      
                        })->first();
        $categories[] = CategoryAuction::where('bIsDel', 0)
                        //->whereIn('strCategoryName', 'like', '%'.$keyword.'%')
                        ->where(function ($query) use($keywords) {
                            for ($i = 0; $i < count($keywords); $i++){
                                $query->orWhere('strCategoryName', 'like',  '%' . $keywords[$i] .'%');
                            }      
                        })->first();
        $categories[] = CategoryGmarket::where('bIsDel', 0)
                        //->whereIn('strCategoryName', 'like', '%'.$keyword.'%')
                        ->where(function ($query) use($keywords) {
                            for ($i = 0; $i < count($keywords); $i++){
                                $query->orWhere('strCategoryName', 'like',  '%' . $keywords[$i] .'%');
                            }      
                        })->first();
        $categories[] = CategoryInterPark::where('bIsDel', 0)
                        //->whereIn('strCategoryName', 'like', '%'.$keyword.'%')
                        ->where(function ($query) use($keywords) {
                            for ($i = 0; $i < count($keywords); $i++){
                                $query->orWhere('strCategoryName', 'like',  '%' . $keywords[$i] .'%');
                            }      
                        })->first();
        $categories[] = CategoryWeMakePrice::where('bIsDel', 0)
                        //->whereIn('strCategoryName', 'like', '%'.$keyword.'%')
                        ->where(function ($query) use($keywords) {
                            for ($i = 0; $i < count($keywords); $i++){
                                $query->orWhere('strCategoryName', 'like',  '%' . $keywords[$i] .'%');
                            }      
                        })->first();
        return response()->json(["status" => "success", "data" => $categories]);
    }

    public function categoryListSmartStore()
    {
        return view('scratch.CategorySmartStoreList');
    }

    public function categoryListCoupang()
    {
        return view('scratch.CategoryCoupangList');
    }

    public function categoryList11thGlobal()
    {
        return view('scratch.Category11thGlobalList');
    }

    public function categoryList11thNormal()
    {
        return view('scratch.Category11thNormalList');
    }

    public function categoryListAuction()
    {
        return view('scratch.CategoryAuctionList');
    }

    public function categoryListInterPark()
    {
        return view('scratch.CategoryInterParkList');
    }

    public function categoryListWeMakePrice()
    {
        return view('scratch.CategoryWeMakePriceList');
    }

    public function categoryListGmarket()
    {
        return view('scratch.CategoryGmarketList');
    }
}
