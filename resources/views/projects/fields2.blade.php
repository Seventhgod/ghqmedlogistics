<div class="form-group col-sm-6">
    {!! Form::label("Project Name", 'Project Name') !!}
    <input class="form-control" name="projectName" value="{{ $project_code->project_name }}" readonly>
</div>

<div class="form-group col-sm-6">
    {!! Form::label("project_code", 'Project Code: ') !!}
    <input class="form-control" name="project_code" value="{{ $project_code->project_code }}" readonly>
</div>

<div class="form-group col-sm-6">
    {!! Form::label("Category", 'Category') !!}
    <select class="form-control" name="Category" id="Category">
        @foreach($category as $categories)
            <option value="{{ $categories->name }}">{{ $categories->name }}</option>
        @endforeach
    </select>
</div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('select[name="Category"]').on('change', function () {
                var category = $(this).val();
                if(category){
                    $.ajax({
                        url: '/projects/getItemName/'+category,
                        type:"GET",
                        dataType:"json",
                        beforeSend: function(){
                            $('#loader').css("visibility", "visible");
                        },
                        success:function(data) {
                            $('select[name="ItemName"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="ItemName"]').append('<option value="'+ value.ProductName +'">' + value.ProductName + '</option>');
                            });
                        },
                        complete: function(){
                            $('#loader').css("visibility", "hidden");
                        }
                    });
                }
                else{
                    $('select[name="ItemName"]').empty();
                }
            });
        });
    </script>

<div class="form-group col-sm-6">
    {!! Form::label("Item Name", 'Item Name') !!}
    <select class="form-control" name="ItemName" id="ItemName">
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


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('projects.index') }}" class="btn btn-secondary">Cancel</a>
</div>
