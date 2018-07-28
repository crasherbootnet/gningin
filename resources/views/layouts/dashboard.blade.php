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

    <link href="{{ asset('assets/open-iconic/font/css/open-iconic-bootstrap.css') }}" rel="stylesheet">

    <!--     Fonts and icons     -->
    <link href="{{asset('assets/maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/css/pe-icon-7-stroke.css') }}" rel="stylesheet" />
    

    <!--     ICHECK     -->
    <link href="{{ asset('plugin/icheck/skins//all.css?v=1.0.2') }}" rel="stylesheet" />

    <!--<link href="{{asset('assets/css/jquery-ui.css')}}" rel="stylesheet" />-->

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

    <!-- TINYMCE -->
    <script type="text/javascript" src="{{ asset('plugin/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugin/tinymce/init-tinymce.js') }}"></script>

    <!-- FILESTYLE -->
    <script type="text/javascript" src="{{ asset('plugin/filestyle/bootstrap-filestyle.min.js') }}"></script>

    <!-- ICHECK -->
    <script type="text/javascript" src="{{ asset('plugin/icheck/icheck.js?v=1.0.2') }}"></script>
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="{{ asset('assets/img/sidebar-5.jpg') }}">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="/" class="simple-text">
                    ONG-BASE
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="/follow-projects/{{ $project->short_code }}">
                        <i class="pe-7s-graph"></i>
                        <p>Tableau de bord</p>
                    </a>
                </li>
                <li>
                    <a href="/projects/{{$project->short_code}}/activites">
                        <i class="pe-7s-user"></i>
                        <p>Activites</p>
                    </a>
                </li>
                <li>
                    <a href="/projects/{{$project->short_code}}/fichiers">
                        <i class="pe-7s-user"></i>
                        <p>Fichiers</p>
                    </a>
                </li>
                <li>
                    <a href="/projects/{{$project->short_code}}/params/">
                        <i class="pe-7s-user"></i>
                        <p>params</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Tableau de bord</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
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
                        <li>
                           <a href="#">
                                <i class="fa fa-search"></i>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="#">
                               Account
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    Dropdown
                                    <b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li class="divider"></li>
                                <li><a href="javascript:void(0)" id="completeSave">Enregistrement</a></li>
                              </ul>
                        </li>
                        <li>
                            <a href="#">
                                Log out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')

        <footer class="footer">
                <div class="container-fluid">
                    <p class="copyright pull-right">
                        &copy; 2016 <a href="http://www.creative-tim.com/">Creative Tim</a>, made with love for a better web
                    </p>
                </div>
            </footer>
        </div>
    </div>

</body>

<div class="modal fade" id="modalAddPersonne" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label class="control-label">Nom et Prénom (*):</label>
                <input type="text" class="form-control" name="name">
              </div>
              <div class="form-group">
                <label class="control-label">Fonction (*):</label>
                <input type="text" class="form-control" name="fonction">
              </div>
              <div class="form-group">
                <label class="control-label">Contact:</label>
                <input type="tel" class="form-control" name="contact">
              </div>
              <div class="form-group">
                <label class="control-label">Email:</label>
                <input type="email" class="form-control" name="email">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
            <button type="button" class="btn btn-primary" id="submitAddModalPersonne">Ajouter</button>
          </div>
        </div>
      </div>
  </div>

  <div class="modal fade" tabindex="-1" role="dialog" id="modalDeleteActivity">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <p>Si vous decidez de supprimez l'activité vous perdrez les données associées à cette activité !!!Voulez vous supprimer l'activité ?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Annulez</button>
            <button type="button" class="btn btn-primary btn_delete_activite" data-id="0" data-project_short_code="{{ $project->short_code }}">Oui</button>
          </div>
        </div>
      </div>
  </div>

  <div class="modal fade" tabindex="-1" role="dialog" id="modalDeletePotentialite">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <p>Voulez vous supprimez la potentialité ?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Annulez</button>
            <button type="button" class="btn btn-primary btn_delete_potentialite" data-id="0">Oui</button>
          </div>
        </div>
      </div>
  </div>

  <div class="modal fade" tabindex="-1" role="dialog" id="modalDeleteObstacle">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <p>Voulez vous supprimez l'obstacle ?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Annulez</button>
            <button type="button" class="btn btn-primary btn_delete_obstacle" data-id="0">Oui</button>
          </div>
        </div>
      </div>
  </div>

  <div class="modal fade" tabindex="-1" role="dialog" id="modalCompleteSave">
      <div class="modal-dialog" role="document">
        <input type="text" name="_token" value="{{ csrf_token() }}" hidden>
        <div class="modal-content">
          <div c0lass="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Saisir le nom de la modification ?</h4>
      </div>
          <div class="modal-body">
            <input type="text" class="form-control" name="name_modification">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Annulez</button>
            <button type="button" class="btn btn-primary" id="save-modification" data-id>Enregister</button>
            <button type="button" class="btn btn-primary btn_delete_obstacle" data-id="0">Enregistrer et Soumettre</button>
          </div>
        </div>
      </div>
  </div>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','../../www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-46172202-1', 'auto');
      ga('send', 'pageview');

    </script>

    <script>
      $(document).ready(function() {
        $("#completeSave").click(function(){

          // on vérifie si nous avons une modification 
          $.ajax({
            url: "{{ url('projects/is-modification/'.$project->short_code) }}",
            type: "get",
            success: function(data){
              if(data == 1)
              {
                $("#modalCompleteSave").modal();
              }else{
                alert("Désolé il y'a aucune modification, veillez apporter une modification avant d'enregistrer une modification");
              }
            }
          });


        });

        // save modification 
        $("#save-modification").click(function (){
          $.ajax({
            url: "{{ url('projects/save-modification/'.$project->short_code)}}",
            type: 'POST',
            data: {'_token' : $("input[name='_token']").val(), 'name' : $("input[name='name_modification']").val()},
            success: function(data){
              if(data == 1){
                alert("l'enregistrement s'est passe avec success ");
              }else if(data == 2){
                alert("Désolé il y'a aucune modification, veillez modifier avant d'enregistrer une modification");
              }
            }
          })

          // close modal
          $("#modalCompleteSave").modal('toggle');
        })
      });
    </script>
</html>


        