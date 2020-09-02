@extends('layouts.app')

@section('title', 'Report Stock Opname')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Report Stok Opname</div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-md-4">Company</label>
                    <div class="col-md-8">
                        <select name="company_id" id="company_id" class="form-control form-control-sm">
                            <option value="">Silahkan pilih</option>
                            @foreach ($companies as $company)
                            <option value="{{$company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-md-4">Warehouse</label>
                    <div class="col-md-8">
                        <select name="warehouse_id" id="warehouse_id" class="form-control form-control-sm">
                            <option value="">All</option>
                            @foreach ($warehouses as $warehouse)
                            <option value="{{$warehouse->id }}">{{ $warehouse->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-2">Kategori</label>
            <div class="col-md-4">
                <select name="category_id" id="category_id" class="form-control form-control-sm">
                    <option value="">All</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row ml-0">
            <button type="submit" id="btnFilterReport" class="offset-md-2 btn btn-secondary"><i
                    class="fa fa-search"></i> Search</button>
        </div>
        <br>
        <div class="table-responsive">
            <table class="table table-sm table-hover table-striped" style="width: 100%" id="tableReport">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Warehouse</th>
                        <th>Drug</th>
                        <th>Satuan</th>
                        <th>Keterangan</th>
                        <th>Qty</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function () {

        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });


        function loadData(company_id, warehouse_id,category_id) { 
            $('#tableReport').DataTable({
                dom: 'lBfrtip',
                processing: true,
                serverSide: true,
                responsive: true,  buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="far fa-file-excel"></i> Export Excel',
                        orientation: 'landscape',
                    }, {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf"></i> PDF',
                        orientation: 'landscape',
                        pageSize: 'LEGAL'
                    },{
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> Print',
                        orientation: 'landscape',
                        pageSize: 'LEGAL'
                    }
                ],
                lengthMenu: [[10, 25, 50,100, -1], [10, 25, 50, 100,"All"]],
                ajax: {
                    url:"{{ route('get.report') }}",
                    data:{company_id:company_id,warehouse_id:warehouse_id}
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'warehouse_name', name: 'warehouse_name'},
                    {data: 'drug_name', name: 'drug_name'},
                    {data: 'unit_name', name: 'unit_name'},
                    {data: 'description', name: 'description'},
                    {data: 'qty', name: 'qty'},
                ]
        });
        }

        
        $('#btnFilterReport').click(function(){
            let company_id = $('#company_id').val();
            let warehouse_id = $('#warehouse_id').val();
            let category_id = $('#category_id').val();
            if(company_id == "" && warehouse_id == ""){
                $('#company_id').focus();
            }else{
            $('#tableReport').DataTable().destroy();
                loadData(company_id,warehouse_id,category_id);
                console.log(company_id,warehouse_id,category_id);
            }
        });

    });
</script>
@endpush