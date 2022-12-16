@extends('admin.layout')
@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3>Manage Inventory</h3>
                                <nav class="navbar navbar-light">
                                    <a href="{{route('admin-inventories-add')}}" class="btn btn-primary my-2 my-sm-0 ms-1">Add</a>
                                </nav>
                            </div>
                            <div class="card-body">
                            @if($data->count() > 0)
                            <div class="table-responsive">
                                <table id="dtable" class="table table-striped table-hover" data-page-length='200'>
                                    <thead>
                                        <tr>
                                            <th scope="col" width="50" style="text-align:center">#</th>
                                            <th scope="col" width="100">Date</th>
                                            <th scope="col" width="220">Vehicle</th>
                                            <th scope="col" width="150">Type</th>
                                            <th scope="col" width="100">VIN</th>
                                            <th scope="col" width="100">Stock#</th>
                                            <th scope="col" width="130">From</th>
                                            <th scope="col" width="130">Buyer</th>
                                            <th scope="col" width="100">Paid Amount ($)</th>
                                            <th scope="col" width="100">Date Paid</th>
                                            <th scope="col" width="100">Pack</th>
                                            <th scope="col" width="100">Date Sold</th>
                                            <th scope="col" width="130">Sold To</th>
                                            <th scope="col" width="100">Amount ($)</th>
                                            <th scope="col" width="100">Title Status</th>
                                            <th scope="col" width="150">Cash / Finance</th>
                                            <th scope="col">Memo</th>
                                            <th scope="col" width="150" style="text-align:center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $row)
                                            <tr id="tr{{ $row->id }}" style="background-color: {{$row->status->color}}">
                                                <td style="text-align:center">{{ $count++ }}</td>
                                                <td>{{ $row->added_date }}</td>
                                                <td>{{ $row->year }} {{ (isset($row->make)) ? $row->make->name : '---' }} {{ (isset($row->model)) ? $row->model->name : '---' }}</td>
                                                <td>{{ (isset($row->vehicletype)) ? $row->vehicletype->name : '---' }}</td>
                                                <td>{{ $row->vin_no }}</td>
                                                <td>{{ $row->stock_no }}</td>
                                                <td>{{ (isset($row->supplier)) ? $row->supplier->name : '---'  }}</td>
                                                <td>{{ (isset($row->staff)) ? $row->staff->name : '---'  }}</td>
                                                <td>{{ $row->purchase_amount }}</td>
                                                <td>{{ $row->purchase_date }}</td>
                                                <td>{{ $row->pack_no }}</td>
                                                <td>{{ (isset($row->sell_date)) ? $row->sell_date : '---'  }}</td>
                                                <td>{{ (isset($row->customer)) ? $row->customer->name : '---'  }}</td>
                                                <td>{{ (isset($row->sell_amount)) ? $row->sell_amount : '---'  }}</td>
                                                <td>{{ (isset($row->title_status)) ? $row->title_status : '---'  }}</td>
                                                <td>{{ (isset($row->finance)) ? $row->finance->name : '---'  }}</td>
                                                <td>{!! $row->description !!}</td>
                                                <td style="text-align: center">
                                                    <a href="{{ route('admin-inventories-add', ['id='.$row->id]) }}" class="btn btn-sm btn-warning rounded-pill"><i
                                                        class="fas fa-pen"></i></a>
                                                        <button type="button" class="btn btn-sm btn-danger rounded-pill delete-row-btn" data-id="{{ $row->id }}"><span class="icon"><i class='fas fa-trash'></i></span></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                                <div class="alert alert-info" role="alert"> No data found. </div>
                            @endif
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
    <link rel="stylesheet" href="{{ asset('assets/libs/data-tables/css/datatables.min.css') }}">
    <script src="{{ asset('assets/libs/data-tables/js/datatables.min.js') }}"></script>

    <script>
        $('#dtable').DataTable({
            dom: 'Bfrtip',
            buttons: ['excelHtml5', 'csvHtml5'],
            ordering: false,
            scrollX: true
        });
    </script>
    
    <script>
    $(document).ready(function() {
        
        $('.delete-row-btn').click(function() {
            var id = $(this).data("id");
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
                        url: '{{ route("admin-inventories-delete")}}',
                        type: 'POST',
                        data: {
                            'id': id,
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function() {
                            $("#tr" + id).remove();
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
        });
    });
    </script>
    @endsection
