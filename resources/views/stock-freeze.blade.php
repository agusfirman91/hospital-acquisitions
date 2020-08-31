@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Stock Freeze</div>
    </div>
    <div class="card-body">
        <form action="{{ route('stock.freeze.post')}}" method="POST" id="form-stock-freeze">
            @csrf
            <input type="hidden" name="id" id="id" value="">
            <div class="form-group row">
                <label class="col-md-2">Company</label>
                <div class="col-md-4">
                    <select name="company_id" id="company_id" class="form-control">
                        <option value="">Silahkan pilih</option>
                        @foreach ($companies as $company)
                        <option value="{{$company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2">Warehouse</label>
                <div class="col-md-10 form-input">
                    <div class="row">
                        @foreach ($warehouses as $warehouse)
                        <div class="col-6">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input warehouse_list_{{$warehouse->id}}"
                                    value="{{ $warehouse->id }}" name="warehouse_list_id">
                                <span class="custom-control-label">{{ $warehouse->name }}</span>
                            </label></div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="form-group row ml-0">
                <button type="submit" class="offset-md-2 btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(document).ready(function () {
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });


        $("#company_id").change(function (e) { 
            e.preventDefault();       
            let id = $(this).val();
            $('#id').val(id)
            $("input[name='warehouse_list_id']:checked").attr('checked',false);
            if(id != 0){
                $.ajax({
                    url: "{{ route('get.stock.freeze')}}",
                    data: {company_id:id},
                    dataType: 'json',
                    method:'POST',
                    success: function (data) {
                        for (let i = 0; i < data.length; i++) {
                            let id = data[i].id;
                            // console.log();                        
                        $(".warehouse_list_"+id).attr('checked',true);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            }
        });

        $("form").on('submit', function (e) {
            e.preventDefault();
            let form = $('#form-stock-freeze'),
            url = form.attr('action'),
            csrf_token = $('meta[name="csrf-token]"').attr('content');
            var warehouse_list_id = [];
            $.each($("input[name='warehouse_list_id']:checked"), function(){
                warehouse_list_id.push($(this).val());
            });
            let id = $("#id").val();
            $.ajax({
                url: url,
                data:{
                    'id':id,
                    'warehouse_list_id':warehouse_list_id,   
                    '_token': csrf_token
                },
                method: "POST",
                dataType: 'json',
                success: function (data) {
                    toastr.success(
                                data.msg,
                                'Information!',
                                {
                                    timeOut: 1000,
                                    fadeOut: 1000,
                                    onHidden: function () {
                                        window.location.reload();
                                    }
                                }
                            );
                    // tablewarehouse.draw();
                },
                error: function (xhr) {
                    let res = xhr.responseJSON;
                    console.log('Error:', res);
                  
                }
            });
            // console.log(warehouse_list_id);
        });


    });
</script>
@endpush