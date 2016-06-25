<h3>
	<?=@$title_for_layout;?>
	<div class="btn-group pull-right">
		<?=$this->Html->link(__('New Album'), array('controller' => 'albums', 'action' => 'add'), array('class' => 'btn btn-primary btn-sm'));?>
	</div>
</h3>

<div class="row">
	<div class="col-xs-12">
		<? foreach($albums as $album): ?>
			<div class="col-xs-4">
				<div class="album-box-container">
					<h4 class="text-center"><?=$album['Album']['title'];?></h4>
					<?=$this->Html->link('<i class="fa fa-eye"> </i>', array('action' => 'view', 'album' => $album['Album']['id']), array('class' => 'btn btn-info btn-square', 'escape' => false));?>
					<?=$this->Html->link('<i class="fa fa-pencil"> </i>', array('action' => 'edit', 'album' => $album['Album']['id']), array('class' => 'btn btn-success btn-square', 'escape' => false));?>
					<?=$this->Html->link('<i class="fa fa-trash"> </i>', array('action' => 'delete', 'album' => $album['Album']['id']), array('class' => 'btn btn-danger btn-square', 'escape' => false));?>
				</div>
			</div>
		<? endforeach; ?>
	</div>
</div>