<h3>
	<?=@$title_for_layout;?>
	<div class="btn-group pull-right">
		<?=$this->Html->link(__('Back'), array('controller' => 'groups', 'action' => 'index'), array('class' => 'btn btn-primary btn-sm'));?>
	</div>
</h3>
<br />
<div class="row">
	<div class="col-xs-12">
		<div class="well">
			<?=$this->Form->create('Page'); ?>
				<?=$this->Form->hidden('id');?>
				<?=$this->Form->input('label');?>
				<?=$this->Form->input('title');?>
				<?=$this->Form->input('url');?>
				<?=$this->Form->input('content', array('type' => 'textarea', 'rows' => 12, 'class' => 'redactor'));?>
				<?=$this->Form->input('meta_keywords');?>
				<?=$this->Form->input('meta_description');?>
				<?=$this->Form->input('position');?>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="data[Page][publish]" <?=(!empty($page['Page']['publish'])) ? 'checked="checked"' : '';?>> Publish
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="data[Page][display_in_nav]" <?=(!empty($page['Page']['display_in_nav'])) ? 'checked="checked"' : '';?>> Display in Nav
					</label>
				</div>
				<?=$this->Form->button(__('Submit'), array('class' => 'btn btn-success'));?>
			<?=$this->Form->end(); ?>
		</div>
	</div>
</div>