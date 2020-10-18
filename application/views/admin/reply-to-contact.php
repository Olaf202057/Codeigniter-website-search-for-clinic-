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
             <?php if($this->session->flashdata('success')!='') {?>
            <div class="alert alert-success text-center"><?php echo $this->session->flashdata('success');?></div>
            <?php } else if($this->session->flashdata('error')!=''){?>
            <div class="alert alert-danger text-center"><?php echo $this->session->flashdata('error');?></div>
         <?php } ?>
            <div class="col-md-6 col-md-offset-3">
                <?php echo $this->session->flashdata('verify_msg'); ?>
            </div>
        </div>
        <div class="row">
            <form class="form-horizontal col-md-6" method="post"  role="form" enctype="multipart/form-data">
                <h2>Reply To Contact Enquiry</h2>
                <?php //echo validation_errors(); ?>
                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Email Address :</label>
                    <div class="col-sm-9">
                        <input type="text"  name="email" id="email" value="<?php if($contact_info[0]['email'] != '') { echo $contact_info[0]['email']; } ?>" placeholder="Email" class="form-control" readonly >
                        <span class="text-danger" id="err_email"><?php echo form_error('email'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Reply Message :</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="reply_message" id="reply_message" style="height: 260px;" autofocus><?php echo set_value('reply_message'); ?></textarea>
                        <span class="text-danger" id="err_reply_msg"><?php echo form_error('reply_message'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <div class="col-sm-3"><button type="submit" name="btn_reply" id="btn_reply" class="btn btn-primary btn-block">Reply</button></div>
                        <div class="col-sm-3"><a href="<?php echo base_url().'admin/contactenquiries'; ?>" class="btn btn-primary btn-block">Back</a ></div>
                        <?php echo $this->session->flashdata('msg'); ?>
                    </div>
                </div>
            </form> <!-- /form -->
        </div>
    </div> <!-- ./container -->
</div>

<script type="text/javascript">
    $('#btn_reply').on('click',function(){
        var reply_message = $('#reply_message').val();
        if(reply_message == '')
        {
            $('#err_reply_msg').text('Please enter some message');
            return false;
        }
        else 
        {
            return true;
        }
    });
</script>