
		<?php $get = $this->input->get(); ?>
	<div class="spacer">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="mod-box">
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
					<div id="search-form-box" style="text-align: center; padding-bottom: 10px;" class="hide">
				
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
					</div>
					<div class="blue-wrapper">
						<div class="row">
							<div class="col-sm-6 col-xs-4">
								<div class="dropdown">
									<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
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
							<div class="col-sm-6 col-xs-8">
								<div class="pull-right wow slideInUp">
									<div class="btn-group" role="group" aria-label="...">
										<a href="<?php echo base_url('search').'?'.$_SERVER['QUERY_STRING']; ?>" class="btn btn-default">Elenco</a>
										<a href="<?php echo base_url('map-search').'?'.$_SERVER['QUERY_STRING']; ?>"class="btn btn-default">Mappa</a>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="res-desc">
									<strong id="result-count"><?php echo $total_rows ?></strong>  risultati in <strong><?php echo $get['q'] ?>&nbsp;<?php echo $get['city'] ?></strong>,  in ordine di  <strong>Tempo di attesa</strong>
								</div>
							</div>
							<div class="col-sm-6">
								
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
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
								  <iframe src="/map_iframe.php?exam_ids=<?=$exam_ids_string?>" frameborder="0" scrolling="no" width="356" height="350" style="margin-left: -8px;"></iframe> 
								</div>
								
								<?php $this->load->view('home/include/search-filter-view') ?>
							</div>
							<div class="col-sm-8">
								<div class="row">
									<div class="col-sm-12">
										<input type="hidden" id="actual_link" value="<?php echo $actual_link ?>">
										<div class="sr-results" id="result-list">
											<ul>
											<?php foreach ($structures as $key => $structure) { 
												
												?>
												<li class="wow slideInUp">
													<div class="row">
														<div class="col-sm-3">
															<div class="img-result">
                                                                <img class="img-responsive col-sm-12" src="<?php echo ($structure->imageurl!=null) ? $structure->imageurl : base_url('assets/img/not-available.png') ?>" />
															</div>
														</div>
														<div class="col-sm-9">
																<div class="col-sm-12">
																	<div><strong><?php echo $structure->hospital ?> </strong></div>
																	<div style="font-size: 10px;">
																		<?php echo $structure->address ?> 
																		
																	</div>														
																</div>
															
																<div class="col-sm-12" style="padding: 0px; margin-top: 2px;">
																	<div class="col-sm-6" style="font-size: 11px;">
																		<?php echo $structure->exam_type ?>
																	</div>
																	<div class="col-sm-6">
																		
																		<div class="col-sm-6">
																				<div class="" style="font-size: 11px;">COSTO</div>
																				<div class="" style="font-size: 11px;"><b><?php echo ($structure->price==null) ? 'SSN':'€  '.$structure->price  ?></b></div>
																		</div>
																		<div class="col-sm-6" style="padding: 0px;">
																			
																				<div class="" style="font-size: 11px;">TEMPO DI ATTESA</div>
																				<div class="" style="font-size: 11px;" ><b><?php echo ($structure->official_waiting_days==null|| $structure->official_waiting_days==0) ? 'N/A':$structure->official_waiting_days.' giomi'  ?> </b></div>
																			
																		</div>
																		<div class="col-sm-12" >
																			<div class="btn-group" role="group" aria-label="...">
																			  	<a href="<?php echo base_url('map-search').'?exam_id='.$structure->exam_id; ?>" target="_blank" class="btn btn-default" style="font-size: 11px;" >Mappa</a>
																				<a href="<?php echo base_url() ?>hospitals/<?php echo $structure->id ?>?exam_id=<?php echo $structure->exam_id ?>"  class="btn btn-default" style="font-size: 11px;">Prenota ora</a>
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
