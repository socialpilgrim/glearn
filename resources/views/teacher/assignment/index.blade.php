@extends('layouts.teacher.app')
@section('content')



<?php //print_r($links); 
 ?>

<section class="main-section">
  <div class="container">
    <div class="row justify-content-center">
     <div class="col-md-8 col-xl-8">
        <?php
        if(count($class_list) > 0){
        $added_array = array();
        $i=1;
        foreach($class_list AS $list){
			
		$logged_teacher_id = $list->teacher_id;	
        $added = $list->class_id.'_'.$list->subject_id;
        if(!in_array($added,$added_array)){
        $added_array[] = $list->class_id.'_'.$list->subject_id;
        ?>
        <div class="classes-box px-3 min-height-auto" style="overflow:visible!important;">
          <div class="d-flex justify-content-between align-items-center flex-wrap pt-1 pb-2">
            <div class="font-weight-bold pt-1"><span class="text-secondary">Class:</span> {{ App\Http\Helpers\CustomHelper::addOrdinalNumberSuffix($list->studentClass->class_name) }} Std</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Section:</span> {{$list->studentClass->section_name}}</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Subject:</span> {{$list->studentSubject->subject_name}}</div>
          </div>
          <hr class="mt-0 mb-1">
          <div class="d-flex justify-content-between flex-wrap py-2">
            <div>
				
				<input type="hidden" id="g_class_id_{{$i}}" value="{{ $list->studentClass->g_class_id}}"/>
              <a  href="javascript:void(0);"  id="new_a_link_{{$i}}" class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow" data-createModal='{{$i}}' data-class_modal="{{$list->class_id}}" data-subject_modal="{{$list->subject_id}}"  data-teacher_modal="{{$list->teacher_id}}">
                <svg class="icon mr-1"><use xlink:href="../images/icons.svg#icon_file"></use></svg> New Assignment
              </a>
			 <!-- <ul class="dropdown-menu">data-toggle="dropdown"
				  	<a class="dropdown-item" href="#">Profile</a>
				  	<a class="dropdown-item" href="#">Change Password</a>
				</ul> -->
			@if ($links[$list->class_id][$list->subject_id]['id'] != '')	
              <a href="javascript:void(0);" data-oldlink="{{$links[$list->class_id][$list->subject_id]['g_live_link']}}" id="old_a_link_{{$i}}" class="btn btn-sm btn-outline-primary mb-1 mr-2 border-0 btn-shadow">
                <svg class="icon icon-2x mr-1"><use xlink:href="../images/icons.svg#icon_eye"></use></svg> View Given Assignments
              </a>
			 </div>  
			 <div>
			   <a href="javascript:" data-editlink="{{$links[$list->class_id][$list->subject_id]['g_live_link']}}" class="btn btn-sm btn-outline-secondary mb-1 border-0 btn-shadow" title="Edit">
                <svg class="icon mr-1"><use xlink:href="../images/icons.svg#icon_edit"></use></svg> Edit 
              </a>
			  
			@else
			   <a href="javascript:void(0);" class="btn btn-sm btn-outline-danger mb-1 mr-2 border-0 btn-shadow">
                <svg class="icon icon-2x mr-1"><use xlink:href="../images/icons.svg#icon_eye"></use></svg> No Assignments
              </a>
			@endif
		 
		  </div>
			
            <!-- <input type="button" name="save" value="save" onclick="openDialog()" /> -->
            
          </div>
        </div> 
		
		
        <?php
        $i++;
        }
      }}else{
    ?>
      <div class="classes-box min-height-auto py-4 p-4 text-danger text-center">
        <svg class="icon icon-4x mr-3"><use xlink:href="../images/icons.svg#icon_nodate"></use></svg> No Record Found!
       </div>
      <?php } ?>  
      </div>
     
	 @php 
	$teachersData = App\ClassTiming::with('studentClass','studentSubject')->where('teacher_id',$logged_teacher_id)->get();
	$arr_subject = $arr_section = array();
	@endphp 
 

	 <div class="col-md-4 col-xl-4 mb-3">
        <div class="p-3 p-md-4 h-100 bg-lightblue">
          <h5 class="font-weight-bold mb-3">Standard Assignment</h5>
          <div class="form-group">
            <label for="classChoose" class="mb-0">Class:</label>
            <select class="form-control form-control-sm border-0" id="classChoose">
              <option>Select Class</option>
              @foreach($teachersData as $key => $data)
					@php 
						$arr_section_key[] = $data->class_id;
						$arr_section[] = App\Http\Helpers\CustomHelper::addOrdinalNumberSuffix($data->studentClass->class_name);
					@endphp
				@endforeach
				@php 
					$arr_section = array_combine($arr_section_key,$arr_section);
				@endphp
				@foreach($arr_section as $key => $value)
					<option value="{{ $key }}">{{$value}}</option>
				@endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="subjectChoose" class="mb-0">Subject:</label>
			  <select class="form-control form-control-sm border-0" id="subjectChoose">
				 <option value="0">Select Subject</option>
			@foreach($teachersData as $key => $data)
					@php 
					$arr_subject_key[] = $data->subject_id;
					$arr_subject[] = isset($data->studentSubject)? $data->studentSubject->subject_name:'-';
					@endphp
				@endforeach
			@php
				$arr_subject = array_combine($arr_subject_key,$arr_subject);
			@endphp	
				@foreach($arr_subject as $value)
						<option value="{{ $key }}">{{  $value }}</option>
				@endforeach
			
              
            </select>
          </div>
		  
          <div class="form-group">
            <label for="topicChoose" class="mb-0">Topic:</label>
            <select class="form-control form-control-sm border-0" id="topicChoose">
              <option>Select Topic</option>
              <option>Magnetic</option>
              <option>Trignometry</option>
              <option>Algebra</option>
              <option>Organic</option>
              <option>Drawing</option>
              <option>Newton</option>
            </select>
          </div>
          <ul class="pl-4">
            <li><a href="#">Assignment #1</a></li>
            <li><a href="#">Assignment #2</a></li>
            <li><a href="#">Assignment #3</a></li>
            <li><a href="#">Assignment #4</a></li>
            <li><a href="#">Assignment #5</a></li>
            <li><a href="#">Assignment #6</a></li>
          </ul>
        </div>
      </div>
	  
	  
	  
    </div>
  </div>
</section>


<!-- New Assignment Modal -->
<div class="modal fade" id="createAssiModal" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title font-weight-bold">New Assignment </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pt-4">
          <input type="hidden"  id="new_assignment" value="">
          <input type="hidden"  id="g_class_id" value="">
          <div class="form-group row">
            <label for="inputJoinlive" class="col-md-4 col-form-label text-md-right">Topic Name :</label>
            <div class="col-md-6">
				<input type="text" id="txt_topin_name" class="form-control" placeholder="Topic Name" />
            </div>
          </div>
          <div class="form-group row">
            <label for="inputAddquiz" class="col-md-4 col-form-label text-md-right"> Assignment Title :</label>
            <div class="col-md-6">
              <input type="text" class="form-control" name="txt_aTitle" id="txt_aTitle" placeholder="Assigment Title">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-8 offset-md-4">
              <button type="button" id="assignment_create" class="btn btn-primary px-4">Next</button>
			  
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

<!-- Open Live link in modal  -->
<div class="modal fade" id="viewClassModal" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title font-weight-bold">View Assigment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pt-4">
			<iframe id="thedialog" width="100%" height="100%"></iframe>
      </div>
    </div>
  </div>
</div>


<!-- Edit Class Modal 
<div class="modal fade" id="editClassModal" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title font-weight-bold">Edit Assignment Links</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pt-4">
          <input type="text"  id="edit_assignment" value="">
          <div class="form-group row">
            <label for="inputJoinlive" class="col-md-4 col-form-label text-md-right">New Assigment URL <small>(Link)</small>:</label>
            <div class="col-md-6">
              <textarea class="form-control" name="new_assignment_url" id="new_assignment_url" rows="3" placeholder="Enter Link" required=""></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputAddquiz" class="col-md-4 col-form-label text-md-right">Given Assignment URL <small>(Link)</small>:</label>
            <div class="col-md-6">
              <textarea class="form-control" name="old_assignment_url" id="old_assignment_url" rows="3" placeholder="Enter Link"></textarea>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-8 offset-md-4">
              <button type="button" id="assignment_edit" class="btn btn-primary px-4">Save</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>-->

<script type="text/javascript">

$(document).on('click', '[data-oldlink]', function(){
   var liveurl = $(this).attr("data-oldlink");
   if(liveurl!=''){
		//$('#viewClassModal').modal('show');
		//$("#thedialog").attr('src','https://google.com');
		window.open(liveurl,"dialog name", "dialogWidth:400px;dialogHeight:300px");
   }else{
    alert('No assignement url found!');
   }
});

$(document).on('click', '[data-editlink]', function(){
   var liveurl = $(this).attr("data-editlink");
   if(liveurl!=''){
      window.open(liveurl,"dialog name", "dialogWidth:400px;dialogHeight:300px");
   }else{
    alert('No assignement url found!');
   }
});


/* 

$(document).on('click', '[data-editmodal]', function(){
 var editmodal = $(this).data('editmodal');
  $('#edit_assignment').val(editmodal);
  $('#new_assignment_url').val($('#new_a_link_'+editmodal).attr('href'));
  $('#old_assignment_url').val($('#old_a_link_'+editmodal).attr('href'));
  $('#editClassModal').modal('show');
}); */

$(document).on('click', '[data-createModal]', function(){
 var val = $(this).data('createmodal');
  $('#new_assignment').val(val);
  $('#g_class_id').val($('#g_class_id_'+val).val());
 // $('#old_assignment_url').val($('#old_a_link_'+editmodal).attr('href'));
 $("#txt_aTitle").val('');
 $("#txt_topin_name").val('');
  $('#createAssiModal').modal('show');
});


$(document).on('click', '#assignment_create',(function(){
 var id = $('#new_assignment').val();
var class_id = $('[data-createmodal="'+id+'"]').data('class_modal');
var subject_id = $('[data-createmodal="'+id+'"]').data('subject_modal');
var teacher_id = $('[data-createmodal="'+id+'"]').data('teacher_modal');
//var timing_id = $('[data-createmodal="'+id+'"]').data('timing_modal');
var g_class_id = $('#g_class_id').val();
var topic_name = $('#txt_topin_name').val();
var assignment_title = $('#txt_aTitle').val();




 $.ajax({
      url: "{{url('create-assignment')}}",
      type: "POST",
      data: {g_class_id:g_class_id,topic_name:topic_name,assignment_title:assignment_title,class_id:class_id,subject_id:subject_id,teacher_id:teacher_id},
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      success: function(result){                          
          var response = JSON.parse(result);
          if(response.status == 'success'){
              //$('#new_a_link_'+edit_assignment).attr('href',new_assignment_url);
              //$('#old_a_link_'+edit_assignment).attr('href',old_assignment_url);
              $.fn.notifyMe('success', 5, response.message);
              $('#createAssiModal').modal('hide');
             
				//$('#viewClassModal').modal('show');
			  
			   //$("#thedialog").attr('src', response.cource_url);
				window.open(response.cource_url,"title","dialogWidth:400px;dialogHeight:300px");
				
          }else{
              $.fn.notifyMe('error', 5, response.message);
          }
      }             
  });
}));

/* 
$(document).on('click', '#assignment_edit',(function(){
 var edit_assignment = $('#edit_assignment').val();
var class_modal = $('[data-editmodal="'+edit_assignment+'"]').data('class_modal');
var subject_modal = $('[data-editmodal="'+edit_assignment+'"]').data('subject_modal');
var new_assignment_url = $('#new_assignment_url').val();
var old_assignment_url = $('#old_assignment_url').val();

 $.ajax({
      url: "{{url('edit-assignment')}}",
      type: "POST",
      data: {class:class_modal,subject:subject_modal,new_assignment_url:new_assignment_url,old_assignment_url:old_assignment_url},
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      success: function(result){                          
          var response = JSON.parse(result);
          if(response.status == 'success'){
              $('#new_a_link_'+edit_assignment).attr('href',new_assignment_url);
              $('#old_a_link_'+edit_assignment).attr('href',old_assignment_url);
              $.fn.notifyMe('success', 5, response.message);
              $('#editClassModal').modal('hide');
          }else{
              $.fn.notifyMe('error', 5, response.message);
          }
      }             
  });
})); */

/* 
function openDialog()
{
	 window.open("https://classroom.google.com/c/OTcwNTI1MzUwOTFa/a/MTAwMTUzNjkwNjQ4/details","dialog name",
         "dialogWidth:400px;dialogHeight:300px");
} */
</script>
@endsection