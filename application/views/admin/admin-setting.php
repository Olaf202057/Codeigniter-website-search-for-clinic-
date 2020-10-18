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
            <div class="col-sm-12">
                <!-- Nav tabs -->
                <?php $this->load->view('admin/include/admin-menu-view') ?>

                <!-- Tab panes -->
                <div class="tab-content">
                    <form method="post" class="form-horizontal" id="admin_setting">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-md-6">
                            <div class="box">
                                <div class="box-title">
                                     <h3 class="box-title1">Info Emails</h3>
                                </div>
                                <div class="box-content">
                                    <div class="form-group">
                                        <?php if($this->session->flashdata('success2')!=''){?>
                                        <div class="alert alert-success"><?php echo $this->session->flashdata('success2'); ?></div>
                                        <?php } ?>
                                    </div>
                                    <form method="post" class="form-horizontal" action>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-md-3 control-label">Info Email</label>
                                            <div class="col-sm-8 col-md-8 controls">
                                                <input type="text" class="form-control" name="info_email" id="info_email" value="<?php echo $emails[0]['info_email'];?>" data-rule-required="true" />
                                                <div class="error" id="error_info_email" ></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-md-3 control-label">Contact Email</label>
                                            <div class="col-sm-8 col-md-8 controls">
                                                <input type="text" class="form-control" name="contact_email" id="contact_email" value="<?php echo $emails[0]['contact_email'];?>" data-rule-required="true" />
                                                <div class="error" id="error_contact_email" ></div>
                                            </div>
                                        </div>
                                       
                                        <div class="form-group row">
                                            <div class="col-sm-8 col-sm-offset-4 col-md-4 col-md-offset-7">
                                                <button type="submit" class="btn btn-primary" name="btn_emails"id="btn_emails">Submit</button>
                                                <a class="btn" href="<?php echo base_url();?>admin">Cancel</a>
                                            </div>
                                       </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

$('#btn_click_price').on('click', function() {
      
  var price   = $('#price').val();
  $('#error_price').html('');
  if(price.trim()=='')
  {
    $('#error_price').html('Please enter price');
    return false;
  }
  else
    return true;

  });
$('#btn_emails').on('click', function() {
      
  var filter =  /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  var info_email   = $('#info_email').val();
  var contact_email   = $('#contact_email').val();
  var flag =1;

  $('#error_info_email').html('');
  $('#error_contact_email').html('');

  if(info_email.trim()=='')
  {
    $('#error_info_email').html('Please enter info email');
    flag = 0;
  }
  else if(!filter.test(info_email))
  {
    $('#error_info_email').html('Please enter valid info email');
    flag = 0;
  }
 if(contact_email.trim()=='')
  {
    $('#error_contact_email').html('Please enter contact email');
     flag = 0;
  }
  else  if(!filter.test(contact_email))
  {
    $('#error_contact_email').html('Please enter valid contact email');
     flag = 0;
  }

    if(flag == 0)
        return false
    else
        return true;

  });

</script>