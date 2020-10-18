 var currentRequest = null;
 $(document).ready(function() {

     $(document).on('click', "ul.pagination li a", function() {
         var _this = $(this);
         var url = _this.attr('href');
         doSearch(url);
        
         return false;
     })
     $(document).on('click', ".filter-search", function() {
       
         doSearch($("#actual_link").val());
        
       
     })
      $(document).on('click', "#btn-reset-filter", function() {
         $('.filter-search').prop('checked',false);
         doSearch($("#actual_link").val());
        
       
     })
      $(document).on('click','#btn-search',function(){
        $('#search-form-box').removeClass('hide')
        return false;
      })
  
 })

 function doSearch(url){
    if (url != undefined) {
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
            //  alert('p');
             currentRequest = $.ajax({
                 type: "GET",
                 url: url+filter_search,
                 success: function(data) {
                     var obj = jQuery.parseJSON(data);
                     $("#result-pagination").html(obj.pagination_links);
                     $('#result-count').html(obj.total_rows);
                     resultHTML(obj.structures);
                     waitingDialog.hide();
                 }

             });
         }
 }
 function resultHTML(structures) {
   // alert(structures);
     var html = '';
     var map_image = 'http://maps.googleapis.com/maps/api/staticmap?';
     $.each(structures, function(i, item) {
        //alert(item.owner_id);


         item.imageurl = (item.imageurl == null||item.imageurl=='') ? base_url + 'assets/img/not-available.png' : item.imageurl;
         item.city = (item.city == null) ? '' : ', ' + item.city;
         item.province_code = (item.province_code == null) ? '' : ', ' + item.province_code;
         item.official_waiting_days = (item.official_waiting_days == null) ? '0' : item.official_waiting_days;
         item.price = (item.price == null) ? 'SSN' : '€  ' + item.price;
         item.website = (item.website == null) ? '#' : 'http://' + item.website;

         if (i == 0) {
             map_image = map_image + 'center=' + item.address + '&zoom=9&scale=false&size=382x382&maptype=roadmap&format=png&visual_refresh=true';
         }
         var list = '<li class="wow slideInUp">' +
             '<div class="row">' +
             '	<div class="col-sm-3">' +
             '		<div class="img-result">' +
             '			<img class="img-responsive" src="' + item.imageurl + '" />' +
             '		</div>' +
             '	</div>' +
             '	<div class="col-sm-9">' +
             '  <div class="col-sm-12">'+
             '      <div><strong>' + item.hospital + '</strong></div>'+
             '      <div  style="font-size: 10px;"> ' + item.address+'</div>'+      
             '  </div>'+
             '    <div class="col-sm-12" style="padding: 0px; margin-top: 2px;">'+
             '           <div class="col-sm-6"  style="font-size: 11px;">'+
             '               ' + item.exam_type + ' '+
             '           </div>'+
             '           <div class="col-sm-6">'+
             '              <div class="col-sm-6">'+
             '                       <div class="" style="font-size: 11px;">COSTO</div>'+
             '                       <div class=""  style="font-size: 11px;"><b>' + item.price + '</b></div>'+
             '              </div>'+
             '              <div class="col-sm-6" style="padding: 0px;">'+
             '                      <div class="" style="font-size: 11px;">TEMPO DI ATTESA</div>'+
             '                       <div class=""  style="font-size: 11px;"><b>' + item.official_waiting_days + 'giomi</b></div>'+
             '               </div>'+
             '               <div class="col-sm-12">'+
             '                  <div class="btn-group" role="group" aria-label="...">'+
             '                      <a href="#" target="_blank" class="btn btn-default"  style="font-size: 11px;">Mappa</a>'+
             '                       <a href="'+base_url+'hospitals/'+item.id+'?exam_id='+item.exam_id+'" class="btn btn-default"  style="font-size: 11px;">Prenota ora</a>'+
             '                  </div>'+
             '              </div>'+
             '   </div>'+
             '	</div>' +
             '</div>' +
             '</li>';
         html = html + list;
         if(i <3) map_image = map_image + '&markers=icon:' + base_url + 'assets/img/map-marker.png%7Cshadow:true%7C' + item.address
     })
    if(structures.length>0){
     $("#img-map").attr('src', map_image);
    }
     $("#result-list ul").html(html);

 }