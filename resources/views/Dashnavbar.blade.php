<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>AMLBD</title>
  <link rel="icon" type="image/x-icon" href="http://www.amlbd.com/wp-content/uploads/2014/05/new-way-to-manage1.png">
  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
  <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <style>
    @import url('https://fonts.googleapis.com/css?family=Open+Sans:400,700,800');
    @import url('https://fonts.googleapis.com/css?family=Lobster');
    .navbar {
      position: absolute;
      left: 0;
      top: 0;
      padding: 0;
      width: 100%;
      transition: background 0.6s ease-in;
      z-index: 99999;
    }
    .navbar .navbar-brand {
      font-size: 2.5rem;
    }
    .navbar .navbar-toggler {
      position: relative;
      height: 50px;
      width: 50px;
      border: none;
      cursor: pointer;
      outline: none;
    }
    .navbar .navbar-toggler .menu-icon-bar {
      position: absolute;
      left: 15px;
      right: 15px;
      height: 2px;
      background-color: #fff;
      opacity: 0;
      -webkit-transform: translateY(-1px);
      -ms-transform: translateY(-1px);
      transform: translateY(-1px);
      transition: all 0.3s ease-in;
    }
    .navbar .navbar-toggler .menu-icon-bar:first-child {
      opacity: 1;
      -webkit-transform: translateY(-1px) rotate(45deg);
      -ms-sform: translateY(-1px) rotate(45deg);
      transform: translateY(-1px) rotate(45deg);
    }
    .navbar .navbar-toggler .menu-icon-bar:last-child {
      opacity: 1;
      -webkit-transform: translateY(-1px) rotate(135deg);
      -ms-sform: translateY(-1px) rotate(135deg);
      transform: translateY(-1px) rotate(135deg);
    }
    .navbar .navbar-toggler.collapsed .menu-icon-bar {
      opacity: 1;
    }
    .navbar .navbar-toggler.collapsed .menu-icon-bar:first-child {
      -webkit-transform: translateY(-7px) rotate(0);
      -ms-sform: translateY(-7px) rotate(0);
      transform: translateY(-7px) rotate(0);
    }
    .navbar .navbar-toggler.collapsed .menu-icon-bar:last-child {
      -webkit-transform: translateY(5px) rotate(0);
      -ms-sform: translateY(5px) rotate(0);
      transform: translateY(5px) rotate(0);
    }
    .navbar-dark .navbar-nav .nav-link {
      position: relative;
      color: #fff;
      font-size: 1.6rem;
    }
    .navbar-dark .navbar-nav .nav-link:focus, .navbar-dark .navbar-nav .nav-link:hover {
      color: dark;
    }
    .navbar .dropdown-menu {
      padding: 0;
      background-color: rgba(0, 0, 0, .9);
    }
    .navbar .dropdown-menu .dropdown-item {
      position: relative;
      padding: 10px 20px;
      color: #fff;
      font-size: 1.4rem;
      border-bottom: 1px solid rgba(255, 255, 255, .1);
      transition: color 0.2s ease-in;
    }
    .navbar .dropdown-menu .dropdown-item:last-child {
      border-bottom: none;
    }
    .navbar .dropdown-menu .dropdown-item:hover {
      background: transparent;
      color: #c0ca33;
    }
    .navbar .dropdown-menu .dropdown-item::before {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      top: 0;
      width: 5px;
      background-color: #c0ca33;
      opacity: 0;
      transition: opacity 0.2s ease-in;
    }
    .navbar .dropdown-menu .dropdown-item:hover::before {
      opacity: 1;
    }
    .navbar.fixed-top {
      position: fixed;
      -webkit-animation: navbar-animation 0.6s;
      animation: navbar-animation 0.6s;
      background-color: rgba(0, 0, 0, .9);
    }
    .navbar.fixed-top.navbar-dark .navbar-nav .nav-link.active {
      color: #c0ca33;
    }
    .navbar.fixed-top.navbar-dark .navbar-nav .nav-link::after {
      background-color: #c0ca33;
    }
    .content {
      padding: 120px 0;
    }
    @media screen and (max-width: 768px) {
      .navbar-brand {
        margin-left: 20px;
      }
      .navbar-nav {
        padding: 0 20px;
        background-color: rgba(0, 0, 0, .9);
      }
      .navbar.fixed-top .navbar-nav {
        background: transparent;
      }
    }
    @media screen and (min-width: 767px) {
      .banner {
        padding: 0 150px;
      }
      .banner h1 {
        font-size: 5rem;
      }
      .banner p {
        font-size: 2rem;
      }
      .navbar-dark .navbar-nav .nav-link {
        padding: 23px 15px;
      }
      .navbar-dark .navbar-nav .nav-link::after {
        content: '';
        position: absolute;
        bottom: 15px;
        left: 30%;
        right: 30%;
        height: 1px;
        background-color: #fff;
        -webkit-transform: scaleX(0);
        -ms-transform: scaleX(0);
        transform: scaleX(0);
        transition: transform 0.1s ease-in;
      }
      .navbar-dark .navbar-nav .nav-link:hover::after {
        -webkit-transform: scaleX(1);
        -ms-transform: scaleX(1);
        transform: scaleX(1);
      }
      .dropdown-menu {
        min-width: 200px;
        -webkit-animation: dropdown-animation 0.3s;
        animation: dropdown-animation 0.3s;
        -webkit-transform-origin: top;
        -ms-transform-origin: top;
        transform-origin: top;
      }
    }
    @-webkit-keyframes navbar-animation {
      0% {
        opacity: 0;
        -webkit-transform: translateY(-100%);
        -ms-transform: translateY(-100%);
        transform: translateY(-100%);
      }
      100% {
        opacity: 1;
        -webkit-transform: translateY(0);
        -ms-transform: translateY(0);
        transform: translateY(0);
      }
    }
    @keyframes navbar-animation {
      0% {
        opacity: 0;
        -webkit-transform: translateY(-100%);
        -ms-transform: translateY(-100%);
        transform: translateY(-100%);
      }
      100% {
        opacity: 1;
        -webkit-transform: translateY(0);
        -ms-transform: translateY(0);
        transform: translateY(0);
      }
    }
    @-webkit-keyframes dropdown-animation {
      0% {
        -webkit-transform: scaleY(0);
        -ms-transform: scaleY(0);
        transform: scaleY(0);
      }
      75% {
        -webkit-transform: scaleY(1.1);
        -ms-transform: scaleY(1.1);
        transform: scaleY(1.1);
      }
      100% {
        -webkit-transform: scaleY(1);
        -ms-transform: scaleY(1);
        transform: scaleY(1);
      }
    }
    @keyframes dropdown-animation {
      0% {
        -webkit-transform: scaleY(0);
        -ms-transform: scaleY(0);
        transform: scaleY(0);
      }
      75% {
        -webkit-transform: scaleY(1.1);
        -ms-transform: scaleY(1.1);
        transform: scaleY(1.1);
      }
      100% {
        -webkit-transform: scaleY(1);
        -ms-transform: scaleY(1);
        transform: scaleY(1);
      }
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-secondary h6">
    <div class="container-fluid">
      <img src="http://www.amlbd.com/wp-content/uploads/2014/05/new-way-to-manage1.png" style="width :8%;">
      <a href="{{route('home')}}" class="navbar-brand" style="font-size: 130%;"><b>AMLBD</b></a>
      
      <button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#main-nav">
        <span class="menu-icon-bar"></span>
        <span class="menu-icon-bar"></span>
        <span class="menu-icon-bar"></span>
      </button>

       <div id="main-nav" class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
        @if(Session::get('admin_type') == "SAdmin")
         <li><a href="{{route('beverages')}}" class="nav-item nav-link" style="font-size: 80%;">Admin Create</a></li>
         <li><a href="{{route('beverages')}}" class="nav-item nav-link" style="font-size: 80%;">Admin list</a></li>
         <li><a href="{{route('AdminCPass')}}" class="nav-item nav-link" style="font-size: 80%;">Change Password</a></li>
         @endif
         <li><a href="{{route('AdminLogout')}}" class="nav-item nav-link" style="font-size: 80%;">Logout</a></li>

        </ul>
      </div>
    </div>
  </nav>
</body>
</html>
<script>
  jQuery(function($) {
    $(window).on('scroll', function() {
      if ($(this).scrollTop() >= 200) {
       $('.navbar').addClass('fixed-top');
     } else if ($(this).scrollTop() == 0) {
       $('.navbar').removeClass('fixed-top');
     }
   });
    
  });
</script>