@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">List Kategori</div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-hover table-striped" style="width: 100%" id="tableCategory">
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

        let tableCategory = $('#tableCategory').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('get.category') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
        });
    });
</script>
@endpush