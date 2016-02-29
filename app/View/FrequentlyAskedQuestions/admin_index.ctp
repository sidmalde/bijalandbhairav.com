<h2>
	<?=$title_for_layout;?>
	<?=$this->Html->link('Add Question', array('action' => 'add'), array('class' => 'btn btn-primary pull-right'));?>
</h2>

<div class="v-outer20">
	<? if(!empty($faqs)): ?>
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>Question</th>
					<th>Visible</th>
					<th>Date Asked</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<? foreach($faqs as $faq): ?>
					<tr>
						<td><?=$faq['FrequentlyAskedQuestion']['question'];?></td>
						<td><?=(!empty($faq['FrequentlyAskedQuestion']['display'])) ? 'Yes' : 'No';?></td>
						<td><?=date('d-M-Y h:i', strtotime($faq['FrequentlyAskedQuestion']['created']));?></td>
						<td>
							<?=$this->Html->link('<i class="fa fa-pencil"></i>', array('action' => 'edit', 'faq' => $faq['FrequentlyAskedQuestion']['id']), array('class' => 'btn btn-square btn-warning', 'escape' => false));?>
							<?=$this->Html->link('<i class="fa fa-trash"></i>', array('action' => 'delete', 'faq' => $faq['FrequentlyAskedQuestion']['id']), array('class' => 'btn btn-square btn-danger', 'escape' => false));?>
						</td>
					</tr>
				<? endforeach; ?>
			</tbody>
		</table>
	<? else: ?>
		<div class="alert alert-info">
			<h3 class="text-center">No questions have been asked yet, please add a question</h3>
			<div Class="text-center"><?=$this->Html->link('Add Question', array('action' => 'add'), array('class' => 'btn btn-primary'));?></div>
			<div class="clear"></div>
		</div>
	<? endif; ?>
</div>