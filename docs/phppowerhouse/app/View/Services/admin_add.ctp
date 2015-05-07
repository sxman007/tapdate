<div class="header">
    <h1 class="page-title">Add Service</h1>
</div>

<?php echo $this->Form->create('Service'); ?>
<!-- Button panel start -->
<div class="btn-toolbar">
    <button class="btn btn-primary"><i class="icon-save"></i> Save</button>
</div>
<!-- Button panel end -->

<!-- Form panel start -->
<div class="well">
    <div class="tab-pane active in" id="home">

        <label>Category</label>
        <?php
        $category_values = array(
            'boys_school' => 'Boys School Guide',
            'girls_school' => 'Girls School Guide',
            'pre_school' => 'Pre School',
            'institute' => 'Special Education Institute',
            'office' => 'Departments and Offices of Education'
        );
        echo $this->Form->input('category', array('type' => 'select', 'label' => FALSE, 'div' => FALSE, 'class' => '', 'id' => 'category', 'options' => $category_values, 'empty' => '--Select--', 'onchange' => 'hideFields(this.value);'));
        ?>

        <label>Name</label>
        <?php echo $this->Form->input('name', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'name')); ?>

        <label>Phone</label>
        <?php echo $this->Form->input('phone', array('type' => 'text', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge', 'id' => 'phone')); ?>

        <label>Email</label>
        <?php echo $this->Form->input('email', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'email')); ?>

        <label>Website</label>
        <?php echo $this->Form->input('website', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'website')); ?>
        <label>GPS Location (Latitude)</label>
        <?php echo $this->Form->input('latitude', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'latitude')); ?>
        
        <label>GPS Location (Longitude)</label>
        <?php echo $this->Form->input('longitude', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'longitude')); ?>
        
        <div class="hide1">
            <label>Year</label>
            <?php echo $this->Form->input('year', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => '', 'id' => 'year')); ?>
        </div>
        
        <div class="hide1">
            <label>Type of Building</label>
            <?php echo $this->Form->input('type_of_building', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'type_of_building')); ?>
        </div>
        
        <div class="hide1">
            <label>No Special Education Classrooms</label>
            <?php echo $this->Form->input('no_special_education_classrooms', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'no_special_education_classrooms')); ?>
        </div>
        
        <div class="hide1">
            <label>Stage</label>
            <?php echo $this->Form->input('stage', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'stage')); ?>
        </div>
        
        <label>Region</label>
        <?php echo $this->Form->input('region', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'region')); ?>
        
        <label>District</label>
        <?php echo $this->Form->input('district', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'district')); ?>
        
        <div class="hide2">
            <label>Name of Manager</label>
            <?php echo $this->Form->input('manager', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'manager')); ?>
        </div>
        
        <div class="hide2">
            <label>Social Network</label>
            <?php echo $this->Form->input('social_network', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'social_network')); ?>
        </div>

        <label>Status</label>
        <?php $status_options = array('1' => 'Active', '0' => 'Inactive'); ?>
        <?php echo $this->Form->input('status', array('type' => 'select', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge', 'id' => 'status', 'options' => $status_options)); ?>

    </div>

</div>
<!-- Form panel end -->
<?php echo $this->Form->end(); ?>

<script type="text/javascript">
function hideFields(val){
    if(val === 'office'){
        $('.hide1').hide();
        $('.hide2').show();
    }else{
        $('.hide1').show();
        $('.hide2').hide();
    }
}
</script>

