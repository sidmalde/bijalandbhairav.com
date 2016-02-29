<h2>
	<?=$title_for_layout;?>
	<?=$this->Html->link('Cancel', array('action' => 'index'), array('class' => 'btn btn-danger pull-right'));?>
</h2>

<div class="v-outer20">
	<?=$this->Form->create('FrequentlyAskedQuestion');?>
		<?=$this->Form->input('question');?>
		<?=$this->Form->input('answer');?>
		<?=$this->Form->input('display');?>
		<div class="">
			<?=$this->Form->button('Save', array('type' => 'submit', 'class' => 'btn btn-success'));?>
		</div>
	<?=$this->Form->end();?>
</div>