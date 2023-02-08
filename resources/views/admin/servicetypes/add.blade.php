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
                                        <label class="form-label"> Service Type</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{old('name' , isset($row->name)? $row->name : '' )}}">
                                        <div class="error" id='error_name'></div>
                                    </div>

                                    <div class="mb-3 col-12">

                                        <div class="table-responsive" style="max-height:600px; overflow:auto">
                                            <table id="vehicleTable" width="100%" class="table table-bordered">
                                            <tr>
                                                <th width="85%">Vehicle Make / Model</th>
                                                <th width="15%" style="text-align:center">Unit Price</th>
                                            </tr>
                                            @foreach($vehicle_models as $res)
                                            <tr style="vertical-align:middle">
                                                <td>
                                                    <input name="vehicle_make_id[]" type="hidden" value="{{ $res->make->id }}" class="form-control"/>
                                                    <input name="vehicle_model_id[]" type="hidden" value="{{ $res->id }}" class="form-control"/>
                                                    <input type="text" value="{{ $res->make->name }} / {{ $res->name }}" class="form-control" readonly/>
                                                </td>
                                                <td>
                                                    <input name="price[]" type="text" class="form-control" style="text-align:center"/>
                                                </td>
                                            </tr>
                                            @endforeach
                                            </table>
                                        </div>

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