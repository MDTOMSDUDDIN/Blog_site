@extends('frontend.author.author_main')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <!-- কার্ড হেডারে ফ্লেক্স লেআউট এবং বাটন যোগ করা হয়েছে -->
            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                <h3 class="text-white">My Post List</h3>
                <a href="{{ route('add.post') }}" class="btn btn-light">Add New Post</a>
            </div>
            <div class="card-body">
                @if (session('status_change'))
                    <div class="alert alert-success">{{ session('status_change') }}</div>
                @endif
                @if (session('del'))
                    <div class="alert alert-success">{{ session('del') }}</div>
                @endif
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Title</th>
                        <th>Preview</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($posts as $index => $post)
                        <tr>
                            <td>{{ $posts->firstitem() + $index }}</td>
                            <td>{{ $post->title }}</td>
                            <td>
                                <img src="{{ asset('uploads/post/preview/' . $post->preview) }}" alt="Preview Image" width="100">
                            </td>
                            <td>
                                <span class="badge badge-{{ $post->status == 1 ? 'success' : 'secondary' }}">
                                    {{ $post->status == 1 ? 'Active' : 'Deactive' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('my.post.status', $post->id) }}" class="btn btn-{{ $post->status == 1 ? 'success' : 'secondary' }}">
                                    {{ $post->status == 1 ? 'Active' : 'Deactive' }}
                                </a>
                                <a href="{{ route('my.post.delete', $post->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="my-5">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
