<div class="col-sm-12">
	<h1><?=__('Register');?></h1>
	<div class="well">
		<?=$this->Form->create('User', array('url' => array('action' => 'register'), 'class' => 'form'));?>
			<div class="col-sm-6">
				<?=$this->Form->input('firstname', array('required' => 'required', 'between' => '<div class="input-group"><span class="input-group-addon"><i class="icon-user"></i></span>', 'after' => '</div>'));?>
				<?=$this->Form->input('lastname', array('required' => 'required', 'between' => '<div class="input-group"><span class="input-group-addon"><i class="icon-user"></i></span>', 'after' => '</div>'));?>
				<?=$this->Form->input('date_of_birth', array('type' => 'text', 'between' => '<div class="input-group"><span class="input-group-addon"><i class="icon-user"></i></span>', 'after' => '</div>'));?>
				<?=$this->Form->button(__('Register'), array('type' => 'submit', 'class' => 'btn btn-success'));?>
			</div>
			<div class="col-sm-6">
				<?=$this->Form->input('email', array('required' => 'required', 'between' => '<div class="input-group"><span class="input-group-addon"><strong>@</strong></span>', 'after' => '</div>'));?>
				<?=$this->Form->input('password', array('required' => 'required', 'between' => '<div class="input-group"><span class="input-group-addon"><i class="icon-asterisk"></i></span>', 'after' => '</div>'));?>
				<?=$this->Form->input('confirm_password', array('required' => 'required', 'type' => 'password', 'between' => '<div class="input-group"><span class="input-group-addon"><i class="icon-asterisk"></i></span>', 'after' => '</div>'));?>
			</div>
		<?=$this->Form->end();?>
		<div class="clear"></div>
	</div>
</div>