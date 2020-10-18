
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
																			<div class="col-sm-8">	Attesa: <?php echo $structure->official_waiting_days; ?>-<b  class="color-neon"> 
																			<?php echo ($structure->official_waiting_days==null|| $structure->official_waiting_days==0) ? 'N/A':$structure->official_waiting_days.' giomi'  ?></b>
																			<?php $url = $structure->source; ?>
																			&nbsp;&nbsp;&nbsp;&nbsp; 
																			<a href="#" data-toggle="popover" data-placement="top" title="Info" data-html="true" data-content="<a target='_blank' href='<?php echo (strncasecmp('http://', $url, 7) && strncasecmp('https://', $url, 8) ? 'http://' : '').$url ?>'><?php echo $url ?></a> "><i class="fa fa-info-circle" aria-hidden="true"></i></a>
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
																			<div>Lascia it Feedback</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</li>
											<?php } ?>