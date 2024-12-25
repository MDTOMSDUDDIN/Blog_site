@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="text-white">Edit FAQ</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('faq.update',$faq->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Question</label>
                        <input type="text" name="question" class="form-control" value="{{ $faq->question }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Answer</label>
                        <textarea name="answer" class="form-control" rows="5">{{ $faq->answer }}</textarea>
                    </div>                    
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">Update FAQ</button>
                    </div>
                </form>
        </div>
    </div>
</div>
</div>

@endsection