<?php if(!empty($news)) { ?>
<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo $this->lang->line('news'); ?> <?php echo $this->lang->line('title'); ?></th>
            <td><?php echo $news->title; ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('date'); ?> </th>
            <td><?php echo date($this->config->item('date_format'), strtotime($news->date)); ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('image'); ?></th>
            <td>
                <?php if($news->image){ ?>
                <img src="<?php echo UPLOAD_PATH; ?>/news/<?php echo $news->image; ?>" alt="" /><br/><br/>
                <?php } ?>
            </td>
        </tr>        
        <tr>
            <th><?php echo $this->lang->line('news'); ?></th>
            <td><?php echo $news->news; ?></td>
        </tr>               
    </tbody>
</table>
<?php } ?>
