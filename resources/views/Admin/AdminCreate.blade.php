<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AMLBD</title>
    <link rel="icon" type="image/x-icon" href="{{asset('img/aml.png')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
        body {
            background: linear-gradient(90deg, #00ffc8, #79beffd8);		
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8
        }
        .profile-button {
            background: rgb(99, 39, 120);
            box-shadow: none;
            border: none
        }
        .profile-button:hover {
            background: #682773
        }
        .profile-button:focus {
            background: #682773;
            box-shadow: none
        }
        .profile-button:active {
            background: #682773;
            box-shadow: none
        }
    </style>
</head>
<body>
    <div>
        @include('Dashnavbar')
    </div>
    <div class="container bg-white shadow " style= "border-radius: 50px; margin-top: 200px; margin-bottom: 150px;">
       <form action="{{route('AdminCreated')}}" method="post" name="form" enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-7 border border-danger" style= "border-radius: 50px;">
                <div class="p-3 py-5">   
                    <h4 class="text-center p-3 mb-4 text-muted">Admin Create</h4>           
                    <div class="form-group input-group">
                     <div class="input-group-prepend">
                      <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                  </div>
                  <input name="name" class="form-control" placeholder="Enter Admin Name" type="text">
              </div>
              <div class="form-group input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                  </div>
                  <input name="email" class="form-control" placeholder="Enter Admin Email" type="email">
              </div> 
              <div class="form-group input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                  </div>
                  <input name="password" class="form-control" placeholder="Enter Admin Password" type="Password">
              </div> 
              <h6 class="ml-2 mt-5">Admin Privileges</h6>
              <div class="row ml-3">
                <div class="custom-control custom-checkbox mt-3 col">     
                  <input type="checkbox" class="custom-control-input" id="customCheck1" name="create" value="True">
                  <label class="custom-control-label" for="customCheck1">Create</label >
              </div>
              <div class="custom-control custom-checkbox mt-3 col">     
                  <input type="checkbox" class="custom-control-input" id="customCheck2" name="update" value="True">
                  <label class="custom-control-label" for="customCheck2">update</label >
              </div>
              <div class="custom-control custom-checkbox mt-3 col">     
                  <input type="checkbox" class="custom-control-input" id="customCheck5" name="issue" value="True">
                  <label class="custom-control-label" for="customCheck5">Issue/Re-Issue</label >
              </div>
              </div>
              <div class="row ml-3">
                <div class="custom-control custom-checkbox mt-3 col">     
                  <input type="checkbox" class="custom-control-input" id="customCheck3" name="delete" value="True">
                  <label class="custom-control-label" for="customCheck3">Delete</label >
              </div>
              <div class="custom-control custom-checkbox mt-3 col">     
                  <input type="checkbox" class="custom-control-input" id="customCheck6" name="return" value="True">
                  <label class="custom-control-label" for="customCheck6">Return</label >
              </div>
              <div class="custom-control custom-checkbox mt-3 col">     
              </div>

              </div>
      <div class="form-group p-5 py-5">
        <input type="submit" class="btn btn-primary btn-block" value="Submit">
    </div>
</div>
</div>
<div class="col-sm-12 col-md-12 col-lg-12 col-xl-5 align-self-center">
  <div class="p-3 py-5">
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible">

        <ul>
           @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
           @endforeach
       </ul>
   </div>
   @endif
   @if (\Session::has('failed'))
   <div class="alert alert-danger alert-dismissible">

    {!! \Session::get('failed') !!}
</div>
@endif
@if (\Session::has('success'))
<div class="alert alert-success alert-dismissible">

    {!! \Session::get('success') !!}
</div>
@endif
</div>
</div>
</div>
</form>
</div>
</body>
</html>