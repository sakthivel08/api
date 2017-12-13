@extends('admin.layout.app')

@section('content')
	{{ Form::model($user, array('url' => array('/admin/users/edit/' . $user->id), 'class' => 'form-horizontal', 'id' => 'useradd', 'files' => 'true', )) }}
		@if (count($errors) > 0)
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
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
					<label class="col-sm-2 control-label" for="email">{{trans('messages.Email')}}</label>
					<div class="col-sm-10">
						{{ Form::email('email', null, array('required' => '', 'class' => 'form-control', 'id' => 'email',  'placeholder' => trans('messages.Email')))}}
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="image">{{trans('messages.Image')}}</label>
					<div class="col-sm-10">
						{{ Form::file('image', ['class' => 'form-control', 'id' => 'image',]) }}
					</div>
				</div>
				@if(isset($user->image))
					<div class="form-group">
						<label class="col-sm-2 control-label"></label>
						<div class="col-sm-10">
							<a href="{{url($user->image)}}" target="_blank">{{trans('messages.Image')}}</a>
						</div>
					</div>
				@endif
				<div class="form-group">
					<label class="col-sm-2 control-label" for="password">{{trans('messages.Password')}}</label>
					<div class="col-sm-10">
						{{ Form::password('password', array('class' => 'form-control', 'id' => 'password', 'placeholder' => trans('messages.Password'))) }}
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="password_confirmation">{{trans('messages.PasswordConfirmation')}}</label>
					<div class="col-sm-10">
						{{ Form::password('password_confirmation', array('class' => 'form-control', 'id' => 'password_confirmation', 'placeholder' => trans('messages.PasswordConfirmation'))) }}
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="mobile">{{trans('messages.Mobile')}}</label>
					<div class="col-sm-10">
						{{ Form::number('mobile', null, array('required' => '', 'class' => 'form-control', 
						'id' => 'mobile',  'placeholder' => trans('messages.Mobile')))}}
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="address">{{trans('messages.Address')}}</label>
					<div class="col-sm-10">
						{{ Form::text('address', null, array('required' => '', 'class' => 'form-control', 'id' => 'address',  'placeholder' => trans('messages.Address')))}}
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="city">{{trans('messages.City')}}</label>
					<div class="col-sm-10">
						{{ Form::text('city', null, array('required' => '', 'class' => 'form-control', 'id' => 'city',  'placeholder' => trans('messages.City')))}}
						{{ Form::hidden('lat', null, array('id' => 'lat')) }}
						{{ Form::hidden('lon', null, array('id' => 'lon')) }}
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">   
						{{Form::submit(trans('messages.Save'), array('class' => 'btn btn-primary', 'id' => 'save'))}}
						<a class="btn btn-default" href="{{url('/admin/users')}}">{{trans('messages.Cancel')}}</a>
					</div>
				</div>
			</div>
		</div>
	{{ Form::close() }}
@stop

@section('content_header')
	<h1> {{trans('messages.EditUser')}}<small>{{trans('messages.ModifyUserDetails')}}</small></h1>
	<ol class="breadcrumb">
		<li><a href="{{url('/admin')}}"><i class="fa fa-home"></i> {{trans('messages.Home')}}</a></li>
		<li class="active"><i class="fa fa-user"></i> {{trans('messages.UsersManagement')}}</li>
	</ol>
@stop

@section('headerjs')
	<link rel="stylesheet" type="text/css" href="{{asset('/assets/plugins/datetimepicker/jquery.datetimepicker.css')}}">
@stop

@section('footerjs')
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkl5YeQiL1Z4iGzqNu2m7lSyArpQflXs8&libraries=places"></script>
	<script type="text/javascript" src="{{asset('/assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
	<script>
		$(document).ready(function(){
			$("#useradd").validate({ rules: { password_confirmation: { equalTo: "#password", } } });
			var lastQuery = null, lastResult = null, autocomplete,
			processLocation = function(callback){
				var input = $("#city");
				var lat = $("#lat"), lon = $("#lon");
				var query = $.trim(input.val()), geocoder;
				var cityVal;
				if(!query || query === lastQuery){
					if(callback){ callback(lastResult); }
					return; // and stop here
				}
				lastQuery = query; // store for next time
				geocoder = new google.maps.Geocoder();
				geocoder.geocode({ address: query, }, function(results, status){
					if(status === google.maps.GeocoderStatus.OK){
						for(var j = 0; j < results[0].address_components.length; j++){
							if(results[0].address_components[j].types[0] == 'locality'){ cityVal = results[0].address_components[j].long_name; break; }
						}
						if(cityVal){ input.val(cityVal); }
						var latitude = lat.val(results[0].geometry.location.lat());
						var longitude = lon.val(results[0].geometry.location.lng());
						lastResult = true; // success!
					}else{
						alert("Sorry - We couldn't find this location. Please try an alternative");
						lastResult = false; // failure!
					}
					if(callback){ callback(lastResult); }
				});
			}, options = { types: [ "geocode" ], };
			// options.componentRestrictions = { country: 'fr', };
			autocomplete = new google.maps.places.Autocomplete($("#city")[0], options);
			google.maps.event.addListener(autocomplete, 'place_changed', processLocation);
		});
	</script>
@stop