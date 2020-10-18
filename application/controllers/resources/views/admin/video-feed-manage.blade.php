@extends('admin.layouts.master')

@section('middle_section')



<style>
.error{
    color:red;
}

</style>
<div id="main-content">
   <!-- BEGIN Page Title -->
<div class="page-title">
    <div>
        <h1> <i class="fa fa-video-camera"></i> Video Feed Manage</h1>
        <h4>Video Feed Manage</h4>
    </div>
</div>
<!-- END Page Title -->

<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
    <ul class="breadcrumb">
        <li class=""><i class="fa fa-home"></i> <a href="{{ url('/') }}/superadmin/dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li  class="active" >Video Feed Manage</li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title"><h3> <i class="fa fa-video-camera"></i></i>Video Feed Manage</h3></div>
            <form name="frm-manage" id="frm-manage" method="post"  >
            {{ csrf_field() }}
                <div class="box-content">
                    <div class="col-md-10">
                        @if(Session::has('success'))
                            <div class="alert alert-success" id="no_select" style="">{{ "Success : ".Session::get('success') }}</div>
                        @elseif(Session::has('error'))
                            <div class="alert alert-danger" id="warning_msg" style="">{{ "Error : ".Session::get('error') }}</div>
                        @endif
                    </div>
                    <div class="btn-toolbar pull-right clearfix">
                        <div class="btn-group"> 
                           <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="javascript:void(0);" data-target="#modal2" data-toggle="modal" title="Add Audio Feed"   style="text-decoration:none;"><i class="fa fa-plus"></i></a>
                           <!--    <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Active Faqs" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage','active');" style="text-decoration:none;"><i class="fa fa-dot-circle-o"></i></a>
                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Block Faqs" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage','block');"  style="text-decoration:none;"><i class="fa fa-circle-o"></i></a> 
                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Delete Faqs" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage','delete');"  style="text-decoration:none;"><i class="fa fa-trash-o"></i></a> 
                            --> <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Refresh" href="{{ url('/') }}/superadmin/video/manage" style="text-decoration:none;"><i class="fa fa-repeat"></i></a> 
                            
                        </div>
                    </div>
                    <br/><br/>
                    <div class="clearfix"></div>
                    <input type="hidden" name="act_status" id="act_status" value="" />
                    <div class="table-responsive" style="border:0" id="showBlockUI">
                        <table class="table table-condensed" <?php //if(count($all_course)>0){?> id="table1"<?php //} ?>>
                            <thead>
                               <tr>
                                <th style="width:50px"><input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th>
                                <th>Stream Name</th>
                                <th>FMS URL</th>
                                <th>Password </th>
                                <th>status</th>
                                <th>Date Assigned</th>
                                <th>Assigned to</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                             <tbody id="catList" >
                            @if(count($feeds)>0)
                                @foreach($feeds as $feed)
                                   
                                <tr>
                                    <td style="width:18px"><input type="checkbox" name="checkbox_del[]" id="checkbox_del" value="{{ $feed['feed_id'] }}"/></td>
                                    <td>{{ $feed['stream_name'] }}</td>
                                    <td>{{ $feed['fms_url'] }}</td>
                                    <td>{{ $feed['password'] }}</td>
                                    <td>@if($feed['feed_status']=='unblock') Available @else Block @endif</td>
                                     <?php if($feed['feed_status']=="block"){ ?>
                                    <td>{{ $feed['assign_date'] }}</td>
                                    <td>{{ $feed['assign_to'] }}</td>
                                    <?php }else{ ?>
                                    <td>-</td>
                                    <td>-</td>
                                    <?php } ?>
                                    <td>
                                        <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip video_feed" style="text-decoration:none;"  href="javascript:void(0);" data-target="#modal1" data-toggle="modal" data-id="{{ $feed['feed_id'] }}" data-name="{{ $feed['stream_name'] }}"  data-status="{{ $feed['feed_status'] }}" data-pass="{{ $feed['password'] }}"  data-date="{{ $feed['assign_date'] }}"  data-to="{{ $feed['assign_to'] }}"  data-fms="{{ $feed['fms_url'] }}"  title="Edit"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                    
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="7">No records found</td>
                                    </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="clear"></div>
                </div>
            </form>
        </div>
    </div>
</div>


<div aria-hidden="false" style="display: none;" id="modal1" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel2"><b>Update Video Feed </b></h3>
            </div>
            <form method="post" action="{{ url('/') }}/superadmin/video/update" id="update_video" >
            {{ csrf_field() }}
                <input type="hidden" name="feed_id" id="feed_id" value="">
                <div class="modal-body">
                    
                   <div class="form-group">
                        <label class="col-sm-3 col-lg-6 control-label" for="port">Stream Name<span style="color:#F00;">*</span></label>
                        <div class="col-sm-9 col-lg-6 controls">
                            <input type="text" class="form-control" name="stream_name" id="stream_name" placeholder="Stream Name"  />
                            <div class="error" id="err_stream_name"></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-6 control-label" for="port">FMS URL  <span style="color:#F00;">*</span></label>
                        <div class="col-sm-9 col-lg-6 controls">
                            <input type="text" class="form-control"  name="fms_url" id="fms_url" placeholder="FMS URL"  />
                            <div class="error" id="err_fms_url"></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-6 control-label" for="port">Password <span style="color:#F00;">*</span></label>
                        <div class="col-sm-9 col-lg-6 controls">
                            <input type="text" class="form-control" name="feed_password" id="feed_password" placeholder="Password"  />
                            <div class="error" id="err_feed_password"></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-6 control-label" for="port">Status </label>
                        <div class="col-sm-9 col-lg-6 controls">
                          
                            <select class="form-control"  name="feed_status" id="feed_status">
                                <option value="block">Block
                                </option>
                                <option value="unblock">Unblock
                                </option>
                            </select>
                            <div class="error" id="err_feed_staus"></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-6 control-label" for="port">Date Assigned </label>
                        <div class="col-sm-9 col-lg-6 controls">
                            <input type="text" class="form-control" name="assign_date" id="assign_date" placeholder="Assign date" readonly />
                            <div class="error" id="err_assign_date"></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-6 control-label" for="port">Assigned to </label>
                        <div class="col-sm-9 col-lg-6 controls">
                            <input type="text" class="form-control"  name="assign_to" id="assign_to" placeholder="Enter Email Id"  />
                            <div class="error" id="err_assign_to"></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                    
                    
                    <div class="clearfix"></div>
                </div>
            
                <div style="text-align:left;" class="modal-footer">
                    <div class="col-sm-12">
                        <button class="btn btn-primary" type="submit" name="btn_update_video_feed" id="btn_update_video_feed" ><i class="fa fa-check"></i>Save</button>
                        <button class="btn" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>






<div aria-hidden="false" style="display: none;" id="modal2" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel2"><b>Add Video Feed </b></h3>
            </div>
            <form method="post" action="{{ url('/') }}/superadmin/video/add" id="add_video" >
            {{ csrf_field() }}
               
                <div class="modal-body">
                    
                   <div class="form-group">
                        <label class="col-sm-3 col-lg-6 control-label" for="port">Stream Name<span style="color:#F00;">*</span></label>
                        <div class="col-sm-9 col-lg-6 controls">
                            <input type="text" class="form-control" name="stream_name" id="stream_name_add" placeholder="Stream Name"  />
                            <div class="error" id="err_stream_name_add"></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-6 control-label" for="port">FMS URL  <span style="color:#F00;">*</span></label>
                        <div class="col-sm-9 col-lg-6 controls">
                            <input type="text" class="form-control"  name="fms_url" id="fms_url_add" placeholder="FMS URL"  />
                            <div class="error" id="err_fms_url_add"></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-6 control-label" for="port">Password <span style="color:#F00;">*</span></label>
                        <div class="col-sm-9 col-lg-6 controls">
                            <input type="text" class="form-control" name="feed_password" id="feed_password_add" placeholder="Password"  />
                            <div class="error" id="err_feed_password_add"></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-6 control-label" for="port">Status </label>
                        <div class="col-sm-9 col-lg-6 controls">
                          
                            <select class="form-control"  name="feed_status" id="feed_status_add">
                                <option value="block">Block
                                </option>
                                <option value="unblock">Unblock
                                </option>
                            </select>
                            <div class="error" id="err_feed_staus_add"></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                  
                    
                    
                    <div class="clearfix"></div>
                </div>
            
                <div style="text-align:left;" class="modal-footer">
                    <div class="col-sm-12">
                        <button class="btn btn-primary" type="submit" name="btn_add_video_feed" id="btn_add_video_feed" ><i class="fa fa-check"></i>Save</button>
                        <button class="btn" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>





@endsection