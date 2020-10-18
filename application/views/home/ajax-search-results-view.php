
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
																<div class="col-sm-7">
																	<div><strong  class="color-neon"><?php echo $structure->hospital ?> </strong></div>
																	<div style="font-size: 10px;" >
																		 <i class="fa fa-map-marker "></i> <?php echo $structure->address ?> <a href="<?php echo base_url('map-search').'?exam_id='.$structure->exam_id; ?>" target="_blank"  style="font-size: 11px;" >(Mappa)</a>
																		
																	</div>	
																	<div class="" style="font-size: 11px;">
																		<div><?php echo $structure->exam_type ?></div>
																		<div>
																			<a href="<?php echo base_url() ?>hospitals/<?php echo $structure->id ?>?exam_id=<?php echo $structure->exam_id ?>"  class="btn btn-default btn-neonblue" style="font-size: 11px;">Prenota ora</a>
																		</div>
																	</div>
																	<?php
																		$CI =& get_instance();
																		$CI->load->model('exam_model');
																		$result = $CI->exam_model->get_hospital_exam_last_review($structure->id, $structure->exam_id);
																		$result_count = $CI->exam_model->count_exam_hospital_review($structure->id, $structure->exam_id);
																		$waiting_days = 0;
																		if($result) {
																			$waiting_days = $result->actual_time;
																		}
																		//echo "<pre>"; print_r($result_count); echo "</pre>";
																		//echo "<pre>"; print_r($result); echo "</pre>";
																	?>													
																</div>
																<div class="col-sm-5" style="padding: 0px; margin-top: 2px; font-size: 12px;">

																	<div class="col-sm-5 text-right">	<b style="font-size: 17px; ">&euro;</b>: <b class="color-neon"><?php echo (($structure->price==null) || ($structure->price=='')) ? 'SSN':'€  '.$structure->price  ?></b></div>
																	<div class="col-sm-6 float-right">	<img src="<?php echo base_url('assets/img/watch_black.png'); ?>" width="14" /> : <b  class="color-neon"> 
																		<?php echo ($structure->official_waiting_days==null || $structure->official_waiting_days==0) ? 'N/A':$structure->official_waiting_days.' giomi'  ?></b>
																		<?php $url = $structure->source; ?>
																		&nbsp;&nbsp; 
																		<a href="javascript:void(0);" data-toggle="popover" data-trigger="hover" data-placement="top" title="Info" data-html="true" data-content="<a target='_blank' href='<?php echo (strncasecmp('http://', $url, 7) && strncasecmp('https://', $url, 8) ? 'http://' : '').$url ?>'><?php echo $url ?></a> "><i class="fa fa-info-circle" aria-hidden="true"></i></a>
																	</div>
																	

																	<div class="col-sm-11 result-border" style="font-size: 11px;background:#e8f6ff;">
																		<div class="row">
																			<div class="col-sm-12 text-center">	
																				<b class="color-neon">
																					Feedback degli utenti
																					&nbsp;&nbsp; 
																					<a href="javascript:void(0);" data-toggle="popover" data-trigger="hover" data-placement="top" title="Feedbacks" data-html="true" data-content="<?php echo $result_count->total_reviews; ?>"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
																				</b>
																			</div>
																			<div class="col-sm-12">	
																				<div class="row">
																					<div class="col-sm-6 text-right">
																						<?php	
																							if($waiting_days == "N/A") {
																								$black = 5;
																								$gray = 0;																				
																							} else if($waiting_days <= 15) {
																								$black = 5;
																								$gray = 0;
																							} else if($waiting_days <= 30) {
																								$black = 4;
																								$gray = 1;
																							} else if($waiting_days <= 60) {
																								$black = 3;
																								$gray = 2;
																							} else if($waiting_days <= 90) {
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
																					<div class="col-sm-6">
																						<?php																					
																							if($waiting_days == "N/A") {
																								echo $waiting_days;																			
																							} else if($waiting_days <= 15) {
																								echo "0-15 days";
																							} else if($waiting_days <= 30) {
																								echo "16-30 days";
																							} else if($waiting_days <= 60) {
																								echo "31-60 days";
																							} else if($waiting_days <= 90) {
																								echo "61-90 days";
																							} else {
																								echo "0-15 days";
																							}
																						?>
																					</div>
																				</div>
																			</div>
																			<div class="col-sm-12">	
																				<div class="row">
																					<div class="col-sm-6 text-right">																					
																						<?php 
																							//echo $structure->ratings;
																							$ratings = floor($structure->ratings);
																							//echo "<span>" . $structure->ratings . "</span> ";
																							//$temp_rating = 2.8;
																							$index =  round($structure->ratings * 2, 0);
																							//echo $index;
																						?>
																						<span class="score s<?php echo $index; ?>"></span>
																					</div>
																					<div class="col-sm-6">
																						<?php																					
																						
																							if($waiting_days == "N/A") {
																								echo $waiting_days;
																							} else if($index <= 5) {
																								echo "qualità bassa";
																							} else if($index <= 7) {
																								echo "qualità media";
																							} else if($structure->formula_rwt <= 10) {
																								echo "qualità alta";
																							}
																						?>
																					</div>
																				</div>
																			</div>
																			<div class="col-sm-12 text-center">
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