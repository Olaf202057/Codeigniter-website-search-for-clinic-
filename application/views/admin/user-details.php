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
			</div>
			<div class="row">
				<div class="col-sm-12">	<b><h4>User Details</h4></b></div>
				<br/>
				<div class="col-sm-12">	<b><h5>Personal Information</h5></b></div>
				<div class="col-sm-12">
				    <div class="col-sm-3"><Label>First Name : </Label> </div>
				    <div class="col-sm-3"><?php echo $user_info[0]['firstname']; ?></div>
				 </div>
				 <br>
				 <div class="col-sm-12">
				   <div class="col-sm-3"><Label>Last Name : </Label> </div>
				   <div class="col-sm-3"><?php echo $user_info[0]['lastname']; ?></div>
				</div>
				<br>
				<div class="col-sm-12">
				   <div class="col-sm-3"><Label> Email Address :</Label> </div>
				    <div class="col-sm-3"><?php echo $user_info[0]['email']; ?></div>
				 </div>
				 <br>
				 <div class="col-sm-12">
				    <div class="col-sm-3"><Label>Registration Type : </Label> </div>
				     <div class="col-sm-3"><?php echo ucfirst($user_info[0]['register_type']); ?></div>
				 </div>
				 <br>
				<div class="col-sm-12">	<b><h5>Billing Details</h5></b></div>
				<br>
				<div class="col-sm-12">
				    <div class="col-sm-3"><Label>Business Name : </Label> </div>
				     <div class="col-sm-3"><?php if($user_info[0]['business_name'] != ''){ echo ucfirst($user_info[0]['business_name']); } else { echo 'Not Available'; } ?></div>
				 </div>
				 <div class="col-sm-12">
				 	<?php $country_name = $this->master_model->getRecords('countries',array('id'=>$user_info[0]['country'])); ?>
				    <div class="col-sm-3"><Label>Country : </Label> </div>
				     <div class="col-sm-3"><?php if(isset($country_name[0]['name']) && $country_name[0]['name'] != ''){ echo ucfirst($country_name[0]['name']); } else { echo 'Not Available'; } ?></div>
				 </div>
				 <div class="col-sm-12">
				 	<?php $state_name = $this->master_model->getRecords('states',array('id'=>$user_info[0]['state'])); ?>
				    <div class="col-sm-3"><Label>State : </Label> </div>
				     <div class="col-sm-3"><?php if(isset($state_name[0]['name']) && $state_name[0]['name'] != ''){ echo ucfirst($state_name[0]['name']); } else { echo 'Not Available'; } ?></div>
				 </div>
				 <div class="col-sm-12">
				 	<?php $city_name = $this->master_model->getRecords('cities',array('id'=>$user_info[0]['city'])); ?>
				    <div class="col-sm-3"><Label>City : </Label> </div>
				     <div class="col-sm-3"><?php if(isset($city_name[0]['name']) && $city_name[0]['name'] != ''){ echo ucfirst($city_name[0]['name']); } else { echo 'Not Available'; } ?></div>
				 </div>
				 <div class="col-sm-12">
				 	<div class="col-sm-3"><Label>Postal Code : </Label> </div>
				     <div class="col-sm-3"><?php if($user_info[0]['postal_code'] != ''){ echo ucfirst($user_info[0]['postal_code']); } else { echo 'Not Available'; } ?></div>
				 </div>
			</div>
		</div>
				<div class="col-sm-1 col-sm-offset-1"><a href="<?php echo base_url().'admin/'; ?>" class="btn btn-primary btn-block">Back</a ></div>
	</div>