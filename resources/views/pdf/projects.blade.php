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
        <td>Project Name</td>
        <td>Date</td>
        <td>Type</td>
        <td>Initiator</td>
        <td>Unit</td>
        <td>File Number</td>
        <td>Mission Code</td>
        <td>Location</td>
        <td>Contact (Initiator)</td>
        <td>Pharmacist</td>
        <td>Reference</td>
    </tr>
    </thead>
    <tbody>
    @foreach ($data as $queue)
        <tr>
            <td>{{ $queue->project_name }}</td>
            <td>{{ $queue->date }}</td>
            <td>{{ $queue->type }}</td>
            <td>{{ $queue->initiator }}</td>
            <td>{{ $queue->unit }}</td>
            <td>{{ $queue->file_number }}</td>
            <td>{{ $queue->mission_code }}</td>
            <td>{{ $queue->location }}</td>
            <td>{{ $queue->init_contact }}</td>
            <td>{{ $queue->pharmacist }}</td>
            <td>{{ $queue->reference }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
