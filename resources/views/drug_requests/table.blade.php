<div class="table-responsive-sm">
    <table class="table table-striped" id="drugRequests-table">
        <thead>
        <th>ID</th>
        <th>Project Code</th>
        <th>Item Name</th>
        <th>Quantity</th>
        <th>Unit</th>
        <th>Category</th>
        <th>Created At</th>
        <th colspan="3">Action</th>
        </thead>
        <tbody>
        @foreach($drugRequests as $items)
            <tr>
                <td>{{ $items->id }}</td>
                <td>{{ $items->project_code }}</td>
                <td>{{ $items->ItemName }}</td>
                <td>{{ $items->quantity }}</td>
                <td>{{ $items->unit }}</td>
                <td>{{ $items->Category }}</td>
                <td>
                    {!! Form::open(['route' => ['drugrequest.destroy', $items->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('drugrequest.show', [$items->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('drugrequest.edit', [$items->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

