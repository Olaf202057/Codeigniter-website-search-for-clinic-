<div>
<a href="#" class="color-neon wow slideInUp pull-right" id="btn-reset-filter" style="font-size:12px; margin-bottom:10px;">
	Rimuovi tutti i filtri
</a>
<div style="clear:both;"></div>
</div>
<div class=" wow slideInUp" id="accordion" role="tablist" aria-multiselectable="true">

	<div class="">
		<div class="panel-heading" role="tab" id="headingOne">
			<h4 class="panel-title mappa-label">
				<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
				  Tempo di attesa ufficiale
				</a>
			</h4>
			<img src="<?php echo base_url('assets/images/line.png') ?>"  style="width:100%" />
		</div>
		<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
			<div class="" style="font-size:12px;">
				<table class="table table-filter">
					<tr>
						<td style="border:none;">&rarr;&nbsp;&nbsp;&nbsp;&nbsp;0-10 giorni</td>
						<td style="border:none;"><div class="checkbox"><label> <input class='filter-search checkbox-owd' data-min="0" data-max="10" type="checkbox"></label></div></td>
					</tr>
					<tr>
						<td style="border:none;">&rarr;&nbsp;&nbsp;&nbsp;&nbsp;10-30 giorni</td>
						<td style="border:none;"><div class="checkbox"><label> <input class='filter-search checkbox-owd' data-min="10" data-max="30"  type="checkbox"></label></div></td>
					</tr>
					<tr>
						<td style="border:none;">&rarr;&nbsp;&nbsp;&nbsp;&nbsp;30-60 giorni</td>
						<td style="border:none;"><div class="checkbox"><label> <input class='filter-search checkbox-owd' data-min="30" data-max="60"  type="checkbox"></label></div></td>
					</tr>
					<tr>
						<td style="border:none;">&rarr;&nbsp;&nbsp;&nbsp;&nbsp;> 60 giorni</td>
						<td style="border:none;"><div class="checkbox"><label> <input class='filter-search checkbox-owd' data-min="0" data-max="999999"  type="checkbox"></label></div></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="">
		<div class="panel-heading" role="tab" id="headingTwo">
			<h4 class="panel-title mappa-label">
				<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
					Costo della prestazione
				</a>
			</h4>
			<img src="<?php echo base_url('assets/images/line.png') ?>"  style="width:100%" />
		</div>
		<div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
				<div class="" style="font-size:12px;">
				<table class="table table-filter">
					<tbody>
						<tr>
							<td style="border:none;">&rarr;&nbsp;&nbsp;&nbsp;&nbsp;SSN</td>
							<td style="border:none;"><div class="checkbox"><label> <input class='filter-search checkbox-price' data-min="0" data-max="0"  type="checkbox"></label></div></td>
						</tr>
						<tr>
							<td style="border:none;">&rarr;&nbsp;&nbsp;&nbsp;&nbsp;€ 0 - € 50</td>
							<td style="border:none;"><div class="checkbox"><label> <input class='filter-search checkbox-price' data-min="0" data-max="50" type="checkbox"></label></div></td>
						</tr>
						<tr>
							<td style="border:none;">&rarr;&nbsp;&nbsp;&nbsp;&nbsp;€ 50 - € 100</td>
							<td style="border:none;" ><div class="checkbox"><label> <input class='filter-search checkbox-price' data-min="50" data-max="100" type="checkbox"></label></div></td>
						</tr>
						<tr>
							<td style="border:none;">&rarr;&nbsp;&nbsp;&nbsp;&nbsp;€ 100 - € 300</td>
							<td style="border:none;"><div class="checkbox"><label> <input class='filter-search checkbox-price' data-min="100" data-max="300" type="checkbox"></label></div></td>
						</tr>
						<tr>
							<td style="border:none;">&rarr;&nbsp;&nbsp;&nbsp;&nbsp;€ 300</td>
							<td style="border:none;"><div class="checkbox"><label> <input class='filter-search checkbox-price' data-min="0" data-max="999999" type="checkbox"></label></div></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="">
		<div class="panel-heading" role="tab" id="headingOne">
			<h4 class="panel-title mappa-label">
				<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
				  Opinione degli utenti
				</a>
			</h4>
			<img src="<?php echo base_url('assets/images/line.png') ?>"  style="width:100%" />
		</div>
		<div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
			<div class="" style="font-size:12px;">
				<table class="table table-filter">
					<tr>
						<td style="border:none;">&rarr;&nbsp;&nbsp;&nbsp;&nbsp;Alta velocità</td>
						<td style="border:none;"><div class="checkbox"><label> <input class='filter-search checkbox-velocit' value="alta" type="checkbox"></label></div></td>
					</tr>
					<tr>
						<td style="border:none;">&rarr;&nbsp;&nbsp;&nbsp;&nbsp;Media velocità</td>
						<td style="border:none;"><div class="checkbox"><label> <input class='filter-search checkbox-velocit' value="media"  type="checkbox"></label></div></td>
					</tr>
					<tr>
						<td style="border:none;">&rarr;&nbsp;&nbsp;&nbsp;&nbsp;Bassa velocità</td>
						<td style="border:none;"><div class="checkbox"><label> <input class='filter-search checkbox-velocit' value="bassa"  type="checkbox"></label></div></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="">
		<div class="panel-heading" role="tab" id="headingOne">
			<h4 class="panel-title mappa-label">
				<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
				  Opinione degli utenti
				</a>
			</h4>
			<img src="<?php echo base_url('assets/images/line.png') ?>"  style="width:100%" />
		</div>
		<div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
			<div class="" style="font-size:12px;">
				<table class="table table-filter">
					<tr>
						<td style="border:none;">&rarr;&nbsp;&nbsp;&nbsp;&nbsp;
						<i class="fa fa-star color-darkblue"></i>
						<i class="fa fa-star color-darkblue"></i>
						<i class="fa fa-star color-darkblue"></i>
						<i class="fa fa-star color-darkblue"></i>
						<i class="fa fa-star color-darkblue"></i>
						</td>
						<td style="border:none;"><div class="checkbox"><label> <input class='filter-search checkbox-rating' value="5" type="checkbox"></label></div></td>
					</tr>
					<tr>
						<td style="border:none;">&rarr;&nbsp;&nbsp;&nbsp;&nbsp;
						<i class="fa fa-star color-darkblue"></i>
						<i class="fa fa-star color-darkblue"></i>
						<i class="fa fa-star color-darkblue"></i>
						<i class="fa fa-star color-darkblue"></i>
						<i class="fa fa-star-o color-gray"></i>
						</td>
						<td style="border:none;"><div class="checkbox"><label> <input class='filter-search checkbox-rating' value="4"  type="checkbox"></label></div></td>
					</tr>
					<tr>
						<td style="border:none;">&rarr;&nbsp;&nbsp;&nbsp;&nbsp;
						<i class="fa fa-star color-darkblue"></i>
						<i class="fa fa-star color-darkblue"></i>
						<i class="fa fa-star color-darkblue"></i>
						<i class="fa fa-star-o color-gray"></i>
						<i class="fa fa-star-o color-gray"></i>
						</td>
						<td style="border:none;"><div class="checkbox"><label> <input class='filter-search checkbox-rating' value="3"  type="checkbox"></label></div></td>
					</tr>
					<tr>
						<td style="border:none;">&rarr;&nbsp;&nbsp;&nbsp;&nbsp;
						<i class="fa fa-star color-darkblue"></i>
						<i class="fa fa-star color-darkblue"></i>
						<i class="fa fa-star-o color-gray"></i>
						<i class="fa fa-star-o color-gray"></i>
						<i class="fa fa-star-o color-gray"></i>
						</td>
						<td style="border:none;"><div class="checkbox"><label> <input class='filter-search checkbox-rating' value="2"  type="checkbox"></label></div></td>
					</tr>
					<tr>
						<td style="border:none;">&rarr;&nbsp;&nbsp;&nbsp;&nbsp;
						<i class="fa fa-star color-darkblue"></i>
						<i class="fa fa-star-o color-gray"></i>
						<i class="fa fa-star-o color-gray"></i>
						<i class="fa fa-star-o color-gray"></i>
						<i class="fa fa-star-o color-gray"></i>
						</td>
						<td style="border:none;"><div class="checkbox"><label> <input class='filter-search checkbox-rating' value="1"  type="checkbox"></label></div></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>