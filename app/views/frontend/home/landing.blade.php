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
            <div>
                <img id="mainimg" src="{{'assets/img/landing/web.jpg'}}" />
                <a href="<?php echo route('fe.root') ?>" class="bta bta1">link1</a>
                <a href="http://batdongsan.log.vn/" class="bta bta2">link2</a>
                <a href="<?php echo route('fe.share.level') ?>" class="bta bta3">link3</a>
            </div>
        </div><!--end #wrapper-->
    </body>
</html>