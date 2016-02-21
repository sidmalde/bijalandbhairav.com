<div class="row">
	<div class="col-xs-12">
		<div class="navbar navbar-default">
			<div class="navbar-header">
				<a href="/" class="navbar-brand hidden-lg hidden-md"><i class="fa fa-home fa-xl"></i></a>
				<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="navbar-collapse collapse" id="navbar-main">
				<ul class="nav navbar-nav main-nav">
					<li class=" hidden-xs hidden-sm"><?=$this->Html->link('<i class="fa fa-home fa-md"></i>', array('controller' => 'pages', 'action' => 'dashboard', 'admin' => true), array('escape' => false, 'class' => 'navbar-brand hidden-xs hidden-sm'));?></li>
					<li class="dropdown">
						<?=$this->Html->link(__('Offers'), array('controller' => 'offers', 'action' => 'index'));?>
						<ul class="dropdown-menu" aria-labelledby="Offer Management">
							<li><?=$this->Html->link(__('Regions'), array('controller' => 'regions', 'action' => 'index'));?></li>
						</ul>
					</li>
					<li><?=$this->Html->link(__('CMS'), array('controller' => 'content_management_system', 'action' => 'index'));?></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li>
						<?=$this->Html->link('<i class="fa fa-cog fa-xs"></i>', '#', array('escape' => false, 'class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'));?>
						<ul class="dropdown-menu" aria-labelledby="User Management">
							<li><?=$this->Html->link(__('Users'), array('controller' => 'users', 'action' => 'index'));?></li>
						</ul>
					</li>
					<li><a href="/logout"><?=__('Logout');?></a></li>
				</ul>
			</div>
		</div>
	</div>
</div>