      var geocoder;
      var currentRequest = null;
      var map;
      var marker;
      var markersArray = [];
      var icon_marker = base_url + 'assets/img/map-marker.png';

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
        //http://medscanner.local.com/hospitals/188?exam_id=4038
          $.each(structures, function(i, item) {
              
                  var exams ='';
                     $.each(item.exams, function(i, exam) {
                        exams = exams+'<div class="pop-exam-detail"><a href="'+base_url+'hospitals/'+item.id+'?exam_id='+exam.exam_id+'">'+exam.exam_type+'</a> (Official Waiting Days :'+exam.official_waiting_days +')</div>';
                      });
                  
                  var contentString = '<div id="content">' +
                      '<h6 id="firstHeading" class="firstHeading">' + item.naming_struct + '</h6><br>' +
                      '<p>'+item.address+'<br>Waiting Time: '+item.official_waiting_days+' days</p>' +
                      '<div id="bodyContent">' +
                        exams+
                      '</div>' +
                      '</div>';
                      var locate = new google.maps.LatLng(item.latitude, item.longitude);
                      map.setCenter(locate);
                      marker = new google.maps.Marker({
                          map: map,
                          title: item.naming_struct,
                          icon: icon_marker,
                          position: new google.maps.LatLng(item.latitude, item.longitude)
                      });
                      markersArray.push(marker);
                      marker.addListener('click', function() {
                          infowindow.open(map, marker);
                      });
                      var infowindow = new google.maps.InfoWindow({
                          content: contentString,
                          maxWidth: 400,
                          maxHeight: 400
                      });
             
          });

      }

      function load_address() {
          waitingDialog.show();
          $.ajax({
              type: "GET",
              url: 'home/get_json_addresses?' + query_string,
              success: function(data) {
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
          if (currentRequest != null) {
              currentRequest.abort();
          }
          currentRequest = $.ajax({
              type: "GET",
              url: 'home/get_json_addresses?' + query_string + filter_search,
              success: function(data) {
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
