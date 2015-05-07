<div class="header">
    <h1 class="page-title">Edit <?php echo $type; ?></h1>
</div>

<?php echo $this->Form->create('User'); ?>
<?php echo $this->Form->input('id',array('type' => 'hidden')); ?>
<!-- Button panel start -->
<div class="btn-toolbar">
    <button class="btn btn-primary"><i class="icon-save"></i> Save</button>
</div>
<!-- Button panel end -->

<!-- Form panel start -->
<div class="well">
    <div class="tab-pane active in" id="home">
        
        <label>Email</label>
        <?php echo $this->Form->input('email', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'email', 'disabled' => TRUE)); ?>

        <label>Name</label>
        <?php echo $this->Form->input('name', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'name')); ?>

        
        <label>Status</label>
        <?php $status_options = array('1' => 'Active', '0' => 'Inactive'); ?>
        <?php echo $this->Form->input('status', array('type' => 'select', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge', 'id' => 'status', 'options' => $status_options)); ?>

    </div>

</div>
<!-- Form panel end -->
<?php echo $this->Form->end(); ?>

