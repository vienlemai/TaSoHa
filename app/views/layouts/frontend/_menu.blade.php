<div class="col-lg-12">
    <div class="navbar navbar-default">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!--<a class="navbar-brand" href="#"><i class="fa fa-home"></i></a>-->
        </div>
        <div class="navbar-collapse collapse navbar-responsive-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="#" class="text-info">Thực phẩm chức năng</a>
                </li>
                <li>
                    <a href="#">Mỹ phẩm</a>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hàng tiêu dùng</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Mặt hàng khác <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">TASOHA Group <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Sứ mệnh</a></li>
                        <li><a href="#">Tasoha LAND</a></li>
                        <li><a href="#">Tasoha ECOM</a></li>
                        <li><a href="#">Tasoha EDU</a></li>
                        <li><a href="#">Tasoha INVEST</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <form action="<?php echo route('fe.search') ?>" method="GET" class="navbar-form navbar-left">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm" placeholder="Tìm kiếm ...">
                        <span class="input-group-btn">
                            <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form> 

            </ul>
        </div>
    </div>

</div>