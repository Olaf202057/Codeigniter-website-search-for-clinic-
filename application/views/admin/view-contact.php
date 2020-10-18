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
				<div class="col-sm-12">	<b><h4>Contact Enquiry Details</h4></b></div>
				<br/>
				<div class="col-sm-12">
				    <div class="col-sm-3"><Label>First Name : </Label> </div>
				    <div class="col-sm-3"><?php echo $contact_details[0]['nome']; ?></div>
				 </div>
				 <br>
				 <div class="col-sm-12">
				   <div class="col-sm-3"><Label>Last Name : </Label> </div>
				   <div class="col-sm-3"><?php echo $contact_details[0]['cognome']; ?></div>
				</div>
				<br>
				<div class="col-sm-12">
				   <div class="col-sm-3"><Label> Email Address :</Label> </div>
				    <div class="col-sm-3"><?php echo $contact_details[0]['email']; ?></div>
				 </div>
				 <br>
				 <div class="col-sm-12">
				    <div class="col-sm-3"><Label>Indirizzo : </Label> </div>
				     <div class="col-sm-3"><?php echo $contact_details[0]['indirizzo']; ?></div>
				 </div>
				 <br>
				<div class="col-sm-12">
				    <div class="col-sm-3"><Label>Cap : </Label> </div>
				    <div class="col-sm-3"><?php echo $contact_details[0]['cap']; ?></div>
				 </div>
				 <br>
				 <div class="col-sm-12">
				    <div class="col-sm-3"><Label>Commune : </Label> </div>
				    <div class="col-sm-3"><?php echo $contact_details[0]['comune']; ?></div>
				 </div>
				 <br>
				<div class="col-sm-12">
				   <div class="col-sm-3"><Label>Province : </Label> </div>
				   	<div class="col-sm-3"><?php echo $contact_details[0]['prov']; ?></div>
				 </div>
				 <br>
				 <div class="col-sm-12">
				   <div class="col-sm-3"><Label>Cellulare : </Label> </div>
				   <div class="col-sm-3"><?php echo $contact_details[0]['cellulare']; ?></div>
				 </div>
				 <br>
				<div class="col-sm-12">
				   <div class="col-sm-3"><Label>Codice Fiscale : </Label> </div>
				   <div class="col-sm-3"><?php echo $contact_details[0]['codice_fiscale']; ?></div>
				 </div>
				 <br>
				 <div class="col-sm-12">
				   <div class="col-sm-3"><Label>Request Message : </Label> </div>
				   <div class="col-sm-3"><?php echo $contact_details[0]['request_message']; ?></div>
				 </div>
				<br>
			</div>
		</div>
				<div class="col-sm-1 col-sm-offset-1"><a href="<?php echo base_url().'admin/contactenquiries'; ?>" class="btn btn-primary btn-block">Back</a ></div>
	</div>