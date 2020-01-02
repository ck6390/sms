<?php if(!empty($notice)){ ?>
<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo $this->lang->line('notice'); ?> <?php echo $this->lang->line('title'); ?></th>
            <td><?php echo $notice->title; ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('date'); ?> </th>
            <td><?php echo date($this->config->item('date_format'), strtotime($notice->date)); ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('notice_for'); ?></th>
            <td><?php echo $notice->name  ? $notice->name : $this->lang->line('all'); ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('notice'); ?></th>
            <td><?php echo $notice->notice; ?></td>
        </tr>        
    </tbody>
</table>
<?php } ?>
