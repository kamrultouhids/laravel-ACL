<!DOCTYPE html>  
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="{!! asset('admin_assets/img/favicon.png') !!}" type="image/x-icon" />
<title>HRMS Login</title>
<!-- Bootstrap Core CSS -->
<link href="{!! asset('admin_assets/bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet">
<!-- animation CSS -->
<link href="{!! asset('admin_assets/css/animate.css') !!}" rel="stylesheet">
<!-- Custom CSS -->
<link href="{!! asset('admin_assets/css/style.css') !!}" rel="stylesheet">
<!-- color CSS -->
<link href="{!! asset('admin_assets/css/colors/default.css') !!}" id="theme"  rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
	.white-box {
		background: #fff;
		padding: 25px;
		margin-bottom: 30px;
		box-shadow: 1px 1px 8px;
		margin: 20% auto;
	}
</style>
</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="new-login-register">
    <div class="container">
		<div class="row">
			<div class="col-md-4"></div>
				<div class="col-md-4">
					<div class="white-box">
						<h3 class="box-title m-b-0">Log In</h3>
						<div class="login-logo" style="text-align: center">
							<b>Company Logo</b>
						</div>
						{!! Form::open(['url' => 'login','class' => 'form-horizontal new-lg-form','id' => 'loginform']) !!}
							@if($errors->any())
								<div class="alert alert-danger alert-dismissible" role="alert">
									@foreach($errors->all() as $error)
										<strong>{!! $error !!}</strong><br>
									@endforeach
								</div>
							@endif

							@if(session()->has('error'))
								<div class="alert alert-danger">
									<p>{!! session()->get('error') !!}</p>
								</div>
							@endif

							@if(session()->has('success'))
								<div class="alert alert-success">
									<p>{!! session()->get('success') !!}</p>
								</div>
							@endif
							<div class="form-group  m-t-20">
							  <div class="col-xs-12">
								<label>User Name</label>
								  <input type="text" name="user_name" class="form-control" placeholder="User Name " value="{!! old('user_name') !!}">
							  </div>
							</div>
							<div class="form-group">
							  <div class="col-xs-12">
								<label>Password</label>
								  <input type="password" name="user_password" class="form-control" placeholder="Password"/>
							  </div>
							</div>

							<div class="form-group text-center m-t-20">
							  <div class="col-xs-12">
								<button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
							  </div>
							</div>
						{!! Form::close() !!}


					</div>
				</div>
			<div class="col-md-4"></div>
		</div>
	</div>
                  
  
  
</section>
<!-- jQuery -->
<script src="{!! asset('admin_assets/plugins/bower_components/jquery/dist/jquery.min.js') !!}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{!! asset('admin_assets/bootstrap/dist/js/bootstrap.min.js') !!}"></script>
<!-- Menu Plugin JavaScript -->
<script src="{!! asset('admin_assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') !!}"></script>

<!--slimscroll JavaScript -->
<script src="{!! asset('admin_assets/js/jquery.slimscroll.js') !!}"></script>
<!--Wave Effects -->
<script src="{!! asset('admin_assets/js/waves.js') !!}"></script>
<!-- Custom Theme JavaScript -->
<script src="{!! asset('admin_assets/js/custom.min.js') !!}"></script>

</body>
</html>
