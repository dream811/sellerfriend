
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ (request()->is('home')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>홈</p>
    </a>
</li>

<li class="nav-item {{ (request()->routeIs('admin.user')) ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ (request()->routeIs('admin.user*')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-copy"></i>
        <p>
        유저관리
        <i class="fas fa-angle-left right"></i>
        <span class="badge badge-info right">4</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
        <a href="{{ route('admin.user.UserManage') }}" class="nav-link {{ (request()->is('admin/user/UserManage')) ? 'active' : '' }}">
            <i class="fas fa-cart-plus nav-icon"></i>
            <p>유저관리</p>
        </a>
        </li>
    </ul>
</li>
<li class="nav-item {{ (request()->routeIs('admin.product')) ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ (request()->routeIs('admin.product*')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-copy"></i>
        <p>
        상품관리
        <i class="fas fa-angle-left right"></i>
        <span class="badge badge-info right">4</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.product.ProductManage') }}" class="nav-link {{ (request()->is('admin/product/ProductManage')) ? 'active' : '' }}">
                <i class="fas fa-cart-plus nav-icon"></i>
                <p>상품관리</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.product.CategoryManage') }}" class="nav-link {{ (request()->is('admin/product/CategoryManage')) ? 'active' : '' }}">
                <i class="fas fa-cart-plus nav-icon"></i>
                <p>카테고리</p>
            </a>
        </li>
    </ul>
</li>