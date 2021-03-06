<button class="btn btn-default btn-block btn-lg wow slideInUp" id="btn-reset-filter" style="margin-bottom:10px;">
	Elimina tutti i filtri
</button>

<div class="panel-group wow slideInUp" id="accordion" role="tablist" aria-multiselectable="true">
	<div class="panel panel-default">
		<div class="panel-heading" role="tab" id="headingOne">
			<h4 class="panel-title">
				<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
				  Tempo di attesa ufficiale
				</a>
			</h4>
		</div>
		<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
			<div class="panel-body">
				<table class="table table-striped table-filter">
					<tr>
						<td>0-10 giorni</td>
						<td><div class="checkbox"><label> <input class='filter-search checkbox-owd' data-min="0" data-max="10" type="checkbox"></label></div></td>
					</tr>
					<tr>
						<td>10-30 giorni</td>
						<td><div class="checkbox"><label> <input class='filter-search checkbox-owd' data-min="10" data-max="30"  type="checkbox"></label></div></td>
					</tr>
					<tr>
						<td>30-60 giorni</td>
						<td><div class="checkbox"><label> <input class='filter-search checkbox-owd' data-min="30" data-max="60"  type="checkbox"></label></div></td>
					</tr>
					<tr>
						<td>> 60 giorni</td>
						<td><div class="checkbox"><label> <input class='filter-search checkbox-owd' data-min="0" data-max="999999"  type="checkbox"></label></div></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading" role="tab" id="headingTwo">
			<h4 class="panel-title">
				<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
					Costo della prestazione
				</a>
			</h4>
		</div>
		<div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
			<div class="panel-body">
				<table class="table table-striped table-filter">
					<tbody>
						<tr>
							<td>SSN</td>
							<td><div class="checkbox"><label> <input class='filter-search checkbox-price' data-min="0" data-max="0"  type="checkbox"></label></div></td>
						</tr>
						<tr>
							<td>€ 0 - € 50</td>
							<td><div class="checkbox"><label> <input class='filter-search checkbox-price' data-min="0" data-max="51" type="checkbox"></label></div></td>
						</tr>
						<tr>
							<td>€ 50 - € 100</td>
							<td><div class="checkbox"><label> <input class='filter-search checkbox-price' data-min="50" data-max="101" type="checkbox"></label></div></td>
						</tr>
						<tr>
							<td>€ 100 - € 300</td>
							<td><div class="checkbox"><label> <input class='filter-search checkbox-price' data-min="100" data-max="301" type="checkbox"></label></div></td>
						</tr>
						<tr>
							<td>€ 300</td>
							<td><div class="checkbox"><label> <input class='filter-search checkbox-price' data-min="300" data-max="999999" type="checkbox"></label></div></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>