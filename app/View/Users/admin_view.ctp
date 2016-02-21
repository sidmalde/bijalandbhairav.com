<?=$this->Form->create('User', array('url' => $this->Html->url(array('controller' => 'users', 'action' => 'edit', 'user' => $user['User']['id'], 'admin' => true)), 'class' => 'form form-user-note-edit', 'type' => 'file')); ?>
<h2>
	<?=@$title_for_layout;?>
	<div class="btn-group pull-right">
		<?=$this->Html->link(__('Back'), array('action' => 'index'), array('class' => 'btn btn-sm btn-primary'));?>
		<?=$this->Form->submit(__('Save Changes'), array('div' => false, 'label' => false, 'type' => 'submit', 'class' => 'btn btn-sm btn-success'));?>
	</div>
</h2>
<div class="v-outer20">
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<div class="well">
				<?=$this->Form->hidden('id');?>
				<?=$this->Form->input('group_id');?>
				<?=$this->Form->input('email');?>
				<?=$this->Form->input('firstname');?>
				<?=$this->Form->input('lastname');?>
				<?=$this->Form->input('mobile');?>
			</div>
		</div>
	</div>
</div>
<?=$this->Form->end(); ?>