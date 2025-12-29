@extends('layouts.master')

@section('title', 'Edit Ticket #{{ $ticket->id }}')

@section('content')
<div class="row justify-content-center">
    <div class="col-xxl-8 col-lg-10">
        <div class="card border-0 shadow-lg">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Edit Ticket #{{ $ticket->id }}</h5>
            </div>
            <div class="card-body p-5">

                <form action="{{ route('tickets.update', $ticket) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <div class="col-md-12">
                            <label for="title" class="form-label">Ticket Title</label>
                            <input type="text" name="title" id="title" 
                                   class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title', $ticket->title) }}" 
                                   placeholder="Brief summary of your issue" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id" 
                                    class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="">Select category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                            {{ old('category_id', $ticket->category_id) == $category->id ? 'selected' : '' }}>
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
                                <option value="low" {{ old('priority', $ticket->priority) == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ old('priority', $ticket->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ old('priority', $ticket->priority) == 'high' ? 'selected' : '' }}>High</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" rows="8" 
                                      class="form-control @error('description') is-invalid @enderror" 
                                      placeholder="Describe your issue in detail..." required>{{ old('description', $ticket->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Current Images -->
                        @if($ticket->images && count($ticket->images) > 0)
                            <div class="col-12">
                                <label class="form-label">Current Images</label>
                                <div class="row g-3">
                                    @foreach($ticket->images as $image)
                                        <div class="col-md-4 position-relative">
                                            <img src="{{ asset('storage/' . $image) }}" 
                                                 class="img-fluid rounded shadow-sm" 
                                                 alt="Ticket image">
                                            <button type="button" 
                                                    class="btn btn-danger btn-sm position-absolute top-0 end-0 rounded-pill m-2 remove-image"
                                                    data-image="{{ $image }}">
                                                <i class="ri-close-line"></i>
                                            </button>
                                            <input type="hidden" name="delete_images[]" value="" class="deleted-image-input">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- New Images Upload -->
                        <div class="col-12">
                            <label for="images" class="form-label">Add/Replace Images (optional)</label>
                            <input type="file" name="images[]" id="images" class="form-control" 
                                   accept="image/*" multiple>
                            <small class="text-muted">You can upload new images to add or replace existing ones</small>

                            <!-- Live Preview for New Images -->
                            <div id="image-preview" class="mt-3 d-flex flex-wrap gap-3"></div>
                        </div>
                    </div>

                    <div class="mt-5 d-flex gap-3 justify-content-end">
                        <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-secondary btn-lg px-5">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            Update Ticket
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Image Preview & Delete Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Preview new images
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
                        <span class="badge bg-success position-absolute top-0 start-100 translate-middle p-2 rounded-pill">New</span>
                    `;
                    preview.appendChild(div);
                }
                reader.readAsDataURL(file);
            }
        });
    });

    // Remove existing image (mark for deletion)
    document.querySelectorAll('.remove-image').forEach(btn => {
        btn.addEventListener('click', function() {
            const imagePath = this.getAttribute('data-image');
            const parent = this.closest('.col-md-4');
            const input = parent.querySelector('.deleted-image-input');
            input.value = imagePath;
            parent.style.opacity = '0.5';
            this.innerHTML = '<i class="ri-check-line"></i>';
            this.classList.remove('btn-danger');
            this.classList.add('btn-success');
        });
    });
});
</script>
@endsection