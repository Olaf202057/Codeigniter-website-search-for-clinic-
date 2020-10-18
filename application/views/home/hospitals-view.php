<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">Hospitals</div>
        </div>
    </div>
</div>
<?php 

            $exam_id = $_GET['exam_id'];
            $exam1 =  $this->master_model->getRecords('tblexamination',array('id'=>$exam_id));
            if(count($exam1)<=0)
            {
                $this->session->set_flashdata('error','Something went wrong');
                redirect(base_url());
            }
                 $this->db->select_sum('actual_time');
                 $this->db->select('count(exam_id)');
    $getReview = $this->master_model->getRecords('tblexamination_review',array('exam_id'=>$exam_id,'status'=>'1')); 
    $actual_time =0;
    if(count($getReview)>0)
    {
        if($getReview[0]['count(exam_id)']!=0)
        {
          $review = ($getReview[0]['actual_time']/$getReview[0]['count(exam_id)']);
          $actual_time = number_format((float)$review, 2, '.', '');
          $actual_time  = round($actual_time);
        }
    }
                    
?>
<div class="spacer">
    <div class="container">
        <div class="row" style="background: #FFF;">
            <div class="col-sm-8">
                <div class="sr-results">
                    <ul>
                        <li class="wow slideInUp" style="padding-top:0;">
                            <h2><a><?php echo $structure->hospital ?></a></h2>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="sr-details"> <i class="fa fa-map-marker"></i>
                                        <h4>Indirizzo</h4>
                                        <?php echo $structure->address; ?> 
									</div>
								</div>
                                <div class="col-sm-6">
                                    <div class="sr-details"> <i class="fa fa-plus-square"></i>
                                        <h4>Prestazione</h4>
                                        <?php echo $exam->common_name ?> 
									</div>
								</div>
							</div>								
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="sr-details"> <i class="fa fa-phone"></i>
                                        <h4>Prenotazioni telefoniche</h4>
                                        <?php echo $structure->telephone ?> 
									</div>
								</div>
                                <div class="col-sm-6">
                                    <div class="sr-details"> <i class="fa fa-clock-o"></i>
                                        <h4>Tempo ufficiale di attesa</h4>
                                        <?php echo (($exam->official_waiting_days!=null  && $exam->official_waiting_days!=0) ? $exam->official_waiting_days.' giorni' : 'N/A').'<br/>'; ?>
									</div>
								</div>
							</div>	
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="sr-details"> <i class="fa fa-internet-explorer"></i>
                                        <h4>Sito internet</h4>
                                        <?php echo $structure->website ?> 
									</div>
								</div>
                                <div class="col-sm-6">
                                    <div class="sr-details"> <i class="fa fa-user"></i>
                                        <h4>Tempo di attesa riportato dagli utenti</h4>
										<?php	
											if($actual_time == "N/A") {
												$black = 5;
												$gray = 0;																				
											} else if($actual_time <= 15) {
												$black = 5;
												$gray = 0;
											} else if($actual_time <= 30) {
												$black = 4;
												$gray = 1;
											} else if($actual_time <= 60) {
												$black = 3;
												$gray = 2;
											} else if($actual_time <= 90) {
												$black = 2;
												$gray = 3;
											} else {
												$black = 1;
												$gray = 4;
											}
										?>
										<?php for($bi=1; $bi<=$black; $bi++) { ?>																					
											<img src="<?php echo base_url('assets/img/watch_black.png'); ?>" width="12" style="margin-right: 1px;" />
										<?php } ?>
										<?php for($bi=1; $bi<=$gray; $bi++) { ?>																					
											<img src="<?php echo base_url('assets/img/watch_gray.png'); ?>" width="12" style="margin-right: 1px;"  />
										<?php } ?>
									</div>
								</div>
							</div>		
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="sr-details"> <i class="fa fa-globe"></i>
                                        <h4>Coordinate</h4>
                                        <?php echo $structure->latitude . ", " . $structure->longitude; ?> 
									</div>
								</div>
                                <div class="col-sm-6">
                                    <div class="sr-details"> <i class="fa fa-thumbs-o-up"></i>
                                        <h4>Qualità della prestazione</h4>
										<?php 
											//echo $structure->ratings;
											$ratings = floor($exam->ratings);
											echo "<span>" . $exam->ratings . "</span> ";
											//$temp_rating = 2.8;
											$index =  round($exam->ratings * 2, 0);
										?>
										<span class="score s<?php echo $index; ?>"></span>
                                    </div>
								</div>
							</div>
							<?php 
								$map_url ="http://maps.googleapis.com/maps/api/staticmap?";
								
								$map_url .= "center=".$structure->address."&zoom=13&scale=false&size=382x382&maptype=roadmap&format=png&visual_refresh=true";
								
								$map_url .="&markers=icon:".base_url()."assets/img/map-marker.png%7Cshadow:true%7C".$structure->address;
							
							?>							
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="sr-details"> <i class="fa fa-car"></i>
                                        <h4>Indicazioni stradali</h4>
                                        <a href="https://maps.google.com/?q=<?php echo $structure->address . ", " . $structure->city . ", " . $structure->province; ?>" target="_blank">Vai a Google map</a> 
									</div>
								</div>
                                <div class="col-sm-6">
                                    <div class="sr-details"> <i class="fa fa-euro"></i>
                                        <h4>Costo della prestazione</h4>
										<?php echo (($exam->price==null) || ($exam->price=='')) ? 'SSN':'€  '.$exam->price  ?>
									</div>
								</div>
							</div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="google-map wow slideInUp" id="googleMap" style="width:100%;height:380px;">

                    <img id="img-map" height="380" width="100%" src="<?php echo $map_url ?>" ></div>
            </div>
        </div>
    </div>
	
	<div class="container">
		<div class="row" style="margin-top:40px;">
			<?php if(count($reviews)>0){ ?>
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Feedbacks</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
					<?php foreach($reviews as $row): ?>
					
						<div class="col-md-6">
							<strong><i class="fa fa-user margin-r-5"></i> <?php echo ($row->name==null) ? 'Anonymous':$row->name ?></strong>  <?php for($x =0;$x<5;$x++){
									if( $row->rating>$x){
										echo '<i class="fa fa-star "></i>';
									}else{
										echo '<i class="fa fa-star-o "></i>';
									}
	
								} ?>
								<div><i></i><?php echo $row->submited_date ?></i></div>
								<p class="text-muted">
									<?php echo $row->comment ?>
								</p>
	
							  <div>Valutazione degli utenti : <?php echo $row->actual_time ?></div>
	
	
							</p>
							<hr>
						</div>
					
						
					<?php endforeach; ?>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
			<?php } ?>
			<div id="review-msg"></div>
			<div class="">
					<?php //if(is_login(false)): ?>
					<div class="text-right">
						<a class="btn btn-success btn-green" href="#reviews-anchor" id="open-review-box">Lascia un feedback</a>
					</div>

					<div class="row" id="post-review-box" style="display:none;">
						<div class="col-md-12">
							<form id="frm-review" method="post">
								<div class="col-md-12">
								<input id="ratings-hidden" name="rating" type="hidden" value="0">
								<input id="ratings-hidden" value="<?php echo $structure->id ?> " name="structure_id" type="hidden">
								<input id="ratings-hidden" value="<?php echo $exam->id; ?> " name="exam_id" type="hidden">
								<label>Feedback</label>
								<textarea class="form-control animated" cols="50" id="new-review" name="comment"  placeholder="Scrivi la tua opinione&hellip;" rows="5"></textarea>
								<div class="text-danger" id="err_msg"></div>
								</div>
								
								<div class="col-md-6">
									<label>Data della prenotazione</label><input type="text" class="form-control" name="tried_to_book_date" id="tried_to_book_date"/>
									<div class="text-danger" id="tried_to_book_date_err"></div>
								</div>	
								<div class="col-md-6">
									<label>Data della prestazione</label><input type="text" class="form-control" name="appointment_date" id="appointment_date"/>
									<div class="text-danger" id="appointment_date_err"></div>
								</div>	
								
								<div class="col-md-6">
									<label>Tempo di attesa riscontrato</label><input type="number" min="0" class="form-control" value="0" name="actual_time" id="actual_time"/>
									<div class="text-danger" id="err_num"></div>
								</div>

								<div class="col-md-6">
									<div class="text-right">
										<div class="row">
											<div class="col-md-8 text-right"> <br />
												<strong>Qualità della prestazione:</strong>
											</div>
											
											<div class="col-md-4"><div class="stars starrr" data-rating="0"></div></div>
										</div>
										<a class="btn btn-danger btn-sm" href="#" id="close-review-box" style="display:none; margin-right: 10px;">
											Cancella
										</a>

										<button class="btn btn-success btn-sm" id="btn-review-submit" type="button">Salva</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<?php //else: ?>
						<!--<a href="<?php echo base_url('accesso') ?>" class="btn btn-primary pull-right" >creare recensioni</a>-->
					<?php //endif; ?>
				</div>

		</div>
	</div>
	
</div>
<script type="text/javascript">
var _MS_PER_DAY = 1000 * 60 * 60 * 24;

// a and b are javascript Date objects
function dateDiffInDays(a, b) {
	//alert(a + " " + b);
	// Discard the time and time-zone information.
	if(a != "" && b != "") {
		var a = new Date(a);
		var b = new Date(b);
		var utc1 = Date.UTC(a.getFullYear(), a.getMonth(), a.getDate());
		var utc2 = Date.UTC(b.getFullYear(), b.getMonth(), b.getDate());
		
		return Math.floor((utc2 - utc1) / _MS_PER_DAY);
	}
}

$(function () {
	var startDate = new Date('01/01/2012');
	var FromEndDate = new Date();
	var ToEndDate = new Date();
	
	ToEndDate.setDate(ToEndDate.getDate()+365);

	$('#tried_to_book_date').datepicker({
		autoclose: true,
		format: "yyyy-mm-dd"
	}).on('changeDate', function(selected){
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf() + 1)));
        $('#appointment_date').datepicker('setStartDate', startDate);
		$("#actual_time").val(dateDiffInDays($('#tried_to_book_date').val(), $('#appointment_date').val()));

    }); 
	$('#appointment_date').datepicker({
        startDate: startDate,
        endDate: ToEndDate,
        autoclose: true, 
		format: "yyyy-mm-dd"
    }).on('changeDate', function(selected){
        FromEndDate = new Date(selected.date.valueOf());
        FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
        $('#tried_to_book_date').datepicker('setEndDate', FromEndDate);
		$("#actual_time").val(dateDiffInDays($('#tried_to_book_date').val(), $('#appointment_date').val()));
    });
});

$('#btn-review-submit').on('click',function(){
        var msg = $('#new-review').val();
        var time = $('#actual_time').val();
		var tried_to_book_date = $('#tried_to_book_date');
		var appointment_date = $('#appointment_date');
        var flag =1;

        $('#err_msg').html('');
        $('#err_num').html('');
		$('#' + tried_to_book_date.attr("id") + "_err").html('');
		$('#' + appointment_date.attr("id") + "_err").html('');

        if(msg.trim() == '')
        {
            $('#err_msg').text('Lascia il feedback');
            flag =0;
        }
        if(time.trim() == '')
        {
            $('#err_num').text('Inserisci il tempo di attesa riscontrato');
            flag =0;
        }
        else if(time <= 0)
        {
            $('#err_num').text('Inserisci un tempo di attesa valido');
            flag =0;
        }
		if(tried_to_book_date.val().trim() == '')
		{
			$('#' + tried_to_book_date.attr("id") + "_err").text('Lascia il booking (tried) Date');
			flag =0;
		}	
		if(appointment_date.val().trim() == '')
		{
			$('#' + appointment_date.attr("id") + "_err").text('Lascia il appointment Date');
			flag =0;
		}	
        if(flag == 0)
            return false;
        else
            return true;
})
</script>
<style>

        .text-muted {
            color: #777;
        }
        .box.box-primary {
            border-top-color: #3c8dbc;
        }
        .box {
            background: #ffffff none repeat scroll 0 0;
            border-radius: 3px;
            border-top: 3px solid #d2d6de;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            position: relative;
            width: 100%;
        }
        .animated {
            -webkit-transition: height 0.2s;
            -moz-transition: height 0.2s;
            transition: height 0.2s;
        }

        .stars
        {
            margin: 20px 0;
            font-size: 24px;
            color: #d17581;
            cursor: pointer;
        }
	</style>
