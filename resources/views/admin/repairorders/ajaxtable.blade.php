<div class="row">
    <div class="col-12">
        <div class="card">
            <h4 class="card-header">Service Types</h4>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive" style="max-height:600px; overflow:auto">
                            <table id="serviceTable" width="100%" class="table table-bordered">
                            <tr>
                                <th width="2%"></th>
                                <th width="65%">Service Name</th>
                                <th width="8%" style="text-align:center">Qty</th>
                                <th width="25%">Part Types</th>
                            </tr>
                            @foreach($service_types as $res)
                            <tr style="vertical-align:middle">
                                <td><input type="checkbox" name="chk"/></td>
                                <td>
                                    <input name="service_id[]" type="hidden" value="{{ $res->service_id }}" class="form-control"/>
                                    <input name="service_type_id[]" type="hidden" value="{{ $res->id }}" class="form-control"/>
                                    <input name="price[]" type="hidden" value="{{ $res->price }}" class="form-control"/>
                                    <input type="text" value="{{ $res->service->name }} / {{ $res->name }} / Unit Price: ${{ $res->price }}" class="form-control" readonly/>
                                </td>
                                <td>
                                    <input name="qty[]" type="text" class="form-control" style="text-align:center"/>
                                </td>
                                <td>
                                    <select name="part_type_id[]" class="select2 form-control">
                                        <option value="">Select Part Types</option>
                                        @if ($part_types->count() > 0)
                                        @foreach($part_types as $res)
                                        <option value="{{ $res->id }}"  @if (@$row->part_type_id ==
                                            $res->id) selected @endif>{{$res->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </td>
                            </tr>
                            @endforeach
                            </table>
                        </div>
                        <button type="button" class="btn btn-sm btn-danger" onclick="deleteRow('serviceTable')"/>
                        <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.select2').select2();
    })
</script>