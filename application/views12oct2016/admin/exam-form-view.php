<div class="spacer">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?php echo $this->session->flashdata('verify_msg'); ?>
            </div>
        </div>
        <div class="row">
            <form class="form-horizontal col-md-6" method="post" role="form">

                <h2>Update Exam</h2>
                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Exam Type</label>
                    <div class="col-sm-9">
                        <input type="text"  name="exam_type" value="<?php echo $exam->exam_type; ?>" placeholder="exam type" class="form-control" autofocus>
                        <span class="text-danger"><?php echo form_error('exam_type'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Common Name</label>
                    <div class="col-sm-9">
                        <input type="text"  name="common_name" value="<?php echo $exam->common_name; ?>" placeholder="common name" class="form-control" >
                        <span class="text-danger"><?php echo form_error('common_name'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Official waiting days</label>
                    <div class="col-sm-9">
                        <input type="number" name="official_waiting_days" value="<?php echo  $exam->official_waiting_days; ?>" placeholder="official waiting days" class="form-control" >
                        <span class="text-danger"><?php echo form_error('official_waiting_days'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Reported waiting days</label>
                    <div class="col-sm-9">
                        <input type="number" name="reported_waiting_days" value="<?php echo  $exam->reported_waiting_days; ?>" placeholder="reported waiting days" class="form-control" >
                        <span class="text-danger"><?php echo form_error('reported_waiting_days'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Price</label>
                    <div class="col-sm-9">
                        <input type="number" name="price" value="<?php echo  $exam->price; ?>" placeholder="price" class="form-control" >
                        <span class="text-danger"><?php echo form_error('price'); ?></span>
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

