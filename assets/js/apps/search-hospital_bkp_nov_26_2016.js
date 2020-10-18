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
  $('[data-toggle="popover"]').popover({ trigger: "hover" }); 
   $('[data-toggle="popover"]').click(function(){
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
               $('.checkbox-rating:checked').each(function(i) {
                  filter_search = filter_search + "&rating["+i+"]=" + $(this).val()
               
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

         var lessratings = 5-item.ratings;
         var _htmlStart = '';
         for (var i = 0; i < item.ratings; i++) {
            _htmlStart = _htmlStart + '<i class="fa fa-star color-darkblue"></i>';
         };
         for (var i = 0; i < lessratings; i++) {
            _htmlStart = _htmlStart + '<i class="fa fa-star-o color-gray"></i>';
         };
         item.imageurl = (item.imageurl == null||item.imageurl=='') ? base_url + 'assets/img/not-available.png' : item.imageurl;
         item.city = (item.city == null) ? '' : ', ' + item.city;
         item.province_code = (item.province_code == null) ? '' : ', ' + item.province_code;
         item.official_waiting_days = (item.official_waiting_days == null) ? '0' : item.official_waiting_days;
         item.price = (item.price == null) ? 'SSN' : '€  ' + item.price;
         item.website = (item.website == null) ? '#' : 'http://' + item.website;
         var popUp = '';
         var popUpHTML ='';
        if(item.source!=null){
          popUpHTML =popUpHTML+'<a target=\'_blank\' href=\''+parseUrl(item.source)+'\'>'+item.source+'</a>';
        }
        if(item.last_updated!=null){
        popUpHTML =popUpHTML+'<div style=\'font-size:12px;\'>Last Updated :'+item.last_updated+'</div>';
        }   
        if(popUpHTML!=''){
              popUp='&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" data-toggle="popover" data-placement="top" title="Info" data-html="true" data-content="'+popUpHTML+' "><i class="fa fa-info-circle" aria-hidden="true"></i></a>';
        }
         if (i == 0) {
             map_image = map_image + 'center=' + item.address + '&zoom=9&scale=false&size=382x382&maptype=roadmap&format=png&visual_refresh=true';
         }
                     
var list = '             <li class="wow slideInUp result-border">' +
            '                                       <div class="row">' +
            '                                           <div class="col-sm-3">' +
            '                                               <div class="img-result">' +
            '                                                    <img class="img-responsive img-thumbnail col-sm-12" src="' + item.imageurl + '" />' +
            '                                               </div>' +
            '                                           </div>' +
            '                                           <div class="col-sm-9">' +
            '                                                   <div class="row">' +
            '                                                   <div class="col-sm-8">' +
            '                                                       <div><strong  class="color-neon">' + item.hospital + ' </strong></div>' +
            '                                                       <div style="font-size: 10px;" > <i class="fa fa-map-marker "></i>' + item.address+' <a href="'+base_url+'map-search?exam_id='+item.exam_id+'" target="_blank"  style="font-size: 11px;" >(Mappa)</a></div>    ' +
            '                                                       <div class="" style="font-size: 11px;">' +
            '                                                           <div>   ' + item.exam_type +'</div>' +
            '                                                           <div class="row">' +
            '                                                               <div class="col-sm-4">  &euro;: <b class="color-neon">' + item.price + '</b></div>' +
            '                                                               <div class="col-sm-8">  Attesa: <b  class="color-neon">' + item.official_waiting_days + 'giomi</b>'+popUp+'</div>' +
            '                                                           </div>' +
            '                                                           <div>' +
            '                                                               <a href="'+base_url+'hospitals/'+item.id+'?exam_id='+item.exam_id+'"  class="btn btn-default btn-neonblue" style="font-size: 11px;">Prenota</a>' +
            '                                                           </div>' +
            '                                                       </div>      ' +                                         
            '                                                   </div>' +
            '                                                   <div class="col-sm-4" style="padding: 0px; margin-top: 2px;">' +
            '                                                       <div class="row">' +
            '                                                           <div class="col-sm-10 " style="padding-right: 7px;text-align:right;">' +_htmlStart +
            '                                                           </div>' +
            '                                                           <div class="col-sm-10 result-border" style="font-size: 11px;background:#e8f6ff;">' +
            '                                                               <div class="row">' +
            '                                                                   <div class="col-sm-8">' +
            '                                                                       <div><b class="color-neon">Alta velocità</b> </div>' +
            '                                                                       <div>Feedbacks : 100</div>' +
            '                                                                   </div>' +
            '                                                                   <div class="col-sm-3">' +
            '                                                                       <div class="label-ratings">8.6</div>' +
            '                                                                   </div>' +
            '                                                               </div>' +
            '                                                               <div>Lascia it Feedback</div>' +
            '                                                           </div>' +
            '                                                       </div>' +
            '                                                   </div>' +
            '                                               </div>' +
            '                                           </div>' +
            '                                       </div>' +
            '                                   </li>' ;
         html = html + list;
         if(i <3) map_image = map_image + '&markers=icon:' + base_url + 'assets/img/map-marker.png%7Cshadow:true%7C' + item.address
     })

    if(structures.length>0){

     $("#img-map").attr('src', map_image);
      
    }else{
        html = '<li class="wow slideInUp result-border"><h4><i class="fa fa-warning"></i>  No record found...</h4></li>' ;
    }
    $("#result-list ul").html(html); 
        $('[data-toggle="popover"]').popover({ trigger: "hover" }); 
       $('[data-toggle="popover"]').click(function(){
        return false;
       })
 }


 function parseUrl(s){
    var prefix = 'http';
   
    if (s.substr(0, prefix.length) !== prefix)
    {
        s = prefix +'://'+ s;
    }
    return s;
 }