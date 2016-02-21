<div id="bottom-shade">
	<?
		$hasMessage = $this->Session->read('Message');
		if (!empty($hasMessage)) {
			echo $this->Session->flash();
		}
	?>
</div>