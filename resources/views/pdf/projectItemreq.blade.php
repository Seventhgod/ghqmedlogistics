<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Demo in Laravel 7</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<table class="table table-bordered table-striped">
    <thead>
    <tr class="table-danger">
        <td>Project Code</td>
        <td>Project Name</td>
        <td>Item Name</td>
        <td>Quantity</td>
        <td>Unit</td>
        <td>Category</td>
    </tr>
    </thead>
    <tbody>
    @foreach ($itemreq as $queue)
        <tr>
            <td>{{ $queue->project_code }}</td>
            <td>{{ $queue->projectName }}</td>
            <td>{{ $queue->ItemName }}</td>
            <td>{{ $queue->quantity }}</td>
            <td>{{ $queue->unit }}</td>
            <td>{{ $queue->Category }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
