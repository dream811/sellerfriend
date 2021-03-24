<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/** 수집관리 **/
//1
Route::get('/scratchProductScrap', [App\Http\Controllers\Scratch\ProductScrapController::class, 'index'])->name('scratch.ProductScrap');
Route::post('/scratchProductScrap', [App\Http\Controllers\Scratch\ProductScrapController::class, 'save'])->name('scratch.ProductScrap');
Route::get('/scratchProductScrap/scratch', [App\Http\Controllers\Scratch\ProductScrapController::class, 'scratch'])->name('scratch.ProductScrapScratch');
//2
Route::get('/scratchProductGetManage', [App\Http\Controllers\Scratch\ProductGetManageController::class, 'index'])->name('scratch.ProductGetManage');
Route::put('/scratchProductGetManage/{productId}', [App\Http\Controllers\Scratch\ProductGetManageController::class, 'update'])->name('scratch.ProductGetManage.update');
//3
Route::get('/scratchSellPrepareCheck', [App\Http\Controllers\Scratch\SellPrepareCheckController::class, 'index'])->name('scratch.SellPrepareCheck');
Route::put('/scratchSellPrepareCheck/{productId}', [App\Http\Controllers\Scratch\SellPrepareCheckController::class, 'update'])->name('scratch.SellPrepareCheck.update');
//4
Route::get('/scratchDesignCheck', [App\Http\Controllers\Scratch\DesignCheckController::class, 'index'])->name('scratch.DesignCheck');
Route::put('/scratchDesignCheck/{productId}', [App\Http\Controllers\Scratch\DesignCheckController::class, 'update'])->name('scratch.DesignCheck.update');
/** 상품관리 **/
//1
Route::get('/productSellTargetManage', [App\Http\Controllers\Product\SellTargetManageController::class, 'index'])->name('product.SellTargetManage');
//**??? */
Route::get('/productSellTargetManageProducts', [App\Http\Controllers\Product\SellTargetManageController::class, 'producSele'])->name('product.SellTargetManageProducts');
Route::post('/productSellTargetManageProducts/marketProductAdd', [App\Http\Controllers\Product\SellTargetManageController::class, 'marketProductAdd'])->name('product.SellTargetManageMarketProductAdd');
//Route::post('/productSellTargetManageProducts/addMarketProduct', [App\Http\Controllers\Product\SellTargetManageController::class, 'saveMarketProduct'])->name('product.SellTargetManageAddMarketProduct');
Route::get('/productSellTargetManageProducts/marketAccountList', [App\Http\Controllers\Product\SellTargetManageController::class, 'marketAccountList'])->name('product.MarketAccountList');

Route::post('/productSellTargetManageProducts/marketAccountList', [App\Http\Controllers\Product\SellTargetManageController::class, 'marketAccountSave'])->name('product.MarketAccountSave');

Route::post('/productSellTargetManageProducts/marketAccountSelect', [App\Http\Controllers\Product\SellTargetManageController::class, 'marketAccountSelect'])->name('product.MarketAccountSelect');
Route::post('/productSellTargetManageProducts/marketAccountProduct', [App\Http\Controllers\Product\SellTargetManageController::class, 'marketAccountProduct'])->name('product.MarketAccountProduct');
Route::get('/productSearchMarketCategory/{marketCode}/category/{categoryCode}/setting/{setId}', [App\Http\Controllers\Product\SellTargetManageController::class, 'marketCategorySearch'])->name('product.SearchMarketCategory');
Route::get('/productSearchMarketOptionMapping/{marketCode}/category/{categoryCode}', [App\Http\Controllers\Product\SellTargetManageController::class, 'marketOptionMappingSearch'])->name('product.SearchMarketOptionMapping');
//2
Route::get('/productRegisteredProductManage', [App\Http\Controllers\Product\RegisteredProductManageController::class, 'index'])->name('product.RegisteredProductManage');
//3
Route::get('/productFailedProductManage', [App\Http\Controllers\Product\FailedProductManageController::class, 'index'])->name('product.FailedProductManage');
//4
Route::get('/productStoppedProductManage', [App\Http\Controllers\Product\StoppedProductManageController::class, 'index'])->name('product.StoppedProductManage');
/** 주문관리 **/
Route::get('/orderWaiting', [App\Http\Controllers\Order\WaitingController::class, 'index'])->name('order.Waiting');

Route::get('/orderSalesStatus', [App\Http\Controllers\Order\SalesStatusController::class, 'index'])->name('order.SalesStatus');
Route::get('/orderMarketOrderCollection', [App\Http\Controllers\Order\MarketOrderCollectionController::class, 'index'])->name('order.MarketOrderCollection');
Route::get('/orderMarketOrderCollection/getMarketAccountList', [App\Http\Controllers\Order\MarketOrderCollectionController::class, 'getMarketAccountList'])->name('order.MarketOrderCollection.GetMarketAccountList');
Route::post('/orderMarketOrderCollection/GetMarketOrderList', [App\Http\Controllers\Order\MarketOrderCollectionController::class, 'getMarketOrderList'])->name('order.MarketOrderCollection.GetMarketOrderList');


Route::get('/orderPaymentWaiting', [App\Http\Controllers\Order\PaymentWaitingController::class, 'index'])->name('order.PaymentWaiting');
Route::get('/orderPassCodeCheck', [App\Http\Controllers\Order\PassCodeCheckController::class, 'index'])->name('order.PassCodeCheck');
Route::get('/orderStockIssueCheck', [App\Http\Controllers\Order\StockIssueCheckController::class, 'index'])->name('order.StockIssueCheck');
Route::get('/orderBuying', [App\Http\Controllers\Order\BuyingController::class, 'index'])->name('order.Buying');
Route::get('/orderPurchasedShipmentWaiting', [App\Http\Controllers\Order\PurchasedShipmentWaitingController::class, 'index'])->name('order.PurchasedShipmentWaiting');
Route::get('/orderChinaShipping', [App\Http\Controllers\Order\ChinaShippingController::class, 'index'])->name('order.ChinaShipping');
Route::get('/orderDestinationArrival', [App\Http\Controllers\Order\DestinationArrivalController::class, 'index'])->name('order.DestinationArrival');
Route::get('/orderBadIncorrectManage', [App\Http\Controllers\Order\BadIncorrectManageController::class, 'index'])->name('order.BadIncorrectManage');
Route::get('/orderOtherPackingWaiting', [App\Http\Controllers\Order\OtherPackingWaitingController::class, 'index'])->name('order.OtherPackingWaiting');
Route::get('/orderUnrecognizedWaybill', [App\Http\Controllers\Order\UnrecognizedWaybillController::class, 'index'])->name('order.UnrecognizedWaybill');
Route::get('/orderKrReturnCommand', [App\Http\Controllers\Order\KrReturnCommandController::class, 'index'])->name('order.KrReturnCommand');
Route::get('/orderChReturnCommand', [App\Http\Controllers\Order\ChReturnCommandController::class, 'index'])->name('order.ChReturnCommand');
Route::get('/orderPackingComplete', [App\Http\Controllers\Order\PackingCompleteController::class, 'index'])->name('order.PackingComplete');
Route::get('/orderPassing', [App\Http\Controllers\Order\PassingController::class, 'index'])->name('order.Passing');
Route::get('/orderPassStrangeReport', [App\Http\Controllers\Order\PassStrangeReportController::class, 'index'])->name('order.PassStrangeReport');
Route::get('/orderKrWarehouseArrival', [App\Http\Controllers\Order\KrWarehouseArrivalController::class, 'index'])->name('order.KrWarehouseArrival');
Route::get('/orderKoreaShipping', [App\Http\Controllers\Order\KoreaShippingController::class, 'index'])->name('order.KoreaShipping');
Route::get('/orderCourierChange', [App\Http\Controllers\Order\CourierChangeController::class, 'index'])->name('order.CourierChange');
Route::get('/orderDeliveryComplete', [App\Http\Controllers\Order\DeliveryCompleteController::class, 'index'])->name('order.DeliveryComplete');
Route::get('/orderPurchaseComplete', [App\Http\Controllers\Order\PurchaseCompleteController::class, 'index'])->name('order.PurchaseComplete');
Route::get('/orderUnsoldableProduct', [App\Http\Controllers\Order\UnsoldableProductController::class, 'index'])->name('order.UnsoldableProduct');
Route::get('/orderCancelledProduct', [App\Http\Controllers\Order\CancelledProductController::class, 'index'])->name('order.CancelledProduct');
//3pl(tpl) 창고입고
Route::get('/tplReceiptRequest', [App\Http\Controllers\Tpl\ReceiptRequestController::class, 'index'])->name('tpl.ReceiptRequest');
Route::get('/tplReceiptConfirm', [App\Http\Controllers\Tpl\ReceiptConfirmController::class, 'index'])->name('tpl.ReceiptConfirm');
Route::get('/tplPurchaseRequestChWarehouse', [App\Http\Controllers\Tpl\PurchaseRequestChWarehouseController::class, 'index'])->name('tpl.PurchaseRequestChWarehouse');
Route::get('/tplPurchaseRequestKrWarehouse', [App\Http\Controllers\Tpl\PurchaseRequestKrWarehouseController::class, 'index'])->name('tpl.PurchaseRequestKrWarehouse');
Route::get('/tplDirectPurchaseChWarehouse', [App\Http\Controllers\Tpl\DirectPurchaseChWarehouseController::class, 'index'])->name('tpl.DirectPurchaseChWarehouse');
Route::get('/tplDirectPurchaseKrWarehouse', [App\Http\Controllers\Tpl\DirectPurchaseKrWarehouseController::class, 'index'])->name('tpl.DirectPurchaseKrWarehouse');
Route::get('/tplPreparing', [App\Http\Controllers\Tpl\PreparingController::class, 'index'])->name('tpl.Preparing');
Route::get('/tplPurchasedShipmentWaiting', [App\Http\Controllers\Tpl\PurchasedShipmentWaitingController::class, 'index'])->name('tpl.PurchasedShipmentWaiting');
Route::get('/tplChinaShipping', [App\Http\Controllers\Tpl\ChinaShippingController::class, 'index'])->name('tpl.ChinaShipping');
Route::get('/tplDestinationArrival', [App\Http\Controllers\Tpl\DestinationArrivalController::class, 'index'])->name('tpl.DestinationArrival');
Route::get('/tplPackingComplete', [App\Http\Controllers\Tpl\PackingCompleteController::class, 'index'])->name('tpl.PackingComplete');
Route::get('/tplPassing', [App\Http\Controllers\Tpl\PassingController::class, 'index'])->name('tpl.Passing');
Route::get('/tplWarehouseArrival', [App\Http\Controllers\Tpl\WarehouseArrivalController::class, 'index'])->name('tpl.WarehouseArrival');
Route::get('/tplOutRequest', [App\Http\Controllers\Tpl\OutRequestController::class, 'index'])->name('tpl.OutRequest');
Route::get('/tplOutComplete', [App\Http\Controllers\Tpl\OutCompleteController::class, 'index'])->name('tpl.OutComplete');
/** 재고관리 **/
Route::get('/inventoryManage', [App\Http\Controllers\Inventory\ManageController::class, 'index'])->name('inventory.Manage');
/** 정산관리 **/
Route::get('/calculateMonthlySalesManage', [App\Http\Controllers\Calculate\MonthlySalesManageController::class, 'index'])->name('calculate.MonthlySalesManage');
Route::get('/calculateDailySalesManage', [App\Http\Controllers\Calculate\DailySalesManageController::class, 'index'])->name('calculate.DailySalesManage');
Route::get('/calculateAllSaleManage', [App\Http\Controllers\Calculate\AllSaleManageController::class, 'index'])->name('calculate.AllSaleManage');
Route::get('/calculatePurchaseManage', [App\Http\Controllers\Calculate\PurchaseManageController::class, 'index'])->name('calculate.PurchaseManage');
Route::get('/calculateCategoryTaxManage', [App\Http\Controllers\Calculate\CategoryTaxManageController::class, 'index'])->name('calculate.CategoryTaxManage');
/** 통계관리 **/
Route::get('/statisticsDailySaleStatus', [App\Http\Controllers\Statistics\DailySaleStatusController::class, 'index'])->name('statistics.DailySaleStatus');
Route::get('/statisticsYearMonthlySaleStatus', [App\Http\Controllers\Statistics\YearMonthlySaleStatusController::class, 'index'])->name('statistics.YearMonthlySaleStatus');
Route::get('/statisticsDepartmentSaleStatus', [App\Http\Controllers\Statistics\DepartmentSaleStatusController::class, 'index'])->name('statistics.DepartmentSaleStatus');
Route::get('/statisticsMarketSaleStatus', [App\Http\Controllers\Statistics\MarketSaleStatusController::class, 'index'])->name('statistics.MarketSaleStatus');
Route::get('/statisticsSellerSaleStatus', [App\Http\Controllers\Statistics\SellerSaleStatusController::class, 'index'])->name('statistics.SellerSaleStatus');
/** 운영관리 **/ 
//오픈마켓관리
Route::get('/operationOpenMarketManage', [App\Http\Controllers\Operation\OpenMarketManageController::class, 'index'])->name('operation.OpenMarketManage');
Route::get('/operationOpenMarketManage/{marketId}/Accounts', [App\Http\Controllers\Operation\OpenMarketManageController::class, 'accounts'])->name('operation.OpenMarketManageAccounts');
Route::post('/operationOpenMarketManage/{marketId}/AccountSave', [App\Http\Controllers\Operation\OpenMarketManageController::class, 'accountSave'])->name('operation.OpenMarketManageAccountSave');
Route::get('/operationOpenMarketManage/{marketId}/AccountShow/{accountId}', [App\Http\Controllers\Operation\OpenMarketManageController::class, 'accountShow'])->name('operation.OpenMarketManageAccountShow');
Route::post('/operationOpenMarketManage/{marketId}/AccountUpdate/{accountId}', [App\Http\Controllers\Operation\OpenMarketManageController::class, 'accountUpdate'])->name('operation.OpenMarketManageAccountUpdate');
Route::get('/operationOpenMarketManage/{marketId}/AccountDelete/{accountId}', [App\Http\Controllers\Operation\OpenMarketManageController::class, 'accountDelete'])->name('operation.OpenMarketManageAccountDelete');
//기초설정관리
Route::get('/operationBasicSettingManage', [App\Http\Controllers\Operation\BasicSettingManageController::class, 'index'])->name('operation.BasicSettingManage');
Route::get('/operationBasicSettingManage/{market_code}/setting/{set_id}', [App\Http\Controllers\Operation\BasicSettingManageController::class, 'setting'])->name('operation.BasicSettingManageSetting');
Route::get('/operationBasicSettingManage/{market_code}/settingDelete/{set_id}', [App\Http\Controllers\Operation\BasicSettingManageController::class, 'settingDelete'])->name('operation.BasicSettingManageSettingDelete');
//출고지 정보
Route::get('/operationBasicSettingManage/SearchOutboundShippingPlace/{market_id}/account/{account_id}', [App\Http\Controllers\Operation\BasicSettingManageController::class, 'searchOutboundShippingPlace'])->name('operation.BasicSettingManageSetting.SearchOutboundShippingPlace');
//반품지 정보
Route::get('/operationBasicSettingManage/SearchReturnShippingCenter/{market_id}/account/{account_id}', [App\Http\Controllers\Operation\BasicSettingManageController::class, 'searchReturnShippingCenter'])->name('operation.BasicSettingManageSetting.SearchReturnShippingCenter');
//기초설정보관
Route::post('/operationBasicSettingManage/{market_code}/setting/{set_id}', [App\Http\Controllers\Operation\BasicSettingManageController::class, 'settingSave'])->name('operation.BasicSettingManageSettingSave');
//상하단이미지관리
Route::get('/operationTopDownImageManage', [App\Http\Controllers\Operation\TopDownImageManageController::class, 'index'])->name('operation.TopDownImageManage');
Route::post('/operationTopDownImageManage', [App\Http\Controllers\Operation\TopDownImageManageController::class, 'store'])->name('operation.TopDownImageManageStore');
Route::get('/operationTopDownImageManage/{imageId}/edit', [App\Http\Controllers\Operation\TopDownImageManageController::class, 'edit'])->name('operation.TopDownImageManageEdit');
Route::post('/operationTopDownImageManage/update', [App\Http\Controllers\Operation\TopDownImageManageController::class, 'update'])->name('operation.TopDownImageManageUpdate');
Route::delete('/operationTopDownImageManage/{imageId}', [App\Http\Controllers\Operation\TopDownImageManageController::class, 'delete'])->name('operation.TopDownImageManageDelete');
//예치금관리
Route::get('/operationDepositManage', [App\Http\Controllers\Operation\DepositManageManageController::class, 'index'])->name('operation.DepositManage');
//카카오알림톡
Route::get('/operationKaTalkManage', [App\Http\Controllers\Operation\KaTalkManageController::class, 'index'])->name('operation.KaTalkManage');
//셀러픽사용료
Route::get('/operationSolutionTaxMange', [App\Http\Controllers\Operation\SolutionTaxManageController::class, 'index'])->name('operation.SolutionTaxMange');
//내정보관리
Route::get('/operationMyInfoMange', [App\Http\Controllers\Operation\MyInfoManageController::class, 'index'])->name('operation.MyInfoMange');
/** 고객관리 **/
//공지사항
Route::get('/contactNotice', [App\Http\Controllers\Contact\NoticeController::class, 'index'])->name('contact.Notice');
//1대1문의
Route::get('/contactFAQ', [App\Http\Controllers\Contact\FAQController::class, 'index'])->name('contact.FAQ');
//자주하는 질문
Route::get('/contactUsualQuestion', [App\Http\Controllers\Contact\UsualQuestionController::class, 'index'])->name('contact.UsualQuestion');
//자료실
Route::get('/contactDataCenter', [App\Http\Controllers\Contact\DataCenterController::class, 'index'])->name('contact.DataCenter');
//배송물류비안내
Route::get('/contactDeliveryTaxInfo', [App\Http\Controllers\Contact\DeliveryTaxInfoController::class, 'index'])->name('contact.DeliveryTaxInfo');
//셀러픽매뉴얼
Route::get('/contactManual', [App\Http\Controllers\Contact\ManualController::class, 'index'])->name('contact.Manual');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('admin')->prefix('admin')->name('admin.')->group(
    function () {
    Route::get('user/roleManage', [App\Http\Controllers\Admin\User\RoleManageController::class, 'index'])->name('user.RoleManage');
    
    Route::get('user/userManage', [App\Http\Controllers\Admin\User\UserManageController::class, 'index'])->name('user.UserManage');
    Route::get('user/userManage/edit/{userId}', [App\Http\Controllers\Admin\User\UserManageController::class, 'edit'])->name('user.UserManage.Edit');
    Route::get('user/userManage/checkIDEmail', [App\Http\Controllers\Admin\User\UserManageController::class, 'checkIDEmail'])->name('user.UserManage.CheckIDEmail');
    Route::post('user/userManage', [App\Http\Controllers\Admin\User\UserManageController::class, 'save'])->name('user.UserManage.Save');
    
    Route::get('user/depositManage', [App\Http\Controllers\Admin\User\DepositManageController::class, 'index'])->name('user.DepositManage');
    Route::get('product/productManage', [App\Http\Controllers\Admin\Product\ProductManageController::class, 'index'])->name('product.ProductManage');
    Route::get('product/categoryManage', [App\Http\Controllers\Admin\Product\CategoryManageController::class, 'index'])->name('product.CategoryManage');
});

Route::group(
    [           
        'namespace' => 'Api\V1',
        'prefix' => 'v1',
    ], function(){

        // Route::get('posts', ['uses'=>'PostsApiController@index']);
        // Route::get('posts/{id}', ['uses'=>'PostsAPIController@show']);

});