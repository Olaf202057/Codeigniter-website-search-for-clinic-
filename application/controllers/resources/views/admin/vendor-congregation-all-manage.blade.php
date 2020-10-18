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
        <h1><i class="fa fa-file-o"></i> Manage Congregation</h1>
        <h4>Manage Congregation</h4>
    </div>
</div>
<!-- END Page Title -->

<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
    <ul class="breadcrumb">
        <li class=""><i class="fa fa-home"></i> <a href="{{ url('/') }}/superadmin/dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li  class="active" >Manage Congregation</li>
    </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Tiles -->
<!-- END Tiles -->
<!-- BEGIN Main Content -->
    
 <div class="row">
   <div class="col-md-12">
    <div class="box">
     <div class="box-title"><h3><i class="fa fa-table"></i>Manage Congregation</h3></div>
     <form name="frm-manage" id="frm-manage" method="get" action="{{ url('/') }}/superadmin/congregation/searchCongregation">
        {{ csrf_field() }}
        <input type="hidden" name="page_id" id="page_id" value="report" >
        <?php if(count($congregation)>0)
        { ?>
        <input type="hidden" name="ven_id" id="ven_id" value="{{ $congregation[0]['vendor_id'] }}" >
        <?php  } ?>
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
             <div class="btn-group">

                <div class="col-md-12 form-group">
                    <label class="col-sm-2 col-lg-2 " style="margin-top:6px;">Congregation name: </label>
                    <div class="col-sm-1 col-lg-2 controls">
                      <input type="text"  placeholder="Congregation name"  id="cong_name" name="cong_name" class="form-control"  value="@if(isset($search_arr)){{ trim($search_arr['cong_name']) }}@endif"  >
                    </div>
                   <label class="col-sm-2 col-lg-2 " style="margin-top:6px;">Midweek Meeting day: </label>
                    <div class="col-sm-1 col-lg-2 controls">
                    
                     <select id='midd_met_day' name="midd_met_day" class="form-control">
                        <option value="">None</option>
                        <option  <?php if(isset($search_arr)){ if($search_arr['midd_met_day'] == 'mon') echo "selected=selected"; }?> value="mon">Monday</option>
                        <option <?php if(isset($search_arr)){ if($search_arr['midd_met_day'] == 'tue') echo "selected=selected"; }?>  value="tue">Tuesday</option>
                        <option <?php if(isset($search_arr)){ if($search_arr['midd_met_day'] == 'wed') echo "selected=selected"; }?>  value="wed">Wednusday</option>
                        <option  <?php if(isset($search_arr)){ if($search_arr['midd_met_day'] == 'thu') echo "selected=selected"; }?> value="thu">Thursday</option>
                        <option  <?php if(isset($search_arr)){ if($search_arr['midd_met_day'] == 'fri') echo "selected=selected"; }?> value="fri">Friday</option>
                        <option  <?php if(isset($search_arr)){ if($search_arr['midd_met_day'] == 'sat') echo "selected=selected"; }?> value="sat">Saturday</option>
                        <option  <?php if(isset($search_arr)){ if($search_arr['midd_met_day'] == 'sun') echo "selected=selected"; }?> value="sun">Sunday</option>
                        
                     </select>
                    </div>
                     <label class="col-sm-2 col-lg-2 " style="margin-top:6px;">Midweek Meeting Time: </label>
                    <div class="col-sm-1 col-lg-1 controls" style='width: 145px;'>
                    
                     <select name="midd_met_time" id="midd_met_time" class="form-control">
                        <option value=""><?php if(isset($search_arr)){ echo $search_arr['midd_met_time']; } else echo "None" ; ?></option>
                    </select>


                    </div>
                 </div> 
                <div class="col-md-12 form-group">

                
                   <label class="col-sm-2 col-lg-2 " style="margin-top:6px;">Weekend Meeting day: </label>
                    <div class="col-sm-1 col-lg-2 controls">
                    
                     <select id='wek_met_day' name="wek_met_day" class="form-control">
                         <option value="">None</option>
                        <option  <?php if(isset($search_arr)){ if($search_arr['wek_met_day'] == 'mon') echo "selected=selected"; }?> value="mon">Monday</option>
                        <option <?php if(isset($search_arr)){ if($search_arr['wek_met_day'] == 'tue') echo "selected=selected"; }?>  value="tue">Tuesday</option>
                        <option <?php if(isset($search_arr)){ if($search_arr['wek_met_day'] == 'wed') echo "selected=selected"; }?>  value="wed">Wednusday</option>
                        <option  <?php if(isset($search_arr)){ if($search_arr['wek_met_day'] == 'thu') echo "selected=selected"; }?> value="thu">Thursday</option>
                        <option  <?php if(isset($search_arr)){ if($search_arr['wek_met_day'] == 'fri') echo "selected=selected"; }?> value="fri">Friday</option>
                        <option  <?php if(isset($search_arr)){ if($search_arr['wek_met_day'] == 'sat') echo "selected=selected"; }?> value="sat">Saturday</option>
                        <option  <?php if(isset($search_arr)){ if($search_arr['wek_met_day'] == 'sun') echo "selected=selected"; }?> value="sun">Sunday</option>
                       
                     </select>
                    </div>

                    <label class="col-sm-2 col-lg-2 " style="margin-top:6px;">Weekend Meeting Time: </label>
                    <div class="col-sm-1 col-lg-1 controls" style='width: 145px;'>
                   
                    <select name="wek_met_time" id="wek_met_time" class="form-control" >
                        <option value=""><?php if(isset($search_arr)){ echo $search_arr['wek_met_time']; }else echo "None"; ?></option>
                    </select>
                    
                    </div>
                    <div class="col-sm-1 col-lg-1 controls" style='width: 145px;'>
                       <input id="submit_filter" class="form-control btn btn-primary same_search" type="submit" value="Search" name="btn_search">
                   </div>
                   <?php if(count($congregation)>0)
                    { ?>
                    <div class="col-sm-1">
                     <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ url('/') }}/superadmin/report/congregations/<?php echo base64_encode($congregation[0]['vendor_id']) ?>" title="vendors"  data-toggle="modal" style="text-decoration:none;"><i class="fa fa-repeat"></i></a>
                    </div>
                   <?php  } else { ?>
                   <div class="col-sm-1">
                     <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ url('/') }}/superadmin/report/vendors" title="vendors"  data-toggle="modal" style="text-decoration:none;"><i class="fa fa-repeat"></i></a>
                    </div>
                    <?php } ?>


                   
                </div> 


                 <div class="col-md-12 form-group">
                      <div class="col-sm-2 col-lg-2 " style="margin-top:6px;"> </div>
                       <div class="col-sm-2 col-lg-2 " style="margin-top:6px;"> </div>
                       <div class="error" id="err_filter_search"></div>
                  </div>

                 
             </div>
           </div>
      
           <br/><br/>
           <div class="clearfix"></div>
           <div class="table-responsive" style="border:0" id="showBlockUI">
             <table class="table table-condensed" <?php //if(count($all_course)>0){?> id="table1"<?php //} ?>>
              <thead>
               <tr>
                <th style="width:18px"><input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th>
                <th>Congregation Name</th>
                <th>Midweek Meeting</th>
                <th>Weekend Meeting</th>
                <th>Administrator</th>
                <th>Port</th>
                <th>30 Day count</th>
                <th>Kingdomhall Image</th>
                <th>Banner</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
             <tbody id="catList" >
            @if(count($congregation)>0)
                @foreach($congregation as $cong)
               
                    <tr>
                        <td style="width:18px"><input type="checkbox" name="checkbox_del[]" id="checkbox_del" value="{{ $cong['congregation_id'] }}"/></td>
                        <td>{{ $cong['congregation_name'] }}</td>
                        <td>{{ ($cong['midd_met_day']!="") ? date('l',strtotime($cong['midd_met_day'])).', '.$cong['midd_met_time'] : '---' }}</td>
                        <td>{{ ($cong['wek_met_day']!="") ? date('l',strtotime($cong['wek_met_day'])).', '.$cong['wek_met_time'] : '---' }}</td>
                        <td>{{ (count($cong['vendor'])>0) ? ucwords($cong['vendor']['vendor_username']) : '---' }}</td>
                        <td>{{ ($cong['port']!=0) ? $cong['port'] : '---' }}</td>
                        <td>{{ '---' }}</td>
                        <?php $kh_image = ($cong['kingdomhall_image']!="") ? $cong['kingdomhall_image'] : "dummypic.jpg";?>
                        <td><img src='{{url("/")}}/public/uploads/congregation_pic/{{ $kh_image }}' width='60' height='40'> </td>
                        <?php $banner_image = ($cong['banner_image']!="") ? $cong['banner_image'] : "dummypic.jpg";?>
                        <td><img src='{{url("/")}}/public/uploads/congregation_pic/{{ $banner_image }}' width='60' height='40'> </td>
                        <td>   
                            @if($cong['congregation_status']=='active')
                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Active"   style="text-decoration:none;"><i class="fa fa-dot-circle-o"></i></a>
                            @else
                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip"  title="block" style="text-decoration:none;"><i class="fa fa-circle-o"></i></a>
                            @endif
                        </td>
                        <td>
                            <!-- <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" style="text-decoration:none;" href="{{ url('/') }}/superadmin/congregation/view/{{ base64_encode($cong['congregation_id']) }}"  title="View"><i class="fa fa-eye"></i></a>
                             -->
                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" style="text-decoration:none;" href="{{ url('/') }}/superadmin/congregation/edit/report/{{ base64_encode($cong['congregation_id']) }}/{{ base64_encode($cong['vendor_id']) }}" title="Edit"><i class="fa fa-edit"></i></a>
                        </td>                                                                                                                                                                 
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

<script type="text/javascript">
//populatedropdown(id_of_time_select)
    window.onload=function(){
        populatedropdownselect("midd_met_time","<?php echo $cong_details['midd_met_time'] ?>");
        populatedropdownselect("wek_met_time","<?php echo $cong_details['wek_met_time'] ?>");


       
    }    
</script>