<? if (!empty($faqs)): ?>
	<br/>
	<br/>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="accordion" id="faq-accordion">
				<? foreach($faqs as $faq): ?>
					<div class="accordion-group">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#faq-accordion" href="#FAQ<?=$faq['FrequentlyAskedQuestion']['id'];?>">
						<div class="accordion-heading">
							<i class="fa fa-plus-square"></i><span class="accordion-question"><?=$faq['FrequentlyAskedQuestion']['question'];?></span>
						</div>
						</a>
						<div id="FAQ<?=$faq['FrequentlyAskedQuestion']['id'];?>" class="accordion-body collapse">
							<div class="accordion-inner">
								<br/>
								<p><?= (!empty($faq['FrequentlyAskedQuestion']['answer'])) ? $faq['FrequentlyAskedQuestion']['answer'] : __('This question will be answered shortly');?></p>
							</div>
						</div>
					</div>
				<? endforeach; ?>
			</div>
		</div>
	</div>
<? endif; ?>
<br />
<br />
<br />
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="well">
			<?=$this->Form->create('FrequentlyAskedQuestion', array('class' => 'form')); ?>
				<?=$this->Form->input('question', array('required' => 'required', 'class' => 'required'));?>
				<div class="text-center">
					<?=$this->Form->button(__('Submit Question'), array('type'=>'submit', 'class'=>'btn btn-lg btn-success'));?>
				</div>
			<? $this->Form->end(); ?>
		</div>
	</div>
</div>