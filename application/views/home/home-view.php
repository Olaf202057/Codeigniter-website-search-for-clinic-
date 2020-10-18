	
<div class="header-content">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<h1>Cerca fra centinaia di ospedali i tempi minimi di attesa per esami diagnostici e visite mediche</h1>
					<div class="hc-form">
					<form action="search" method="get">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Esame medico</label>
									<input list="exam" name="q" placeholder="Esame medico" class="form-control" id="search_q">
									<datalist id="exam">
                    <option value="COVID-19">
									</datalist>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Citta</label>
									<input list="city" name="city" placeholder="Citta" class="form-control" id="search_city">
									<datalist id="city">
									</datalist>
                </div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<button type="submit" class="btn btn-block">ricerca</button>
								</div>
							</div>
						</div>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="spacer">
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div class="sc-box wow slideInUp">
						<span><i class="fa fa-search"></i></span>
						<a href="#">Cerca</a>
						Dicci quale visita od esami devi fare e dove vuoi effettuarla. Fra centinaia di strutture sanitarie pubbliche, private o private convenzionate <strong>troverai sempre l'opportunita migliore per le tue esigenze</strong>.
					</div>
				</div>
				<div class="col-sm-4">
					<div class="sc-box wow slideInUp">
						<span><i class="fa fa-balance-scale"></i></span>
						<a href="#">Confronta</a>
						Cerchiamo milioni di esami e visite mediche in tutta italia per trovare i'opzione piu conveniente. Compara i tempi di attesa, il costo e le recensioni per l'esame che devi effettuare.
					</div>
				</div>
				<div class="col-sm-4">
					<div class="sc-box wow slideInUp">
						<span><i class="fa fa-briefcase"></i></span>
						<a href="#">Prenota</a>
						Hai trovato l'esame o la visita che cercavi? Effettua la prenotazione telefonica o prenota sul sito web della struttura che hai scelto. E ricorda di lasciarci il feedback sui tempi di attesa che hai riscontrato e la qualita dell'esame che hai effettuato. <strong>Medscanner e veloce, facile e gratuito</strong>.
					</div>
				</div>
			</div>
		</div>
  </div>
  
  <script>
    $.get("/home/city",
    {
      
    },
    function(res){
      var strexam = '';
      var strcity = '';

      for(x in res['data_exam']){
        strexam += '<option value="'+res['data_exam'][x].exam_type+'" />';
      }
      for(y in res['data_city']){
        strcity += '<option value="'+res['data_city'][y].name+'" />';
      }

      var exam = document.getElementById("exam");
      exam.innerHTML = strexam;
      var city = document.getElementById("city");
      city.innerHTML = strcity;
    });
  </script>
