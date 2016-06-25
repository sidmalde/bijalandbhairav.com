<div class="navbar navbar-dark" role="navigation">
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			<li><a href="/" class="large"><i class="fa fa-home fa-fw"></i></a></li>

			<? foreach($boxes as $index => $box): ?>
				<li><a class="" href="<?=$box['link'];?>" alt="<?=$box['label'];?>"><?=$box['label'];?></a></li>
			<? endforeach; ?>

			<? if(!empty($currentUser['User']['id'])): ?>
				<li class="pull-right"><a href="/logout">Logout</a></li>
			<? endif; ?>
		</ul>
	</div>
</div>