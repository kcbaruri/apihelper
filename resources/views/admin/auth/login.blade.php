@extends('admin.layouts.admin')

@section('content')
<!-- Main Wrapper -->
        
        <div class="main-wrapper login-body">
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-card alert-danger" role="alert">
            <strong>{{$error}} </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            @endforeach
            @endif
            <div class="login-wrapper">
                    <div class="loginbox">
                        <div class="login-right">
                           
                            <div class="login-right-wrap">
                            <div style="display: flex;justify-content: center; margin-bottom:5px;"><img width="80px;" src="{{ asset('samajikadmin/img/logo.png')}}" alt="Logo"></div>
                            <h5 class="text-primary text-center">নাজমহল ভবন, উত্তরা , ঢাকা -  তে প্রবেশ করুন</h5>
                                <!-- Form -->
                                <form action="{{ route('admin.login') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input class="form-control" name="email" type="text" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" name="password" type="password" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block" type="submit">Login</button>
                                    </div>
                                </form>                                
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <!-- /Main Wrapper -->
@endsection