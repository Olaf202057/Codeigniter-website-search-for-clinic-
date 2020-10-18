@extends('admin.layouts.master')

@section('middle_section')
<!-- BEGIN Page Title -->
<div id="main-content">
    <div class="page-title">
        <div>
            <h1> <i class="fa fa-phone"></i> Add phone vendor</h1>
            <h4>Add phone vendor</h4>
        </div>
    </div>
    <!-- END Page Title -->
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="{{ url('/') }}/superadmin/dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span>
                <a href="{{ url('/') }}/superadmin/faq/manage">Manage Faq's</a><span class="divider"><i class="fa fa-angle-right"></i></span>
            </li>
            <li class="active"> Add phone vendor</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->
    <!-- BEGIN Main Content -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3> <i class="fa fa-phone"></i> Add phone vendor</h3>
                </div>
                <div class="box-content">
                    <form method="post" class="form-horizontal" action="{{ url('/') }}/superadmin/phonevendor/addvendor" id="frm_add_product" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-md-10">
                        @if(Session::has('success'))
                            <div class="alert alert-success" id="no_select" style="">{{ "Success : ".Session::get('success') }}</div>
                        @elseif(Session::has('error'))
                            <div class="alert alert-danger" id="warning_msg" style="">{{ "Error : ".Session::get('error') }}</div>
                        @endif
                        </div>
                       <div class="form-group">
                            <label class="col-sm-3 col-lg-3 control-label" for="add_faq">Vendor name <span style="color:#F00;">*</span>
                            </label>
                            <div class="col-sm-9 col-lg-5 controls">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name"   />
                                <div class="error" sttle="color:red" id="err_name"></div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                         <div class="col-sm-9 col-lg-4 controls">&nbsp;</div>
                            <div class="col-sm-9 col-lg-5 controls">
                                <input type="submit" class="btn btn-primary" name="btn_add_phn_vendor" id="btn_add_phn_vendor" value="Submit"/>
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
