

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
					    <input required type="text" class="form-control" value="<?php echo set_value('nome'); ?>" name="nome" placeholder="NOME">
					 </div>
					 <div class="col-sm-6">
					    <input required type="text" class="form-control"  value="<?php echo set_value('cognome'); ?>" name="cognome" placeholder="COGNOME">
					 </div>
				</div>
				<div class="col-sm-12" style="margin-top:10px;">	
					<div class="col-sm-6">
					    <input required type="text" class="form-control"  value="<?php echo set_value('indirizzo'); ?>" name="indirizzo" placeholder="INDIRIZZO">
					 </div>
					 <div class="col-sm-3">
					    <input required type="text" class="form-control"  value="<?php echo set_value('cap'); ?>" name="cap" placeholder="CAP">
					 </div>
				</div>
				<div class="col-sm-12" style="margin-top:10px;">	
					<div class="col-sm-6">
					    <input type="text" class="form-control"  value="<?php echo set_value('comune'); ?>" name="comune" placeholder="COMUNE">
					 </div>
					 <div class="col-sm-3">
					    <input required type="text" class="form-control"  value="<?php echo set_value('prov'); ?>" name="prov" placeholder="PROV">
					 </div>
				</div>
				<div class="col-sm-12" style="margin-top:10px;">	
					<div class="col-sm-6">
					    <input required type="text" class="form-control"  value="<?php echo set_value('cellulare'); ?>" name="cellulare" placeholder="CELLULARE">
					 </div>
					 <div class="col-sm-6">
					    <input required type="text" class="form-control"  value="<?php echo set_value('codice_fiscale'); ?>" name="codice_fiscale" placeholder="CODICE FISCALE">
					 </div>
				</div>
				<div class="col-sm-12" style="margin-top:10px;">	
					<div class="col-sm-6">
					    <input required type="email" class="form-control" value="<?php echo set_value('email'); ?>"  name="email" placeholder="E-MAIL">
					 </div>
					 <div class="col-sm-6">
					    <input required type="email" class="form-control" value="<?php echo set_value('confirm_email'); ?>"  name="confirm_email" placeholder="CONFERMA E-MAIL">
					 </div>
				</div>
			
				<div class="col-sm-12">	<h4>La Tua richiesta</h4></div>
				<div class="col-sm-12"  style="margin-top:10px;">	
					<textarea class="form-control" name="request_message" style="height: 260px;"><?php echo set_value('request_message'); ?></textarea>
					 
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
				<div><button type="submit" class="btn btn-danger pull-right">invia la tua richiesta</button></div>
			</div>
		</div>
	</div>

	</form>
