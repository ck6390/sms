<script>
    $(document).ready(function(){
        $("#btnPrint").click(function () {
            var divContents = $("#dvContainer").html();
            var printWindow = window.open('', '', 'height=8.5in;width=8.5in;');
            printWindow.document.write('<html><head><title></title><style media="print">.hiddens{display:none !important}.table-bordered{border-width: 1px;border-style: solid;border-color: rgb(221, 221, 221);border-image:initial;}.table{width: 100%;max-width: 100%;margin-bottom: 20px;}.table > thead:first-child > tr:first-child > th {border-top: 0px;}.table-bordered > thead > tr > th {border-width: 1px;border-style: solid;border-color: rgb(221, 221, 221);border-image: initial;line-height: 1.42857;vertical-align: top;padding: 8px;}.table-bordered > tbody > tr > td{border-width: 1px;border-style: solid;border-color: rgb(221, 221, 221);border-image:initial;line-height: 1.42857;vertical-align: top;padding: 8px;}.center{text-align:center}.col-40{width:40%;float:left;}.col-10{width:5%;float:left;padding-left:35%}.col-30{width:25%;float:left;line-height:28px}.clearfix{clear:both;}@page{margin:10;padding:0px;}.col-80{width:80%;float:left;}.right-text{text-align:right;}.col-33{width:33.33%;float:left;}.left-text{text-align:left;}.col-60{width:60%;float:left;}.border-top{border-top:.5px solid #ccc;}.col-15{width:10%;float:left;}.margin-left-20{margin-left:30%;}</style>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    });
</script>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-bar-chart"></i><small> <?php echo $this->lang->line('expenditure'); ?> <?php echo $this->lang->line('report'); ?></small></h3>                
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            
            <?php $this->load->view('quick_report'); ?>   
            
             <div class="x_content filter-box no-print"> 
                <?php echo form_open_multipart(site_url('report/expenditure'), array('name' => 'expenditure', 'id' => 'expenditure', 'class' => 'form-horizontal form-label-left'), ''); ?>
                <div class="row">                    
                    <div class="col-md-10 col-sm-10 col-xs-12">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <?php echo $this->lang->line('academic_year'); ?>
                            <select  class="form-control col-md-7 col-xs-12" name="academic_year_id" id="academic_year_id">
                                <option value=""><?php echo $this->lang->line('all'); ?></option>
                                <?php foreach ($academic_years as $obj) { ?>
                                <option value="<?php echo $obj->id; ?>" <?php if(isset($academic_year_id) && $academic_year_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->session_year; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <?php echo $this->lang->line('group_by_data'); ?> <span class="required">*</span>
                            <select  class="form-control col-md-7 col-xs-12" name="group_by" id="group_by" required="required">
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                <?php $groups = get_group_by_type(); ?>
                                <?php foreach ($groups as $key=>$value) { ?>
                                <option value="<?php echo $key; ?>" <?php if(isset($group_by) && $group_by == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                <?php } ?>
                                <option value="expenditure_head" <?php if(isset($group_by) && $group_by == 'expenditure_head'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('expenditure_head'); ?></option>
                                <option value="expenditure_by" <?php if(isset($group_by) && $group_by == 'expenditure_by'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('expenditure'); ?> <?php echo $this->lang->line('method'); ?></option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <?php echo $this->lang->line('start_date'); ?>
                            <input  class="form-control col-md-7 col-xs-12"  name="date_from"  id="date_from" value="<?php echo isset($date_from) && $date_from != '' ?  date('d-m-Y', strtotime($date_from)) : ''; ?>" placeholder="<?php echo $this->lang->line('start_date'); ?>" type="text" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <?php echo $this->lang->line('end_date'); ?>
                            <input  class="form-control col-md-7 col-xs-12"  name="date_to"  id="date_to" value="<?php echo isset($date_to) && $date_to != '' ?  date('d-m-Y', strtotime($date_to)) : ''; ?>" placeholder="<?php echo $this->lang->line('end_date'); ?>" type="text" autocomplete="off">
                        </div>
                    </div>
                    </div>
                
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group"><br/>
                            <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('find'); ?></button>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>

            <div class="x_content" id="dvContainer">
                <div class="" data-example-id="togglable-tabs">
                    
                  <div class="x_content">             
                       <div class="row">
                           <div class="col-sm-4  col-sm-offset-4 layout-box">
                               <p>
                            <div class="center">
                                <div class="col-xs-4 col-15 margin-left-20">
                                <?php if($this->session->userdata('school_logo')){?>               
                                    <img class="img-thumbnail img-circle logo" src="<?php echo $this->config->item('upload_url'); ?><?php echo 'assets/logo/'.$this->session->userdata('school_logo'); ?>" alt="" width="80" />
                                    
                                <?php } else{ ?>
                                   <img src="<?php echo IMG_URL; ?>na.png" class="img-thumbnail img-circle logo" width="80px">
                                <?php } ?>                                
                                </div>                            
                                <div class="col-xs-8 col-30 center">
                                    <h4><?php echo $this->gsms_setting->school_name; ?></h4>
                                    <p><?php echo $this->gsms_setting->address; ?></p>
                                </div>
                            </div>
                            <div class="clearfix"></div><br/>
                                   <h3 class="head-title ptint-title"><i class="fa fa-bar-chart"></i><small> <?php echo $this->lang->line('expenditure'); ?> <?php echo $this->lang->line('report'); ?></small></h3>                
                               </p>
                           </div>
                       </div>            
                   </div>
                    
                    <ul  class="nav nav-tabs bordered no-print hiddens">
                        <li class=""><a href="#tab_tabular"   role="tab" data-toggle="tab"   aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('tabular'); ?> <?php echo $this->lang->line('report'); ?></a> </li>
                        <li  class="active"><a href="#tab_graphical"   role="tab" data-toggle="tab"  aria-expanded="false"><i class="fa fa-line-chart"></i> <?php echo $this->lang->line('graphical'); ?> <?php echo $this->lang->line('report'); ?></a> </li>                          
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in" id="tab_tabular" >
                            <div class="x_content">
                            <table id="datatable-keytable" class="datatable-responsive table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th><?php echo $this->lang->line('academic_year'); ?></th>
                                        <th><?php echo $this->lang->line('group_by_data'); ?></th>
                                        <th><?php echo $this->lang->line('amount'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php 
                                    $grnd_total = 0;
                                    $count = 1; if(isset($expenditure) && !empty($expenditure)){ ?>
                                        <?php foreach($expenditure as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>                                            
                                            <td><?php echo $obj->session_year; ?></td>
                                            <td><?php echo $obj->group_by_field; ?></td>
                                            <td><?php echo $obj->total_amount; $grnd_total +=$obj->total_amount; ?></td>                                           
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td colspan="3"><strong><?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('amount'); ?></strong></td>
                                            <td><strong><?php echo number_format($grnd_total,2); ?></strong></td>                                           
                                        </tr>
                                    <?php }else{ ?>
                                        <tr><td colspan="5" class="text-center"><?php echo $this->lang->line('no_data_found'); ?></td></tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <div  class="tab-pane fade in active" id="tab_graphical" >
                            <div class="x_content">
                                <?php if(isset($expenditure) && !empty($expenditure)){ ?>
                                 <script type="text/javascript">

                                    $(function () {
                                        $('#expenditure-report').highcharts({
                                            chart: {
                                                type: 'pie',
                                                options3d: {
                                                    enabled: true,
                                                    alpha: 45
                                                }
                                            },
                                            title: {
                                                text: ' <?php echo $this->lang->line('expenditure'); ?> <?php echo $this->lang->line('report'); ?>'
                                            },
                                            subtitle: {
                                                text: ''
                                            },
                                            plotOptions: {
                                                pie: {
                                                    innerSize: 100,
                                                    depth: 45,
                                                    dataLabels: {
                                                        format: '{point.name}'
                                                    }
                                                }
                                            },
                                            series: [{
                                                name: '<?php echo $this->lang->line('amount'); ?>',
                                                data: [ 
                                                    
                                                    <?php foreach($expenditure as $obj){ ?>
                                                    ['<?php echo $obj->session_year.'<br/>'.$obj->total_amount; ?><br/><?php echo $obj->group_by_field; ?>', <?php echo $obj->total_amount; ?>],
                                                    <?php } ?>                                                   
                                                ]
                                            }],
                                            credits: {
                                            enabled: false
                                            }
                                        });
                                     });
                                </script>
                                <div id="expenditure-report" style="width: 99%; height: 500px; margin: 0 auto"></div>
                                 <?php }else{ ?>
                                <p class="text-center"><?php echo $this->lang->line('no_data_found'); ?></p>
                                 <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                 <div class="row no-print">
                    <div class="col-xs-12 text-right">
                        <button class="btn btn-default hiddens" id="btnPrint"><i class="fa fa-print"></i> <?php echo $this->lang->line('print'); ?></button>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
 <script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>
 <script type="text/javascript">
     
    $('#date_from').datepicker();
    $('#date_to').datepicker();
    $("#expenditure").validate();  
       
</script>
