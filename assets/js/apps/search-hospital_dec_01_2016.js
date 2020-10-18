(function(e){var t,o={className:"autosizejs",append:"",callback:!1,resizeDelay:10},i='<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',n=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],s=e(i).data("autosize",!0)[0];s.style.lineHeight="99px","99px"===e(s).css("lineHeight")&&n.push("lineHeight"),s.style.lineHeight="",e.fn.autosize=function(i){return this.length?(i=e.extend({},o,i||{}),s.parentNode!==document.body&&e(document.body).append(s),this.each(function(){function o(){var t,o;"getComputedStyle"in window?(t=window.getComputedStyle(u,null),o=u.getBoundingClientRect().width,e.each(["paddingLeft","paddingRight","borderLeftWidth","borderRightWidth"],function(e,i){o-=parseInt(t[i],10)}),s.style.width=o+"px"):s.style.width=Math.max(p.width(),0)+"px"}function a(){var a={};if(t=u,s.className=i.className,d=parseInt(p.css("maxHeight"),10),e.each(n,function(e,t){a[t]=p.css(t)}),e(s).css(a),o(),window.chrome){var r=u.style.width;u.style.width="0px",u.offsetWidth,u.style.width=r}}function r(){var e,n;t!==u?a():o(),s.value=u.value+i.append,s.style.overflowY=u.style.overflowY,n=parseInt(u.style.height,10),s.scrollTop=0,s.scrollTop=9e4,e=s.scrollTop,d&&e>d?(u.style.overflowY="scroll",e=d):(u.style.overflowY="hidden",c>e&&(e=c)),e+=w,n!==e&&(u.style.height=e+"px",f&&i.callback.call(u,u))}function l(){clearTimeout(h),h=setTimeout(function(){var e=p.width();e!==g&&(g=e,r())},parseInt(i.resizeDelay,10))}var d,c,h,u=this,p=e(u),w=0,f=e.isFunction(i.callback),z={height:u.style.height,overflow:u.style.overflow,overflowY:u.style.overflowY,wordWrap:u.style.wordWrap,resize:u.style.resize},g=p.width();p.data("autosize")||(p.data("autosize",!0),("border-box"===p.css("box-sizing")||"border-box"===p.css("-moz-box-sizing")||"border-box"===p.css("-webkit-box-sizing"))&&(w=p.outerHeight()-p.height()),c=Math.max(parseInt(p.css("minHeight"),10)-w||0,p.height()),p.css({overflow:"hidden",overflowY:"hidden",wordWrap:"break-word",resize:"none"===p.css("resize")||"vertical"===p.css("resize")?"none":"horizontal"}),"onpropertychange"in u?"oninput"in u?p.on("input.autosize keyup.autosize",r):p.on("propertychange.autosize",function(){"value"===event.propertyName&&r()}):p.on("input.autosize",r),i.resizeDelay!==!1&&e(window).on("resize.autosize",l),p.on("autosize.resize",r),p.on("autosize.resizeIncludeStyle",function(){t=null,r()}),p.on("autosize.destroy",function(){t=null,clearTimeout(h),e(window).off("resize",l),p.off("autosize").off(".autosize").css(z).removeData("autosize")}),r())})):this}})(window.jQuery||window.$);

var __slice=[].slice;(function(e,t){var n;n=function(){function t(t,n){var r,i,s,o=this;this.options=e.extend({},this.defaults,n);this.$el=t;s=this.defaults;for(r in s){i=s[r];if(this.$el.data(r)!=null){this.options[r]=this.$el.data(r)}}this.createStars();this.syncRating();this.$el.on("mouseover.starrr","span",function(e){return o.syncRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("mouseout.starrr",function(){return o.syncRating()});this.$el.on("click.starrr","span",function(e){return o.setRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("starrr:change",this.options.change)}t.prototype.defaults={rating:void 0,numStars:5,change:function(e,t){}};t.prototype.createStars=function(){var e,t,n;n=[];for(e=1,t=this.options.numStars;1<=t?e<=t:e>=t;1<=t?e++:e--){n.push(this.$el.append("<span class='fa fa-star-o'></span>"))}return n};t.prototype.setRating=function(e){if(this.options.rating===e){e=void 0}this.options.rating=e;this.syncRating();return this.$el.trigger("starrr:change",e)};t.prototype.syncRating=function(e){var t,n,r,i;e||(e=this.options.rating);if(e){for(t=n=0,i=e-1;0<=i?n<=i:n>=i;t=0<=i?++n:--n){this.$el.find("span").eq(t).removeClass("fa-star-o").addClass("fa-star")}}if(e&&e<5){for(t=r=e;e<=4?r<=4:r>=4;t=e<=4?++r:--r){this.$el.find("span").eq(t).removeClass("fa-star").addClass("fa-star-o")}}if(!e){return this.$el.find("span").removeClass("fa-star").addClass("fa-star-o")}};return t}();return e.fn.extend({starrr:function(){var t,r;r=arguments[0],t=2<=arguments.length?__slice.call(arguments,1):[];return this.each(function(){var i;i=e(this).data("star-rating");if(!i){e(this).data("star-rating",i=new n(e(this),r))}if(typeof r==="string"){return i[r].apply(i,t)}})}})})(window.jQuery,window);$(function(){return $(".starrr").starrr()})

$(function(){
    $(document).on('click','#btn-review-submit',function(){
        var data=$('#frm-review').serialize();
        waitingDialog.show();
        $.ajax({
            type: "post",
            url: base_url+'submit-review',
            data:data,
            success: function(data){
                $('#reset-modal .msg').html(data);
                waitingDialog.hide();
                $('#review-msg').html('<div class="alert alert-success alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong> Grazie per il feedback!</strong>  </div>');
                $('#new-review').val('');
                $('input[name=actual_time]').val(0);
				$("#ratings-hidden").val(0);
				//$("#feedback_structure_id").val('');
				//$("#feedback_exam_id").val('');
				//alert("asdf");
				$(".starrr").find('span').removeClass('fa-star').addClass('fa-star-o');
				$('#ratingModal').modal('hide');
            }

        });
    })
    $('#new-review').autosize({append: "\n"});

    var reviewBox = $('#post-review-box');
    var newReview = $('#new-review');
    var openReviewBtn = $('#open-review-box');
    var closeReviewBtn = $('#close-review-box');
    var ratingsField = $('#ratings-hidden');

    openReviewBtn.click(function(e)
    {
        reviewBox.slideDown(400, function()
        {
            $('#new-review').trigger('autosize.resize');
            newReview.focus();
        });
        openReviewBtn.fadeOut(100);
        closeReviewBtn.show();
    });

    closeReviewBtn.click(function(e)
    {
        e.preventDefault();
        reviewBox.slideUp(300, function()
        {
            newReview.focus();
            openReviewBtn.fadeIn(200);
        });
        closeReviewBtn.hide();

    });

    $('.starrr').on('starrr:change', function(e, value){
        ratingsField.val(value);
    });
	
	$(document).on("click", ".init-modal", function(){
		//alert($(this).attr("data-strictureid"));
		$("#ratings-hidden").val(0);
		$("#feedback_structure_id").val($(this).attr("data-strictureid"));
		$("#feedback_exam_id").val($(this).attr("data-examid"));
		//alert("asdf");
		$(".starrr").find('span').removeClass('fa-star').addClass('fa-star-o');
		//$(".starrr").starrr({rating:0});
		$('#ratingModal').modal('show');								
	});
});







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
     });
     $(document).on('click', ".js-result-order li a", function() {
		 //alert("hello");
		 $(".js-result-order li").removeClass('active');
		 $(this).parent('li').addClass('active');
         doSearch($("#actual_link").val());
     });
      $(document).on('click', "#btn-reset-filter", function() {
         $('.filter-search').prop('checked',false);
         doSearch($("#actual_link").val());
        
       
     })
      $(document).on('click','#btn-search',function(){
        $('#search-form-box').removeClass('hide')
        return false;
      })
  
 })

var $star_rating = $('.star-rating .fa');

var SetRatingStar = function() {
	return $star_rating.each(function() {
		if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
			return $(this).removeClass('fa-star-o').addClass('fa-star');
		} else {
			return $(this).removeClass('fa-star').addClass('fa-star-o');
		}
	});
};

$star_rating.on('click', function() {
	$star_rating.siblings('input.rating-value').val($(this).data('rating'));
	return SetRatingStar();
});

SetRatingStar();

 function doSearch(url){
    if (url != undefined) {
             waitingDialog.show();
            var filter_search = "";
	          $('.checkbox-owd:checked').each(function(i) {
	              filter_search = filter_search + "&owd_min["+i+"]=" + $(this).attr('data-min')
	              filter_search = filter_search + "&owd_max["+i+"]=" + $(this).attr('data-max')
	          });
	          $('.checkbox-price:checked').each(function(i) {
	              filter_search = filter_search + "&price_min["+i+"]=" + $(this).attr('data-min');
	              filter_search = filter_search + "&price_max["+i+"]=" + $(this).attr('data-max');
	          });
	          $('.checkbox-velocit:checked').each(function(i) {
	              filter_search = filter_search + "&velocit["+i+"]=" + $(this).attr('value');
	          });
	          $('.checkbox-rating:checked').each(function(i) {
	              filter_search = filter_search + "&rating["+i+"]=" + $(this).attr('value');
	          });
			  if($(".js-result-order li.active").length > 0) {
			  	filter_search = filter_search + "&sort=" + $(".js-result-order li.active a").attr('data-value');
			  }
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
					 $("#result-list ul").html(obj.html);
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
     //$("#result-list ul").html(html);

 }