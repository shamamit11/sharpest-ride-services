@extends('admin.layout')
@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form enctype="multipart/form-data" method="post" action="{{$action}}" id="form">
                                    @csrf
                                    <input type="hidden" class="form-control" name="id"
                                        value="{{ isset($row->id)? $row->id : '' }}">
                                    
                                        @if(isset($row->id))
                                        <div>
                                            <div class="mb-3 col-12">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label class="form-label"> Vehicle Make</label>
                                                        <select name="vehicle_make_id" class="form-control" readonly >
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
                                                        <select name="vehicle_model_id" class="form-control" readonly>
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
                                                </div>
                                            </div>

                                            <div class="mb-3 col-6">
                                                <label class="form-label">Service</label>
                                                <select name="service_id" class="form-control" readonly>
                                                    <option value="">Select</option>
                                                    @if ($services->count() > 0)
                                                    @foreach($services as $service)
                                                    <option value="{{ $service->id }}"  @if (@$row->service_id ==
                                                        $service->id) selected @endif>{{$service->name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <div class="error" id='error_service_id'></div>
                                            </div>

                                            <div class="mb-3 col-6">
                                                <label class="form-label"> Name</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{old('name' , isset($row->name)? $row->name : '' )}}" readonly>
                                                <div class="error" id='error_name'></div>
                                            </div>
                                        </div>
                                        @else

                                            <div>
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
                                                    </div>
                                                </div>

                                                <div class="mb-3 col-6">
                                                    <label class="form-label">Service</label>
                                                    <select name="service_id" class="select2 form-control">
                                                        <option value="">Select</option>
                                                        @if ($services->count() > 0)
                                                        @foreach($services as $service)
                                                        <option value="{{ $service->id }}"  @if (@$row->service_id ==
                                                            $service->id) selected @endif>{{$service->name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    <div class="error" id='error_service_id'></div>
                                                </div>

                                                <div class="mb-3 col-6">
                                                    <label class="form-label"> Name</label>
                                                    <input type="text" class="form-control" name="name"
                                                        value="{{old('name' , isset($row->name)? $row->name : '' )}}">
                                                    <div class="error" id='error_name'></div>
                                                </div>
                                            </div>

                                        @endif

                                        <div class="mb-3 col-2">
                                            <label class="form-label"> Unit Price (USD)</label>
                                            <input type="text" class="form-control" name="price"
                                                value="{{old('price' , isset($row->price)? $row->price : '' )}}">
                                            <div class="error" id='error_price'></div>
                                        </div>

                                        <button type="submit" class="btn btn-primary  btn-loading">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.includes.footer')
    </div>
    @endsection
    @section('footer-scripts')
    <script src="{{ asset('assets/libs/chained/jquery.chained.min.js') }}"></script> 
    <script src="{{ asset('assets/admin/js/servicetypes/add.js') }}"></script>

    @endsection