@extends('layouts.app')

@push('style')
<style>
    .spinner {
        position: absolute;
        top: 75%;
        left: 60%;
        margin-left: -50px;
        margin-top: -50px;
        z-index: 10;
    }
</style>
@endpush
@section('content')

<div class="spinner-border text-secondary spinner">
    <span class="sr-only">Loading...</span>
</div>


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
            <button type="submit" id="btnFilter" class="offset-md-2 btn btn-secondary">
                <i class="fas fa-search" data-feather="search"></i> Search</button>
        </div>


        <br>
        <form action="{{ route('stock.opname.post')}}" method="POST">
            @csrf
            <div class="table-responsive">
                <table class="table table-sm table-hover table-striped" style="width: 100%" id="tableStockOpname">
                    <thead>
                        <tr>
                            <th width='20px'>#ID </th>
                            <th>Nama Barang</th>
                            <th>Gudang</th>
                            <th>Satuan</th>
                            <th>Exp Date</th>
                            <th width='50px'>Qty</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <br>
                <button type="submit" class="btn btn-danger" id="btnSave">Save Current Page</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')

<script>
    $(document).ready(function () {

        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

        $('.spinner').hide();

        function loadData(company_id, warehouse_id,category_id) { 
            $('#tableStockOpname').DataTable({
                        processing: true,
                        serverSide: true,
                        responsive: true,   
                        language: {
                            processing: '<i class="spinner-border text-secondary"></i><span class="sr-only">Waiting...</span> '},                    
                        ajax: {
                            url:"{{ route('get.stock.opname') }}",
                            data:{company_id:company_id,warehouse_id:warehouse_id,category_id:category_id}
                        },
                        columns: [
                            {data: 'id', name: 'id',orderable: false,searchable: false},
                            {data: 'drug_name', name: 'drug_name',searchable: false},
                            {data: 'warehouse_name', name: 'warehouse_name',orderable: false,searchable: false},
                            {data: 'unit_name', name: 'unit_name', orderable: false,searchable: false},
                            {data: 'date_exp', name: 'date_exp', orderable: false,searchable: false},
                            {data: 'qty', name: 'qty', orderable: false,searchable: false},
                            {data: 'description', name: 'description',orderable: false,searchable: false},
                        ]
                });
        }
        
        $('#btnFilter').click(function(){
            let company_id = $('#company_id').val();
            let warehouse_id = $('#warehouse_id').val();
            let category_id = $('#category_id').val();
            if(company_id == ""){
                $('#company_id').focus();
            }else{
            $('#tableStockOpname').DataTable().destroy();
                loadData(company_id,warehouse_id,category_id);
                // console.log(company_id,warehouse_id,category_id);
            }
        });
        
        $('form').on('submit', function(e){
            e.preventDefault();
            let form = $(this),
            url = form.attr('action'),
            csrf_token = $('meta[name="csrf-token]"').attr('content');
            $('.spinner').show();
            $.ajax({
                url: url,
                data: form.serialize(),
                dataType: 'json',
                method:'POST',
                success: function (data) {
                    $('.spinner').hide();
                    $('tbody tr').addClass('bg-primary');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        });

        $("#company_id").change(function (e) { 
            e.preventDefault();
            let company_id = $(this).val();
            if(company_id != ""){
                $.get("getdata/warehouse/"+company_id, function (res) {
                    $('#warehouse_id').empty();
                    $('#warehouse_id').append('<option value="">All</option>');
                        $.each(res, function(key, value) {
                            $('#warehouse_id').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                });
            }
        });


        $("#warehouse_id").change(function (e) { 
            e.preventDefault();
            let company_id = $("#warehouse_id").val();
            let warehouse_id = $(this).val();
            if(company_id != "" && warehouse_id !=""){
                $.get("getdata/warehouse/"+company_id+"/"+warehouse_id, function (res) {
                    $('#category_id').empty();
                    $('#category_id').append('<option value="">All</option>');
                        $.each(res, function(key, value) {
                            $('#category_id').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                });
            }
        });

    });
</script>
@endpush