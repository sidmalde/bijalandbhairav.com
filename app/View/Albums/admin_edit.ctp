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
			<? foreach($unassignedImages as $unassignedImage): ?>
				<div class="col-xs-3">
					<div class="image-box-container">
						<div>
							<img src="<?=$unassignedImage['Upload']['thumbnail_url'];?>" />
						</div>
						<div>
							<span>by <?=$unassignedImage['User']['fullname'];?></span>
							<div>
								<input type="checkbox" id="chk<?=$unassignedImage['Upload']['id'];?>" name="data[Album][<?=$unassignedImage['Upload']['id'];?>]" />
								<label for="chk<?=$unassignedImage['Upload']['id'];?>"><span></span>Add</label>
								<?#=$this->Form->input('Add to Alum', array('type' => 'checkbox', 'div' => false, 'between' => false, 'class' => 'normal-checkbox'));?>
							</div>
						</div>
					</div>
				</div>
			<? endforeach; ?>
		</div>
	</div>
<?=$this->Form->end();?>