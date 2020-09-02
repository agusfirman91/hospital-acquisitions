{!! Form::model($group, [
'route' =>$group->exists ? ['group.update', $group->id] : ['group.store'],
'method' =>$group->exists ? 'PUT' : 'POST'
]) !!}

<div class="form-group row">
    <label class="col-md-4 control-label">Name</label>
    <div class="col-md-8 form-input">
        {!! Form::select('company_id', $company,$group->company_id, ['class' =>
        'form-control', 'id'
        => 'company_id','placeholder'=>'Please Choose']) !!}
    </div>
</div>

<div class="form-group row">
    <label class="col-md-4 control-label">Code</label>
    <div class="col-md-8 form-input">
        {!! Form::text('code', null, ['class' => 'form-control', 'id' => 'code']) !!}
    </div>
</div>

<div class="form-group row">
    <label class="col-md-4 control-label">Name</label>
    <div class="col-md-8 form-input">
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
    </div>
</div>


{!! Form::close() !!}