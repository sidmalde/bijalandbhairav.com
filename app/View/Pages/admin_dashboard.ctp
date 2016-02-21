<h1>
	<?=$title_for_layout;?>
</h1>

<div class="page-content">
	<div class="row">
		<div class="col-sm-3">
			<div class="admin-dashboard-tile">
				<a href="<?=$this->Html->url(array('controller' => 'offers', 'action' => 'index', 'admin' => true));?>">
					<i class="fa fa-plane fa-xl"></i>
					<h4>Offers</h4>
				</a>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="admin-dashboard-tile">
				<a href="<?=$this->Html->url(array('controller' => 'pages', 'action' => 'index', 'admin' => true));?>">
					<i class="fa fa-bars fa-xl"></i>
					<h4>CMS - Pages</h4>
				</a>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="admin-dashboard-tile">
				<a href="<?=$this->Html->url(array('controller' => 'default', 'action' => 'form_index', 'admin' => true));?>">
					<i class="fa fa-user fa-xl"></i>
					<h4>Enquiries</h4>
				</a>
			</div>
		</div>
	</div>
</div>