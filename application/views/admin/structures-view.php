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
						
						<div role="tabpanel" class="tab-pane fade in active " id="hospitals">
						<div class="row"  style="margin-top:5px;" >
                          <div class="col-sm-6">
                            <div class="input-group">							  
								  <input type="text" class="form-control" id="txt-search" value="<?php echo $this->input->get("q") ?>" placeholder="Search for...">
								  <span class="input-group-btn">
								  <button class="btn btn-default" id="btn-search-structure" type="button">Go!</button>
								  </span>
							  
                            </div><!-- /input-group -->
							
							<div class="row" style="margin-top: 15px;">
								<div class="col-sm-6">
									<select name="column" id="sorting-column" class="form-control">
										<?php foreach($columns_array as $ck => $cv) { ?>
										<option value="<?php echo $ck; ?>" <?php if($this->input->get("column") == $ck) { ?> selected="selected"<?php } ?>><?php echo $cv; ?></option>
										<?php } ?>
									</select>	
								</div>
								<div class="col-sm-6">							  
									<select name="order" id="sorting-order" class="form-control">
										<option value="asc" <?php if($this->input->get("order") == "asc") { ?> selected="selected"<?php } ?>>ASC</option>
										<option value="desc" <?php if($this->input->get("order") == "desc") { ?> selected="selected"<?php } ?>>DESC</option>
									</select>
								</div>
							</div>					
                          </div><!-- /.col-lg-6 -->
                        <div class="col-sm-6">
                          <a class="btn btn-primary btn-sm" type="button" href="<?php echo base_url().'admin/add_structures'; ?>" >Add</a> 
                        </div>
                        </div>
						<table class="table table-striped" id="tbl-hospitals"> 
								<thead> 
									<tr> 
										<th>Hospital Name</th>
										<th>Address</th>
										<th>City</th>
										<th>Province</th>
										<th>Region</th>
										<th>Latitude</th>
										<th>Longitude</th>
										<th>Telephone</th> 
										<th>Website</th>  
										<th>Logo</th> 
										<th>Email</th> 
										<th>Owner ID</th>
										<th>Last update</th>
										<th style="width: 177px">Action</th>
									</tr> 
								</thead> 
								<tbody> 
								<?php foreach ($structures as $key => $structure) : ?>
									<tr>
										<td><?php echo $structure->hospital; ?></td>
										<td><?php echo $structure->address; ?></td>
										<td><?php echo $structure->city; ?></td>
										<td><?php echo $structure->province; ?></td>
										<td><?php echo $structure->region; ?></td>
										<td><?php echo $structure->latitude; ?></td>
										<td><?php echo $structure->longitude; ?></td>
										<td><?php echo $structure->telephone; ?></td> 
										<td><?php echo $structure->website; ?></td>
										<td>
											<?php if(!empty($structure->image_url)) { ?>
											<img alt="no logo" src="<?php echo $structure->image_url; ?>" width="50" />
											<?php } ?>
										</td>
										<td><?php echo $structure->email; ?></td>
										<td><?php echo $structure->firstname; ?></td>
										<td><?php echo date("F d, Y", strtotime($structure->lastupdated)); ?></td>
										<td>
                                            <div class="btn-group">
											<a href="<?php echo base_url().'admin/edit_structures/'.$structure->id ?>" type="button" data-id="<?php echo $structure->id ?>" class="btn btn-primary btn-sm">Edit</a>
                                                <a href="<?php echo base_url().'admin/exams?structure='.$structure->id ?>" type="button" data-id="<?php echo $structure->id ?>" class="btn btn-info btn-sm">Exams</a>
											<button type="button" data-id="<?php echo $structure->id ?>" class="btn btn-remove-structure btn-danger btn-sm">Delete</button>
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
