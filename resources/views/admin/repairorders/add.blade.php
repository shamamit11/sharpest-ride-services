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
                                                <input type="text" class="form-control" name="year" value="{{old('year' , isset($row->year)? $row->year : '' )}}">
                                                <div class="error" id='error_year'></div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label"> Vehicle Engine</label>
                                                <input type="text" class="form-control" name="engine" value="{{old('engine' , isset($row->engine)? $row->engine : '' )}}">
                                                <div class="error" id='error_engine'></div>
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

                    <div id="ajaxtable">
                        <div class='alert alert-info' role='alert'> Select Vehicle Model First. </div>
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
<script>
    $(document).ready(function(){
        $("#vehicle_model_id").change(function(){
            var vehicle_model_id = $(this).val();

            if(vehicle_model_id) {
                $.ajax({
                    url: "{{ route('admin-repairorders-ajax-table') }}",
                    type: 'POST',
                    data: {
                        'vehicle_model_id': vehicle_model_id,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        if(res) {
                            $("#ajaxtable").html(res);
                        }
                    }
                });
            } else {
                $("#ajaxtable").html("<div class='alert alert-info' role='alert'> Select Vehicle Model First. </div>");
            }
        });
    });
</script>

@endsection