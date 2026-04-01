<nav id="sidebar" class="sidebar js-sidebar" style="background-color:#FFE3E3; border-right:1px solid;">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand text-decoration-none" href="#">
            <span class="d-flex align-items-center border-bottom menu">🪷 MENÜ 🪷</span></a>

        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('dashboard') }}"><i class="bi bi-house"></i>
                <span class="align-middle"> Dashboard</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('products.index') }}"><i class="bi bi-box"></i>
                <span class="align-middle"> Ürünler</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('stocks') }}"><i class="bi bi-database"></i>
                <span class="align-middle"> Stok</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('orders') }}"><i class="bi bi-person-lines-fill"></i>
                <span class="align-middle"> Siparişler</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('packages') }}"><i class="bi bi-boxes"></i>
                <span class="align-middle"> Paketler</span>
            </li> 
        </ul>
        <hr>
        <ul class="sidebar-nav">
            <a href="#" class="btn btn-secondary"><i class="bi bi-box-arrow-right"></i> Çıkış yap</a>
        </ul>
    </div>
</nav>