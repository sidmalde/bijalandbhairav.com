<div class="row">
	<? foreach ($boxes as $index => $box): ?>
		<? if($index <= 2): ?>
			<? if($index == 0): ?>
				<?=$this->element('home-box', array('firstBox' => true, 'label' => $box['label'], 'link' => @$box['link'], 'imgSource' => $box['img-source'])); ?>
			<? else: ?>
				<?=$this->element('home-box', array('label' => $box['label'], 'link' => @$box['link'], 'imgSource' => $box['img-source'])); ?>
			<? endif; ?>
		<? endif; ?>
	<? endforeach; ?>
</div>

<br /><br />

<div class="row">
	<? foreach ($boxes as $index => $box): ?>
		<? if($index > 2): ?>
			<? if($index == 0): ?>
				<?=$this->element('home-box', array('firstBox' => true, 'label' => $box['label'], 'link' => @$box['link'], 'imgSource' => $box['img-source'])); ?>
			<? else: ?>
				<?=$this->element('home-box', array('label' => $box['label'], 'link' => @$box['link'], 'imgSource' => $box['img-source'])); ?>
			<? endif; ?>
		<? endif; ?>
	<? endforeach; ?>
</div>