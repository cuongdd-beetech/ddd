@extends('dashboard.admin.layouts.master')
@section('content')
<div class="col-md-6">


    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add Category</h3>
        </div>
    
    <form action="{{ route('admin.category.store') }}" method='post'  enctype="multipart/form-data">
        @csrf
        @method('POST')
            <div class="card-body pt-3 ps-2 pe-2">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name*</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name" value="{{ old('name') }}" required>
                </div>
                <span class="text-danger">@error('name'){{ $message }} @enderror</span>
            </div>
            <div class="card-body pt-0 ps-2 pe-2">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="d-flex">Parent id</label>
                
                            <select class="form-control" aria-label="Default select example" name ="parent_id" >
                                <option default>Open this select menu</option>
                                @foreach($data as $dataCat) 
                                    <option value="{{ $dataCat->id }}"> {{ $dataCat->name }} </option>
                                @endforeach
                            </select>
                </div>
                <span class="text-danger">@error('parent_id'){{ $message }} @enderror</span>
            </div>
        <div class="card-footer float-left">
            <button type="submit" class="btn btn-primary">ADD</button>
        </div>
    </form>
</div>   
@endsection
