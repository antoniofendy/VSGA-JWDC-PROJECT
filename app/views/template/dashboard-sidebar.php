<style>
    .sidebar {
        background-color: #1e3799;
    }
    </style>

    <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
            <i class="fas fa-cogs"></i>
        </div>
        <div class="sidebar-brand-text mx-2 accent-font" style="text-transform:none;">Administrator Dashboard</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo $current_page == 'dashboard' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= BASE_URL ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading accent-font">
        Master Data
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?php echo $current_page == 'master_data' ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-database"></i>
            <span>Master Data List</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Master Data:</h6>
                <a class="collapse-item" href="<?= BASE_URL ?>/Member/index"> Members</a>
                <a class="collapse-item" href="<?= BASE_URL ?>"> Book</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Heading -->
    <div class="sidebar-heading accent-font">
        Transactions
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?php echo $current_page == 'transaction' ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-exchange-alt"></i>
            <span>Transaction Types</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Transaction:</h6>
                <a class="collapse-item" href="<?= BASE_URL ?>"> Loan Transaction</a>
                <a class="collapse-item" href="<?= BASE_URL ?>"> Return Transaction</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Heading -->
    <div class="sidebar-heading accent-font">
        Reports
    </div>

    <!-- Nav Item - Book -->
    <li class="nav-item <?php echo $current_page == 'report' ? 'active' : '' ?>">
        <a href="<?= BASE_URL ?>" class="nav-link">
            <i class="fas fa-file-alt"></i>
            <span>Transaction Report</span>
        </a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>