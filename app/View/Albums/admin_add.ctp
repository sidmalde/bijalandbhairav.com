<?=$this->Form->create('Album', array('class' => 'form form-horizontal'));?>
	<h3>
		<?=@$title_for_layout;?>
		<div class="btn-group pull-right">
			<?=$this->Html->link(__('Back'), array('controller' => 'albums', 'action' => 'index'), array('class' => 'btn btn-primary btn-sm'));?>
			<?=$this->Form->button('Save Album', array('type' => 'submit', 'class' => 'btn btn-success btn-sm'));?>
		</div>
	</h3>

	<div class="row">
		<div class="col-xs-12">
			<?=$this->Form->input('title');?>
			<?=$this->Form->input('description');?>
			<?=$this->Form->input('display_order');?>
		</div>
	</div>
<?=$this->Form->end();?>