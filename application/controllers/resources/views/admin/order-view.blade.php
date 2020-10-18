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
        <h1> <i class="fa fa-bars"></i>Order View</h1>
        <h4>Order View</h4>
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
                     <div class="col-md-12 form-group">
                      <div class="col-sm-2 col-lg-2 " style="margin-top:6px;"> </div>
                      <div class="col-sm-2 col-lg-2 " style="margin-top:6px;"> </div>
                      <div class="col-sm-3 col-lg-3 " style="margin-top:6px;"> </div>
                      <div class="col-sm-3 col-lg-3 " style="margin-top:6px;"> </div>
                      <div class="col-sm-2 col-lg-2 " style="margin-top:6px;"><a class="btn btn-primary" href="{{ url('/') }}/superadmin/order/recurringfees/{{ $orders[0]['order_id']}}" title="Recurring Fees"   style="text-decoration:none;">Recurring Fees</a> </div>
                     </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="col-sm-2 col-lg-2" style="font-size:14px;"><b><u>Order Details</u> -</b></label>
                          </div>
                        </div>
                        <div class="col-md-8">
                          <div class="table-responsive">
                            <table class="table" border="1" cellpadding="5" BORDERCOLOR="#E5E5E5">
                            <tr>
                               <th style="text-align:left" width="150">Order ID</th>
                              <th style="text-align:left" width="250">Vendor Name</th>
                              <th style="text-align:left" width="150">Amount</th>
                              <th style="text-align:left" width="150">Profile Id</th>
                              <th style="text-align:left" width="200">Date</th>
                              <?php if(count($orders[0]['product'])>0){ 
                                   if(substr_count(strtoupper($orders[0]['product'][0]['product']), strtoupper('free'))>0){
                                ?>
                              <th style="text-align:left" width="200"> Validity</th>
                              <?php }else{ ?>
                               <th style="text-align:left" width="200">Recurring Cycle</th>
                               <?php } }else {?>
                                <th style="text-align:left" width="200">Recurring Cycle</th>
                                <?php } ?>
                            </tr>
                            @if(count($orders)>0)
                                @foreach($orders as $order)
                            <tr>
                              <td style="text-align:left;">{{ $order['order_id'] }}</td>
                              <td style="text-align:left;">{{ $order['vendor']['vendor_username'] }}</td> 
                              <td style="text-align:left;"><?php echo "$ ".number_format((float)$order['amount'], 2, '.', '');?></td>
                              <td style="text-align:left;">{{ $order['profile_id'] }}</td>
                              <td style="text-align:left;">{{ date('Y-m-d h:i A',strtotime($order['order_date'])) }}</td>
                              <td style="text-align:left;">{{ $order['cycle'] }} Month</td>
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
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="col-sm-2 col-lg-2" style="font-size:14px;"><b><u>Product</u> -</b></label>
                          </div>
                        </div>
                        <div class="col-md-8">
                            <div class="table-responsive">
                            <table class="table" border="1" cellpadding="5" BORDERCOLOR="#E5E5E5">
                            <tr>
                              <th style="text-align:center" width="500">Product</th>
                              <th style="text-align:center" width="150">SKU</th>
                              <th style="text-align:center" width="150">Price</th>
                             </tr>
                             @if(count($orders[0]['product'])>0)
                                @foreach($orders[0]['product'] as $order)
                             <tr>
                              <td style="text-align:left;">{{$order['product'] }}</td>
                              <td style="text-align:center;">-</td>
                              <td style="text-align:center;"><?php echo "$ ".number_format((float)$order['price'], 2, '.', '');?></td>
                             </tr>

                             @endforeach
                             <tr>
                              <td style="text-align:left;"></td>
                              <td style="text-align:center;"><b>Total </b></td>
                              <td style="text-align:center;"><b><?php echo "$ ".number_format((float)$orders[0]['amount'], 2, '.', '');?></b></td>
                            </tr>
                            @else
                                <tr>
                                    <td colspan="3">No Product</td>
                                </tr>
                            @endif
                          
                          </table>  
                          </div>                  
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="col-sm-2 col-lg-2" style="font-size:14px;"><b><u>Order comments:</u> -</b> 
                                <a class="btn btn-primary" href="javascript:void(0);" data-target="#modal1" data-toggle="modal" title="Add Order Comment"   style="text-decoration:none;">Add Order Comment</a>
                            </label>
                          </div>
                        </div>
                        <div class="col-md-8">
                            <div class="table-responsive">
                            <table class="table" border="1" cellpadding="5" BORDERCOLOR="#E5E5E5">
                            <tr>
                              <th style="text-align:center" width="500">Date</th>
                              <th style="text-align:center" width="150">Vendor</th>
                              <th style="text-align:center" width="150">Notified</th>
                              <th style="text-align:center" width="150">Status</th>
                              <th style="text-align:center" width="150">Comment</th>
                             </tr>
                             @if(count($ordercomment)>0)
                                @foreach($ordercomment as $comment)
                             <tr>
                              <td style="text-align:left;">{{ date('Y-m-d',strtotime($comment['date']))}}</td>
                              <td style="text-align:center;">--</td>
                              <td style="text-align:center;">--</td>
                              <td style="text-align:center;">--</td>
                              <td style="text-align:center;">{{$comment['comment']}}</td>
                             </tr>
                              @endforeach
                            @endif
                           
                          </table>  
                          </div>                  
                        </div>


                        <div class="clearfix"></div>
                        <div class="col-md-12">
                          <div class="form-group">
                                
                            <label class="col-sm-2 col-lg-2" style="font-size:14px;"><b><u>Admin comments:</u> -</b> 
                              <a class="btn btn-primary" href="javascript:void(0);" data-target="#modal2" data-toggle="modal" title="Add Admin Comment"   style="text-decoration:none;">Add Admin Comment</a>
                          </label>
                          </div>
                        </div>
                        <div class="col-md-8">
                            <div class="table-responsive">
                            <table class="table" border="1" cellpadding="5" BORDERCOLOR="#E5E5E5">
                           <tr>
                              <th style="text-align:center" width="500">Date</th>
                              <th style="text-align:center" width="150">Vendor</th>
                              <th style="text-align:center" width="150">Notified</th>
                              <th style="text-align:center" width="150">Status</th>
                              <th style="text-align:center" width="150">Comment</th>
                             </tr>
                             @if(count($admincomment)>0)
                                @foreach($admincomment as $order)
                             <tr>
                              <td style="text-align:left;">{{ date('Y-m-d',strtotime($comment['date']))}}</td>
                              <td style="text-align:center;">--</td>
                              <td style="text-align:center;">--</td>
                              <td style="text-align:center;">--</td>
                              <td style="text-align:center;">{{$comment['comment']}}</td>
                             </tr>
                            @endforeach
                            @endif
                           
                          
                          </table>  
                          </div>                  
                        </div>
                      <div class="clearfix"></div>
                    
                    <div class="clear"></div>
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
                <h3 id="myModalLabel2"><b>Add Admin Comment </b></h3>
            </div>
            <form method="post" action="{{ url('/') }}/superadmin/order/admincomment" id="add_comment" >
            {{ csrf_field() }}
               
                <div class="modal-body">
                   
                   <input type="hidden" name="order_id" id="order_id" value="{{$orders[0]['order_id'] }}">
                     <div class="form-group">
                        <label class="col-sm-2 col-lg-2 control-label" for="port">Comment </label>
                        <div class="col-sm-10 col-lg-10 controls">
                            <textarea type="text" class="form-control"  name="admin_comment" id="admin_comment" placeholder="Enter Admin Comment" ></textarea>
                            <div class="error" style="color:red" id="err_admin_cmnt"></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                    
                    
                    <div class="clearfix"></div>
                </div>
            
                <div style="text-align:left;" class="modal-footer">
                    <div class="col-sm-12">
                        <button class="btn btn-primary" type="submit" name="btn_add_admin_comment" id="btn_add_admin_comment" >Add</button>
                        <button class="btn" type="button" data-dismiss="modal">Cancel</button>
                    </div>
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
                <h3 id="myModalLabel2"><b>Add Order Comment </b></h3>
            </div>
            <form method="post" action="{{ url('/') }}/superadmin/order/ordercomment" id="add_comment" >
            {{ csrf_field() }}
               
                <div class="modal-body">
                   
                   <input type="hidden" name="order_id" id="order_id" value="{{$orders[0]['order_id'] }}">
                     <div class="form-group">
                        <label class="col-sm-2 col-lg-2 control-label" for="port">Comment </label>
                        <div class="col-sm-10 col-lg-10 controls">
                            <textarea type="text" class="form-control"  name="order_comment" id="order_comment" placeholder="Enter Order Comment" ></textarea>
                            <div class="error" style="color:red" id="err_ord_cmnt"></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                    
                    
                    <div class="clearfix"></div>
                </div>
            
                <div style="text-align:left;" class="modal-footer">
                    <div class="col-sm-12">
                        <button class="btn btn-primary" type="submit" name="btn_add_order_comment" id="btn_add_order_comment" >Add</button>
                        <button class="btn" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>






@endsection