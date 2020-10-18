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
        <h1><i class="fa fa-users"></i> Vendors</h1>
        <h4>Vendors</h4>
    </div>
</div>
<!-- END Page Title -->

<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
    <ul class="breadcrumb">
        <li class=""><i class="fa fa-home"></i> <a href="{{ url('/') }}/superadmin/dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li  class="active" >Vendors</li>
    </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Tiles -->
<!-- END Tiles -->
<!-- BEGIN Main Content -->
    
 <div class="row">
   <div class="col-md-12">
    <div class="box">
     <div class="box-title"><h3><i class="fa fa-users"></i>Vendors</h3></div>
     <form name="frm-manage" id="frm-manage" method="get" action="{{ url('/') }}/superadmin/report/searchVendor">

        
        <input type="hidden" name="page_id" id="page_id" value="banner" >

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
                     <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ url('/') }}/superadmin/report/vendors" title="vendors"  data-toggle="modal" style="text-decoration:none;"><i class="fa fa-repeat"></i></a>
                 </div>
                </div> 
               
            </div>
             <div class="col-md-12 form-group">
                  <div class="col-sm-2 col-lg-2 " style="margin-top:6px;"> </div>
                   <div class="col-sm-2 col-lg-2 " style="margin-top:6px;"> </div>
                   <div class="error" id="err_vendor_search"></div>
              </div>

           <div class="clearfix"></div>
           <div class="table-responsive" style="border:0" id="showBlockUI">
             <table class="table table-condensed" <?php //if(count($all_course)>0){?> id="table1"<?php //} ?>>
              <thead>
               <tr>
                <th style="width:18px"><input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th>
                <th>Vendor Name</th>
                <th>E-mail</th>
                <th>Congregation</th>
               </tr>
              </thead>
             <tbody id="catList" >
            @if(count($vendors)>0)
                @foreach($vendors as $ven)
               
                    <tr>
                        <td style="width:18px"><input type="checkbox" name="checkbox_del[]" id="checkbox_del" value="{{ $ven['vendor_id'] }}"/></td>
                        <td>{{ $ven['vendor_username'] }}</td>
                        <td><a href="mailto:{{ $ven['vendor_email'] }}">{{ $ven['vendor_email'] }}</a></td>
                        <td>
                        <a class="btn btn-to-success btn-bordered btn-fill show-tooltip" style="text-decoration:none;" href="{{ url('/') }}/superadmin/report/congregations/{{ base64_encode($ven['vendor_id']) }}" title="See congrgation">Congregations</a>

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







                
@endsection
