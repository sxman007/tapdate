<?php
echo $this->Form->create('User',array('type' => 'file'));
if(!empty($list)) {
    
echo $this->Form->input('friend', array('type' => 'select', 'label' => FALSE, 'div' => FALSE, 'class' => '','required'=>'true', 'id' => 'friend','options' => $list,'empty'=>'---select---' )); 
} else {
   echo $this->Form->input('friend', array('type' => 'select', 'label' => FALSE, 'div' => FALSE, 'class' => '','required'=>'true', 'id' => 'friend','empty'=>'---select---' ));  
}
echo $this->Form->end();
?>