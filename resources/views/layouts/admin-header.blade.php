<header class="admin-header">
    <div class="container">
        <nav class="admin-nav">
            <div class="admin-nav__logo">
                <h2>HOLY ADMIN</h2>
            </div>
            <ul class="admin-nav__menu">
                <li>
                    <a href="{{ route('admin.products') }}" 
                       class="admin-nav__link {{ request()->is('admin/products*') ? 'active' : '' }}">
                       Товары
                    </a>
                </li>
                <li>
                    <a href="/product-create" 
                       class="admin-nav__link {{ request()->is('product-create*') ? 'active' : '' }}">
                       Добавить товар
                    </a>
                </li>
                <li>
                    <a href="/categories" 
                       class="admin-nav__link {{ request()->is('categories*') ? 'active' : '' }}">
                       Категории
                    </a>
                </li>
                <li>
                    <a href="/category-create" 
                       class="admin-nav__link {{ request()->is('category-create*') ? 'active' : '' }}">
                       Добавить категорию
                    </a>
                </li>
                <li>
                    <a href="/orders" 
                       class="admin-nav__link {{ request()->is('orders*') ? 'active' : '' }}">
                       Заказы
                    </a>
                </li>
                <li>
                <a class="nav-link btn-sm {{ Request::is('user') ? 'active' : '' }}" 
           href="{{ route('user') }}">
           Назад
        </a>
                </li>
            </ul>
        </nav>
    </div>
</header>