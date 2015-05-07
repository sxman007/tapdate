<div class="header">
    <h1 class="page-title">Likes List</h1>
</div>


<!-- Search start -->
<div class="search-well">
    <?php
    $options1 = array('' => '----select----');
    $options1 = $options1 + $options;
    echo $this->Form->create('User', array('type' => 'post', 'url' => array('controller' => 'likes', 'action' => 'index', 'admin' => TRUE)));
    echo $this->Form->input('search', array('type' => 'select', 'selected' => $selected, 'label' => FALSE, 'div' => FALSE, 'class' => '', 'id' => 'search', 'options' => $options1));
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
                <th>Images</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Dob</th>
                <th >Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($count) {
                //echo $user_id;
                foreach ($results as $loop => $result) {
                    if ($result['User']['image']) {
                        $path = "uploads/users/images/" . $result['User']['image'];
                    } else {
                        $path = "img/no_image.png";
                    }
                    ?>
                    <tr>
                        <td><?php echo $loop + 1; ?></td>
                        <td><img src="<?php echo $this->webroot; ?><?php echo $path; ?>" height="50" width="50"></td>
                        <td><?php echo $result['User']['first_name']; ?></td>
                        <td><?php echo $result['User']['last_name']; ?></td>
                        <td><?php echo $result['User']['email_id']; ?></td>
                        <td><?php echo date('d-M-Y', strtotime($result['User']['dob'])); ?></td>

                        <td>
                            <!--<a href="<?php echo $this->Html->url(array('action' => 'edit', 'admin' => TRUE, $result['User']['id'])); ?>" title="Edit"><i class="icon-pencil"></i></a>-->

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
                                    <!--<a href="<?php echo $this->Html->url(array('action' => 'change_status', 'admin' => TRUE, $result['User']['id'], $statusval)); ?>" title="Change Status to <?php echo $status; ?>"><i class="<?php echo $class; ?>"></i></a>-->

                            <a href="<?php echo $this->Html->url(array('action' => 'delete', 'admin' => TRUE, $user_id, $result['User']['id'])); ?>" onclick="if (!confirm('Are you sure want to delete this record permanently?'))
                                                return false;" title="Delete"><i class="icon-remove"></i></a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="7" style="text-align: center;">No records found</td>
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

