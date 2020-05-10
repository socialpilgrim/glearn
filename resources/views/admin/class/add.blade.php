@extends('layouts.admin.app')
@section('content')  
<?php 


?>

 <section class="main-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card card-common mb-3">
          <div class="card-header">
            <span class="topic-heading">Create New Class</span>
          </div>
			<div class="card-body pt-4">
				  {!! Form::open(array('route' => ['classes.add'],'method'=>'POST','autocomplete'=>'off')) !!}
				<div class="row">
				<div class="col-md-6">	
						<div class="form-group row">
						  <label for="colFormLabel" class="col-md-4 col-form-label">Class Name:</label>
						  <div class="col-md-8">
							  {!! Form::text('class_name', null, array('placeholder' => 'Class Name','class' => 'form-control','required'=>'required','pattern'=>'[a-zA-Z0-9]+')) !!}
						  </div>
						</div>
						
						<div class="form-group row">
						  <label for="colFormLabel" class="col-md-4 col-form-label">Select Subject:</label>
						  <div class="col-md-8">
							  {!! Form::select('subject', $data['subject'], null,array('class' => 'form-control','required'=>'required')) !!}
						  </div>
						</div>
						
						<div class="form-group row">
							<label for="colFormLabel" class="col-md-4 col-form-label">Section :</label>
							<div class="col-md-8">
							{!! Form::text('section', null, array('placeholder' => 'Section','class' => 'form-control','required'=>'required')) !!}
							</div>
							
						</div>
						
						<div class="form-group row">
							<label for="colFormLabel" class="col-md-4 col-form-label">Class Heading:</label>
							<div class="col-md-8">
							{!! Form::text('class_heading', null, array('placeholder' => 'Class Heading','class' => 'form-control','required'=>'required')) !!}
							</div>
						</div>
						
						<div class="form-group row">
							<label for="colFormLabel" class="col-md-4 col-form-label">Class Description:</label>
							<div class="col-md-8">
							{!! Form::textarea('description', null, array('placeholder' => 'Class Description','class' => 'form-control','required'=>'required','cols'=>'5','rows'=>'5')) !!}
							</div>
						</div>
						<div class="form-group row">
							<label for="colFormLabel" class="col-md-4 col-form-label">Room:</label>
							<div class="col-md-8">
							{!! Form::text('room', null, array('placeholder' => 'Room Number','class' => 'form-control','required'=>'required')) !!}
							</div>
						</div>
							   
						
				</div>
			
				<div class="col-md-6">	
							<div class="form-group row">
						  <label for="colFormLabel" class="col-md-4 col-form-label">Select Teacher:</label>
						  <div class="col-md-8">
							  {!! Form::select('teacher',$data['teacher'], null,array('class' => 'form-control','required'=>'required')) !!}
						  </div>
						</div>
						
						<div class="form-group row">
						  <label for="colFormLabel" class="col-md-4 col-form-label">Select Days:</label>
						  <div class="col-md-8">
							  {!! Form::select('days', $days, null,array('class' => 'form-control','required'=>'required')) !!}
						  </div>
						</div>
						
						<div class="form-group row">
							<label for="colFormLabel" class="col-md-4 col-form-label">Start Time :</label>
							<div class="col-md-8">
							{!! Form::text('start_time', null, array('placeholder' => '','class' => 'form-control timepicker','required'=>'required')) !!}
							</div>
							
						</div>
						
						<div class="form-group row">
							<label for="colFormLabel" class="col-md-4 col-form-label">End Time:</label>
							<div class="col-md-8">
							{!! Form::text('end_time', null, array('placeholder' => '','class' => 'form-control timepicker','required'=>'required')) !!}
							</div>
						</div>
						
						<div class="form-group row">
							<label for="colFormLabel" class="col-md-4 col-form-label">Is Lunch:</label>
							<div class="col-md-8">
							{!! Form::checkbox('islunch',1,null, array('class' => 'form-control')) !!}
							</div>
						</div>
						
						
						
					</div>
				</div>
				<div class="row">
			
					<div class="col-md-12">
						<div class="form-group row">
							<div class="col-md-6 offset-md-4">
								<button type="submit" class="btn btn-primary btn-w140">Submit</button>
								<a href="{{route('admin.listClass')}}" class="btn btn-danger">Back</a>
						   </div>
						 </div>
					</div>
				</div>
	
			{!! Form::close() !!}  
				  
			</div>
		  
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>  
<script type="text/javascript">

    $('.timepicker').datetimepicker({

        format: 'HH:mm:ss'

    }); 

</script> 
@endsection