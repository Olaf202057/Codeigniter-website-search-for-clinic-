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
						<br />
						<div role="tabpanel" class="tab-pane fade " id="report">
							<table class="table table-striped"> 
								<thead> 
									<tr> 
										<th>Hospital Name</th> 
										<th>Reviews</th> 
										<th>Status</th> 
										<th>Action</th> 
									</tr> 
								</thead> 
								<tbody> 
									<tr>
										<td>Andalusia Regional Hospital</td> 
										<td>No reviews so far</td> 
										<td>Approved</td> 
										<td>
											<button type="button" class="btn btn-success btn-sm">Approved</button>
											<button type="button" class="btn btn-primary btn-sm">Edit</button>
											<button type="button" class="btn btn-danger btn-sm">Delete</button>
										</td> 
									</tr>
									<tr>
										<td>Athens-Limestone Hospital</td> 
										<td>No reviews so far</td> 
										<td>Pending</td> 
										<td>
											<button type="button" class="btn btn-success btn-sm">Approved</button>
											<button type="button" class="btn btn-primary btn-sm">Edit</button>
											<button type="button" class="btn btn-danger btn-sm">Delete</button>
										</td> 
									</tr>
									<tr>
										<td>Atmore Community Hospital</td> 
										<td>No reviews so far</td> 
										<td>Approved</td> 
										<td>
											<button type="button" class="btn btn-success btn-sm">Approved</button>
											<button type="button" class="btn btn-primary btn-sm">Edit</button>
											<button type="button" class="btn btn-danger btn-sm">Delete</button>
										</td> 
									</tr>
								</tbody> 
							</table>
						</div>
						<div role="tabpanel" class="tab-pane fade in active" id="hospitals">
						<table class="table table-striped" id="tbl-hospitals"> 
								<thead> 
									<tr> 
										<th>Hospital Name</th> 
										<th>Vat Number</th> 
										
									
										<th>Phone</th> 
										<th>Email</th> 
										<th>Action</th>
									</tr> 
								</thead> 
								<tbody> 
								<?php foreach ($structures as $key => $structure) : ?>
									<tr>
										<td><?php echo $structure->naming_struct ?></td> 
										<td><?php echo $structure->vat_number ?></td> 
									
										<td><?php echo $structure->phone ?></td> 
										<td><?php echo $structure->email ?></td> 
										
										<td>
											<button type="button" data-id="<?php echo $structure->id ?>" class="btn btn-success btn-sm">Approved</button>
											<button type="button" data-id="<?php echo $structure->id ?>" class="btn btn-primary btn-sm">Edit</button>
											<button type="button" data-id="<?php echo $structure->id ?>" class="btn btn-danger btn-sm">Delete</button>
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