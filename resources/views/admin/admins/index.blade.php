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
	 			@if(!$admins->isEmpty())
	 				@foreach ($admins as $admin)	 			
		 				<tr>
		 					<td>{{$admin->name}}</td>
							<td>{{$admin->email}}</td>
							<td>
								<a class="btn btn-primary" href="{{ route('admins.edit',$admin->id) }}"><i class="fa fa-edit fa-lg"></i></a>
								
								<a class="btn btn-danger" onClick="return confirm('Are you sure?')" href="{{ url('/admin/admins/delete',[ 'id' => $admin->id, ])}}"><i class="fa fa-trash-o fa-lg"></i></a>
							</td>
						</tr>
					@endforeach
				@else
					<td colspan="5" class="text-center">{{trans('messages.Norecordsfound')}}</td>
				@endif
			</table>
			{{$admins->render()}}
		</div>
	</div>
@stop

@section('content_header')
	<h1>{{trans('messages.AdminsManagement')}} <small>{{trans('messages.DetailsofAdmins')}}</small></h1></br>
	<a class="btn btn-primary" href="{{ route('admins.create') }}">{{trans('messages.AddAdmin')}}</a>
	<ol class="breadcrumb">
		<li><a href="{{url('/admin')}}"><i class="fa fa-home"></i> {{trans('messages.Home')}}</a></li>
		<li class="active"><i class="fa fa-user-secret"></i> {{trans('messages.AdminsManagement')}}</li>
	</ol>
@stop