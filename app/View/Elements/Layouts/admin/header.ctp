<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="/">Visaline Travel</a>
	</div>
	<!-- /.navbar-header -->

	<ul class="nav navbar-top-links navbar-right">
		<!-- /.dropdown -->
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
			</a>
			<ul class="dropdown-menu dropdown-user">
				<li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a></li>
				<li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a></li>
				<li class="divider"></li>
				<li><a href="<?=Router::url(array('controller' => 'users', 'action' => 'logout', 'admin' => false));?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
			</ul>
			<!-- /.dropdown-user -->
		</li>
		<!-- /.dropdown -->
	</ul>
	<!-- /.navbar-top-links -->

	<div class="navbar-default sidebar" role="navigation">
		<div class="sidebar-nav navbar-collapse">
			<ul class="nav" id="side-menu">
				<li>
					<a <?=(!empty($bodyClass) && $bodyClass == 'offers') ? 'class="active"' : '';?>href="<?=Router::url(array('controller' => 'offers', 'action' => 'index'));?>"><i class="fa fa-user fa-fw"></i> Offers</a>
				</li>
				<li>
					<a <?=(!empty($bodyClass) && $bodyClass == 'regions') ? 'class="active"' : '';?>href="<?=Router::url(array('controller' => 'regions', 'action' => 'index'));?>"><i class="fa fa-globe fa-fw"></i> Regions</a>
				</li>
				<li>
					<a <?=(!empty($bodyClass) && $bodyClass == 'pages') ? 'class="active"' : '';?>href="<?=Router::url(array('controller' => 'pages', 'action' => 'index'));?>"><i class="fa fa-book fa-fw"></i> Pages</a>
				</li>
			</ul>
		</div>
		<!-- /.sidebar-collapse -->
	</div>
	<!-- /.navbar-static-side -->
</nav>