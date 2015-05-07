<div class="header">
    <h1 class="page-title">Services</h1>
</div>

<!-- Search start -->
<div class="search-well">
    <?php
    echo $this->Form->create('Service',array('type' => 'post','url' => array('controller' => 'services','action' => 'index','admin' => TRUE)));
        echo $this->Form->input('search', array('type' => 'text', 'label' => FALSE, 'div' => FALSE, 'class' => '', 'id' => 'search', 'placeholder' => 'Search by Name/Region/District'));
        echo '&nbsp;';
        $category_values = array(
            'boys_school' => 'Boys School Guide',
            'girls_school' => 'Girls School Guide',
            'pre_school' => 'Pre School',
            'institute' => 'Special Education Institute',
            'office' => 'Departments and Offices of Education'
        );
        echo $this->Form->input('category', array('type' => 'select', 'label' => FALSE, 'div' => FALSE, 'class' => '', 'id' => 'category', 'options' => $category_values, 'empty' => '--Sort by category--'));
    ?>
    <button class="btn" style="margin-bottom: 9px;"><i class="icon-search"></i> Go</button>
    <?php
    echo $this->Form->end();
    ?>
</div>
<!-- Search end -->

<!-- New user button start -->
<div class="btn-toolbar">
    <a href="<?php echo $this->Html->url(array('action' => 'add', 'admin' => TRUE)); ?>" class="btn btn-primary"><i class="icon-plus"></i> Add</a>
    <a href="<?php echo $this->Html->url(array('action' => 'import', 'admin' => TRUE)); ?>" class="btn btn-primary"><i class="icon-plus"></i> Import CSV</a>
</div>
<!-- New user button start -->


<!-- Listing start -->
<div class="well">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Category</th>
                <th style="width: 26px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($count) {
                foreach ($results as $loop => $result) {
                    ?>
                    <tr>
                        <td><?php echo $loop + 1; ?></td>
                        <td><?php echo $result['Service']['name']; ?></td>
                        <td>
                            <?php
                            if($result['Service']['category'] == 'boys_school'){
                                echo 'Boys School Guide';
                            }elseif($result['Service']['category'] == 'girls_school'){
                                echo 'Girls School Guide';
                            }elseif($result['Service']['category'] == 'pre_school'){
                                echo 'Pre School';
                            }elseif($result['Service']['category'] == 'institute'){
                                echo 'Special Education Institute';
                            }elseif($result['Service']['category'] == 'office'){
                                echo 'Departments and Offices of Education';
                            }
                            ?>
                        </td>
                        <td>
                            <a href="<?php echo $this->Html->url(array('action' => 'edit', 'admin' => TRUE, $result['Service']['id'])); ?>" title="Edit"><i class="icon-pencil"></i></a>

                            <?php
                            if ($result['Service']['status'] == 0) {
                                $class = 'icon-ban-circle';
                                $status = 'Active';
                                $statusval = 1;
                            } else {
                                $class = 'icon-ok-circle';
                                $status = 'Inactive';
                                $statusval = 0;
                            }
                            ?>
                            <a href="<?php echo $this->Html->url(array('action' => 'change_status', 'admin' => TRUE, $result['Service']['id'], $statusval)); ?>" title="Change Status to <?php echo $status; ?>"><i class="<?php echo $class; ?>"></i></a>

                            <a href="<?php echo $this->Html->url(array('action' => 'delete', 'admin' => TRUE, $result['Service']['id'], 2)); ?>" onclick="if (!confirm('Are you sure want to delete this record permanently?'))
                                        return false;" title="Delete"><i class="icon-remove"></i></a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="5" style="text-align: center;">No records found</td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<!-- Listing end -->

<?php if ($count > 0) { ?>
    <?php echo $this->element('admin/pagination'); ?>
<?php } ?>

