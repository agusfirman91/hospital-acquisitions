{!! Form::model($company, [
'route' =>$company->exists ? ['company.update', $company->id] : ['company.store'],
'method' =>$company->exists ? 'PUT' : 'POST'
]) !!}

<div class="form-group row">
    <label class="col-md-4 control-label">Name</label>
    <div class="col-md-8 form-input">
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
    </div>
</div>

<div class="form-group row">
    <label class="col-md-4 control-label">Description</label>
    <div class="col-md-8 form-input">
        {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'description','rows'=>3]) !!}
    </div>
</div>


{!! Form::close() !!}