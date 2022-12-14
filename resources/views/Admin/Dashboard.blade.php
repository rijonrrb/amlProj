<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AMLBD</title>
  <link rel="icon" type="image/x-icon" href="{{asset('img/aml.png')}}">
  <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
  <link
  href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,600;1,200;1,400;1,600&display=swap"
  rel="stylesheet">
</head>
<body>
  <div>
    @include('navbar.Dashnavbar')
  </div>
  <div class="header" style="margin-bottom: 80px; margin-top: 120px;">
    <h1>Adaptable, Workable & Secure</h1>
    <h1>Technology for IT Department</h1>
    <p>This website will manage all of your IT stuff such as User list, IP list, Inventory list, VPN system and many more....</p>
  </div> 
  <div class="row1-container">
    <div class="box box-down cyan" title="Click on the text">
      <a href="{{route('userlist')}}" ><h2 class="hover-underline-animation">User List</h2></a> <br>
      <code>All the User list are here!</code>
      <img src="https://www.svgrepo.com/show/192244/man-user.svg" alt="" style="height: 90px; width: 90px;">
    </div>
    <div class="box red" title="Click on the text">
      <a href="{{route('ipaddress')}}" ><h2 class="hover-underline-animation">IP List</h2></a> <br>  
      <code>All the IP list are here!</code>
      <img src="{{asset('img/ip.svg')}}" alt="" style="height: 100px; width: 100px;">
    </div>
    <div class="box box-down blue" title="Click on the text">
      <a href="{{route('vpn')}}" ><h2 class="hover-underline-animation">VPN List</h2></a> <br>
      <code>All the VPN list are here!</code>
      <img src="{{asset('img/vpn.svg')}}" alt="" style="height: 100px; width: 100px;">
    </div>
  </div>
  <div class="row2-container">
    <div class="box orange" title="Click on the text">
      <a href="{{route('Igloo_CHO')}}" ><h2 class="hover-underline-animation">Asset List</h2></a> <br>
      <code>All the Asset list are here!</code>
      <img src="https://www.svgrepo.com/show/190786/laptop.svg" alt="" style="height: 90px; width: 90px;">
    </div>
  </div>
<br><br>
</body>
</html>