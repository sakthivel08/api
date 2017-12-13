@extends('admin.layout.app')

@section('content')
	<div class="box">
		<div class="box-body">
			<table class="table table-hover">
				<tr style="text-align:center">
					<th>{{trans('messages.Name')}}</th>
	 				<th>{{trans('messages.Email')}}</th>
					<th>{{trans('messages.Action')}}</th>
	 			</tr>
	 			@if(!$users->isEmpty())
	 				@foreach($users as $user)	 			
		 				<tr>
							<td>{{$user->name}}</td>
							<td>{{$user->email}}</td>
							<td>
								<a class="btn btn-primary" href="{{ url('/admin/users/edit', [ 'id' => $user->id, ])}}"><i class="fa fa-edit fa-lg"></i></a>
								<a class="btn btn-danger" onClick="return confirm('Are you sure?')" href="{{ url('/admin/users/delete',[ 'id' => $user->id, ])}}"><i class="fa fa-trash-o fa-lg"></i></a>
							</td>
						</tr>
					@endforeach
				@else
					<td colspan="5" class="text-center">{{trans('messages.Norecordsfound')}}</td>
				@endif
			</table>
			{{ $users->render() }}
		</div>
	</div>
@stop

@section('content_header')
	<h1>{{trans('messages.UsersManagement')}} <small>{{trans('messages.DetailsofUser')}}</small></h1></br>
	<a class="btn btn-primary" href="{{url('/admin/users/add')}}">{{trans('messages.AddUser')}}</a>
	<ol class="breadcrumb">
		<li><a href="{{url('/admin')}}"><i class="fa fa-home"></i> {{trans('messages.Home')}}</a></li>
		<li class="active"><i class="fa fa-user"></i> {{trans('messages.UsersManagement')}}</li>
	</ol>
@stop
