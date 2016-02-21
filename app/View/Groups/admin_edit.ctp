<?=$this->Form->create('Group'); ?>
	<div class="row">
		<div class="span12 page-header">
			<div class="row">
				<div class="span8"><h3><?=@$title_for_layout;?></h3></div>
				<div class="span3">
					<div class="btn-group pull-right">
						<?=$this->Form->button(__('Save'), array('class' => 'btn btn-primary'));?>
						<?=$this->Html->link(__('Cancel'), array('controller' => 'users', 'action' => 'index'), array('class' => 'btn btn-danger'));?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="span12">
			<div class="well">
					<?=$this->Form->hidden('id', array('value' => $group['Group']['id']));?>
					<?=$this->Form->input('name', array('value' => $group['Group']['name']));?>
					<?=$this->Form->input('description', array('value' => $group['Group']['description']));?>
			</div>
		</div>
	</div>
<?=$this->Form->end();?>