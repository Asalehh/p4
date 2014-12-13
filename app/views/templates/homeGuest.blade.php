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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="bodyGuest">

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



<div class="container homeTextSpacing">


<span class="bgspan spanHomeTitle"><i class="fa fa-list-ol"></i> Task Manager App</span><br /><br />
<span class="bgspan spanHomeDesc">Manage your tasks and get your life organized.</span>
<br /><br />
<a href="/register" class="btn btn-primary">Register Now</a>
</div>


<div class="footerGuest" style="text-align:center;">

<a href="https://github.com/Asalehh/p4" target="_blank" title="See on GitHub"><i class="fa fa-github fa-3x"></i></a>

</div>