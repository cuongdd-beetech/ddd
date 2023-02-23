@extends('dashboard.admin.layouts.master')
@section('content')
<div class="col-md-6">


    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Update</h3>
        </div>
    
    <form action="{{ route('admin.category.update', $category->id) }}" method='post'  enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="card-body pt-3 ps-2 pe-2">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name*</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name" value="{{ $category->name }}" required>
                </div>
                <span class="text-danger">@error('name'){{ $message }} @enderror</span>
            </div>
            <div class="card-body pt-0 ps-2 pe-2">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="d-flex">Parent id</label>
                
                            <select class="form-control" aria-label="Default select example" name ="parent_id">
                                @if($category->parent_id == null)
                                    <option value="">Null</option>
                                    @foreach($data as $data1)                          
                                        <option value="{{ $data1->id }}">{{ $data1->id }}-{{ $data1->name }} </option>
                                    @endforeach
                                @else
                                    <option value="{{ $category->parent_id }}">{{ $category->parent_id }}</option>
                                    @foreach($data as $data1)                          
                                        <option value="{{ $data1->id }}">{{ $data1->id }}-{{ $data1->name }} </option>
                                    @endforeach
                                @endif
                                </select>
                </div>
                
                <span class="text-danger">@error('parent_id'){{ $message }} @enderror</span>
            </div>
        <div class="card-footer float-left">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>   
@endsection