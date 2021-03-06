<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="/"><img src="/assets/img/logo-72.png" width="25" alt="Aero" /><span class="m-l-10">Shop game</span></a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <a class="image" href="#"><img src="/assets/img/avatar.jpg" alt="User" /></a>
                    <div class="detail">
                        <h4>
                            <?php echo $username ?>
                        </h4>
                        <small>
                            Administrator</small>
                    </div>
                </div>
            </li>
            <li class="active open">
                <a href="/admin/index.php"><i class="zmdi zmdi-home"></i><span>Trang quản trị viên</span></a>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle"><i class="fas fa-list"></i><span>Danh mục</span></a>
                <ul class="ml-menu">
                    <li><a href="list_add.php">Danh sách danh mục</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle"><i class="fab fa-product-hunt"></i><span>Sản phẩm</span></a>
                <ul class="ml-menu">
                    <li><a href="/admin/product/view.php">Danh sách sản phẩm</a></li>
                </ul>
            </li>
            <li>
                <a href="/admin/biller/view.php" class="menu-toggle"><i class="fas fa-shopping-cart"></i> <span>Danh sách đơn hàng</span></a>
            </li>
            <li>
                <a href="/admin/history/payment.php" class="menu-toggle"><i class="fas fa-money-check-alt"></i><span>Lịch sử thanh toán tự động</span></a>
            </li>
            <li>
                <a href="/admin/system/view.php" class="menu-toggle"><i class="fas fa-users"></i> <span>Hệ thống</span></a>
            </li>
            <li>
                <a href="/logout.php"><i class="zmdi zmdi-link"></i><span>Đăng xuất</span></a>
            </li>
        </ul>
    </div>
</aside>