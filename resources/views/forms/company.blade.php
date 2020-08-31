{!! Form::model($company, [
'route' =>$company->exists ? ['company.update', $company->id] : ['company.store'],
'method' =>$company->exists ? 'PUT' : 'POST'
]) !!}

<div class="form-group row">
    <label class="col-md-2 control-label">Name</label>
    <div class="col-md-4 form-input">
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
    </div>
</div>


{!! Form::close() !!}