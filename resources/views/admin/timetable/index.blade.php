@extends('layouts.admin.app')

@section('content')
<section class="main-section">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-sm-12">
        <div class="card card-common mb-3">
          <div class="card-header">
            <span class="topic-heading">Time Table</span>
            <div class="float-right">
              <a type="button" class="btn btn-sm btn-success" href="{{route('admin.timetableimport')}}">
                <svg class="icon icon-font16 icon-mmtop-3 mr-1"><use xlink:href="{{asset('images/icons.svg#icon_adduser')}}"></use></svg> Import Time Table
              </a>
            </div>
          </div>
          <div class="card-body pt-3">
            <div class="row justify-content-center">
              <div class="col-md-4 col-lg-3 text-md-left text-center mb-1">
                <span data-dtlist="#teacherlist" class="mb-1">
                  <div class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                </span>
              </div>
              <div class="col-md-8 col-lg-9 text-md-right text-center mb-1">
                <span data-dtfilter="#teacherlist" class="mb-1">
                  <div class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                </span>
              </div>
              <div class="col-sm-12">
          <table id="teacherlist" class="table table-sm table-bordered display" style="width:100%" data-page-length="25" data-order="[[ 2, &quot;asc&quot; ]]" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
            <thead>
              <tr>
                <th>#</th>
                <th>Day</th>
                <th>Class</th>
                <th>Section</th>
                <th>Subject</th>
                <th>Teacher</th>
                <th>Start Time</th>
                <th>End Time</th>
              </tr>
            </thead>
            
          <tbody>
           @if(count($timetables)>0)
              @php $i=0; @endphp
                @foreach($timetables as $timetable)
                  <tr>
                    <td>{{++$i}}</td>
                    <td>{{$timetable->class_day}}</td>
                    <td>{{$timetable->studentClass->class_name}}</td>
                    <td>{{$timetable->studentClass->section_name}}</td>
                    <td>{{$timetable->studentSubject->subject_name}}</td>
                    <td>{{$timetable->first_name }} {{  $timetable->last_name}}</td>
                    <td>{{$timetable->from_timing}}</td>
                    <td>{{$timetable->to_timing}}</td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</section>
<script type="text/javascript">
$(document).ready(function() {
  $('#teacherlist').DataTable({
    initComplete: function(settings, json) {
      $('[data-dtlist="#'+settings.nTable.id+'"').html($('#'+settings.nTable.id+'_length').find("label"));
      $('[data-dtfilter="#'+settings.nTable.id+'"').html($('#'+settings.nTable.id+'_filter').find("input[type=search]").attr('placeholder', $('#'+settings.nTable.id).attr('data-filterplaceholder')))
    }
  });
  $('.dateset').datepicker({
    dateFormat: "yy/mm/dd"
    // showAnim: "slide"
  })
});
</script>
@endsection