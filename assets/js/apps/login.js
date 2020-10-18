$(document).ready(function(){
	$(document).on('click',"#btn-forgot-password",function(){
		var _this = $(this);
		var email  = $("#frm-forgot-password input[name=email]").val()
		
		if(email!=''){
			waitingDialog.show();
			$.ajax({
						type: "post",
						url: base_url+'resettalapassword',
						data:{email:email},
						success: function(data){
							$('#reset-modal .msg').html(data);
							waitingDialog.hide();
						}
						
					});
		}else{
			$('#reset-modal .msg').html('<div class="alert alert-danger text-center">Enter Email Address</div>')
			waitingDialog.hide();
		}
		return false;
	})
});