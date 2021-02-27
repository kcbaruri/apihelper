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
                                <h3 class="page-title">{{ __('sidebar.districts') }}</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{ __('sidebar.districts') }}</a></li>
                                    <li class="breadcrumb-item active">{{ __('pages.update_district') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ __('pages.update_district') }}</h4>
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

                                    <form action="{{ route('admin.districts.update', $district->id) }}" method="post">
                                       
                                        {{ csrf_field() }}
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.tbl_name_column') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" value="<?php echo $district->name;?>" placeholder="Name" id="name" name="name" required="required">
                                            </div>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.tbl_description_column') }}</label>
                                            <div class="col-md-10">
                                            <textarea class="form-control" rows ="6" placeholder="Description" id="description" name="description"><?php echo $district->description;?></textarea>
                                            </div>

                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('sidebar.divisions') }}</label>
                                            <div class="col-md-10">
                                                <select name="division_id" class="form-control" required="required">
                                                <option value="">Select</option>
                                                @foreach ($divisions as $var)
                                                <option value="{{ $var->id }}" <?php if($var->id == $district->division_id) echo "selected=selected"; else echo "";?>>{{ $var->name }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.show_in_list') }}</label>
                                            <div class="col-md-10">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="status" class="radio" value="1" @if($district->status == 1 || empty($district->status)) checked @endif> Yes
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="status" class="radio" value="0" @if($district->status == 0) checked @endif> No
                                                    </label>
                                                </div>                                  
                                        
                                            </div>
                                        </div>     

                                        <div class="form-group mb-0">
                                        <button class="btn btn-primary" type="submit">{{ __('pages.update_button') }}</button>
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