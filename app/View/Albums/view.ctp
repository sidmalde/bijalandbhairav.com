<div class="outer">

	<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
	    <div class="slides"></div>
	    <h3 class="title"></h3>
	    <a class="prev">‹</a>
	    <a class="next">›</a>
	    <a class="close">×</a>
	    <a class="play-pause"></a>
	    <ol class="indicator"></ol>
	</div>

	<div class="well">
		<div id="links">
			<? foreach($album['Upload'] as $albumImage): ?>
			    <a href="<?=$albumImage['medium_url'];?>" title="<?=$albumImage['filename'];?>">
					<img src="<?=$albumImage['thumbnail_url'];?>" alt="<?=$albumImage['filename'];?>">
				</a>
			<? endforeach; ?>
		</div>
	</div>
</div>
<div class="clr"></div>

<script src="/js/blueimp/blueimp-gallery.min.js"></script>

<?=$this->element('gallery-script');?>