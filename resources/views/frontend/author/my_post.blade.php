@extends('frontend.author.author_main')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h2 class="text-white">My Post Lists</h2>
            </div>
            <div class="card-body">
              @if (session('status'))
                  <div class="alert alert-success">{{ session('status') }}</div>
              @endif
              @if (session('past_del'))
               <div class="alert alert-success">{{ session('past_del') }}</div>
              @endif
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Title</th>
                        <th>Preview</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                @foreach ($posts as $index=>$post)
                    <tr>
                        <td>{{ $posts->firstitem()+$index }}</td>
                        <td>{{ $post->title }}</td>
                        <td>
                            <img src="{{ asset('uploads/post/preview') }}/{{ $post->preview }}" alt="">
                        </td>
                        <td><span class="badge badge-{{ $post->status==1?'primary':'secondary' }}">{{ $post->status==1? 'active':'Deactive' }}</span></td>
                        <td>
                            <a href="{{ route('my.post.status',$post->id) }}" class="btn btn-{{ $post->status==1?'primary':'secondary' }}">{{ $post->status==1? 'active':'Deactive' }}</a>
                            <a href="{{ route('my.post.delete',$post->id) }}" class="btn btn-danger">Delete</a>
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