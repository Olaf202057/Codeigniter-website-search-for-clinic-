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
        <h1> <i class="fa fa-bars"></i>Recurring Fees</h1>
        <h4>Recurring Fees</h4>
    </div>
</div>
<!-- END Page Title -->

<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
    <ul class="breadcrumb">
        <li class=""><i class="fa fa-home"></i> <a href="{{ url('/') }}/superadmin/dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span>
            
        </li>
        <li title="Manage Orders" ><a href="{{ url('/') }}/superadmin/order/manage">Manage Order</a> <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li title="Manage Orders" ><a href="{{ url('/') }}/superadmin/order/view/{{ $orders[0]['order_id'] }}">Order View</a> <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li  class="active" >Order View</li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title"><h3> <i class="fa fa-bars"></i>Order View</h3></div>
            <form name="frm-manage" id="frm-manage" method="post" >
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
                            
                        </div>
                    </div>
                    <br/><br/>
                    <div class="clearfix"></div>
                    
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="col-sm-2 col-lg-2" style="font-size:14px;"><b><u>Order Details</u> - </b></label>
                          </div>
                        </div>
                          <div class="col-md-12">
                           <div class="form-group">
                            <label class="col-sm-2 col-lg-2" style="font-size:14px;"><b><u>Original Order Id</u> - {{ $orders[0]['order_id']}} </b></label>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="table-responsive">
                            <table class="table" border="1" cellpadding="5" BORDERCOLOR="#E5E5E5">
                            <tr>
                             <th style="text-align:left" width="150">Order ID</th>
                              <th style="text-align:left" width="450">Vendor Name</th>
                              <th style="text-align:left" width="250">Amount</th>
                              <th style="text-align:left" width="350">Profile Id</th>
                              <th style="text-align:left" width="100">Order Date</th>
                              <!-- <th style="text-align:left" width="450">Next Pay Date</th> -->
                              <th style="text-align:left" width="450">Completed Cycles</th>
                              <?php if(count($orders[0]['product'])>0){ 
                                   if(substr_count(strtoupper($orders[0]['product'][0]['product']), strtoupper('free'))>0){
                                ?>
                              <th style="text-align:left" width="200"> Validity</th>
                              <?php }else{ ?>
                              <th style="text-align:left" width="200">Recurring Cycle</th>
                              <?php } }else {?>
                              <th style="text-align:left" width="200">Recurring Cycle</th>
                              <?php } ?>
                               <th style="text-align:left" width="450">Status</th>
                               <th style="text-align:left" width="450">Action</th>
                            </tr>

                            @if(count($orders)>0)
                                @foreach($orders as $order)
                            <tr>
                               <td style="text-align:left;">{{ $order['order_id'] }}</td>
                              <td style="text-align:left;">{{ $order['vendor']['vendor_username'] }}</td>
                              <td style="text-align:left;"><?php echo "$ ".number_format((float)$order['amount'], 2, '.', '');?></td>
                              <td style="text-align:left;">{{ $order['profile_id'] }}</td>
                              <td style="text-align:left;">{{ date('Y-m-d ',strtotime($order['order_date'])) }}</td>
                              <!-- <td style="text-align:left;">{{ date('Y-m-d ',strtotime($order['next_pay_date'])) }}</td> -->
                              <td style="text-align:left;">{{ $order['cycles_completed'] }}</td>
                              <td style="text-align:left;">{{ $order['cycle'] }} Month</td>
                              <td style="text-align:left;">{{ucfirst($order['status']) }}</td>
                              

                              <?php if($order['plan_status']=='ongoing' && $order['status']=="completed"){ ?>
                             
                              
                              <td style="text-align:left;"><a class="btn btn-primary" href="{{ url('/') }}/cancelRecurring/{{ $orders[0]['order_id']}}/admin" title="Recurring Fees"   style="text-decoration:none;">Cancel</a> </td>
                              <?php } ?>
                            </tr>
                            @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">No Order</td>
                                    </tr>
                            @endif
                          </table>  
                          </div>                  
                        </div>
                        <br/>
                        <div class="clearfix"></div>



                        <div class="clearfix"></div>
                    
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="col-sm-2 col-lg-2" style="font-size:14px;"><b><u>Recurring Details</u> -</b></label>
                          </div>
                        </div>
                       <!--  <div class="col-md-10">
                          <div class="table-responsive">
                            <table class="table" border="1" cellpadding="5" BORDERCOLOR="#E5E5E5" >
                            <tr>
                               <th style="width:50px"><input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th>
                              <th style="text-align:left" width="150">Order ID</th>
                              <th style="text-align:left" width="150">Amount</th>
                              <th style="text-align:left" width="150">Profile Id</th>
                              <th style="text-align:left" width="200">Pay Date</th>
                              <th style="text-align:left" width="150">Next Pay Date</th>
                            </tr>
                            @if(count($recurring)>0)
                                @foreach($recurring as $rec)
                            <tr>
                              <td></td>
                              <td style="text-align:left;">{{ $rec['rec_id'] }}</td>
                              <td style="text-align:left;"><?php echo "$ ".number_format((float)$rec['amount'], 2, '.', '');?></td>
                              <td style="text-align:left;">{{ $rec['profile_id'] }}</td>
                              <td style="text-align:left;">{{ date('Y-m-d',strtotime($rec['pay_date'])) }}</td>
                              <td style="text-align:left;">{{ date('Y-m-d',strtotime($rec['next_pay_date'])) }}</td>
                            </tr>
                            @endforeach
                              @else
                                <tr>
                                  <td colspan="5">No Recurring for this Order</td>
                                </tr>
                            @endif
                          </table>  
                          </div>                  
                        </div> -->
                    <br/>

                    <div class="clearfix"></div>
                    <div class="table-responsive" style="border:0" id="showBlockUI">
                      <table class="table table-condensed" <?php if(count($recurring)>0){?> id="table1"<?php } ?> border="1" BORDERCOLOR="#E5E5E5">
                          <thead>
                            <tr>
                              <th  style="border:2" style="text-align:left" width="150">Order ID</th>
                              <th  style="border:2" style="text-align:left" width="150">Amount</th>
                              <th  style="border:2" style="text-align:left" width="150">Profile Id</th>
                              <th  style="border:2" style="text-align:left" width="200">Pay Date</th>
                              <th  style="border:2" style="text-align:left" width="150">Next Pay Date</th>
                            </tr>
                          </thead>
                          <tbody id="catList" >
                          @if(count($recurring)>0)
                            @foreach($recurring as $rec)
                            <tr>
                              <td style="text-align:left;">{{ $rec['rec_id'] }}</td>
                              <td style="text-align:left;"><?php echo "$ ".number_format((float)$rec['amount'], 2, '.', '');?></td>
                              <td style="text-align:left;">{{ $rec['profile_id'] }}</td>
                              <td style="text-align:left;">{{ date('Y-m-d',strtotime($rec['pay_date'])) }}</td>
                              <td style="text-align:left;">{{ date('Y-m-d',strtotime($rec['next_pay_date'])) }}</td>
                            </tr>
                            @endforeach
                            @else
                              <tr>
                                <td colspan="6">No records found</td>
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