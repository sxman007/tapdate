<div class="header">
    <h1 class="page-title">Avatars</h1>
</div>


<!-- New user button start -->
<div class="btn-toolbar">
    <a href="<?php echo $this->Html->url(array('action' => 'add_avatar', 'admin' => TRUE)); ?>" class="btn btn-primary"><i class="icon-plus"></i> Add</a>
</div>
<!-- New user button start -->


<!-- Listing start -->
<div class="well">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
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
                        <td>
                            <?php 
                            if($result['Avatar']['image']){
                                echo $this->Html->image('/uploads/avatars/thumb_80x80/' . $result['Avatar']['image'], array('alt' => '')); 
                            }  else {
                                echo 'No Image';
                            }
                            ?>
                        </td>
                        <td>
                            <a href="<?php echo $this->Html->url(array('action' => 'edit_avatar', 'admin' => TRUE, $result['Avatar']['id'])); ?>" title="Edit"><i class="icon-pencil"></i></a>

                            <?php
                            if ($result['Avatar']['status'] == 0) {
                                $class = 'icon-ban-circle';
                                $status = 'Active';
                                $statusval = 1;
                            } else {
                                $class = 'icon-ok-circle';
                                $status = 'Inactive';
                                $statusval = 0;
                            }
                            ?>
                            <a href="<?php echo $this->Html->url(array('action' => 'change_status', 'admin' => TRUE, 'Avatar', $result['Avatar']['id'], $statusval)); ?>" title="Change Status to <?php echo $status; ?>"><i class="<?php echo $class; ?>"></i></a>

                            <a href="<?php echo $this->Html->url(array('action' => 'change_status', 'admin' => TRUE, 'Avatar', $result['Avatar']['id'], 2)); ?>" onclick="if (!confirm('Are you sure want to delete this record permanently?')) return false;" title="Delete"><i class="icon-remove"></i></a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="4" style="text-align: center;">No records found</td>
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

