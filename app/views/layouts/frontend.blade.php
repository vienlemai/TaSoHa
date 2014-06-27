<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Tasoha</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/bootstrap.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/style-responsive.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/override.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/ribbons.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/sequence.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/default.css')}}">
        <!-- Styles Switcher -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/switcher.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/override-template.css')}}">

        <!-- Java Script  -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/modernizr.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/selectnav.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/flexslider.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/fancybox.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/isotope.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/jquery.fitvids.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/custom.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/switcher.js')}}"></script>
    </head>
    <body>
        <!-- Wrapper Start -->
        <div id="wrapper" class="container">
            <div class="ie-dropdown-fix" >
                <?php echo View::make('layouts/frontend/_header')->render() ?>
                <!-- Header / End -->
                <?php echo View::make('layouts/frontend/_menu')->render() ?>
                <div class="clear"></div>
            </div>
            <!-- Navigation / End -->
            <!-- Content -->
            <?php echo View::make('layouts/frontend/_flash')->render() ?>
            @yield('content')
            <div class="push"></div>
            <div id="scroll-to-top" ><a href="#" title="Go to Top"></a></div>
        </div>
        <section id="phone">
            <div class="row">
                <div class="center margintop60 marginbottom60">
                    <h1><i class="icon-phone"></i> Call us now +123-456-789</h1>
                </div>
            </div>
        </section>
        <section id="footer-section">
            <!-- Footer Top -->
            <div id="footer" class=" paddingbottom" >
                <div class="border-footer-left"></div>
                <div class="border-footer-right"></div>
                <div class="container">
                    <div class="row">

                        <!-- Subscribe  -->
                        <div class="span4">
                            <div class="footer-headline"><h4>Subscribe</h4></div>
                            <p>Keep updated with our news</p><p>Your email is safe with us!</p>
                            <div class="input-append">
                                <input  id="appendedInputButton"  type="text" class="span2" placeholder="Enter Email Address">
                                <button class="btn" type="button">Subscribe!</button>
                            </div>
                        </div>

                        <!-- Photo Stream -->
                        <div class="span4">
                            <div class="footer-headline"><h4>Photo Stream</h4></div>
                            <div class="flickr-widget">
                                <div class="clear"></div>
                            </div>
                        </div>

                        <!-- Latest Tweets -->
                        <div class="span4">
                            <div class="footer-headline"><h4>Latest Tweets</h4></div>
                            <ul id="twitter"></ul>
                            <div class="clear"></div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Footer / Bottom -->
            <div id="footer" class="footer-bottom" style="background: #111;">
                <div class="container">
                    <div class="span12">
                        <div id="footer-bottom">
                            © Copyright 2012 by <a href="#">aabu</a>. All rights reserved.
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Styles Switcher -->
<!--        <div id="style-switcher" style="right: -300px;">
            <h2>Color Switcher Options<a href="#">Settings</a></h2>
            <div>
                <h3>Ribbons</h3>
                <div class="layout-style">
                    <select id="ribbon-switcher">
                        <option value="css/ribbons">Yes</option>
                        <option value="css/noribbons">No</option>
                    </select>
                </div>
                <p>Be Creative with the Menu & Menu Hover, You can have more then 300 Combinations!</p>

                <h3>Default Colors (includes Menu Hover)</h3>
                <ul class="colors" id="color1">
                    <li><a href="#" class="sexy-orange" title="Sexy Orange"></a></li>
                    <li><a href="#" class="blue" title="Blue"></a></li>
                    <li><a href="#" class="orange" title="Orange"></a></li>
                    <li><a href="#" class="navy" title="Navy"></a></li>
                    <li><a href="#" class="black" title="Black"></a></li>
                    <li><a href="#" class="yellow" title="Yellow"></a></li>
                    <li><a href="#" class="peach" title="Peach"></a></li>
                    <li><a href="#" class="beige" title="Beige"></a></li>
                    <li><a href="#" class="purple" title="Purple"></a></li>
                    <li><a href="#" class="red" title="Red"></a></li>
                    <li><a href="#" class="pink" title="Pink"></a></li>
                    <li><a href="#" class="celadon" title="Celadon"></a></li>
                    <li><a href="#" class="brown" title="Brown"></a></li>
                    <li><a href="#" class="cherry" title="Cherry"></a></li>
                    <li><a href="#" class="gray" title="Gray"></a></li>
                    <li><a href="#" class="olive" title="Olive"></a></li>
                    <li><a href="#" class="dirty-green" title="Dirty Green"></a></li>
                </ul>

                <h3>Background Image</h3>
                <ul class="colors bg" id="bg">
                    <li><a href="#" class="bg1"></a></li>
                    <li><a href="#" class="bg2"></a></li>
                    <li><a href="#" class="bg3"></a></li>
                    <li><a href="#" class="bg4"></a></li>
                    <li><a href="#" class="bg5"></a></li>
                    <li><a href="#" class="bg6"></a></li>
                    <li><a href="#" class="bg7"></a></li>
                    <li><a href="#" class="bg8"></a></li>
                    <li><a href="#" class="bg9"></a></li>
                    <li><a href="#" class="bg10"></a></li>
                    <li><a href="#" class="bg11"></a></li>
                    <li><a href="#" class="bg12"></a></li>
                    <li><a href="#" class="bg13"></a></li>
                    <li><a href="#" class="bg14"></a></li>
                    <li><a href="#" class="bg15"></a></li>
                    <li><a href="#" class="bg16"></a></li>
                    <li><a href="#" class="bg17"></a></li>
                    <li><a href="#" class="bg18"></a></li>
                </ul>

                <h3>Background Color</h3>
                <ul class="colors bgsolid" id="bgsolid">
                    <li><a href="#" class="green-bg" title="Green"></a></li>
                    <li><a href="#" class="blue-bg" title="Blue"></a></li>
                    <li><a href="#" class="orange-bg" title="Orange"></a></li>
                    <li><a href="#" class="navy-bg" title="Navy"></a></li>
                    <li><a href="#" class="yellow-bg" title="Yellow"></a></li>
                    <li><a href="#" class="peach-bg" title="Peach"></a></li>
                    <li><a href="#" class="beige-bg" title="Beige"></a></li>
                    <li><a href="#" class="purple-bg" title="Purple"></a></li>
                    <li><a href="#" class="red-bg" title="Red"></a></li>
                    <li><a href="#" class="pink-bg" title="Pink"></a></li>
                    <li><a href="#" class="celadon-bg" title="Celadon"></a></li>
                    <li><a href="#" class="brown-bg" title="Brown"></a></li>
                    <li><a href="#" class="cherry-bg" title="Cherry"></a></li>
                    <li><a href="#" class="gray-bg" title="Gray"></a></li>
                    <li><a href="#" class="dark-bg" title="Dark"></a></li>
                    <li><a href="#" class="cyan-bg" title="Cyan"></a></li>
                    <li><a href="#" class="olive-bg" title="Olive"></a></li>
                    <li><a href="#" class="dirty-green-bg" title="Dirty Green"></a></li>
                </ul>
            </div>
            <div id="reset"><a href="#" class="btn">Reset</a></div>
        </div>-->
    </body>
</html>