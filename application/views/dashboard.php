


 <!--Dashboard Section-->
<form id="dashboard" method="post" action="">
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
                  </select>  -->
               </div>

               <div class="col-sm-6 col-md-6 col-lg-6 text-right">
                  <select class="selectpicker select-dropdown history-select" data-size="5" style="display: none;" name="getRecords" id="getRecords" >
                     <option  value="last_7"  <?php if($date_range =='last_7') echo "selected" ; ?>>Ultimi 7 giorni: <?php echo date('d M Y', strtotime('-7 days'));?> -  <?php echo date('d M Y');?></option>
                     <option  value="last_15"  <?php if($date_range =='last_15')  echo "selected" ; ?>>Ultimo 15 giorni: <?php echo date('d M Y', strtotime('-15 days'));?> -  <?php echo date('d M Y');?></option>
                     <option  value="last_month"  <?php if($date_range == 'last_month') echo "selected" ; ?>>Ultimo mese: <?php echo date('d M Y', strtotime('-30 days'));?> -  <?php echo date('d M Y');?></option>
                     <option  value="all"  <?php if($date_range =='all') echo "selected" ; ?> >Tutti</option>
                  </select>
               </div>
               <div class="clearfix"></div>
              
               <div class="col-sm-12 col-md-12 col-lg-12 wow fadeInDown" data-wow-delay="0s">
                  <div class="counting-box">
                     <div class="box borderless">
                        <strong> <?php if($impresion[0]['clicks'] != '' && $impresion[0]['clicks'] > 0){ echo $impresion[0]['clicks'] ;} else echo "0,000"; ?></strong><br/>
                        <!-- Interactions -->
                        Clicks
                     </div>
                     <div class="box">
                        <strong>
                           <?php if($impresion[0]['impresion'] != '' && $impresion[0]['impresion'] > 0){ echo $impresion[0]['impresion'] ;} else echo "0,000"; ?>
                        </strong><br/>
                        Impressioni
                     </div>
                     <div class="box">
                        <strong>
                          <?php 
                              $intr_rate = 0;
                          if($impresion[0]['impresion'] > 0 && $impresion[0]['clicks'] > 0)
                          {
                             $rate = ($impresion[0]['clicks']/$impresion[0]['impresion'])*100;
                             $intr_rate = number_format((float)$rate, 2, '.', '');
                          }
                          else
                          {
                            $intr_rate =0.00;
                          } 
                          echo $intr_rate; ?>
                          %</strong><br/>
                        Rate di interazione (CTR)
                     </div>
                     <div class="box">
                        <strong><i class="fa fa-eur" aria-hidden="true"></i> <?php echo $price; ?></strong><br/>
                        Costo per click
                     </div>
                     <div class="box">
                        <strong><i class="fa fa-eur" aria-hidden="true"></i>   <?php if($impresion[0]['used_amount'] != '' &&  $impresion[0]['used_amount'] > 0){ echo $impresion[0]['used_amount'] ;} else echo "0,000"; ?></strong><br/>
                        Costo totale
                     </div>
                  </div>
               </div>
               <div class="clearfix"></div>
               <div class="margin-10">
                 
                  <div class="col-sm-12 col-md-12 col-lg-12 pad-10- wow fadeInDown" data-wow-delay="0s">
                     <div class="table-responsive emty-table alrts-table">
                        <div class="table-title">
                           <i class="fa fa-line-chart"></i> Riepilogo grafico
                           <!-- <span class="pull-right"><button type="button" class="btn btn-xs"><i class="fa fa-caret-down" aria-hidden="true"></i></button> <button type="button" class="btn btn-xs"><i class="fa fa-minus" aria-hidden="true"></i></button> <button type="button" class="btn btn-xs"><i class="fa fa-remove" aria-hidden="true"></i></button></span> -->
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
                           <i class="fa fa-pencil"></i> Riepilogo per esame
                           <!-- <span class="pull-right"><button type="button" class="btn btn-xs"><i class="fa fa-caret-down" aria-hidden="true"></i></button> <button type="button" class="btn btn-xs"><i class="fa fa-minus" aria-hidden="true"></i></button> <button type="button" class="btn btn-xs"><i class="fa fa-remove" aria-hidden="true"></i></button></span> -->
                           <div class="clearfix"></div>
                        </div>
                        <table class="table table-bordered">
                           <tr>
                              <th width="1%"></th>
                              <th width="14%" class="keyword-col">Esame</th>
                              <th class="active-click">Click</th>
                              <th>Costo totale</th>
                              <th>CTR</th>
                              <th>Impr.</th>
                              <th>CPC</th>
                           </tr>

                           <?php if(count($result)>0)
                                 { 
                                    foreach ($result as $res) 
                                    {
                                      if($res['impresion']>0)
                                       $ctr1 = ($res['clicks']/$res['impresion'])*100;
                                      else
                                       $ctr1 =0.00;
                                      $ctr = number_format((float)$ctr1, 2, '.', '');
                                      $quality_score = 0;
                                      $cpc = 0.00;
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
                                         
                               ?>
                                   <tr>
                                    <td><i class="fa fa-circle"></i></td>
                                    <td class="keyword-col"> <?php echo $res['exam_type'];?></td>
                                    <td><?php echo $res['clicks'];?></td>
                                    <td><i class="fa fa-eur" aria-hidden="true"></i> <?php echo $res['used_amount'];?></td>
                                    <td><?php echo  $ctr ; ?>%</td>
                                    <td><?php echo $res['impresion'];?></td>
                                    <td><i class="fa fa-eur" aria-hidden="true"></i> <?php echo $cpc; ?></td>
                                   </tr>
                            <?php     
                                    }
                                 }
                                 else
                                 {
                              ?>
                                 <tr>
                                    <td colspan="6"> No Records found.</td>
                                    
                                   
                                 </tr>
                           <?php } ?>
                           
                           
                        </table>
                        <div class="table-footer"><!-- <a href="#">View saved filter <i class="fa fa-angle-double-right"></i></a> <span class="pull-right"> 1-3 of 10 <button type="button" class="btn btn-xs"><i class="fa fa-angle-left"></i></button> <button type="button" class="btn btn-xs"><i class="fa fa-angle-right"></i></button></span> --></div>
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
          // $('.scrollMe .dropdown-menu').scrollyou();
         
          // prettyPrint();
           };
         


      </script>



<!-- 
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
 -->

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
         $getExam = $this->master_model->getRecords('tbl_click_datewise',array('tblexamination.owner_id'=>$this->session->userdata('user')->id));

         if(count($getExam)>0)
         {
            $str = '';
            foreach ($getExam as $exam) {
               $str = $str."['".date('d M',strtotime($exam['date']))."',".$exam['click_count']."],";
            }
            
            rtrim($str,',');
         }
         else
            $str = "['".date('d M')."',0]";
       

      ?>
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
         ['Year','Clicks'],
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


