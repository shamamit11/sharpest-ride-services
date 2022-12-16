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
                                        <label class="form-label"> Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{old('name' , isset($row->name)? $row->name : '' )}}">
                                        <div class="error" id='error_name'></div>
                                    </div>

                                    <div class="mb-3 col-2">
                                        <label class="form-label"> Unit Price (USD)</label>
                                        <input type="text" class="form-control" name="price"
                                            value="{{old('price' , isset($row->price)? $row->price : '' )}}">
                                        <div class="error" id='error_price'></div>
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

    <script src="{{ asset('assets/admin/js/servicetypes/add.js') }}"></script>

    @endsection