<div class="outer">
	<? foreach($albums as $album): ?>
		<? if(!empty($album['Upload'])): ?>
			<div class="col-xs-4">
				<div class="album-box-container">
					<a href="/gallery/<?=$album['Album']['slug'];?>">
						<img src="<?=$album['Thumbnail']['thumbnail_url'];?>" />
						<p class="text-center"><?=$album['Album']['title'];?></p>
					</a>
				</div>
			</div>
		<? endif; ?>
	<? endforeach; ?>
</div>
<div class="clr"></div>