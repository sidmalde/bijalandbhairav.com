<? if(!empty($rawPass)): ?>
    <div class="aleryt alert-info">
        <h3>Your password is: <?=$rawPass;?></h3>
    </div>
<? endif; ?>

<? if(!empty($currentUser)): ?>
    <?=$this->element('Uploads/uploader-widget');?>
    <?=$this->element('Uploads/upload-template');?>
    <?=$this->element('Uploads/download-template');?>
<? else: ?>
    <div class="row">
        <div class="col-sm-5">
            <div class="well">
                <h2 class="text-center">Login</h2>
                <?=$this->Form->create('User', array('url' => array('action' => 'login'), 'class' => 'form-login'));?>
                    <?=$this->Form->input('email', array('between' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>', 'after' => '</div>'));?>
                    <?=$this->Form->input('password', array('between' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-asterisk"></i></span>', 'after' => '</div>'));?>
                    <?=$this->Form->button(__('Login'), array('type' => 'submit', 'class' => 'btn btn-success'));?>
                <?=$this->Form->end();?>
            </div>
        </div>
        <div class="col-sm-6 col-sm-offset-1">
            <div class="well">
                <h2 class="text-center">Sign Up</h2>
                <?=$this->Form->create('User', array('url' => array('action' => 'register'), 'class' => 'form-login'));?>
                    <div class="row">
                        <div class="col-sm-6">
                            <?=$this->Form->input('firstname');?>
                        </div>
                        <div class="col-sm-6">
                            <?=$this->Form->input('lastname');?>
                        </div>
                    </div>
                    <?=$this->Form->input('email');?>
                    <?=$this->Form->button(__('Sign Up'), array('type' => 'submit', 'class' => 'btn btn-success'));?>
                <?=$this->Form->end();?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h6 class="text-center">Please sign up and login to upload your media.<br>Don't worry, your information will NOT leave this site, this is just so we know who has uploaded what.<br/>Thank You.</h6>
        </div>
    </div>
<? endif; ?>





    <!-- The blueimp Gallery widget -->
<?/*<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>*/?>


