<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo $this->lang->line('gallery'); ?> <?php echo $this->lang->line('title'); ?></th>
            <td><?php echo $gallery->title; ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('is_view_on_web'); ?></th>
            <td><?php echo $gallery->is_view_on_web ? $this->lang->line('yes') : $this->lang->line('no'); ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('cover_image'); ?></th>
            <td>
                <?php if($gallery->image){ ?>
                    <img src="<?php echo UPLOAD_PATH; ?>/gallery/<?php echo $gallery->image; ?>" alt=""  class="img-responsive" /><br/><br/>
                <?php } ?>
            </td>
        </tr>       
        <tr>
            <th><?php echo $this->lang->line('note'); ?></th>
            <td><?php echo $gallery->note; ?></td>
        </tr>       
        <tr>
            <th><?php echo $this->lang->line('created'); ?></th>
            <td><?php echo date($this->gsms_setting->sms_date_format, strtotime($gallery->created_at)); ?></td>
        </tr>       
    </tbody>
</table>
