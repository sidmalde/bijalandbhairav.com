<div id="footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<?/*<div class="text-contact">Contact Us:</div>*/?>
				<div class="col-md-4 col-md-offset-1 text-center text-contact">
					<strong>Bijal:</strong> +44 7957 342 975
				</div>
				<div class="col-md-4 col-md-offset-1 text-center text-contact">
					<strong>Bhairav:</strong> +44 7713 367 821
					<?/*<audio controls autoplay="true">
						<source src="<?=$backgroundSongPath;?>" type="audio/mpeg" autostart="true" volume="0.2">
						Your browser does not support the audio element.
					</audio>*/?>
				</div>
				<div class="clear"></div>
			</div>

			<div class="col-sm-10 col-sm-offset-1">
				<div class="v-margin20 text-center bold">
					<a class="" href="/" alt="Home">Home</a> | 
					<? foreach($boxes as $index => $box): ?>
						<a class="" href="<?=$box['link'];?>" alt="<?=$box['label'];?>"><?=$box['label'];?></a> <?=($index < 5) ? '|' : '' ?> 
					<? endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>