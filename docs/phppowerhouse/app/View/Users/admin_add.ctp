<div class="header">
    <h1 class="page-title">Add User</h1>
</div>

<?php echo $this->Form->create('User'); ?>
<!-- Button panel start -->
<div class="btn-toolbar">
    <button class="btn btn-primary"><i class="icon-save"></i> Save</button>
</div>
<!-- Button panel end -->

<!-- Form panel start -->
<div class="well">
    <div class="tab-pane active in" id="home">
        
        <label>Email</label>
        <?php echo $this->Form->input('email', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'email')); ?>

        <label>Name</label>
        <?php echo $this->Form->input('name', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'name')); ?>

    </div>

</div>
<!-- Form panel end -->
<?php echo $this->Form->end(); ?>

