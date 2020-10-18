<div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">Administrator</div>
            </div>
        </div>
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

<div class="spacer">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?php echo $this->session->flashdata('verify_msg'); ?>
            </div>
        </div>
        <div class="row">
            <form class="form-horizontal col-md-6" method="post"  role="form" enctype="multipart/form-data">
                <h2>Add Hospital</h2>
                <?php //echo validation_errors(); ?>
                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Hospital</label>
                    <div class="col-sm-9">
                        <input type="text"  name="hospital" id="hospital" value="" placeholder="Hospital" class="form-control" autofocus>
                        <span class="text-danger" id="err_hospital"><?php echo form_error('hospital'); ?></span>
                    </div>
                </div>
                <div class="form-group hide">
                    <label for="firstName" class="col-sm-3 control-label">Search Keyword</label>
                    <div class="col-sm-9">
                        <input type="text"  name="search_keyword" id="search_keyword" value="" placeholder="search keyword" class="form-control" >
                        <span class="text-danger" id="err_keyword"><?php echo form_error('search_keyword'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Address</label>
                    <div class="col-sm-9">
                        <input type="text" name="address" id="address" value="" placeholder="Address" class="form-control" >
                        <span class="text-danger" id="err_address"><?php echo form_error('address'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">City</label>
                    <div class="col-sm-9">
                        <input type="text" name="city" id="city" value="" placeholder="city" class="form-control" >
                        <span class="text-danger" id="err_city"><?php echo form_error('province'); ?></span>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Province</label>
                    <div class="col-sm-9">
                        <input type="text" name="province" id="province" value="" placeholder="province" class="form-control" >
                        <span class="text-danger" id="err_province"><?php echo form_error('province'); ?></span>
                    </div>
                </div>
				  <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Address formatted</label>
                    <div class="col-sm-9">
                        <input type="text" name="address_formatted" id="address_formatted" value="" placeholder="address formatted" class="form-control" >
                        <span class="text-danger" id="err_address_format"><?php echo form_error('address_formatted'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Telephone</label>
                    <div class="col-sm-9">
                        <input type="text" name="telephone" id="telephone" value="" placeholder="telephone" class="form-control" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Fax</label>
                    <div class="col-sm-9">
                        <input type="text" name="fax" id="fax" value="" placeholder="fax" class="form-control" >
                    </div>
                </div>
                 <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Website</label>
                    <div class="col-sm-9">
                        <input type="text" name="website" id="website" value="" placeholder="website" class="form-control" >
                        <span class="text-danger" id="err_website"><?php echo form_error('website'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input type="text" name="email" id="email"  value=""class="form-control" placeholder="Email">
                        <span class="text-danger" id="err_email"><?php echo form_error('email'); ?></span>
                    </div>
                </div>
                 <!-- <div class="form-group">
                    <label for="email" class="col-sm-3 control-label"></label>
             
                    <div class="col-sm-9">
                        <img style="width:100%;" src="<?php echo base_url().'assets/img/not-available.png'; ?>" >
                        <span class="text-danger" id="err_image"><?php //echo form_error('image_url'); ?></span>
                      
                    </div>

                </div> -->
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">File Upload</label>
                    <div class="col-sm-9">
                           <input type="file" id="btn-upload-image" name="fileupload" />
                    </div>
                </div>
            
                <div class="form-group hide">
                    <label for="email" class="col-sm-3 control-label">Tagged Hospital</label>
                    <div class="col-sm-9">
                        <select name="structure_parent_id" class="form-control">
                            <option value="0"></option>

                        </select>

                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">

                        <button type="submit" name="add_hospital" id="add_hospital" class="btn btn-primary btn-block">Add</button>
                        <?php echo $this->session->flashdata('msg'); ?>
                    </div>
                </div>
            </form> <!-- /form -->
        </div>
    </div> <!-- ./container -->
</div>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>

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
    $('#add_hospital').on('click',function(){
            var hospital        = $('#hospital').val();
            var search_keyword  = $('#search_keyword').val();
            var address         = $('#address').val();
            var city            = $('#city').val();
            var province        = $('#province').val();
            var address_formatted   = $('#address_formatted').val();
            var telephone       = $('#telephone').val();
            var fax             = $('#fax').val();
            var website         = $('#website').val();
            var email           = $('#email').val();
            var image           = $('#btn-upload-image').val();
            var filter          = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var site_filter     = /^(http|https|ftp):\/\/(www+\.)?[a-zA-Z0-9]+\.([a-zA-Z]{2,4})\/?/;
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
            else 
            {
                $('#err_city').text('');
            }
            if(province == '')
            {
                $('#err_province').text('Please enter province ');
                flag = 0;
            }
            else 
            {
                $('#err_province').text('');
            }
            if(address_formatted == '')
            {
                $('#err_address_format').text('Please enter address');
                flag = 0;
            }
            else 
            {
                $('#err_address_format').text('');
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
                flag = 0
            }
            else 
            {
                $('#err_email').text('');
            }
            if(image == '')
            {
                $('#err_image').text('Please select image');
                flag = 0;
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
</script>
