{!! Form::model($comodity, [
'route' =>$comodity->exists ? ['comodity.update', $comodity->id] : ['comodity.store'],
'method' =>$comodity->exists ? 'PUT' : 'POST'
]) !!}

<div class="form-group row">
    <label class="col-md-4 control-label">Name</label>
    <div class="col-md-8 form-input">
        {!! Form::select('company_id', $company,$comodity->company_id, ['class' =>
        'form-control', 'id'
        => 'company_id','placeholder'=>'Please Choose']) !!}
    </div>
</div>
<div class="form-group row">
    <label class="col-md-4 control-label">Name</label>
    <div class="col-md-8 form-input">
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
    </div>
</div>


{!! Form::close() !!}