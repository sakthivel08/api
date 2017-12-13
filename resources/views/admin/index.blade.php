@extends('admin.layout.app')

@section('content')
	<div class="row">
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-yellow">
				<div class="inner">
					<h3>0</h3>
					<p>{{trans('messages.UsersRegistrations')}}</p>
				</div>
				<div class="icon">
					<i class="fa fa-user"></i>
				</div>
				<!-- <a href="{{url('/admin/teachers')}}" class="small-box-footer">{{trans('messages.Moreinfo')}} <i class="fa fa-arrow-circle-right"></i></a> -->
			</div>
		</div>
		<!-- <div class="col-lg-3 col-xs-6">
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3>0</h3>
					<p>{{trans('messages.CharityRegistrations')}}</p>
				</div>
				<div class="icon">
					<i class="fa fa-users"></i>
				</div>
				<a href="{{url('/admin/parents')}}" class="small-box-footer">{{trans('messages.Moreinfo')}} <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div> -->
		
	</div>
@stop

@section('content_header')
	<h1>{{trans('messages.Dashboard')}} <small>{{trans('messages.Controlpanel')}}</small></h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i> {{trans('messages.Home')}}</a></li>
		<li class="active"><i class="fa fa-dashboard"></i> {{trans('messages.Dashboard')}}</li>
	</ol>
@stop