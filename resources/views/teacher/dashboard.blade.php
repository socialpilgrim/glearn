@extends('layouts.teacher.app')
@php $i = 1;$k=$i;@endphp
@section('content')

<?php 

//print_r($teacherData);

?>

<section class="main-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-12">
        <ul class="nav nav-tabs1 nav-pills" id="myTab" role="tablist">
          <li class="nav-item mb-1">
            <a class="nav-link shadow-sm active" data-toggle="tab" href="#ulclasses" role="tab" aria-selected="true">Today's Live Classes</a>
          </li>
          <li class="nav-item mb-1">
            <a class="nav-link shadow-sm" data-toggle="tab" href="#plclasses" role="tab">Past Live Classes</a>
          </li>
          <li class="nav-item mb-1 ml-md-auto">
            <a class="nav-link shadow-sm mr-0" data-toggle="modal" href="#addClassModal" role="modal">
              <svg class="icon mr-1"><use xlink:href="../images/icons.svg#icon_plus"></use></svg> Add Classes
            </a>
          </li>
        </ul>
       <div class="tab-content pt-3">
          <div class="tab-pane fade show active" id="ulclasses">
		  
		  @if(count($teacherData) > 0)

			  @foreach ($teacherData as $t)
				
				@php
					 $i=1;
					if($t->class_name == "1")
						$st = "st";
					elseif($t->class_name == "2")
						$st = "nd";
					elseif($t->class_name == "3")
						$st = "rd";
					else
						$st = "th";
				
				@endphp		
			  
					<div class="classes-box">
					  <div class="classes-datetime">
						<div class="cls-date">{{ $todaysDate }}</div>
						<div class="cls-from">{{$t->from_timing}}</div>
						<div class="cls-separater">to</div>
						<div class="cls-to">{{$t->to_timing}}</div>
					  </div>
					  <div class="d-flex justify-content-between align-items-center flex-wrap pt-1 pb-2">
						<div class="font-weight-bold pt-1"><span class="text-secondary">Class:</span> {{App\Http\Helpers\CustomHelper::addOrdinalNumberSuffix($t->studentClass->class_name)}} Std</div>
						<div class="font-weight-bold pt-1"><span class="text-secondary">Section:</span> {{$t->studentClass->section_name}}</div>
						<div class="font-weight-bold pt-1"><span class="text-secondary">Subject:</span> {{$t->studentSubject->subject_name}}</div>
					  </div>
					  <p class="mt-0 mb-2 text-secondary text-edit" contenteditable="true">
						
					  </p>
					  <input type="hidden" id="g_class_id_{{$i}}" value="{{ $t->studentClass->g_class_id}}"/>
					  <div class="d-flex justify-content-between flex-wrap py-2">
						<div>
						  <a href="javascript:void(0);" data-LiveLink="{{ $t->studentClass->g_link }}" id="live_c_link_{{$i}}"  class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow">
							<svg class="icon font-10 mr-1"><use xlink:href="../images/icons.svg#icon_dot"></use></svg> Join Live
						  </a>
						  <a href="#" class="btn btn-sm btn-outline-primary mb-1 mr-2 border-0 btn-shadow" id="new_a_link_{{$i}}" class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow" data-createModal='{{$i}}' data-class_modal="{{$t->class_id}}" data-subject_modal="{{$t->subject_id}}"  data-teacher_modal="{{$t->teacher_id}}">
							<svg class="icon font-12 mr-1"><use xlink:href="../images/icons.svg#icon_plus"></use></svg> Add New Assignment
						  </a>
						  <a href="#" class="btn btn-sm btn-outline-magenta mb-1 mr-2 border-0 btn-shadow">
							<svg class="icon mr-1"><use xlink:href="../images/icons.svg#icon_bell"></use></svg> Notify Students 
						  </a>
						</div>
						<div>
						  <button type="button" data-classhelp="#A01" class="btn btn-sm btn-outline-info mb-1 mr-2 border-0 btn-shadow" title="Help"><svg class="icon mr-1"><use xlink:href="../images/icons.svg#icon_help"></use></svg>
							Help 
						  </button>
						  <button type="button" data-editmodal="#A123" class="btn btn-sm btn-outline-secondary mb-1 border-0 btn-shadow" title="Edit"><svg class="icon mr-1"><use xlink:href="../images/icons.svg#icon_edit"></use></svg> Edit 
						  </button>
						</div>
					  </div>
					  
					  <?php
						$topics = App\Http\Helpers\CustomHelper::getTopics($t->class_id);
					  ?>
					  
					  <div class="select-topicbox">
						<select class="form-control custom-select-sm border-0 btn-shadow" data-selecttopic="{{$t->id}}">
						    <option value="">Select Topic</option>
							  @if(count($topics)>0)
								@foreach($topics as $topic)
								  <?php $selected = ($topic->id==$t->topic_id)?'selected':'';?>
								  <option value="{{$topic->id}}" {{$selected}}>{{$topic->topicname}}</option>
								@endforeach
							  @endif
							</select>
						</select>
						<a href="#" class="btn btn-outline-primary btn-sm btn-block mt-2 border-0 btn-shadow" id="st1" style="display:;">
						  View Content
						</a>
					  </div>
					</div>
					@php 
					$i++;	
					@endphp
				@endforeach
			@else

            <div class="classes-box min-height-auto py-4 p-4 text-danger text-center">
              <svg class="icon icon-4x mr-3"><use xlink:href="../images/icons.svg#icon_nodate"></use></svg> No Record Found!
            </div>
			@endif
          </div>

          <!-- ///////////////// -->
          <!-- Past Live Classes -->
          <!-- ///////////////// -->
          <div class="tab-pane fade" id="plclasses">
            <div class="classes-box">
              <div class="classes-datetime">
                <div class="cls-date">22 Apr</div>
                <div class="cls-from">10:00 AM</div>
                <div class="cls-separater">to</div>
                <div class="cls-to">11:00 AM</div>
              </div>
              <div class="d-flex justify-content-between align-items-center flex-wrap pt-1 pb-2">
                <div class="font-weight-bold pt-1"><span class="text-secondary">Class:</span> 7th Std</div>
                <div class="font-weight-bold pt-1"><span class="text-secondary">Section:</span> A</div>
                <div class="font-weight-bold pt-1"><span class="text-secondary">Subject:</span> Physics</div>
              </div>
              <p class="mt-0 mb-2 text-secondary text-edit" contenteditable="true">
                Description of Physics, The branch of science concerned with the nature and...
              </p>
              <div class="d-flex justify-content-between flex-wrap py-2">
                <div>
                  <a href="#" class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow">
                    <svg class="icon icon-2x mr-1"><use xlink:href="../images/icons.svg#icon_eye"></use></svg> View Recording
                  </a>
                  <a href="#" class="btn btn-sm btn-outline-primary mb-1 mr-2 border-0 btn-shadow">
                    <svg class="icon font-12 mr-1"><use xlink:href="../images/icons.svg#icon_plus"></use></svg> Add Quiz 
                  </a>
                  <a href="#" class="btn btn-sm btn-outline-magenta mb-1 mr-2 border-0 btn-shadow d-none">
                    <svg class="icon mr-1"><use xlink:href="../images/icons.svg#icon_chart"></use></svg> Report 
                  </a>
                </div>
                <div>
                  <a href="#" class="btn btn-sm btn-outline-info mb-1 mr-2 border-0 btn-shadow" title="Help"><svg class="icon mr-1"><use xlink:href="../images/icons.svg#icon_help"></use></svg>
                    Help
                  </a>
                  <a href="#editModal" data-editmodal="#A123" class="btn btn-sm btn-outline-secondary mb-1 border-0 btn-shadow" title="Edit"><svg class="icon mr-1"><use xlink:href="../images/icons.svg#icon_edit"></use></svg> Edit 
                  </a>
                </div>
              </div>
              <div class="select-topicbox">
                <select class="form-control custom-select-sm border-0 btn-shadow" data-selecttopic="#est1">
                  <option value="">Select Topic</option>
                  <option>Topic A</option>
                  <option>Topic B</option>
                  <option>Topic C</option>
                </select>
                <a href="#" class="btn btn-outline-primary btn-sm btn-block border-0 btn-shadow" id="est1" style="display: none;">
                  View Content
                </a>
              </div>
            </div>
            <div class="classes-box">
              <div class="classes-datetime">
                <div class="cls-date">22 Apr</div>
                <div class="cls-from">10:00 AM</div>
                <div class="cls-separater">to</div>
                <div class="cls-to">11:00 AM</div>
              </div>
              <div class="d-flex justify-content-between align-items-center flex-wrap pt-1 pb-2">
                <div class="font-weight-bold pt-1"><span class="text-secondary">Class:</span> 8th Std</div>
                <div class="font-weight-bold pt-1"><span class="text-secondary">Section:</span> B</div>
                <div class="font-weight-bold pt-1"><span class="text-secondary">Subject:</span> Physics</div>
              </div>
              <p class="mt-0 mb-2 text-secondary text-edit" contenteditable="true">
                Description of Physics, The branch of science concerned with the nature and...
              </p>
              <div class="d-flex justify-content-between flex-wrap py-2">
                <div>
                  <a href="#" class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow">
                    <svg class="icon icon-2x mr-1"><use xlink:href="../images/icons.svg#icon_eye"></use></svg> View Recording
                  </a>
                  <a href="#" class="btn btn-sm btn-outline-primary mb-1 mr-2 border-0 btn-shadow">
                    <svg class="icon font-12 mr-1"><use xlink:href="../images/icons.svg#icon_plus"></use></svg> Add Quiz 
                  </a>
                  <a href="#" class="btn btn-sm btn-outline-magenta mb-1 mr-2 border-0 btn-shadow d-none">
                    <svg class="icon mr-1"><use xlink:href="../images/icons.svg#icon_chart"></use></svg> Report 
                  </a>
                </div>
                <div>
                  <a href="#" class="btn btn-sm btn-outline-info mb-1 mr-2 border-0 btn-shadow" title="Help"><svg class="icon mr-1"><use xlink:href="../images/icons.svg#icon_help"></use></svg>
                    Help
                  </a>
                  <a href="#editModal" data-editmodal="#A123" class="btn btn-sm btn-outline-secondary mb-1 border-0 btn-shadow" title="Edit"><svg class="icon mr-1"><use xlink:href="../images/icons.svg#icon_edit"></use></svg> Edit 
                  </a>
                </div>
              </div>
              <div class="select-topicbox">
                <select class="form-control custom-select-sm border-0 btn-shadow" data-selecttopic="#est2">
                  <option value="">Select Topic</option>
                  <option>Topic A</option>
                  <option>Topic B</option>
                  <option>Topic C</option>
                </select>
                <a href="#" class="btn btn-outline-primary btn-sm btn-block border-0 btn-shadow" id="est2" style="display: none;">
                  View Content
                </a>
              </div>
            </div>
            <div class="classes-box">
              <div class="classes-datetime">
                <div class="cls-date">22 Apr</div>
                <div class="cls-from">10:00 AM</div>
                <div class="cls-separater">to</div>
                <div class="cls-to">11:00 AM</div>
              </div>
              <div class="d-flex justify-content-between align-items-center flex-wrap pt-1 pb-2">
                <div class="font-weight-bold pt-1"><span class="text-secondary">Class:</span> 9th Std</div>
                <div class="font-weight-bold pt-1"><span class="text-secondary">Section:</span> C</div>
                <div class="font-weight-bold pt-1"><span class="text-secondary">Subject:</span> Physics</div>
              </div>
              <p class="mt-0 mb-2 text-secondary text-edit" contenteditable="true">
                Description of Physics, The branch of science concerned with the nature and...
              </p>
              <div class="d-flex justify-content-between flex-wrap py-2">
                <div>
                  <a href="#" class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow">
                    <svg class="icon icon-2x mr-1"><use xlink:href="../images/icons.svg#icon_eye"></use></svg> View Recording
                  </a>
                  <a href="#" class="btn btn-sm btn-outline-primary mb-1 mr-2 border-0 btn-shadow">
                    <svg class="icon font-12 mr-1"><use xlink:href="../images/icons.svg#icon_plus"></use></svg> Add Quiz 
                  </a>
                  <a href="#" class="btn btn-sm btn-outline-magenta mb-1 mr-2 border-0 btn-shadow d-none">
                    <svg class="icon mr-1"><use xlink:href="../images/icons.svg#icon_chart"></use></svg> Report 
                  </a>
                </div>
                <div>
                  <a href="#" class="btn btn-sm btn-outline-info mb-1 mr-2 border-0 btn-shadow" title="Help"><svg class="icon mr-1"><use xlink:href="../images/icons.svg#icon_help"></use></svg>
                    Help
                  </a>
                  <a href="#editModal" data-editmodal="#A123" class="btn btn-sm btn-outline-secondary mb-1 border-0 btn-shadow" title="Edit"><svg class="icon mr-1"><use xlink:href="../images/icons.svg#icon_edit"></use></svg> Edit 
                  </a>
                </div>
              </div>
              <div class="select-topicbox">
                <select class="form-control custom-select-sm border-0 btn-shadow" data-selecttopic="#est3">
                  <option value="">Select Topic</option>
                  <option>Topic A</option>
                  <option>Topic B</option>
                  <option>Topic C</option>
                </select>
                <a href="#" class="btn btn-outline-primary btn-sm btn-block border-0 btn-shadow" id="est3" style="display: none;">
                  View Content
                </a>
              </div>
            </div>
            <div class="classes-box min-height-auto py-4 p-4 text-danger text-center">
              <svg class="icon icon-4x mr-3"><use xlink:href="../images/icons.svg#icon_nodate"></use></svg> No Record Found!
            </div>
          </div>
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



<!-- Class Box Help Modal -->
<div class="modal fade" id="classhelpModal" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light d-flex align-items-center">
        <h5 class="modal-title font-weight-bold">Help Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <svg class="icon"><use xlink:href="../images/icons.svg#icon_times2"></use></svg>
        </button>
      </div>
      <div class="modal-body pt-4">
        <form>
          <div class="form-group">
            <textarea class="form-control" value="" rows="5" placeholder="Write help message..." required="required"></textarea>
          </div>
          <div class="form-group text-right">
            <button type="submit" class="btn btn-primary px-4">
              <svg class="icon mr-2"><use xlink:href="../images/icons.svg#icon_send"></use></svg> Send
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<!-- Add Class Modal -->
<div class="modal fade" id="addClassModal" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light d-flex align-items-center">
        <h5 class="modal-title font-weight-bold">Add Class</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <svg class="icon"><use xlink:href="../images/icons.svg#icon_times2"></use></svg>
        </button>
      </div>
      <div class="modal-body pt-4">
        <form>
          <div class="form-group row">
            <label for="addinputDate" class="col-md-4 col-form-label text-md-right">Date:</label>
            <div class="col-md-6">
              <input type="text" class="form-control ac-datepicker" id="addinputDate" value="" placeholder="DD MM YYYY">
            </div>
          </div>
          <div class="form-group row">
            <label for="addinputFtime" class="col-md-4 col-form-label text-md-right">Class From Time:</label>
            <div class="col-md-6">
              <input type="text" class="form-control ac-time" id="addinputFtime" value="" placeholder="00:00 AM/PM">
            </div>
          </div>
          <div class="form-group row">
            <label for="addinputTtime" class="col-md-4 col-form-label text-md-right">Class To Time:</label>
            <div class="col-md-6">
              <input type="text" class="form-control ac-time" id="addinputTtime" value="" placeholder="00:00 AM/PM">
            </div>
          </div>
          <div class="form-group row">
            <label for="addclassChoose" class="col-md-4 col-form-label text-md-right">Class:</label>
            <div class="col-md-6">
              <select class="custom-select" id="addclassChoose">
                <option>Select Class</option>
                <option>6th Std</option>
                <option>7th Std</option>
                <option>8th Std</option>
                <option>9th Std</option>
                <option>10th Std</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="addinputSection" class="col-md-4 col-form-label text-md-right">Section:</label>
            <div class="col-md-6">
              <select class="custom-select" id="addinputSection" multiple="multiple">
                <option>A</option>
                <option>B</option>
                <option>C</option>
                <option>D</option>
                <option>E</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="addinputSubject" class="col-md-4 col-form-label text-md-right">Subject:</label>
            <div class="col-md-6">
              <select class="custom-select" id="addinputSubject">
                <option>Select Subject</option>
                <option>Physics</option>
                <option>Chemistry</option>
                <option>Mathematics</option>
                <option>English</option>
                <option>Biology</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputDesc" class="col-md-4 col-form-label text-md-right">Description:</label>
            <div class="col-md-6">
              <textarea class="form-control" id="inputDesc" rows="3" placeholder="Write here..."></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputJoinlive" class="col-md-4 col-form-label text-md-right">Join Live <small>(Link)</small>:</label>
            <div class="col-md-6">
              <textarea class="form-control" id="inputJoinlive" rows="3" placeholder="Enter Link"></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputNotifystd" class="col-md-4 col-form-label text-md-right">Notify Students:</label>
            <div class="col-md-6">
              <textarea class="form-control" id="inputNotifystd" rows="3" placeholder="Enter Notify Message"></textarea>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-8 offset-md-4">
              <button type="button" class="btn btn-primary px-4">Save Class</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End -->

<!-- Edit Class Modal -->
<div class="modal fade" id="editClassModal" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light d-flex align-items-center">
        <h5 class="modal-title font-weight-bold">Edit Class Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <svg class="icon"><use xlink:href="../images/icons.svg#icon_times2"></use></svg>
        </button>
      </div>
      <div class="modal-body pt-4">
        <form>
          <div class="form-group row">
            <label for="inputDate" class="col-md-4 col-form-label text-md-right">Date:</label>
            <div class="col-md-6">
              <input type="text" class="form-control" id="inputDate" value="22 Apr">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputFtime" class="col-md-4 col-form-label text-md-right">Class From Time:</label>
            <div class="col-md-6">
              <input type="text" class="form-control" id="inputFtime" value="10:00 AM" placeholder="00:00 AM/PM">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputTtime" class="col-md-4 col-form-label text-md-right">Class To Time:</label>
            <div class="col-md-6">
              <input type="text" class="form-control" id="inputTtime" value="11:00 AM" placeholder="00:00 AM/PM">
            </div>
          </div>
          <div class="form-group row">
            <label for="classChoose" class="col-md-4 col-form-label text-md-right">Class:</label>
            <div class="col-md-6">              
              <select class="custom-select" id="classChoose">
                <option>Select Class</option>
                <option>6th Std</option>
                <option>7th Std</option>
                <option>8th Std</option>
                <option>9th Std</option>
                <option>10th Std</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputSection" class="col-md-4 col-form-label text-md-right">Section:</label>
            <div class="col-md-6">
              <input type="text" class="form-control" id="inputSection" value="A" placeholder="Example A,B">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputSubject" class="col-md-4 col-form-label text-md-right">Subject:</label>
            <div class="col-md-6">
              <select class="custom-select" id="inputSubject">
                <option>Select Subject</option>
                <option>Physics</option>
                <option>Chemistry</option>
                <option>Mathematics</option>
                <option>English</option>
                <option>Biology</option>
              </select>
            </div>
          </div>	
          <div class="form-group row">
            <label for="inputDesc" class="col-md-4 col-form-label text-md-right">Description:</label>
            <div class="col-md-6">
              <textarea class="form-control" id="inputDesc" rows="3" placeholder="Write here...">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputJoinlive" class="col-md-4 col-form-label text-md-right">Join Live <small>(Link)</small>:</label>
            <div class="col-md-6">
              <textarea class="form-control" id="inputJoinlive" rows="3" placeholder="Enter Link">https://www.xipetech.club/work/liveclass/</textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputAddquiz" class="col-md-4 col-form-label text-md-right">Add Quiz <small>(Link)</small>:</label>
            <div class="col-md-6">
              <textarea class="form-control" id="inputAddquiz" rows="3" placeholder="Enter Link">https://www.xipetech.club/work/liveclass/</textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputNotifystd" class="col-md-4 col-form-label text-md-right">Notify Students:</label>
            <div class="col-md-6">
              <textarea class="form-control" id="inputNotifystd" rows="3" placeholder="Enter Link">Class will start from monday</textarea>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-8 offset-md-4">
              <button type="button" class="btn btn-primary px-4">Save</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End -->




<script type="text/javascript">
$(document).ready(function(){
  $('.ac-datepicker').datepicker({
    dateFormat: 'd M yy'
  });
  $('.ac-time').timepicker({
    controlType: 'select',
    oneLine: true,
    timeFormat: 'hh:mm tt'
  });
}); 



$(document).on('click', '[data-LiveLink]', function(){
   var liveurl = $(this).attr("data-LiveLink");
   if(liveurl!=''){
		//$('#viewClassModal').modal('show');
		//$("#thedialog").attr('src','https://google.com');
		window.open(liveurl,"dialog name", "dialogWidth:400px;dialogHeight:300px");
   }else{
    alert('No assignement url found!');
   }
});


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






</script>

@endsection

