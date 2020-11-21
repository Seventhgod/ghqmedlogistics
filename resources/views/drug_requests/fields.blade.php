<div class="form-group col-sm-6">
    {!! Form::label("Project Name", 'Project Name') !!}
    <select class="form-control" name="product_id">
        {{ $project = \App\Projects::all(['id', 'project_name']) }}
        @foreach($project as $project)
            <option value="{{ $project->project_name }}">{{ $project->project_name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group col-sm-6">
    {!! Form::label("Item Name", 'Item Name') !!}
    <select class="form-control" name="product_id">
        {{ $project = \App\Items::all(['id', 'ProductName']) }}
        @foreach($project as $project)
            <option value="{{ $project->ProductName }}">{{ $project->ProductName }}</option>
        @endforeach
    </select>
</div>
<div class="form-group col-sm-6">
    {!! Form::label("Quantity", 'Quantity') !!}
    {!! Form::text('quantity',null, ['class'=>'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label("Unit", 'Unit') !!}
    {!! Form::text('unit',null, ['class'=>'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label("Category", 'Category') !!}
    {!! Form::text('Category',null, ['class'=>'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('drugRequests.index') }}" class="btn btn-secondary">Cancel</a>
</div>
