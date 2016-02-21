<h3>
	<?=@$title_for_layout;?>
	<div class="btn-group pull-right">
		<?=$this->Html->link(__('Back'), array('controller' => 'users', 'action' => 'index'), array('class' => 'btn btn-primary btn-sm'));?>
	</div>
</h3>

<div class="well  col-lg-5">
	<?=$this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'add'), 'class' => 'form'));?>
		<?=$this->Form->input('group_id', array('empty' => __('Please select an option:'), 'options' => $groups));?>
		<?=$this->Form->input('email');?>
		<?=$this->Form->input('firstname');?>
		<?=$this->Form->input('lastname');?>
		<?=$this->Form->input('password');?>
		<?=$this->Form->input('mobile');?>
		<div class="clear">&nbsp;</div>
		<?=$this->Form->button(__('Save'), array('type' => 'submit', 'class' => 'btn btn-success'));?>
	<?=$this->Form->end();?>
</div>