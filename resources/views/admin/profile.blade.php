@extends('admin.layout.app')

@section('content')
	
	 {{ Form::model($admin, array('url' =>  route('name'), 'class' => 'form-horizontal', 'id' => "profile",)) }}
		@if (count($errors) > 0)
			<div class="alert alert-danger alert-dismissable">
	    		<button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button>
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
		@endif	
		<div class="box">
			<div class="box-body">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="firstname">{{trans('messages.FirstName')}}</label>
					<div class="col-sm-10">
						{{ Form::text('firstname', null, array('required' => '', 'class' => 'form-control', 'id' => 'firstname', 'placeholder' => trans('messages.FirstName'))) }}
					</div>  
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="lastname">{{trans('messages.LastName')}}</label>
					<div class="col-sm-10">
						{{ Form::text('lastname', null, array('required' => '', 'class' => 'form-control', 'id' => 'lastname', 'placeholder' => trans('messages.LastName'))) }}
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="password">{{trans('messages.Password')}}</label>
					<div class="col-sm-10">
						{{ Form::password('password', array('class' => 'form-control', 'id' => 'password', 'placeholder' => trans('messages.Password'))) }}
					</div>	
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="password-confirm">{{trans('messages.ConfirmPassword')}}</label>
					<div class="col-sm-10">
						{{ Form::password('password_confirmation', array('class' => 'form-control', 'id' => 'password-confirm', 'placeholder' => trans('messages.ConfirmPassword'))) }}
					</div>	
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">     
						{{Form::submit(trans('messages.Save'),array('class' => 'btn btn-primary', 'id' => 'save'))}}
						<a class="btn btn-default" href="{{url('/admin')}}">{{trans('messages.Cancel')}}</a>
					</div> 
				</div>
			</div>
		</div>
	{{ Form::close() }}
@stop

@section('content_header')
	<h1>Profile</h1>
	<ol class="breadcrumb">
		<li><a href="{{url('/admin')}}"><i class="fa fa-home"></i> Home</a></li>
		<li class="active"><i class="fa fa-user"></i> Profile</li>
	</ol>
@stop

@section('footerjs')
	<script type="text/javascript" src="{{asset('/assets/plugins/moment/moment.js')}}"></script>
	<script type="text/javascript" src="{{asset('/assets/plugins/datetimepicker/build/jquery.datetimepicker.full.js')}}"></script>
	<script type="text/javascript" src="{{asset('/assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
	@if(App::getLocale() == 'fr')
		<script type="text/javascript" src="{{asset('/assets/plugins/jquery-validation/localization/messages_fr.min.js')}}"></script>
	@elseif(App::getLocale() == 'ar')
		<script type="text/javascript" src="{{asset('/assets/plugins/jquery-validation/localization/messages_ar.min.js')}}"></script>
	@endif
	<script>
		console.log("{{App::getLocale()}}");
		$(document).ready(function(){
			$.validator.addMethod("birthdate", function(value, element){
				// put your own logic here, this is just a (crappy) example
				// return value.match(/^\d\d?\/\d\d?\/\d\d\d\d$/);
				return value.match(/^\d\d\d\d?\-\d\d?\-\d\d$/);
			}, "Please enter a date in the format dd/mm/yyyy.");
			@if(App::getLocale() == 'fr')
				$.datetimepicker.setLocale('fr');
			@elseif(App::getLocale() == 'ar')
				$.datetimepicker.setLocale('ar');
			@endif
			$("#profile").validate({
				rules: {
					password_confirmation: { equalTo: "#password", }
				},
			});
			
		});
	</script>
@stop