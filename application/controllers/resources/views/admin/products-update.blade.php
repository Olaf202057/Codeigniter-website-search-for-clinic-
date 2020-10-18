@extends('admin.layouts.master')

@section('middle_section')
<!-- BEGIN Page Title -->
<div id="main-content">
    <div class="page-title">
        <div>
            <h1><i class="fa fa-building-o"></i> Update Product </h1>
            <h4>Update Product</h4>
        </div>
    </div>
    <!-- END Page Title -->
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="{{ url('/') }}/superadmin/dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span>
            </li><li title="Manage Product" ><a href="{{ url('/') }}/superadmin/product/manage">Manage product</a> <span class="divider"><i class="fa fa-angle-right"></i></span>
            </li>
            <li class="active">Update Product</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->
    <!-- BEGIN Main Content -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>Update Product</h3>
                </div>
                <div class="box-content">
                    <form method="post" class="form-horizontal" action="{{ url('/') }}/superadmin/product/updateProduct" id="frm_update_product" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="product_id" id="product_id" value="{{$product['product_id']}}">
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-3 control-label" for="product_name">Product Name <span style="color:#F00;">*</span>
                            </label>
                            <div class="col-sm-9 col-lg-5 controls">
                                <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Product Name" value="{{ $product['product_name'] }}" data-rule-required="true"   />
                                <div class="error" id="err_product_name">{{ $errors->first('product_name') }}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-3 control-label" for="product_description" class="ckeditor">Product Description <span style="color:#F00;">*</span>
                            </label>
                            <div class="col-sm-9 col-lg-5 controls">
                            <textarea name="product_description" id="product_description" data-rule-required="true" class="form-control" placeholder="Product Description">{{ $product['product_description']}}</textarea>
                                <div class="error" id="err_product_description">{{ $errors->first('product_description') }}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-3 control-label" for="sell_price">Sell Price <span style="color:#F00;">*</span>
                            </label>
                            <div class="col-sm-9 col-lg-5 controls">
                                <input type="text" class="form-control" name="sell_price" id="sell_price" placeholder="Product Sell Price"  data-rule-required="true"  value="{{ $product['sell_price']}}" />
                                <div class="error" id="err_sell_price">{{ $errors->first('sell_price') }}</div>
                            </div>
                        </div>
                         <div class="form-group">
                         <div class="col-sm-9 col-lg-4 controls">&nbsp;</div>
                            <div class="col-sm-9 col-lg-5 controls">
                                <input type="submit" class="btn btn-primary" name="btn_product_update" id="btn_product_update" value="Update"/>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
<!-- END Main Content -->
@endsection
