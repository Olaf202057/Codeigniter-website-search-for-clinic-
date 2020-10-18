

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

                    <?php if($this->session->flashdata('success')!='') {?>
		            <div class="alert alert-success text-center"><?php echo $this->session->flashdata('success');?></div>
		            <?php } else if($this->session->flashdata('error')!=''){?>
		            <div class="alert alert-danger text-center"><?php echo $this->session->flashdata('error');?></div>
		         <?php } ?>
					<!-- Tab panes -->
					<div class="tab-content">
						<br />
						<div role="tabpanel" class="tab-pane fade in active " id="users">
						<div class="table-responsive">
							<table class="table table-striped" id="tbl-users"> 
								<thead> 
									<tr> 
										<th>Email</th> 
										<th>First Name</th> 
										<th>Last Name</th> 
										<!-- <th>Role</th>  -->
										<th>Date of Brith</th> 
										<th>Status</th> 
										<th style="width: 350px;">Action</th>
									</tr> 
								</thead> 
								<tbody> 
									<?php foreach ($users as $key => $user) : ?>
									<tr>
										<td><a href="<?php echo base_url().'admin/hospital/'.$user->id; ?>"><?php echo $user->email ?></a></td>
										<td><?php echo $user->firstname ?></td> 
										<td><?php echo $user->lastname ?></td> 
										<!-- <td><?php echo ($user->role==2) ? 'Advertiser' :'Admin' ?></td>  -->
										<?php if($user->dob == ""){?>
										<td>-</td> 
										<?php }else{ ?>
										<td><?php   echo date('Y-m-d',strtotime($user->dob)); ?></td> 
										<?php } ?>
										<td><?php echo ($user->status==1) ? 'Email Confirm':'Pending Email Confirmation' ?></td> 
										<td>
                                            <div class="btn-group">
                                            <a class="btn btn-success btn-sm"  data-price="<?php echo $user->clicks_price;?>"  data-id="<?php echo $user->id;?>"  data-name ="<?php echo $user->firstname.' '.$user->lastname;?>"  class="btn btn-primary btn-sm"   data-target="#model" data-toggle="modal" onclick="return getprice(this);">Click Price</a>
                                            <a class="btn btn-primary btn-sm" href="<?php echo base_url().'admin/userstats/'.($user->id); ?>">Stats</a>
											<button type="button" data-id="<?php echo $user->id ?>" class="btn <?php echo ($user->is_approved==1) ? 'disabled approveClass':'btn-success btn-approve-user ' ?>  btn-sm"><?php echo ($user->is_approved==1) ? 'Approved':'Approve' ?></button>
											<!-- <a href="<?php echo base_url().'admin/hospital/'?><?php echo $user->id ?>" class="btn btn-info btn-sm">Hopital</a> -->
											<a href="<?php echo base_url().'admin/edit_user/'?><?php echo $user->id ?>" class="btn btn-primary btn-sm">Edit</a>
											<button type="button" data-id="<?php echo $user->id ?>" class="btn btn-danger btn-remove-user btn-sm">Delete</button></div>
										</td> 
									</tr>
									
								<?php endforeach; ?>
								</tbody> 
							</table>
							</div>
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



<div aria-hidden="false" style="display: none;" id="model" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel2"><b>Click Price </b></h3>
            </div>
            <form method="post" action="<?php echo base_url();?>admin/set_price" >
                <div class="modal-body">
                   <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label" for="port">User Name : <span class="error">*</span> </label>
                        <input type="hidden" id="user_id" name="user_id" >
                        <div class="col-sm-9 col-lg-6 controls">
                            <input  type="text" class="form-control" name="user_name" id="user_name" placeholder="User Name" readonly />
                            <div class="error" id="err_exam_type_edit"><?php echo form_error('user_name'); ?></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label" for="port">Price: <span class="error">*</span> </label>
                        <div class="col-sm-9 col-lg-6 controls">
                            <input  type="number" class="form-control"  name="price" id="price" placeholder="Price"  />
                            <div class="error" id="err_price"><?php echo form_error('price'); ?></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                     
                
                <div style="text-align:left;" class="modal-footer">
                    <div class="col-sm-12">
                        <button class="btn btn-primary" type="submit" name="btn_price" id="btn_price" ><i class="fa fa-check"></i>Save</button>
                        <button class="btn" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
 function getprice(obj){
            var id   = $(obj).attr('data-id');
            var price = $(obj).attr('data-price');
             var name = $(obj).attr('data-name');
             
            if(id.trim()=='')
            {
              alert("something wrong");
            }
            else
            {
              $('#user_id').val(id);
              $('#price').val(price);
              $('#user_name').val(name);
            }
         
          }


          $('#btn_price').on('click',function(){
          	var price = $('#price').val();
          	if(price.trim()=='')
          	{
          		$('#err_price').html('Please enter price');
          		return false;
          	}
          	else
          		return true;
          })

</script>