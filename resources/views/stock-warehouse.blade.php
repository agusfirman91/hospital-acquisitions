@extends('layouts.app')
@push('style')
<style>
    /* .table {
        color: #000;
    }

    .table-bordered,
    .table-bordered td,
    .table-bordered th {
        border: 1px solid #000;
    } */
</style>
@endpush
@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Stock Warehouse</div>
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
            <button type="submit" id="btnFilter" class="offset-md-2 btn btn-primary">Search</button>
        </div>
        <input type="hidden" id="comName">
        <input type="hidden" id="wName">
        <input type="hidden" id="cName">
        <br>
        <div class="table-responsive">
            <table class="table table-sm table-bordered" style="width: 100%" id="tableStock">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama</th>
                        <th>Satuan</th>
                        <th>Keterangan</th>
                        <th>Stok Fisik</th>
                        <th>Stok Fisik Cek</th>
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
            let comName =$('#comName').val();
            let wName =$('#wName').val();
            let cName = $('#cName').val();
                $('#tableStock').DataTable({
                        dom: 'lBfrtip',  
                        paging: true,
                        autoWidth: true,
                        processing: true,
                        serverSide: true,
                        responsive: true,    
                        buttons: [
                            {
                                extend: 'print',
                                title:"Stock Warehouse",
                                text: '<i class="fa fa-print"></i> Print Count Stock',
                                orientation: 'landscape',
                                pageSize: 'LEGAL',
                                messageTop: function () {
                                    return "<b>Site</b>  :"+comName+"<br/><b>Gudang</b>  :"+wName+"<br/><b>Kategori</b> : "+cName;
                                },
                                customize: function ( win ) {
                                    $(win.document.body)
                                        .css( 'font-size', '10pt' );
                                    $(win.document.body).find( 'table' )
                                        .addClass( 'compact' )
                                        .css( 'font-size', 'inherit' )
                                        .appendTo( '#tableStock_wrapper .col-md-6:eq(0)' );;
                                }
                            }
                        ],
                        ajax: {
                            url:"{{ route('get.stock.warehouse') }}",
                            data:{company_id:company_id,warehouse_id:warehouse_id,category_id:category_id}
                        },
                        lengthMenu: [[10, 25, 50,100, -1], [10, 25, 50, 100,"All"]],
                        columns: [
                            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                            {data: 'drug_code', name: 'drug_code'},
                            {data: 'drug_name', name: 'drug_name'},
                            {data: 'unit_name', name: 'unit_name'},
                            {data: 'description', name: 'description'},
                            {data: 'stok_fisik',defaultContent:''},
                            {data: 'stok_fisik_cek', defaultContent:''},
                        ]
                });
        }

        $('#btnFilter').click(function(){
            let company_id = $('#company_id').val();
            let warehouse_id = $('#warehouse_id').val();
            let category_id = $('#category_id').val();
            // alert($("#warehouse_id option:selected" ).text());
            $('#wName').val($("#warehouse_id option:selected").text());
            $('#cName').val($("#category_id option:selected").text());
            $('#comName').val($("#company_id option:selected").text());
            if(company_id == "" && warehouse_id == ""){
                $('#company_id').focus();
            }else{
            $('#tableStock').DataTable().destroy();
                loadData(company_id,warehouse_id,category_id);
                // console.log(company_id,warehouse_id);
            }
        });


        
    });
</script>
@endpush