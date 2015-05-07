<div class="sidebar-nav">
    <!-- Dashboard -- start -->
    <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'dashboard', 'admin' => TRUE)); ?>" class="nav-header"><i class="icon-dashboard"></i>Dashboard <i class="icon-chevron-right" style="float:right;"></i></a>
    <!-- Dashboard -- end -->

   
    
    
    <!-- User Management -- start -->
    <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'index', 'admin' => TRUE)); ?>" class="nav-header"><i class="icon-list"></i>Users Management <i class="icon-chevron-right" style="float:right;"></i></a>
    <!-- User Management -- end -->
    
     <!-- friends request Management -- start -->
    <a href="<?php echo $this->Html->url(array('controller' => 'friends', 'action' => 'index', 'admin' => TRUE)); ?>" class="nav-header"><i class="icon-list"></i>Friends  Management <i class="icon-chevron-right" style="float:right;"></i></a>
    <!-- Services Management -- end -->
 <!-- friends list Management -- start -->
    <a href="<?php echo $this->Html->url(array('controller' => 'friends', 'action' => 'friends_list', 'admin' => TRUE)); ?>" class="nav-header"><i class="icon-list"></i>Friends List Management <i class="icon-chevron-right" style="float:right;"></i></a>
    <!-- Services Management -- end -->
    <!-- likes Management -- start -->
    <a href="<?php echo $this->Html->url(array('controller' => 'likes', 'action' => 'index', 'admin' => TRUE)); ?>" class="nav-header"><i class="icon-list"></i>Likes Management <i class="icon-chevron-right" style="float:right;"></i></a>
    <!-- Services Management -- end -->
<!-- likes Management -- start -->
    <a href="<?php echo $this->Html->url(array('controller' => 'friends', 'action' => 'block_list', 'admin' => TRUE)); ?>" class="nav-header"><i class="icon-list"></i>Block Management <i class="icon-chevron-right" style="float:right;"></i></a>
    <!-- Services Management -- end -->
</div>
