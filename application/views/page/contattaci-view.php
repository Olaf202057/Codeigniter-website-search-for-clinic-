<?php echo validation_errors(); ?>
	<?php echo $this->session->flashdata('message'); ?>
	<form class="form-horizontal" method="post">
	<div class="spacer">
		<div class="container">
			<div class="row">
				<?php echo $contattaci_1->content ?>
			</div>
			<div class="row">
				
				<div class="col-sm-12">	<h4>I tuoi dati anagrafici</h4></div>
				
				<div class="col-sm-12">	
					<div class="col-sm-6">
					    <input  type="text" class="form-control" value="<?php if(isset($this->session->userdata('user')->firstname) && $this->session->userdata('user')->firstname != ''){ echo $this->session->userdata('user')->firstname; } ?><?php echo set_value('nome'); ?>" id="fname" name="nome" placeholder="NOME">
					 	<span class="text-danger" id="err_fname"><?php echo form_error('nome'); ?></span>
					 </div>
					 <div class="col-sm-6">
					    <input  type="text" class="form-control"  value="<?php if(isset($this->session->userdata('user')->lastname) && $this->session->userdata('user')->lastname != ''){ echo $this->session->userdata('user')->lastname; } echo set_value('cognome'); ?>" id="lname" name="cognome" placeholder="COGNOME">
						<span class="text-danger" id="err_lname"><?php echo form_error('cognome'); ?></span>
					 </div>
				</div>
				<div class="col-sm-12" style="margin-top:10px;">	
					<div class="col-sm-6">
					    <input  type="text" class="form-control"  value="<?php echo set_value('indirizzo'); ?>" id="address" name="indirizzo" placeholder="INDIRIZZO">
					 	<span class="text-danger" id="err_address"><?php echo form_error('indirizzo'); ?></span>
					 </div>
					 <div class="col-sm-3">
					    <input  type="text" class="form-control"  value="<?php echo set_value('cap'); ?>" name="cap" id="capital" placeholder="CAP">
					 	<span class="text-danger" id="err_capital"><?php echo form_error('cap'); ?></span>
					 </div>
				</div>
				<div class="col-sm-12" style="margin-top:10px;">	
					<div class="col-sm-6">
					    <input type="text" class="form-control"  value="<?php echo set_value('comune'); ?>" name="comune" id="comune" placeholder="COMUNE">
					 	<span class="text-danger" id="err_comune"><?php echo form_error('comune'); ?></span>
					 </div>
					 <div class="col-sm-3">
					    <input  type="text" class="form-control"  value="<?php echo set_value('prov'); ?>" name="prov" id="province" placeholder="PROV">
					 	<span class="text-danger" id="err_province"><?php echo form_error('prov'); ?></span>
					 </div>
				</div>
				<div class="col-sm-12" style="margin-top:10px;">	
					<div class="col-sm-6">
					    <input  type="text" class="form-control"  value="<?php echo set_value('cellulare'); ?>" name="cellulare" id="cellulare" placeholder="CELLULARE" maxlength="10">
					 	<span class="text-danger" id="err_cellulare"><?php echo form_error('cellulare'); ?></span>
					 </div>
					 <div class="col-sm-6">
					    <input  type="text" class="form-control"  value="<?php echo set_value('codice_fiscale'); ?>" name="codice_fiscale" id="codice_fiscale" placeholder="CODICE FISCALE">
					 	<span class="text-danger" id="err_codice"><?php echo form_error('codice_fiscale'); ?></span>
					 </div>
				</div>
				<div class="col-sm-12" style="margin-top:10px;">	
					<div class="col-sm-6">
					    <input  type="email" class="form-control" value="<?php if(isset($this->session->userdata('user')->email) && $this->session->userdata('user')->email != ''){ echo $this->session->userdata('user')->email; } ?><?php echo set_value('email'); ?>"  name="email" id="email" placeholder="E-MAIL">
					 	<span class="text-danger" id="err_email"><?php echo form_error('email'); ?></span>
					 </div>
					 <div class="col-sm-6">
					    <input  type="email" class="form-control" value="<?php if(isset($this->session->userdata('user')->email) && $this->session->userdata('user')->email != ''){ echo $this->session->userdata('user')->email; } ?><?php echo set_value('confirm_email'); ?>"  name="confirm_email" id="confirm_email" placeholder="CONFERMA E-MAIL">
					 	<span class="text-danger" id="err_confirm_email"><?php echo form_error('confirm_email'); ?></span>
					 </div>
				</div>
			
				<div class="col-sm-12">	<h4>La Tua richiesta</h4></div>
				<div class="col-sm-12"  style="margin-top:10px;">	
					<textarea class="form-control" name="request_message" id="request_message" style="height: 260px;"><?php echo set_value('request_message'); ?></textarea>
					 <span class="text-danger" id="err_message"><?php echo form_error('request_message'); ?></span>
				</div>
				
			</div>
			<div class="row">
			<br/><br/>
				<?php echo $contattaci_2->content ?>
			</div>
			<div class="row">

				<p><b>Accetto il trattamento dei dati personali nel rispetto del D.lgs. 196/2003 e dellecondizioni generali.</b></p>
				<div><label><input type="radio" name="accept" value="1" />Accetto<label></div>
				<div><label><input type="radio" name="accept" value="0" />Non accetto<label></div>
				<span class="text-danger" id="err_term"></span>
				<div><button type="submit" id="btn_contact_us" class="btn btn-danger pull-right">invia la tua richiesta</button></div>
			</div>
		</div>
	</div>

	</form>

<script type="text/javascript">
	$('#btn_contact_us').on('click',function(){
		var fname 			= $('#fname').val();
		var lname 			= $('#lname').val();
		var address		    = $('#address').val();
		var capital 		= $('#capital').val();
		var comune 			= $('#comune').val();
		var province 		= $('#province').val();
		var cellulare 		= $('#cellulare').val();
		var codice_fiscale 	= $('#codice_fiscale').val();
		var email 			= $('#email').val();
		var confirm_email 	= $('#confirm_email').val();
		var request_message = $('#request_message').val();
		var filter        	= /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var flag 			= 1;
		var accept   		= $("input[type='radio'][name='accept']:checked").length;
		

		if(fname == '')
		{
			$('#err_fname').text('Please enter first name.');
			flag = 0;
		}
		else 
		{
			$('#err_fname').text('');
		}
		if(lname == '')
		{
			$('#err_lname').text('Please enter last name.')	;
			flag = 0;
		}
		else 
		{
			$('#err_lname').text('');
		}
		if(address == '')
		{
			$('#err_address').text('Please enter address.');
			flag = 0;
		}
		else 
		{
			$('#err_address').text('');
		}
		if(capital == '')
		{
			$('#err_capital').text('Please enter cap');
			flag = 0;
		}
		else 
		{
			$('#err_capital').text('');
		}
		if(comune == '')
		{
			$('#err_comune').text('Please enter comune');
			flag = 0;
		}
		else 
		{
			$('#err_comune').text('');
		}
		if(province == '')
		{
			$('#err_province').text('Please enter province.');
			flag =0;
		}
		else 
		{
			$('#err_province').text('');
		}
		if(cellulare == '')
		{
			$('#err_cellulare').text('Please enter contact number.');
			flag = 0;
		}
		else if(isNaN(cellulare))
		{
			$('#err_cellulare').text('Please enter only digits');
			flag = 0;
		}
		else 
		{
			$('#err_cellulare').text('');
		}
		if(codice_fiscale == '')
		{
			$('#err_codice').text('Please enter codice fiscale.');
			flag = 0;
		}
		else 
		{
			$('#err_codice').text('');
		}
		if(email == '')
		{
			$('#err_email').text('Please enter email address');
			flag = 0;
		}
		else if(!filter.test(email))
		{
			$('#err_email').text('Please enter valid email address');
			flag = 0;
		}
		else 
		{
			$('#err_email').text('');
		}
		if(confirm_email == '')
		{
			$('#err_confirm_email').text('Please enter confirm your email.');
			flag = 0;
		}
		else if(confirm_email != email)
		{
			$('#err_confirm_email').text('Confirm email does not match with email.');
			flag = 0;
		}
		else 
		{
			$('#err_confirm_email').text('');
		}
		if(request_message == '')
		{
			$('#err_message').text('Please enter request message');
			flag = 0;
		}
		else 
		{
			$('#err_message').text('');
		}
		if(accept == 0)
		{
			$('#err_term').text('Please agree to terms');
			flag = 0;
		}
		else 
		{
			$('#err_term').text('');
		}
		if(flag == 0)
		{
			return false;
		}
		else 
		{
			return true;
		}

	});
</script>