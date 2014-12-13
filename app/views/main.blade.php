<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title',"Task Manager")</title>

    <!-- Bootstrap -->
    <link href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.0/yeti/bootstrap.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <!--<link href="/css/customNav.css" rel="stylesheet">-->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

<nav class="navbar navbar-default" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/"><b>Task Manager</b></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->

      <ul class="nav navbar-nav navbar-right">

        @if (Auth::id())
          <li><a href="/"><i class="fa fa-user"></i> {{Auth::user()->username}}</a></li>

          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-cog"></i> Lists <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="/list/add"><i class="fa fa-th-list"></i> Add List</a></li>
            <li class="divider"></li>
            <li><a href="/list/all"><i class="fa fa-list"></i> View Lists</a></li>

          </ul>
        
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-cog"></i> Tasks <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">

            <li><a href="/task/add"><i class="fa fa-plus-square"></i> Add Task</a></li>
            <li class="divider"></li>
            <li><a href="/task/all"><i class="fa fa-history"></i> View All Tasks</a></li>
            <li><a href="/task/completed"><i class="fa fa-check-square-o"></i> Completed Tasks</a></li>
            <li><a href="/task/incompleted"><i class="fa fa-minus-square"></i> Incompleted Tasks</a></li>
          </ul>

          <li><a href="/logout" onclick="return confirm('Are you sure?');"><i class="fa fa-sign-out"></i> Logout</a></li>
        @else
          <li><a href="/register"><i class="fa fa-plus-square"></i> Register</a></li>
          <li><a href="/login"><i class="fa fa-sign-in"></i> Log In</a></li>      
        @endif
      </li>
      </ul>



      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


    <div class="container">
        @if(Session::get('flash_message'))
          <div class="alert alert-info" id="flash_message">
            
             {{Session::get('flash_message');}}

          </div>
        @endif

        @if(Session::get('success_message'))
          <div class="alert alert-success" id="flash_message">
            
             {{Session::get('success_message');}}

          </div>
        @endif

        @if(Session::get('error_message'))
          <div class="alert alert-danger" id="not_flash_message">
            
             {{Session::get('error_message');}}

          </div>
        @endif

        @if($errors->first())
          <div class="alert alert-danger" id="not_flash_message">
            
             @foreach($errors->all() AS $error)
              <li>{{$error}}</li>
             @endforeach

          </div>
        @endif

        @yield('content')


        <div class="footer" style="text-align:center;">

          @yield('footer')
          
        </div>


    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">
       $(document).ready(function(){

          $('#flash_message').delay(5000).slideToggle(500);

       });
    </script>


  </body>
</html>