@extends('layouts.admin.app')

@section('content')
<section class="main-section">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-sm-12">
        <div class="card card-common mb-3">
          <div class="card-header">
            <span class="topic-heading">Help Tickets</span>
            <div class="float-right">
              {{-- <a type="button" class="btn btn-sm btn-success" href="{{route('teacher.add')}}">
                <svg class="icon icon-font16 icon-mmtop-3 mr-1"><use xlink:href="{{asset('images/icons.svg#icon_adduser')}}"></use></svg> Add Teacher
              </a> --}}
            </div>
          </div>
          <div class="card-body pt-3">
            <div class="row justify-content-center">
              <div class="col-md-4 col-lg-3 text-md-left text-center mb-1">
                <span data-dtlist="#ticketlist" class="mb-1">
					<div class="spinner-border spinner-border-sm text-secondary" role="status"></div> 
                </span>
              </div>
              <div class="col-md-8 col-lg-9 text-md-right text-center mb-1">
                <span data-dtfilter="#ticketlist" class="mb-1">
                   <div class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                </span>
              </div>
              <div class="col-sm-12">
                <table id="ticketlist" class="table table-sm table-bordered display" data-page-length="100" data-order="[[0, &quot;desc&quot; ]]" style="width:100%" data-page-length="10"data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
                  <thead>
                    <tr>
                      <th>SNO</th>
                      <th>Teacher Name</th>
                      <th>Class</th>
                      <th>Section</th>
                      <th>Subject</th>
                      <th>Description</th>
                      <th>Class Join link</th>
                    </tr>
                  </thead>
                  <tbody id="ticketlist_tbody">
                    <tr>
						  <td>1</td>
						  <td>Mohd Faiz</td>
						  <td>8</td>
						  <td>A</td>
						  <td>Physics</td>
						  <td>Need help</td>
						  <td>http://www.elearning.com</td>
						</tr>
						<tr>
						  <td>2</td>
						  <td>Anjali Singh</td>
						  <td>7</td>
						  <td>B</td>
						  <td>Chemistry</td>
						  <td>Need help</td>
						  <td>http://www.elearning.com</td>
						</tr>
						<tr>
						  <td>3</td>
						  <td>Rinkoo Singh</td>
						  <td>6</td>
						  <td>C</td>
						  <td>Maths</td>
						  <td>Need help</td>
						  <td>http://www.elearning.com</td>
						</tr>
						<tr>
						  <td>4</td>
						  <td>Amit Kapoor</td>
						  <td>8</td>
						  <td>A</td>
						  <td>English</td>
						  <td>Need help</td>
						  <td>http://www.elearning.com</td>
						</tr>
						<tr>
						  <td>5</td>
						  <td>Raeesh Alam</td>
						  <td>7</td>
						  <td>B</td>
						  <td>Drawing</td>
						  <td>Need help</td>
						  <td>http://www.elearning.com</td>
						</tr>
						<tr>
						  <td>6</td>
						  <td>Helkon De</td>
						  <td>9</td>
						  <td>A</td>
						  <td>Maths</td>
						  <td>Need help</td>
						  <td>http://www.elearning.com</td>
						</tr>
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
  
  var tbl = $('#ticketlist').DataTable({
    initComplete: function(settings, json) {
      $('[data-dtlist="#'+settings.nTable.id+'"').html($('#'+settings.nTable.id+'_length').find("label"));
      $('[data-dtfilter="#'+settings.nTable.id+'"').html($('#'+settings.nTable.id+'_filter').find("input[type=search]").attr('placeholder', $('#'+settings.nTable.id).attr('data-filterplaceholder')))
    }
  });
  $('.dateset').datepicker({
    dateFormat: "yy/mm/dd"
    // showAnim: "slide"
  });
});

 
</script>
@endsection