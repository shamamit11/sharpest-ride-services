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
                                <h3>Service Types Management</h3>
                                <nav class="navbar navbar-light">
                                    <form method="get" class="d-flex">
                                        <div class="input-group"> @csrf
                                            <input type="text" name="q" value="{{ @$q }}" class="form-control"
                                                placeholder="Search">
                                            <button class="btn btn-success my-2 my-sm-0" type="submit"><i
                                                    class="align-middle" data-feather="search"></i></button>
                                        </div>
                                    </form>
                                    <a href="{{route('admin-servicetypes-addmultiple')}}" class="btn btn-primary my-2 my-sm-0 ms-1">
                                        Add Multiple Data</a>
                                    <a href="{{route('admin-servicetypes-addsingle')}}" class="btn btn-primary my-2 my-sm-0 ms-1">
                                        Add Single Data</a>
                                </nav>
                            </div>
                            <div class="card-body">
                                @if($servicetypes->count() > 0)
                                <table class="table">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="50">#</th>
                                            <th width="250">Vehicle</th>
                                            <th>Service Type</th>
                                            <th width="250">Service</th>
                                            <th style="text-align:left" width="200">Unit Price</th>
                                            <th style="text-align:center" width="120">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($servicetypes as $row)
                                        <tr id="tr{{ $row->id }}">
                                            <td>{{ $count++ }}</td>
                                            <td>{{ @$row->make->name }} / {{ @$row->model->name }}</td>
                                            <td>{{ @@$row->name }}</td>
                                            <td>{{ @@$row->service->name }}</td>
                                            <td style="text-align:left">${{ @$row->price }}</td>
                                            <td style="text-align:center"><a
                                                    href="{{route('admin-servicetypes-edit', ['id='.$row->id])}}"
                                                    class="btn btn-sm btn-warning rounded-pill"><i
                                                        class="fas fa-pen"></i></a>
                                                <button type="button"
                                                    class="btn btn-sm btn-danger rounded-pill delete-row-btn"
                                                    data-id="{{ $row->id }}"><span class="icon"><i
                                                            class='fas fa-trash'></i></span></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        Showing {{ $from_data }} to {{ $to_data }} of {{ $total_data }}
                                        records.
                                    </div>
                                    <div class="col-md-8 col-sm-6 col-xs-12">
                                        <div class="float-end"> {{$servicetypes->links('pagination::bootstrap-4')}} </div>
                                    </div>
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
                        url: '{{ route("admin-servicetypes-delete")}}',
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
