<div class="row">
	<div class="col-sm-6 col-sm-offset-3">
		<div class="well well-dark">
			<div class="lead"><?=__('Login');?></div>
			<?=$this->Form->create('User', array('url' => array('action' => 'login'), 'class' => 'form-login'));?>
				<?=$this->Form->input('email', array('between' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>', 'after' => '</div>'));?>
				<?=$this->Form->input('password', array('between' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-asterisk"></i></span>', 'after' => '</div>'));?>
				<?=$this->Form->button(__('Login'), array('type' => 'submit', 'class' => 'btn btn-success'));?>
			<?=$this->Form->end();?>
		</div>
	</div>
</div>