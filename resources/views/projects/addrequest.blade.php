@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('adminreq.index') !!}">Make Request</a>
        </li>
        <li class="breadcrumb-item active">Create</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                @if ($errors->has('email'))
                                @endif
                            </div>
                            <i class="fa fa-plus-square-o fa-lg"></i>
                            <strong>Make Request</strong>
                        </div>
                        <div class="card-body">
                            {!! Form::open(['route' => 'drugRequests.store']) !!}
                                @include('projects.fields2')
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
