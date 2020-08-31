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
                <select name="company_id" id="company_id" class="form-control">
                    <option value="">Silahkan pilih</option>
                    @foreach ($companies as $company)
                    <option value="{{$company['id']}}">{{ $company['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row ml-0">
            <button type="submit" id="btnFilter" class="offset-md-2 btn btn-primary">Search</button>
        </div>

        <br>
        <div class="table-responsive">
            <table class="table table-sm table-hover table-striped" style="width: 100%" id="tableDrug">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th style="width:20%">Name</th>
                        <th>Company</th>
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

        function load_data(company_id, warehouse_id){
            let table = $('#tableDrug').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    lengthMenu: [[10, 25, 50,100, -1], [10, 25, 50, 100,"All"]],
                    ajax: {
                        url :"{{ route('get.drug') }}",
                        data:{company_id:company_id}
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'code', name: 'code'},
                        {data: 'name', name: 'name'},
                        {data: 'company_name', name: 'company_name'},
                        {data: 'unit_name', name: 'unit_name'},
                        {data: 'group_name', name: 'group_name'},
                        {data: 'category_name', name: 'category_name'},
                        {data: 'comodity_name', name: 'comodity_name'},
                        {data: 'material_name', name: 'material_name'},
                    ]
            });
        }

        // load_data();

        $('#btnFilter').click(function(){
            let company_id = $('#company_id').val();
            let warehouse_id = $('#warehouse_id').val();
            if(company_id == "" && warehouse_id == ""){
                $('#company_id').focus();
            }else{
            $('#tableDrug').DataTable().destroy();
                load_data(company_id,warehouse_id);
                // console.log(warehouse_id);
            }
        });


    });
</script>
@endpush