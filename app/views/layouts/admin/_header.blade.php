<header class="header">
    <a href="<?php echo route('admin.root') ?>" class="logo">
        <!-- Add the class icon to your logo image or logo icon to add the margining -->
        Video Streaming
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i> <span><?php echo Auth::admin()->get()->getFullName() ?> <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo route('admin.users.profile') ?>" class=""><?php echo trans('messages.profile'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo route('admin.users.password') ?>" class=""><?php echo trans('messages.change_password'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo route('admin.logout') ?>" class=""><?php echo trans('messages.sign_out'); ?></a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>