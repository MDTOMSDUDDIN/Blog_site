@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white">Faq List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    @if (session('edit_faq'))
                    <div class="alert alert-success">{{ session('edit_faq') }}</div>
                    @endif
                    @if (session('del_faq'))
                    <div class="alert alert-success">{{ session('del_faq') }}</div>
                    @endif
                    <tr>
                        <th>SL</th>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Action</th>
                    </tr>
                    @foreach($faqs as $key => $faq)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $faq->question }}</td>
                            <td>{{ Str::substr($faq->answer, 0, 40) . '....' }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('faq.show', $faq->id) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('faq.edit', $faq->id) }}" class="btn btn-success btn-sm">Edit</a>
                                    <form action="{{ route('faq.destroy', $faq->id) }}" method="POST" style="display:inline;">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="4">
                            <a href="{{ route('faq.create') }}" class="btn btn-secondary">Add New</a>
                        </td>
                    </tr>
                </table>  
            </div>
        </div>
    </div>
</div>

@endsection
