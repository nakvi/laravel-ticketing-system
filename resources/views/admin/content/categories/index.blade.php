@extends('layouts.master')

@section('title', 'Manage Categories')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Categories</h4>
                <a href="{{ route('categories.create') }}" class="btn btn-primary">Add New Category</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description ?? '—' }}</td>
                                    <td>
                                        <!-- Active Toggle Button -->
                                        <form action="{{ route('categories.toggle-active', $category) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-sm {{ $category->is_active ? 'btn-success' : 'btn-secondary' }}"
                                                title="{{ $category->is_active ? 'Deactivate' : 'Activate' }}">
                                                <i class="ri-toggle-{{ $category->is_active ? 'fill' : 'line' }}"></i>
                                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                                            </button>
                                        </form>

                                        <!-- Edit Button -->
                                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning ms-1">
                                            <i class="ri-edit-line"></i> Edit
                                        </a>

                                        <!-- Delete Button with Confirmation Modal -->
                                        <button type="button" class="btn btn-sm btn-danger ms-1" data-bs-toggle="modal"
                                            data-bs-target="#confirmModal" data-action="delete" data-title="Delete Category?"
                                            data-message="This will permanently delete the category. Tickets using it will remain."
                                            data-form-action="{{ route('categories.destroy', $category) }}"
                                            data-method="DELETE">
                                            <i class="ri-delete-bin-line"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No categories yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection