<h3>
	<?=@$title_for_layout;?>
	<div class="btn-group pull-right">
		<?=$this->Html->link(__('New Top Level Page'), array('controller' => 'pages', 'action' => 'add'), array('class' => 'btn btn-primary btn-sm'));?>
	</div>
</h3>
<div class="row">
	<div class="col-xs-12">
		<? if (!empty($pages)): ?>
			<table class="table table-hover table-striped table-bordered">
				<tr>
					<th><?=__('Title');?></th>
					<th><?=__('Url');?></th>
					<th><?=__('Publish');?></th>
					<th><?=__('Last Modified');?></th>
					<th>&nbsp;</th>
				</tr>
				<? foreach ($pages as $page): ?>
					<tr>
						<td><?=$page['Page']['title']?></td>
						<td><?=$page['Page']['url']?></td>
						<td><?=($page['Page']['publish']) ? __('Yes') : __('No');?></td>
						<td><?=$this->Time->nice($page['Page']['modified'])?></td>
						<td>
							<div class="btn-group">
								<?=$this->Html->link(__('Actions').' <span class="caret"></span>', array('controller' => 'pages', 'action' => 'edit', 'page' => $page['Page']['id']), array('escape' => false, 'class' => 'btn btn-success btn-sm dropdown-toggle', 'data-toggle' => 'dropdown'));?>
								<ul class="dropdown-menu">
									<li><?=$this->Html->link('<i class="fa fa-pencil"></i> '.__('Edit'), array('controller' => 'pages', 'action' => 'edit', 'page' => $page['Page']['id']), array('escape' => false));?></li>
									<li><?=$this->Html->link('<i class="fa fa-times"></i> '.__('Delete'), array('controller' => 'pages', 'action' => 'delete', 'page' => $page['Page']['id']), array('escape' => false), __('Are yo sure?'));?></li>
								</ul>
							</div>
						</td>
					</tr>
				<? endforeach; ?>
			</table>
		<? endif; ?>
	</div>
</div>
