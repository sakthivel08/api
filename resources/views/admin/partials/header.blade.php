<header class="main-header">
	<!-- Logo -->
	<a href="{{url('admin')}}" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><b>FT</b></span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><b>Fayat</b></span>
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>
		<div class="navbar-custom-menu">
		          <ul class="nav navbar-nav">	
				<li class="dropdown notifications-menu">
					<!--  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<span class="hidden-xs">{{trans('messages.ChangeLanguage')}}</span>
					</a>   -->
					<!-- <ul class="dropdown-menu" style="width: auto;">
						<li>
							<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: auto;">
								<ul class="menu" style="overflow: hidden; width: auto; height: auto;">
									<li @if(App::getLocale() == 'en') class="activeLang" @endif><a href="{{urlWithQuery(Request::url(), array('lang' => 'en'))}}">{{trans('messages.English')}}</a></li>
									<li @if(App::getLocale() == 'fr') class="activeLang" @endif><a href="{{urlWithQuery(Request::url(), array('lang' => 'fr'))}}">{{trans('messages.French')}}</a></li>
									 <li @if(App::getLocale() == 'ar') class="activeLang" @endif><a href="{{urlWithQuery(Request::url(), array('lang' => 'ar'))}}">{{trans('messages.Arabic')}}</a></a></li>
									</ul>
							</div>
						</li>
					</ul>  -->
				</li>
				<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<span class="hidden-xs">{{$admin->name}}</span>
					</a>
					<ul class="dropdown-menu">
						<li class="user-header">
							<p>{{$admin->name}}</p>
						</li>
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-left">
								<a href="#" class="btn btn-default btn-flat">{{trans('messages.Profile')}}</a>
							</div>
							<div class="pull-right">
								<a href="{{url('/admin/logout')}}" class="btn btn-default btn-flat">{{trans('messages.Signout')}}</a>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="{{asset('/assets/dist/img/avatar5.png')}}" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p>{{$admin->name}}</p>
				<a href="#" ><i class="fa fa-circle text-success"></i> {{trans('messages.Online')}}</a>
			</div>
		</div>
		
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="header">{{trans('MAINNAVIGATION')}}</li>
			<li class="@if(Request::is('admin')) active @endif">
				<a href="{{url('admin')}}">
					<i class="fa fa-dashboard"></i> <span>{{trans('Dashboard')}}</span>
				</a>
			</li>
			<!-- <li class="@if(Request::is('admin/admins') || Request::is('admin/admins/*')) active @endif">
				<a href="{{url('/admin/admins')}}">
					<i class="fa fa-user-secret"></i> <span>{{trans('AdminsManagement')}}</span>
				</a>
			</li> -->
			
			<li class="@if(Request::is('admin/users') || Request::is('admin/users/*')) active @endif">
				<a href="{{url('/admin/users')}}">
					<i class="fa fa-users"></i> <span>{{trans('messages.UsersManagement')}}</span>
				</a>
			</li>

			

			
			
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>