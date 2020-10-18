
	<!-- <div class="page-title">
		<div class="container">
			<div class="row">
				<div class="col-sm-12"><?php echo ucfirst($this->session->userdata('user')->firstname).' '.ucfirst($this->session->userdata('user')->lastname); ?></div>
			</div>
		</div>
	</div> -->


	
	<div class="spacer">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<!-- Nav tabs -->

                    <?php $this->load->view('user-menu'); ?>

					<!-- Tab panes -->
					<div class="tab-content">
						
						<div role="tabpanel" class="tab-pane fade in active " id="hospitals">
						<div class="row"  style="margin-top:5px;" >
                          <div class="col-sm-6">
                            <div class="input-group">
                              <input type="text" class="form-control" id="txt-search" value="<?php echo $this->input->get("q") ?>" placeholder="Search for...">
                              <span class="input-group-btn">
                                <button class="btn btn-default" id="btn-search-structure" type="button"></button>
                              </span>
                            </div>  <!-- /input-group -->
                          </div><!-- /.col-lg-6 -->
                        <div class="col-sm-6">
                          <a class="btn btn-primary btn-sm" type="button" href="<?php echo base_url().'hospital/add'; ?>" >Add</a> 
                        </div>
                        </div>
						<table class="table table-striped" id="tbl-hospitals"> 
								<thead> 
									<tr> 
										<th>Hospital Name</th>
										<th>Address</th>
										<th>Telephone</th> 
										<th>Email</th> 
										<th>Website</th>
										<th style="width: 177px">Action</th>
									</tr> 
								</thead> 
								<tbody> 
								<?php
								 if(count($structures)>0){
								 foreach ($structures as $hospitals) : ?>
									<tr>
										<td><?php echo $hospitals['hospital']; ?></td>
										<td><?php echo $hospitals['address']; ?></td>
										<td><?php echo $hospitals['telephone']; ?></td> 
										<td><?php echo $hospitals['email']; ?></td>
										<td><?php echo $hospitals['website']; ?></td>
										<td>
                                            <div class="btn-group">
											<a href="<?php echo base_url().'hospital/edit/'.$hospitals['id'] ?>" type="button" data-id="<?php echo $hospitals['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                            <a href="<?php echo base_url().'exam?structure='.$hospitals['id'] ?>" type="button" data-id="<?php echo $hospitals['id']; ?>" class="btn btn-info btn-sm">Exams</a>
											<button type="button" data-id="<?php echo $hospitals['id'] ?>" class="btn btn-remove-structure btn-danger btn-sm">Delete</button>
                                            </div>
										</td> 
									</tr>
									
								<?php endforeach; } else { ?>
										<tr><td>You have not added any hospitals.</td></tr>
								<?php } ?>
									
								
								</tbody> 
							</table>
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