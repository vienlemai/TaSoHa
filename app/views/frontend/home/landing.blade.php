<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Tasoha</title>
        <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/frontend/css/landing.css')}}"/>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700&subset=latin,vietnamese,latin-ext' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <div class="logo"><a href="index.htm"><img src="{{'assets/img/landing/logo.png'}}" /></a></div>
                <div class="name"></div>
                <div class="global">
                    <div class="imgroll"><img src="{{'assets/img/landing/global.gif'}}" /></div>
                    <p>TASOHA - Đánh thức tiềm năng – Khơi nguồn sức mạnh</p>
                </div>
            </div><!--end #header-->

            <div id="main">
                <div>
                    <div class="box">
                        <a href="<?php echo route('fe.root') ?>">
                            <img src="{{'assets/img/landing/pic1.jpg'}}" />
                        </a>
                        <h2>
                            <a href="<?php echo route('fe.root') ?>">THƯƠNG MẠI</a>
                        </h2>
                    </div>
                    <div class="box">
                        <a href="http://batdongsan.log.vn/">
                            <img src="{{'assets/img/landing/pic2.gif'}}" />
                        </a>
                        <h2>
                            <a href="http://batdongsan.log.vn/">BẤT ĐỘNG SẢN</a>
                        </h2>
                    </div>
                    <div class="box">
                        <a href="#">
                            <img src="{{'assets/img/landing/pic3.png'}}" />
                        </a>
                        <h2>
                            <a href="#">PHÁT TRIỂN</a>
                        </h2>
                    </div>
                    <div class="clear"></div>
                </div>


            </div><!--end #main-->

            <div id="footer"></div>
        </div><!--end #wrapper-->
    </body>
</html>