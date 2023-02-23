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
    <button class="btn-sm btn-primary mb-3 mt-3 d-block float-right"><a class="text-white" href="{{ route('admin.category.create') }}">Add Category</a></button>

    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Parent id</th>
            <th>Status</th>
            <th>Created</th>
            <th class="text-right">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $cat)
        <tr>
            <td>{{ $cat -> id }}</td>
            {{-- <td>{{ $user -> email }}</td> --}}
            <td>{{ $cat -> name }}</td>
            <td>{{ $cat -> parent_id }}</td>
            
            <td>
                @if($cat->status == 0)
                    <span class="badge badge-danger">Private</span>
                @else
                    <span class="badge badge-success">Public</span>                
                @endif
            </td>
            <td>{{ $cat -> created_at -> format('m-d-Y') }}</td>
            <td class="text-right">
                <form action="{{ route('admin.category.destroy', $cat->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <a href="{{ route('admin.category.edit', $cat->id) }}" class="btn btn-sm btn-success">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button class="btn btn-sm btn-danger btndelete">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </td>
            {{-- <td class="text-right">
                <a href="{{ route('admin.category.edit', $cat->id) }}" class="btn btn-sm btn-success">
                    <i class="fas fa-edit"></i>
                </a>
            </td> --}}
        </tr>
    @endforeach
    </tbody>
 </table>
 <hr>
 <div class="next d-flex justify-content-center">
    {{ $data->appends(request()->all())->links() }}
 </div>
 
@endsection
