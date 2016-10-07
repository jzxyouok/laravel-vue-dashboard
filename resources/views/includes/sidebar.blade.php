<!-- Sidebar -->
    <section id="dashboard-sidebar" class="main-sidebar">
      <section id="sidebar-wrapper" class="sidebar">
            <div class="user-panel info">
                <div class="pull-left image">
                    <img src="//placeholdit.imgix.net/~text?txtfont=monospace,bold&bg=DD4B39&txtclr=ffffff&txt=A&w=45&h=45&txtsize=16" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <a href="javascript:void(0)">
                        <i class="fa fa-circle text-success"></i> Online
                    </a>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="javascript:void(0)">
                        <i class="fa fa-users"></i> <span>Users</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active">
                            <a href="javascript:void(0)">
                                <i class="fa fa-circle-o"></i> <span>User List</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="javascript:void(0)">
                        <i class="fa fa-cog"></i> <span>Settings</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="javascript:void(0)">
                                <i class="fa fa-circle-o"></i> <span>User Roles</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="fa fa-circle-o"></i> <span>User Permissions</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="javascript:void(0)">
                        <i class="fa fa-calendar"></i> <span>Calendar</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                </li>
                <li class="treeview">
                    <a href="javascript:void(0)">
                        <i class="fa fa-sitemap"></i> <span>Jobs</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                </li>
            </ul>
        </section>
    </section>