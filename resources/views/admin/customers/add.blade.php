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

                                    <div class="mb-3 col-6">
                                        <label class="form-label"> Email</label>
                                        <input type="text" class="form-control" name="email"
                                            value="{{old('email' , isset($row->email)? $row->email : '' )}}">
                                        <div class="error" id='error_email'></div>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label class="form-label"> Phone</label>
                                        <input type="text" class="form-control" name="phone"
                                            value="{{old('phone' , isset($row->phone)? $row->phone : '' )}}">
                                        <div class="error" id='error_phone'></div>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label class="form-label"> Mobile</label>
                                        <input type="text" class="form-control" name="mobile"
                                            value="{{old('mobile' , isset($row->mobile)? $row->mobile : '' )}}">
                                        <div class="error" id='error_mobile'></div>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label class="form-label">How do you hear about us?</label>
                                        <select class="form-control" name="source">
                                            <option value="radio" @if(@$row->source == 'radio') selected @endif>Radio</option>
                                            <option value="tv" @if(@$row->source == 'tv') selected @endif>TV</option>
                                            <option value="localad" @if(@$row->source == 'localad') selected @endif>Local Advertisement</option>
                                            <option value="referral" @if(@$row->source == 'referral') selected @endif>Referral</option>
                                            <option value="searchengine" @if(@$row->source == 'searchengine') selected @endif>Search Engine</option>
                                        </select>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label class="form-label">Added By</label>
                                        <select name="staff_id" class="select2 form-control">
                                            <option value="">Select</option>
                                            @if ($staffs->count() > 0)
                                            @foreach($staffs as $staff)
                                             <option value="{{ $staff->id }}"  @if (@$row->staff_id ==
                                                $staff->id) selected @endif>{{$staff->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        <div class="error" id='error_staff_id'></div>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label class="form-label">Remarks</label>
                                        <textarea class="form-control" name="remarks" rows="8">{{old('remarks', isset($row->remarks)? $row->remarks : '' )}}</textarea>
                                    </div>

                                    <div class="mb-3 col-3">
                                        <label class="form-label">Order / Position</label>
                                        <input type="text" class="form-control" name="orders" value="{{old('orders' , isset($row->orders) ? $row->orders : $orders)}}">
                                    </div>

                                    <div class="mb-3">
                                    <label class="form-label">Status</label>
                                                <label class="switch">
                                                    <input type="checkbox" class="switch-input" name="status" value="1" {{ ((isset($row->
                status) && $row->status == 1) ||  !isset($row->status))? 'checked' : '' }} /> <span
                                                        class="switch-label" data-on="Active" data-off="Inactive"></span>
                                                    <span class="switch-handle"></span> </label>
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

    <script src="{{ asset('assets/admin/js/customers/add.js') }}"></script>

    @endsection