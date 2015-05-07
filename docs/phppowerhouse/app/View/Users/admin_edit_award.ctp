<div class="header">
    <h1 class="page-title">Add Award</h1>
</div>

<?php echo $this->Form->create('Award', array('type' => 'file')); ?>
<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
<!-- Button panel start -->
<div class="btn-toolbar">
    <button class="btn btn-primary"><i class="icon-save"></i> Save</button>
</div>
<!-- Button panel end -->

<!-- Form panel start -->
<div class="well">
    <div class="tab-pane active in" id="home">
        
            <label>Title</label>
            <?php echo $this->Form->input('title',array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'title')); ?>
            
            <?php
            if($this->request->data['Award']['image'] != ''){
                echo '<p>' . $this->Html->image('/uploads/awards/thumb_80x80/' . $this->request->data['Award']['image'], array(
                    'alt' => $this->request->data['Award']['image']
                )) . '</p>';
            }
            ?>
            
            <label>Image</label>
            <?php echo $this->Form->input('image',array('label' => FALSE, 'div' => FALSE, 'type' => 'file', 'class' => 'input-xlarge', 'id' => 'image')); ?>
            
            <label>Short Description</label>
            <?php echo $this->Form->input('short_description',array('label' => FALSE, 'div' => FALSE, 'type' => 'textarea', 'class' => 'input-xlarge', 'id' => 'short_description')); ?>
            
            <label>Status</label>
            <?php $status_options = array('1' => 'Active', '0' => 'Inactive'); ?>
            <?php echo $this->Form->input('status', array('type' => 'select', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge', 'id' => 'status', 'options' => $status_options)); ?>
            
   </div>

</div>
<!-- Form panel end -->
<?php echo $this->Form->end(); ?>

