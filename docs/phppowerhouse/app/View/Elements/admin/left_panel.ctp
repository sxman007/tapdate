<div class="sidebar-nav">
    <!-- Dashboard -- start -->
    <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'dashboard', 'admin' => TRUE)); ?>" class="nav-header"><i class="icon-dashboard"></i>Dashboard <i class="icon-chevron-right" style="float:right;"></i></a>
    <!-- Dashboard -- end -->

    <!-- Services Management -- start -->
    <a href="<?php echo $this->Html->url(array('controller' => 'services', 'action' => 'index', 'admin' => TRUE)); ?>" class="nav-header"><i class="icon-list"></i>Services Management <i class="icon-chevron-right" style="float:right;"></i></a>
    <!-- Services Management -- end -->
    
    
    <!-- User Management -- start -->
    <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'index', 'admin' => TRUE)); ?>" class="nav-header"><i class="icon-list"></i>Users Management <i class="icon-chevron-right" style="float:right;"></i></a>
    <!-- User Management -- end -->
</div>
