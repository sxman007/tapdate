<div class="header">
    <h1 class="page-title">Users</h1>
</div>


<!-- Search start -->
<div class="search-well">
    <?php
    echo $this->Form->create('User',array('type' => 'post','url' => array('controller' => 'users','action' => 'index','admin' => TRUE)));
        echo $this->Form->input('search', array('type' => 'text', 'label' => FALSE, 'div' => FALSE, 'class' => '', 'id' => 'search', 'placeholder' => '--Search by Name/Email--'));
    ?>
    <button class="btn" style="margin-bottom: 9px;"><i class="icon-search"></i> Go</button>
   <?php
   echo $this->Form->end();
   ?>
</div>
<!-- Search end -->


<!-- New user button start -->
<div class="btn-toolbar">
    <a href="<?php echo $this->Html->url(array('action' => 'add', 'admin' => TRUE, 'user')); ?>" class="btn btn-primary"><i class="icon-plus"></i> Add</a>
</div>
<!-- New user button start -->


<!-- Listing start -->
<div class="well">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
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
                        <td><?php echo $result['User']['name']; ?></td>
                        <td><?php echo $result['User']['email']; ?></td>
                        <td>
                            <a href="<?php echo $this->Html->url(array('action' => 'edit', 'admin' => TRUE, $result['User']['id'])); ?>" title="Edit"><i class="icon-pencil"></i></a>

                            <?php
                            if ($result['User']['status'] == 0) {
                                $class = 'icon-ban-circle';
                                $status = 'Active';
                                $statusval = 1;
                            } else {
                                $class = 'icon-ok-circle';
                                $status = 'Inactive';
                                $statusval = 0;
                            }
                            ?>
                            <a href="<?php echo $this->Html->url(array('action' => 'change_status', 'admin' => TRUE, $result['User']['id'], $statusval)); ?>" title="Change Status to <?php echo $status; ?>"><i class="<?php echo $class; ?>"></i></a>

                            <a href="<?php echo $this->Html->url(array('action' => 'delete', 'admin' => TRUE, $result['User']['id'])); ?>" onclick="if (!confirm('Are you sure want to delete this record permanently?')) return false;" title="Delete"><i class="icon-remove"></i></a>
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

