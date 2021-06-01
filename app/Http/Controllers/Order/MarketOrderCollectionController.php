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
use App\Models\Market;
use App\Models\MarketAccount;
use App\Models\MarketSettingCoupang;
use App\Models\Order;
use App\Models\OrderItem;
use App\MyLibs\CoupangConnector;
use Yajra\DataTables\Facades\DataTables;
use DateTime;
use Illuminate\Support\Facades\DB;

class MarketOrderCollectionController extends Controller
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

        $title = "마켓주문수집";
        
        $markets = Market::where('bIsDel', 0)
                ->where('bIsUsed', 1)
                ->get();
        if ($request->ajax()) {
            $orderItems = OrderItem::where('bIsDel', 0)
            ->whereIn('nOrderIdx', 
                DB::table("tb_orders")
                ->where('nUserId', Auth::id())
                ->pluck('nIdx'));
            return DataTables::eloquent($orderItems)
                    ->addIndexColumn()
                    ->addColumn('check', function($row){
                        $check = '<input type="checkbox" name="chkProduct[]" onclick="" value="'.$row->nIdx.'">';
                        return $check;
                    })
                    ->addColumn('marketInfo', function($row){
                        $element = '<ul class="list-inline" style="">';
                        $element .= '<li class="text-center list-inline-item">
                                '.$row->order->marketAccount->market->strMarketName.'
                            </li><br>';
                        $element .= '<li class="text-center list-inline-item">
                                '.$row->order->marketAccount->strAccountId.'
                            </li><br>';
                        $element .= '</ul>';
                        return $element;
                    })
                    ->addColumn('mainImage', function($row){
                        if($row->strImageUrl==""){
                            $mainImage = '<li class="list-inline-item">
                                    <span>
                                        <img alt="gallery thumbnail" style="width: 5rem;" src="'.asset('assets/images/system/no-image.png').'">
                                    </span>
                            </li>';
                            return $mainImage;
                        }else{
                            $mainImage = '<li class="list-inline-item">
                                <a href="'.asset('storage/'.$row->strImageUrl).'" target="_blank">
                                    <span data="'.asset('storage/'.$row->strImageUrl).'" class="preview">
                                        <img alt="gallery thumbnail" style="width: 5rem;" src="'.asset('storage/'.$row->strImageUrl).'">
                                    </span>
                                </a>
                            </li>';
                            return $mainImage;
                        }
                    })
                    ->addColumn('productInfo', function($row){
                        $element = '<ul class="list-inline" style="">';
                        $element .= '<li class="list-inline-item" style="font-size:14px;">
                                '.$row->strVendorItemPackageName.'
                            </li><br>';
                        $element .= '<li class="list-inline-item " style="font-size:11px;">
                                '.$row->strFirstSellerProductItemName.'
                            </li><br>';
                        $checked0 = $row->nRequestType == 0 ? "checked" : "";
                        $checked1 = $row->nRequestType == 1 ? "checked" : "";
                        $element .='<div class="input-group">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input mt-1 rdoRequestType" data-id="'.$row->nIdx.'" type="radio" id="rdoRequestType1_'.$row->nIdx.'" name="rdoRequestType_'.$row->nIdx.'" value="1" '.$checked1.'>
                                    <label for="rdoRequestType1_'.$row->nIdx.'" style="padding-top:4px; font-size:10px;" class="custom-control-label">구매요청</label>
                                </div>
                                <div class="custom-control custom-radio ml-3">
                                    <input class="custom-control-input rdoRequestType" data-id="'.$row->nIdx.'" type="radio" id="rdoRequestType2_'.$row->nIdx.'" name="rdoRequestType_'.$row->nIdx.'" value="0" '.$checked0.'>
                                    <label for="rdoRequestType2_'.$row->nIdx.'" style="padding-top:4px; font-size:10px;" class="custom-control-label">직접구매</label>
                                </div>
                            </div>';
                        $element .= '</ul>';
                        return $element;
                    })
                    ->addColumn('ICNumber', function($row){
                        $element = '<ul class="list-inline">';
                        $element .= '<li class="list-inline-item" style="font-size:14px;">
                                '.$row->strProductId.'
                            </li>';
                        $element .= '</ul>';
                        return $element;
                    })
                    ->addColumn('orderNumber', function($row){
                        $element = '<ul class="list-inline">';
                        $element .= '<li class="list-inline-item" style="font-size:14px;">
                            '.$row->order->strShipmentBoxId.'
                        </li><br>';
                        $element .= '<li class="list-inline-item" style="font-size:14px;">
                            '.$row->order->strOrderId.'
                        </li>';
                        $element .= '</ul>';
                        return $element;
                    })
                    ->addColumn('OrderPayDate', function($row){
                        $element = '<ul class="list-inline">';
                        $element .= '<li class="list-inline-item" style="font-size:14px;">
                            '.$row->order->dtOrderedAt.'
                        </li><br>';
                        $element .= '<li class="list-inline-item" style="font-size:14px;">
                            '.$row->order->dtPaidAt.'
                        </li><br>';
                        $element .= '</ul>';
                        return $element;
                    })
                    ->addColumn('ODInfo', function($row){
                        $element = '<ul class="list-inline">';
                        $element .= '<li class="list-inline-item">
                            '.$row->order->strOrdererName.'
                        </li><br>';
                        $element .= '<li class="list-inline-item">
                            '.$row->order->strReceiverName.'
                        </li><br>';
                        $element .= '<li class="list-inline-item">
                            '.$row->order->strReceiverAddr1.' '.$row->order->strReceiverAddr2.'
                        </li><br>';
                        $element .= '</ul>';
                        return $element;
                    })
                    ->addColumn('action', function($row){
                        $element = "";
                        if($row->nWorkProcess == 0){
                            $element = '<button type="button" data-id="'.$row->nIdx.'" style="font-size:10px !important;" class="btn btn-xs btn-primary btnManualMatching btnMatching">수동매칭</button>';
                        }else if ($row->nWorkProcess == 1) {
                            $element = '<button type="button" data-id="'.$row->nIdx.'" style="font-size:10px !important;" class="btn btn-xs btn-primary btnAutoMatching btnMatching">자동매칭</button>';
                        }else if ($row->nWorkProcess == 2) {
                            $element = '<button type="button" data-id="'.$row->nIdx.'" style="font-size:10px !important;" class="btn btn-xs btn-primary btnOptionMatching btnMatching">옵션매칭</button>';
                        }else{
                            $element = '<span>매칭완료</span>';
                        }
                        
                        return $element;
                    })
                    ->filter(function($query) use ($request){
                        //마켓
                        $query->when($request->get('chkMatchY') == 1 || $request->get('chkMatchN') == 1, function($query2) use ($request) {
                            $cond1 = $request->get('chkMatchN');
                            $cond2 = $request->get('chkMatchY');
                            if(!($cond1 && $cond2)){
                                if($cond1){
                                    $query2->where('nProductItemIdx', 0);
                                }else if($cond2){
                                    $query2->where('nProductItemIdx', '<>', 0);
                                }
                            }                                 
                        })
                        ->when($request->get('searchWord') != "", function($query2) use ($request) {
                            $cond = $request->get('searchWord');
                            $query2->where('strVendorItemPackageId', 'like', '%'.$cond.'%')
                                ->orWhere('strVendorItemPackageName', 'like', '%'.$cond.'%')
                                ->orWhere('strVendorItemName', 'like', '%'.$cond.'%')
                                ->orWhere('strSellerProductName', 'like', '%'.$cond.'%')
                                ->orWhere('strSellerProductItemName', 'like', '%'.$cond.'%')
                                ->orWhere('strFirstSellerProductItemName', 'like', '%'.$cond.'%')
                                ->orWhere('strDeliveryChargeTypeName', 'like', '%'.$cond.'%');
                        })
                        ->when($request->get('selMarketId') > 0, function($query2) use ($request) {
                            $cond = $request->get('selMarketId');
                            $condArr = MarketAccount::where('nMarketIdx', $cond)->pluck('nIdx');
                            $cond1 = Order::whereIn('nMarketAccIdx', $condArr);
                            $query2->whereIn('nMarketAccIdx', 
                                MarketSettingCoupang::where('nOrderIdx', $cond)
                                ->pluck('nIdx'))
                            ->get();
                        });
                    })
                    ->rawColumns(['check', 'marketInfo', 'mainImage', 'productInfo', 'ICNumber', 'orderNumber', 'OrderPayDate', 'ODInfo', 'action'])
                    ->make(true);
                    
        }
        return view('order.MarketOrderCollectionManage', compact('title', 'markets'));
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
    //발주서조회를 위한 마켓계정 리스트(get)
    public function getMarketAccountList()
    {
        
        $marketAccounts = MarketAccount::where('nUserId', Auth::id())
                                        ->get();

        return view('order.MarketAccountList', compact('marketAccounts'));
    }

    //마켓주문수집
    //발주서조회를 위한 마켓계정 리스트(post)
    public function getMarketOrderList(Request $request)
    {
        
        $chkAccount = $request->get('chkAccount');
        
        $accounts = MarketAccount::where('nUserId', Auth::id())
                                        ->whereIn('nIdx', $chkAccount)
                                        ->get();
        //dd($accounts);
        $markets = Market::where('strMarketCode', 'coupang');
        $productsCount = 0;
        $successCount = 0;
        $failedCount = 0;

        $coupang = new CoupangConnector();
        foreach ($accounts as $key1 => $account) {
            $coupang = new CoupangConnector($account->strAPIAccessKey, $account->strSecretKey, $account->strVendorId, $account->strAccountId);
            $date = new DateTime('now');
            $start_date = $date->format('Y-m-d H:i:s');
            $date->modify('+1 day');
            $end_date = $date->format('Y-m-d H:i:s');
            $res =  (object)json_decode($coupang->getOrderSheetsDayList($start_date, $end_date, 50), false);
            
            if($res->code == "200"){
                $cnt = count($res->data);
                foreach ($res->data as $key2 => $order) {
                    
                    $orderM = new Order([
                        'nUserId'                             => Auth::id(),
                        'nMarketAccIdx'                       => $account->nIdx,
                        'strShipmentBoxId'                    => $order->shipmentBoxId,
                        'strOrderId'                          => $order->orderId,
                        'dtOrderedAt'                         => $order->orderedAt,
                        'strOrdererName'                      => $order->orderer->name,
                        'strOrdererEmail'                     => $order->orderer->email,
                        'strOrdererSafeNumber'                => $order->orderer->safeNumber,
                        'strOrdererNumber'                    => $order->orderer->ordererNumber,
                        'dtPaidAt'                            => $order->paidAt,
                        'strStatus'                           => $order->status,
                        'nShippingPrice'                      => $order->shippingPrice,
                        'nRemotePrice'                        => $order->remotePrice,
                        'bRemoteArea'                         => $order->remoteArea,
                        'strParcelPrintMessage'               => $order->parcelPrintMessage,
                        'bSplitShipping'                      => $order->splitShipping,
                        'bAbleSplitShipping'                  => $order->ableSplitShipping,
                        'strReceiverName'                     => $order->receiver->name,
                        'strReceiverSafeNumber'               => $order->receiver->safeNumber,
                        'strReceiverNumber'                   => $order->receiver->receiverNumber,
                        'strReceiverAddr1'                    => $order->receiver->addr1,
                        'strReceiverAddr2'                    => $order->receiver->addr2,
                        'strPostCode'                         => $order->receiver->postCode,
                        'strOSIDPersonalCustomClearanceCode'  => $order->overseaShippingInfoDto->personalCustomsClearanceCode,
                        'strOSIDOrdererSsn'                   => $order->overseaShippingInfoDto->ordererSsn,
                        'strOSIDOrdererPhoneNumber'           => $order->overseaShippingInfoDto->ordererPhoneNumber,
                        'strDeliveryCompanyName'              => $order->deliveryCompanyName,
                        'strInvoiceNumber'                    => $order->invoiceNumber,
                        'dtInTrasitDateTime'                  => $order->inTrasitDateTime,
                        'dtDeliveredDate'                     => $order->deliveredDate,
                        'strReferer'                          => $order->refer,
                        'bIsDel'                              => 0
                    ]);

                    $orderM->save();
                    
                    foreach ($order->orderItems as $key3 => $orderItem) {
                        
                        $strEtcInfoValues = implode("|", $orderItem->etcInfoValues);
                        $item = new OrderItem([
                            'nOrderIdx'                      => $orderM->nIdx,
                            'strVendorItemPackageId'         => $orderItem->vendorItemPackageId,
                            'strVendorItemPackageName'       => $orderItem->vendorItemPackageName,
                            'strProductId'                   => $orderItem->productId,
                            'strVendorItemId'                => $orderItem->vendorItemId,
                            'strVendorItemName'              => $orderItem->vendorItemName,
                            'nShippingCount'                 => $orderItem->shippingCount,
                            'nSalesPrice'                    => $orderItem->salesPrice,
                            'nOrderPrice'                    => $orderItem->orderPrice,
                            'nDiscountPrice'                 => $orderItem->discountPrice,
                            'nInstantCouponDiscount'         => $orderItem->instantCouponDiscount,
                            'nDownloadableCouponDiscount'    => $orderItem->downloadableCouponDiscount,
                            'nCoupangDiscount'               => $orderItem->coupangDiscount,
                            'strExternalVendorSkuCode'       => $orderItem->externalVendorSkuCode,
                            'strEtcInfoHeader'               => $orderItem->etcInfoHeader,
                            'strEtcInfoValue'                => $orderItem->etcInfoValue,
                            'strEtcInfoValues'               => $strEtcInfoValues,//$orderItem->strEtcInfoValues,
                            'strSellerProductId'             => $orderItem->sellerProductId,
                            'strSellerProductName'           => $orderItem->sellerProductName,
                            'strSellerProductItemName'       => $orderItem->sellerProductItemName,
                            'strFirstSellerProductItemName'  => $orderItem->firstSellerProductItemName,
                            'nCancelCount'                   => $orderItem->cancelCount,
                            'nHoldCountForCancel'            => $orderItem->holdCountForCancel,
                            'dtEstimatedShippingDate'        => $orderItem->estimatedShippingDate == "" ? "0000-00-00 00:00:00" : $orderItem->estimatedShippingDate,
                            'dtPlannedShippingDate'          => $orderItem->plannedShippingDate == "" ? "0000-00-00 00:00:00" : $orderItem->plannedShippingDate,
                            'dtInvoiceNumberUploadDate'      => $orderItem->invoiceNumberUploadDate,
                            'strExtraProperties'             => "",//$orderItem->extraProperties
                            'bPricingBadge'                  => $orderItem->pricingBadge,
                            'bUsedProduct'                   => $orderItem->usedProduct,
                            'dtConfirmDate'                  => $orderItem->confirmDate,
                            'strDeliveryChargeTypeName'      => $orderItem->deliveryChargeTypeName,
                            'bCanceled'                      => $orderItem->canceled,
                            'bIsDel'                         => 0
                        ]);
                        $item->save();
                    }
                }
            }
            
        }
          
        //return view('order.MarketAccountList', compact('marketAccounts'));
    }
    
    public function updateRequestType($orderItemId, Request $request){
        $val = $request->post('value');
        $orderItem = OrderItem::find($orderItemId)->update(['nRequestType' => $val]);
        return response()->json(["status" => "success", "data" => $orderItem]);
    }

    public function getMatchProductList($orderItemId){
        
        $products = Product::where('bIsDel', 0)
            ->where('nUserId', Auth::id())
            ->get();
            
        // $product->productMainImage = $product->productImages->where('nImageCode',0)->first() == null ? new SuccessProductImage() : $product->productImages->where('nImageCode',0)->first();
        // $product->productSubImage1 = $product->productImages->where('nImageCode',1)->first() == null ? new SuccessProductImage() : $product->productImages->where('nImageCode',1)->first();
        // $product->productSubImage2 = $product->productImages->where('nImageCode',2)->first() == null ? new SuccessProductImage() : $product->productImages->where('nImageCode',2)->first();
        
        return view('order.MatchProductList', compact('orderItemId', 'products'));
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
