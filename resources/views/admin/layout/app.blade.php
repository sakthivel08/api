<!DOCTYPE html>
<html>
	<head>
		<title>{{$title}}</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="{{asset('/assets/bootstrap/css/bootstrap.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('/assets/plugins/iCheck/square/blue.css')}}">
		<link rel="stylesheet" href="{{asset('/assets/dist/css/skins/_all-skins.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('assets/jquery-ui/jquery-ui.css')}}">	
		@yield('headerjs')
		<link rel="stylesheet" type="text/css" href="{{asset('/assets/dist/css/AdminLTE.css')}}">
		
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper" id="loader">
			@include('admin.partials.header')
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">@yield('content_header')</section>
				<section class="content">
					@if(Session::has('error'))
						<div class="alert alert-danger alert-dismissible">
							<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
							{{ Session::get('error') }}
						</div>
					@endif
					@if(Session::has('message'))
						<div class="alert alert-success alert-dismissible">
							<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
							{{ Session::get('message') }}
						</div>
					@endif
					@yield('content')
				</section>
			</div>
			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					<b>{{trans('messages.Version')}}</b> 1.0
				</div>
				<strong>{{trans('messages.Copyright')}} &copy; {{date('Y')}} <a href="{{url('/')}}">Fayat</a>.</strong> {{trans('messages.AllRightsReserved')}}
			</footer>
		</div>
		<script src="{{asset('/assets/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
		<script src="{{asset('/assets/bootstrap/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('/assets/dist/js/app.min.js')}}"></script>
		@yield('footerjs')
	</body>

	
</html>