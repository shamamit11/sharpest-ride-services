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

                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label"> App Name</label>
                                                <input type="text" class="form-control" name="app_name"
                                                    value="{{old('app_name' , isset($row->app_name)? $row->app_name : '' )}}">
                                                <div class="error" id='error_app_name'></div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label"> Company Name</label>
                                                <input type="text" class="form-control" name="company_name"
                                                    value="{{old('company_name' , isset($row->company_name)? $row->company_name : '' )}}">
                                                <div class="error" id='error_company_name'></div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label"> Company Registration# / FEIN#</label>
                                                <input type="text" class="form-control" name="company_registration_no"
                                                    value="{{old('company_registration_no' , isset($row->company_registration_no)? $row->company_registration_no : '' )}}">
                                                <div class="error" id='error_company_registration_no'></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label"> Address 01</label>
                                                <input type="text" class="form-control" name="company_address1"
                                                    value="{{old('company_address1' , isset($row->company_address1)? $row->company_address1 : '' )}}">
                                                <div class="error" id='error_company_address1'></div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label"> Address 02</label>
                                                <input type="text" class="form-control" name="company_address2"
                                                    value="{{old('company_address2' , isset($row->company_address2)? $row->company_address2 : '' )}}">
                                                <div class="error" id='error_company_address2'></div>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label"> City</label>
                                                <input type="text" class="form-control" name="company_city"
                                                    value="{{old('company_city' , isset($row->company_city)? $row->company_city : '' )}}">
                                                <div class="error" id='error_company_city'></div>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label"> State</label>
                                                <input type="text" class="form-control" name="company_state"
                                                    value="{{old('company_state' , isset($row->company_state)? $row->company_state : '' )}}">
                                                <div class="error" id='error_company_state'></div>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label"> Zip</label>
                                                <input type="text" class="form-control" name="company_zip"
                                                    value="{{old('company_zip' , isset($row->company_zip)? $row->company_zip : '' )}}">
                                                <div class="error" id='error_company_zip'></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label"> Company Phone</label>
                                                <input type="text" class="form-control" name="company_phone"
                                                    value="{{old('company_phone' , isset($row->company_phone)? $row->company_phone : '' )}}">
                                                <div class="error" id='error_company_phone'></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label"> Company Email</label>
                                                <input type="text" class="form-control" name="company_email"
                                                    value="{{old('company_email' , isset($row->company_email)? $row->company_email : '' )}}">
                                                <div class="error" id='error_company_email'></div>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label"> Logo Image</label>
                                                <br>
                                                <input type="file" name="file_image" onchange="encodeImgtoBase64(this)">
                                                <input name="logo" type="hidden" id="logo" />
                                                <div>
                                                    @if($row && $row->logo)
                                                    <div style="margin:5px 0 0 0;"> <img
                                                            src="{{ asset('/storage/settings/'.$row->logo)}}" id="displayImg"
                                                            width="200">
                                                    </div>
                                                    @else
                                                    <div style="margin:5px 0 0 0;"> <img
                                                            src="{{ asset('/assets/admin/images/browser.png')}}" id="displayImg"
                                                            width="200">
                                                    </div>
                                                    @endif
                                                    <div style="margin:5px 0 0 0;"
                                                        class="{{ ($row && $row->logo) ? 'd-block' : 'd-none' }}"
                                                        id='btn_image_delete'>
                                                        <button type="button" class="btn btn-xs btn-danger"
                                                            Onclick="confirmDelete('logo')">Delete Image</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label"> Favicon Image</label>
                                                <br>
                                                <input type="file" name="file_image" onchange="encodeFavImgtoBase64(this)">
                                                <input name="favicon" type="hidden" id="favicon" />
                                                <div>
                                                    @if($row && $row->favicon)
                                                    <div style="margin:5px 0 0 0;"> <img
                                                            src="{{ asset('/storage/settings/'.$row->favicon)}}" id="displayFavImg"
                                                            width="50">
                                                    </div>
                                                    @else
                                                    <div style="margin:5px 0 0 0;"> <img
                                                            src="{{ asset('/assets/admin/images/browser.png')}}" id="displayFavImg"
                                                            width="50">
                                                    </div>
                                                    @endif
                                                    <div style="margin:5px 0 0 0;"
                                                        class="{{ ($row && $row->favicon) ? 'd-block' : 'd-none' }}"
                                                        id='btn_image_delete1'>
                                                        <button type="button" class="btn btn-xs btn-danger"
                                                            Onclick="confirmDelete1('favicon')">Delete Image</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-3">
                                        <label class="form-label"> Sales Tax(%)</label>
                                        <input type="text" class="form-control" name="sales_tax"
                                            value="{{old('sales_tax' , isset($row->sales_tax)? $row->sales_tax : '' )}}">
                                        <div class="error" id='error_sales_tax'></div>
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

    <script src="{{ asset('assets/admin/js/appsettings/add.js') }}"></script>
    <script>
    $().ready(function() {
        //to delete
        confirmDelete = function(field_name) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                reverseButtons: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route("admin-appsettings-imagedelete")}}',
                        type: 'POST',
                        data: {
                            'id': '{{ @$row->id }}',
                            'field_name': field_name,
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function() {
                            $("#displayImg").attr("src",
                                "{{ asset('/assets/admin/images/browser.png')}}");
                            $("#btn_image_delete").addClass('d-none');
                            $("#logo").val('');
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Your data has been deleted.',
                                'success'
                            );
                        }
                    });
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        '',
                        'error'
                    )
                }
            })
        }

        confirmDelete1 = function(field_name) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                reverseButtons: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route("admin-appsettings-imagedelete")}}',
                        type: 'POST',
                        data: {
                            'id': '{{ @$row->id }}',
                            'field_name': field_name,
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function() {
                            $("#displayFavImg").attr("src",
                                "{{ asset('/assets/admin/images/browser.png')}}");
                            $("#btn_image_delete1").addClass('d-none');
                            $("#favicon").val('');
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Your data has been deleted.',
                                'success'
                            );
                        }
                    });
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        '',
                        'error'
                    )
                }
            })
        }

    });
    </script>
    @endsection