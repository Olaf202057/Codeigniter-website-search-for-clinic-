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
        <h1><i class="fa fa-file-o"></i> Manage Users</h1>
        <h4>Manage Users</h4>
    </div>
</div>
<!-- END Page Title -->

<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
    <ul class="breadcrumb">
        <li class=""><i class="fa fa-home"></i> <a href="{{ url('/') }}/superadmin/dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li  class="active" >Manage Users</li>
    </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Tiles -->
<!-- END Tiles -->
<!-- BEGIN Main Content -->
    
 <div class="row">
   <div class="col-md-12">
    <div class="box">
     <div class="box-title"><h3><i class="fa fa-table"></i>Manage Users</h3></div>
     <form name="frm-manage" id="frm-manage" method="get" action="{{ url('/') }}/superadmin/users/manage">
        
       <div class="box-content">
         <div class="col-md-10">
            @if(Session::has('success'))
                <div class="alert alert-success" id="no_select" style="">{{ "Success : ".Session::get('success') }}</div>
            @elseif(Session::has('error'))
                <div class="alert alert-danger" id="warning_msg" style="">{{ "Error : ".Session::get('error') }}</div>
            @endif
         </div>
          <div class="col-md-10">
                <div class="col-md-12 form-group">
                    <label class="col-sm-3 col-lg-2 " style="margin-top:6px;">Vendor name: </label>
                    <div class="col-sm-1 col-lg-2 controls">
                      <input type="text"  placeholder="Vendor Name"  id="vendor_name" name="vendor_name" class="form-control"  value="@if(isset($search_arr)){{ trim($search_arr['vendor_name']) }}@endif"  >
                    </div>

                    <label class="col-sm-1 col-lg-1 " style="margin-top:6px;">Email: </label>
                    <div class="col-sm-1 col-lg-3 controls">
                      <input type="text"  placeholder="Vendor Email"  id="vendor_email" name="vendor_email" class="form-control"  value="@if(isset($search_arr)){{ trim($search_arr['vendor_email']) }}@endif"  >
                    </div>
                    
                 <div class="col-sm-2">
                    <input id="btn_search" class="form-control btn btn-primary search_vendor" type="submit" value="Search" name="btn_search">
                 </div>
                 <div class="col-sm-1">
                     <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ url('/') }}/superadmin/users/manage" title="vendors"  style="text-decoration:none;"><i class="fa fa-repeat"></i></a>
                 </div>
                </div> 
               
          </div>
          <div class="col-md-12 form-group">
                <div class="col-sm-2 col-lg-2 " style="margin-top:6px;"> </div>
                 <div class="col-sm-2 col-lg-2 " style="margin-top:6px;"> </div>
                 <div class="error" id="err_vendor_search"></div>
            </div>


         <div class="btn-toolbar pull-right clearfix">
           <div class="btn-group"> 
            </div>
             <div class="btn-group"> 
            
             <!-- <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Active Course" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage','active');" style="text-decoration:none;"><i class="fa fa-dot-circle-o"></i></a>
             <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Block Course" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage','block');"  style="text-decoration:none;"><i class="fa fa-circle-o"></i></a> 
              <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Refresh" href=""style="text-decoration:none;"><i class="fa fa-repeat"></i></a> -->
              <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="javascript:void(0)" title="Add Vendor" data-target="#add_vendor" data-toggle="modal" style="text-decoration:none;"><i class="fa fa-plus"></i></a>
             </div>
           </div>
           <br/><br/>
           <div class="clearfix"></div>
           <div class="table-responsive" style="border:0" id="showBlockUI">
             <table class="table table-condensed" <?php //if(count($all_course)>0){?> id="table1"<?php //} ?>>
              <thead>
               <tr>
                <th style="width:18px"><input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th>
                <th>User Name</th>
                <th>User Email</th>
               
                <th>User Role</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="catList" >
            @if(count($vendors)>0)
                @foreach($vendors as $vendor)
                    <?php $role="";if($vendor['vendor_role']=='kh_admin'){$role = 'Kingdom Hall Admin';}elseif($vendor['vendor_role']=='super_admin'){$role = 'Super Admin';}elseif($vendor['vendor_role']=='trial_admin'){$role = 'Trial Admin';} ?>
                
                    <tr>
                        <td style="width:18px"><input type="checkbox" name="checkbox_del[]" id="checkbox_del" value="{{ $vendor['vendor_id'] }}"/></td>
                            <td>{{ $vendor['vendor_username'] }}</td>
                            <td>{{ $vendor['vendor_email'] }}</td>
                            
                            <td>{{ ($role!="") ? ucwords($role) : '---' }}</td>
                        <td>   
                            @if($vendor['vendor_status']=='active')
                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Active" href="{{ url('/') }}/superadmin/changeVendorStatus/{{ $vendor['vendor_id'] }}/{{'block'}}"  style="text-decoration:none;"><i class="fa fa-dot-circle-o"></i></a>
                            @else
                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Block" href="{{ url('/') }}/superadmin/changeVendorStatus/{{ $vendor['vendor_id'] }}/{{'active'}}" style="text-decoration:none;"><i class="fa fa-circle-o"></i></a>
                            @endif
                        </td>
                        <td>
                           <!--  <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" style="text-decoration:none;"  onclick="javascript : return delete_confirm()" href="javascript:void(0);"  title="Delete"><i class="fa fa-trash-o"></i></a> -->
                            <!-- <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" style="text-decoration:none;"  onclick="javascript : return delete_confirm()" href="{{ url('/') }}/superadmin/deleteVendor/{{ $vendor['vendor_id'] }}"  title="Delete"><i class="fa fa-trash-o"></i></a> -->
                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip edit_vendor" data-username="{{ $vendor['vendor_username'] }}" data-email="{{ $vendor['vendor_email'] }}" data-role="{{ $vendor['vendor_role'] }}" data-target="#edit_vendor" data-vendorid="{{ $vendor['vendor_id'] }}" data-toggle="modal" style="text-decoration:none;" href="javascript:void(0);" title="Edit"><i class="fa fa-edit"></i></a>
                           
                        </td>
                    </tr>
                
                @endforeach
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
<!-- Add Vendor Pop-Up -->
<div aria-hidden="false" style="display: none;" id="add_vendor" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel2"><b>Add new Vendor</b></h3>
            </div>
            <form method="post" action="{{ url('/') }}/superadmin/addvendor" id="add_new_vendor" >
            {{ csrf_field() }}
                <div class="modal-body">
                    <div id="new_vendor" class="type_div" style="display:block;margin-top: 10px;">
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-6 control-label" for="port">Vendor Username</label>
                            <div class="col-sm-9 col-lg-6 controls">
                                <input type="text" class="form-control" name="add_vendor_username" id="add_vendor_username" placeholder="UserName" value=""  />
                                <div class="error" id="err_add_vendor_username"></div>
                            </div>
                             <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="email_val" id="email_val">
                            <label class="col-sm-3 col-lg-6 control-label" for="port">Vendor Email</label>
                            <div class="col-sm-9 col-lg-6 controls">
                                <input type="text" class="form-control" name="add_vendor_email" id="add_vendor_email" placeholder="Email" value=""  />
                                <div class="error" id="err_add_vendor_email"></div>
                            </div>
                             <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-6 control-label" for="port">Vendor Password</label>
                            <div class="col-sm-9 col-lg-6 controls">
                                <input type="password" class="form-control" name="add_vendor_password" id="add_vendor_password" placeholder="Password" value=""  />
                                <div class="error" id="err_add_vendor_password"></div>
                            </div>
                             <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-6 control-label" for="port">Confirm Password</label>
                            <div class="col-sm-9 col-lg-6 controls">
                                <input type="password" class="form-control" name="add_confirm_password" id="add_confirm_password" placeholder="Confirm Password" value=""  />
                                <div class="error" id="err_add_confirm_password"></div>
                            </div>
                             <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-6 control-label" for="port">Select Role</label>
                            <div class="col-sm-9 col-lg-6 controls">
                                <select class="form-control" name="add_vendor_role" id="add_vendor_role" >
                                    <option value="kh_admin">Kingdom Hall Admin</option>
                                    <option value="super_admin">Super Admin</option>
                                    <option value="trial_admin">Trial Admin</option>
                                </select>        
                                <div class="error" id="err_add_vendor_role"></div>
                            </div>
                             <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            
                <div style="text-align:left;" class="modal-footer">
                    <div class="col-sm-12">
                        <button class="btn btn-primary" type="submit" name="btn_add_vendor" id="btn_add_vendor" ><i class="fa fa-check"></i>Save</button>
                        <button class="btn" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End : Add Vendor Pop-Up -->
<!-- Edit Vendor Pop-Up -->
<div aria-hidden="false" style="display: none;" id="edit_vendor" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel2"><b>Edit new Vendor</b></h3>
            </div>
            <form method="post" action="{{ url('/') }}/superadmin/editvendor" id="frm_edit_vendor" >
            {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" name="vendor_id" id="vendor_id" value="" >
                    <div id="old_vendor" class="type_div" style="display:block;margin-top: 10px;">
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-6 control-label" for="port">Vendor Username</label>
                            <div class="col-sm-9 col-lg-6 controls">
                                <input type="text" class="form-control" name="edit_vendor_username" id="edit_vendor_username" placeholder="UserName" value=""  />
                                <div class="error" id="err_edit_vendor_username"></div>
                            </div>
                             <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="email_val1" id="email_val1">
                            <label class="col-sm-3 col-lg-6 control-label" for="port">Vendor Email</label>
                            <div class="col-sm-9 col-lg-6 controls">
                                <input type="hidden" class="form-control" name="edit_vendor_email12" id="edit_vendor_email12" placeholder="Email" value=""  />
                                <input type="text" class="form-control" name="edit_vendor_email" id="edit_vendor_email" placeholder="Email" value=""  />
                                <div class="error" id="err_edit_vendor_email"></div>
                            </div>
                             <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-6 control-label" for="port">Vendor Password</label>
                            <div class="col-sm-9 col-lg-6 controls">
                                <input type="password" class="form-control" name="edit_vendor_password" id="edit_vendor_password" placeholder="Password" value=""  />
                                <div class="error" id="err_edit_vendor_password"></div>
                            </div>
                             <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-6 control-label" for="port">Confirm Password</label>
                            <div class="col-sm-9 col-lg-6 controls">
                                <input type="password" class="form-control" name="edit_confirm_password" id="edit_confirm_password" placeholder="Confirm Password" value=""  />
                                <div class="error" id="err_edit_confirm_password"></div>
                            </div>
                             <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-6 control-label" for="port">Select Role</label>
                            <div class="col-sm-9 col-lg-6 controls">
                                <select class="form-control" name="edit_vendor_role" id="edit_vendor_role" >
                                    <option value="kh_admin">Kingdom Hall Admin</option>
                                    <option value="super_admin">Super Admin</option>
                                    <option value="trial_admin">Trial Admin</option>
                                </select>        
                                <div class="error" id="err_edit_vendor_role"></div>
                            </div>
                             <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            
                <div style="text-align:left;" class="modal-footer">
                    <div class="col-sm-12">
                        <button class="btn btn-primary" type="submit" name="btn_edit_vendor" id="btn_edit_vendor" ><i class="fa fa-check"></i>Save</button>
                        <button class="btn" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection