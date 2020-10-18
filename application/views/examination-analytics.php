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
               <ul>
                  <li>
                     <div class="head-title"><a href="#">All Examinations</a></div>
                     <ul>
                       
                   <?php if(count($examination)>0)
                         {
                           foreach ($examination as  $exam) 
                           { ?>
                         <li ><a href="javascript:void(0);" class="getid" data-id="<?php echo $exam['examination_id'];?>"><i class="fa fa-search" aria-hidden="true"></i><?php echo $exam['exam_type'];?></a></li>
                             
                     <?php }
                         }
                         else
                         { ?>
                               <li><a href="javascript:void(0);"><i class="fa fa-search" aria-hidden="true"></i>No Examination</a></li>
                    <?php } ?>
               
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
                 
                  <div class="clearfix"></div>
                  <div class="clearfix"></div>
                  <div class="margin-10">
                    <div class="col-sm-12 col-md-12 col-lg-12 pad-10- wow fadeInDown" data-wow-delay="0s">
                        <div class="table-responsive emty-table alrts-table">
                           <div class="table-title">
                              <i class="fa fa-line-chart"></i> Days Graph
                              <span class="pull-right"></span>
                              <div class="clearfix"></div>
                           </div>
                           <div class="graph-img">
                            <div id="curve_chart" style="margin-top:20px; position:relative; height: 290px;"></div>
                           </div>
                        </div>
                     </div> 
                     <div class="clearfix"></div>
                      <div class="col-sm-12 col-md-12 col-lg-12 pad-10- wow fadeInDown" data-wow-delay="0s">
                        <div class="table-responsive emty-table alrts-table">
                           <div class="table-title">
                              <i class="fa fa-line-chart"></i> Visitatori per esame
                              <span class="pull-right"><!-- <button type="button" class="btn btn-xs"><i class="fa fa-caret-down" aria-hidden="true"></i></button> <button type="button" class="btn btn-xs"><i class="fa fa-minus" aria-hidden="true"></i></button> <button type="button" class="btn btn-xs"><i class="fa fa-remove" aria-hidden="true"></i></button> --></span>
                              <div class="clearfix"></div>
                           </div>
                           <div class="graph-img">
                              <!-- <img src="<?php echo base_url();?>assets/images/graph-img.jpg" alt="graph" />
                              <div class="col-sm-6 col-md-6 col-lg-6">Saturday, 27 August 2016</div>
                              <div class="col-sm-6 col-md-6 col-lg-6 text-right">Friday, 2 September 2016</div> -->
                              <div id="chart_div" style="margin-top:20px; position:relative; height: 290px;"></div>
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
                              <i class="fa fa-pencil"></i> Esame 
                              <span class="pull-right"><!-- button type="button" class="btn btn-xs"><i class="fa fa-caret-down" aria-hidden="true"></i></button> <button type="button" class="btn btn-xs"><i class="fa fa-minus" aria-hidden="true"></i></button> <button type="button" class="btn btn-xs"><i class="fa fa-remove" aria-hidden="true"></i></button> --></span>
                              <div class="clearfix"></div>
                           </div>
                           <table class="table table-bordered">
                              <tr>
                                 <th width="1%"></th>
                                 <th width="14%" class="keyword-col">Esame</th>
                                 <th class="active-click">Click</th>
                                 <th>Total Cost</th>
                                 <th>CTR</th>
                                 <th>Impr.</th>
                                 <!-- <th>Avg.CPC</th> -->
                                 <th>CPC</th>
                                <!--  <th>Avg.CPM</th> -->
                                 <!-- <th>Avg.Pos</th>
                                 <th width="11%">Status</th> -->
                              </tr>
                              <?php if(count($examination)>0)
                                    {
                                       foreach ($examination as $res) 
                                       {
                                         if($res['impresion']>0)
                                          $ctr1 = ($res['clicks']/$res['impresion'])*100;
                                         else
                                          $ctr1 = "0.00";
                                        $ctr = number_format((float)$ctr1, 2, '.', '');
                                        $quality_score = 0;
                                        $cpc = 0;
                                        $cpm = 0;
                                        $cpc = $res['click_price'];


                                        if($ctr >0 && $cpc > 0 && $res['impresion']>0)
                                        {
                                            $cpm1 = ($res['impresion']*$ctr*$cpc)/1000;
                                            $cpm =number_format((float)$cpm1, 2, '.', '');
                                        }
                                        
                                       ?>
                                    <tr>
                                       <td><i class="fa fa-circle"></i></td>
                                       <td class="keyword-col"> <?php echo $res['exam_type'];?></td>
                                       <td><?php echo $res['clicks'];?></td>
                                       <td><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $res['used_amount'];?></td>
                                       <td><?php echo  $ctr ; ?>%</td>
                                       <td><?php echo $res['impresion'];?></td>
                                       <td><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $cpc; ?></td>
                                      <!--  <td><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $cpm; ?></td> -->
                                       <!-- <td>0.00</td>
                                       <td>Below first page bid</td>  -->
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
          /* $('.scrollMe .dropdown-menu').scrollyou();
         
           prettyPrint();*/
           };
         /*
           $('.getid').on('click',function(){
            var id = $(this).attr('data-id');
            $('#exam_id').val(id);

           document.forms["examination_form"].submit()


           });*/

     


      </script>
      <script type="text/javascript" language="javascript" src="js/wow.min.js"></script>
      <script type="text/javascript">
       /*  wow = new WOW({
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
         };*/
      </script>


   
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      <?php 
        
       
         $getExam = $this->master_model->getRecords('tblexamination',array('owner_id'=>$this->session->userdata('user')->id));


          

       
         if(count($getExam)>0)
         {  $i =1;
            $str = "['Esame','Tempo di attesa','reported waiting days'],";
            foreach ($getExam as $exam) {
                      $this->db->select_sum('rating');
                      $this->db->select('count(exam_id)');
                      //$rr =0;
                      $rr =0;
                      $this->db->select_sum('rating');
                      $this->db->select('count(exam_id)');
                      $getReview = $this->master_model->getRecords('tblexamination_review',array('exam_id'=>$exam['id'],'status'=>'1')); 
                      if(count($getReview)>0)
                      {
                          if($getReview[0]['count(exam_id)']!=0)
                          {
                            $review = intval(($getReview[0]['rating']/$getReview[0]['count(exam_id)']));
                            $rr= $review;
                          }
                      }



               $str = $str."['".$exam['exam_type']."',$exam[official_waiting_days],$rr],";
               $i++;
            }
            rtrim($str,',');
         }
         else
            $str = "['Esame','Tempo di attesa','reported waiting days'],['0',0,0]";
       

      ?>
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
         <?php echo $str;?>]);

        var options = {
          title: 'Days Report',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }




      google.charts.setOnLoadCallback(drawVisualization);

      <?php        /* $this->db->select('common_name');
                    $this->db->select_sum('click_count');
                    $this->db->group_by('exam_id');*/
                    $this->db->join("tbl_ads_users","tbl_ads_users.examination_id = tblexamination.id");
         $getRec = $this->master_model->getRecords('tblexamination',array('owner_id'=>$this->session->userdata('user')->id));

        
         if(count($getRec)>0)
         {  $i =1;
            $str2 = "['Esame','Visitatori'],";
            foreach ($getRec as $exam) {
               $str2 = $str2."['".$exam['exam_type']."',$exam[clicks]],";
               $i++;
            }
            
            rtrim($str2,',');
         }
         else
            $str2 = "['Esame','Visitatori'],['0',0]";
      ?>

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
        <?php echo $str2;?>]);

    var options = {
      title : 'Visite totali',
      vAxis: {title: 'NO. di visitatori'},
      hAxis: {title: 'Esame'},
      seriesType: 'bars',
      series: {5: {type: 'line'}}
    };

    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }















     
</script>


