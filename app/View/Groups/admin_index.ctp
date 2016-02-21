<h3>
	<?=@$title_for_layout;?>
	<div class="btn-group pull-right">
		<?=$this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add'), array('class' => 'btn btn-primary btn-sm'));?>
	</div>
</h3>

<div class="row">
	<div class="col-xs-12">
		<table class="table table-hover table-striped">
			<tr>
				<th><?=__('Name');?></th>
				<th><?=__('Description');?></th>
				<th><?=__('Users');?></th>
				<th><?=__('Last Modified');?></th>
				<th>&nbsp;</th>
			</tr>
			<? foreach ($groups as $group): ?>
				<tr>
					<td><?=$group['Group']['name']?></td>
					<td><?=$group['Group']['description']?></td>
					<td><?=count($group['User'])?></td>
					<td><?=$this->Time->nice($group['Group']['modified'])?></td>
					<td>
						<?=$this->Html->link('<i class="fa fa-pencil"></i> '.__('Edit'), array('controller' => 'groups', 'action' => 'edit', 'group' => $group['Group']['id']), array('escape' => false, 'class' => 'btn btn-sm btn-info'));?>
						<!--<div class="btn-group">
							<?=$this->Html->link(__('Actions').' <span class="caret"></span>', array('controller' => 'groups', 'action' => 'edit', 'group' => $group['Group']['id']), array('escape' => false, 'class' => 'btn btn-success dropdown-toggle', 'data-toggle' => 'dropdown'));?>
							<ul class="dropdown-menu">
								<li></li>
								<li><?=$this->Html->link('<i class="fa fa-times"></i> '.__('Delete'), array('controller' => 'groups', 'action' => 'delete', 'group' => $group['Group']['id']), array('escape' => false), __('Are yo sure?'));?></li>
							</ul>
						</div>-->
					</td>
				</tr>
			<? endforeach; ?>
		</table>
	</div>
</div>
