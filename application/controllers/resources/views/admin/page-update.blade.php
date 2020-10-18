@extends('admin.layouts.master')

@section('middle_section')
<!-- BEGIN Page Title -->
<div id="main-content">
    <div class="page-title">
        <div>
            <h1> <i class="fa fa-file-o"></i> Update Frontpage </h1>
            <h4>Update Frontpage </h4>
        </div>
    </div>
    <!-- END Page Title -->
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="{{ url('/') }}/superadmin/dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span><a href="{{ url('/') }}/superadmin/pages/manage">Manage Frontpage</a><span class="divider"><i class="fa fa-angle-right"></i></span>
            </li>
            <li class="active"> Update Frontpage </li>
        </ul>
    </div>
    <!-- END Breadcrumb -->
    <!-- BEGIN Main Content -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3> <i class="fa fa-file-o"></i> Update Frontpage </h3>
                </div>
                <div class="box-content">
                    <form method="post" class="form-horizontal" action="{{ url('/') }}/superadmin/pages/updatepage" id="frm_add_product" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-md-10">
                        @if(Session::has('success'))
                            <div class="alert alert-success" id="no_select" style="">{{ "Success : ".Session::get('success') }}</div>
                        @elseif(Session::has('error'))
                            <div class="alert alert-danger" id="warning_msg" style="">{{ "Error : ".Session::get('error') }}</div>
                        @endif
                        </div>
                        <input type="hidden" name="front_id" name="front_id" value="{{ $pages[0]['front_id'] }}">
                         <input type="hidden" name="old_image" name="old_image" value="{{ $pages[0]['front_image'] }}">
                       <div class="form-group">
                            <label class="col-sm-3 col-lg-3 control-label" for="name">Name <span style="color:#F00;">*</span>
                            </label>
                            <div class="col-sm-9 col-lg-5 controls">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ $pages[0]['front_page_name_eng']}}"  />
                                <div class="error" style="color:red" id="err_name"></div>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-sm-3 col-lg-3 control-label" for="add_faq">Title <span style="color:#F00;">*</span>
                            </label>
                            <div class="col-sm-9 col-lg-5 controls">
                                <input type="text" class="form-control" name="title" id="title" placeholder="Question" value="{{ $pages[0]['front_page_title_eng']}}"  />
                                <div class="error" style="color:red" id="err_title"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-3 control-label" for="kingdomhall_image">Front Image</label>
                            <div class="col-sm-9 col-lg-9 controls">
                                @if($pages[0]['front_image']!="")
                                    <div class=""><img src="{{ url('/') }}/public/uploads/frontpage-images/{{ $pages[0]['front_image'] }}" width="400" height="200" ></div>
                                @endif
                                <input type="file" class="form-control bimage" name="front_image" id="front_image" />
                                <div class="error" style="color:red" id="error_front_image"></div>
                               
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-3 control-label" for="Description" class="ckeditor">Description<span style="color:#F00;">*</span>
                            </label>
                            <div class="col-sm-9 col-lg-5 controls">
                            <textarea name="description" id="description"  class="form-control ckeditor" placeholder="Description">{{ $pages[0]['front_page_description_eng']}}</textarea>
                                <div class="error" style="color:red" id="err_description"></div>
                            </div>
                        </div>
                        

                         <div class="form-group">
                         <div class="col-sm-9 col-lg-4 controls">&nbsp;</div>
                            <div class="col-sm-9 col-lg-5 controls">
                                <input type="submit" class="btn btn-primary" name="btn_update_page" id="btn_update_page" value="Submit"/>
                                 <a class="btn" type="button" href="{{ url('/') }}/superadmin/pages/manage">Cancel</a>
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
