<? if (isset($firstBox) && $firstBox == true): ?>
	<div class="col-md-4">
<? else: ?>
	<div class="col-md-4">
<? endif; ?>
	<div class="home-box">
		<a href="<?=(empty($link)) ? '#' : $link ?>">
			<div class="img-container">
				<img class="fade" src="<?=$imgSource;?>" >
			</div>
			<div class="link-container">
				<div class="t-margin btn btn-warning btn-block large"><?=$label;?></div>
			</div>
		</a>
	</div>
</div>