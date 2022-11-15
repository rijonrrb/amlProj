<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AMLBD</title>
    <link rel="icon" type="image/x-icon" href="http://www.amlbd.com/wp-content/uploads/2014/05/new-way-to-manage1.png">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">

</head>
<body>
<div class="container">
	<div class="screen">
		<div class="screen__content">
			<br><br>
			<h1 class="hl">Login</h1>
            <form action="{{route('AdminLog')}}" method="post" name="form">
                <div class="hq">
                            {{csrf_field()}}
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
                </div>
				<div class="login__field">
					<input type="text" name="email" required="required"><span>Email</span>
				</div>
				<div class="login__field">
					<input type="password" name="password" required="required"><span>Password</span>
				</div>
				<input type="submit" class="button login__submit" value="Login">
					<i class="button__icon fas fa-chevron-right"></i>
				</input>				
			</form>
			<div class="social-login">				
			</div>          
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>
</body>
</html>