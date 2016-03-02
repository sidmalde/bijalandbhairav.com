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
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800,400italic,600italic' rel='stylesheet' type='text/css'>
	
</head>
<body class="default-layout">
	
	<div class="container">
		<?=$this->element('Layouts/header-top-default');?>
		<div class="row">
			<div class="col-sm-12">
				<?=$this->element('Layouts/nav-default');?>
				<div class="well well-dark-transparent">
					<div class="row">
						<? if(isset($weddingSchedule)): ?>
							<div class="col-sm-9">
								<h1><?=$title_for_layout;?></h1>
								<h2>Save the Date</h2>

								<p>We do not have any other formal events planned except for the wedding on Thursday.</p>

								<p>We hope that you enjoy Córdoba either side of the Thursday and we are looking to organise something informal on the Wednesday and Friday but we will let you know closer to the time.</p>
							</div>
							<div class="col-sm-3">
								<img class="ganesh" src="/img/Ganesh Test.png" />
							</div>
						<? else: ?>
							<div class="col-sm-12">
								<h1><?=$title_for_layout;?></h1>
							</div>
						<? endif; ?>
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