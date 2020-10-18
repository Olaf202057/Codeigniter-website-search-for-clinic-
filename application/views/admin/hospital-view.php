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
        <div class="">
            <div class="row">
                <div class="col-lg-7">
                    <div class="step3">
                        <b><h1>User Details</h1></b>
                        <br/>

                        <h2>Personal Information</h2>
                        <div class="user_box">
                            <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                                <label for="" class="label-txt">First Name <span> : </span>
                                </label>
                            </div>
                            <div class="col-sm-8 col-md-7 col-lg-7">
                                <?php if(isset($user_info[0][ 'firstname']) && (count($user_info[0][ 'firstname'])>0)) { echo ucfirst($user_info[0]['firstname']);} else { echo "NA";}?>
                            </div>
                        </div>
                        <div class="user_box">
                            <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                                <label for="" class="label-txt">Last Name <span> : </span>
                                </label>
                            </div>
                            <div class="col-sm-8 col-md-7 col-lg-7">
                                <?php if(isset($user_info[0][ 'lastname']) && (count($user_info[0][ 'lastname'])>0)) { echo ucfirst($user_info[0]['lastname']);} else { echo "NA";}?>
                            </div>
                        </div>
                        <div class="user_box">
                            <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                                <label for="" class="label-txt">Email Address <span> : </span>
                                </label>
                            </div>
                            <div class="col-sm-8 col-md-7 col-lg-7">
                                <?php if(isset($user_info[0][ 'email']) && (count($user_info[0][ 'email'])>0)) { echo ucfirst($user_info[0]['email']);} else { echo "NA";}?>
                            </div>
                        </div>
                        <div class="user_box">
                            <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                                <label for="" class="label-txt">Registration Type <span> : </span>
                                </label>
                            </div>
                            <div class="col-sm-8 col-md-7 col-lg-7">
                                <?php if(isset($user_info[0][ 'register_type']) && (count($user_info[0][ 'register_type'])>0)) { echo ucfirst($user_info[0]['register_type']);} else { echo "NA";}?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7">
                    <div class="step3">
                        <h2>Billing Details</h2>
                        <div class="user_box">
                            <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                                <label for="" class="label-txt">Business Name <span> : </span>
                                </label>
                            </div>
                            <div class="col-sm-8 col-md-7 col-lg-7">
                                <?php if(isset($user_info[0][ 'business_name']) && (count($user_info[0][ 'business_name'])>0)) { echo ucfirst($user_info[0]['business_name']);} else { echo "NA";}?>
                            </div>
                        </div>
                        <div class="user_box">
                            <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                                <label for="" class="label-txt">Country <span> : </span>
                                </label>
                                <?php $country_name=$this->master_model->getRecords('countries',array('id'=>$user_info[0]['country'])); ?>
                            </div>
                            <div class="col-sm-8 col-md-7 col-lg-7">
                                <?php if(isset($country_name[0][ 'name']) && (count($country_name[0][ 'name'])>0)) { echo ucfirst($country_name[0]['name']);} else { echo "NA";}?>
                            </div>
                        </div>
                        <div class="user_box">
                            <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                                <label for="" class="label-txt">State <span> : </span>
                                </label>
                                <?php $state_name=$this->master_model->getRecords('states',array('id'=>$user_info[0]['state'])); ?>
                            </div>
                            <div class="col-sm-8 col-md-7 col-lg-7">
                                <?php if(isset($state_name[0][ 'name']) && (count($state_name[0][ 'name'])>0)) { echo ucfirst($state_name[0]['name']);} else { echo "NA";}?>
                            </div>
                        </div>
                        <div class="user_box">
                            <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                                <label for="" class="label-txt">City <span> : </span>
                                </label>
                                <?php $city_name=$this->master_model->getRecords('cities',array('id'=>$user_info[0]['city'])); ?>
                            </div>
                            <div class="col-sm-8 col-md-7 col-lg-7">
                                <?php if(isset($city_name[0][ 'name']) && (count($city_name[0][ 'name'])>0)) { echo ucfirst($city_name[0]['name']);} else { echo "NA";}?>
                            </div>
                        </div>
                        <div class="user_box">
                            <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                                <label for="" class="label-txt">Postal Code <span> : </span>
                                </label>

                            </div>
                            <div class="col-sm-8 col-md-7 col-lg-7">
                                <?php if(isset($user_info[0][ 'postal_code']) && (count($user_info[0][ 'postal_code'])>0)) { echo ucfirst($user_info[0]['postal_code']);} else { echo "NA";}?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7">
                    <div class="step3">
                        <h2>Hospital Details</h2>
                          <div class="row">
                            <div class="user_box">
                                <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                                    <label for="" class="label-txt">Hospital Name <span> : </span>
                                    </label>
                                </div>
                                <div class="col-sm-8 col-md-7 col-lg-7">
                                    <?php if(isset($hospital_info) && (count($hospital_info)>0)) { echo ucfirst($hospital_info[0]['hospital']);} else { echo "NA";}?>
                                </div>
                            </div>
                            <div class="user_box">
                                <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                                    <label for="" class="label-txt">Address <span> : </span>
                                    </label>
                                </div>
                                <div class="col-sm-8 col-md-7 col-lg-7">
                                    <?php if(isset($hospital_info) && (count($hospital_info)>0)) { echo ucfirst($hospital_info[0]['address']);} else { echo "NA";}?>
                                </div>

                            </div>

                            <div class="user_box">
                                <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                                    <label for="" class="label-txt">City <span> : </span>
                                    </label>
                                </div>
                                <div class="col-sm-8 col-md-7 col-lg-7">
                                    <?php if(isset($hospital_info) && (count($hospital_info)>0)) { echo ucfirst($hospital_info[0]['city']);} else { echo "NA";}?>
                                </div>

                            </div>
                            <div class="user_box">
                                <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                                    <label for="" class="label-txt">Province <span> : </span>
                                    </label>
                                </div>
                                <div class="col-sm-8 col-md-7 col-lg-7">
                                    <?php if(isset($hospital_info) && (count($hospital_info)>0)) { echo ucfirst($hospital_info[0]['province']);} else { echo "NA";}?>
                                </div>

                            </div>
                            <div class="user_box">
                                <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                                    <label for="" class="label-txt">Telephone <span> : </span>
                                    </label>
                                </div>
                                <div class="col-sm-8 col-md-7 col-lg-7">
                                    <?php if(isset($hospital_info) && (count($hospital_info)>0)) { echo $hospital_info[0]['telephone'];} else { echo "NA";}?>
                                </div>

                            </div>
                            <div class="user_box">
                                <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                                    <label for="" class="label-txt">Fax <span> : </span>
                                    </label>
                                </div>
                                <div class="col-sm-8 col-md-7 col-lg-7">
                                    <?php if(isset($hospital_info) && (count($hospital_info)>0)) { echo $hospital_info[0]['fax'];} else { echo "NA";}?>
                                </div>

                            </div>
                            <div class="user_box">
                                <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                                    <label for="" class="label-txt">Email <span> : </span>
                                    </label>
                                </div>
                                <div class="col-sm-8 col-md-7 col-lg-7">
                                    <?php if(isset($hospital_info) && (count($hospital_info)>0)) { echo $hospital_info[0]['email'];} else { echo "NA";}?>
                                </div>

                            </div>
                            <div class="user_box">
                                <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                                    <label for="" class="label-txt">Website <span> : </span>
                                    </label>
                                </div>
                                <div class="col-sm-8 col-md-7 col-lg-7">
                                    <?php if(isset($hospital_info) && (count($hospital_info)>0)) { echo $hospital_info[0]['website'];} else { echo "NA";}?>
                                </div>

                            </div>
                            <!--  <div class="col-md-2 col-lg-2 m-top">
                  <button class="bg-btn" type="button" name="btn_update_cancel" id="btn_update_cancel" onclick="location.href='<?php echo base_url();?>admin/users/">Back</button>
                     
                  </div> -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7">
                <div class="step3">
                    <h2>Hospital Examination Details</h2>

                    <!--  <div class="cmt-step">Set your preference for when and how you'll pay for your ads. </div> -->
                    <div class="row">
                        <?php if(count($hospital_info)>0) { foreach($hospital_info as $info) { ?>
                        <div class="user_box">
                            <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                                <label for="" class="label-txt">Exam Type <span> : </span>
                                </label>
                            </div>
                            <div class="col-sm-8 col-md-7 col-lg-7">
                                <?php echo ucfirst($info[ 'exam_type']);?>
                            </div>

                            <div class="user_box">
                                <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                                    <label for="" class="label-txt">Common Name <span> : </span>
                                    </label>
                                </div>
                                <div class="col-sm-8 col-md-7 col-lg-7">
                                    <?php echo ucfirst($info[ 'common_name']);?>
                                </div>

                            </div>

                            <div class="user_box">
                                <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                                    <label for="" class="label-txt">Official Waiting Days <span> : </span>
                                    </label>
                                </div>
                                <div class="col-sm-8 col-md-7 col-lg-7">
                                    <?php echo $info[ 'official_waiting_days']; ?>
                                </div>

                            </div>
                            <div class="user_box">
                                <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                                    <label for="" class="label-txt">Reported Waiting Days <span> : </span>
                                    </label>
                                </div>
                                <div class="col-sm-8 col-md-7 col-lg-7">
                                    <?php echo $info[ 'reported_waiting_days']; ?>
                                </div>
                            </div>
                            <?php } } else { echo "<div class='alert alert-danger text-center'>No Record Found..! </div>"; } ?>
                            <div class="clr"></div>
                            <div class="col-md-2 col-lg-2 m-top">
                                <a class="bg-btn" type="button" href="<?php echo base_url();?>admin/users">Back</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>