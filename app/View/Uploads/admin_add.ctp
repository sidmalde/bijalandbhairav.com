<h2>
	<?=__('Upload file');?>
	<?=$this->Html->link('<i class="icon-long-arrow-left"></i>', array('action' => 'index'), array('class' => 'btn btn-square btn-inverse btn-small pull-right', 'title' => __('Return to uploads'), 'escape' => false))?>
</h2>
<div class="outer5">
	<?=$this->Form->create('Upload', array('type' => 'file', 'class' => 'form'));?>
    <?=$this->Form->input('filename', array('type' => 'file'));?>
    <?=$this->Form->input('label', array('placeholder' => 'Optional and internal use only', 'required' => true));?>
    <?=$this->Form->input('description', array('placeholder' => 'Optional and internal use only'));?>
    <div class="control-group btn-group btn-group-block" data-toggle="buttons-checkbox">
        <?=$this->Form->hidden('product_datasheet')?>
        <button type="button" class="btn"><?=ucwords(str_replace("_"," ",'product_datasheet'))?></button>
    </div>
    <button type="submit" class="btn btn-success btn-small" data-loading-text="<?=__('Uploading')?>"><?=__('Upload')?></button>
  <?php echo $this->Form->end();?>
</div>