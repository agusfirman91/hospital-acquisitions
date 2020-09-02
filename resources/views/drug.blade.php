@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">List Barang / Obat</div>
    </div>
    <div class="card-body">

        <div class="form-group row">
            <label class="col-md-2">Company</label>
            <div class="col-md-4">
                <select name="company_id" id="company_id" class="form-control form-control-sm">
                    <option value="">Silahkan pilih</option>
                    @foreach ($companies as $company)
                    <option value="{{$company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
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
            <button type="submit" id="btnFilterDrug" class="offset-md-2 btn btn-primary">Search</button>
        </div>

        <br>
        <div class="table-responsive">
            <table class="table table-sm table-hover table-striped" style="width: 100%" id="tableDrug">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>#Kode</th>
                        <th style="width:20%">Name</th>
                        <th>Satuan</th>
                        <th>Ketegori</th>
                        <th>Golongan</th>
                        <th>Komoditas</th>
                        <th>Material Group</th>
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

<script>
    $(document).ready(function () {

        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

        function load_data(company_id, category_id){
            let table = $('#tableDrug').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    lengthMenu: [[10, 25, 50,100, -1], [10, 25, 50, 100,"All"]],
                    ajax: {
                        url :"{{ route('get.drug') }}",
                        data:{company_id:company_id,category_id:category_id}
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'code', name: 'code'},
                        {data: 'name', name: 'name'},
                        {data: 'unit_name', name: 'unit_name'},
                        {data: 'category_name', name: 'category_name'},
                        {data: 'group_name', name: 'group_name'},
                        {data: 'comodity_name', name: 'comodity_name'},
                        {data: 'material_name', name: 'material_name'},
                    ]
            });
        }

        // load_data();

        $('#btnFilterDrug').click(function(){
            let company_id = $('#company_id').val();
            let category_id = $('#category_id').val();
            if(company_id == "" && category_id == ""){
                $('#company_id').focus();
            }else{
            $('#tableDrug').DataTable().destroy();
                load_data(company_id,category_id);
                // console.log(warehouse_id);
            }
        });


    });
</script>
@endpush