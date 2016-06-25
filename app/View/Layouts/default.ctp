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
	<link rel="stylesheet" href="/css/blueimp-gallery.min.css">
	
</head>
<body class="default-layout">
	
	<div class="container">
		<?=$this->element('Layouts/header-top-default');?>
		<div class="row">
			<div class="col-sm-12">
				<?=$this->element('Layouts/nav-default');?>
				<div class="well well-dark-transparent">
					<div class="row">
						<?/* if(isset($weddingSchedule)): ?>
							
							<div class="col-sm-3">
								<img class="ganesh" src="/img/Ganesh Test.png" />
							</div>
						<? else: */?>
							<div class="col-sm-12">
								<h1><?=$title_for_layout;?></h1>
							</div>
						<?/* endif; */?>
					</div>
					<?=$this->fetch('content'); ?>
				</div>
			</div>
		</div>
	</div>
	<?=$this->element('Layouts/footer-default');?>
	<?=$this->element('flash_container');?>
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

	<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
	<script src="/plugins/FileUpload/js/vendor/jquery.ui.widget.js"></script>
	<!-- The Templates plugin is included to render the upload/download listings -->
	<script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
	<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
	<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
	<!-- The Canvas to Blob plugin is included for image resizing functionality -->
	<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
	<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<!-- blueimp Gallery script -->
	<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
	<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
	<script src="/plugins/FileUpload/js/jquery.iframe-transport.js"></script>
	<!-- The basic File Upload plugin -->
	<script src="/plugins/FileUpload/js/jquery.fileupload.js"></script>
	<!-- The File Upload processing plugin -->
	<script src="/plugins/FileUpload/js/jquery.fileupload-process.js"></script>
	<!-- The File Upload image preview & resize plugin -->
	<script src="/plugins/FileUpload/js/jquery.fileupload-image.js"></script>
	<!-- The File Upload audio preview plugin -->
	<script src="/plugins/FileUpload/js/jquery.fileupload-audio.js"></script>
	<!-- The File Upload video preview plugin -->
	<script src="/plugins/FileUpload/js/jquery.fileupload-video.js"></script>
	<!-- The File Upload validation plugin -->
	<script src="/plugins/FileUpload/js/jquery.fileupload-validate.js"></script>
	<!-- The File Upload user interface plugin -->
	<script src="/plugins/FileUpload/js/jquery.fileupload-ui.js"></script>
	<!-- The main application script -->
	<script src="/plugins/FileUpload/js/main.js"></script>
	<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
	<!--[if (gte IE 8)&(lt IE 10)]>
	<script src="/uploads/FileUpload/js/cors/jquery.xdr-transport.js"></script>
	<![endif]-->

	<?=$this->Html->script('bootstrap.min'); ?>
	<?=$this->Html->script('core'); ?>
</body>
</html>