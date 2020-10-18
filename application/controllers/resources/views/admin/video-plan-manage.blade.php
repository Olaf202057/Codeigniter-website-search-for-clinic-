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
        <h1> <i class="fa fa-film"></i> Live Streaming Video</h1>
        <h4>Live Streaming Video</h4>
    </div>
</div>
<!-- END Page Title -->

<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
    <ul class="breadcrumb">
        <li class=""><i class="fa fa-home"></i> <a href="{{ url('/') }}/superadmin/dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span>
            
        </li>
        <li  class="active" >Live Streaming Video</li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title"><h3> <i class="fa fa-film"></i>Live Streaming Video</h3></div>
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
                            <!-- <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ url('/') }}/superadmin/faq/add" title="Add Faq"   style="text-decoration:none;"><i class="fa fa-plus"></i></a>
                             <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Active Faqs" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage','active');" style="text-decoration:none;"><i class="fa fa-dot-circle-o"></i></a>
                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Block Faqs" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage','block');"  style="text-decoration:none;"><i class="fa fa-circle-o"></i></a> 
                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Delete Faqs" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage','delete');"  style="text-decoration:none;"><i class="fa fa-trash-o"></i></a> 
                            --> <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Refresh" href="{{ url('/') }}/superadmin/plan/video" style="text-decoration:none;"><i class="fa fa-repeat"></i></a> 
                            
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
                                
                                <th>Members</th>
                                <th>Price</th>
                               <!--  <th>status</th> -->
                                <th>Action</th>
                              </tr>
                            </thead>
                             <tbody id="catList" >
                            @if(count($plans)>0)
                                @foreach($plans as $plan)
                                   
                                        <tr>
                                            <td style="width:18px"><input type="checkbox" name="checkbox_del[]" id="checkbox_del" value="{{ $plan['plan_id'] }}"/></td>
                                            <td>{{ $plan['members'] }}</td>
                                            <td>
                                                ${{ $plan['price'] }}
                                            </td>
                                         
                                        
                                            <td>
                                                <!-- <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" style="text-decoration:none;" onclick="return delete_confirm()" href="{{ url('/') }}/superadmin/plan/delete/{{ base64_encode($plan['plan_id']) }}"  title="Delete"><i class="fa fa-trash-o"></i></a> -->
                                                <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip set_price" style="text-decoration:none;"  href="javascript:void(0);" data-target="#modal1" data-toggle="modal" data-planid="{{ $plan['plan_id'] }}" data-planmem="{{ $plan['members'] }}"  data-planprice="{{ $plan['price'] }}"   title="Edit"><i class="fa fa-edit"></i></a>
                                                <!-- <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" style="text-decoration:none;" href="{{ url('/') }}/superadmin/faq/view/{{ base64_encode($plan['plan_id']) }}"  title="View"><i class="fa fa-eye"></i></a> -->
                                                
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
                <h3 id="myModalLabel2"><b>Update Video Plan </b></h3>
            </div>
            <form method="post" action="{{ url('/') }}/superadmin/plan/updatevideo" id="vendor_pop" >
            {{ csrf_field() }}
                <input type="hidden" name="plan_id" id="plan_id" value="">
                <div class="modal-body">
                    
                   <div class="form-group">
                        <label class="col-sm-3 col-lg-6 control-label" for="port">Members</label>
                        <div class="col-sm-9 col-lg-6 controls">
                            <input type="text" class="form-control" name="member" id="plan_member" placeholder="Members"  />
                            <div class="error" id="err_member"></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-6 control-label" for="port">Price</label>
                        <div class="col-sm-9 col-lg-6 controls">
                            <input type="text" class="form-control"  name="price" id="plan_price" placeholder="Price"  />
                            <div class="error" id="err_price"></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                    
                    
                    <div class="clearfix"></div>
                </div>
            
                <div style="text-align:left;" class="modal-footer">
                    <div class="col-sm-12">
                        <button class="btn btn-primary" type="submit" name="btn_update_plan" id="btn_update_plan" ><i class="fa fa-check"></i>Save</button>
                        <button class="btn" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>





@endsection