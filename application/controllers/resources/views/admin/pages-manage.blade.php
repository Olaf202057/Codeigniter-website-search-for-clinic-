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
        <h1> <i class="fa fa-file-text"></i>Manage frontpage</h1>
        <h4>Manage frontpage</h4>
    </div>
</div>
<!-- END Page Title -->

<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
    <ul class="breadcrumb">
        <li class=""><i class="fa fa-home"></i> <a href="{{ url('/') }}/superadmin/dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span>
            
        </li>
        <li  class="active" >Manage frontpage</li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title"><h3> <i class="fa fa-file-text"></i>Manage frontpage</h3></div>
            <form name="frm-manage" id="frm-manage" method="post"  action="{{ url('/') }}/superadmin/faq/faqact">
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
                           <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Refresh" href="{{ url('/') }}/superadmin/pages/manage" style="text-decoration:none;"><i class="fa fa-repeat"></i></a> 
                            
                        </div>
                    </div>
                    <br/><br/>
                    <div class="clearfix"></div>
                     <div class="table-responsive" style="border:0" id="showBlockUI">
                    <input type="hidden" name="act_status" id="act_status" value="" />
                   
                        <table class="table table-condensed"  <?php if(count($pages)>0){?> id="table1"<?php } ?>>
                            <thead>
                               <tr>
                                <th style="width:18px"><input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th>
                                
                                <th>Page Name</th>
                                <th>Page Title</th>
                                <th>Description</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                             <tbody id="catList" >
                            @if(count($pages)>0)
                                @foreach($pages as $page)
                               
                                   
                                        <tr>
                                            <td style="width:18px"><input type="checkbox" name="checkbox_del[]" id="checkbox_del" value="{{ $page['front_id'] }}"/></td>
                                            <td>{{ $page['front_page_name_eng'] }}</td>
                                            <td>   
                                                {{ $page['front_page_title_eng'] }}
                                            </td>
                                             <td>
                                                <?php 
                                                    $str =substr($page['front_page_description_eng'],0,50);
                                                    echo strip_tags($str) ?>
                                            </td>
                                            <td>
                                                 <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" style="text-decoration:none;"  href="{{ url('/') }}/superadmin/pages/update/{{ base64_encode($page['front_id']) }}"  title="Edit"><i class="fa fa-edit"></i></a>
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