@extends('dashboard.admin.layouts.master')
@section('content')
<div class="col-md-6">
    <style>
        .btn-warning {
            position: relative;
            padding: 11px 16px;
            font-size: 15px;
            line-height: 1.5;
            border-radius: 3px;
            color: #fff;
            background-color: #ffc100;
            border: 0;
            overflow: hidden;
            transition: 0.2s;
        }

        .btn-warning input[type='file']{
            cursor: pointer;
            position: absolute;
            left: 0;
            top: 0;
            transform: scale(5);
            opacity: 0;
        }

        .btn-warning:hover {
            background: #d9a400;
        }

        .files {
            display: flex;
        }
    </style>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add User</h3>
        </div>
    
    
    <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')
            <div class="card-body pt-3 ps-2 pe-2">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address*</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="{{ old('email') }}" >
                </div>
                <span class="text-danger">@error('email'){{ $message }} @enderror</span>
            </div>
            <div class="card-body pt-0 ps-2 pe-2">
                <div class="form-group">
                    <label for="exampleInputEmail1">User name*</label>
                    <input type="text" class="form-control" id="user_name" placeholder="Enter email" name="user_name" value="{{ old('user_name') }}" >
                </div>
                <span class="text-danger">@error('user_name'){{ $message }} @enderror</span>
            </div>
            <div class="card-body pt-0 ps-2 pe-2">
                <div class="form-group">
                    <label for="exampleInputEmail1">Birthday</label>
                    <input type="date" class="form-control" id="birthday" placeholder="Enter email" name="birthday" value="{{ old('birthday') }}">
                </div>
                <span class="text-danger">@error('birthday'){{ $message }} @enderror</span>
            </div>
            <div class="card-body pt-0 ps-2 pe-2">
                <div class="form-group">
                    <label for="exampleInputEmail1">First name*</label>
                    <input type="text" class="form-control" id="first_name" placeholder="Enter email" name="first_name" value="{{ old('first_name') }}">
                </div>
                <span class="text-danger">@error('first_name'){{ $message }} @enderror</span>
            </div>
            <div class="card-body pt-0 ps-2 pe-2">
                <div class="form-group">
                    <label for="exampleInputEmail1">Last name*</label>
                    <input type="text" class="form-control" id="last_name" placeholder="Enter email" name="last_name" value="{{ old('last_name') }}" >
                </div>
                <span class="text-danger">@error('last_name'){{ $message }} @enderror</span>
            </div> 
            <div class="card-body pt-0 ps-2 pe-2">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="d-flex">Province*</label>       
                            <select class="form-control" id="selectProvince" aria-label="Default select example" name ="province_id">
                                <option value="">Select your province</option>
                                @foreach($provinces as $province) 
                                    <option value="{{ $province->id }}">{{ $province->name }} </option>
                                @endforeach
                            </select>
                </div>
                <span class="text-danger">@error('province_id'){{ $message }} @enderror</span>
            </div>

            <div class="card-body pt-0 ps-2 pe-2">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="d-flex">District*</label>                        
                            <select class="form-control" id="selectDistrict" aria-label="Default select example" name ="district_id">                               
                                <option default value="">Select your district</option>
                            </select>
                </div>
                <span class="text-danger">@error('district_id'){{ $message }} @enderror</span>
            </div>

            <div class="card-body pt-0 ps-2 pe-2">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="d-flex">Commune*</label>
                            <select class="form-control" id="selectCommune" aria-label="Default select example" name ="commune_id">
                                <option default value="">Select your commune</option>
                            </select>
                </div>
                <span class="text-danger">@error('commune_id'){{ $message }} @enderror</span>
            </div>
            <div class="card-body pt-0 ps-2 pe-2">
                <div class="form-group"> 
                        <label for="exampleInputEmail1">Avatar*</label>
                        <button class="btn-warning" style="display: block">
                            <input accept="image/*" type='file' id="imgInp" name="file_upload"/>
                            <label for="file_upload" class="files"><i class="material-icons">add_photo_alternate</i>Choose a photo</label>
                        </button>
                        <span class="text-danger">@error('file_upload'){{ $message }} @enderror</span>
                </div>
                <img id="blah" src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="your image"  style="max-width: 100%;"/>
            </div>
        <div class="card-footer float-left">
            <button type="submit" class="btn btn-primary add">ADD</button>
        </div>
    </form>
</div>   
@endsection


