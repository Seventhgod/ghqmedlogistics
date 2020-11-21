<div class="form-group col-sm-6">
    {!! Form::label('project_name', 'Project Name: ') !!}
    {!! Form::text('project_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('type', 'Project Type: ') !!}
    <input class="form-control datepicker" name="type"  type="text">
</div>

<div class="form-group col-sm-6">
    {!! Form::label('initiator', 'Initiator: ') !!}
    {!! Form::text('initiator', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('unit', 'Unit: ') !!}
    {!! Form::text('unit', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('file_number', 'File Number: ') !!}
    {!! Form::text('file_number', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('mission_code', 'Mission Code: ') !!}
    {!! Form::text('mission_code', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('location', 'Location: ') !!}
    {!! Form::text('location', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status: ') !!}
    <input class="form-control" name="status" value="Pending" readonly>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('contact', 'Contact (eg. 2332444444444): ') !!}
    <input class="form-control" type="tel" name="init_contact" maxlength="12">
</div>

<div class="form-group col-sm-6">
    {!! Form::label('email_address', 'Email Address: ') !!}
    <input class="form-control" type="email" name="email" maxlength="12">
</div>

<div class="form-group col-sm-6">
    {!! Form::label('pharmacist', 'Pharmacist: ') !!}
    <input class="form-control" type="text" name="pharmacist" maxlength="12">
</div>

<div class="form-group col-sm-6">
    {!! Form::label('exchange_rate', 'Exchange Rate: ') !!}
    <input class="form-control" type="text" name="exchange_rate" maxlength="6">
</div>

<div class="form-group col-sm-6">
    {!! Form::label('order_number', 'Order Number: ') !!}
    <input class="form-control" type="text" name="order_number" maxlength="8">
</div>

<div class="form-group col-sm-6">
    {!! Form::label('reference', 'Reference: ') !!}
    <input class="form-control" type="text" name="reference" maxlength="12">
</div>

<div class="form-group col-sm-6">
    <button class="btn btn-success" type="submit">Save</button>
    <a href="{{ route('projects.index') }}" class="btn btn-primary">Cancel</a>
</div>
