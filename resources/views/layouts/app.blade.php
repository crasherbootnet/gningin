<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Ong-base - @yield('title')</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

         <!-- Canonical SEO  -->
        <link rel="canonical" href="https://www.creative-tim.com/product/light-bootstrap-dashboard"/>

        <!--  Social tags      -->
        <meta name="keywords" content="creative tim, html dashboard, html css dashboard, web dashboard, freebie, free bootstrap dashboard, bootstrap, css3 dashboard, bootstrap admin, light bootstrap dashboard, frontend, responsive bootstrap dashboard">

        <meta name="description" content="An admin dashboard template designed to be simple and beautiful.">

        <!-- Schema.org markup for Google+ -->
        <meta itemprop="name" content="Light Bootstrap Dashboard by Creative Tim">
        <meta itemprop="description" content="An admin dashboard template designed to be simple and beautiful.">

        <meta itemprop="image" content="../../s3.amazonaws.com/creativetim_bucket/products/32/original/opt_lbd_thumbnail.jpg">
        <!-- Twitter Card data -->

        <meta name="twitter:card" content="product">
        <meta name="twitter:site" content="@creativetim">
        <meta name="twitter:title" content="Light Bootstrap Dashboard by Creative Tim">

        <meta name="twitter:description" content="An admin dashboard template designed to be simple and beautiful.">
        <meta name="twitter:creator" content="@creativetim">
        <meta name="twitter:image" content="../../s3.amazonaws.com/creativetim_bucket/products/32/original/opt_lbd_thumbnail.jpg">
        <meta name="twitter:data1" content="Light Bootstrap Dashboard by Creative Tim">
        <meta name="twitter:label1" content="Product Type">
        <meta name="twitter:data2" content="Free">
        <meta name="twitter:label2" content="Price">

        <!-- Open Graph data -->
        <meta property="og:title" content="Light Bootstrap Dashboard by Creative Tim" />
        <meta property="og:type" content="article" />
        <meta property="og:url" content="dashboard.html" />
        <meta property="og:image" content="../../s3.amazonaws.com/creativetim_bucket/products/32/original/opt_lbd_thumbnail.jpg"/>
        <meta property="og:description" content="An admin dashboard template designed to be simple and beautiful." />
        <meta property="og:site_name" content="Creative Tim" />

        <!-- Bootstrap core CSS     -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Animation library for notifications   -->
        <link href="{{ asset('assets/css/animate.min.css') }}" rel="stylesheet"/>

        <!--  Light Bootstrap Table core CSS    -->
        <link href="{{ asset('assets/css/light-bootstrap-dashboard.css') }}" rel="stylesheet"/>


        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="{{ asset('assets/css/demo.css') }}" />

        <!--     Fonts and icons     -->
        <link href="{{asset('assets/maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
        <link href="{{ asset('assets/css/pe-icon-7-stroke.css') }}" rel="stylesheet" />

        <!--   Core JS Files   -->
        <script src="{{ asset('assets/js/jquery-1.10.2.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>

        <!--  Checkbox, Radio & Switch Plugins -->
        <script src="{{ asset('assets/js/bootstrap-checkbox-radio-switch.js') }}"></script>

        <!--  Charts Plugin -->
        <script src="{{ asset('assets/js/chartist.min.js') }}"></script>

        <!--  Notifications Plugin    -->
        <script src="{{ asset('assets/js/bootstrap-notify.js') }}"></script>

        <!--  Google Maps Plugin    -->
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

        <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
        <script src="{{ asset('assets/js/light-bootstrap-dashboard.js') }}"></script>

        <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
        <script src="{{ asset('assets/js/demo.js') }}"></script>

        <style type="text/css">
            .footer {
                position: fixed;
                left: 0;
                bottom: 0;
                width: 100%;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="/">ONG-BASE</a>
                    </div>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-dashboard"></i>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe"></i>
                                    <b class="caret"></b>
                                    <span class="notification">5</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Notification 1</a></li>
                                    <li><a href="#">Notification 2</a></li>
                                    <li><a href="#">Notification 3</a></li>
                                    <li><a href="#">Notification 4</a></li>
                                    <li><a href="#">Another notification</a></li>
                                </ul>
                            </li>
                        </ul>
                        <form class="navbar-form navbar-left">
                            <div class="form-group">
                              <input type="text" class="form-control" placeholder="Search">
                            </div>
                        </form>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#">Account</a></li>
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                              </ul>
                            </li>
                            <li>
                                @component('components.logout') 
                                    @slot('space') 
                                        ongs 
                                    @endslot
                                @endcomponent
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            @yield('content')
    
            <footer class="footer">
                <div class="container-fluid">
                    <p class="copyright pull-left">
                        &copy; 2017 <a href="http://www.ong-base.com/">Ong Base</a>, 
                        ensures good management of ong databases
                    </p>
                </div>
            </footer>
        </div>
    </body>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','../../www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-46172202-1', 'auto');
      ga('send', 'pageview');

    </script>
</html>

