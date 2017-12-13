<!DOCTYPE html>
<html>
	<head>
		<title>Admin Login</title>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="{{asset('/assets/bootstrap/css/bootstrap.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('/assets/plugins/iCheck/square/blue.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('/assets/dist/css/AdminLTE.min.css')}}">
	</head>
	<body class="hold-transition login-page">
		@if(Session::has('admin_err'))
			<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('admin_err') }}</p>
		@endif
		{{ Form::open(array('url' =>'/admin/login', "id" => "loginForm",)) }}
			<div class="login-box">
				<div class="login-logo">
					<b>Admin</b>
				</div>
				@if(Session::has('error'))
					<div class="alert alert-danger alert-dismissible">
						<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button> {{ Session::get('error') }}
					</div>
				@endif
				@if(Session::has('message'))
					<div class="alert alert-success alert-dismissible">
						<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button> {{ Session::get('message') }}
					</div>
				@endif
				<div class="login-box-body">
					<p class="login-box-msg">Sign in to Admin page</p>
					<div class="form-group">
						{{ Form::email('email', old('email'), array('class' => 'form-control', 'type' => 'email', 'id' => 'email', 'placeholder' => 'Email', 'required' => '')) }}
					</div>
					<div class="form-group">
						{{ Form::password('password', array('class'=> 'form-control','id'=>'password', 'placeholder' => 'Password', 'required' => '', "minlength" => 6)) }}
					</div>
					<div class="row">
						<div class="col-xs-8">
							{{ Form::checkbox('remember', 1, null, ['id' => 'remember', 'class' => 'className']) }}
							{{ Form::label('remember', 'Remember Me')}}
						</div>
						<div class="col-xs-4">
							{{Form::submit('Sign In', array('class' => 'btn btn-primary btn-block btn-flat' ,'id' => 'submit'))}}
						</div>
					</div>
				</div>
			</div>
		{{Form::close()}}
		<script src="{{asset('/assets/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
		<script src="{{asset('/assets/bootstrap/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('/assets/plugins/iCheck/icheck.min.js')}}"></script>
		<script src="{{asset('/assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
		@if(App::getLocale() == 'fr')
			<script type="text/javascript" src="{{asset('/assets/plugins/jquery-validation/localization/messages_fr.min.js')}}"></script>
		@elseif(App::getLocale() == 'ar')
			<script type="text/javascript" src="{{asset('/assets/plugins/jquery-validation/localization/messages_ar.min.js')}}"></script>
		@endif
		<script type="text/javascript">
			$(function(){
				/*$('input').iCheck({
					checkboxClass: 'icheckbox_square-blue',
					radioClass: 'iradio_square-blue',
					increaseArea: '20%' // optional
				});*/
				$("#loginForm").validate();
			});
		</script>
	</body>
</html>