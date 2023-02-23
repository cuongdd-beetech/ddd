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
        <div class="d-inline-flex justify-content-between w-100 mr-auto align-items-center">
        <form action="#" method="get" class="csvPdf">
            <div class="d-flex float-left">
                <select class="form-control w-100 select d-flex mt-2 float-left" aria-label="Default select example" name ="">
                    <option value="">Dowload option</option>
                    <option value="">Export Csv</option>
                    <option value="">Export Pdf</option>
                </select>
                <button type="submit" value="Submit" class="csv btn-sm btn-primary ml-3 h-50 mt-2 d-flex align-items-center">Select</button>
            </div>
        </form>

        <form action="{{ route('admin.product.index') }}" method="get" class="">
            <div class="d-flex">
                <select class="form-control w-100 d-flex mt-2" aria-label="Default select example" name ="stock">
                    <option value="#">Search option</option>
                    <option value="less10">Stock: < 10</option>
                    <option value="form10To100">Stock: 10-100</option>
                    <option value="form100to200">Stock: 100-200</option>
                    <option value="more200">Stock: > 200</option>
                </select>
                <button type="submit" value="Submit" class="btn-sm btn-primary ml-3 h-50 mt-2 align-items-center">Select</button>
            </div>
        </form>

        <form action="{{ route('admin.product.index') }}" method="get">
            <div class="w-25 d-flex">
                <input type="text" class="form-control" placeholder="Search your product" name="key">
                <button type="submit" value="Submit" class="btn-sm btn-primary ml-3 h-50 mt-1">Search</button>
            </div>
        </form>

        <button class="btn-sm btn-primary mb-3 mt-3 d-block float-right mr-0"><a class="text-white" href="{{ route('admin.product.create') }}">Add Product</a></button>    
        </div>
    <thead>
        <tr>
            <th>ID</th>
            <th>Sku</th>
            <th>Name</th>
            <th>Stock</th>
            <th>Expired at</th>
            <th class="text-right">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $pro)
        <tr id = "pid{{ $pro->id }}">
            <td>{{ $pro -> id }}</td>
            <td>{{ $pro -> sku }}</td>
            <td>{{ $pro -> name }}</td>
            <td>{{ $pro -> stock }}</td>
            <td>{{ $pro -> expired_at -> format('Y-m-d') }}</td>
            <td class="text-right">
                    <a href="{{ route('admin.product.edit', $pro->id) }}" class="btn btn-sm btn-success">
                        <i class="fas fa-edit"></i>
                    </a>
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <button data-route="{{ route('admin.product.delete', $pro->id) }}" data-value="{{ $pro->id }}" class="btn btn-sm btn-danger btndelete delPro btn-table-delete">
                        <i class="fas fa-trash"></i>
                    </button>
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
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).on('click','.btn-table-delete',function(){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                buttons: [true, "Do it!"],
              })
              .then((result) => {                 
                if (result.isConfirmed) {
                            $.ajax({
                                method: 'post',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: $(this).data('route'),
                                contentType: "application/json",
                                success: function (response, textStatus, xhr) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                     )
                                    window.location='/admin/product/index'
                                }
                            });
                }
              }) 
        });

        function exportTasks(_this) {
            let _url = $(_this).data('href');
            window.location.href = _url;
        }

        
            $('.csv').on('click', function(){
                if($(".select option:selected").text() == 'Export Csv'){
                    $('.csvPdf').attr('action', '{{ route('admin.product.export') }}')
                }else if($(".select option:selected").text() == 'Export Pdf'){
                    $('.csvPdf').attr('action', '{{ route('admin.product.exportPdf') }}')
                } else {
                    $('.csvPdf').attr('action', '#')
                }
            });

    </script>
@endsection