		<?php $get = $this->input->get(); ?>
	<div class="spacer">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<!--<div class="mod-box">
						<div class="row">
							<div class="col-sm-8">
								<p>
									Esame medico:<strong><?php echo $get['q'] ?></strong>
										Città:<strong><?php echo $get['city'] ?> </strong>
								</p>
							</div>
							<div class="col-sm-4">
								<button class="btn btn-primary pull-right" id="btn-search">
									<i class="fa fa-search"></i> Modifica
								</button>
							</div>
						</div>
					</div>
					-->
					<!---<div id="search-form-box" style="text-align: center; padding-bottom: 10px;" class="hide">
				
						<div class="row">
							<div class="col-sm-12">
								<form class="form-inline" method="get">
								  <div class="form-group">
								    <label  for="">Esame medico</label>
								    <input type="text" class="form-control" name="q"  value="<?php if(isset($get['q'])) echo $get['q'];  ?>" placeholder='Esame medico' >
								  </div>
                                    <?php if(!empty($common_names)): ?>
                                    <div class="form-group">
                                        <label  for="">nome comune</label>
                                        <select name="common_name"  class="form-control"  >
                                            <option value=""></option>
                                        <?php foreach($common_names as $row) : ?>
                                          <option <?php echo trim($common_name)==trim($row->common_name) ? "selected":"" ?> ><?php echo $row->common_name ?></option>
                                        <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <?php endif; ?>
								  <div class="form-group">
								    <label for="">Citta</label>
								    <input type="text" class="form-control" name="city" value="<?php echo $get['city'] ?>" placeholder="Citta">
								  </div>
								  
								  <button type="submit" class="btn btn-default">Ricerca</button>
								</form>
							</div>
						</div>
					</div> -->
					<div id="search-form-box" style="text-align: center; padding-bottom: 10px;">
						<form action="search" method="get">
							<div class="row">
								<div class="col-sm-5" style="padding-left: 0px;">
									<div class="form-group">
										<input type="text" name="q" class="form-control" value="<?php echo $get['q']; ?>" placeholder="Esame medico" id="search_q"/>
									</div>
								</div>
								<div class="col-sm-5">
									<div class="form-group">
										<input type="text" name="city" class="form-control" value="<?php echo $get['city']; ?>" placeholder="Citta" id="search_city" />
									</div>
								</div>
								<div class="col-sm-2 text-right">
									<div class="form-group">
										<button type="submit" class="btn btn-darkblue" style="padding-left: 20px; padding-right: 20px;">ricerca</button>
									</div>
								</div>
							</div>
						</form>
					</div>
					
					
					
					<div class="row" style="   margin-bottom: 5px;">
						<div class="col-md-6" style="padding-left: 0px">
							<div class="pull-left" style="color:#02304f;    font-size: 12px;">
									<strong id="result-count"><?php echo $total_rows ?></strong>  risultati in <strong><?php echo $get['q'] ?>&nbsp;<?php echo $get['city'] ?></strong>,  in ordine di  <strong>Tempo di attesa</strong>
								</div>
						</div>
						<div class="col-md-6">
								<div class="dropdown pull-right">
									<button class="btn btn-sm btn-darkblue dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
										Ordina per
									<span class="caret"></span>
									</button>
									<ul class="dropdown-menu js-result-order" aria-labelledby="dropdownMenu1">
										<li <?php if(isset($get_params['sort']) && $get_params['sort'] == 'default') { ?> class="active" <?php } ?>><a href="javascript:void(0);" data-value="default">Default</a></li>
										<li <?php if(isset($get_params['sort']) && $get_params['sort'] == 'costo') { ?> class="active" <?php } ?>><a href="javascript:void(0);" data-value="costo">costo</a></li>
										<li <?php if(isset($get_params['sort']) && $get_params['sort'] == 'suggerito') { ?> class="active" <?php } ?>><a href="javascript:void(0);" data-value="suggerito">suggerito dagli utenti</a></li>
									</ul>
								</div>
						</div>
					</div>
					<div class="">
						
						
						<div class="row">
							<div class="col-sm-4 left-nav-border">

								<div class="row wow slideInUp" style="padding: 0px 10px;">
									<a href="<?php echo base_url('search').'?'.$_SERVER['QUERY_STRING']; ?>" class="col-md-6 btn-neonblue" style="   padding: 10px 0; border-color: #ddd -moz-use-text-color #ddd #ddd;    border-image: none;    border-style: solid none solid solid;    border-width: 1px medium 1px 1px;">Elenco</a>
									<a href="<?php echo base_url('map-search').'?'.$_SERVER['QUERY_STRING']; ?>"class="col-md-6  btn-white" style="   padding: 10px 0;border:1px solid #ddd;">Mappa</a>
								</div>
								<div class=" wow slideInUp ">

									<h4 class="mappa-label">Mappa</h4>
									<img src="<?php echo base_url('assets/images/line.png') ?>"  style="width:100%" />	
									<div class=" wow slideInUp"  >
										<?php 
									$exam_ids = array();
									/*echo " <pre>";
									print_r($structures);
									exit();*/
									foreach ($structures as $key => $structure) : 
										$exam_ids[] = $structure->exam_id;
									endforeach;
									if ($exam_ids) {
										$exam_ids_string = implode(',', $exam_ids);
									}
									 ?>
									  <iframe src="<?php echo base_url(); ?>map_iframe.php?exam_ids=<?=$exam_ids_string?>" frameborder="0" scrolling="no" width="100%" height="350" style="margin-left: -5px; "></iframe> 
									</div>
									
									<?php $this->load->view('home/include/search-filter-view') ?>
								</div>
							</div>
							<div class="col-sm-8">
								<div class="row">
									<div class="col-sm-12">
										<input type="hidden" id="actual_link" value="<?php echo $actual_link ?>">
										<div class="sr-results" id="result-list">
											<ul>
											<?php foreach ($structures as $key => $structure) {  ?>
												<li class="wow slideInUp result-border">
													<div class="row">
														<div class="col-sm-3">
															<div class="img-result">
                                                                <img class="img-responsive img-thumbnail col-sm-12" src="<?php echo ($structure->imageurl!=null) ? $structure->imageurl : base_url('assets/img/not-available.png') ?>" />
															</div>
														</div>
														<div class="col-sm-9">
																<div class="row">
																<div class="col-sm-8">
																	<div><strong  class="color-neon"><?php echo $structure->hospital ?> </strong></div>
																	<div style="font-size: 10px;" >
																		 <i class="fa fa-map-marker "></i> <?php echo $structure->address ?> <a href="<?php echo base_url('map-search').'?exam_id='.$structure->exam_id; ?>" target="_blank"  style="font-size: 11px;" >(Mappa)</a>
																		
																	</div>	
																	<div class="" style="font-size: 11px;">
																		<div><?php echo $structure->exam_type ?></div>
																		<div class="row">

																			<div class="col-sm-4">	&euro;: <b class="color-neon"><?php echo (($structure->price==null) || ($structure->price=='')) ? 'SSN':'€  '.$structure->price  ?></b></div>
																			<div class="col-sm-8">	Attesa: <b  class="color-neon"> 
																			<?php echo ($structure->official_waiting_days==null || $structure->official_waiting_days==0) ? 'N/A':$structure->official_waiting_days.' giomi'  ?></b>
																			<?php $url = $structure->source; ?>
																			&nbsp;&nbsp;&nbsp;&nbsp; 
																			<a href="javascript:void(0);" data-toggle="popover" data-trigger="hover" data-placement="top" title="Info" data-html="true" data-content="<a target='_blank' href='<?php echo (strncasecmp('http://', $url, 7) && strncasecmp('https://', $url, 8) ? 'http://' : '').$url ?>'><?php echo $url ?></a> "><i class="fa fa-info-circle" aria-hidden="true"></i></a>
																			</div>
																			
																		
																		</div>
																		<div>
																			<a href="<?php echo base_url() ?>hospitals/<?php echo $structure->id ?>?exam_id=<?php echo $structure->exam_id ?>"  class="btn btn-default btn-neonblue" style="font-size: 11px;">Prenota ora</a>
																		</div>
																	</div>													
																</div>
																<div class="col-sm-4" style="padding: 0px; margin-top: 2px;">
																	<div class="row">
																		<div class="col-sm-10" style="position: relative; padding-right: 7px;text-align:right;">
																			
																			<?php 
																				//echo $structure->ratings;
																				$ratings = floor($structure->ratings);
																				echo "<span>" . $structure->ratings . "</span> ";
																				//$temp_rating = 2.8;
																				$index =  round($structure->ratings * 2, 0);
																			?>
																			<span class="score s<?php echo $index; ?>"></span>
																		</div>
																		<div class="col-sm-10 result-border" style="font-size: 11px;background:#e8f6ff;">
																			<div class="row">
																				<div class="col-sm-8">
																					<div><b class="color-neon">
																					
																					<?php
																						if($structure->formula_rwt <= 3) {
																							echo "Alta velocità";
																						} else if($structure->formula_rwt <= 6) {
																							echo "Media velocità";
																						} else if($structure->formula_rwt <= 10) {
																							echo "Bassa velocità";
																						}
																					?>
																					</b> </div>
																					<div>Feedbacks : 100</div>
																				</div>
																				<div class="col-sm-3">
																					<div class="label-ratings"><?php echo $structure->formula_rwt; ?></div>
																				</div>
																			</div>
																			<div>
																				<a data-target="#ratingModal" class="init-modal" data-strictureid="<?php echo $structure->id; ?>" data-examid="<?php echo $structure->exam_id; ?>">Lascia it Feedback</a>																			
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</li>
											<?php } ?>
											</ul>
										</div>
									</div>
								</div>
								
								<br />
								
								<div class="row">
									<div class="col-sm-12" id="result-pagination">
										<?php echo $pagination_links ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


<!-- Modal -->
<div id="ratingModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
	
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Feedback</h4>
			</div>
			<div class="modal-body">
				<div id="review-msg"></div>
				<div class="row" id="post-review-box">
					<div class="col-md-12">
						<form id="frm-review" method="post">
							<div class="col-md-12">
								<input id="ratings-hidden" name="rating" type="hidden" value="0">
								<input value="" name="structure_id" id="feedback_structure_id" type="hidden">
								<input value="" name="exam_id" id="feedback_exam_id" type="hidden">
								<label>Feedbacks</label>
								<textarea class="form-control animated" cols="50" id="new-review" name="comment"  placeholder="Enter your review here..." rows="5"></textarea>
								<div class="text-danger" id="err_msg"></div>
							</div>
							<div class="col-md-6">
								<label>Date Tried To book</label><input type="text" class="form-control" name="tried_to_book_date" id="tried_to_book_date"/>
								<div class="text-danger" id="tried_to_book_date_err"></div>
							</div>	
							<div class="col-md-6">
								<label>Appointment Date</label><input type="text" class="form-control" name="appointment_date" id="appointment_date"/>
								<div class="text-danger" id="appointment_date_err"></div>
							</div>
							<div class="col-md-6">
								<label>Tempo di attesa riscontrato</label><input readonly="readonly" type="number" min="0" class="form-control" value="0" name="actual_time" id="actual_time"/>
								<div class="text-danger" id="err_num"></div>
							</div>
				
							<div class="col-md-6">
								<div class="text-right">
									<div class="stars starrr" data-rating="0"></div>
									<p>&nbsp;</p>
									<?php /*?><a class="btn btn-danger btn-sm" href="#" id="close-review-box" style="display:none; margin-right: 10px;">
									<span class="fa fa-remove"></span>Cancella</a><?php */?>
				
									<button class="btn btn-success btn-lg" id="btn-review-submit" type="button">Salva</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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


	/*$("#tried_to_book_date").datepicker({
		format: "yyyy-mm-dd",
    	autoclose: true
	});
	$("#appointment_date").datepicker({
		format: "yyyy-mm-dd",
    	autoclose: true
	});*/	
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
});
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});
</script>

<style>
	.datepicker.datepicker-dropdown { z-index: 9999 !important; }
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

