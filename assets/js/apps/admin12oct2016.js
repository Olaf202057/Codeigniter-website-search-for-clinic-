$(document).ready(function(){
    $(document).on('click','input[name=r_common_name]',function(){
        $('#common_name').val('')
        if ($(this).attr('checkstate') == 'true')
        {
            $(this).attr('checked', false);
            $(this).attr('checkstate', 'false');  // .attr returns a string for unknown param values.
        }
        else
        {
            $(this).attr('checked', true);
            $(this).attr('checkstate', 'true');
        }
    })
    $(this).prop('checked', false);
    $(document).on('click','#btn-do-assign',function(){
        if($('input[name="exam_id[]"]:checked').size()==0){
            alert('Please select an exam to update common name....');
            return false;
        }else{
            $("#modal-assign-common").modal('show');
        }
    })
    $(document).on('click','#btn-assign-common',function(){
        var _this = $(this);

        if($('#common_name').val().trim()!=''|| $('input[name=r_common_name]:checked').val()){
            $('#common_name').removeClass('alert-danger');
            if(confirm('Are you sure to assign this selected exam this common name?')){
                $('#common_name').removeClass('alert-danger');
                var common_name =($('#common_name').val().trim()!='') ? $('#common_name').val():$('input[name=r_common_name]:checked').val();

                waitingDialog.show();
                $.ajax({
                    type: "POST",
                    url: base_url+'admin/update_exam_common_name',
                    data:$('input[name="exam_id[]"]:checked').serialize()+'&common_name='+common_name,
                    success: function(data){
                        window.location.href=window.location.href;
                        waitingDialog.hide();
                    },
                    error:function(){
                        waitingDialog.hide();
                    }

                });
            }
        }else{
            $('#common_name').addClass('alert-danger');
        }

        return false
    })
    $(document).on('click','#select_all_exam',function(){
        $('input[name="exam_id[]"]').prop('checked',$(this).is(':checked'))
    })
    $(document).on('click','input[name="exam_id[]"]',function(){
        if($('input[name="exam_id[]"]').size()!=$('input[name="exam_id[]"]:checked').size()){
            $('#select_all_exam').prop('checked',false);
        }else{
            $('#select_all_exam').prop('checked',true);
        }
    })
	$(document).on('click',"#hospitals ul.pagination li a",function(){
		var _this = $(this);
		var url = _this.attr('href');

		if(url!=undefined){
			waitingDialog.show();
			$.ajax({
						type: "GET",
						url: url,
						success: function(data){
							var obj = jQuery.parseJSON(data);
							$("#result-pagination").html(obj.pagination_links);
                            resulStructurestHTML(obj.structures);
							waitingDialog.hide();
						}

					});
		}
		return false;
	})
    $(document).on('click',"#btn-search",function(){

        var url =base_url+'admin/exams?q='+$("#txt-search").val();

        if(url!=undefined){
            waitingDialog.show();
            $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data){
                            var obj = jQuery.parseJSON(data);
                            $("#result-pagination").html(obj.pagination_links);
                            resulExamsHTML(obj.exams);
                            waitingDialog.hide();
                        }

                    });
        }
        return false;
    })
    
    $(document).on('click',"#btn-search-structure",function(){

        var url =base_url+'admin/structures?q='+$("#txt-search").val();

        if(url!=undefined){
            waitingDialog.show();
            $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data){
                            var obj = jQuery.parseJSON(data);
                            $("#result-pagination").html(obj.pagination_links);
                            resulStructurestHTML(obj.structures);
                            waitingDialog.hide();
                        }

                    });
        }
        return false;
    })
    
	$(document).on('click',"#exam ul.pagination li a",function(){
        var _this = $(this);
        var url = _this.attr('href');

        if(url!=undefined){
            waitingDialog.show();
            $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data){
                            var obj = jQuery.parseJSON(data);
                            $("#result-pagination").html(obj.pagination_links);
                            resulExamsHTML(obj.exams);
                            waitingDialog.hide();
                        }

                    });
        }
        return false;
    })

	
	$(document).on('click',"#users .btn-remove-user",function(){
		var _this = $(this);
		
			if(confirm('Are you sure to remove this user?')){
			waitingDialog.show();
			$.ajax({
						type: "POST",
						url: base_url+'admin/remove_user',
						data:{id:_this.attr('data-id')},
						success: function(data){
							if(data==1){
								_this.parent().parent().parent().remove();
							}
							waitingDialog.hide();
						},
						error:function(){
								waitingDialog.hide();
						}
						
					});
			}
		return false;
	})

    $(document).on('click',"#tbl-exams .btn-remove-exam",function(){
        var _this = $(this);

        if(confirm('Are you sure to remove this exam?')){
            waitingDialog.show();
            $.ajax({
                type: "POST",
                url: base_url+'admin/remove_exam',
                data:{id:_this.attr('data-id')},
                success: function(data){
                    if(data==1){
                        _this.parent().parent().parent().remove();
                        _this.parent().parent().parent().remove();
                    }
                    waitingDialog.hide();
                },
                error:function(){
                    waitingDialog.hide();
                }

            });
        }
        return false;
    })

    $(document).on('click',"#tbl-hospitals .btn-remove-structure",function(){
        var _this = $(this);

        if(confirm('Are you sure to remove this hospital?')){
            waitingDialog.show();
            $.ajax({
                type: "POST",
                url: base_url+'admin/remove_structure',
                data:{id:_this.attr('data-id')},
                success: function(data){
                    if(data==1){
                        _this.parent().parent().parent().remove();
                    }
                    waitingDialog.hide();
                },
                error:function(){
                    waitingDialog.hide();
                }

            });
        }
        return false;
    })
	$(document).on('click',"#users .btn-approve-user",function(){
		var _this = $(this);
		
		if(confirm('Are you sure to approved this user?')){
			waitingDialog.show();
			$.ajax({
						type: "POST",
						url: base_url+'admin/approve_user',
						data:{id:_this.attr('data-id')},
						success: function(data){
							if(data==1){
								_this.removeClass(' btn-success');
								_this.removeClass('btn-approve-user');
							}
							waitingDialog.hide();
						},
						error:function(){
								waitingDialog.hide();
						}
						
					});
		}
		return false;
	})
	$(document).on('click',"#users ul.pagination li a",function(){
		var _this = $(this);
		var url = _this.attr('href');
		
		if(url!=undefined){
			waitingDialog.show();
			$.ajax({
						type: "GET",
						url: url,
						success: function(data){
							var obj = jQuery.parseJSON(data);
							$("#result-pagination").html(obj.pagination_links);
							resulUserstHTML(obj.users);
							waitingDialog.hide();
						}
						
					});
		}
		return false;
	})
    $(document).on('click',"#review .btn-remove-review",function(){
        var _this = $(this);

        if(confirm('Are you sure to remove this review?')){
            waitingDialog.show();
            $.ajax({
                type: "POST",
                url: base_url+'admin/remove_exam_review',
                data:{id:_this.attr('data-id')},
                success: function(data){
                    if(data==1){
                        _this.parent().parent().parent().remove();
                    }
                    waitingDialog.hide();
                },
                error:function(){
                    waitingDialog.hide();
                }

            });
        }
        return false;
    })

    $(document).on('click',"#btn-update-review",function(){
        var _this = $(this);

        if(confirm('Are you sure to update this review?')){
            waitingDialog.show();
            $.ajax({
                type: "POST",
                url: base_url+'admin/update_exam_review',
                data:$('#frm-review').serialize(),
                success: function(data){
                    if(data==1){
                        $('#review-msg').html('<div class="alert alert-success alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong> Grazie per il feedback!</strong>  </div>');
                        window.location.reload();
                    }
                    waitingDialog.hide();
                },
                error:function(){
                    waitingDialog.hide();
                }

            });
        }
        return false;
    })
    $(document).on('click',"#review .btn-approve-review",function(){
        var _this = $(this);

        if(confirm('Are you sure to approved this review?')){
            waitingDialog.show();
            $.ajax({
                type: "POST",
                url: base_url+'admin/approve_exam_review',
                data:{id:_this.attr('data-id')},
                success: function(data){
                    if(data==1){
                        _this.parent().prev().html('Approved')
                        _this.removeClass(' btn-success');
                        _this.removeClass('btn-approve-user');
                    }
                    waitingDialog.hide();
                },
                error:function(){
                    waitingDialog.hide();
                }

            });
        }
        return false;
    })
    $(document).on('click','.btn-edit-review',function(){

        var id=$(this).attr('data-id');
        $.ajax({
            type: "GET",
            url: base_url+'admin/get_exam_review/'+id,
            success: function(data){
                var obj = jQuery.parseJSON(data);
                $('textarea[name=comment]').val(obj.comment);
                $('input[name=id]').val(obj.id);
                $('input[name=actual_time]').val(obj.actual_time);
                $('input[name=structure_id]').val(obj.structure_id);
                $('input[name="exam_id[]"]').val(obj.exam_id);
                $('input[name=rating]').val(obj.rating);
                $('#modal-edit-review').modal('show');
            },
            error:function(){

            }

        });
    })
})
function resulUserstHTML(users){
	var html='';
	$.each(users,function(i, item){
		var tr ='<tr>'+
				'	<td>'+item.email+'</td> '+
				'	<td>'+item.firstname+'</td> '+
				'	<td>'+item.lastname+'</td> '+
				'	<td>'+((item.role==1) ? "Admin" :"Normal")+'</td> '+
				'	<td>'+item.birthday+'</td> '+
				'	<td>'+((item.status==1) ? "Email Confirm'":"Pending Email Confirmation")+'</td> '+
				'	<td>'+
            '	<div class="btn-group">'+
				'		<button type="button" data-id="'+item.id+'" class="btn '+((item.is_approved==1) ?"" :"btn-success btn-approve-user")+' btn-sm">Approved</button>'+
				'		<button type="button" data-id="'+item.id+'" class="btn btn-primary btn-sm">Edit</button>'+
				'		<button type="button" data-id="'+item.id+'" class="btn btn-danger btn-sm">Delete</button>'+
            '	</td> '+
				'	</td> '+
				'</tr>';
		
		html = html+tr;

	})

	$("#tbl-users tbody").html(html);
	
}

function resulExamsHTML(exams){
    var html='';
    $.each(exams,function(i, item){
        var tr =' <tr>'+
                '    <td><input type="checkbox" name="exam_id[]" value="'+item.id +'"></td>'+
                '    <td>'+
                '        <div>'+item.exam_type +'</div>'+
                '        <i>'+item.hospital +'</i>'+
                '    </td>'+
                '    <td>'+item.common_name +'</td>'+
                '    <td>'+((item.official_waiting_days==null) ? 0 : item.official_waiting_days ) +'</td>'+
                '    <td>'+((item.reported_waiting_days==null) ? 0 : item.reported_waiting_days ) +'</td>'+
                '    <td>'+((item.price==null) ? 0 : item.price) +'</td>'+
                '    <td>'+
                '        <div class="btn-group">'+
                '            <a href="'+base_url+'admin/edit_exam/'+item.id+'" type="button" data-id="'+item.id+'" class="btn btn-primary btn-sm">Edit</a>'+
                '            <button type="button" data-id="'+item.id+'"  class="btn btn-remove-exam btn-danger btn-sm">Delete</button>'+
                '        </div>'+
                '    </td>'+
                '</tr> '; 
        
        html = html+tr;

    })

    $("#tbl-exams tbody").html(html);
    
}
function resulStructurestHTML(structures){
	var html='';
	$.each(structures,function(i, item){
		var tr ='<tr>'+
				'	<td>'+item.hospital+'</td> '+
				'	<td>'+item.address+'</td> '+
				'	<td>'+item.telephone+'</td> '+
				'	<td>'+item.email+'</td> '+
				'	<td>'+item.website+'</td> '+
				'	<td>'+
				'	<div class="btn-group">'+
                '<a href="'+base_url+'admin/edit_structures/'+item.id+'" type="button" data-id="'+item.id+'" class="btn btn-primary btn-sm">Edit</a>'+
                '<a href="'+base_url+'admin/exams?structure='+item.id+'" type="button" data-id="'+item.id+'" class="btn btn-info btn-sm">Exams</a>'+
				'		<button type="button" data-id="'+item.id+'" class="btn btn-danger btn-sm">Delete</button>'+
                '   </div>'+
				'	</td> '+
				'</tr>';
		
		html = html+tr;

	})

	$("#tbl-hospitals tbody").html(html);
	
}


/***Review Area**/

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
                $('#review-msg').html('<div class="alert alert-success alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Thanks for filling out our review form!</strong>  </div>');
                $('#new-review').val('');
                $('input[name=actual_time]').val(0);
                $('#close-review-box').trigger('click')
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
});
