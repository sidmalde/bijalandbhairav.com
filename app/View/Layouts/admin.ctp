<!DOCTYPE html>
<!DOCTYPE html>
<html>
	<head>
		<?=$this->Html->charset();?>
		<title><?=$title_for_layout;?></title>
		<?=$this->Html->meta('icon');?>
		
		 <!-- Bootstrap Core CSS -->
		<link href="/css/theme/bootstrap.min.css" rel="stylesheet">
		<!-- MetisMenu CSS -->
		<link href="/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
		<!-- Timeline CSS -->
		<link href="/css/plugins/timeline.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="/css/theme/sb-admin-2.css" rel="stylesheet">
		<!-- Morris Charts CSS -->
		<link href="/css/plugins/morris.css" rel="stylesheet">
		<!-- Calendar File -->
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.6/fullcalendar.min.css">
		<!-- DateTimePicker File -->
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.0.0/css/bootstrap-datetimepicker.min.css">
		<!-- Admin Core File -->
		<link href="/css/admin-core.css" rel="stylesheet">

		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/s/bs/jqc-1.11.3,pdfmake-0.1.18,dt-1.10.10,af-2.1.0,b-1.1.0,b-colvis-1.1.0,b-flash-1.1.0,b-html5-1.1.0/datatables.min.css"/>

		<link rel="stylesheet" href="/js/redactor/redactor.css">
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800,400italic,600italic' rel='stylesheet' type='text/css'>
		
		<!-- Custom Fonts -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" type="text/css">

		<?/*=$this->Html->css('admin-theme'); ?>
		<?=$this->Html->css('datepicker/jquery-ui.min'); ?>
		<?=$this->Html->css('datepicker/jquery-ui.theme.min'); ?>
		<?=$this->Html->css('datepicker/jquery-ui.structure.min'); ?>
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<?=$this->Html->css('admin-core'); ?>

		<script src="http://code.jquery.com/jquery-1.9.1.js" rel="stylesheet"></script>
		<?=$this->Html->script('bootstrap'); ?>
		<?=$this->Html->script('datepicker/jquery-ui.min'); ?>*/?>

	</head>
	<body>
		<div id="wrapper">
			<?=$this->element('Layouts/admin/header');?>
			<div id="page-wrapper">
				<div class="row">
					<div class="col-sm-12">
						<?=$this->fetch('content'); ?>
					</div>
				</div>
				<div id="footer" class="row">
					<div class="col-sm-12">
					</div>
				</div>
				<div class="clear">
				</div>
			</div>
		<?=$this->element('flash_container');?>

		<script src="/js/jquery-1.11.0.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/s/bs/jqc-1.11.3,pdfmake-0.1.18,dt-1.10.10,af-2.1.0,b-1.1.0,b-colvis-1.1.0,b-flash-1.1.0,b-html5-1.1.0/datatables.min.js"></script>
		<script src="/js/bootstrap.min.js"></script>
		<script src="/js/plugins/metisMenu/metisMenu.min.js"></script>
		
		<script src="/js/sb-admin-2.js"></script>
		<script src="/js/redactor/redactor.js"></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.0.0/js/bootstrap-datetimepicker.min.js"></script>

		<?=$this->Html->script('core');?>

		</div>
	</body>
</html>
