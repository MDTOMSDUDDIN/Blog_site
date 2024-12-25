@extends('frontend.author.author_main')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <!-- কার্ড হেডারে ফ্লেক্স লেআউট এবং বাটন যোগ করা হয়েছে -->
            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                <h3 class="text-white">Add New Post</h3>
                <a href="{{ route('my.post') }}" class="btn btn-light">My Post List</a>
            </div>
            <div class="card-body">
                @if(session('added'))
                <div class="alert alert-success" role="alert">
                    {{ session('added') }}
                </div>
                @endif
                @if(session('not'))
                <div class="alert alert-danger" role="alert">
                    {{ session('not') }}
                </div>
                @endif

                <!-- সাধারণ ত্রুটি বার্তা -->
                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- ক্যাটাগরি ফিল্ড -->
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control @error('category_id') border-danger @enderror">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option> 
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <!-- রিড টাইম ফিল্ড -->
                        <div class="col-lg-2">
                            <div class="mb-3">
                                <label for="read_time">Read Time</label>
                                <input type="number" name="read_time" id="read_time" class="form-control @error('read_time') border-danger @enderror" value="{{ old('read_time') }}">
                                @error('read_time')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <!-- পোস্ট টাইটেল ফিল্ড -->
                        <div class="col-lg-7">
                            <div class="mb-3">
                                <label for="title">Post Title</label>
                                <input type="text" name="title" id="title" class="form-control @error('title') border-danger @enderror" value="{{ old('title') }}">
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <!-- ডিসক্রিপশন ফিল্ড -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="desp">Description</label>
                                <textarea name="desp" id="summernote" class="form-control @error('desp') border-danger @enderror">{{ old('desp') }}</textarea>
                                @error('desp')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <!-- ট্যাগ ফিল্ড -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="tag_id">Tags</label>
                                <select name="tag_id[]" id="select-gear" class="demo-default @error('tag_id') border-danger @enderror" multiple placeholder="Select Tags...">
                                    <option value="">Select Tags..</option>
                                    <optgroup label="Climbing">
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}" {{ (collect(old('tag_id'))->contains($tag->id)) ? 'selected':'' }}>
                                                {{ $tag->tag_name }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                </select>
                                @error('tag_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                @error('tag_id.*')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <!-- প্রিভিউ ইমেজ ফিল্ড -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="preview" class="form-label">Preview</label>
                                <input type="file" name="preview" id="preview" class="form-control @error('preview') border-danger @enderror" accept="image/*">
                                @error('preview')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <!-- প্রিভিউ ইমেজ দেখানোর জন্য এলিমেন্ট -->
                                <img id="preview-image" src="#" alt="Preview Image" style="display: none; width: 200px; height:200px; margin-top: 10px;" />
                            </div>
                        </div>

                        <!-- থাম্বনেইল ইমেজ ফিল্ড -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="thumbnail" class="form-label">Thumbnail</label>
                                <input type="file" name="thumbnail" id="thumbnail" class="form-control @error('thumbnail') border-danger @enderror" accept="image/*">
                                @error('thumbnail')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <!-- থাম্বনেইল ইমেজ দেখানোর জন্য এলিমেন্ট -->
                                <img id="thumbnail-image" src="#" alt="Thumbnail Image" style="display: none; width: 200px; height:200px; margin-top: 10px;" />
                            </div>
                        </div>

                        <!-- সাবমিট বাটন -->
                        <div class="col-lg-6 m-auto">
                            <div class="mb-3 mt-5">
                                <button type="submit" class="btn btn-success form-control">Add Post</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- ফর্মের শেষে -->
            </div>
        </div> 
    </div>
</div>
@endsection

<!-- জাভাস্ক্রিপ্ট সেকশন -->
@section('scripts')
<script>
    // ফাংশন যা ইমেজ আপলোড এবং প্রিভিউ দেখাবে
    function readURL(input, previewId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var img = document.getElementById(previewId);
                img.src = e.target.result;
                img.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    // প্রিভিউ ইমেজের জন্য ইভেন্ট লিসেনার
    document.getElementById('preview').addEventListener('change', function(){
        readURL(this, 'preview-image');
    });

    // থাম্বনেইল ইমেজের জন্য ইভেন্ট লিসেনার
    document.getElementById('thumbnail').addEventListener('change', function(){
        readURL(this, 'thumbnail-image');
    });
</script>
@endsection

