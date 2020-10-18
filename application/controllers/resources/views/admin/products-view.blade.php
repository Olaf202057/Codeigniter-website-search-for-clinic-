@extends('admin.layouts.master')

@section('middle_section')
<!-- BEGIN Page Title -->
<div id="main-content">
    <div class="page-title">
        <div>
            <h1><i class="fa fa-building-o"></i> Update Product </h1>
            <h4>View Product</h4>
        </div>
    </div>
    <!-- END Page Title -->
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="{{ url('/') }}/superadmin/dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span>
            </li><li title="Manage Product" ><a href="{{ url('/') }}/superadmin/product/manage">Manage product</a> <span class="divider"><i class="fa fa-angle-right"></i></span>
            </li>
            <li class="active">View Product</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->
    <!-- BEGIN Main Content -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">

                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>View Product</h3>
                </div>
                <div class="box-content">
                    <form method="post" class="form-horizontal" action="{{ url('/') }}/superadmin/product/updateProduct" id="frm_update_product" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    <div class="col-md-6">
                       <div class="form-group">
                            <label class="col-sm-3 col-lg-3 control-label" for="product_name">Product Name 
                            </label>
                            <div class="col-sm-9 col-lg-9 controls">
                                <input type="text" class="form-control" readonly name="product_name" id="product_name" placeholder="Product Name" value="{{ $product['product_name'] }}" data-rule-required="true"   />
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-3 control-label" for="product_description" class="ckeditor">Product Description 
                            </label>
                            <div class="col-sm-9 col-lg-9 controls">
                            <textarea name="product_description" id="product_description" readonly data-rule-required="true" class="form-control" placeholder="Product Description">{{ $product['product_description']}}</textarea>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-3 control-label" for="sell_price">Sell Price 
                            </label>
                            <div class="col-sm-9 col-lg-9 controls">
                                <input type="text" class="form-control" name="sell_price" id="sell_price" readonly placeholder="Product Sell Price"  data-rule-required="true"  value="{{ $product['sell_price']}}" />
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-5 control-label" for="sell_price">
                            </label>
                            <div class="col-sm-9 col-lg-7 controls">
                                <a class="btn" href="{{ url('/') }}/superadmin/product/manage" type="button" data-dismiss="modal">Cancel</a>
                                
                            </div>
                        </div>
                    
                        <div class="clearfix"></div>
                    </div>
                         <div class="clearfix"></div><div class="clearfix"></div>
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
<!-- END Main Content -->
@endsection
