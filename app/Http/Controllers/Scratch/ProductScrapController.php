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
use App\Models\WeightType;
use App\Models\MoneyType;

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
        $moneyTypes = MoneyType::where('bIsDel', 0)
                ->get();
        $weightTypes = WeightType::where('bIsDel', 0)
                ->get();
        $shareType = "1";
        $tr = new GoogleTranslate('ko');
        $tr->setSource('zh-cn');
        $tr->setTarget('ko');
        $strChMainName = '秋冬加厚职业套装2020新款毛呢大衣中长款套裙工作服工装妮子外套';
        $strKrMainName = $tr->translate($strChMainName);
        $title = "상품스크랩";
        return view('scratch.ProductScrap', compact('title', 'strChMainName', 'strKrMainName', 'brands', 'comes', 'categories_1', 'categories_2', 'categories_3', 'categories_4', 'shareType', 'moneyTypes', 'weightTypes'));
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
        //$scrapURL = 'https://item.taobao.com/item.htm?spm=2013.1.0.0.5c77577bM4iKJj&id=604441926066&scm=1007.12144.95220.42296_0_0&pvid=38083436-f8a4-412c-ba84-e54b99d0f8d7&utparam=%7B"x_hestia_source"%3A"42296"%2C"x_object_type"%3A"item"%2C"x_hestia_subsource"%3A"default"%2C"x_mt"%3A0%2C"x_src"%3A"42296"%2C"x_pos"%3A1%2C"wh_pid"%3A-1%2C"x_pvid"%3A"38083436-f8a4-412c-ba84-e54b99d0f8d7"%2C"scm"%3A"1007.12144.95220.42296_0_0"%2C"x_object_id"%3A604441926066%7D';
        curl_setopt($cURLConnection, CURLOPT_URL, 'http://localhost:8004/url='.$scrapURL);
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cURLConnection, CURLOPT_CONNECTTIMEOUT, 0); 
        curl_setopt($cURLConnection, CURLOPT_TIMEOUT, 400); //timeout in seconds
        $result = curl_exec($cURLConnection);
        curl_close($cURLConnection);
        $tr = new GoogleTranslate('ko');
        $tr->setSource('zh-cn');
        $tr->setTarget('ko');
        //$result = '{"valItemInfo":{"skuList":[{"names":"XXL 西装（红色） ","pvs":"20509:28318;1627207:991520546","skuId":"3249618852974"},{"names":"XXXL 西装（红色） ","pvs":"20509:28319;1627207:991520546","skuId":"3249618852975"},{"names":"XS 西装（红色） ","pvs":"20509:28313;1627207:991520546","skuId":"3249618852976"},{"names":"S 西装（红色） ","pvs":"20509:28314;1627207:991520546","skuId":"3249618852977"},{"names":"M 西装（红色） ","pvs":"20509:28315;1627207:991520546","skuId":"3249618852978"},{"names":"L 西装（红色） ","pvs":"20509:28316;1627207:991520546","skuId":"3249618852979"},{"names":"XXL 半裙（红色） ","pvs":"20509:28318;1627207:818642468","skuId":"3249618852980"},{"names":"XXXL 半裙（红色） ","pvs":"20509:28319;1627207:818642468","skuId":"3249618852981"},{"names":"XS 半裙（红色） ","pvs":"20509:28313;1627207:818642468","skuId":"3249618852982"},{"names":"S 半裙（红色） ","pvs":"20509:28314;1627207:818642468","skuId":"3249618852983"},{"names":"M 半裙（红色） ","pvs":"20509:28315;1627207:818642468","skuId":"3249618852984"},{"names":"L 半裙（红色） ","pvs":"20509:28316;1627207:818642468","skuId":"3249618852985"},{"names":"XXL 西装+半裙（红色） ","pvs":"20509:28318;1627207:1473871118","skuId":"3249618852986"},{"names":"XXXL 西装+半裙（红色） ","pvs":"20509:28319;1627207:1473871118","skuId":"3249618852987"},{"names":"XS 西装+半裙（红色） ","pvs":"20509:28313;1627207:1473871118","skuId":"3249618852988"},{"names":"S 西装+半裙（红色） ","pvs":"20509:28314;1627207:1473871118","skuId":"3249618852989"},{"names":"M 西装+半裙（红色） ","pvs":"20509:28315;1627207:1473871118","skuId":"3249618852990"},{"names":"L 西装+半裙（红色） ","pvs":"20509:28316;1627207:1473871118","skuId":"3249618852991"},{"names":"XXL 西装（灰色） ","pvs":"20509:28318;1627207:732368729","skuId":"3249618852992"},{"names":"XXXL 西装（灰色） ","pvs":"20509:28319;1627207:732368729","skuId":"3249618852993"},{"names":"XS 西装（灰色） ","pvs":"20509:28313;1627207:732368729","skuId":"3249618852994"},{"names":"S 西装（灰色） ","pvs":"20509:28314;1627207:732368729","skuId":"3249618852995"},{"names":"M 西装（灰色） ","pvs":"20509:28315;1627207:732368729","skuId":"3249618852996"},{"names":"L 西装（灰色） ","pvs":"20509:28316;1627207:732368729","skuId":"3249618852997"},{"names":"XXL 半裙（灰色） ","pvs":"20509:28318;1627207:790282473","skuId":"3249618852998"},{"names":"XXXL 半裙（灰色） ","pvs":"20509:28319;1627207:790282473","skuId":"3249618852999"},{"names":"XS 半裙（灰色） ","pvs":"20509:28313;1627207:790282473","skuId":"3249618853000"},{"names":"S 半裙（灰色） ","pvs":"20509:28314;1627207:790282473","skuId":"3413519379001"},{"names":"M 半裙（灰色） ","pvs":"20509:28315;1627207:790282473","skuId":"3413519379002"},{"names":"L 半裙（灰色） ","pvs":"20509:28316;1627207:790282473","skuId":"3413519379003"},{"names":"XXL 西装+半裙（灰色） ","pvs":"20509:28318;1627207:1007030450","skuId":"3413519379004"},{"names":"XXXL 西装+半裙（灰色） ","pvs":"20509:28319;1627207:1007030450","skuId":"3413519379005"},{"names":"XS 西装+半裙（灰色） ","pvs":"20509:28313;1627207:1007030450","skuId":"3413519379006"},{"names":"S 西装+半裙（灰色） ","pvs":"20509:28314;1627207:1007030450","skuId":"3413519379007"},{"names":"M 西装+半裙（灰色） ","pvs":"20509:28315;1627207:1007030450","skuId":"3413519379008"},{"names":"L 西装+半裙（灰色） ","pvs":"20509:28316;1627207:1007030450","skuId":"3413519379009"},{"names":"XXL 衬衫+半裙（红色） ","pvs":"20509:28318;1627207:1569789026","skuId":"3250006668147"},{"names":"XXXL 衬衫+半裙（红色） ","pvs":"20509:28319;1627207:1569789026","skuId":"3250006668152"},{"names":"XS 衬衫+半裙（红色） ","pvs":"20509:28313;1627207:1569789026","skuId":"3250006668127"},{"names":"S 衬衫+半裙（红色） ","pvs":"20509:28314;1627207:1569789026","skuId":"3250006668132"},{"names":"M 衬衫+半裙（红色） ","pvs":"20509:28315;1627207:1569789026","skuId":"3250006668137"},{"names":"L 衬衫+半裙（红色） ","pvs":"20509:28316;1627207:1569789026","skuId":"3250006668142"},{"names":"XXL 衬衫+半裙（灰色） ","pvs":"20509:28318;1627207:1198900190","skuId":"3250006668145"},{"names":"XXXL 衬衫+半裙（灰色） ","pvs":"20509:28319;1627207:1198900190","skuId":"3250006668150"},{"names":"XS 衬衫+半裙（灰色） ","pvs":"20509:28313;1627207:1198900190","skuId":"3250006668125"},{"names":"S 衬衫+半裙（灰色） ","pvs":"20509:28314;1627207:1198900190","skuId":"3250006668130"},{"names":"M 衬衫+半裙（灰色） ","pvs":"20509:28315;1627207:1198900190","skuId":"3250006668135"},{"names":"L 衬衫+半裙（灰色） ","pvs":"20509:28316;1627207:1198900190","skuId":"3250006668140"},{"names":"XXL 西装+衬衫+半裙（红色） ","pvs":"20509:28318;1627207:1569789025","skuId":"3250006668146"},{"names":"XXXL 西装+衬衫+半裙（红色） ","pvs":"20509:28319;1627207:1569789025","skuId":"3250006668151"},{"names":"XS 西装+衬衫+半裙（红色） ","pvs":"20509:28313;1627207:1569789025","skuId":"3250006668126"},{"names":"S 西装+衬衫+半裙（红色） ","pvs":"20509:28314;1627207:1569789025","skuId":"3250006668131"},{"names":"M 西装+衬衫+半裙（红色） ","pvs":"20509:28315;1627207:1569789025","skuId":"3250006668136"},{"names":"L 西装+衬衫+半裙（红色） ","pvs":"20509:28316;1627207:1569789025","skuId":"3250006668141"},{"names":"XXL 西装+衬衫+半裙（灰色） ","pvs":"20509:28318;1627207:1100934058","skuId":"3250006668144"},{"names":"XXXL 西装+衬衫+半裙（灰色） ","pvs":"20509:28319;1627207:1100934058","skuId":"3250006668149"},{"names":"XS 西装+衬衫+半裙（灰色） ","pvs":"20509:28313;1627207:1100934058","skuId":"3250006668124"},{"names":"S 西装+衬衫+半裙（灰色） ","pvs":"20509:28314;1627207:1100934058","skuId":"3250006668129"},{"names":"M 西装+衬衫+半裙（灰色） ","pvs":"20509:28315;1627207:1100934058","skuId":"3250006668134"},{"names":"L 西装+衬衫+半裙（灰色） ","pvs":"20509:28316;1627207:1100934058","skuId":"3250006668139"},{"names":"XXL 衬衫 ","pvs":"20509:28318;1627207:43602","skuId":"3250006668148"},{"names":"XXXL 衬衫 ","pvs":"20509:28319;1627207:43602","skuId":"3250006668153"},{"names":"XS 衬衫 ","pvs":"20509:28313;1627207:43602","skuId":"3250006668128"},{"names":"S 衬衫 ","pvs":"20509:28314;1627207:43602","skuId":"3250006668133"},{"names":"M 衬衫 ","pvs":"20509:28315;1627207:43602","skuId":"3250006668138"},{"names":"L 衬衫 ","pvs":"20509:28316;1627207:43602","skuId":"3250006668143"}],"defSelected":[],"skuMap":{";20509:28318;1627207:1007030450;":{"priceCent":65600,"price":"656.00","stock":500,"skuId":"3413519379004"},";20509:28316;1627207:1473871118;":{"priceCent":65600,"price":"656.00","stock":500,"skuId":"3249618852991"},";20509:28316;1627207:1198900190;":{"priceCent":53600,"price":"536.00","stock":0,"skuId":"3250006668140"},";20509:28313;1627207:1569789025;":{"priceCent":85600,"price":"856.00","stock":500,"skuId":"3250006668126"},";20509:28314;1627207:43602;":{"priceCent":27600,"price":"276.00","stock":500,"skuId":"3250006668133"},";20509:28314;1627207:790282473;":{"priceCent":31600,"price":"316.00","stock":0,"skuId":"3413519379001"},";20509:28313;1627207:1007030450;":{"priceCent":65600,"price":"656.00","stock":500,"skuId":"3413519379006"},";20509:28319;1627207:43602;":{"priceCent":27600,"price":"276.00","stock":500,"skuId":"3250006668153"},";20509:28316;1627207:790282473;":{"priceCent":31600,"price":"316.00","stock":0,"skuId":"3413519379003"},";20509:28314;1627207:1569789026;":{"priceCent":53600,"price":"536.00","stock":500,"skuId":"3250006668132"},";20509:28316;1627207:1100934058;":{"priceCent":85600,"price":"856.00","stock":0,"skuId":"3250006668139"},";20509:28319;1627207:1569789026;":{"priceCent":53600,"price":"536.00","stock":500,"skuId":"3250006668152"},";20509:28315;1627207:1569789026;":{"priceCent":53600,"price":"536.00","stock":500,"skuId":"3250006668137"},";20509:28314;1627207:818642468;":{"priceCent":31600,"price":"316.00","stock":500,"skuId":"3249618852983"},";20509:28318;1627207:1569789025;":{"priceCent":85600,"price":"856.00","stock":499,"skuId":"3250006668146"},";20509:28316;1627207:818642468;":{"priceCent":31600,"price":"316.00","stock":500,"skuId":"3249618852985"},";20509:28318;1627207:818642468;":{"priceCent":31600,"price":"316.00","stock":500,"skuId":"3249618852980"},";20509:28313;1627207:991520546;":{"priceCent":43600,"price":"436.00","stock":500,"skuId":"3249618852976"},";20509:28315;1627207:991520546;":{"priceCent":43600,"price":"436.00","stock":500,"skuId":"3249618852978"},";20509:28319;1627207:991520546;":{"priceCent":43600,"price":"436.00","stock":500,"skuId":"3249618852975"},";20509:28316;1627207:43602;":{"priceCent":27600,"price":"276.00","stock":500,"skuId":"3250006668143"},";20509:28313;1627207:1569789026;":{"priceCent":53600,"price":"536.00","stock":500,"skuId":"3250006668127"},";20509:28314;1627207:1569789025;":{"priceCent":85600,"price":"856.00","stock":500,"skuId":"3250006668131"},";20509:28315;1627207:43602;":{"priceCent":27600,"price":"276.00","stock":500,"skuId":"3250006668138"},";20509:28314;1627207:732368729;":{"priceCent":43600,"price":"436.00","stock":0,"skuId":"3249618852995"},";20509:28318;1627207:1473871118;":{"priceCent":65600,"price":"656.00","stock":500,"skuId":"3249618852986"},";20509:28318;1627207:1198900190;":{"priceCent":53600,"price":"536.00","stock":500,"skuId":"3250006668145"},";20509:28319;1627207:1569789025;":{"priceCent":85600,"price":"856.00","stock":500,"skuId":"3250006668151"},";20509:28315;1627207:1569789025;":{"priceCent":85600,"price":"856.00","stock":500,"skuId":"3250006668136"},";20509:28313;1627207:1473871118;":{"priceCent":65600,"price":"656.00","stock":499,"skuId":"3249618852988"},";20509:28318;1627207:1569789026;":{"priceCent":53600,"price":"536.00","stock":500,"skuId":"3250006668147"},";20509:28315;1627207:1100934058;":{"priceCent":85600,"price":"856.00","stock":0,"skuId":"3250006668134"},";20509:28313;1627207:1198900190;":{"priceCent":53600,"price":"536.00","stock":500,"skuId":"3250006668125"},";20509:28313;1627207:732368729;":{"priceCent":43600,"price":"436.00","stock":500,"skuId":"3249618852994"},";20509:28316;1627207:732368729;":{"priceCent":43600,"price":"436.00","stock":0,"skuId":"3249618852997"},";20509:28319;1627207:732368729;":{"priceCent":43600,"price":"436.00","stock":500,"skuId":"3249618852993"},";20509:28318;1627207:732368729;":{"priceCent":43600,"price":"436.00","stock":500,"skuId":"3249618852992"},";20509:28315;1627207:732368729;":{"priceCent":43600,"price":"436.00","stock":0,"skuId":"3249618852996"},";20509:28314;1627207:1100934058;":{"priceCent":85600,"price":"856.00","stock":0,"skuId":"3250006668129"},";20509:28316;1627207:991520546;":{"priceCent":43600,"price":"436.00","stock":500,"skuId":"3249618852979"},";20509:28319;1627207:1473871118;":{"priceCent":65600,"price":"656.00","stock":500,"skuId":"3249618852987"},";20509:28316;1627207:1569789025;":{"priceCent":85600,"price":"856.00","stock":499,"skuId":"3250006668141"},";20509:28313;1627207:818642468;":{"priceCent":31600,"price":"316.00","stock":500,"skuId":"3249618852982"},";20509:28319;1627207:1198900190;":{"priceCent":53600,"price":"536.00","stock":500,"skuId":"3250006668150"},";20509:28315;1627207:790282473;":{"priceCent":31600,"price":"316.00","stock":0,"skuId":"3413519379002"},";20509:28313;1627207:790282473;":{"priceCent":31600,"price":"316.00","stock":500,"skuId":"3249618853000"},";20509:28319;1627207:1100934058;":{"priceCent":85600,"price":"856.00","stock":500,"skuId":"3250006668149"},";20509:28316;1627207:1007030450;":{"priceCent":65600,"price":"656.00","stock":0,"skuId":"3413519379009"},";20509:28314;1627207:1473871118;":{"priceCent":65600,"price":"656.00","stock":499,"skuId":"3249618852989"},";20509:28314;1627207:1198900190;":{"priceCent":53600,"price":"536.00","stock":0,"skuId":"3250006668130"},";20509:28315;1627207:818642468;":{"priceCent":31600,"price":"316.00","stock":500,"skuId":"3249618852984"},";20509:28313;1627207:43602;":{"priceCent":27600,"price":"276.00","stock":500,"skuId":"3250006668128"},";20509:28319;1627207:818642468;":{"priceCent":31600,"price":"316.00","stock":500,"skuId":"3249618852981"},";20509:28314;1627207:991520546;":{"priceCent":43600,"price":"436.00","stock":500,"skuId":"3249618852977"},";20509:28318;1627207:43602;":{"priceCent":27600,"price":"276.00","stock":500,"skuId":"3250006668148"},";20509:28318;1627207:991520546;":{"priceCent":43600,"price":"436.00","stock":500,"skuId":"3249618852974"},";20509:28318;1627207:1100934058;":{"priceCent":85600,"price":"856.00","stock":500,"skuId":"3250006668144"},";20509:28315;1627207:1198900190;":{"priceCent":53600,"price":"536.00","stock":0,"skuId":"3250006668135"},";20509:28319;1627207:790282473;":{"priceCent":31600,"price":"316.00","stock":500,"skuId":"3249618852999"},";20509:28313;1627207:1100934058;":{"priceCent":85600,"price":"856.00","stock":500,"skuId":"3250006668124"},";20509:28319;1627207:1007030450;":{"priceCent":65600,"price":"656.00","stock":500,"skuId":"3413519379005"},";20509:28314;1627207:1007030450;":{"priceCent":65600,"price":"656.00","stock":0,"skuId":"3413519379007"},";20509:28318;1627207:790282473;":{"priceCent":31600,"price":"316.00","stock":500,"skuId":"3249618852998"},";20509:28315;1627207:1007030450;":{"priceCent":65600,"price":"656.00","stock":0,"skuId":"3413519379008"},";20509:28316;1627207:1569789026;":{"priceCent":53600,"price":"536.00","stock":500,"skuId":"3250006668142"},";20509:28315;1627207:1473871118;":{"priceCent":65600,"price":"656.00","stock":499,"skuId":"3249618852990"}},"salesProp":{}},"valLoginIndicator":"//buy.taobao.com/auction/buy.htm?from=itemDetail&id=541358973641","isShowSizeRecommend":false,"isDoubleElevenItem":true,"isHouseholdService":false,"isSevenDaysRefundment":false,"apiBidCount":"//tbskip.taobao.com/json/show_bid_count.htm?itemNumId=541358973641&old_quantity=33095&date=1613550736000","valTimeLeft":600467,"standingDate":0,"tradeParams":{},"api":{"descUrl":"//dscnew.taobao.com/i7/540/351/541358973641/TB1KLqabPgy_uJjSZKb8qtXkXla.desc%7Cvar%5Edesc%3Bsign%5Ecd3b5f8a9772728be92bc344e7cfbd42%3Blang%5Egbk%3Bt%5E1612345056","httpsDescUrl":"//descnew.taobao.com/i7/540/351/541358973641/TB1KLqabPgy_uJjSZKb8qtXkXla.desc%7Cvar%5Edesc%3Bsign%5Ecd3b5f8a9772728be92bc344e7cfbd42%3Blang%5Egbk%3Bt%5E1612345056","fetchDcUrl":"//hdc1new.taobao.com/asyn.htm?pageId=1308989908&userId=1695868671"},"tag":{"isShowMeiliXinde":false,"isMedical":false,"isRightRecommend":true,"isShowEcityIcon":false,"isShowYuanchuanIcon":false,"isBrandAttr":true,"isShowTryReport":false,"isAsynDesc":true,"isBrandSiteRightColumn":true,"isShowHouseIcon":false},"isService":false,"isTripUser":false,"cmCatId":"0","cartEnable":true,"renderSystemServer":"//render.taobao.com","carCascade":false,"isWTContract":false,"isOnlyInMobile":false,"isAreaSell":false,"isMultiPoint":true,"isShowSizeHelper":false,"isMeiz":false,"newSelectCityApi":"//mdskip.taobao.com/json/detailSelectCity.do?isAreaSell=false&itemId=541358973641","initCspuExtraApi":"//ext-mdskip.taobao.com/extension/initCspuExtra.htm","detail":{"isMemberShopItem":false,"isBundleItem":false,"canEditInItemDet":true,"isAllowReport":true,"isHiddenShopAction":false,"isDownShelf":false,"is0YuanBuy":false,"isCarService":false,"isShowEcityBasicSign":false,"isItemAllowSellerView":true,"goNewAuctionFlow":false,"isShowEcityVerticalSign":false,"reviewListType":1,"rxShowTitle":"本品为处方药，请在医师指导下使用。","isVaccine":false,"isHasPos":false,"recommendBigMarkDownEndTime":"1477880000000","isAutoYushou":false,"isOnePriceCar":false,"isVitual3C":false,"rxIcon":"https://gw.alicdn.com/tfs/TB13T_zHHrpK1RjSZTEXXcWAVXa-216-84.png","isFullCarSell":false,"isHideAttentionBtn":false,"isNABundleItem":false,"double11StartTime":"","showDiscountRecommend":false,"enableAliMedicalComponent":true,"isOtcDrug":false,"isYYZY":false,"mlhNewDesc":false,"isMainLiaoSku":false,"isHkMilk":false,"isEnableAppleSku":true,"isHkItem":false,"isShowContentModuleTitle":false,"isRx2Count":true,"isHiddenNonBuyprice":false,"isH5NewLogin":true,"isHkO2OItem":false,"isSavingEnergy":false,"showFushiPoiInfo":false,"defaultItemPrice":"276.00 - 856.00","globalSellItem":false,"isShowEcityDesc":false,"isSkuColorShow":false,"autoccUser":false,"isMenDianInventroy":false,"isMeilihui":false,"isLadderGroupon":false,"isHidePoi":false,"isNewAttraction":true,"isPreSellBrand":false,"loginBeforeCart":false,"isAutoFinancing":false,"showSuperMarketBuy":false,"isPrescriptionDrug":false,"isHasQualification":false,"recommendBigMarkDownStartTime":"1478793600000","pageType":"default","isIFCShop":false,"isAlicomMasterCard":false,"isCarCascade":false,"isDianQiMeiJia":false,"isSkuMemorized":false,"addressLevel":2,"isRx2":false,"isTeMai":false,"allowRate":true,"isShowPreClosed":false,"isO2OStaging":false,"isPurchaseMallVipBuyer":false,"cdn75":false,"isNewMedical":false,"isCarYuEBao":false,"isAliHouse":false,"isCyclePurchase":false,"isChineseMedicinalMaterial":false,"isAliTelecomNew":false,"show9sVideo":true,"isHkDirectSale":false,"isTspace":false,"tryReportDisable":false,"isB2Byao":false,"isRegionLevel":false,"isContractPhoneItem":false,"isYY":false,"supermarketAndQianggou":false,"isZhengChe":false,"isDianZiMendian":false,"isNextDayService":false,"timeKillAuction":false},"apiAddCart":"//cart.taobao.com/add_cart_item.htm?item_id=541358973641","apiBeans":"//count.taobao.com/counter3?keys=SM_368_dsr-1695868671,ICCP_1_541358973641","idsMod":[],"initApi":"//mdskip.taobao.com/core/initItemDetail.htm?isUseInventoryCenter=false&cartEnable=true&service3C=false&isApparel=true&isSecKill=false&tmallBuySupport=true&isAreaSell=false&tryBeforeBuy=false&offlineShop=false&itemId=541358973641&showShopProm=false&isPurchaseMallPage=false&itemGmtModified=1612899372000&isRegionLevel=false&household=false&sellerPreview=false&queryMemberRight=true&addressLevel=2&isForbidBuyItem=false","valPointTimes":1.0,"changeLocationApi":"//mdskip.taobao.com/core/changeLocation.htm?isUseInventoryCenter=false&cartEnable=true&sellerUserTag3=144185694259019904&service3C=false&sellerUserTag2=18015687536541704&isSecKill=false&isAreaSell=false&sellerUserTag4=1729382398646306179&offlineShop=false&itemId=541358973641&sellerUserTag=34672674&showShopProm=false&tgTag=false&isPurchaseMallPage=false&isRegionLevel=false&household=false&notAllowOriginPrice=false&addressLevel=2","isTmallComboSupport":false,"serviceIconList":[{"description":"该商品加入了“公益宝贝”计划","tagLink":"//service.taobao.com/support/main/help_quick.htm?q=%25E4%25BB%2580%25E4%25B9%2588%25E6%2598%25AF%25E5%2585%25AC%25E7%259B%258A%25E5%25AE%259D%25E8%25B4%259D%25EF%25BC%259F","tagImage":"//img.alicdn.com/tps/i4/T18aVfFI0dXXcsE9Te-40-42.png"}],"valPointRate":0.5,"tradeType":2,"valMode":128,"initExtraApi":"//ext-mdskip.taobao.com/extension/initExtra.htm","itemDO":{"isInRepository":false,"isSupportTryBeforeBuy":false,"reservePrice":"856.00","isSecondKillFromMobile":false,"cspuCategorySwitch":false,"isOnline":true,"title":"秋冬新款职业套装女时尚毛呢外套气质西服正装女套裙美容师工作服","isEnterprisePath":false,"showCompanyPurchase":false,"isDcAsyn":true,"feature":"1","attachImgUrl":["//img.alicdn.com/imgextra/i3/1695868671/O1CN01QTBC0x2DvMnDRP5uh_!!1695868671.jpg","//img.alicdn.com/imgextra/i4/1695868671/TB2sy4kdLSM.eBjSZFNXXbgYpXa_!!1695868671.jpg"],"isElecCouponItem":false,"brandSiteId":"0","brandSpecialSold":"false","sellerNickName":"jme%E6%9C%8D%E9%A5%B0%E6%97%97%E8%88%B0%E5%BA%97","isSecondKillFromPC":false,"auctionType":"b","encryptSellerId":"UvFxSMFgLOmxuvQTT","prov":"福建","brand":"J-ME","isDefaultChooseTryBeforeBuy":false,"quantity":25495,"isBidden":false,"hasSku":true,"isNewProGroup":false,"weight":"0","userId":"1695868671","rootCatId":"16","itemId":"541358973641","validatorUrl":"//store.taobao.com/tadget/shop_stats.htm","isCustomizedItem":false,"auctionStatus":"0","isSecondKillFromPCAndWap":false,"brandId":"3973873","sellProgressiveRate":"3_100_1.60;6_0_4.50;9_0_6.00","spuId":"710293386","categoryId":"162401"},"rateConfig":{"itemId":541358973641,"sellerId":1695868671,"rateScoreCacheDisable":false,"rateSubjectDisable":false,"tryReportDisable":false,"rateScoreDisable":false,"rateEnable":true,"spuId":710293386,"rateNewChartDisable":false,"listType":1,"rateCloudDisable":false},"rstShopId":104124092,"propertyPics":{";1627207:43602;":["//img.alicdn.com/imgextra/i4/1695868671/TB2EDPlbY5K.eBjy0FnXXaZzVXa_!!1695868671.jpg"],";1627207:991520546;":["//img.alicdn.com/imgextra/i4/1695868671/TB2Jgx_bYOJ.eBjy1XaXXbNupXa_!!1695868671.jpg"],"default":["//img.alicdn.com/imgextra/i1/1695868671/O1CN01xbCtIZ2DvMrnVCUPI_!!0-item_pic.jpg","//img.alicdn.com/imgextra/i2/1695868671/TB2XdJJg8DH8KJjSszcXXbDTFXa_!!1695868671.jpg","//img.alicdn.com/imgextra/i1/1695868671/TB1aj6scDTI8KJjSsphXXcFppXa_!!0-item_pic.jpg","//img.alicdn.com/imgextra/i2/1695868671/TB2nkJIbY1J.eBjy1zeXXX9kVXa_!!1695868671.jpg","//img.alicdn.com/imgextra/i3/1695868671/TB2Y_1ccyGO.eBjSZFpXXb3tFXa_!!1695868671.jpg"],";1627207:1198900190;":["//img.alicdn.com/imgextra/i1/1695868671/TB2Aj1PcByN.eBjSZFgXXXmGXXa_!!1695868671.jpg"],";1627207:1007030450;":["//img.alicdn.com/imgextra/i2/1695868671/TB2kZF1b9iJ.eBjSszfXXa4bVXa_!!1695868671.jpg"],";1627207:1569789026;":["//img.alicdn.com/imgextra/i4/1695868671/TB2q.CQcp5N.eBjSZFKXXX_QVXa_!!1695868671.jpg"],";1627207:818642468;":["//img.alicdn.com/imgextra/i1/1695868671/TB2Nsh1b9iJ.eBjSszfXXa4bVXa_!!1695868671.jpg"],";1627207:1100934058;":["//img.alicdn.com/imgextra/i4/1695868671/TB2uZG8bZaJ.eBjy0FbXXcwrFXa_!!1695868671.jpg"],";1627207:1569789025;":["//img.alicdn.com/imgextra/i1/1695868671/TB2RtHfbY1J.eBjSspnXXbUeXXa_!!1695868671.jpg"],";1627207:732368729;":["//img.alicdn.com/imgextra/i2/1695868671/TB2Cfp3b4mJ.eBjy0FhXXbBdFXa_!!1695868671.jpg"],";1627207:1473871118;":["//img.alicdn.com/imgextra/i3/1695868671/TB2WYaMcCiK.eBjSZFsXXbxZpXa_!!1695868671.jpg"],";1627207:790282473;":["//img.alicdn.com/imgextra/i4/1695868671/TB2iL01b9uJ.eBjy0FgXXXBBXXa_!!1695868671.jpg"]},"tmallRateType":0,"selectRegionApi":"//mdskip.taobao.com/core/selectRegion.do?isAreaSell=false&itemId=541358973641","apiItemViews":"//count.taobao.com/counter2?keys=ICVT_7_541358973641&inc=ICVT_7_541358973641&sign=52921d07335550fad9cf19a6407191eea2b","tagsId":"100609,120321,120577,123649,123905,166402,2049,65281,227074,249858,218369,203521,214273,215809,220673,221697,223489,236801,242945,161793,119298,112386,149761,173313,187649,188673,189441,192769,398594,4614,11015,542466,6411,1803,2059,3851,7947,11531,16395,23563,24075,1240322,1518082,1437442,1618946,1619202,84801,70465,89665,122177,189250,30273,23105,36417,37953,61761,233282,241218,63042,206657,220737,237121,244033,137281,107842,116546,141121,144449,173121,186177,4678,4166,11846,5447,544322,3915,2635,11083,11339,11595,17739,24139,1254210,1619266,112001,115329,150146,175490,385,22145,51329,61825,202370,233346,28802,59010,62082,200321,217985,231553,233089,131713,101762,82306,120962,140161,140417,150145,161921,168321,186753,191873,444802,299394,3974,8583,11143,349570,1163,1675,907,2443,4491,17803,22155,1513090,1517698,1517954,1418882,1434754,1727874,1791618,1833090,66241,67521,103105,108225,111553,120513,28353,29889,33217,37569,40897,243906,246978,15554,25282,57026,207297,223169,223425,236737,107458,140993,149697,159169,178625,179649,188609,427458,299458,1478,371650,4555,3019,2507,1483,4811,5835,6603,7371,15563,23755,1518018,1562306,1800898,1619138,1649602","url":{"tbskip":"//tbskip.taobao.com","mdskip":"//mdskip.taobao.com","tradeForOldTmallBuy":"//stay.buy.tmall.com/order/confirm_order.htm","tgDetailDomain":"//detail.ju.taobao.com","detailServer":"//detail.taobao.com","buyBase":"//buy.taobao.com/auction","mallList":"//list.tmall.com","extMdskip":"//ext-mdskip.taobao.com","xCrossServer":"//mdetail.tmall.com","tgDomain":"//ju.taobao.com","rate":"//rate.tmall.com","tradeBaseUrl":"//trade.taobao.com/trade","topUploadServerBaseUrl":"//upload.taobao.com","BIDRedirectionitemDomain":"//paimai.taobao.com"},"tradeConfig":{"1":"//buy.taobao.com/auction/buy_now.jhtml","2":"//buy.tmall.com/order/confirm_order.htm","3":"//obuy.tmall.com/home/order/confirm_order.htm","4":"","7":"//tw.taobao.com/buy/auction/buy_now.jhtml"},"valCartInfo":{"itemId":"541358973641","cartUrl":"//cart.taobao.com/my_cart.htm?from=bdetail","statsUrl":"//go.mmstat.com/1.gif?logtype=2&category=cart_{loc}_162401"},"isAliTripHK":false,"selectCityApi":"//mdskip.taobao.com/core/selectCity.htm?isAreaSell=false&itemId=541358973641","getProgressiveInfoApi":"//mdskip.taobao.com/core/getProgressiveInfo.do?platform_type=b2c&fromTryBeforeBuy=false&sellerId=1695868671&platform=tmall&category=162401&sellerPercent=3_100_1.60;6_0_4.50;9_0_6.00"}';
        
        
        $arrResponse = (array)json_decode($result, true);
                
        if(str_contains($scrapURL, "detail.tmall.com")){
            $tranArr = $arrResponse['valItemInfo']['skuList'];
            foreach ($tranArr as $key => $value) {
                unset($value['pvs']);
                unset($value['skuId']);
                $tranArr[$key] = $value;  
            }
            $transData = json_encode($tranArr, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
            $trnasResult = (array)json_decode($tr->translate($transData), true);
            //
            //print_r($trnasResult);
            $descData = "";
            foreach ($arrResponse['valItemInfo']['skuList'] as $key => $value) {
                $price = $arrResponse['valItemInfo']['skuMap'][';'.$arrResponse['valItemInfo']['skuList'][$key]['pvs'].';']['price'];
                $ChSize = explode(" ", array_values($arrResponse['valItemInfo']['skuList'][$key])[0], 2);
                $KrSize = explode(" ", array_values($trnasResult[$key])[0], 2);
                $arrResponse['valItemInfo']['skuList'][$key]['price'] = $price;
                $arrResponse['valItemInfo']['skuList'][$key]['basePrice'] = number_format($price * 170, 2, '.', '');
                $arrResponse['valItemInfo']['skuList'][$key]['salePrice'] = number_format(($price + $price * 0.3) * 170, 2, '.', '');
                $arrResponse['valItemInfo']['skuList'][$key]['KrSize'] = $KrSize[0];//$tr->translate($ChSize[0]);
                $arrResponse['valItemInfo']['skuList'][$key]['ChSize'] = $ChSize[0];
                $arrResponse['valItemInfo']['skuList'][$key]['KrColorPattern'] = $KrSize[1];//$tr->translate($ChSize[1].$ChSize[2]);
                $arrResponse['valItemInfo']['skuList'][$key]['ChColorPattern'] = $ChSize[1];
                $arrResponse['valItemInfo']['skuList'][$key]['image'] = $arrResponse['propertyPics'][';'.explode(";", $arrResponse['valItemInfo']['skuList'][$key]['pvs'])[1].';'][0];
                $arrResponse['valItemInfo']['skuList'][$key]['weight'] = 0;
                $descData .= '<div style="pdding-botton:10px; text-align: center;"><p>['.$arrResponse['valItemInfo']['skuList'][$key]['KrColorPattern'].', '.$arrResponse['valItemInfo']['skuList'][$key]['KrSize'].']</p><p><img src="'.$arrResponse['valItemInfo']['skuList'][$key]['image'].'"></p></div>';
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
            $descData .= substr($res, 11, -2);
            $resDetailTmall = array(
                'chMainName' => $arrResponse['itemDO']['title'],
                'krMainName' => $krTitle,
                'keyword' => str_replace(' ', ',', $krTitle),
                'price' => $arrResponse['itemDO']['reservePrice'],
                'items' => $arrResponse['valItemInfo']['skuList'],
                'images' => $arrResponse['propertyPics']['default'],
                'description' => $descData
            );
            //print_r($resDetailTmall);
            return response()->json(["status" => "success", "data" => $resDetailTmall]);
        }
        else if(str_contains($scrapURL, "item.taobao.com"))
        {
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
            //컬러 패턴 번역
            $transData = json_encode(array_values($arrResponse['colors']), JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
            $trnasResult = $tr->translate($transData);
            $transResArr = json_decode($trnasResult);
            $idx=0;
            foreach ($arrResponse['colors'] as $key => $value) {
                $transResArr[$key] = $transResArr[$idx];
                unset($transResArr[$idx]);
                $idx++;
            }
            $price = 0;
            foreach ($arrResponse['skuMap'] as $key => $value) {
                // $price = $arrResponse['valItemInfo']['skuMap'][';'.$arrResponse['valItemInfo']['skuList'][$key]['pvs'].';']['price'];
                // $ChSize = explode(" ", array_values($arrResponse['valItemInfo']['skuList'][$key])[0], 2);
                // $KrSize = explode(" ", array_values($trnasResult[$key])[0], 2);
                if($value['price'] > $price){
                    $price = $value['price'];
                }
                $val = array(
                    "pvs" => $key,
                    "price" => $value['price'],
                    "basePrice" => number_format($value['price'] * 170, 2, ',', ''),
                    "salePrice" => number_format(($value['price'] + $value['price'] * 0.3) * 170, 2, '.', ''),
                    "ChSize" => $arrResponse['sizes'][explode(';', $key)[1]],
                    "KrSize" => $arrResponse['sizes'][explode(';', $key)[1]],
                    "ChColorPattern" => $arrResponse['colors'][explode(';', $key)[2]],
                    "KrColorPattern" => $transResArr[explode(';', $key)[2]],
                    "image" => $arrResponse['colorImages'][explode(';', $key)[2]],
                    "weight" => 0
                );
                $resDetailTaobao['items'][] = $val;
                $descData .= '<div style="pdding-botton:10px; text-align: center;"><p>['.$val['KrColorPattern'].", ".$val['KrSize'].']</p><p><img src="'.$val['image'].'"></p></div>';
            }
            
            $resDetailTaobao['description'] = $descData.str_replace("|", "\"",$arrResponse['description']);
            $resDetailTaobao['images'] = $arrResponse['auctionImages'];
            $resDetailTaobao['price'] = $price;
            return response()->json(["status" => "success", "data" => $resDetailTaobao]);
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
        $brand = $request->post('txtBrandName');
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
            'strComeCode' => $request->post('selComeName'), 
            'strCategoryCode1' => $request->post('selCategoryName1'), 
            'strCategoryCode2' => $request->post('selCategoryName2'), 
            'strCategoryCode3' => $request->post('selCategoryName3'), 
            'strCategoryCode4' => $request->post('selCategoryName4'), 
            'strCategoryName' => $request->post('txtCategoryName'), 
            'nShareType' => $request->post('rdoShareType'),
            'bIsDel'=> 0
        ]);
        $product->save();
        //detail data
        $nMarketPrice = number_format(($request->post('txtBasePrice') + $request->post('txtCountryShippingCost'))*170 + $request->post('txtWorldShippingCost'), 2, '.', '');
        $nMarginPercent = 30;
        $productDetail = new ProductDetail([
            'nProductIdx' => $product->nIdx,
            'strBasePriceType' => $request->post('selBasePriceType'),
            'nBasePrice' => number_format($request->post('txtBasePrice'), 2, '.', ''),
            'strCountryShippingCostType' => $request->post('selCountryShippingCostType'),
            'nCountryShippingCost' => number_format($request->post('txtCountryShippingCost'), 2, '.', ''),
            'strWorldShippingCostType' => $request->post('selWorldShippingCostType'),
            'nWorldShippingCost' => $request->post('txtWorldShippingCost'),
            'strWeightType' => $request->post('selWeightType'),
            'nWeight' => number_format($request->post('txtWeight'), 2, '.', ''),
            'bAdditionalOption1' => number_format($request->post('chkAdditionalOption1')),
            'bAdditionalOption2' => number_format($request->post('chkAdditionalOption2')),
            'bAdditionalOption3' => number_format($request->post('chkAdditionalOption3')),
            'bAdditionalOption4' => number_format($request->post('chkAdditionalOption4')),
            'nMultiPriceOptionType' => number_format($request->post('rdoMultiPriceOptionType')),
            'nMarketPrice' => $nMarketPrice,
            'nMarginPrice' => number_format($nMarketPrice / (100 - $nMarginPercent) /100 + $nMarketPrice, 2, '.', ''),
            'nMarginPercent' => $nMarginPercent,
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
                'nImageCode' => $i,
                'strName' => '',
                'strURL' => $arrDetailImage[$i],
                'nHeight' => 0,
                'nWidth' => 0,
                'strNote' => '',
                'bIsDel' => 0
            ]);
            $productImage->save();
        }

        return redirect('scratchProductScrap');
    }
}
