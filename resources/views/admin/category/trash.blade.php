@extends('layouts.admin');
@section('content')
{{-- @can('category_trash') --}}
    

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white">Trash Category List</h3>
            </div>
            <div class="card-body">
                @if (session('restore'))
            <div class="alert alert-success">{{ session('restore') }}</div>
            @endif
           
                <form action="{{ route('category.check.restore') }}" method="POST">
                @csrf
                <table class="table table-striped">
                    <tr>
                        <th width="50"><div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" id="chkSelectAll">
                                Check All
                            <i class="input-frame"></i></label>
                        </div></th>
                        <th>SL</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($trash_cat as $index=>$category )
                        <tr>
                            <td><div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" name="category_id[]" value="{{ $category -> id }}" class="form-check-input chkDel">
                                <i class="input-frame"></i></label>
                            </div></td>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>
                            <img src="{{ asset('uploads/category') }}/{{ $category->category_image }}" alt="">
                        </td>
                        <td>
                            <a href="{{ route('category.restore',$category->id) }}" class="btn btn-info">Restore</a>
                            <a data-link="{{ route('category.hard.delete',$category->id) }}" class="btn btn-danger del">Delete</a>
                            
                        </td>
                    </tr>
                    @endforeach
                    
                </table>
                <div class="my-2">
                    <button name="action_btn" value="1" type="submit" class="btn btn-info del_check d-none">Restore</button>
                    <button name="action_btn" value="2" type="submit" class="btn btn-danger del_check d-none">Delete Checked</button>
                </div>
            </form>
            </div>
        </div>



    </div>
</div>
{{-- @endcan --}}

@endsection

@section('script')
    <script>
        $('.del').click(function(){
            Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        var link =$(this).attr('data-link');
                        window.location.href =link
                    }
                    });
        });
    </script>

    @if (session('pdel'))
    <script>
        Swal.fire({
            title: "Good job!",
            text: "{{ session('pdel') }}",
            icon: "success"
            });
    </script>
    @endif
    <script>
        $("#chkSelectAll").on('click', function(){
     this.checked ? $(".chkDel").prop("checked",true) : $(".chkDel").prop("checked",false); 
     $('.del_check').toggleClass('d-none')
})

$(".chkDel").on('click', function(){
     $('.del_check').removeClass('d-none')
})
    </script>

@endsection


