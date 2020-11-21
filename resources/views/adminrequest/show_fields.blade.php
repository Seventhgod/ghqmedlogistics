<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $adminrequest->id }}</p>
</div>

<div class="form-group">
    {!! Form::label('Project Name', 'Project Name') !!}
    <p>{{ $adminrequest->project_name }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $adminrequest->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $adminrequest->updated_at }}</p>
</div>

