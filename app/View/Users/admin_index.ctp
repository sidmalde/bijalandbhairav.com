<h3>
	<?=@$title_for_layout;?>
	<div class="btn-group pull-right">
		<?=$this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add'), array('class' => 'btn btn-primary btn-sm'));?>
		<?=$this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add'), array('class' => 'btn btn-primary btn-sm'));?>
	</div>
</h3>

<div class="row">
	<div class="col-xs-12">
		<ul class="nav nav-tabs" id="myTab">
			<?php foreach ($groups as $index => $group): ?>
				<? $activeLinkClass=($index == 0) ? 'class="active"': '';?>
				<li <?=$activeLinkClass;?>>
					<a href="<?='#'.Sanitize::paranoid(strtolower($group['Group']['name']));?>" data-toggle="tab">
						<span class="badge badge-info">(<?=count($group['User']);?>)</span>
						<?=$group['Group']['name'];?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>

	 
		<div id="myTabContent" class="tab-content">
			<?php foreach ($groups as $index => $group): ?>
				<? $tabClass=($index == 0) ? 'active in': 'fade'; ?>
				<div class="tab-pane <?=$tabClass;?>" id="<?=Sanitize::paranoid(strtolower($group['Group']['name']));?>">
					<div class="row">
						<div class="col-xs-12">
							<? if (!empty($group['User'])): ?>
								<table class="table table-condensed table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th><?=__('Email'); ?></th>
											<th><?=__('Name'); ?></th>
											<th><?=__('Mobile'); ?></th>
											<th><?=__('Active'); ?></th>
											<th><?=__('Deleted'); ?></th>
											<th>
												&nbsp;
											</th>
										</tr>
									</thead>
									<tbody>
										<? foreach ($group['User'] as $user): ?>
											<tr>
												<td><?=$user['email']; ?>&nbsp;</td>
												<td><?=$user['fullname']; ?>&nbsp;</td>
												<td><?=$user['mobile']; ?>&nbsp;</td>
												<td><?=($user['active']) ? __('Yes') : __('No'); ?>&nbsp;</td>
												<td><?=($user['deleted']) ? __('Yes') : __('No'); ?>&nbsp;</td>
												<td class="actions">
													<div class="btn-group">
														<?=$this->Html->link(__('Actions').'<span class="caret"></span>', '#', array('escape' => false, 'class' => 'btn btn-info btn-sm dropdown-toggle', 'data-toggle' => 'dropdown'));?>
														<ul class="dropdown-menu">
															<? if (empty($user['active'])): ?>
																<li><?=$this->Html->link(__('Activate'), array('controller' => 'users', 'action' => 'activate', 'user' => $user['id']));?></li>
															<? endif; ?>
															<li><?=$this->Html->link('<i class="fa fa-eye"></i> '.__('View'), array('controller' => 'users', 'action' => 'view', 'user' => $user['id'], 'admin' => true), array('escape' => false));?></li>
															<li><?=$this->Html->link('<i class="fa fa-times"></i> '.__('Delete'), array('controller' => 'users', 'action' => 'delete', 'user' => $user['id'], 'admin' => true), array('escape' => false));?></li>
														</ul>
													</div>
												</td>
											</tr>
										<? endforeach; ?>
									</tbody>
								</table>
							<? else: ?>
								<div class="alert alert-info">
									<p class="text-center lead"><strong><?=__('There are currently no users in this group.');?></strong></p>
								</div>
							<? endif; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
