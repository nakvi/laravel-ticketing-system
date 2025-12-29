@extends('layouts.master')

@section('title', 'Create New Ticket')

@section('content')
<div class="row justify-content-center">
    <div class="col-xxl-8 col-lg-10">
        <div class="card border-0 shadow-lg">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Create New Support Ticket</h5>
            </div>
            <div class="card-body p-5">

                <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-4">
                        <div class="col-md-12">
                            <label for="title" class="form-label">Ticket Title</label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title') }}" placeholder="Brief summary of your issue" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="">Select category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="priority" class="form-label">Priority</label>
                            <select name="priority" id="priority" class="form-select" required>
                                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ old('priority', 'medium') == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" rows="8" class="form-control @error('description') is-invalid @enderror"
                                      placeholder="Please describe your issue in detail..." required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                        <label for="images" class="form-label">Attach Images (optional)</label>
                        <input type="file" name="images[]" id="images" class="form-control" 
                            accept="image/*" multiple>
                        <small class="text-muted">You can upload multiple images (JPG, PNG, GIF)</small>

                        <!-- Live Preview -->
                        <div id="image-preview" class="mt-3 d-flex flex-wrap gap-3"></div>
                    </div>
                    </div>

                    <div class="mt-5 d-flex gap-3 justify-content-end">
                        <a href="{{ route('tickets.index') }}" class="btn btn-secondary btn-lg px-5">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            Submit Ticket
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById('images').addEventListener('change', function(e) {
    const preview = document.getElementById('image-preview');
    preview.innerHTML = '';

    [...e.target.files].forEach(file => {
        if (file.type.match('image.*')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'position-relative';
                div.innerHTML = `
                    <img src="${e.target.result}" class="img-thumbnail" style="width:150px;height:150px;object-fit:cover;">
                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 rounded-pill remove-image">
                        <i class="ri-close-line"></i>
                    </button>
                `;
                preview.appendChild(div);

                // Remove image from input on click
                div.querySelector('.remove-image').addEventListener('click', () => {
                    div.remove();
                    // Rebuild file list (complex, but optional)
                });
            }
            reader.readAsDataURL(file);
        }
    });
});
</script>
@endsection