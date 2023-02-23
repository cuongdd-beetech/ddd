@extends('dashboard.admin.layouts.master')
@section('content')

 <table class="table table-hover">
    @if(Session::has('mesage'))
        <div class="arlert alert-success">
            {{ Session::get('mesage') }}
        </div>
    @endif
    @if(Session::has('status'))
        <div class="arlert alert-success">
            {{ Session::get('status') }}
        </div>
    @endif
    @if(Session::has('ermessage'))
        <div class="arlert alert-success">
            {{ Session::get('ermessage') }}
        </div>
    @endif

        <form action="{{ route('admin.user.index') }}" method="get">
            <div class="w-25 d-flex justify-content-start" style="margin-bottom: -50px">
                <input type="text" class="form-control" placeholder="Search your product" name="key" value="{{ old('key') }}">
                <button type="submit" value="Submit" class="btn-sm btn-primary ml-3 h-30 mt-1">Search</button>
            </div>
        </form>
        <button class="btn-sm btn-primary mb-3 mt-3 d-block float-right"><a class="text-white" href="{{ route('admin.user.create') }}">Add User</a></button>
    <thead>
        <tr>
            <th>ID</th>
            <th>User_name</th>
            <th>Birthday</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Status</th>
            <th>Created At</th>
            <th class="text-right">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $user)
        <tr>
            <td>{{ $user -> id }}</td>
            <td>{{ $user -> user_name }}</td>
            <td>{{ $user -> birthday }}</td>
            <td>{{ $user -> first_name }}</td>
            <td>{{ $user -> last_name }}</td>
            <td>
                @if($user->status == 0)
                    <span class="badge badge-danger">Private</span>
                @else
                    <span class="badge badge-success">Public</span>                
                @endif
            </td>
            <td>{{ $user -> created_at -> format('m-d-Y') }}</td>
            <td class="text-right">
                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-sm btn-success">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button class="btn btn-sm btn-danger btndelete">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
 </table>
 <hr>
 <div class="next d-flex justify-content-center">
    {{ $data->appends(request()->all())->links() }}
 </div>
 
@endsection

