@extends('admin.layouts.master')
@section('middle_section')
<!-- BEGIN Page Title -->
<style>
.error{
    color : red;
}
</style>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/bootstrap-switch/static/js/bootstrap-switch.js"></script>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/bootstrap-switch/static/stylesheets/bootstrap-switch.css" />

<div id="main-content">
    <div class="page-title">
        <div>
            <h1><i class="fa fa-building-o"></i> Update Congregation </h1>
            <h4>Update Congregation</h4>
        </div>
    </div>
    <!-- END Page Title -->
    <!-- BEGIN Breadcrumb -->
      <?php 

      if(Request::segment(4)=='banner')
        {

            $str = "noBannerImages";
            $str1 = "report";
        }
        else if(Request::segment(4)=='report')
        {
            $id =  Request::segment(5) ;
            $ven_id =  Request::segment(6) ;
            $str = "congregations/$ven_id";
            $str1 = "report";
        }
        else if(Request::segment(4)=='meeting')
        {
            
            $str = "meeting";
            $str1 = "congregations";
        }
        else
        {
            $str = "manage";
            $str1 = "congregation";
        }
        ?>
    <div id="breadcrumbs">
        <ul class="breadcrumb">
            <li title="Dashboard" ><i class="fa fa-home"></i><a href="{{ url('/') }}/superadmin/dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span>
            </li>
            <li title="Manage Congregation" ><a href="{{ url('/') }}/superadmin/{{ $str1 }}/{{$str}}">Manage Congregation</a> <span class="divider"><i class="fa fa-angle-right"></i></span>
            </li>
            <li class="active">Update Congregation</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->
    <!-- BEGIN Main Content -->

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>Update Congregation</h3>
                </div>

              


                <div class="box-content">
                          <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12">
                               @if(Session::has('error'))
                               <div class="alert alert-danger">{{Session::get('error')}}</div>
                               @endif
                               @if(Session::has('success'))
                               <div class="alert alert-success">{{Session::get('success')}}</div>
                               @endif
                             </div>
                          </div>


                         <?php $midd_met_day = "";
                            if($cong_details[0]['midd_met_day']=="none")
                                {$midd_met_day = "None";}
                            elseif($cong_details[0]['midd_met_day']=="mon")
                                {$midd_met_day = "Monday";}
                            elseif($cong_details[0]['midd_met_day']=="tue")
                                {$midd_met_day = "Tuesday";}
                            elseif($cong_details[0]['midd_met_day']=="wed")
                                {$midd_met_day = "Wednusday";}
                            elseif($cong_details[0]['midd_met_day']=="thu")
                                {$midd_met_day = "Thursday";}
                            elseif($cong_details[0]['midd_met_day']=="fri")
                                {$midd_met_day = "Friday";}
                            elseif($cong_details[0]['midd_met_day']=="sat")
                                {$midd_met_day = "Saturday";}
                            elseif($cong_details[0]['midd_met_day']=="sun")
                                {$midd_met_day = "Sunday";}
                         ?>
                          <?php $wek_met_day = "";
                            if($cong_details[0]['midd_met_day']=="none")
                                {$wek_met_day = "None";}
                            elseif($cong_details[0]['midd_met_day']=="mon")
                                {$wek_met_day = "Monday";}
                            elseif($cong_details[0]['midd_met_day']=="tue")
                                {$wek_met_day = "Tuesday";}
                            elseif($cong_details[0]['midd_met_day']=="wed")
                                {$wek_met_day = "Wednusday";}
                            elseif($cong_details[0]['midd_met_day']=="thu")
                                {$wek_met_day = "Thursday";}
                            elseif($cong_details[0]['midd_met_day']=="fri")
                                {$wek_met_day = "Friday";}
                            elseif($cong_details[0]['midd_met_day']=="sat")
                                {$wek_met_day = "Saturday";}
                            elseif($cong_details[0]['midd_met_day']=="sun")
                                {$wek_met_day = "Sunday";}
                         ?>

                        <div class="col-md-12">
                            <?php if($cong_details[0]['use_google_map']=='no'){ ?>
                            <div class="col-sm-4 col-lg-4 control-label">
                             <div class="col-sm-5 col-lg-5 controls">
                              <?php if($cong_details[0]['banner_image']!="")
                                      $img =  $cong_details[0]['banner_image'];
                                   else
                                      $img = "dummypic.jpg";
                              ?>
                              <div class=""><img src="{{ url('/')}}/public/uploads/congregation_pic/{{ $img }}" width="400" height="200" ></div>
                            </div>
                            </div>
                            <?php  } 
                            else
                            { ?>
                            <div class="col-sm-4 col-lg-4 control-label">
                             
                              <div class="img_related_prod">
                                   <iframe  width="100%"  frameborder="0" style="border:0"  scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=<?php echo $cong_details[0]['latitude'].",".$cong_details[0]['longuitude'];?>&output=embed"></iframe>
                              </div>
                            
                            </div>
                            <?php } ?>

                            
                            <div class="col-sm-8 col-lg-8 control-label">
                                 <div class="col-sm-8 col-lg-8 controls" >
                               
                              <b> <?php if(count($country1)>0){ echo $country1[0]['country_name'];} ?>  <?php if(count($city)>0){ echo " - ". $city[0]['city_name'] ;}?> </b></br>
                              {{ $cong_details[0]['congregation_name'] }} <?php if(count($country1)>0){ echo " , ".$country1[0]['country_name'];} ?>   <?php if(count($city)>0){ echo  " - ".$city[0]['city_name'] ;}?> </br>
                           
                                  <b><hr style="border-color: grey !important; "> </b>
                                  <div class="col-sm-4 col-lg-4 controls" >
                                     Midweek Meeting</br>Weekend Meeting
                                  </div>
                                  <div class="col-sm-4 col-lg-4 controls" >
                                    <b> {{ $midd_met_day }} @if($cong_details[0]['midd_met_time']!=''), @endif {{ $cong_details[0]['midd_met_time'] }} </br>
                                        {{ $wek_met_day }} @if($cong_details[0]['wek_met_time']!=''), @endif {{ $cong_details[0]['wek_met_time'] }}</b>
                                  </div>
                                
                                </div>
                            </div>
                            
                        </div>
                 
                    <form method="post" class="form-horizontal" action="{{ url('/') }}/superadmin/editcong" id="validation-form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="act" id="act" value="{{ Request::segment(4) }}" >
                        <input type="hidden" name="cong_id" id="cong_id" value="{{ Request::segment(5) }}" >
                        


                        <div class="tabbable">
                            <div class="form-group"> &nbsp;</div>
                             <b>Congregation tab details</b>

                            <ul id="myTab1" class="nav nav-tabs"> 
                                <li id="congregation_tab" data-tab="congregation" data-tabno="1" class="active tabbing_head" ><a href="#congregation_div" data-tab="congregation"  data-toggle="tab"><i class="fa fa-cog"></i> Congregation </a></li>
                                <li id="phone_setting_tab" data-tab="phone_setting" data-tabno="2" class="tabbing_head" ><a href="#phone_setting_div" data-tab="phone_setting"  data-toggle="tab"><i class="fa fa-phone-square"></i> Phone Settings</a></li>
                                <li id="video_setting_tab" data-tab="video_setting" data-tabno="3" class="tabbing_head" ><a href="#video_setting_div" data-tab="video_setting"  data-toggle="tab"><i class="fa fa-video-camera"></i> Video Settings</a></li>
                                <li id="banner_tab" data-tab="banner" data-tabno="4" class="tabbing_head" ><a href="#banner_div" data-tab="banner"  data-toggle="tab"><i class="fa fa-map-marker"></i> Banner</a></li>
                                <li id="audio_tab" data-tab="audio" data-tabno="4" class="tabbing_head" ><a href="#audio_div" data-tab="audio" data-toggle="tab"><i class="fa fa-volume-up"></i> Audio Settings</a></li>
                                <li id="order_date_tab" data-tab="order_date" data-tabno="5" class="tabbing_head" ><a href="#order_date_div" data-tab="order_date" data-toggle="tab"><i class="fa fa-users"></i> Service Status</a></li>
                                <!-- <li id="service_status_tab" data-tab="service_status" data-tabno="6" class="tabbing_head" ><a href="#service_status_div" data-tab="service_status"  data-toggle="tab"><i class="fa fa-users"></i>Service Status</a></li> -->
                               <!--  <li id="meta_info_tab" data-tab="meta_info" data-tabno="7" class="tabbing_head" ><a href="#meta_info_div" data-tab="meta_info" data-toggle="tab"><i class="fa fa-users"></i>Other Information</a></li> -->
                                <li id="email_tab" data-tab="email" data-tabno="8" class="tabbing_head" ><a href="#email_div" data-tab="email" data-toggle="tab"><i class="fa fa-envelope"></i>Email</a></li>
                                <li id="user_tab" data-tab="user" data-tabno="9" class="tabbing_head" ><a href="#user_div" data-tab="user" data-toggle="tab"><i class="fa fa-user"></i>User</a></li>
                                
                            </ul>
                            <div id="myTabContent1" class="tab-content">
                                <div class="tab-pane fade in active tabbing_content" id="congregation_div">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="congregation_name">Congregation Name <span style="color:#F00;">*</span>
                                        </label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <input type="text" class="form-control" name="congregation_name" id="congregation_name" placeholder="Congregation Name" value="{{ $cong_details[0]['congregation_name'] }}" data-rule-required="true" data-tab="congregation" data-tabno="1"  />
                                            <input type="hidden" class="form-control" name="congregation_name1" id="congregation_name1"  value="{{ $cong_details[0]['congregation_name'] }}"   />
                                            <input type="hidden" class="form-control" name="valid_name" id="valid_name"  value=""   />
                                            <div class="error" id="err_congregation_name">{{ $errors->first('congregation_name') }}</div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="kingdomhall_image">KingdomHall Image</label>
                                        <div class="col-sm-9 col-lg-9 controls">
                                             <?php if($cong_details[0]['kingdomhall_image']!="")
                                                    $img =  $cong_details[0]['kingdomhall_image'];
                                                 else
                                                    $img = "dummypic.jpg";
                                                ?>
                                                <div class=""><img class="fileimage" src="{{ url('/') }}/public/uploads/congregation_pic/{{ $img }}" width="400" height="200" ></div>
                                            
                                            <input type="file" class="form-control bimage kimage" name="kingdomhall_image" id="kingdomhall_image" data-tab="congregation" data-tabno="1" style="margin-top: 10px"/>
                                            <div id="btn_upload1" style="display: none;">
                                             <button type="submit" class="btn  tabbing_btn" data-tab="congregation" id="btn_save_cong" ><span class="glyphicon glyphicon-ok"></span> upload </button>
                                           </div>
                                            <div class="error_msg error" id="error_kingdomhall_image"></div>
                                            <p>
                                              <ul>
                                                <li>File must be less than <b>10mb</b></li>
                                                <li>Allowed types are <b>jpg | png | gif | jpeg</b></li>
                                              </ul>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="banner_image">Banner</label>
                                        <div class="col-sm-9 col-lg-9 controls">
                                            
                                            <?php 
                                            if($cong_details[0]['use_google_map']=='yes') 
                                                $img1 = '';
                                             else if($cong_details[0]['banner_image']!="")
                                                $img1 =  $cong_details[0]['banner_image'];
                                             else
                                                $img1 = "dummypic.jpg";
                                            ?>

                                                <div class="ban_image" style="<?php  if($cong_details[0]['use_google_map']=='yes')echo 'display:none;' ?>"><img class="fileimage1" src="{{ url('/')}}/public/uploads/congregation_pic/{{ $img1 }}" width="400" height="200" ></div>

                                            <?php if($cong_details[0]['banner_image']!=""){  echo "<br><br>".$cong_details[0]['banner_image'] ?>
                                             
                                             <button name="" id="remove_banner" value="remove_banner" data-id="{{$cong_details[0]['congregation_id'] }}" data-name="{{ $cong_details[0]['banner_image'] }}"> Remove banner image</button>

                                             <?php  } ?>
                                            <input type="file" class="form-control bimage" name="banner_image" id="banner_image" data-tab="congregation" data-tabno="1" style="margin-top: 10px"/>
                                           <div id="btn_upload" style="display: none;">
                                                <button type="submit" class="btn tabbing_btn" data-tab="congregation" id="btn_save_cong" ><span class="glyphicon glyphicon-ok"></span> Upload </button>
                                           </div>
                                            <div class="error_msg error" id="error_banner_image"></div>
                                            <p style="margin-top: 10px">[ If no photo is uploaded, a default photo will be used, best viewing size <b>(960 X 360)</b> ]</p>
                                            <p>
                                              <ul>
                                                <li>File must be less than <b>512KB</b></li>
                                                <li>Allowed types are <b>jpg | png | gif | jpeg</b></li>
                                              </ul>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="url_server">URL Server</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <input type="text" class="form-control" name="url_server" id="url_server" placeholder="http://" value="{{ $cong_details[0]['url_server'] }}" data-tab="congregation" data-tabno="1" />
                                            <div class="error" id="err_url_server"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="port">Port</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <input type="text" class="form-control" name="port" id="port" placeholder="Port" value="{{ $cong_details[0]['port'] }}" data-tab="congregation" data-tabno="1" />
                                            <div class="error" id="err_port"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-2 control-label" for="news_description"><b>Congregation</b></label>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="cong_country">Country</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <select name="cong_country" id="cong_country" class="form-control" data-tab="congregation" data-tabno="1" >
                                                <option value=''>Select Country</option>
                                                @foreach ($country as $country_name)
                                                    <option value="{{ $country_name['country_id'] }}" <?php if($cong_details[0]['cong_country']==$country_name['country_id']){echo "selected='selected'";} ?>> {{ $country_name['country_name'] }}</option>
                                                @endforeach
                                            </select>
                                            <div class="error" id="err_cong_country"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="cong_state">State</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <select name="cong_state" id="cong_state" class="form-control" data-tab="congregation" data-tabno="1">
                                                <option value=''>Select State</option>
                                                @if(count($state)>0)
                                                    @foreach($state as $stat)
                                                        <option value="{{ $stat['state_id'] }}" <?php if($cong_details[0]['cong_state']==$stat['state_id']){echo "selected='selected'";} ?> >{{ $stat['state_name'] }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div class="error" id="err_cong_state"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="cong_city">City</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <select name="cong_city" id="cong_city" class="form-control" data-tab="congregation" data-tabno="1">
                                                <option value=''>Select City</option>
                                                @if(count($city)>0)
                                                    @foreach($city as $cit)
                                                        <option value="{{ $cit['state_id'] }}" <?php if($cong_details[0]['cong_city']==$cit['city_id']){echo "selected='selected'";} ?> >{{ $cit['city_name'] }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div class="error" id="err_cong_city"></div>
                                        </div>
                                    </div>
                                    <div class="form-group"></div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="continent">Continent</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <select name="continent" id="continent" class="form-control" data-rule-required="true" data-tab="congregation" data-tabno="1">
                                                <option value=''>Select Continent</option>
                                                <option <?php if($cong_details[0]['continent']=="usa"){echo "selected='selected'";} ?> value="usa">U.S.A.</option>
                                                <option <?php if($cong_details[0]['continent']=="ns"){echo "selected='selected'";} ?> value="ns">North / South America</option>
                                                <option <?php if($cong_details[0]['continent']=="ea"){echo "selected='selected'";} ?> value="ea">Europe / Asia</option>
                                                <option <?php if($cong_details[0]['continent']=="aao"){echo "selected='selected'";} ?> value="aao">Africa / Australia / Others</option>
                                            </select>
                                            <div class="error" id="err_continent"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-2 control-label" for="news_description"><b>Midweek Meeting</b></label>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="midd_met_day">Day</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <select name="midd_met_day" id="midd_met_day" class="form-control" data-tab="congregation" data-tabno="1">
                                                <option <?php if($cong_details[0]['midd_met_day']=="none"){echo "selected='selected'";} ?> value="none">None</option>
                                                <option <?php if($cong_details[0]['midd_met_day']=="mon"){echo "selected='selected'";} ?> value="mon">Monday</option>
                                                <option <?php if($cong_details[0]['midd_met_day']=="tue"){echo "selected='selected'";} ?> value="tue">Tuesday</option>
                                                <option <?php if($cong_details[0]['midd_met_day']=="wed"){echo "selected='selected'";} ?> value="wed">Wednusday</option>
                                                <option <?php if($cong_details[0]['midd_met_day']=="thu"){echo "selected='selected'";} ?> value="thu">Thursday</option>
                                                <option <?php if($cong_details[0]['midd_met_day']=="fri"){echo "selected='selected'";} ?> value="fri">Friday</option>
                                                <option <?php if($cong_details[0]['midd_met_day']=="sat"){echo "selected='selected'";} ?> value="sat">Saturday</option>
                                                <option <?php if($cong_details[0]['midd_met_day']=="sun"){echo "selected='selected'";} ?> value="sun">Sunday</option>
                                            </select>
                                            <div class="error" id="err_midd_met_day"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="midd_met_time">Time </label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <select name="midd_met_time" id="midd_met_time" class="form-control" data-tab="congregation" data-tabno="1">
                                                <option value="none">-None-</option>
                                            </select>
                                            <div class="error" id="err_midd_met_time"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="midd_met_dur">Duration</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <input type="text" class="form-control" name="midd_met_dur" id="midd_met_dur" placeholder="Meeting Duration in min" value="{{ $cong_details[0]['midd_met_dur'] }}" data-tab="congregation" data-tabno="1"/>
                                            <div class="error" id="err_midd_met_dur"></div>
                                        </div>
                                    </div>
                                    <div class="form-group"></div>

                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-2 control-label" for="news_description"><b>Weekend Meeting</b></label>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="wek_met_day">Day</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <select name="wek_met_day" id="wek_met_day" class="form-control" data-tab="congregation" data-tabno="1">
                                                <option <?php if($cong_details[0]['wek_met_day']=="none"){echo "selected='selected'";} ?> value="none">None</option>
                                                <option <?php if($cong_details[0]['wek_met_day']=="mon"){echo "selected='selected'";} ?> value="mon">Monday</option>
                                                <option <?php if($cong_details[0]['wek_met_day']=="tue"){echo "selected='selected'";} ?> value="tue">Tuesday</option>
                                                <option <?php if($cong_details[0]['wek_met_day']=="wed"){echo "selected='selected'";} ?> value="wed">Wednusday</option>
                                                <option <?php if($cong_details[0]['wek_met_day']=="thu"){echo "selected='selected'";} ?> value="thu">Thursday</option>
                                                <option <?php if($cong_details[0]['wek_met_day']=="fri"){echo "selected='selected'";} ?> value="fri">Friday</option>
                                                <option <?php if($cong_details[0]['wek_met_day']=="sat"){echo "selected='selected'";} ?> value="sat">Saturday</option>
                                                <option <?php if($cong_details[0]['wek_met_day']=="sun"){echo "selected='selected'";} ?> value="sun">Sunday</option>
                                            </select>
                                            <div class="error" id="err_wek_met_day"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="wek_met_time">Time </label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <select name="wek_met_time" id="wek_met_time" class="form-control" data-tab="congregation" data-tabno="1">
                                                <option value="none">-None-</option>
                                            </select>
                                            <div class="error" id="err_wek_met_time"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="wek_met_dur">Duration</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <input type="text" class="form-control" name="wek_met_dur" id="wek_met_dur" placeholder="Meeting Duration in min" value="{{ $cong_details[0]['wek_met_dur'] }}" data-tab="congregation" data-tabno="1" />
                                            <div class="error" id="err_wek_met_dur"></div>
                                        </div>
                                    </div>
                                    <div class="form-group"></div>

                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="cong_phone">Congregation Phone</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <input type="text" class="form-control" name="cong_phone" id="cong_phone" placeholder="Congregation Phone " value="{{  $cong_details[0]['cong_phone'] }}" data-tab="congregation" data-tabno="1" />
                                            <div class="error" id="err_cong_phone"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="acc_name">Stream Account Name</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <input type="text" class="form-control" name="acc_name" id="acc_name" placeholder="Stream Account Name" value="{{ $cong_details[0]['acc_name'] }}" data-tab="congregation" data-tabno="1" />
                                            <div class="error" id="err_acc_name"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="reference_link"> JW Reference Material Link</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <input type="text" class="form-control" name="reference_link" id="reference_link" placeholder="http://" value="{{ $cong_details[0]['reference_link'] }}" data-tab="congregation" data-tabno="1" />
                                            <div class="error" id="err_reference_link"></div>
                                        </div>
                                    </div>


                                     <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="timezone">Time Zone<span style="color:#F00;">*</span>
                                        </label>
                                        <?php 
                                           $idents = DateTimeZone::listIdentifiers();

                                           $timezone1 = date_default_timezone_get();
                                        ?>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <select name="timezone" id="timezone" class="form-control" data-tab="congregation" data-tabno="1">
                                                <option value=''>Select timezone</option>
                                                <?php foreach($idents as $aa) {
                                                date_default_timezone_set($aa);
                                                $time = $aa.": ".$date= date('l, F, d, Y h:i:A') ;?>
                                                    <option value="<?php echo $aa ; ?>" <?php if($cong_details[0]['timezone']==$aa) echo "selected";?> ><?php echo $time;?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="error" id="err_timezone">{{ $errors->first('timezone') }}</div>
                                        </div>
                                        <?php date_default_timezone_set($timezone1) ; ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="kh_admin">Kingdom Hall Admin</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <input type="text" class="form-control" name="kh_admin" id="kh_admin" placeholder="Enter Kingdom Hall Admin Name" value="{{ $cong_details[0]['kh_admin'] }}" data-tab="congregation" data-tabno="1" />
                                            <div class="error" id="err_kh_admin"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="rq_usr_reg">Required User Registration</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <select name="rq_usr_reg" id="rq_usr_reg" class="form-control" value="on" data-tab="congregation" data-tabno="1" >
                                                <option <?php if($cong_details[0]['rq_usr_reg']=="yes"){echo "selected='selected'";} ?> value="yes">Yes</option>
                                                <option <?php if($cong_details[0]['rq_usr_reg']=="no"){echo "selected='selected'";} ?> value="no">No</option>
                                            </select>
                                            <div class="error" id="err_rq_usr_reg"></div>
                                        </div>
                                    </div>




                                  <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="list_pass">Listening Password<span style="color:#F00;">*</span>
                                        </label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <input type="text" class="form-control" name="list_pass" id="list_pass" placeholder="Listening Password" value="{{ $cong_details[0]['list_pass'] }}" data-tab="congregation" data-tabno="1" />
                                            <div class="error" id="err_list_pass"> {{ $errors->first('list_pass') }}</div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="atten_pass">Attendance Count Password<span style="color:#F00;">*</span>
                                        </label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <input type="text" class="form-control" name="atten_pass" id="atten_pass" placeholder="Attendance Count Password" value="{{ $cong_details[0]['atten_pass'] }}" data-tab="congregation" data-tabno="1" />
                                            <div class="error" id="err_atten_pass">{{ $errors->first('atten_pass') }}</div>
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <div class="col-sm-9 col-lg-4 controls">&nbsp;</div>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <button type="submit" class="btn btn-primary tabbing_btn" data-tab="congregation" id="btn_save_cong" ><span class="glyphicon glyphicon-ok"></span> Update </button>
                                            <button type="button" class="btn btn-primary tabbing_btn" id="first_tab" data-tabno="2" data-tab="phone_setting" ><span class="glyphicon glyphicon-ok"></span> Next </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade tabbing_content" id="phone_setting_div">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="phone_brcast">Phone BroadCast #</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <input type="text" class="form-control" name="phone_brcast" id="phone_brcast" placeholder="Phone BroadCast" value="{{ $cong_details[0]['phone_brcast'] }}" data-tab="phone_setting" data-tabno="2" />
                                            <div class="error" id="err_phone_brcast"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="lst_cong_pin">Listening Cong Pin #</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <input type="text" class="form-control" name="lst_cong_pin" id="lst_cong_pin" placeholder="Listening Cong Pin" value="{{ $cong_details[0]['lst_cong_pin'] }}" data-tab="phone_setting" data-tabno="2" />
                                            <div class="error" id="err_lst_cong_pin"></div>
                                        </div>
                                    </div>
                                   <!--  <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="admin_cnt_pin">Admin Count Pin #</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <input type="text" class="form-control" name="admin_cnt_pin" id="admin_cnt_pin" placeholder="Admin Count Pin" value="{{ $cong_details[0]['admin_cnt_pin'] }}" data-tab="phone_setting" data-tabno="2" />
                                            <div class="error" id="err_admin_cnt_pin"></div>
                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="channels">Number of channels
                                        </label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <select name="channels" id="channels" class="form-control" data-tab="phone_setting" data-tabno="2">
                                                <option value=''>Select channel</option>
                                               <?php for($i=1;$i<=30;$i++){ ?>
                                                    <option value="{{ $i }}" <?php if($cong_details[0]['channel']==$i) echo "selected"; ?> >{{ $i }}</option>
                                               <?php } ?>
                                            </select>
                                            <div class="error" id="err_channel"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="channels">Phone vendor
                                        </label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <select name="phn_vendor" id="phn_vendor" class="form-control" data-tab="phone_setting" data-tabno="2">
                                                <option value=''>Select vendor</option>
                                                @foreach($phn_ven as $ven)
                                                    <option value="{{ $ven['name'] }}" <?php if($cong_details[0]['phone_vendor']==$ven['name']) echo "selected"; ?> >{{ $ven['name'] }}</option>
                                                @endforeach
                                            </select>
                                            <div class="error" id="err_channel"></div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-sm-9 col-lg-4 controls">&nbsp;</div>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <button type="submit" class="btn btn-primary tabbing_btn" data-tab="phone_setting" id="btn_save_cong" ><span class="glyphicon glyphicon-ok"></span> Update </button>
                                            <button type="button" class="btn btn-primary tabbing_btn" id="second_tab" data-tabno="3" data-tab="video_setting" ><span class="glyphicon glyphicon-ok"></span> Next </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade tabbing_content" id="video_setting_div">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-2 control-label" for="news_description"><b>Video Player</b>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="vdo_hight">Video Height</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <input type="text" class="form-control" name="vdo_hight" id="vdo_hight" placeholder="Video Height" value="{{ $cong_details[0]['vdo_hight'] }}" data-tab="video_setting" data-tabno="3" />
                                            <div class="error" id="err_vdo_hight"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="vdo_width">Video Width</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <input type="text" class="form-control" name="vdo_width" id="vdo_width" placeholder="Video Width" value="{{ $cong_details[0]['vdo_width'] }}" data-tab="video_setting" data-tabno="3" />
                                            <div class="error" id="err_vdo_width"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-3 col-lg-3 control-label" for="rtmp_playback">Stream Name</label>
                                      <div class="col-sm-2 col-lg-3 controls">
                                          <input type="text" class="form-control" name="stream_name" id="stream_name" placeholder="Stream name" value="{{ $cong_details[0]['video_stream_name'] }}" data-tab="video_setting" data-tabno="3" />
                                          <div class="error" id="err_rtmp_playback"></div>
                                      </div>
                                        <label class="btn btn-primary Wowza_Code" ><b>Generate Wowza Code</b></label>
                                        <label class="col-sm-1 col-lg-1 control-label" ></label>
                                        <label class="btn btn-primary ScaleEngine_Code"  ><b>Generate ScaleEngine Code</b></label>
                                       

                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="rtmp_playback">RTMP Playback Flash</label>
                                        <div class="col-sm-9 col-lg-7 controls">
                                            <input type="text" class="form-control" name="rtmp_playback" id="rtmp_playback" placeholder="" value="{{ $cong_details[0]['rtmp_playback'] }}" data-tab="video_setting" data-tabno="3" />
                                            <div class="error" id="err_rtmp_playback"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="hls_playback">HLS PlayBack(IOS/Android/ROKU)</label>
                                        <div class="col-sm-9 col-lg-7 controls">
                                            <input type="text" class="form-control" name="hls_playback" id="hls_playback" placeholder="" value="{{ $cong_details[0]['hls_playback'] }} " data-tab="video_setting" data-tabno="3" />
                                            <div class="error" id="err_hls_playback"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="rtsp_playback">RTSP PlayBack(Legacy Android)</label>
                                        <div class="col-sm-9 col-lg-7 controls">
                                            <input type="text" class="form-control" name="rtsp_playback" id="rtsp_playback" placeholder="" value="{{ $cong_details[0]['rtsp_playback'] }}" data-tab="video_setting" data-tabno="3" />
                                            <div class="error" id="err_rtsp_playback"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-sm-9 col-lg-4 controls">&nbsp;</div>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <button type="submit" class="btn btn-primary tabbing_btn" data-tab="congregation" id="btn_save_cong" ><span class="glyphicon glyphicon-ok"></span> Update </button>
                                            <button type="button" class="btn btn-primary tabbing_btn" data-tabno="4" data-tab="banner" id="third_tab" ><span class="glyphicon glyphicon-ok"></span> Next </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade tabbing_content" id="banner_div">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="use_google_map">Use Google map as a Banner</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            
                                            <select name="use_google_map" id="use_google_map" class="form-control" data-tab="banner" data-tabno="4">
                                                <option value='yes'<?php if($cong_details[0]['use_google_map']=="yes"){ echo "selected='selected'"; }?> >Yes</option>
                                                <option value="no" <?php if($cong_details[0]['use_google_map']=="no"){ echo "selected='selected'"; }?> >No</option>
                                               
                                            </select>

                                            <div class="error" id="err_use_google_map"></div>
                                        </div>
                                    </div>
                                   <!--  <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="timezone">Time Zone<span style="color:#F00;">*</span>
                                        </label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <select name="timezone" id="timezone" class="form-control" data-tab="banner" data-tabno="4">
                                                <option value=''>Select Continent</option>
                                               <?php //foreach($timezone as $zone){ ?>
                                                    <option value="" <?php //if($cong_details[0]['timezone']==$zone['timezone_id']){echo "selected='selected'";} ?> ></option>
                                               <?php //} ?>
                                            </select>
                                            <div class="error" id="err_timezone"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="kh_admin">Kingdom Hall Admin</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <input type="text" class="form-control" name="kh_admin" id="kh_admin" placeholder="Enter Kingdom Hall Admin Name" value="{{ $cong_details[0]['kh_admin'] }}" data-tab="banner" data-tabno="4" />
                                            <div class="error" id="err_kh_admin"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="rq_usr_reg">Required User Registration</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <select name="rq_usr_reg" id="rq_usr_reg" class="form-control" value="on" data-tab="banner" data-tabno="4" >
                                                <option <?php //if($cong_details[0]['rq_usr_reg']=="yes"){echo "selected='selected'";} ?> value="yes">Yes</option>
                                                <option <?php //if($cong_details[0]['rq_usr_reg']=="no"){echo "selected='selected'";} ?> value="no">No</option>
                                            </select>
                                            <div class="error" id="err_rq_usr_reg"></div>
                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="snd_mail_to_admin">Send email to Kingdom Hall admin at the time of publishing </label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <input type="checkbox" <?php if($cong_details[0]['snd_mail_to_admin']=="yes"){ echo "checked='checked'"; }?> name="snd_mail_to_admin" id="snd_mail_to_admin" value="on" data-tab="banner" data-tabno="4" >
                                            <div class="error" id="err_snd_mail_to_admin"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-2 control-label" for="snd_mail_to_admin"> <b>Kingdom Hall Details </b></label>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="latitude">Latitude</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Enter Latitude" value="{{ $cong_details[0]['latitude'] }}" data-tab="banner" data-tabno="4" />
                                            <div class="error" id="err_latitude"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="longuitude">Longitude</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <input type="text" class="form-control" name="longuitude" id="longuitude" placeholder="Enter Longitude" value="{{ $cong_details[0]['longuitude'] }}" data-tab="banner" data-tabno="4" />
                                            <div class="error" id="err_longuitude"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-12 control-label" for="">&nbsp;</label>
                                        <div class="col-sm-9 col-lg-12 controls" id="map_canvas" style="height: 32em;">
                                            <iframe width="1200" height="435" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=<?php echo $cong_details[0]['latitude'].",".$cong_details[0]['longuitude'];?>&output=embed"></iframe>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-9 col-lg-4 controls">&nbsp;</div>
                                        <div class="col-sm-9 col-lg-5 controls" style="margin-top: 18px">
                                            <button type="submit" class="btn btn-primary tabbing_btn" data-tab="video_setting" id="btn_save_cong" ><span class="glyphicon glyphicon-ok"></span> Update </button>
                                            <button type="button" class="btn btn-primary tabbing_btn" data-tab="audio" data-tabno="5" id="audio" ><span class="glyphicon glyphicon-ok"></span> Next </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade tabbing_content" id="audio_div">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="record_ado_session">Record Audio Session</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <div class="make-switch" data-on="success" data-off="warning" style="height: 30px;">
                                                <input type="checkbox" <?php if($cong_details[0]['record_ado_session']=="yes"){ echo "checked='checked'"; }?> value="on" name="record_ado_session" id="record_ado_session" data-tab="audio" data-tabno="5"/>
                                            </div>  
                                            <div class="error" id="err_ph_service"></div>
                                        </div>
                                    </div>
                                  <!--   <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="display_rcordng">Display Recordings</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <div class="make-switch" data-on="success" data-off="warning" style="height: 30px;">
                                                <input type="checkbox" <?php if($cong_details[0]['display_rcordng']=="yes"){ echo "checked='checked'"; }?> value="on" name="display_rcordng" id="display_rcordng" data-tab="audio" data-tabno="5" />
                                            </div>  
                                            <div class="error" id="err_ph_service"></div>
                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                        <div class="col-sm-9 col-lg-4 controls">&nbsp;</div>
                                        <div class="col-sm-9 col-lg-5 controls" style="margin-top: 18px">
                                            <button type="submit" class="btn btn-primary tabbing_btn" data-tab="audio" id="btn_save_cong" ><span class="glyphicon glyphicon-ok"></span> Update </button>
                                            <button type="button" class="btn btn-primary tabbing_btn" data-tab="order_date" data-tabno="6" id="seventh_tab" ><span class="glyphicon glyphicon-ok"></span> Next </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade tabbing_content" id="order_date_div">


                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-2 control-label" for="ado_order" style=""><b>Subscription status</b></label>
                                    </div>

                                     <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="default_msg">Default Message</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <textarea class="form-control" name="default_msg" data-tab="service_status" data-tabno="6" id="default_msg" style="resize:none;" placeholder="Enter Default Message">{{ $cong_details[0]['default_msg'] }}</textarea>
                                            <div class="error" id="err_default_msg"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="ado_service">Audio Service</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <div class="make-switch" data-on="success" data-off="warning" style="height: 30px;">
                                                <input type="checkbox" <?php if($cong_details[0]['ado_service']=="yes"){echo "checked='checked'";} ?> value="on" name="ado_service" data-tabno="6" id="ado_service" data-tab="service_status" />
                                            </div>  
                                            <div class="error" id="err_ado_service"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="ph_service">Phone Dial-In Service</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <div class="make-switch" data-on="success" data-off="warning" style="height: 30px;">
                                                <input type="checkbox" <?php if($cong_details[0]['ph_service']=="yes"){echo "checked='checked'";} ?> value="on" name="ph_service" id="ph_service" data-tab="service_status" data-tabno="6" />
                                            </div>  
                                            <div class="error" id="err_ph_service"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="vdo_strem_service">Streaming Video Service</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <div class="make-switch" data-on="success" data-off="warning" style="height: 30px;">
                                                <input type="checkbox" <?php if($cong_details[0]['vdo_strem_service']=="yes"){echo "checked='checked'";} ?> value="on" name="vdo_strem_service" id="vdo_strem_service" data-tab="service_status" data-tabno="6" />
                                            </div>  
                                            <div class="error" id="err_vdo_strem_service"></div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-2 control-label" for="ado_order" style=""><b>Order Details</b></label>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="ado_order">Audio Order #</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <input type="text" class="form-control" name="ado_order" id="ado_order" placeholder="Enter Audio Order" value="{{ $audio_order }}" readonly data-tab="order_date" data-tabno="6" />
                                            <div class="error" id="err_ado_order"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="tel_order">Telephone Order #</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <input type="text" class="form-control" name="tel_order" id="tel_order" placeholder="Enter Telephone Order" value="{{ $channel_order }}" readonly data-tab="order_date" data-tabno="6" />
                                            <div class="error" id="err_tel_order"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="vdo_order">Video Order #</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <input type="text" class="form-control" name="vdo_order" id="vdo_order" placeholder="Enter Video Order" value="{{ $video_order }}" readonly data-tab="order_date" data-tabno="6" />
                                            <div class="error" id="err_vdo_order"></div>
                                        </div>
                                    </div>
                                   <!--  <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="order_bid">Order BID</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <input type="text" class="form-control" name="order_bid" id="order_bid" placeholder="Enter Order Bid" value="{{ $cong_details[0]['order_bid'] }}" data-tab="order_date" data-tabno="6" />
                                            <div class="error" id="err_order_bid"></div>
                                        </div>
                                    </div> -->

                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="news_description"><b>Non-Recurring Date of Expiration(Free)</b></label>
                                    </div>
                                    <div class="form-group">
                                      <?php if(count($free_a)>0)
                                      {

                                            //dd($free_a[0]->end_date);
                                            $ex_date_a = date('Y-m-d',strtotime($free_a[0]->end_date));
                                      }    else
                                            $ex_date_a = '-'; 
                                           if(count($free_v)>0)
                                            $ex_date_v = date('Y-m-d',strtotime($free_v[0]->end_date));
                                           else
                                            $ex_date_v = '-'; 

                                      ?>
                                      <label class="col-sm-3 col-lg-3 control-label" for="ado_order_exp">Audio Order on Expiry Date</label>
                                      <div class="col-sm-9 col-lg-5 controls">
                                          <input type="text" class="form-control date-picker" name="ado_order_exp" id="ado_order_exp" placeholder="Enter Audio Order" value="{{ $ex_date_a}}" data-tab="order_date" data-tabno="6" readonly/>
                                          <div class="error" id="err_ado_order_exp"></div>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-3 col-lg-3 control-label" for="tel_order_exp">Telephone Order on Expiry Date</label>
                                      <div class="col-sm-9 col-lg-5 controls">
                                          <input type="text" class="form-control date-picker" name="tel_order_exp" id="tel_order_exp" placeholder="Enter Telephone Order" value="-" data-tab="order_date" data-tabno="6" readonly/>
                                          <div class="error" id="err_tel_order_exp"></div>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-3 col-lg-3 control-label" for="vdo_order_exp">Video Order Expire on</label>
                                      <div class="col-sm-9 col-lg-5 controls">
                                          <input type="text" class="form-control date-picker" name="vdo_order_exp" id="vdo_order_exp" placeholder="Enter Video Order" value="{{ $ex_date_v}}" data-tab="order_date" data-tabno="6" readonly/>
                                          <div class="error" id="err_vdo_order_exp"></div>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-9 col-lg-4 controls">&nbsp;</div>
                                        <div class="col-sm-9 col-lg-5 controls" style="margin-top: 18px">
                                            <button type="submit" class="btn btn-primary tabbing_btn" data-tab="order_date" id="btn_save_cong" ><span class="glyphicon glyphicon-ok"></span> Update </button>
                                            <button type="button" class="btn btn-primary tabbing_btn" data-tabno="7" data-tab="email" id="fifth_tab" ><span class="glyphicon glyphicon-ok"></span> Next </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- <div class="tab-pane fade tabbing_content" id="meta_info_div">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="menu_title">Menue Link Title</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <input type="text" class="form-control" name="menu_title" id="menu_title" data-tabno="7" placeholder="Menue Link Title" value="{{ $cong_details[0]['menu_title'] }}" data-tab="meta_info" >
                                            <div class="error" id="err_menu_title"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="description">Description</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <textarea class="form-control" name="description" data-tab="meta_info" data-tabno="7" id="description" style="resize:none;" placeholder="Description" >{{ $cong_details[0]['description'] }}</textarea>
                                            <div class="error" id="err_description"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="log_mgs">Revision Log Message</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <textarea class="form-control" name="log_mgs" data-tab="meta_info" data-tabno="7" id="log_mgs" style="resize:none;" placeholder="Revision Log Message" >{{ $cong_details[0]['log_mgs'] }}</textarea>
                                            <div class="error" id="err_log_mgs"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="url_alias">URL Alias</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <textarea class="form-control" name="url_alias" data-tab="meta_info" data-tabno="7" id="url_alias" style="resize:none;" placeholder="Revision Log Message" >{{ $cong_details[0]['url_alias'] }}</textarea>
                                            <div class="error" id="err_url_alias"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="url_alias">Comment Status</label>
                                        <div class="col-sm-9 col-lg-5 controls" style="margin-top: 5px">
                                            <div class="form-group">
                                                <label class="col-sm-1 col-lg-1 control-label" for="open" style="margin-top: -6px" >Open</label>
                                                <div class="col-sm-1 col-lg-1 controls">
                                                    <input type="radio" name="cmt_sett" value="open" id="open" <?php  if($cong_details[0]['cmt_sett']=='open'){echo "checked='checked'";} ?> data-tab="meta_info" data-tabno="7" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-1 col-lg-1 control-label" for="close" style="margin-top: -5px" >Close</label>
                                                <div class="col-sm-1 col-lg-1 controls">
                                                    <input type="radio" name="cmt_sett" value="close" id="close" <?php  if($cong_details[0]['cmt_sett']=='close'){echo "checked='checked'";} ?> data-tab="meta_info" data-tabno="7" >
                                                </div>
                                            </div>
                                            <div class="error" id="err_url_alias"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="meta_tag">Meta tag</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <textarea class="form-control" name="meta_tag" data-tabno="7" data-tab="meta_info" id="meta_tag" style="resize:none;" placeholder="Revision Log Message" >{{ $cong_details[0]['meta_tag'] }}</textarea>
                                            <div class="error" id="err_meta_tag"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="keyword">Keyword</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <textarea class="form-control" name="keyword" data-tabno="7" data-tab="meta_info" id="keyword" style="resize:none;" placeholder="Revision Log Message" >{{ $cong_details[0]['keyword'] }}</textarea>
                                            <div class="error" id="err_keyword"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="authred_by">Authered By</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <input type="text" class="form-control" name="authred_by" id="authred_by" placeholder="Authered By" value="{{ $cong_details[0]['authred_by'] }}" data-tab="meta_info" data-tabno="7" >
                                            <div class="error" id="err_authred_by"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-3 control-label" for="authred_on">Authered On</label>
                                        <div class="col-sm-9 col-lg-5 controls">
                                            <input type="text" class="form-control date-picker" name="authred_on" id="authred_on" placeholder="Authered On" value="{{ $cong_details[0]['authred_on'] }}" data-tab="meta_info" data-tabno="7" readonly/>
                                            <div class="error" id="err_authred_on"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-9 col-lg-4 controls">&nbsp;</div>
                                        <div class="col-sm-9 col-lg-5 controls" style="margin-top: 18px">
                                            <button type="submit" class="btn btn-primary tabbing_btn" data-tab="meta_info" id="btn_save_cong" ><span class="glyphicon glyphicon-ok"></span> Update </button>
                                            <button type="button" class="btn btn-primary tabbing_btn" data-tabno="8" data-tab="email" id="sixth_tab" ><span class="glyphicon glyphicon-ok"></span> Next </button>
                                        </div>
                                    </div>
                                </div>
 -->
                                 <div class="tab-pane fade tabbing_content" id="email_div">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-4 control-label" for="email_alert" style=""><b>Alert and System Configuration</b></label>
                                    </div>
                               
                                
                                    <div class="form-group" align="left">
                                            <label class="col-sm-3 col-lg-4 control-label" for="email_alert" style=""><input type="checkbox" <?php if($cong_details[0]['notify_reach_conn']=="yes"){ echo "checked='checked'"; }?> name="notify_reach_conn" id="notify_reach_conn"  data-tab="banner" data-tabno="8" > Notify yourself if connections reach maximum capacity </label>
                                    </div>
                                    <div class="col-md-12">
                                       
                                        <div class="col-sm-6 col-lg-6 control-label">
                                            <div align="left"> <b>Midweek Meeting</b></div>
                                            <div class="form-group">
                                                <label class="col-sm-8 col-lg-8 control-label" for="email_alert" style=""><input type="checkbox" <?php if($cong_details[0]['mid_email_cnt']=="yes"){ echo "checked='checked'"; }?> name="mid_email_cnt" id="mid_email_cnt"  data-tab="banner" data-tabno="8" >  Email attendance count </label>
                                            </div>
                                           
                                             <div class="col-sm-4 col-lg-4 ">
                                               <b>Every</b></br>
                                               <select name="mid_email_day" id="mid_email_day" class="form-control" data-tab="congregation" data-tabno="8">
                                                    <option  value="none" <?php if($cong_details[0]['mid_email_day']=="none"){ echo "selected"; }?>>None</option>
                                                    <option  value="mon" <?php if($cong_details[0]['mid_email_day']=="mon"){ echo "selected"; }?>>Monday</option>
                                                    <option  value="tue" <?php if($cong_details[0]['mid_email_day']=="tue"){ echo "selected"; }?>>Tuesday</option>
                                                    <option  value="wed" <?php if($cong_details[0]['mid_email_day']=="wed"){ echo "selected"; }?>>Wednusday</option>
                                                    <option  value="thu" <?php if($cong_details[0]['mid_email_day']=="thu"){ echo "selected"; }?>>Thursday</option>
                                                    <option  value="fri" <?php if($cong_details[0]['mid_email_day']=="fri"){ echo "selected"; }?>>Friday</option>
                                                    <option  value="sat" <?php if($cong_details[0]['mid_email_day']=="sat"){ echo "selected"; }?>>Saturday</option>
                                                    <option  value="sun" <?php if($cong_details[0]['mid_email_day']=="sun"){ echo "selected"; }?>>Sunday</option>
                                                </select> 
                                            </div>
                                            <div class="col-sm-4 col-lg-4 ">
                                                <b>Time</b></br>
                                                <select name="mid_email_time" id="mid_email_time" class="form-control" data-tab="congregation" data-tabno="8">
                                                    <option value="none">-None-</option>
                                                </select>
                                            </div>
                                        </br></br></br>
                                            
                                            

                                        </div>
                                        
                                        <div class="col-sm-6 col-lg-6 control-label">
                                             <div align="left"> <b>Weekend Meeting </b></div>
                                            <div class="form-group">
                                                    <label class="col-sm-8 col-lg-8 control-label" for="email_alert" style=""><input type="checkbox" <?php if($cong_details[0]['wknd_email_cnt']=="yes"){ echo "checked='checked'"; }?> name="wknd_email_cnt" id="wknd_email_cnt"  data-tab="banner" data-tabno="8" > Email attendance count  </label>
                                            </div>

                                            <div class="col-sm-4 col-lg-4 ">
                                               <b>Every</b></br>
                                               <select name="wknd_email_day" id="wknd_email_day" class="form-control" data-tab="congregation" data-tabno="1">
                                                  <option  value="none" <?php if($cong_details[0]['wknd_email_day']=="none"){ echo "selected"; }?>>None</option>
                                                    <option  value="mon" <?php if($cong_details[0]['wknd_email_day']=="mon"){ echo "selected"; }?>>Monday</option>
                                                    <option  value="tue" <?php if($cong_details[0]['wknd_email_day']=="tue"){ echo "selected"; }?>>Tuesday</option>
                                                    <option  value="wed" <?php if($cong_details[0]['wknd_email_day']=="wed"){ echo "selected"; }?>>Wednusday</option>
                                                    <option  value="thu" <?php if($cong_details[0]['wknd_email_day']=="thu"){ echo "selected"; }?>>Thursday</option>
                                                    <option  value="fri" <?php if($cong_details[0]['wknd_email_day']=="fri"){ echo "selected"; }?>>Friday</option>
                                                    <option  value="sat" <?php if($cong_details[0]['wknd_email_day']=="sat"){ echo "selected"; }?>>Saturday</option>
                                                    <option  value="sun" <?php if($cong_details[0]['wknd_email_day']=="sun"){ echo "selected"; }?>>Sunday</option>
                                                    
                                                </select> 
                                            </div>
                                           
                                            <div class="col-sm-4 col-lg-4 ">
                                                <b>Time</b></br>
                                                <select name="wknd_email_time" id="wknd_email_time" class="form-control" data-tab="congregation" data-tabno="1">
                                                    <option value="none">-None-</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">&nbsp;</div>
                                    <div class="form-group">&nbsp;</div>
                                    <div class="form-group">&nbsp;</div>
                                    <div class="form-group">
                                      <label class="col-sm-1 col-lg-2 control-label">Enter email addresses : </label>
                                      <div class="col-sm-9 col-lg-7 controls">
                                         <input id="tag-input-1" type="text" class="form-control tags"  placeholder="Enter Email" name="emailid" value="{{ $cong_details[0]['congregation_user_email'] }}"/>
                                      </div>
                                   </div>

                                   
                                 
                                    <div class="form-group">
                                        <div class="col-sm-9 col-lg-4 controls">&nbsp;</div>
                                        <div class="col-sm-9 col-lg-5 controls" style="margin-top: 18px">
                                            <button type="submit" class="btn btn-primary tabbing_btn" data-tab="email" id="btn_save_cong" ><span class="glyphicon glyphicon-ok"></span> Update </button>
                                             <button type="button" class="btn btn-primary tabbing_btn" data-tabno="9" data-tab="user" id="seventh_tab" ><span class="glyphicon glyphicon-ok"></span> Next </button>
                                         </div>
                                    </div>
                                </div>



                                <div class="tab-pane fade tabbing_content" id="user_div">
                                    <div class="table-responsive" style="border:0" id="showBlockUI">
                                        <table class="table table-condensed" <?php //if(count($all_course)>0){?> id="table1"<?php //} ?>>
                                            <thead>
                                               <tr>
                                                <th width="200">Blocked</th>
                                                <th width="400">Full Name</th>
                                                <th width="400">User Name</th>
                                                <th width="400">Email</th>
                                                <th width="300">Last Access IP</th>
                                                <th width="400">Last Access</th>
                                                <th width="200">Access Status</th>
                                               </tr>
                                            </thead>
                                            <tbody id="catList" >
                                          
                                           @if(count($users))
                                             @foreach($users as $user)
                                            <tr>
                                                <td style="width:18px"><input type="checkbox" name="chk_blocked[]" id="chk_blocked" <?php if($user['access_status']=='block' ) echo "checked"; ?> value="{{ $user['rec_id'] }}"/></td>
                                               <td>{{ $user['user_full_name'] }}</td>
                                                 <td></td>
                                                 <td>{{ $user['email'] }}</td>
                                                 <td>{{ $user['ip_address'] }}</td>
                                                 <td>{{ date('d F Y h:i A ',strtotime($user['access_date'] ))}}</td>
                                                 <?php if($user['access_status']=='active')
                                                 { ?>
                                                 <td class="edit1"><a hef="javascript:void();"><img src="{{ url('/')}}/public/images/front/sucess.png" alt="cross"/></a></td>
                                                 <?php  } else {?>
                                                 <td class="edit1"><a hef="javascript:void();"><img src="{{ url('/')}}/public/images/front/cross.png" alt="cross"/></a></td>
                                                 <?php } ?>
                                            </tr>
                                             @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                   
                                    <div class="form-group">
                                        <div class="col-sm-9 col-lg-4 controls">&nbsp;</div>
                                        <div class="col-sm-9 col-lg-5 controls" style="margin-top: 18px">
                                            <!--  <button type="button" class="btn btn-primary tabbing_btn" data-tabno="9" data-tab="user_div" id="seventh_tab" ><span class="glyphicon glyphicon-ok"></span> Next </button> -->
                                            <button type="submit" class="btn btn-primary tabbing_btn" data-tab="user" id="btn_save_cong" ><span class="glyphicon glyphicon-ok"></span> Update </button>

                                            <a class="btn" type="button" href="{{ url('/') }}/superadmin/congregation/{{$str}}">Cancel</a>
                                         </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- END Main Content -->

            
@endsection
<script type="text/javascript">
//populatedropdown(id_of_time_select)
    window.onload=function(){
        populatedropdownselect("midd_met_time","<?php echo $cong_details[0]['midd_met_time'] ?>");
        populatedropdownselect("wek_met_time","<?php echo $cong_details[0]['wek_met_time'] ?>");


        populatedropdownselect("mid_email_time","<?php echo $cong_details[0]['mid_email_time'] ?>");
        populatedropdownselect("wknd_email_time","<?php echo $cong_details[0]['wknd_email_time'] ?>");
    }    
</script>