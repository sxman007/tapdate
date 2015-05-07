
<script>
    function show_friends(id) {
        //alert(id);
        $.ajax({
				url: '<?php echo ROOT_URL; ?>admin/friends/friends_ajax',
				type: 'post',
				data: 'id='+id,
                                dataType: 'html',
				success: function(data) {
				 
				    //console.log(data);
				    if (data) {
                                        //alert(data);
                 
				       $('#friends_list').html(data);
				        //window.location.reload();
				    }
				}
			    });
    }
</script>

<div class="header">
    <h1 class="page-title">Add Friend</h1>
</div>

<?php echo $this->Form->create('User',array('type' => 'file')); ?>
<!-- Button panel start -->
<div class="btn-toolbar">
    <button class="btn btn-primary"><i class="icon-save"></i> Save</button>
</div>
<!-- Button panel end -->

<!-- Form panel start -->
<div class="well">
    <div class="tab-pane active in" id="home">
        <?php 
        //$users1=array(''=>'----select----');
        //$users1=$users1+$users;
        //$friends1=array(''=>'----select----');
        //$friends1=$friends1+$friends;
        ?>
        <label>Users *</label>
        <?php echo $this->Form->input('user', array('type' => 'select','empty'=>'--- select---', 'label' => FALSE, 'div' => FALSE, 'class' => '','required'=>'true', 'id' => 'user','options' => $users,'onchange' => 'show_friends(this.value)' )); ?>
        <?php //echo $this->Form->input('user', array('type' => 'select', 'label' => FALSE, 'div' => FALSE, 'class' => '','required'=>'true', 'id' => 'user','options' => $users1)); ?>
        <label>Friends *</label>
        <div id="friends_list">
       <?php echo $this->Form->input('friend', array('type' => 'select','empty'=>'--- select---' ,'label' => FALSE, 'div' => FALSE, 'class' => '','required'=>'true', 'id' => 'friend' )); ?>
        </div>
     
    </div>

</div>
<!-- Form panel end -->
<?php echo $this->Form->end(); ?>

