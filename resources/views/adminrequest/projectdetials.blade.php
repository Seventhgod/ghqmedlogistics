@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="">Pending Projects Requests</a>
        </li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Details</strong>
                            <a href="{{ route('adminreq.index') }}" class="btn btn-light">Back</a>
                            <div class="justify-content-end">
                                <a href="{{ route('projectItemreq.index', [$projectid->id]) }}" class="btn btn-success">Export to PDF</a>
                                <a href="{{ route('projectItemexc.index', [$projectid->id]) }}" class="btn btn-success">Export to Excel</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <th>ID</th>
                                    <th>Item Name</th>
                                    <th>Category</th>
                                    <th>Unit</th>
                                    </thead>
                                    <tbody>
                                    @foreach($getReq as $request)
                                        <tr>
                                            <td>{{$request->id}}</td>
                                            <td>{{$request->ItemName}}</td>
                                            <td>{{$request->Category}}</td>
                                            <td>{{$request->unit}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
