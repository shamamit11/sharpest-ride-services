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
                                    
                                        <div class="mb-3 row">
                                            <div class="col-md-4">
                                                <label class="form-label">Inventory Date</label>
                                                <input type="text" class="form-control date" name="added_date" value="{{old('added_date' , isset($row->added_date)? $row->added_date : date('Y-m-d') )}}"  data-date-format="yyyy-mm-dd" data-date-autoclose="true" >
                                                <div class="error" id='error_added_date'></div>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Stock#</label>
                                                <input type="text" class="form-control" name="stock_no" value="{{old('stock_no' , isset($row->stock_no)? $row->stock_no : '' )}}">
                                                <div class="error" id='error_stock_no'></div>
                                            </div>
                                        </div>

                                        <div class="demo-code-preview" data-label="Vehicle Information">
                                            <div class="mb-3 row">
                                                <div class="col-md-4">
                                                    <label class="form-label"> Vehicle Make</label>
                                                    <select name="vehicle_make_id" id="vehicle_make_id" class="select2 form-control">
                                                        <option value="">Select Make</option>
                                                        @if ($makes->count() > 0)
                                                        @foreach($makes as $res)
                                                        <option value="{{ $res->id }}"  @if (@$row->vehicle_make_id ==
                                                            $res->id) selected @endif>{{$res->name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    <div class="error" id='error_vehicle_make_id'></div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-label"> Vehicle Model</label>
                                                    <select name="vehicle_model_id" id="vehicle_model_id" class="select2 form-control">
                                                        <option value="">Select Model</option>
                                                        @if ($models->count() > 0)
                                                        @foreach($models as $res)
                                                        <option value="{{ $res->id }}"  data-chained="{{ $res->vehicle_make_id }}" @if (@$row->vehicle_model_id ==
                                                            $res->id) selected @endif>{{$res->name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    <div class="error" id='error_vehicle_model_id'></div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-label">Year </label>
                                                    <input type="text" class="form-control" name="year" value="{{old('year' , isset($row->year)? $row->year : '' )}}">
                                                    <div class="error" id='error_year'></div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <div class="col-md-4">
                                                    <label class="form-label">Vehicle Type </label>
                                                    <select name="vehicle_type_id" class="select2 form-control">
                                                        <option value="">Select</option>
                                                        @if ($vehicletypes->count() > 0)
                                                        @foreach($vehicletypes as $res)
                                                        <option value="{{ $res->id }}"  @if (@$row->vehicle_type_id ==
                                                            $res->id) selected @endif>{{$res->name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    <div class="error" id='error_vehicle_type_id'></div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-label"> Vin#</label>
                                                    <input type="text" class="form-control" name="vin_no" value="{{old('vin_no' , isset($row->vin_no)? $row->vin_no : '' )}}">
                                                    <div class="error" id='error_vin_no'></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="demo-code-preview" data-label="Purchase Information">
                                            <div class="mb-3 row">
                                                <div class="col-sm-4">
                                                    <label class="form-label">Bought From / Supplier </label>
                                                    <select class="form-control select2" name="supplier_id" id="supplier_id">
                                                        <option value="">Select</option>
                                                        @foreach ($suppliers as $supplier )
                                                        <option value="{{ $supplier->id }}" @if(isset($row->supplier_id) && $row->supplier_id== $supplier->id) selected  @endif>
                                                        {{ $supplier->name }} </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="error" id='error_supplier_id'></div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <label class="form-label">Buyer / Staff </label>
                                                    <select class="select2 form-control" name="staff_id" id="staff_id">
                                                        <option value="">Select</option>
                                                        @foreach ($staffs as $staff )
                                                        <option value="{{ $staff->id }}" @if(isset($row->staff_id) && $row->staff_id== $staff->id) selected  @endif>
                                                        {{ $staff->name }} </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="error" id='error_staff_id'></div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <label class="form-label">Amount Paid (USD) </label>
                                                    <input type="text" class="form-control" name="purchase_amount" value="{{old('purchase_amount' , isset($row->purchase_amount)? $row->purchase_amount : '' )}}">
                                                    <div class="error" id='error_purchase_amount'></div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <div class="col-sm-4">
                                                    <label class="form-label">Payment Date </label>
                                                    <input type="text" class="form-control date" name="purchase_date" value="{{old('purchase_date' , isset($row->purchase_date)? $row->purchase_date : '' )}}"  data-date-format="yyyy-mm-dd" data-date-autoclose="true" >
                                                    <div class="error" id='error_purchase_date'></div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <label class="form-label"> Pack#</label>
                                                    <input type="text" class="form-control" name="pack_no" value="{{old('pack_no' , isset($row->pack_no)? $row->pack_no : '' )}}">
                                                    <div class="error" id='error_pack_no'></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="demo-code-preview" data-label="Sales Information">
                                            <div class="mb-3 row">
                                                <div class="col-sm-4">
                                                    <label class="form-label">Sold Date </label>
                                                    <input type="text" class="form-control date" name="sell_date" value="{{old('sell_date' , isset($row->sell_date)? $row->sell_date : '' )}}"  data-date-format="yyyy-mm-dd" data-date-autoclose="true" >
                                                    <div class="error" id='error_sell_date'></div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <label class="form-label">Sold to / Customer </label>
                                                    <select class="select2 form-control" name="customer_id" id="customer_id">
                                                        <option value="">Select</option>
                                                        @foreach ($customers as $customer )
                                                        <option value="{{ $customer->id }}" @if(isset($row->customer_id) && $row->customer_id== $customer->id) selected  @endif>
                                                        {{ $customer->name }} </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="error" id='error_customer_id'></div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <label class="form-label">Amount (USD) </label>
                                                    <input type="text" class="form-control" name="sell_amount" value="{{old('sell_amount' , isset($row->sell_amount)? $row->sell_amount : '' )}}">
                                                    <div class="error" id='error_sell_amount'></div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <div class="col-sm-4">
                                                    <label class="form-label">Cash / Finance </label>
                                                    <select class="select2 form-control" name="finance_id" id="finance_id">
                                                        <option value="">Select</option>
                                                        @foreach ($finances as $finance )
                                                        <option value="{{ $finance->id }}" @if(isset($row->finance_id) && $row->finance_id== $finance->id) selected  @endif>
                                                        {{ $finance->name }} </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="error" id='error_finance_id'></div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <label class="form-label"> Title / Status</label>
                                                    <input type="text" class="form-control" name="title_status" value="{{old('title_status' , isset($row->title_status)? $row->title_status : '' )}}">
                                                    <div class="error" id='error_title_status'></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3 mt-3">
                                            <label class="form-label">Memo</label>
                                            <textarea class="form-control" name="description" rows="8">{{old('description' , isset($row->description)? $row->description : '' )}}</textarea>
                                            <div class="error" id='error_description'></div>
                                        </div>

                                        <div class="mb-3 mt-3 col-3">
                                            <label class="form-label"> Status</label>
                                            <select class="select2 form-control" name="status_id" id="status_id">
                                                @foreach ($statuses as $status )
                                                <option value="{{ $status->id }}" @if(isset($row->status_id) && $row->status_id== $status->id) selected  @endif>
                                                {{ $status->name }} </option>
                                                @endforeach
                                            </select>
                                            <div class="error" id='error_status_id'></div>
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

    <link href="{{ asset('assets/libs/datepicker/datepicker.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/libs/datepicker/datepicker.js') }}"></script>

    <script>
        $().ready(function() {
            $(".date").datepicker();
        });
    </script>

    <script src="{{ asset('assets/admin/js/inventories/add.js') }}"></script>

    @endsection