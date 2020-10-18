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
        <h1> <i class="fa fa-phone"></i>Phone vendor manage</h1>
        <h4>Phone vendor manage</h4>
    </div>
</div>
<!-- END Page Title -->

<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
    <ul class="breadcrumb">
        <li class=""><i class="fa fa-home"></i> <a href="{{ url('/') }}/superadmin/dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span>
            
        </li>
        <li  class="active" >Phone vendor manage</li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title"><h3> <i class="fa fa-phone"></i>Phone vendor manage</h3></div>
            <form name="frm-manage" id="frm-manage" method="post"  action="{{ url('/') }}/superadmin/phonevendor/phoneact">
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
                            <a  href="javascript:void(0);"   data-target="#modal1" data-toggle="modal" class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip"  title="Add Faq"   style="text-decoration:none;"><i class="fa fa-plus"></i></a>
                             <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Active Faqs" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage','active');" style="text-decoration:none;"><i class="fa fa-dot-circle-o"></i></a>
                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Block Faqs" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage','block');"  style="text-decoration:none;"><i class="fa fa-circle-o"></i></a> 
                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Delete Faqs" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage','delete');"  style="text-decoration:none;"><i class="fa fa-trash-o"></i></a> 
                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Refresh" href="{{ url('/') }}/superadmin/phonevendor/manage" style="text-decoration:none;"><i class="fa fa-repeat"></i></a> 
                            
                        </div>
                    </div>
                    <br/><br/>
                    <div class="clearfix"></div>
                    <input type="hidden" name="act_status" id="act_status" value="" />
                    <div class="table-responsive" style="border:0" id="showBlockUI">
                        <table class="table table-condensed" <?php //if(count($all_course)>0){?> id="table1"<?php //} ?>>
                            <thead>
                               <tr>
                                <th style="width:100px"><input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th>
                                <th>Name</th>
                                <th>status</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                             <tbody id="catList" >
                            @if(count($venders)>0)
                                @foreach($venders as $ven)
                                   
                                        <tr>
                                            <td style="width:100px"><input type="checkbox" name="checkbox_del[]" id="checkbox_del" value="{{ $ven['phone_id'] }}"/></td>
                                            <td>{{ $ven['name'] }}</td>
                                           
                                            <td>   
                                                @if($ven['status']=='active')
                                                    <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Active" href="{{ url('/') }}/superadmin/phonevendor/changeStatus/{{ base64_encode($ven['phone_id']) }}/{{'block'}}"  style="text-decoration:none;"><i class="fa fa-dot-circle-o"></i></a>
                                                @else
                                                    <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Block" href="{{ url('/') }}/superadmin/phonevendor/changeStatus/{{ base64_encode($ven['phone_id']) }}/{{'active'}}" style="text-decoration:none;"><i class="fa fa-circle-o"></i></a>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" style="text-decoration:none;" onclick="return delete_confirm()" href="{{ url('/') }}/superadmin/phonevendor/delete/{{ base64_encode($ven['phone_id']) }}"  title="Delete"><i class="fa fa-trash-o"></i></a>
                                                <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip update_phn" style="text-decoration:none;"  data-id="<?php echo $ven['phone_id'];?>"  data-name="<?php echo $ven['name'];?>" href="javascript:void(0);"   data-target="#modal2" data-toggle="modal" title="Edit"><i class="fa fa-edit"></i></a>
                                               
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



<div aria-hidden="false"  id="modal1"  style="display: none;"  class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel2"><b>Phone Vendor.</b></h3>
            </div>
            <form method="post" action="{{ url('/') }}/superadmin/phonevendor/addvendor" id="phn_vendor" >
            {{ csrf_field() }}
                
                <div class="modal-body">
                  
                    <div class="form-group">
                            <label class="col-sm-3 col-lg-6 control-label" for="port">Vendor Name</label>
                            <div class="col-sm-9 col-lg-6 controls">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value=""  />
                                <div class="error" id="err_name"></div>
                            </div>
                             <div class="clearfix"></div>
                        </div>
                    
                    <div class="clearfix"></div>
                </div>
            
                <div style="text-align:left;" class="modal-footer">
                    <div class="col-sm-12">
                        <button class="btn btn-primary" type="submit" name="btn_add_phn_vendor" id="btn_add_phn_vendor" ><i class="fa fa-check"></i>Save</button>
                        <button class="btn" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>




<div aria-hidden="false"  id="modal2"  style="display: none;"  class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel2"><b>Update phone Vendor.</b></h3>
            </div>
            <form method="post" action="{{ url('/') }}/superadmin/phonevendor/update" id="phn_vendor_up" >
            {{ csrf_field() }}
                
                <div class="modal-body">
                   <input type="hidden" name="vendors_ids" id="vendors_ids">
                    <div class="form-group">
                            <label class="col-sm-3 col-lg-6 control-label" for="port">Vendor Name</label>
                            <div class="col-sm-9 col-lg-6 controls">
                                <input type="text" class="form-control" name="new_name" id="new_name" placeholder="Enter name" value=""  />
                                <div class="error" id="err_up_name"></div>
                            </div>
                             <div class="clearfix"></div>
                        </div>
                    
                    <div class="clearfix"></div>
                </div>
            
                <div style="text-align:left;" class="modal-footer">
                    <div class="col-sm-12">
                        <button class="btn btn-primary" type="submit" name="btn_up_phn_vendor" id="btn_up_phn_vendor" ><i class="fa fa-check"></i>Save</button>
                        <button class="btn" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>









@endsection