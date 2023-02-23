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
            <h3 class="card-title">Edit User</h3>
        </div>
    
    
    <form action="{{ route('admin.user.update', $user->id) }}" method='post' enctype="multipart/form-data">
        @csrf 
        @method('PUT')
            <div class="card-body pt-3 ps-2 pe-2">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address*</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{ $user->email }}" required>
                </div>
                <span class="text-danger">@error('email'){{ $message }} @enderror</span>
            </div>
            <div class="card-body pt-0 ps-2 pe-2">
                <div class="form-group">
                    <label for="exampleInputEmail1">User name*</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="user_name" value="{{ $user->user_name }}" required>
                </div>
                <span class="text-danger">@error('user_name'){{ $message }} @enderror</span>
            </div>
            <div class="card-body pt-0 ps-2 pe-2">
                <div class="form-group">
                    <label for="exampleInputEmail1">Birthday</label>
                    <input type="date" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="birthday" value="{{ $user->birthday }}">
                </div>
                <span class="text-danger">@error('birthday'){{ $message }} @enderror</span>
            </div>
            <div class="card-body pt-0 ps-2 pe-2">
                <div class="form-group">
                    <label for="exampleInputEmail1">First name*</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="first_name" value="{{ $user->first_name }}" required>
                </div>
                <span class="text-danger">@error('first_name'){{ $message }} @enderror</span>
            </div>
             <div class="card-body pt-0 ps-2 pe-2">
                <div class="form-group">
                    <label for="exampleInputEmail1">Last name*</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="last_name" value="{{ $user->last_name }}" required>
                </div>
                <span class="text-danger">@error('last_name'){{ $message }} @enderror</span>
            </div>

            <div class="card-body pt-0 ps-2 pe-2">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="d-flex">Province*</label>
                            <select class="form-control" id="selectProvince" aria-label="Default select example" name ="province_id">
                                @foreach($provinces as $province)
                                    @if($province->id == $user->province_id)
                                        <option value="{{ $province->id }}" class ="province" selected>{{ $province->name }}</option>
                                    @else    
                                        <option value="{{ $province->id }}" class ="provinces">{{ $province->name }} </option>
                                    @endif
                                @endforeach
                            </select>                       
                </div>
                <span class="text-danger">@error('province_id'){{ $message }} @enderror</span>
            </div>
            <div class="card-body pt-0 ps-2 pe-2">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="d-flex ">District*</label>                   
                        <select class="form-control" id="selectDistrict" aria-label="Default select example" name ="district_id">
                            @foreach($districts as $district)
                                @if($district->id == $user->district_id) 
                                    <option  value="{{ $district->id }}" class="district" selected>{{ $district->name }}</option>
                                @else
                                    <option value="{{ $district->id }}" class="districted">{{ $district->name }}</option>
                                @endif
                            @endforeach
                        </select>                    
                </div>
                <span class="text-danger">@error('district_id'){{ $message }} @enderror</span>
            </div>

            <div class="card-body pt-0 ps-2 pe-2">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="d-flex">Commune*</label>
                        <select class="form-control" id="selectCommune" aria-label="Default select example" name ="commune_id">
                            @foreach($communes as $commune)
                                @if($commune->id == $user->commune_id)
                                    <option  value="{{ $commune->id }}" class="commune" selected>{{ $commune->name }} </option>
                                @else
                                    <option value="{{ $commune->id }}" class="communed">{{ $commune->name }}</option>
                                @endif
                            @endforeach
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
                <img id="blah" src="{{  asset('uploads/user/'.$user->avatar) }}" alt="your image"  style="max-width: 100%;" />
            </div>  
        <div class="card-footer">
            <button type="submit" class="btn btn-primary update">Update</button>
            <button class="btn btn-primary"><a href="{{ route('admin.user.index') }}" style="color: red">Cancel</a></button>
        </div>
    </form>
</div> 
@endsection

