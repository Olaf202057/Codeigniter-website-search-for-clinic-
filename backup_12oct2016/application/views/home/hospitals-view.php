<div class="page-title">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">Hospitals</div>
			</div>
		</div>
	</div>

	<div class="hospital-cover"><img class="img-responsive" src="<?php echo base_url() ?>assets/img/hospital.jpg" /></div>
	
	<div class="spacer">
		<div class="container">
			<div class="row">
				<div class="col-sm-7">
					<div class="sr-results">
						<ul>
							<li class="wow slideInUp" style="padding-top:0;">
								<h2><a><?php echo $structure->hospital ?></a></h2>
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.
								<br /><br /><br />
								
								<div class="row">
									<div class="col-sm-6">
										<div class="sr-details">
											<i class="fa fa-map-marker"></i>
											<h4>Location</h4>
											<?php echo $structure->address ?> 
																
										</div><br />
									
										<div class="sr-details">
											<i class="fa fa-file-text-o"></i>
											<h4>Examination</h4>
											<?php 	echo $exam->exam_type; ?>
										</div><br />
										
										<div class="sr-details">
											<i class="fa fa-clock-o"></i>
											<h4>Maximum Waiting Time</h4>
											<?php 
												echo (($exam->official_waiting_days!=null  && $exam->official_waiting_days!=0) ? $exam->official_waiting_days.' days' : 'N/A').'<br/>';
											?>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="sr-details">
											<i class="fa fa-phone"></i>
											<h4>Telephone</h4>
											<?php echo $structure->telephone ?>
										</div><br />
										
										<div class="sr-details">
											<i class="fa fa-calendar-check-o"></i>
											<h4>Reported Waiting Date</h4>
											<?php echo (($exam->reported_waiting_days!=null) ? $exam->reported_waiting_days.' days' : ''); ?>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
                    <div class="container">
                        <div class="row" style="margin-top:40px;">
                            <div class="col-md-6">
                                <?php if(count($reviews)>0){ ?>
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Reviews</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <?php foreach($reviews as $row): ?>
                                        <strong><i class="fa fa-user margin-r-5"></i> <?php echo $row->name ?></strong>  <?php for($x =0;$x<5;$x++){
                                                if( $row->rating>$x){
                                                    echo '<i class="fa fa-star "></i>';
                                                }else{
                                                    echo '<i class="fa fa-star-o "></i>';
                                                }

                                            } ?>
                                            <div><i></i><?php echo $row->submited_date ?></i></div>
                                            <p class="text-muted">
                                                <?php echo $row->comment ?>
                                            </p>

                                          <div>Actual Time : <?php echo $row->actual_time ?></div>


                                        </p>
                                        <hr>
                                        <?php endforeach; ?>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <?php } ?>
                                <div id="review-msg"></div>
                                <div class="">
                                    <?php if(is_login(false)): ?>
                                    <div class="text-right">
                                        <a class="btn btn-success btn-green" href="#reviews-anchor" id="open-review-box">Leave a Review</a>
                                    </div>

                                    <div class="row" id="post-review-box" style="display:none;">
                                        <div class="col-md-12">
                                            <form id="frm-review" method="post">
                                                <div class="col-md-12">
                                                <input id="ratings-hidden" name="rating" type="hidden" value="0">
                                                <input id="ratings-hidden" value="<?php echo $structure->id ?> " name="structure_id" type="hidden">
                                                <input id="ratings-hidden" value="<?php echo $exam->id; ?> " name="exam_id" type="hidden">
                                                <label>Review</label>
                                                <textarea class="form-control animated" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." rows="5"></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Actual spent time</label><input type="number" min="0" class="form-control" value="0" name="actual_time" />
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="text-right">
                                                        <div class="stars starrr" data-rating="0"></div>
                                                        <a class="btn btn-danger btn-sm" href="#" id="close-review-box" style="display:none; margin-right: 10px;">
                                                            <span class="fa fa-remove"></span>Cancel</a>
                                                        <button class="btn btn-success btn-lg" id="btn-review-submit" type="button">Save</button>
                                                    </div>
                                                </div>


                                            </form>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                        <a href="<?php echo base_url('accesso') ?>" class="btn btn-primary pull-right" >creare recensioni</a>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    </div>
				</div>
				<div class="col-sm-4 col-sm-offset-1">
					<div class="google-map wow slideInUp" id="googleMap" style="width:450px;height:380px;" >
					<?php 
								$map_url ="http://maps.googleapis.com/maps/api/staticmap?";
								
								$map_url .= "center=".$structure->address."&zoom=13&scale=false&size=382x382&maptype=roadmap&format=png&visual_refresh=true";
									
								$map_url .="&markers=icon:".base_url()."assets/img/map-marker.png%7Cshadow:true%7C".$structure->address;
								
								 ?>
					<img id="img-map" height="380" width="450" src="<?php echo $map_url ?>" ></div>
				</div>
			</div>
		</div>
	</div>
	<style>

        .text-muted {
            color: #777;
        }
        .box.box-primary {
            border-top-color: #3c8dbc;
        }
        .box {
            background: #ffffff none repeat scroll 0 0;
            border-radius: 3px;
            border-top: 3px solid #d2d6de;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            position: relative;
            width: 100%;
        }
        .animated {
            -webkit-transition: height 0.2s;
            -moz-transition: height 0.2s;
            transition: height 0.2s;
        }

        .stars
        {
            margin: 20px 0;
            font-size: 24px;
            color: #d17581;
            cursor: pointer;
        }
	</style>
