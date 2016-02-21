<!DOCTYPE html>
<html>
<head>
	<?=$this->Html->charset(); ?>
	<title><?=$title_for_layout;?></title>
	<?=$this->Html->meta('icon');?>

	<?=$this->fetch('meta');?>
	
	<?#=$this->Html->css('bootstrap'); ?>
	<?=$this->Html->css('admin-theme'); ?>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<?=$this->Html->css('core'); ?>
</head>
<body>
	<div id="main-content" class="container">
		<div class="row">
			<div class="col-sm-12 main">
				<?=$this->fetch('content'); ?>
			</div>
		</div>
	</div>
	<?=$this->element('flash_container');?>
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<?=$this->Html->script('bootstrap.min'); ?>
	<?=$this->Html->script('core'); ?>
	<?/*<div class="container">
		<div id="content" class="row">
			<div class="col-xs-12">
				<?=$this->element('header-default');?>
				<?=$this->element('nav-main-default');?>
				<div class="row">
					<div class="col-md-12">
						<?=$this->fetch('content'); ?>
					</div>
				</div>
			</div>
		</div>
		<div id="footer" class="row">
			<div class="col-xs-12">
			</div>
		</div>
		<div class="clear">&nbsp;</div>
	</div>
	<?=$this->element('flash_container');?>*/?>
</body>
</html>
