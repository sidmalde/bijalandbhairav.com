<!DOCTYPE html>
<html>
<head>
	<?=$this->Html->charset(); ?>
	<title><?=$title_for_layout;?></title>
	<?=$this->Html->meta('icon');?>

	<?=$this->fetch('meta');?>
	
	<?=$this->Html->css('bootstrap'); ?>
	<?=$this->Html->css('theme/cerulean'); ?>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" type="text/css">
	<?=$this->Html->css('core'); ?>
	<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	
</head>
<body class="default-layout">
	<?//=$this->element('Layouts/nav-top-default');?>
	
	<div class="container">
		<?=$this->element('Layouts/header-top-default');?>
		<div class="row">
			<div class="col-sm-12">
				<div class="well well-dark-transparent">
					<div class="row">
						<div class="col-sm-3">
							<a href="/">Home</a> > <?=$title_for_layout;?>
						</div>
						<div class="col-sm-6">
							<h1 class="text-center"><?=$title_for_layout;?></h1>
						</div>
					</div>
					<?=$this->fetch('content'); ?>
				</div>
			</div>
		</div>
	</div>
	<?=$this->element('Layouts/footer-default');?>
	<?=$this->element('flash_container');?>
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<?=$this->Html->script('bootstrap.min'); ?>
	<?=$this->Html->script('core'); ?>
</body>
</html>