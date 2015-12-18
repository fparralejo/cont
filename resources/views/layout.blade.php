<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<!--    <meta name="viewport" content="width=device-width, initial-scale=1">  -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{URL::asset('favicon.ico')}}">

    <title>Cuentas Generales</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

    <!-- Bootstrap core JavaScript
    ================================================== -->
    
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.10.0/jquery-ui.min.js"></script>
<!--    <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />-->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="{{URL::asset('js/docs.min.js')}}"></script>
    <script src="{{URL::asset('js/tools.js')}}"></script>

    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/1.0.0/css/dataTables.responsive.css">
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/responsive/1.0.0/js/dataTables.responsive.min.js"></script>
    <script src="{{URL::asset('lib/datepicker/js/bootstrap-datepicker.js')}}"></script>
    
    <link rel="stylesheet" href="{{URL::asset('css/formValidation.min.css')}}">
    <script src="{{URL::asset('js/formValidation.min.js')}}"></script>
    <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>

    <!-- Custom styles for this template -->
    <link href="{{URL::asset('css/bootstrap-theme.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/dashboard.css')}}" rel="stylesheet">

    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ URL::asset('main') }}">Listado</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">

            @include('includes.menu')
              
<!--            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Informes<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ URL::asset('informes/ultdias/30') }}">Ultimos 30 Días</a></li>
                  <li><a href="{{ URL::asset('informes/ultdias/365') }}">Ultimos 365 Días</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="{{ URL::asset('informes/mesesEjercicio/'.date('Y')) }}">Meses por Años</a></li>
                </ul>            
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gráficas<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ URL::asset('graficas/meses/2000') }}">2000</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2001') }}">2001</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2002') }}">2002</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2003') }}">2003</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2004') }}">2004</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2005') }}">2005</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2006') }}">2006</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2007') }}">2007</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2008') }}">2008</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2009') }}">2009</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2010') }}">2010</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2011') }}">2011</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2012') }}">2012</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2013') }}">2013</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2014') }}">2014</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2015') }}">2015</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2016') }}">2016</a></li>
                </ul>
            </li>
            <li><a href="{{ URL::asset('logout') }}">Salir</a></li>-->
            
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
              
            @include('includes.menu')
            
<!--            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Informes<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ URL::asset('informes/ultdias/30') }}">Ultimos 30 Días</a></li>
                  <li><a href="{{ URL::asset('informes/ultdias/365') }}">Ultimos 365 Días</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="{{ URL::asset('informes/mesesEjercicio/'.date('Y')) }}">Meses por Años</a></li>
                </ul>            
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gráficas<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ URL::asset('graficas/meses/2000') }}">2000</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2001') }}">2001</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2002') }}">2002</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2003') }}">2003</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2004') }}">2004</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2005') }}">2005</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2006') }}">2006</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2007') }}">2007</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2008') }}">2008</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2009') }}">2009</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2010') }}">2010</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2011') }}">2011</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2012') }}">2012</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2013') }}">2013</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2014') }}">2014</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2015') }}">2015</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2016') }}">2016</a></li>
                </ul>
            </li>
            <li><a href="{{ URL::asset('logout') }}">Salir</a></li>-->
            
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          @yield('submenu')
<!--          <hr/>-->
          @yield('principal')

        </div>
      </div>
    </div>

    </body>
</html>
