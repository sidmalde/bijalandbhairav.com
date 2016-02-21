<div id="footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="v-margin20 text-center">
					<a class="" href="/" alt="Home">Home</a> | 
					<? foreach($boxes as $index => $box): ?>
						<a class="" href="<?=$box['link'];?>" alt="<?=$box['label'];?>"><?=$box['label'];?></a> <?=($index < 5) ? '|' : '' ?> 
					<? endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>