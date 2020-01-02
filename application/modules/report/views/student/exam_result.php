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
                <h3 class="head-title"><i class="fa fa-bar-chart"></i><small> <?php echo $this->lang->line('exam'); ?> <?php echo $this->lang->line('result'); ?> <?php echo $this->lang->line('report'); ?></small></h3>                
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            
            <?php $this->load->view('quick_report'); ?>   
            
             <div class="x_content filter-box no-print"> 
                <?php echo form_open_multipart(site_url('report/examresult'), array('name' => 'examresult', 'id' => 'examresult', 'class' => 'form-horizontal form-label-left'), ''); ?>
                <div class="row">                    
                   <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('academic_year'); ?> <span class="red">*</span></div>
                            <select  class="form-control col-md-7 col-xs-12" name="academic_year_id" required="required" id="academic_year_id">
                                <option value=""><?php echo $this->lang->line('all'); ?></option>
                                <?php foreach ($academic_years as $obj) { ?>
                                <option value="<?php echo $obj->id; ?>" <?php if(isset($academic_year_id) && $academic_year_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->session_year; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                   <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('class'); ?> <span class="red">*</span></div>
                            <select  class="form-control col-md-7 col-xs-12" name="class_id" id="class_id" required="required" onchange="get_section_by_class(this.value, '');">
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                <?php foreach ($classes as $obj) { ?>
                                <option value="<?php echo $obj->id; ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                   <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('section'); ?></div>
                            <select  class="form-control col-md-7 col-xs-12" name="section_id" id="section_id">                                
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                            </select>
                        </div>
                    </div>                    
                
                    <div class="col-md-3 col-sm-3 col-xs-12">
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
                           <div class="col-sm-4  col-sm-offset-4 layout-box center">
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
                                 <div class="clearfix"></div>
                                   <h4 class="head-title ptint-title"><i class="fa fa-bar-chart"></i><small> <?php echo $this->lang->line('exam'); ?> <?php echo $this->lang->line('result'); ?> <?php echo $this->lang->line('report'); ?></small></h4>                
                                   <?php if(isset($academic_year)){ ?>
                                   <div><?php echo $this->lang->line('academic_year'); ?>: <?php echo $academic_year; ?></div>
                                   <?php } ?>
                                   <div>
                                   <?php if(isset($class)){ ?>
                                   <?php echo $this->lang->line('class'); ?>: <?php echo $class; ?>
                                   <?php } ?>
                                   <?php if(isset($section)){ ?>
                                   , <?php echo $this->lang->line('section'); ?>: <?php echo $section; ?>
                                   <?php } ?>
                                   </div>
                               </p>
                           </div>
                       </div>            
                   </div>
                    
                    
                    <ul  class="nav nav-tabs bordered no-print hiddens">
                        <li class="active"><a href="#tab_tabular"   role="tab" data-toggle="tab"   aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('tabular'); ?> <?php echo $this->lang->line('report'); ?></a> </li>
                    </ul>
                    <br/>
                   
                    <div class="tab-content">
                        <div  class="tab-pane fade in active" id="tab_tabular" >
                            <div class="x_content">
                            <table id="datatable-keytable" class="datatable-responsive table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('name'); ?></th>
                                        <th><?php echo $this->lang->line('roll_no'); ?></th>
                                        <th><?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('subject'); ?></th>                                            
                                        <th><?php echo $this->lang->line('exam'); ?> <?php echo $this->lang->line('mark'); ?></th>                                            
                                        <th><?php echo $this->lang->line('obtain'); ?> <?php echo $this->lang->line('mark'); ?></th> 
                                        <th ><?php echo $this->lang->line('percentage'); ?></th> 
                                        <th> <?php echo $this->lang->line('average_grade_point'); ?></th>                                            
                                        <th><?php echo $this->lang->line('grade'); ?></th>                                            
                                        <th><?php echo $this->lang->line('result'); ?> <?php echo $this->lang->line('status'); ?></th>                                            
                                        <th ><?php echo $this->lang->line('position_in_section'); ?></th>                                            
                                        <th ><?php echo $this->lang->line('position_in_class'); ?></th>   
                                        <th><?php echo $this->lang->line('remark'); ?></th>  
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php 
                                    
                                    $count = 1; if(isset($examresult) && !empty($examresult)){ ?>
                                        <?php foreach($examresult as $obj){ ?>
                                        <?php $class_position = get_position_student_position($academic_year_id, $class_id, $obj->student_id); ?>    
                                        <?php $section_position = get_position_student_position($academic_year_id, $class_id,$obj->student_id, $obj->section_id); ?> 
                                        <tr>
                                            <td><?php echo $obj->student; ?></td>
                                            <td><?php echo $obj->roll_no; ?></td>
                                            <td><?php echo $obj->total_subject; ?></td>
                                            <td><?php echo $obj->total_mark; ?></td>
                                            <td><?php echo $obj->total_obtain_mark; ?></td>
                                            <td><?php echo $obj->total_mark > 0 ? number_format(@$obj->total_obtain_mark/$obj->total_mark*100, 2) : 0; ?>%</td> 
                                            <td><?php echo $obj->avg_grade_point; ?></td>
                                            <td><?php echo $obj->grade; ?></td>
                                            <td><?php echo $this->lang->line($obj->result_status); ?></td>
                                            <td><?php echo $section_position; ?></td> 
                                            <td><?php echo $class_position; ?></td> 
                                            <td><?php echo $obj->remark; ?></td>
                                        </tr>
                                        <?php } ?>                                        
                                    <?php }else{ ?>
                                        <tr><td colspan="12" class="text-center"><?php echo $this->lang->line('no_data_found'); ?></td></tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
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

 <script type="text/javascript">

    $("#examresult").validate(); 
    
    <?php if(isset($class_id) && isset($section_id)){ ?>
        get_section_by_class('<?php echo $class_id; ?>', '<?php echo $section_id; ?>');
    <?php } ?>
      function get_section_by_class(class_id, section_id){       
           
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_section_by_class'); ?>",
            data   : {class_id: class_id, section_id:section_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                  $('#section_id').html(response);
               }
            }
        });         
    }
    
       
</script>
