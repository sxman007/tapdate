<div class="header">
    <h1 class="page-title">Import CSV</h1>
</div>

<?php echo $this->Form->create('Service',array('type' => 'file')); ?>
<!-- Button panel start -->
<div class="btn-toolbar">
    <button class="btn btn-primary"><i class="icon-save"></i> Save</button>
</div>
<!-- Button panel end -->

<!-- Form panel start -->
<div class="well">
    <div class="tab-pane active in" id="home">

        <label>Upload CSV</label>
        <?php
        echo $this->Form->input('csv', array('type' => 'file', 'label' => FALSE, 'div' => FALSE, 'class' => '', 'id' => 'csv'));
        ?>

    </div>

</div>
<!-- Form panel end -->
<?php echo $this->Form->end(); ?>
