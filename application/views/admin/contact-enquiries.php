<div class="page-title">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">Administrator</div>
			</div>
		</div>
	</div>
	
	<div class="spacer">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<!-- Nav tabs -->
                    <?php $this->load->view('admin/include/admin-menu-view') ?>

					<!-- Tab panes -->
					<div class="tab-content">
						
						<div role="tabpanel" class="tab-pane fade in active " id="enquiries">
						<div class="row"  style="margin-top:5px;" >
                          <div class="col-sm-6">
                           	
                           </div>
                        
                        </div>
						<table class="table table-striped" id="tbl-hospitals"> 
								<thead> 
									<tr> 
										<th>First Name</th>
										<th>Last Name</th>
										<th>Email</th> 
										<th>Message</th> 
										<th>Contact Number</th>
										<th style="width: 177px">Action</th>
									</tr> 
								</thead> 
								<tbody> 
								<?php foreach ($contact_details as $details) : ?>
									<tr>
										<td><?php echo $details['nome']; ?></td>
										<td><?php echo $details['cognome']; ?></td>
										<td><?php echo $details['email']; ?></td> 
										<td><?php echo $details['request_message']; ?></td>
										<td><?php echo $details['cellulare']; ?></td>
										<td>
                                            <div class="btn-group">
											<a href="<?php echo base_url().'admin/replytocontact/'.$details['id']; ?>" type="button"  class="btn btn-primary btn-sm">Reply</a>
                                            <a href="<?php echo base_url().'admin/viewcontact/'.$details['id']; ?>" type="button"  class="btn btn-info btn-sm">View</a>
											<!-- <button type="button" data-id="<?php echo base_url().'admin/deletecontact/'.$details['id']; ?>" class="btn btn-remove-structure btn-danger btn-sm">Delete</button> -->
                                            </div> 
										</td> 
									</tr>
									
								<?php endforeach; ?>
									
								
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
