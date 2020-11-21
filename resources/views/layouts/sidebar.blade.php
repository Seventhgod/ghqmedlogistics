<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">
                    <i class="nav-icon icon-speedometer"></i> Dashboard
                </a>
            </li>
            @can('read-users','read-roles')
            <li class="nav-title">Settings</li>
            @endcan
            @can('read-users')
            <li class="nav-item">
                <a class="nav-link" href="/users">
                    <i class="nav-icon icon-people"></i> Users
                </a>
            </li>
            @endcan
            @can('read-roles')
            <li class="nav-item">
                <a class="nav-link" href="/roles">
                    <i class="nav-icon icon-key"></i> Roles
                </a>
            </li>
            @endcan
            <li class="nav-title">Data Collection</li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('projects.index') }}">
                    <i class="nav-icon cil-storage"></i> Projects
                </a>
            </li>
            <!--<li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="nav-icon cil-spreadsheet"></i> Equipment Requests
                </a>
            </li>-->
            <!--<li class="nav-item">
                <a class="nav-link" href="{{ route('drugRequests.index') }}">
                    <i class="nav-icon cil-spreadsheet"></i> Item Requests
                </a>
            </li>-->
            @can('read-request-approval')
            <li class="nav-title">Approvals</li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('adminreq.index') }}">
                    <i class="nav-icon cil-send"></i> Pending Requests
                </a>
            </li>
            @endcan
            <li class="nav-title">Products</li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('items.index') }}">
                    <i class="nav-icon cil-paperclip"></i> Items
                </a>
            </li>
        </ul>
    </nav>
    <sidebar></sidebar>
</div>
