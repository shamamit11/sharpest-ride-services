@php 
    use App\Services\Admin\RepairOrderService as ROService;
@endphp
@extends('admin.layout')
@section('content')
    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="panel-body">
                                <div class="clearfix">
                                    <div class="float-start">
                                        <img src="{{ asset('/storage/settings/'.$app_settings->logo)}}" width="250">
                                    </div>
                                    <div class="float-end">
                                        <h4>Invoice # <br>
                                            <strong>{{ $row->code }}</strong>
                                        </h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="float-start mt-3">
                                            <address>
                                                <strong>{{ $customer->name }}</strong><br>
                                                <abbr title="Phone">P:</abbr> {{ $customer->mobile }} <br>
                                                <abbr title="Email">E:</abbr> {{ $customer->email }}
                                            </address>
                                        </div>
                                        <div class="float-end mt-3">
                                            <p><strong>Order Date: </strong> {{ $row->created_at }}</p>
                                            <p class="m-t-10"><strong>Order Status: &nbsp; </strong> 
                                                <span class="badge" style="background-color: {{ $row->status->color }}; padding: 7px">{{ $row->status->name }}</span>
                                            </p>
                                        </div>
                                    </div><!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table mt-4">
                                                <thead>
                                                <tr><th width="50">#</th>
                                                    <th width="200">Service</th>
                                                    <th>Service Type</th>
                                                    <th width="100" style="text-align:center">Quantity</th>
                                                    <th width="150" style="text-align:right">Unit Cost</th>
                                                    <th width="150" style="text-align:right">Total</th>
                                                </tr></thead>
                                                <tbody>
                                                    @php 
                                                        $count = 1;
                                                        $sub_total = 0;
                                                    @endphp
                                                    @foreach($repair_services as $res)
                                                        <tr>
                                                            <td>{{ $count }}</td>
                                                            <td> {{ $res->service->name }}</td>
                                                            <td> {{ $res->service_type->name }}</td>
                                                            <td style="text-align:center">{{ $res->qty }}</td>
                                                            <td style="text-align:right">${{ $res->service_type->price }}</td>
                                                            <td style="text-align:right">${{ $res->price }}</td>
                                                        </tr>
                                                        @php 
                                                            $count++;
                                                            $sub_total = $sub_total + $res->price;
                                                        @endphp
                                                        
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-6">
                                        <div class="clearfix mt-4">
                                            <h5 class="small text-dark fw-normal">PAYMENT TERMS AND POLICIES</h5>

                                            <small>
                                                All accounts are to be paid within 7 days from receipt of
                                                invoice. To be paid by cheque or credit card or direct payment
                                                online. If account is not paid within 7 days the credits details
                                                supplied as confirmation of work undertaken will be charged the
                                                agreed quoted fee noted above.
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-6 offset-xl-3">
                                        <p class="text-end"><b>Sub-total:</b> ${{ number_format((float)$sub_total, 2, '.', '') }}</p>
                                        @php 
                                            $tax = $sub_total * $app_settings->sales_tax / 100;
                                        @endphp
                                        <p class="text-end">Tax ({{ $app_settings->sales_tax }}%): ${{ number_format((float)$tax, 2, '.', '') }}</p>
                                        <hr>
                                        <h3 class="text-end">USD {{ number_format((float)$sub_total + $tax, 2, '.', '') }}</h3>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-print-none">
                                    <div class="float-end">
                                        <a href="javascript:window.print()" class="btn btn-dark waves-effect waves-light"><i class="fa fa-print"></i> &nbsp; Print</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

            </div>
            <!-- end row -->        
            
            </div> <!-- container-fluid -->

        </div>
    </div>
@endsection
@section('footer-scripts')
<script src="{{ asset('assets/libs/chained/jquery.chained.min.js') }}"></script> 
<script src="{{ asset('assets/admin/js/repairorders/add.js') }}"></script>

@endsection