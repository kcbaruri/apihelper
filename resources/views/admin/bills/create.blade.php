@extends('layouts.master')

@section('breadcrumb')
    <x-breadcrumb header="Tenant {{isset($tenant) && $tenant->id ? 'edit': 'add'}}" :routes="['billmanager.index'=>'Bill', 'Generate bill']"/>
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form class="needs-validation" novalidate method="post" action="{{ route('billmanager.store') }}">
                            @csrf
                            <div class="card-body flat-form" id="dynamic-form">

                                <div class="row parent-block">
                                    <div class="col-md-12">
                                       
                                        <div class="col-md-10">
                                            <label for="tenant_id">Family Head</label>
                                            <select name="tenant_id" id="tenant_id" class="form-control">
                                                <option value="0" selected disabled>Please Select Tenant</option>
                                                <?php foreach ($familyHeads as $key=>$name): ?>
                                                <option value="{{$key}}">
                                                <?php  echo $name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <x-validation-error field="tenant_id"/>
                                        </div>

                                        <?php foreach ($billHeads as $billHead): ?>
                                            <div class="col-md-10">
                                            <label for="col_{{$billHead->id}}"><?php echo $billHead->name; ?></label>
                                            <input name="col_{{$billHead->id}}" type="text" class="form-control" id="col_{{$billHead->id}}">
                                            <x-validation-error field="col_{{$billHead->id}}"/>
                                             </div>

                                        <?php endforeach; ?>

                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right float-right">
                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
