@extends('admin.layout')
@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <form enctype="multipart/form-data" method="post" action="{{$action}}" id="form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    @csrf
                                    <input type="hidden" class="form-control" name="id"
                                        value="{{ isset($row->id)? $row->id : '' }}">

                                    <div class="mb-3 col-12">
                                        <label class="form-label">Customer Details</label>
                                        <select name="customer_id" class="select2 form-control">
                                            <option value="">Select Customer</option>
                                            @if ($customers->count() > 0)
                                            @foreach($customers as $cust)
                                                <option value="{{ $cust->id }}"  @if (@$row->customer_id ==
                                                $cust->id) selected @endif>{{$cust->code}} / {{$cust->name}} / Mobile#: {{$cust->mobile}} / Email: {{$cust->email}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        <div class="error" id='error_customer_id'></div>
                                    </div>

                                    <div class="mb-3 col-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label"> Vehicle Make</label>
                                                <select name="vehicle_make_id" id="vehicle_make_id" class="select2 form-control">
                                                    <option value="">Select Make</option>
                                                    @if ($vehicle_makes->count() > 0)
                                                    @foreach($vehicle_makes as $res)
                                                    <option value="{{ $res->id }}"  @if (@$row->vehicle_make_id ==
                                                        $res->id) selected @endif>{{$res->name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <div class="error" id='error_vehicle_make_id'></div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label"> Vehicle Model</label>
                                                <select name="vehicle_model_id" id="vehicle_model_id" class="select2 form-control">
                                                    <option value="">Select Model</option>
                                                    @if ($vehicle_models->count() > 0)
                                                    @foreach($vehicle_models as $res)
                                                    <option value="{{ $res->id }}"  data-chained="{{ $res->vehicle_make_id }}" @if (@$row->vehicle_model_id ==
                                                        $res->id) selected @endif>{{$res->name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <div class="error" id='error_vehicle_model_id'></div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label"> Vehicle Year</label>
                                                <select name="vehicle_year_id" id="vehicle_year_id" class="select2 form-control">
                                                    <option value="">Select Year</option>
                                                    @if ($vehicle_years->count() > 0)
                                                    @foreach($vehicle_years as $res)
                                                    <option value="{{ $res->id }}"  data-chained="{{ $res->vehicle_model_id }}" @if (@$row->vehicle_year_id ==
                                                        $res->id) selected @endif>{{$res->name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <div class="error" id='error_vehicle_year_id'></div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label"> Vehicle Engine</label>
                                                <select name="vehicle_engine_id" id="vehicle_engine_id" class="select2 form-control">
                                                    <option value="">Select Engine</option>
                                                    @if ($vehicle_engines->count() > 0)
                                                    @foreach($vehicle_engines as $res)
                                                    <option value="{{ $res->id }}"  data-chained="{{ $res->vehicle_year_id }}" @if (@$row->vehicle_engine_id ==
                                                        $res->id) selected @endif>{{$res->name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <div class="error" id='error_vehicle_engine_id'></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label">Vehicle Type</label>
                                                <select name="vehicle_type_id" class="select2 form-control">
                                                    <option value="">Select</option>
                                                    @if ($vehicle_types->count() > 0)
                                                    @foreach($vehicle_types as $res)
                                                    <option value="{{ $res->id }}"  @if (@$row->vehicle_type_id ==
                                                        $res->id) selected @endif>{{$res->name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <div class="error" id='error_vehicle_type_id'></div>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label">VIN #</label>
                                                <input type="text" class="form-control" name="vin_no"
                                            value="{{old('vin_no' , isset($row->vin_no)? $row->vin_no : '' )}}">
                                                <div class="error" id='error_vin_no'></div>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label">Odometer Reading</label>
                                                <input type="text" class="form-control" name="odometer_reading"
                                            value="{{old('odometer_reading' , isset($row->odometer_reading)? $row->odometer_reading : '' )}}">
                                                <div class="error" id='error_odometer_reading'></div>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label">License Plate#</label>
                                                <input type="text" class="form-control" name="license_plate"
                                            value="{{old('license_plate' , isset($row->license_plate)? $row->license_plate : '' )}}">
                                                <div class="error" id='error_license_plate'></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <h4 class="card-header">Service Types</h4>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @foreach($allservices as $service)
                                                @if(count($service['service_types']) > 0)
                                                    <div class="card-custom-header">
                                                        {{ $service['service_name'] }}
                                                    </div>
                                                    @foreach($service['service_types'] as $type)
                                                    <div class="card-custom-body">
                                                        <div class="row">
                                                            <div class="col-md-6 mt-2 mb-2">
                                                                <input type="hidden" class="form-control" name="service_id[]" value="{{ $type->service_id }}" readonly>
                                                                <input type="hidden" class="form-control" name="service_type_id[]" value="{{ $type->id }}" readonly>
                                                                <input type="text" class="form-control" value="{{ $type->name }} &nbsp; / &nbsp; Unit Price: ${{ $type->price }}" readonly>
                                                            </div>

                                                            <div class="col-md-2 mt-2 mb-2">
                                                                <input type="number" class="form-control" name="qty[]" value="" placeholder="Qty">
                                                            </div>

                                                            <div class="col-md-4 mt-2 mb-2">
                                                            <select name="part_type_id[]" class="select2 form-control">
                                                                <option value="">Select Part Types</option>
                                                                @if ($part_types->count() > 0)
                                                                @foreach($part_types as $res)
                                                                <option value="{{ $res->id }}"  @if (@$row->part_type_id ==
                                                                    $res->id) selected @endif>{{$res->name}}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3 col-12">
                                        <label class="form-label">Remarks</label>
                                        <textarea class="form-control" name="remarks" rows="8">{{old('remarks', isset($row->remarks)? $row->remarks : '' )}}</textarea>
                                        <div class="error" id='error_remarks'></div>
                                    </div>

                                    <div class="mb-3 col-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Assigned To</label>
                                                <select name="staff_id" class="select2 form-control">
                                                    <option value="">Select Staff</option>
                                                    @if ($staffs->count() > 0)
                                                    @foreach($staffs as $res)
                                                    <option value="{{ $res->id }}"  @if (@$row->staff_id ==
                                                        $res->id) selected @endif>{{$res->name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <div class="error" id='error_staff_id'></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Status</label>
                                                <select name="status_id" class="select2 form-control">
                                                    <option value="">Select Job Status</option>
                                                    @if ($statuses->count() > 0)
                                                    @foreach($statuses as $res)
                                                    <option value="{{ $res->id }}"  @if (@$row->status_id ==
                                                        $res->id) selected @endif>{{$res->name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <div class="error" id='error_status_id'></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary  btn-loading">Submit</button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @include('admin.includes.footer')
        </div>
    </div>
@endsection
@section('footer-scripts')
<script src="{{ asset('assets/libs/chained/jquery.chained.min.js') }}"></script> 
<script src="{{ asset('assets/admin/js/repairorders/add.js') }}"></script>

@endsection