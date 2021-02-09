@if (Auth::user()->isAdmin())
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ (request()->is('home')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
        상품수집관리
        <i class="fas fa-angle-left right"></i>
        <span class="badge badge-info right">4</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
        <a href="{{ route('scratch.ProductScrap') }}" class="nav-link {{ (request()->is('scratchProductScrap')) ? 'active' : '' }}">
            <i class="fas fa-cart-plus nav-icon"></i>
            <p>[1]상품스크랩</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('scratch.ProductGetManage') }}" class="nav-link {{ (request()->is('scratchProductGetManage')) ? 'active' : '' }}">
            <i class="fas fa-briefcase nav-icon"></i>
            <p>[2]상품수집관리</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('scratch.SellPrepareCheck') }}" class="nav-link {{ (request()->is('scratchSellPrepareCheck')) ? 'active' : '' }}">
            <i class="fas fa-clipboard-list nav-icon"></i>
            <p>[3]판매준비검토</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('scratch.DesignCheck') }}" class="nav-link {{ (request()->is('scratchDesignCheck')) ? 'active' : '' }}">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>[4]디자인검토</p>
        </a>
        </li>
    </ul>
</li>
@else
<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ (request()->is('home')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
<li class="nav-item {{ (request()->routeIs('scratch*')) ? 'menu-open' : '' }}">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
        상품수집관리
        <i class="fas fa-angle-left right"></i>
        <span class="badge badge-info right">4</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
        <a href="{{ route('scratch.ProductScrap') }}" class="nav-link {{ (request()->is('scratchProductScrap')) ? 'active' : '' }}">
            <i class="fas fa-cart-plus nav-icon"></i>
            <p>[1]상품스크랩</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('scratch.ProductGetManage') }}" class="nav-link {{ (request()->is('scratchProductGetManage')) ? 'active' : '' }}">
            <i class="fas fa-briefcase nav-icon"></i>
            <p>[2]상품수집관리</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('scratch.SellPrepareCheck') }}" class="nav-link {{ (request()->is('scratchSellPrepareCheck')) ? 'active' : '' }}">
            <i class="fas fa-clipboard-list nav-icon"></i>
            <p>[3]판매준비검토</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('scratch.DesignCheck') }}" class="nav-link {{ (request()->is('scratchDesignCheck')) ? 'active' : '' }}">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>[4]디자인검토</p>
        </a>
        </li>
    </ul>
</li>
<li class="nav-item {{ (request()->routeIs('product*')) ? 'menu-open' : '' }}">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
        상품관리
        <i class="fas fa-angle-left right"></i>
        <span class="badge badge-info right">6</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
        <a href="{{ route('product.SellTargetManage') }}" class="nav-link {{ (request()->is('productSellTargetManage')) ? 'active' : '' }}">
            <i class="fas fa-cart-plus nav-icon"></i>
            <p>[1]판매대상상품</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('product.RegisteredProductManage') }}" class="nav-link {{ (request()->is('productRegisteredProductManage')) ? 'active' : '' }}">
            <i class="fas fa-briefcase nav-icon"></i>
            <p>[2]등록상품관리</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('product.FailedProductManage') }}" class="nav-link {{ (request()->is('productFailedProductManage')) ? 'active' : '' }}">
            <i class="fas fa-clipboard-list nav-icon"></i>
            <p>[3]등록실패상품관리</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('product.StoppedProductManage') }}" class="nav-link {{ (request()->is('productStoppedProductManage')) ? 'active' : '' }}">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>[4]판매중지상품</p>
        </a>
        </li>
    </ul>
</li>
<li class="nav-item {{ (request()->routeIs('order*')) ? 'menu-open' : '' }}">
    <a href="{{ route('order.Waiting') }}" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
        주문관리
        <i class="fas fa-angle-left right"></i>
        <span class="badge badge-info right">6</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
        <a href="{{ route('order.SalesStatus') }}" class="nav-link">
            <i class="fas fa-cart-plus nav-icon"></i>
            <p>판매현황</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('order.MarketOrderCollection') }}" class="nav-link">
            <i class="fas fa-briefcase nav-icon"></i>
            <p>오픈마켓주문수집</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('order.PaymentWaiting') }}" class="nav-link">
            <i class="fas fa-clipboard-list nav-icon"></i>
            <p>[0]결제대기</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('order.Waiting') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>[1]준비중</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('order.PassCodeCheck') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>->통관부호확인</p>
        </a>
        <li class="nav-item">
        <a href="{{ route('order.StockIssueCheck') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>[2]품절및이슈확인</p>
        </a>
        <li class="nav-item">
        <a href="{{ route('order.Buying') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>[3]구매중</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('order.PurchasedShipmentWaiting') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>[4]구매후발송대기</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('order.ChinaShipping') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>[5]중국배송중</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('order.DestinationArrival') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>[6]집하지도착</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('order.BadIncorrectManage') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>->불량/오배송관리</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('order.OtherPackingWaiting') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>->기타패킹대기</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('order.UnrecognizedWaybill') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>->미인식운장</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('order.KrReturnCommand') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>->반품지시(KR)</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('order.ChReturnCommand') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>->반품지시(CN)</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('order.PackingComplete') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>[7]패킹완료</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('order.Passing') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>[8]통관중</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('order.PassStrangeReport') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>->통관이상보고</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('order.KrWarehouseArrival') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>[9]한국창고도착</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('order.KoreaShipping') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>[10]한국배송중</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('order.CourierChange') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>->택배사변경</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('order.DeliveryComplete') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>[11]배송완료</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('order.PurchaseComplete') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>[11]구매완료</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('order.UnsoldableProduct') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>[★]판매불가상품</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('order.CancelledProduct') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>[★]취소상품</p>
        </a>
        </li>
    </ul>
</li>
<li class="nav-item {{ (request()->routeIs('tpl*')) ? 'menu-open' : '' }}">
    <a href="{{ route('tpl.Preparing') }}" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
        창고입고(3PL)
        <i class="fas fa-angle-left right"></i>
        <span class="badge badge-info right">4</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
        <a href="{{ route('tpl.ReceiptRequest') }}" class="nav-link">
            <i class="fas fa-cart-plus nav-icon"></i>
            <p>입고신청관리</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('tpl.ReceiptConfirm') }}" class="nav-link">
            <i class="fas fa-briefcase nav-icon"></i>
            <p>접수확인중</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('tpl.PurchaseRequestChWarehouse') }}" class="nav-link">
            <i class="fas fa-clipboard-list nav-icon"></i>
            <p>구매요청중국창고</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('tpl.PurchaseRequestKrWarehouse') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>구매요청한국창고</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('tpl.DirectPurchaseChWarehouse') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>직접구매중국창고</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('tpl.DirectPurchaseKrWarehouse') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>직접구매한국창고</p>
        </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('tpl.Preparing') }}" class="nav-link">
                <i class="fas fa-crop-alt nav-icon"></i>
                <p>[1]준비중</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('tpl.PurchasedShipmentWaiting') }}" class="nav-link">
                <i class="fas fa-crop-alt nav-icon"></i>
                <p>[1]구매후발송대기</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('tpl.ChinaShipping') }}" class="nav-link">
                <i class="fas fa-crop-alt nav-icon"></i>
                <p>[1]중국배송중</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('tpl.DestinationArrival') }}" class="nav-link">
                <i class="fas fa-crop-alt nav-icon"></i>
                <p>[1]집하지도착</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('tpl.PackingComplete') }}" class="nav-link">
                <i class="fas fa-crop-alt nav-icon"></i>
                <p>[1]패킹완료</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('tpl.Passing') }}" class="nav-link">
                <i class="fas fa-crop-alt nav-icon"></i>
                <p>[1]통관중</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('tpl.WarehouseArrival') }}" class="nav-link">
                <i class="fas fa-crop-alt nav-icon"></i>
                <p>[1]창고도착</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('tpl.OutRequest') }}" class="nav-link">
                <i class="fas fa-crop-alt nav-icon"></i>
                <p>[1]출고요청</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('tpl.OutComplete') }}" class="nav-link">
                <i class="fas fa-crop-alt nav-icon"></i>
                <p>[1]출고완료</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item {{ (request()->routeIs('inventory*')) ? 'menu-open' : '' }}">
    <a href="{{ route('inventory.Manage') }}" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
        재고관리
        <i class="fas fa-angle-left right"></i>
        <span class="badge badge-info right">4</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
        <a href="{{ route('inventory.Manage') }}" class="nav-link">
            <i class="fas fa-cart-plus nav-icon"></i>
            <p>재고관리</p>
        </a>
        </li>
    </ul>
</li>
<li class="nav-item {{ (request()->routeIs('calculate*')) ? 'menu-open' : '' }}">
    <a href="{{ route('calculate.MonthlySalesManage') }}" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
        정산관리
        <i class="fas fa-angle-left right"></i>
        <span class="badge badge-info right">4</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
        <a href="{{ route('calculate.MonthlySalesManage') }}" class="nav-link">
            <i class="fas fa-cart-plus nav-icon"></i>
            <p>월별매출정산관리</p>
        </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
        <a href="{{ route('calculate.DailySalesManage') }}" class="nav-link">
            <i class="fas fa-cart-plus nav-icon"></i>
            <p>일별매출정산관리</p>
        </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
        <a href="{{ route('calculate.AllSaleManage') }}" class="nav-link">
            <i class="fas fa-cart-plus nav-icon"></i>
            <p>종합정산관리</p>
        </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
        <a href="{{ route('calculate.PurchaseManage') }}" class="nav-link">
            <i class="fas fa-cart-plus nav-icon"></i>
            <p>구매정산관리</p>
        </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
        <a href="{{ route('calculate.CategoryTaxManage') }}" class="nav-link">
            <i class="fas fa-cart-plus nav-icon"></i>
            <p>물류비관리</p>
        </a>
        </li>
    </ul>
</li>
<li class="nav-item {{ (request()->routeIs('statistics*')) ? 'menu-open' : '' }}">
    <a href="{{ route('statistics.DailySaleStatus') }}" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
        통계관리
        <i class="fas fa-angle-left right"></i>
        <span class="badge badge-info right">4</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
        <a href="{{ route('statistics.DailySaleStatus') }}" class="nav-link">
            <i class="fas fa-cart-plus nav-icon"></i>
            <p>일별매출현황</p>
        </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
        <a href="{{ route('statistics.YearMonthlySaleStatus') }}" class="nav-link">
            <i class="fas fa-cart-plus nav-icon"></i>
            <p>년월별매출현황</p>
        </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
        <a href="{{ route('statistics.DepartmentSaleStatus') }}" class="nav-link">
            <i class="fas fa-cart-plus nav-icon"></i>
            <p>판매처별매출현황</p>
        </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
        <a href="{{ route('statistics.MarketSaleStatus') }}" class="nav-link">
            <i class="fas fa-cart-plus nav-icon"></i>
            <p>마켓별매출현황</p>
        </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
        <a href="{{ route('statistics.SellerSaleStatus') }}" class="nav-link">
            <i class="fas fa-cart-plus nav-icon"></i>
            <p>판매자별매출현황</p>
        </a>
        </li>
    </ul>
</li>
<li class="nav-item {{ (request()->routeIs('operation*')) ? 'menu-open' : '' }}">
    <a href="{{ route('operation.OpenMarketManage') }}" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
        운영관리
        <i class="fas fa-angle-left right"></i>
        <span class="badge badge-info right">4</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
        <a href="{{ route('operation.OpenMarketManage') }}" class="nav-link">
            <i class="fas fa-cart-plus nav-icon"></i>
            <p>오픈마켓계정관리</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('operation.BasicSettingManage') }}" class="nav-link">
            <i class="fas fa-briefcase nav-icon"></i>
            <p>기초설정관리</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('operation.TopDownImageManage') }}" class="nav-link">
            <i class="fas fa-clipboard-list nav-icon"></i>
            <p>상하단이미지관리</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('operation.DepositManage') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>예치금관리</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('operation.KaTalkManage') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>카카오알림톡</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('operation.SolutionTaxMange') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>셀러사용료</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('operation.MyInfoMange') }}" class="nav-link">
            <i class="fas fa-crop-alt nav-icon"></i>
            <p>내정보</p>
        </a>
        </li>
    </ul>
</li>
@endif