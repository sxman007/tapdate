<div class="header">
    <h1 class="page-title">Add Avatar</h1>
</div>

<?php echo $this->Form->create('Avatar', array('type' => 'file')); ?>
<!-- Button panel start -->
<div class="btn-toolbar">
    <button class="btn btn-primary"><i class="icon-save"></i> Save</button>
</div>
<!-- Button panel end -->

<!-- Form panel start -->
<div class="well">
    <div class="tab-pane active in" id="home">
        
            <label>Image</label>
            <?php echo $this->Form->input('image',array('label' => FALSE, 'div' => FALSE, 'type' => 'file', 'class' => 'input-xlarge', 'id' => 'image')); ?>
            
            <label>Status</label>
            <?php $status_options = array('1' => 'Active', '0' => 'Inactive'); ?>
            <?php echo $this->Form->input('status', array('type' => 'select', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge', 'id' => 'status', 'options' => $status_options)); ?>
            
   </div>

</div>
<!-- Form panel end -->
<?php echo $this->Form->end(); ?>

