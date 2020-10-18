<div class="page-title">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">Administrator</div>
      </div>
    </div>
  </div>
<style type="text/css">
.act a {color:#050404; /*new colour*/}

</style>

<form method="post" action="" id="examination_form">
<div class="container">
   <div class="row">
      <div class="col-sm-3 col-md-3 col-lg-3">
         <!--left side bar-->
         <div class="left-section">
            <div class="search-bar">
              <!--  <input type="text" class="search"/><span><i class="fa fa-search" aria-hidden="true"></i></span> -->
            </div> 
            <hr/>
            <div class="left-sidebar">
               <input type="hidden" name="exam_id" id="exam_id" value="<?php echo $exam_id;?>" >
               <ul>
                  <li>
                     <div class="head-title"><a href="javascript:void(0);">Examinations</a></div>
                     <ul>
                         <li class="act"><a href="javascript:void(0);" class="" ><i class="fa fa-search" aria-hidden="true"></i><?php echo $common_name;?></a></li>
                     </ul>
                  </li>
                  <li>
                     <div class="head-title"><a ></a></div>
                  </li>
                 
               </ul>
            </div>
         </div>
      </div>
      <div class="col-sm-9 col-md-9 col-lg-9">
         <div class="dashboard">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-sm-6 col-md-6 col-lg-6">
                    <!--  <h4>Customise Modules</h4>
                     <select class="selectpicker select-dropdown" style="display: none;">
                        <option data-icon="fa fa-folder-open-o">All Campaigns</option>
                        <option data-icon="fa fa-long-arrow-right">Campaigns 1</option>
                        <option data-icon="fa fa-long-arrow-right">Campaigns 2</option>
                        <option data-icon="fa fa-long-arrow-right">Campaigns 3</option>
                        <option data-icon="fa fa-long-arrow-right">Campaigns 4</option>
                     </select>
                     <select class="selectpicker select-dropdown" style="display: none;">
                        <option data-icon="fa fa-square blue-square">Clicks</option>
                        <option data-icon="fa fa-square green-square">Clicks 1</option>
                        <option data-icon="fa fa-square red-square">Clicks 2</option>
                        <option data-icon="fa fa-square orenge-square">Clicks 3</option>
                     </select>
                     <span style="margin-right:20px;">VS</span>
                     <select class="selectpicker select-dropdown" style="display: none;">
                        <option>None</option>
                        <option>Campaigns 1</option>
                        <option>Campaigns 2</option>
                        <option>Campaigns 3</option>
                        <option>Campaigns 4</option>
                     </select>
                     <select class="selectpicker select-dropdown" style="display: none;">
                        <option>Daily</option>
                        <option>Day 1</option>
                        <option>Day 2</option>
                        <option>Day 3</option>
                        <option>Day 4</option>
                     </select> -->
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-6 text-right">
                    <a href="<?php echo base_url().'admin/exams'; ?>" style="margin:21px 15px 0 0" class="btn btn-primary btn-sm">Back</a>
                     <select class="selectpicker select-dropdown history-select" data-size="5" style="display: none;" name="duration" id="duration" >
                      <option  value="last_7"  <?php if($date_range =='last_7') echo "selected" ; ?>>Last 7 days: <?php echo date('d M Y', strtotime('-7 days'));?> -  <?php echo date('d M Y');?></option>
                      <option  value="last_15"  <?php if($date_range =='last_15')  echo "selected" ; ?>>Last 15 days: <?php echo date('d M Y', strtotime('-15 days'));?> -  <?php echo date('d M Y');?></option>
                      <option  value="last_month"  <?php if($date_range == 'last_month') echo "selected" ; ?>>Last month: <?php echo date('d M Y', strtotime('-30 days'));?> -  <?php echo date('d M Y');?></option>
                      <option  value="all"  <?php if($date_range =='all') echo "selected" ; ?> >All</option>
                     </select>
                  </div>
                  <div class="clearfix"></div>
                  <div class="clearfix"></div>
                  <div class="margin-10">
                     <div class="col-sm-12 col-md-12 col-lg-12 pad-10- wow fadeInDown" data-wow-delay="0s">
                        <div class="table-responsive emty-table alrts-table">
                           <div class="table-title">
                              <i class="fa fa-line-chart"></i> Clicks Graph
                              <span class="pull-right"><!-- <button type="button" class="btn btn-xs"><i class="fa fa-caret-down" aria-hidden="true"></i></button> <button type="button" class="btn btn-xs"><i class="fa fa-minus" aria-hidden="true"></i></button> <button type="button" class="btn btn-xs"><i class="fa fa-remove" aria-hidden="true"></i></button> --></span>
                              <div class="clearfix"></div>
                           </div>
                           <div class="graph-img">
                              <!-- <img src="<?php echo base_url();?>assets/images/graph-img.jpg" alt="graph" />
                              <div class="col-sm-6 col-md-6 col-lg-6">Saturday, 27 August 2016</div>
                              <div class="col-sm-6 col-md-6 col-lg-6 text-right">Friday, 2 September 2016</div> -->
                              <div id="curve_chart" style="margin-top:20px; position:relative; height: 290px;"></div>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <div class="col-sm-12 col-md-12 col-lg-12">
                        <hr />
                     </div>
                     <div class="col-sm-12 col-md-12 col-lg-12 pad-10- wow fadeInDown" data-wow-delay="0s">
                        <div class="table-responsive">
                           <div class="table-title">
                              <i class="fa fa-pencil"></i> Examination <?php echo $common_name;?> Stats. 
                              <span class="pull-right"><!-- button type="button" class="btn btn-xs"><i class="fa fa-caret-down" aria-hidden="true"></i></button> <button type="button" class="btn btn-xs"><i class="fa fa-minus" aria-hidden="true"></i></button> <button type="button" class="btn btn-xs"><i class="fa fa-remove" aria-hidden="true"></i></button> --></span>
                              <div class="clearfix"></div>
                           </div>
                           <table class="table table-bordered">
                              <tr>
                                 <th width="1%"></th>
                                 <th width="14%" class="keyword-col">Examination</th>
                                 <th class="active-click">Click</th>
                                 <th>Cost</th>
                                 <th>CTR</th>
                                 <th>Impr.</th>
                                 <!-- <th>Avg.CPC</th> -->
                                 <th>CPC</th>
                                
                              </tr>
                              <?php if(count($examination)>0)
                                    {
                                       foreach ($examination as $res) 
                                       {
                                         if($exam_id != $res['examination_id'])
                                           continue;
                                         if($res['impresion']>0)
                                          $ctr1 = ($res['clicks']/$res['impresion'])*100;
                                         else
                                          $ctr1 = "0.00";
                                      $ctr = number_format((float)$ctr1, 2, '.', '');
                                      $quality_score = 0;
                                      $cpm = 0.00;
                                      $cpc = 0.00;
                                                  $this->db->select_sum('rating');
                                                  $this->db->select('count(exam_id)');
                                      $getReview = $this->master_model->getRecords('tblexamination_review',array('exam_id'=>$res['examination_id'],'status'=>'1')); 
                                      if(count($getReview)>0)
                                      {
                                        if($getReview[0]['count(exam_id)']!=0)
                                        {
                                          $review = ($getReview[0]['rating']/$getReview[0]['count(exam_id)']);
                                          $quality_score = number_format((float)$review, 2, '.', '');
                                          $cpc = ($res['ad_rank']/$quality_score);
                                        }
                                      }

                                      $cpc   = number_format((float)$cpc, 2, '.', '');
                                     /* $cost1 =  $res['click_price']*$res['clicks']; 
                                      $cost  = number_format((float)$cost1, 2, '.', '');
                                        */
                                       ?>
                                    <tr>
                                       <td><i class="fa fa-circle"></i></td>
                                       <td class="keyword-col"> <?php echo $res['exam_type'];?></td>
                                       <td><?php echo $res['clicks'];?></td>
                                       <td><i class="fa fa-eur" aria-hidden="true"></i> <?php echo $res['budget_amount'];?></td>
                                       <td><?php echo  $ctr ; ?>%</td>
                                       <td><?php echo $res['impresion'];?></td>
                                       <td><i class="fa fa-eur" aria-hidden="true"></i> <?php echo $cpc; ?></td>
                                     
                                    </tr>
                                    <?php 

                                       }
                                   }
                                   else
                                   { ?>
                                    <tr>
                                       <td colspan="7"> No records found </td>
                                    </tr>
                            <?php } ?>
                           </table>
                           <div class="table-footer"><!-- <a href="#">View saved filter <i class="fa fa-angle-double-right"></i></a> <span class="pull-right"> 1-3 of 10 <button type="button" class="btn btn-xs"><i class="fa fa-angle-left"></i></button> <button type="button" class="btn btn-xs"><i class="fa fa-angle-right"></i></button></span> --></div>
                        </div>
                     </div>
                     <!--End Table -->
                     <!--    End Table -->    
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</form>




 <script type="text/javascript">
         window.onload=function(){
           $('.selectpicker').selectpicker();
           $('.rm-mustard').click(function() {
             $('.remove-example').find('[value=Mustard]').remove();
             $('.remove-example').selectpicker('refresh');
           });
           $('.rm-ketchup').click(function() {
             $('.remove-example').find('[value=Ketchup]').remove();
             $('.remove-example').selectpicker('refresh');
           });
           $('.rm-relish').click(function() {
             $('.remove-example').find('[value=Relish]').remove();
             $('.remove-example').selectpicker('refresh');
           });
           $('.ex-disable').click(function() {
               $('.disable-example').prop('disabled',true);
               $('.disable-example').selectpicker('refresh');
           });
           $('.ex-enable').click(function() {
               $('.disable-example').prop('disabled',false);
               $('.disable-example').selectpicker('refresh');
           });
         
           // scrollYou
           $('.scrollMe .dropdown-menu').scrollyou();
         
           prettyPrint();
           };
         
           $('.getid').on('click',function(){
            var id = $(this).attr('data-id');
            $('#exam_id').val(id);

           document.forms["examination_form"].submit()


           });

     


      </script>
      <script type="text/javascript" language="javascript" src="js/wow.min.js"></script>
      <script type="text/javascript">
         wow = new WOW({
             animateClass: 'animated',
             offset: 100,
             callback: function(box) {
                 console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
             }
         });
         wow.init();
         document.getElementById('moar').onclick = function() {
             var section = document.createElement('section');
             section.className = 'section--purple wow fadeInDown';
             this.parentNode.insertBefore(section, this);
         };
      </script>


   
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      <?php 
        
         $day =7;
         if($date_range=="last_7")
            $day =7;
         else
            if($date_range=="last_15")
               $day = 15;
            else if($date_range == "last_month")
               $day = 30;
            else if($date_range == 'all')
               $day = 'all';
            else
               $day =7;



        
         
         $this->db->select('tblexamination.*,tbl_click_datewise.*');
         $this->db->select_sum('click_count');
         $this->db->group_by('date');
         $this->db->join('tblexamination','tblexamination.id = tbl_click_datewise.exam_id');
           if($day != "all")
         $this->db->where('tbl_click_datewise.date BETWEEN DATE_SUB(NOW(), INTERVAL '.$day.' DAY) AND NOW()');
         $getExam = $this->master_model->getRecords('tbl_click_datewise',array('exam_id'=>$exam_id));

        /* echo $this->db->last_query();
         exit();*/
         if(count($getExam)>0)
         {
            $str = "['Year','Clicks'],";
            foreach ($getExam as $exam) {
               $str = $str."['".date('d M',strtotime($exam['date']))."',".$exam['click_count']."],";
            }
            
            rtrim($str,',');
         }
         else
            $str = "['Year','Clicks'],[0,0]";
       

      ?>
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
         <?php echo $str;?>]);

        var options = {
          title: 'Clicks Report',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }

     
</script>


