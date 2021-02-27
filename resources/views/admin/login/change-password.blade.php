@extends('admin.layouts.admin')

@section('content')

            <!-- Main Wrapper -->
        <div class="main-wrapper">
        
            
                @include('admin.layouts.topbar')
                @include('admin.layouts.sidebar')
            
            <!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
                
                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="page-title">Admin</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Change Password</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Change Password</h4>
                                </div>
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
                                <div class="card-body">
                                    <form action="{{ url()->route('admin.update-password') }}" method="post" onsubmit = "return(validate());">
                                        {{ csrf_field() }}
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">New Password</label>
                                            <div class="col-md-10">
                                                <input type="password" class="form-control" placeholder="New Password" id="new_password" name="new_password" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Confirm Password</label>
                                            <div class="col-md-10">
                                                <input type="password" class="form-control" placeholder="Confirm Password" id="confirm_password" name="confirm_password" value="">
                                            </div>
                                        </div>

                                        <div class="form-group mb-0">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                
                </div>          
            </div>
            <!-- /Main Wrapper -->
        
        </div>
        <!-- /Main Wrapper -->
@endsection

@section('script')
<script type="text/javascript">
function validate(){
    var new_password = document.getElementById('new_password').value;
    var confirm_password = document.getElementById('confirm_password').value;

    if(new_password != confirm_password){
    alert("Passwords are not same");
    return false;
    }

    if(new_password.length < 6)
    {
    alert("Password should be minimum 6 characters");
    return false;
    }
    

}
</script>
@endsection