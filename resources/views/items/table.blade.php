<div class="table-responsive-sm">
    <table class="table table-striped" id="drugRequests-table">
        <thead>
        <th>ID</th>
        <th>Product Code</th>
        <th>Item Name</th>
        <th>Pack</th>
        <th>Sub Category</th>
        <th>Category</th>
        <th colspan="3">Action</th>
        </thead>
        <tbody>
        @foreach($data as $items)
            <tr>
                <td>{{ $items->id }}</td>
                <td>{{ $items->productcode }}</td>
                <td>{{ $items->ProductName }}</td>
                <td>{{ $items->Pack }}</td>
                <td>{{ $items->SubCategory }}</td>
                <td>{{ $items->drugcategory }}</td>
                <td>
                    {!! Form::open(['route' => ['items.destroy', $items->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <!--<a href="{{ route('items.show', [$items->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>-->
                        <!--<a href="{{ route('items.edit', [$items->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>-->
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $data -> render() }}
</div>
