@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">List Gudang</div>
    </div>
    <div class="card-body">

        <br>
        <div class="table-responsive">
            <table class="table table-sm table-hover table-striped" style="width: 100%" id="tableStock">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th></th>
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

        function loadData(company_id, warehouse_id) { 
                $('#tableStock').DataTable({
                        processing: true,
                        serverSide: true,
                        responsive: true,
                        ajax: "{{ route('get.warehouse') }}",
                        columns: [
                            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                            {data: 'name', name: 'name'},
                            {data: 'action', name: 'action', orderable: false, searchable: false},
                        ]
                });
        }


        loadData();

        $('#btnFilter').click(function(){
            let company_id = $('#company_id').val();
            let warehouse_id = $('#warehouse_id').val();
            if(company_id == "" && warehouse_id == ""){
                $('#company_id').focus();
            }else{
            $('#tableDrug').DataTable().destroy();
                loadData(company_id,warehouse_id);
                // console.log(warehouse_id);
            }
        });


        
    });
</script>
@endpush