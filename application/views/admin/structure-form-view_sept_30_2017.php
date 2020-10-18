<div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">Administrator</div>
            </div>
        </div>
    </div>
<div class="spacer">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?php echo $this->session->flashdata('verify_msg'); ?>
            </div>
        </div>
        <div class="row">
            <form class="form-horizontal col-md-6" method="post" role="form" enctype="multipart/form-data">
                <h2>Update Hospital</h2>
                <?php echo validation_errors(); ?>
                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Hospital</label>
                    <div class="col-sm-9">
                        <input type="text"  name="hospital" value="<?php echo $hospital->hospital; ?>" placeholder="Hospital" class="form-control" autofocus>
                        <span class="text-danger"><?php echo form_error('hospital'); ?></span>
                    </div>
                </div>
                <div class="form-group hide">
                    <label for="firstName" class="col-sm-3 control-label">Search Keyword</label>
                    <div class="col-sm-9">
                        <input type="text"  name="search_keyword" value="<?php echo $hospital->search_keyword; ?>" placeholder="search keyword" class="form-control" >
                        <span class="text-danger"><?php echo form_error('search_keyword'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Address</label>
                    <div class="col-sm-9">
                        <input type="text" name="address" value="<?php echo  $hospital->address; ?>" placeholder="Address" class="form-control" >
                        <span class="text-danger"><?php echo form_error('address'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">City</label>
                    <div class="col-sm-9">
                        <input type="text" name="city" value="<?php echo  $hospital->city; ?>" placeholder="city" class="form-control" >
                        <span class="text-danger"><?php echo form_error('province'); ?></span>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Province</label>
                    <div class="col-sm-9">
                        <input type="text" name="province" value="<?php echo  $hospital->province; ?>" placeholder="province" class="form-control" >
                        <span class="text-danger"><?php echo form_error('province'); ?></span>
                    </div>
                </div>
				  <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Address formatted</label>
                    <div class="col-sm-9">
                        <input type="text" name="address_formatted" value="<?php echo  $hospital->address_formatted; ?>" placeholder="address formatted" class="form-control" >
                        <span class="text-danger"><?php echo form_error('address_formatted'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Telephone</label>
                    <div class="col-sm-9">
                        <input type="text" name="telephone" value="<?php echo  $hospital->telephone; ?>" placeholder="telephone" class="form-control" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Fax</label>
                    <div class="col-sm-9">
                        <input type="text" name="fax" value="<?php echo  $hospital->fax; ?>" placeholder="fax" class="form-control" >
                    </div>
                </div>
                 <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Website</label>
                    <div class="col-sm-9">
                        <input type="text" name="website" value="<?php echo  $hospital->website; ?>" placeholder="website" class="form-control" >
                        <span class="text-danger"><?php echo form_error('website'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input type="text"  value="<?php echo  $hospital->email; ?>"class="form-control">
                        <span class="text-danger"><?php echo form_error('email'); ?></span>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="email" class="col-sm-3 control-label"></label>
             
                    <div class="col-sm-9">
                        <img style="width:100%;" src="<?php echo  !empty($hospital->image_url) ? $hospital->image_url:base_url().'assets/img/not-available.png' ; ?>" >
                        <span class="text-danger"><?php echo form_error('image_url'); ?></span>
                      
                    </div>

                </div>
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

                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                        <?php echo $this->session->flashdata('msg'); ?>
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