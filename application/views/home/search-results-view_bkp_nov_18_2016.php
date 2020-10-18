
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
									<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
										<li><a href="#">Default</a></li>
										<li><a href="#">costo</a></li>
										<li><a href="#">suggerito dagli utenti</a></li>
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
									  <iframe src="/map_iframe.php?exam_ids=<?=$exam_ids_string?>" frameborder="0" scrolling="no" width="100%" height="350" style="margin-left: -5px; "></iframe> 
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
											<?php foreach ($structures as $key => $structure) { 
												
												?>
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

																			<div class="col-sm-4">	&euro;: <b class="color-neon"><?php echo ($structure->price==null) ? 'SSN':'€  '.$structure->price  ?></b></div>
																			<div class="col-sm-8">	Attesa: <b  class="color-neon"> 
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
																		<div class="col-sm-10 " style="padding-right: 7px;text-align:right;">
																			<?php 
																				if($structure->ratings>0){
																					for($x =0; $x<$structure->ratings;$x++){
																					
																						echo '<i class="fa fa-star color-darkblue"></i>';
																					}
																				}
																				$less_star = 5-$structure->ratings;

																				if($less_star>0){
																					for($x =0; $x<$less_star;$x++){
																					
																						echo '<i class="fa fa-star-o color-gray"></i>';
																					}
																				}
																				?>

																		</div>
																		<div class="col-sm-10 result-border" style="font-size: 11px;background:#e8f6ff;">
																			<div class="row">
																				<div class="col-sm-8">
																					<div><b class="color-neon">Alta velocità</b> </div>
																					<div>Feedbacks : 100</div>
																				</div>
																				<div class="col-sm-3">
																					<div class="label-ratings">8.6</div>
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
