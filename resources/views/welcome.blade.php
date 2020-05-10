@extends('layouts.app')
@section('content')
<section class="login-section">
  <div class="container min-height">
    <div class="row justify-content-center min-height align-items-center">
      <div class="col-sm-10 col-md-8 col-lg-6 col-xl-4">
        <div class="login-form">         
          <h1>E-Learning</h1>
         <!-- <ul class="nav nav-pills mb-4 justify-content-center" role="tablist">
            <li class="nav-item">
              <a class="nav-link text-white border-0 btn-shadow active" data-toggle="pill" href="#teacherBox">
                <svg class="icon icon-3x mr-2 mmb-2"><use xlink:href="{{asset('images/icons.svg#icon_teacher')}}"></use></svg> Teacher
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white border-0 btn-shadow" data-toggle="pill" href="#supportBox">
                <svg class="icon icon-1x mr-2 mmb-1"><use xlink:href="{{asset('images/icons.svg#icon_support')}}"></use></svg> Support
              </a>
            </li>
          </ul> -->
          <div class="tab-content">
            <div class="tab-pane fade " id="teacherBox">
              <form method="POST" action="{{ route('teacher.login') }}">
              @csrf
                <div class="form-group">
                  <input id="login_pin" type="password" class="form-control form-control-lg" name="login_pin" placeholder="Enter PIN" required>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-lg btn-primary btn-block">
                    {{ __('Login') }}
                </div>
              </form>
            </div>
          
            <div class="tab-pane fade show active" id="supportBox">
              <form method="POST" class="loginbox-section" action="{{ route('admin.login.post') }}">
                @csrf
                <div class="form-group mb-4">
                        <button type="submit" class="btn btn-lg btn-primary btn-block">
                            {{ __('Admin Login') }}
                        </button>
                </div>
              </form>

              <form method="POST" class="loginbox-section" action="{{ route('teacher.login.post') }}">
              @csrf 
              <div class="form-group mb-4">
                        <button type="submit" class="btn btn-lg btn-primary btn-block">
                            {{ __('Teacher Login') }}
                        </button>
                </div>
              </form>
              
              <form method="POST" class="loginbox-section" action="#">
              @csrf
                <div class="form-group mb-4">
                        <button type="submit" class="btn btn-lg btn-primary btn-block">
                            {{ __('Student Login') }}
                        </button>
                </div>
              </form>

            </div>


          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection