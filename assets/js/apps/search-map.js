	var geocoder;
	var currentRequest = null;
	var map;
	var marker;
	var markersArray = [];
	var icon_marker = base_url + 'assets/img/map-marker.png';
	//var get_listing_url = 'index.php/home/get_json_addresses?';
	var get_listing_url = 'home/get_json_addresses?';

	function initMap() {
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(45.53558, 10.21472);
		var mapOptions = {
			zoom: 8,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		map = new google.maps.Map(document.getElementById('map'), mapOptions);
		load_address();
	
	}

	function add_marker_by_address(structures) {
		//var infowindow = new google.maps.InfoWindow({maxWidth: 400, maxHeight: 400});
		var marker;
		//http://medscanner.local.com/hospitals/188?exam_id=4038
		$.each(structures, function(i, item) {
			latlngset = new google.maps.LatLng(item.latitude, item.longitude);
			var marker = new google.maps.Marker({  
				map: map, 
				title: item.naming_struct, 
				icon: icon_marker,
				position: latlngset  
			});
			map.setCenter(marker.getPosition());
			
			
			
			var exams ='';
			$.each(item.exams, function(i, exam) {
				exams = exams+'<div class="pop-exam-detail"><a href="'+base_url+'hospitals/'+item.id+'?exam_id='+exam.exam_id+'">'+exam.exam_type+'</a> (Official Waiting Days :'+exam.official_waiting_days +')</div>';
			});
			var rating_star =  Math.round(item.ratings * 2);
			var contentString = '<div id="content' + i + '">' +
			'<h6 id="firstHeading" class="firstHeading">' + item.naming_struct + '</h6><br>' +
			'<p>'+item.address+'<br />Official Waiting Time: '+item.official_waiting_days+' days</p>' +
			'<p>Usre Reported Time: '+item.formula_rwt+' days</p>' +
			'<p>Rating: <span class="score s'+ rating_star +'"></span></p>' + 
			'<div id="bodyContent">' + 
				'<a href="' + base_url + 'hospitals/' + item.id + '?exam_id=' + item.eid + '"  class="btn btn-default btn-neonblue">Prenota ora</a>' + 
			'</div>' +
			'</div>';
			
			/*var contentString = '<div id="content' + i + '">' +
			'<h6 id="firstHeading" class="firstHeading">' + item.naming_struct + '</h6><br>' +
			'<p>'+item.address+'<br />Waiting Time: '+item.official_waiting_days+' days</p>' +
			'<div id="bodyContent">' +
			exams+
			'</div>' +
			'</div>';*/
			
			var infowindow = new google.maps.InfoWindow();
			
			google.maps.event.addListener(marker,'click', (function(marker,contentString,infowindow){ 
				return function() {
					infowindow.setContent(contentString);
					infowindow.open(map,marker);
				};
			})(marker,contentString,infowindow));			
			markersArray.push(marker);
			//var locate = new google.maps.LatLng(item.latitude, item.longitude);
			//map.setCenter(locate);
			
			/*marker = new google.maps.Marker({
				map: map,
				title: item.naming_struct,
				icon: icon_marker,
				position: new google.maps.LatLng(item.latitude, item.longitude)
			});
			markersArray.push(marker);
			marker.addListener('click', function() {
				infowindow.close();
				infowindow.setContent(contentString);
				infowindow.open(map, marker);
			});*/             
		});
	}

	function load_address() {
		waitingDialog.show();
		//alert(get_listing_url + query_string);
		console.log(get_listing_url + query_string);
		$.ajax({
			type: "GET",
			url: get_listing_url + query_string,
			success: function(data) {
				//alert(data);
				var obj = jQuery.parseJSON(data);
				add_marker_by_address(obj);
				waitingDialog.hide();
			}
		});
	}

	function clearOverlays() {
		if (markersArray) {
			for (i in markersArray) {
			  	markersArray[i].setMap(null);
			}
		}
	}

	function search_structure() {
		waitingDialog.show();
		var filter_search = "";
		$('.checkbox-owd:checked').each(function(i) {
			filter_search = filter_search + "&owd_min["+i+"]=" + $(this).attr('data-min')
			filter_search = filter_search + "&owd_max["+i+"]=" + $(this).attr('data-max')
		})
		$('.checkbox-price:checked').each(function(i) {
			filter_search = filter_search + "&price_min["+i+"]=" + $(this).attr('data-min')
			filter_search = filter_search + "&price_max["+i+"]=" + $(this).attr('data-max')
		})
		$('.checkbox-velocit:checked').each(function(i) {
			filter_search = filter_search + "&velocit["+i+"]=" + $(this).attr('value');
		});
		$('.checkbox-rating:checked').each(function(i) {
			filter_search = filter_search + "&rating["+i+"]=" + $(this).attr('value');
		}); 
		
		if (currentRequest != null) {
			currentRequest.abort();
		}
		//alert(get_listing_url + query_string + filter_search);
		var final_url = get_listing_url + query_string + filter_search;
		//alert(final_url);
		console.log(final_url);
		currentRequest = $.ajax({
			type: "GET",
			url: final_url,
			success: function(data) {
				//alert(data);
				console.log(data);
				var obj = jQuery.parseJSON(data);
				add_marker_by_address(obj);
				waitingDialog.hide();
			}
		
		});
	
	}

	$(document).ready(function() {
		$('.filter-search').click(function() {
			clearOverlays()
			search_structure();
		})
		$("#btn-reset-filter").click(function() {
			clearOverlays()
			$('.filter-search').prop('checked',false);
			search_structure();
		})
	})
