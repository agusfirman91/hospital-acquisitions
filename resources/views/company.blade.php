@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">LIst Company</div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-hover table-striped" style="width: 100%" id="tableCompany">
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
        <br>
        <a class="btn btn-primary modal-show" title="Add Company" href="{{ route('company.create')}}">Add Company</a>
    </div>
</div>
@include('layouts.modal')
@endsection

@push('scripts')

<script>
    $(document).ready(function () {

        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

        let tableCompany = $('#tableCompany').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('get.company') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
        });

        $('body').on('click', '.modal-show', function (event) {
            event.preventDefault();
            // console.log('OK');
            
            let me = $(this),
                url = me.attr('href'),
                title = me.attr('title');

            $('#modal-title').html(title);
            $('#modal-btn-save').text(me.hasClass('edit') ? 'Update' : 'Create');
            $.ajax({
                url: url,
                dataType:'html',
                success:function(response){
                    $('#modal-body').html(response)
                } 
            });

            $('#modal').modal('show');
        });


    });
</script>
@endpush