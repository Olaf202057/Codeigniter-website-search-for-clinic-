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
        <h1> <i class="fa fa-bookmark-o"></i> Order Manage</h1>
        <h4>Order Manage</h4>
    </div>
</div>
<!-- END Page Title -->

<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
    <ul class="breadcrumb">
        <li class=""><i class="fa fa-home"></i> <a href="{{ url('/') }}/superadmin/dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span>
            
        </li>
        <li  class="active" >Order Manage</li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title"><h3> <i class="fa fa-bookmark-o"></i>Order Manage</h3></div>
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
                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Refresh" href="{{ url('/') }}/superadmin/order/manage" style="text-decoration:none;"><i class="fa fa-repeat"></i></a> 
                            
                        </div>
                    </div>
                    <br/><br/>
                    <div class="clearfix"></div>
                    <input type="hidden" name="act_status" id="act_status" value="" />
                    <div class="table-responsive" style="border:0" id="showBlockUI">
                        <table class="table table-condensed" <?php if(count($orders)>0){?> id="table1"<?php } ?>>
                            <thead>
                               <tr>
                                <th style="width:50px"><input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th>
                                <th>Oreder Id </th>
                                <th>Vendor name </th>
                                <th>Profile Id </th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                             <tbody id="catList" >
                            @if(count($orders)>0)
                                @foreach($orders as $order)
                                   
                                        <tr>
                                            <td style="width:18px"><input type="checkbox" name="checkbox_del[]" id="checkbox_del" value="{{ $order['order_id'] }}"/></td>
                                            <td>{{ $order['order_id'] }}</td>
                                            <td>{{ $order['vendor']['vendor_username'] }}</td>
                                            <td>{{ $order['profile_id'] }}</td>
                                            <td>{{ date('Y-m-d h:i A',strtotime($order['order_date'])) }}</td>
                                            <td>$ {{ $order['amount'] }}</td>
                                            <td>{{ $order['status'] }}</td>
                                            <td>
                                                <!-- <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip audio_feed" style="text-decoration:none;"  href="javascript:void(0);"    title="Edit"><i class="fa fa-edit"></i></a> -->
                                                 <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip " style="text-decoration:none;"  href="{{ url('/') }}/superadmin/order/view/{{ $order['order_id']}}"    title="View"><i class="fa fa-eye"></i></a>
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




@endsection