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
        <h1><i class="fa fa-file-o"></i> Manage Product</h1>
        <h4>Manage Products</h4>
    </div>
</div>
<!-- END Page Title -->

<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
    <ul class="breadcrumb">
        <li class=""><i class="fa fa-home"></i> <a href="{{ url('/') }}/superadmin/dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li  class="active" >Manage Product</li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title"><h3><i class="fa fa-table"></i>Manage Products</h3></div>
            <form name="frm-manage" id="frm-manage" method="post" action="">
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
                            <!-- <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Active Course" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage','active');" style="text-decoration:none;"><i class="fa fa-dot-circle-o"></i></a>
                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Block Course" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage','block');"  style="text-decoration:none;"><i class="fa fa-circle-o"></i></a> 
                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Refresh" href=""style="text-decoration:none;"><i class="fa fa-repeat"></i></a> -->
                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ url('/') }}/superadmin/product/add" title="Add Product"  data-toggle="modal" style="text-decoration:none;"><i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="clearfix"></div>
                    <div class="table-responsive" style="border:0" id="showBlockUI">
                        <table class="table table-condensed" <?php //if(count($all_course)>0){?> id="table1"<?php //} ?>>
                            <thead>
                               <tr>
                                <th style="width:18px"><input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th>
                                <th>Product Name</th>
                                <th>Product Id</th>
                                <th>Product Description</th>
                                <th>Product Price</th>
                                <th>Status</th>
                                <th>Create payment link</th>
                                <th>Action</th>
                              </tr>
                            </thead><tbody id="catList" >
                            @if(count($products)>0)
                                @foreach($products as $prod)
                                    <tr>
                                       <td style="width:18px"><input type="checkbox" name="checkbox_del[]" id="checkbox_del" value="{{ $prod['product_id'] }}"/></td>
                                        <td>{{ ucfirst($prod['product_name']) }}</td>
                                         <td>{{ $prod['product_id'] }}</td>
                                        <td>{{ $prod['product_description'] }}</td>
                                        <td>{{ '$'.number_format($prod['sell_price'],2) }}</td>
                                          <td>   
                                            @if($prod['product_status']=='active')
                                                <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Active" href="{{ url('/') }}/superadmin/changeProductStatus/{{ base64_encode($prod['product_id']) }}/{{'block'}}"  style="text-decoration:none;"><i class="fa fa-dot-circle-o"></i></a>
                                            @else
                                                <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Block" href="{{ url('/') }}/superadmin/changeProductStatus/{{ base64_encode($prod['product_id']) }}/{{'active'}}" style="text-decoration:none;"><i class="fa fa-circle-o"></i></a>
                                            @endif
                                        </td>
                                         <td>   
                                            @if($prod['product_status']=='active')
                                                <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip create_payment_link" style="text-decoration:none;"  href="javascript:void(0);" data-target="#modal1" data-toggle="modal" data-prod-id="{{ $prod['product_id'] }}"  data-prod-price="{{ $prod['sell_price'] }}" data-prod-name="{{ $prod['product_name'] }}" title="Create payment link"><i class="fa fa-ticket"></i></a>
                                            @else
                                                <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="" href="javascript:void(0);" style="text-decoration:none;"><i class="fa fa-ticket"></i></a>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" style="text-decoration:none;" href="{{ url('/') }}/superadmin/product/view/{{ base64_encode($prod['product_id']) }}"  title="View"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" style="text-decoration:none;" href="{{ url('/') }}/superadmin/product/update/{{ base64_encode($prod['product_id']) }}" title="Edit"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" style="text-decoration:none;" href="{{ url('/') }}/superadmin/product/delete/{{ base64_encode($prod['product_id']) }}" onclick="return delete_confirm()" title="Delete"><i class="fa fa-trash-o"></i></a>
                                            
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
                <h3 id="myModalLabel2"><b>Create Payment Link </b></h3>
            </div>
            <form method="post" action="{{ url('/') }}/superadmin/paymentlink/create" id="vendor_pop" >
            {{ csrf_field() }}
                
                <div class="modal-body">
                    
                   <div class="form-group">
                        <label class="col-sm-3 col-lg-6 control-label" for="port">Product Name</label>
                        <div class="col-sm-9 col-lg-6 controls">
                            <input type="text" class="form-control" name="product_name" id="prod_name" placeholder="Product Name" readonly />
                            <div class="error" id="err_prod_name"></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-6 control-label" for="port">Product Id</label>
                        <div class="col-sm-9 col-lg-6 controls">
                            <input type="text" class="form-control" name="product_id" id="prod_id" placeholder="Product Id" readonly />
                            <div class="error" id="err_id"></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-6 control-label" for="port">Price</label>
                        <div class="col-sm-9 col-lg-6 controls">
                            <input type="text" class="form-control"  name="product_price" id="product_price" placeholder="Product Price" readonly />
                            <div class="error" id="err_price"></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-6 control-label" for="port">Congregation Quantity</label>
                        <div class="col-sm-9 col-lg-6 controls">
                            <input type="text" class="form-control"  name="quantity" id="quantity" placeholder="Congregation Quantity"  />
                            <div class="error" id="err_qty"></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                    
                    
                <div class="clearfix"></div>
                </div>
            
                <div style="text-align:left;" class="modal-footer">
                    <div class="col-sm-12">
                        <button class="btn btn-primary" type="submit" name="btn_create_link" id="btn_create_link" ><i class="fa fa-check"></i>Create link</button>
                        <button class="btn" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection