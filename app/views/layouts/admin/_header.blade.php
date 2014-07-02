<header class="header">
    <a href="<?php echo route('admin.root') ?>" class="logo">
        Tasoha Administration
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span>Language <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#" class="">English</a>
                        </li>
                        <li>
                            <a href="#" class="">Vietnamese</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i> <span><?php echo Auth::admin()->get()->full_name ?> <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#" class="">My Account</a>
                        </li>
                        <li>
                            <a href="#" class="">Change Password</a>
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