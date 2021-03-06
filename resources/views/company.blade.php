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
                        <th>#ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <br>
        <a class="btn btn-secondary modal-show" title="Add Company" href="{{ route('company.create')}}">
            <i class="fas fa-plus" data-feather="add"></i>
            Add Company</a>
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
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
        });

        $('body').on('click', '.modal-show', function (event) {
            event.preventDefault();
            
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

        
        $('#modal-btn-save').click(function (event) {
            event.preventDefault();
            $(this).html('Sending..');
            
            
            let form = $('#modal-body form'),
            url = form.attr('action'),
            csrf_token = $('meta[name="csrf-token]"').attr('content'),
            method = $('input[name=_method]').val() == undefined ? 'POST' : 'PUT';
            form.find('.help-block').remove();
            form.find('.form-group').removeClass('has-error');
            
            let name = $('input:text[name=name]').val();
            let description = $('textarea[name=description]').text();
            
            $.ajax({
                url: url,
                data: form.serialize(),
                method: method,
                dataType: 'json',
                success: function (data) {
                // console.log(date);
                    $('#siteForm').trigger("reset");
                    $('#modal').modal('hide');
                    toastr.success(data.msg, 'Information', {
                        timeOut: 1000
                    });
                    tableCompany.draw();
                },
                error: function (xhr) {
                    let res = xhr.responseJSON;
                    // console.log('Error:', res);
                    $(this).html('Create');
                    if($.isEmptyObject(res) == false){
                        $.each(res.errors, function(key, value){
                            $('#' + key)
                            .closest('.form-input')
                            .addClass('has-error')
                            .append('<span class="help-block text-danger"><strong>'+ value + '</strong></span>');
                        })
                    }
                    // $('#saveBtn').html('Save Changes');
                }
            });
        });

    });
</script>
@endpush