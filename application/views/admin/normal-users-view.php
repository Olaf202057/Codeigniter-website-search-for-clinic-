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
						<div role="tabpanel" class="tab-pane fade in active " id="normalusers">
							<table class="table table-striped" id="tbl-users"> 
								<thead> 
									<tr> 
										<th>Email</th> 
										<th>First Name</th> 
										<th>Last Name</th> 
										<!-- <th>Role</th>  -->
										<th>Date of Brith</th> 
										<th>Status</th> 
										<th style="width: 186px;">Action</th>
									</tr> 
								</thead> 
								<tbody> 
									<?php foreach ($users as $key => $user) : ?>
									<tr>
										<td><a href="<?php echo base_url().'admin/hospital/'.$user->id; ?>"><?php echo $user->email ?></a></td>
										<td><?php echo $user->firstname ?></td> 
										<td><?php echo $user->lastname ?></td> 
										<?php if($user->dob == "" || $user->dob == '0000-00-00'){ ?>
										<td>-</td> 
										<?php }else{ ?>
										<td><?php   echo date('Y-m-d',strtotime($user->dob)); ?></td> 
										<?php } ?>
										<td><?php echo ($user->status==1) ? 'Email Confirm':'Pending Email Confirmation' ?></td> 
										
										<td><?php echo ($user->status==1) ? 'Email Confirm':'Pending Email Confirmation' ?></td> 
										<td>
                                            <div class="btn-group">
                                         <!--    <a class="btn btn-primary btn-sm" href="<?php echo base_url().'admin/userstats/'.($user->id); ?>">Stats</a> -->
											<button type="button" data-id="<?php echo $user->id ?>" class="btn <?php echo ($user->is_approved==1) ? '':'btn-success btn-approve-user' ?>  btn-sm">Approved</button>
											<!-- <a href="<?php echo base_url().'admin/hospital/'?><?php echo $user->id ?>" class="btn btn-info btn-sm">Hopital</a> -->
											<a href="<?php echo base_url().'admin/edit_normal_user/'?><?php echo $user->id ?>" class="btn btn-primary btn-sm">Edit</a>
											<button type="button" data-id="<?php echo $user->id ?>" class="btn btn-danger btn-remove-user btn-sm">Delete</button></div>
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