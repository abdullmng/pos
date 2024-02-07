@extends('layouts.app')
@section('title', 'Edit Branch')

@section('breadcrumb')
<ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('branches.index') }}">Branches</a></li>
        <li class="breadcrumb-item active">Edit</li>
</ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{ route('branches.update', $branch->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                    <div class="form-group">
                        <button class="btn btn-primary">Update Branch <i class="bi bi-check"></i></button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="branch_name">Branch Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" required value="{{ $branch->name }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="location">Branch Location <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="location" required value="{{ $branch->location }}">
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
