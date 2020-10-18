<div class="spacer">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?php echo $this->session->flashdata('verify_msg'); ?>
            </div>
        </div>
        <div class="row">file
        <?php $this->load->view('user-menu'); ?>
        <?php echo $this->session->flashdata('msg'); ?>
            <form class="form-horizontal col-md-6" method="post" role="form" enctype="multipart/form-data" action="">
                <h2>Informazioni sulla Struttura</h2>
                <div class="step3">
                <?php if((isset($hospital)) && (count($hospital)>0)) {?>
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Ospedale <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text"  name="hospital" id="hospital" value="<?php echo ucfirst($hospital[0]['hospital']);?>" placeholder="Ospedale" class="form-control input-address">
                        <span class="text-danger" id="err_hospital"><?php echo form_error('hospital'); ?></span>
                    </div>
                     <div class="clr"></div>
                </div>
                <div class="user_box hide">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Search Keyword <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text"  name="search_keyword" id="search_keyword" value="" placeholder="search keyword" class="form-control input-address" >
                        <span class="text-danger" id="err_keyword"><?php echo form_error('search_keyword'); ?></span>
                    </div>
                     <div class="clr"></div>
                </div>
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Indirizzo <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text" name="address" id="address" value="<?php echo ucfirst($hospital[0]['address']);?>" placeholder="Indirizzo" class="form-control input-address" >
                        <span class="text-danger" id="err_address"><?php echo form_error('address'); ?></span>
                    </div>
                     <div class="clr"></div>
                </div>
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Città <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text" name="city" id="city" value="<?php echo ucfirst($hospital[0]['city']);?>" placeholder="Città" class="form-control input-address" >
                        <span class="text-danger" id="err_city"><?php echo form_error('city'); ?></span>
                    </div>
                     <div class="clr"></div>
                </div>
                 <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Provincia <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text" name="province" id="province" value="<?php echo ucfirst($hospital[0]['province']);?>" placeholder="Provincia" class="form-control input-address" >
                        <span class="text-danger" id="err_province"><?php echo form_error('province'); ?></span>
                    </div>
                     <div class="clr"></div>
                </div>
				 <!--  <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Address formatted <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text" name="address_formatted" id="address_formatted" value="<?php echo ucfirst($hospital[0]['address_formatted']);?>" placeholder="address formatted" class="form-control input-address" >
                        <span class="text-danger" id="err_address_format"><?php echo form_error('address_formatted'); ?></span>
                    </div>
                     <div class="clr"></div>
                </div> -->
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Telefono <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text" name="telephone" id="telephone" value="<?php echo $hospital[0]['telephone'];?>" placeholder="Telefono" class="form-control input-address" >
                        <span class="text-danger" id="err_telephone"><?php echo form_error('telephone'); ?></span>
                    </div>
                     <div class="clr"></div>
                </div>
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Fax <span> : </span> </label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text" name="fax" name="fax" value="<?php echo $hospital[0]['fax'];?>" placeholder="fax" class="form-control input-address" >
                    </div>
                     <div class="clr"></div>
                </div>
                 <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Sito <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text" name="website" id="website" value="<?php echo $hospital[0]['website'];?>" placeholder="website" class="form-control input-address" >
                        <span class="text-danger" id="err_website"><?php echo form_error('website'); ?></span>
                    </div>
                     <div class="clr"></div>
                </div>
                <div class="user_box">
                    <label for="email" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Email <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text" id="email" name="email" value="<?php echo $hospital[0]['email'];?>" class="form-control input-address">
                        <span class="text-danger" id="err_email"><?php echo form_error('email'); ?></span>
                    </div>
                     <div class="clr"></div>
                </div>
                 <div class="user_box">
                    <label for="email" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1"></label>
             
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <img class="fileimage" style="width:50%;heigth:50%;" src="<?php echo  !empty($hospital[0]['image_url']) ? $hospital[0]['image_url']:base_url().'assets/img/not-available.png' ; ?>" >
                        <span class="text-danger"><?php echo form_error('image_url'); ?></span>                      
                    </div> 
                     <div class="clr"></div>
                </div>
                <div class="user_box">
                    <label for="email" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">File caricato <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                           <!-- <input type="file" name="fileupload" id="fileupload" class="input-address" />
                           <span class="text-danger" id="err_image"><?php echo form_error('fileupload'); ?></span> -->
                           <div class="upload-block">
                            <input type="file" style="visibility:hidden; height: 0;" name="fileupload" id="fileupload"/>
                            <div class="input-group ">
                                <input type="text" class="form-control file-caption  kv-fileinput-caption" disabled="disabled"/>
                                <div class="btn btn-primary btn-file btn-gry">
                                    <a class="file" onclick="browseImage(this)">Scegli</a>
                                </div>
                                <div class="btn btn-primary btn-file btn-file-remove remove" style="border-right:1px solid #fbfbfb !important;display:none;">
                                            <a class="file" onclick="removeBrowsedImage(this)"><i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                </div>
                            </div>
                       <span class="text-danger" id="err_image"><?php echo form_error('fileupload'); ?></span>
                        </div>

                    </div>
                     <div class="clr"></div>
                </div>
            
                <div class="user_box hide">
                    <label for="email" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Tagged Hospital <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <select name="structure_parent_id" class="form-control input-address">
                            <option value="0"></option>

                        </select>

                    </div>
                </div>
                <?php } else { ?>
                     <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Hospital <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text"  name="hospital" id="hospital" value="" placeholder="Hospital" class="form-control input-address">
                        <span class="text-danger" id="err_hospital"><?php echo form_error('hospital'); ?></span>
                    </div>
                     <div class="clr"></div>
                </div>
                <div class="user_box hide">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Search Keyword <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text"  name="search_keyword" id="search_keyword" value="" placeholder="search keyword" class="form-control input-address" >
                        <span class="text-danger" id="err_keyword"><?php echo form_error('search_keyword'); ?></span>
                    </div>
                </div>
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Address <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text" name="address" id="address" value="" placeholder="Address" class="form-control input-address" >
                        <span class="text-danger" id="err_address"><?php echo form_error('address'); ?></span>
                    </div>
                     <div class="clr"></div>
                </div>
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">City <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text" name="city" id="city" value="" placeholder="city" class="form-control input-address" >
                        <span class="text-danger" id="err_city"><?php echo form_error('city'); ?></span>
                    </div>
                     <div class="clr"></div>
                </div>
                 <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Province <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text" name="province" id="province" value="" placeholder="province" class="form-control input-address" >
                        <span class="text-danger" id="err_province"><?php echo form_error('province'); ?></span>
                    </div>
                     <div class="clr"></div>
                </div>
                 <!--  <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Address formatted <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text" name="address_formatted" id="address_formatted" value="" placeholder="address formatted" class="form-control input-address" >
                        <span class="text-danger" id="err_address_format"><?php echo form_error('address_formatted'); ?></span>
                    </div>
                     <div class="clr"></div>
                </div> -->
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Telephone <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text" name="telephone" id="telephone" value="" placeholder="telephone" class="form-control input-address" >
                        <span class="text-danger" id="err_telephone"><?php echo form_error('telephone'); ?></span>
                    </div>
                     <div class="clr"></div>
                </div>
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Fax <span> : </span> </label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text" name="fax" name="fax" value="" placeholder="fax" class="form-control input-address" >
                    </div>
                     <div class="clr"></div>
                </div>
                 <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Website <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text" name="website" id="website" value="" placeholder="website" class="form-control input-address" >
                        <span class="text-danger" id="err_website"><?php echo form_error('website'); ?></span>
                    </div>
                     <div class="clr"></div>
                </div>
                <div class="user_box">
                    <label for="email" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Email <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text" id="email" name="email" value="" class="form-control input-address">
                        <span class="text-danger" id="err_email"><?php echo form_error('email'); ?></span>
                    </div>
                     <div class="clr"></div>
                </div>
                 <div class="user_box">
                    <label for="email" class="col-sm-3 control-label"></label>
             
                    <div class="col-sm-9">
                        <img style="width:100%;" src="" class="fileimage">
                        <span class="text-danger"><?php echo form_error('image_url'); ?></span>
                   </div>
                    <div class="clr"></div>
                </div>
                <div class="user_box">
                    <label for="email" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">File Upload <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                           <!-- <input type="file" name="fileupload" id="fileupload" class="input-address" />
                           <span class="text-danger" id="err_image"><?php echo form_error('fileupload'); ?></span> -->
                           <div class="upload-block">
                                <input type="file" style="visibility:hidden; height: 0;" name="fileupload" id="fileupload"/>
                                <div class="input-group ">
                                    <input type="text" class="form-control file-caption  kv-fileinput-caption" disabled="disabled"/>
                                    <div class="btn btn-primary btn-file btn-gry">
                                        <a class="file" onclick="browseImage(this)">Browse...</a>
                                    </div>
                                    <div class="btn btn-primary btn-file btn-file-remove remove" style="border-right:1px solid #fbfbfb !important;display:none;">
                                                <a class="file" onclick="removeBrowsedImage(this)"><i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                    </div>
                                </div>
                           <span class="text-danger" id="err_image"><?php echo form_error('fileupload'); ?></span>
                            </div>
                    </div>
                     <div class="clr"></div>
                </div>
            
                <div class="user_box hide">
                    <label for="email" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Tagged Hospital <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <select name="structure_parent_id" class="form-control input-address">
                            <option value="0"></option>

                        </select>

                    </div>
                </div>
                <?php }?>
                <div class="user_box">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit" class="bg-btn update_hospital" name="update_hospital" id="update_hospital">Aggiorna</button>
                        <button class="bg-btn" type="button" name="btn_update_cancel" id="btn_update_cancel" onclick="location.href='<?php echo base_url();?>ads/dashboard'">Ignora</button> 
                        
                    </div>
                </div>
                </div>
            </form> <!-- /form -->
        </div>
    </div> <!-- ./container -->
</div>

<style type="text/css">
    .file_button_container,
  .file_button_container input {
       height: 47px;
       width: 263px;
       cursor: pointer;
   }

   .file_button_container {
       background: transparent url(<?php echo base_url()?>assets/img/btn-button.png) left top no-repeat;
   }

   .file_button_container input {
       opacity: 0;
   }
</style>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMqS0pCvSx6yV0zJ1tAIWFSOQiq1yV16Y&libraries=places"></script>

<script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', function() {
        var places = new google.maps.places.Autocomplete(document
            .getElementById('address'));
        google.maps.event.addListener(places, 'place_changed', function() {
            var place = places.getPlace();
            var address = place.formatted_address;
            var value = address.split(",");
            count = value.length;
            country = value[count - 1];
            state = value[count - 2];
            city = value[count - 3];
            var z = state.split(" ");
            document.getElementById("selCountry").text = country;
            var i = z.length;
            document.getElementById("pstate").value = z[1];
            if (i > 2)
                document.getElementById("pzcode").value = z[2];
            document.getElementById("pCity").value = city;
            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();
            var mesg = address;
            document.getElementById("address").value = mesg;

        });
    });

    $(document).on('keydown', '#telephone,#fax', function(e) {
        if((e.keyCode >= 65 && e.keyCode <= 122)  &&  !(e.keyCode >= 96 && e.keyCode <= 105) ) { 
            e.preventDefault();
        }
    });

    $('#update_hospital').on('click',function(){

            var hospital        = $('#hospital').val();
           /* var search_keyword  = $('#search_keyword').val();*/
            var address         = $('#address').val();
            var city            = $('#city').val();
            var province        = $('#province').val();
           // var address_formatted   = $('#address_formatted').val();
            var telephone       = $('#telephone').val();
            var website         = $('#website').val();
            var email           = $('#email').val();
            var filename        = $("#fileupload").val();
            var ext             = filename.split('.').pop();
            var filter          = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var site_filter     = /^(http|https|ftp):\/\/(www+\.)?[a-zA-Z0-9]+\.([a-zA-Z]{2,4})\/?/;
            var name_filter = /^[a-zA-Z .]*$/;

            var flag            = 1;

            if(hospital == '')
            {
                $('#err_hospital').text('Please enter hospital name');
                flag = 0;
            }
            else 
            {
                $('#err_hospital').text('');
            }
            
            if(address == '')
            {
                $('#err_address').text('Please enter address');
                flag = 0;
            }
            else 
            {
                $('#err_address').text('');
            }

            if(city == '')
            {
                $('#err_city').text('Please enter city');
                flag = 0;
            }
            else if(!name_filter.test(city))
            {
                $('#err_city').text('Please valid enter city');
                flag = 0;
            }
            else 
            {
                $('#err_city').text('');
            }

            if(province == '')
            {
                $('#err_province').text('Please enter province ');
                flag = 0;
            }
            else if(!name_filter.test(province))
            {
                $('#err_province').text('Please valid enter province');
                flag = 0;
            }
            else 
            {
                $('#err_province').text('');
            }

            /*if(address_formatted == '')
            {
                $('#err_address_format').text('Please enter address');
                flag = 0;
            }
            else 
            {
                $('#err_address_format').text('');
            }*/

            if(telephone == '')
            {
              $('#err_telephone').text('Please enter telephone number.');
              flag = 0;
            }
            else if(isNaN(telephone) || telephone.length<6 || telephone.length>10)
            {
              $('#err_telephone').text('Please enter valid telephone number greater than 6 and less than 10.');
              flag = 0;
            }   
            else 
            {
              $('#err_telephone').text('');
            }

            if(website == '')
            {
                $('#err_website').text('Please enter hospital website');
                flag = 0;
            }
            else if(!site_filter.test(website))
            {
                $('#err_website').text('Please enter a valid website');
                flag = 0;
            }
            else 
            {
                $('#err_website').text('');
            }
    
            if(email == '')
            {
                $('#err_email').text('Please enter email id');
                flag = 0;
            }
            else if(!filter.test(email))
            {
                $('#err_email').text('Please enter a valid email id');
                flag = 0;
            }
            else 
            {
                $('#err_email').text('');
            }
            if(filename!=""  && ext!="jpg" && ext!="png" && ext!="gif" && ext!="jpeg" && ext!="JPG" && ext!="PNG" && ext!="JPEG" && ext!="GIF")
            {       
                $('#err_image').addClass('error');
                $('#err_image').html('Only jpg, png, gif, jpeg type images is allowed');
                $('#fileupload').on('change',function () { $('#err_image').removeClass('error'); $('#err_image').html(''); });
                $('#fileupload').focus();
                flag=0;
            }
            else 
            {
                $('#err_image').text('');
            }
            if(flag == 0)
            {
                return false;
            }
            else 
            {
                return true;    
            }
            
        });

/*file upload demo*/

    
 $("#fileupload").on('change', function () {
      var reader = new FileReader();
      reader.onload = function (e) {
        $(".fileimage").attr('src',e.target.result);
      };
      reader.readAsDataURL(this.files[0]);
    });



        function browseImage(ref)
        {
          var upload_block = $(ref).closest('div.upload-block');
          $(upload_block).find('input[type="file"]').trigger('click');
        }

        function removeBrowsedImage(ref)
        {
          $(".fileimage").attr('src','');
          var upload_block = $(ref).closest('div.upload-block');
          
          $(upload_block).find('input.file-caption').val("");
          $(upload_block).find("div.btn-file-remove").hide();
          $(upload_block).find('input[type="file"]').val("");
        }

        $(document).ready(function()
        {
          // This is the simple bit of jquery to duplicate the hidden field to subfile
          $('div.upload-block').find('input[type="file"]').change(function()
          {
            var upload_block = $(this).closest('div.upload-block');
            if($(this).val().length>0)
            {
              $(upload_block).find("div.btn-file-remove").show();

            }

            $(upload_block).find('input.file-caption').val($(this).val());
          });
          
        });
</script>