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
        <h1><i class="fa fa-file-o"></i> Required Login Congregations</h1>
        <h4> Required Login Congregations</h4>
    </div>
</div>
<!-- END Page Title -->

<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
    <ul class="breadcrumb">
        <li class=""><i class="fa fa-home"></i> <a href="{{ url('/') }}/superadmin/dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li  class="active" > Required Login Congregations</li>
    </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Tiles -->
<!-- END Tiles -->
<!-- BEGIN Main Content -->
    
 <div class="row">
   <div class="col-md-12">
    <div class="box">
     <div class="box-title"><h3><i class="fa fa-file-o"></i> Required Login Congregations</h3></div>
     <form name="frm-manage" id="frm-manage" method="post" action="{{ url('/') }}/superadmin/report/searchVendor">

        {{ csrf_field() }}
        <input type="hidden" name="page_id" id="page_id" value="banner" >

       <div class="box-content">
         <div class="col-md-10">
            @if(Session::has('success'))
                <div class="alert alert-success" id="no_select" style="">{{ "Success : ".Session::get('success') }}</div>
            @elseif(Session::has('error'))
                <div class="alert alert-danger" id="warning_msg" style="">{{ "Error : ".Session::get('error') }}</div>
            @endif
         </div>

        
         

           <div class="clearfix"></div>
          <div class="table-responsive" style="border:0" id="showBlockUI">
             <table class="table table-condensed" <?php //if(count($all_course)>0){?> id="table1"<?php //} ?>>
              <thead>
               <tr>
                <th style="width:18px"><input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th>
                <th>Congregation Name</th>
                <th>Midweek Meeting</th>
                <th>Weekend Meeting</th>
               
                
                <th>Status</th>
                <th>Login</th>
              </tr>
            </thead>
             <tbody id="catList" >
            @if(count($congregation)>0)
                @foreach($congregation as $cong)
               
                    <tr>
                        <td style="width:18px"><input type="checkbox" name="checkbox_del[]" id="checkbox_del" value="{{ $cong['congregation_id'] }}"/></td>
                        <td><!-- <a href="{{ url('/') }}/superadmin/congregation/view/{{ base64_encode($cong['congregation_id']) }}"> -->{{ $cong['congregation_name'] }}<!-- </a> --></td>
                        <td>{{ ($cong['midd_met_day']!="") ? date('l',strtotime($cong['midd_met_day'])).', '.$cong['midd_met_time'] : '---' }}</td>
                        <td>{{ ($cong['wek_met_day']!="") ? date('l',strtotime($cong['wek_met_day'])).', '.$cong['wek_met_time'] : '---' }}</td>
                        <?php $kh_image = ($cong['kingdomhall_image']!="") ? $cong['kingdomhall_image'] : "dummypic.jpg";?>
                        <td>   
                            @if($cong['congregation_status']=='active')
                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Active"   style="text-decoration:none;"><i class="fa fa-dot-circle-o"></i></a>
                            @else
                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip"  title="block" style="text-decoration:none;"><i class="fa fa-circle-o"></i></a>
                            @endif
                        </td>
                        <td> <b>Required </b></td>
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
